<?php
/**
###COMMON_PHP_FILE_HEADER###
*/

// include ###BANKNAME### API class
require_once(DIR_FS_CATALOG . 'inc/xtc_output_warning.inc.php');
require_once (DIR_FS_CATALOG . 'includes/classes/__vads_api.php');

// include the admin configuration functions
include_once (DIR_FS_CATALOG . 'admin/includes/functions/__vads_output.php');

// load module language file
 $language = $_SESSION['language'];
 include_once(DIR_FS_CATALOG . "lang/$language/modules/payment/__vads_multi.php");

/**
 * Main class implementing ###BANKNAME### multiple payment module for OSC.
 */
class __vads_multi {
	/**
	 * @var string
	 */
	var $code;
	/**
	 * @var string
	 */
	var $title;
	/**
	 * @var string
	 */
	var $description;
	/**
	 * @var boolean
	 */
	var $enabled;
	/**
	 * @var int
	 */
	var $sort_order;
	/**
	 * @var string
	 */
	var $form_action_url;
	/**
	 * @var int
	 */
	var $order_status;

	/**
	 * Class constructor
	 */
	function __vads_multi() {
		global $order;

		// initialize code
		$this->code = '__vads_multi';
		
		// initialize title
		$this->title = '<img src="'.DIR_WS_CATALOG.'images/###LOGO###" style="width: 100px; vertical-align: middle; border: none;" alt="###BANKNAME###"> '. MODULE_PAYMENT___VADS_MULTI_TEXT_TITLE;
		
		// initialize description
		$this->description  = '';
		$this->description .= '<b>' . MODULE_PAYMENT___VADS_MODULE_INFORMATION . '</b>';
		$this->description .= '<br/><br/>';
		
		$this->description .= '<table class="infoBoxContent">';
		$this->description .= '<tr><td style="text-align: right;">' . MODULE_PAYMENT___VADS_DEVELOPED_BY . '</td><td><a href="http://www.lyra-network.com/" target="_blank"><b>Lyra network</b></a></td></tr>';
		$this->description .= '<tr><td style="text-align: right;">' . MODULE_PAYMENT___VADS_CONTACT_EMAIL . '</td><td><a href="mailto:###SUPPORT_EMAIL###"><b>support@__vads.ch</b></a></td></tr>';
		$this->description .= '<tr><td style="text-align: right;">' . MODULE_PAYMENT___VADS_CONTRIB_VERSION . '</td><td><b>###CONTRIB_VERSION###</b></td></tr>';
		$this->description .= '<tr><td style="text-align: right;">' . MODULE_PAYMENT___VADS_GATEWAY_VERSION . '</td><td><b>V2</b></td></tr>';
		$this->description .= '<tr><td style="text-align: right;">' . MODULE_PAYMENT___VADS_CMS_VERSION . '</td><td><b>###CMS_NAME### ###CMS_VERSION###</b></td></tr>';
		$this->description .= '</table>';
		
		$this->description .= '<br/>';
		$this->description .= MODULE_PAYMENT___VADS_CHECK_URL . '<b>' . HTTP_SERVER . DIR_WS_CATALOG . 'checkout_process___vads.php</b>';
		$this->description .= '<hr />';
		
		// initialize enabled
		$this->enabled = (MODULE_PAYMENT___VADS_MULTI_STATUS == '1');

		// initialize sort_order
		$this->sort_order = MODULE_PAYMENT___VADS_MULTI_SORT_ORDER;
		
		$this->form_action_url = MODULE_PAYMENT___VADS_MULTI_PLATFORM_URL;
		
		if ((int)MODULE_PAYMENT___VADS_MULTI_ORDER_STATUS > 0) {
			$this->order_status = MODULE_PAYMENT___VADS_MULTI_ORDER_STATUS;
		}

		// if there's an order to treat, start preliminary payment zone check
		if (is_object($order)) {
			$this->update_status();
		}
	}

	/**
	 * Payment zone and amount restriction checks
	 */
	function update_status() {
		global $order;
		
		if(!$this->enabled) {
			return;
		}
		$billing_zone = $order->billing['zone_id'];
		
		// check customer zone
		if ((int)MODULE_PAYMENT___VADS_MULTI_ZONE > 0) {
			$flag = false;
			$check_query = xtc_db_query("SELECT zone_id FROM " . TABLE_ZONES_TO_GEO_ZONES .
										" WHERE geo_zone_id = '" . MODULE_PAYMENT___VADS_MULTI_ZONE .
										"' AND zone_country_id = '" . $order->billing['country']['id'] .
										"' ORDER by zone_id ASC;");
			while ($check = xtc_db_fetch_array($check_query)) {
				if (($check['zone_id'] < 1) || ($check['zone_id'] == $billing_zone)) {
					$flag = true;
					break;
				}
			}

			if (!$flag) {
				$this->enabled = false;
			}	
		}
		
		// check amount restrictions
		if ((MODULE_PAYMENT___VADS_MULTI_AMOUNT_MIN != '' && $order->info['total'] < MODULE_PAYMENT___VADS_MULTI_AMOUNT_MIN)
				|| (MODULE_PAYMENT___VADS_MULTI_AMOUNT_MAX != '' && $order->info['total'] > MODULE_PAYMENT___VADS_MULTI_AMOUNT_MAX)) {
			$this->enabled = false;
		}
		
		// check currency		
		$__vadsMultiApi = new __VadsMultiApi('###CONTRIB_ENCODING###'); // load ###BANKNAME###s payment API
		
		$defaultCurrency = (defined('USE_DEFAULT_LANGUAGE_CURRENCY') && USE_DEFAULT_LANGUAGE_CURRENCY == 'true') ? LANGUAGE_CURRENCY : DEFAULT_CURRENCY;
		if(!$__vadsMultiApi->findCurrencyByAlphaCode($order->info['currency']) && !$__vadsMultiApi->findCurrencyByAlphaCode($defaultCurrency)) {
			// currency is not supported, module is not available
			$this->enabled = false;
		}
		
		// check multi payment options
		$options = $this->get_available_options();
		if(count($options) <= 0) {
			$this->enabled = false;
		}
	}
	
	function get_available_options() {
		global $order;
		
		$amount = $order->info['total'];
		
		$options = MODULE_PAYMENT___VADS_MULTI_OPTIONS ? 
					json_decode(MODULE_PAYMENT___VADS_MULTI_OPTIONS, true) : 
					array(); 
			
		$availOptions = array();
		if(is_array($options) && count($options) > 0) {
			foreach ($options as $code => $option) {
				if(empty($option)) {
					continue;
				}
	
				if((!$option['min_amount'] || $amount >= $option['min_amount'])
				&& (!$option['max_amount'] || $amount <= $option['max_amount'])) {
					// option will be available
					$availOptions[$code] = $option;
				}
			}
		}
			
		return $availOptions;
	}

	/**
	 * JS checks : we let the platform do all the validation itself
	 * @return false
	 */
	function javascript_validation() {
		return false;
	}

	/**
	 * Parameters for what the payment option will look like in the list
	 * @return array
	 */
	function selection() {
		global $order;
		
		$this->update_status();
		if (!$this->enabled) {
			return null;
		}
		$selection = array(
				'id' => $this->code,
                'module' => str_replace('###LOGO###', '###LOGO3###', $this->title)
		);
		
		$first = true;
		foreach ($this->get_available_options() as $code => $option) {
			$checked = '';
			if($first) {
				$checked = ' checked="checked"';
				$first = false;
			}
			$selection['fields'][] = array(
					'title' => '',
					'field' => '<input type="radio" id="__vads_multi_option_' . $code . '" name="__vads_multi_option" value="'.$code.'" 
					 onclick="$(\'input[name=payment][value=__vads_multi]\').attr(\'checked\', true);
					 setTimeout( function(){ $(\'#innopay_multi_option_' . $code.'\').attr(\'checked\',\'checked\'); },10);" 
					 style="vertical-align: middle; margin-top: 0;"' . $checked . '> ' .
					'<label for="__vads_multi_option_' . $code . '">' . $option['label'] . '</label>' 			
			);
		}
		
		return $selection;
	}

	/**
	 * Server-side checks after payment selection : We let the platform do all the validation itself
	 * @return false
	 */
	function pre_confirmation_check() {
		return false;
	}

	/**
	 * Server-size checks before payment confirmation :  We let the platform do all the validation itself
	 * @return false
	 */
	function confirmation() {
		return false;
	}

	/**
	 * Prepare the form that will be sent to the payment gateway
	 * @return string
	 */
	function process_button() {
		global $order,$xtPrice ;
		
		// load ###BANKNAME### payment API
		$__vadsMultiApi = new __VadsMultiApi('###CONTRIB_ENCODING###');
		
		// admin configuration parameters
		$configParams = array(
				'site_id', 'key_test', 'key_prod', 'ctx_mode', 'platform_url', 'available_languages',
				'capture_delay', 'validation_mode', 'payment_cards', 'redirect_enabled',
				'redirect_success_timeout', 'redirect_success_message', 'redirect_error_timeout',
				'redirect_error_message', 'return_mode'
		);
		
		foreach ($configParams as $name) {
			$__vadsMultiApi->set($name, constant('MODULE_PAYMENT___VADS_MULTI_' . strtoupper($name)));
		}
		
		// get the shop language code
		$query = xtc_db_query("SELECT code FROM " . TABLE_LANGUAGES . " WHERE languages_id = " . $_SESSION['languages_id']);
		$langData = xtc_db_fetch_array($query);
		$__vadsLanguage = $__vadsMultiApi->isSupportedLanguage($langData['code']) ?
					strtolower($langData['code']) :
					MODULE_PAYMENT___VADS_MULTI_LANGUAGE;
		
		// get the currency to use
		$currencyValue = $order->info['currency_value'];
		$__vadsCurrency = $__vadsMultiApi->findCurrencyByAlphaCode($order->info['currency']);
		if(!$__vadsCurrency) {
			// currency is not supported, use the default shop currency
			$defaultCurrency = (defined('USE_DEFAULT_LANGUAGE_CURRENCY') && USE_DEFAULT_LANGUAGE_CURRENCY == 'true') ? 
								LANGUAGE_CURRENCY : DEFAULT_CURRENCY;
			$__vadsCurrency = $__vadsMultiApi->findCurrencyByAlphaCode($defaultCurrency);
			$currencyValue = 1;
		}
		
		// calculate amount ...
		$total = round($order->info['total'] * $currencyValue, $xtPrice->get_decimal_places($__vadsCurrency->alpha3));
		
		// activate 3ds ?
		$threedsMpi = null;
		if(MODULE_PAYMENT___VADS_MULTI_3DS_MIN_AMOUNT != '' && $order->info['total'] < MODULE_PAYMENT___VADS_MULTI_3DS_MIN_AMOUNT) {
			$threedsMpi = '2';
		}
		
		// other parameters
		$version = '';
		$coo_versioninfo = MainFactory::create_object('VersionInfo');
		foreach ($coo_versioninfo->get_shop_versioninfo() as $key => $value) {
			$version = $key;
		}
		$data = array(
				// order info
				'amount' => $__vadsCurrency->convertAmountToInteger($total),
				'order_id' => $this->_guess_order_id(),
				'contrib' => '###CONTRIB_PARAM###/' . $version,
				'order_info' => 'session_id=' . session_id(),
		
				// misc data 
				'currency' => $__vadsCurrency->num, 
				'language' => $__vadsLanguage,
				'threeds_mpi' => $threedsMpi,
				'url_return' => xtc_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL'),
				
				// customer info
				'cust_id' => $_SESSION['customer_id'],
				'cust_email' => $order->customer['email_address'],
				'cust_phone' => $order->customer['telephone'],
				'cust_first_name' => $order->billing['firstname'],
				'cust_last_name' => $order->billing['lastname'],
				'cust_address' => $order->billing['street_address'] . ' ' . $order->billing['suburb'],
				'cust_city' => $order->billing['city'],
				'cust_state' => $order->billing['state'],
				'cust_zip' => $order->billing['postcode'],
				'cust_country' => $order->billing['country']['iso_code_2']
		);
		
		// delivery data
		if($order->delivery != false) {
			$data['ship_to_first_name'] = $order->delivery['firstname'];
			$data['ship_to_last_name'] = $order->delivery['lastname'];
			$data['ship_to_street'] = $order->delivery['street_address'];
			$data['ship_to_street2'] = $order->delivery['suburb'];
			$data['ship_to_city'] = $order->delivery['city'];
			$data['ship_to_state'] = $order->delivery['state'];
			
			$countryCode = $order->delivery['country']['iso_code_2'];
			if($countryCode == 'FX') { // FX not recognized as a country code by PayPal
				$countryCode = 'FR';
			}
			$data['ship_to_country'] = $countryCode;				
			$data['ship_to_zip'] = $order->delivery['postcode'];
		}
		// set multi payment options
		$options = $this->get_available_options();
		$option = $options[$_POST['__vads_multi_option']];
		
		$first = (key_exists('first', $option) && $option['first'] != '') ? 
				$__vadsCurrency->convertAmountToInteger(($option['first'] / 100) * $total) :
				NULL;
		
		// override cb contract
		$data['contracts'] = $option['contract'] ? 'CB=' . $option['contract'] : null;
		
		$__vadsMultiApi->setFromArray($data);
		$__vadsMultiApi->setMultiPayment(NULL /* use already set amount */, $first, $option['count'], $option['period']);
		
		return $__vadsMultiApi->getRequestFieldsHtml();
	}

	/**
	 * Verify client data after he returned from payment gateway
	 */
	function before_process() {
		global $order, $__vadsMultiResponse, $messageStack;
		
		$__vadsMultiResponse = new __VadsResponse(
				$_REQUEST,
				MODULE_PAYMENT___VADS_MULTI_CTX_MODE,
				MODULE_PAYMENT___VADS_MULTI_KEY_TEST,
				MODULE_PAYMENT___VADS_MULTI_KEY_PROD
		);
		$fromServer = $__vadsMultiResponse->get('hash');
	
		// Check authenticity
		if(!$__vadsMultiResponse->isAuthentified()) {
			if($fromServer) {
				die($__vadsMultiResponse->getOutputForGateway('auth_fail'));
			} else {
				$messageStack->add_session('header', MODULE_PAYMENT___VADS_TECHNICAL_ERROR, 'error');				
				xtc_redirect(xtc_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL', true));
				die();
			}
		}
		
		// messages to display on payment result page
		if(MODULE_PAYMENT___VADS_MULTI_CTX_MODE == 'TEST') {
			$messageStack->add_session('header', MODULE_PAYMENT___VADS_GOING_INTO_PROD_INFO . '<a href="###PRODFAQ_URL###" target="_blank">###PRODFAQ_URL###</a>', 'success');
		}
		
		// act according to case
		if($__vadsMultiResponse->isAcceptedPayment()) {
			// successful payment
			if($this->_is_order_paid()) {
				if($fromServer) {
					die ($__vadsMultiResponse->getOutputForGateway('payment_ok_already_done'));
				} else {
					$this->_clear_session_vars();
					xtc_redirect(xtc_href_link(FILENAME_CHECKOUT_SUCCESS, '', 'SSL', true));
					die();
				}
			} else {
				// update order payment data
				$multiSettings = $__vadsMultiResponse->get('payment_config');
				$sub = substr($multiSettings, strpos($multiSettings,'count=')+strlen('count='),strlen($multiSettings));    	
				$nbCount = substr($sub,0,strpos($sub,';'));    
				$order->info['cc_type'] = $__vadsMultiResponse->get('card_brand').' - '.$nbCount.'x';
				$order->info['cc_number'] = $__vadsMultiResponse->get('card_number');
				$order->info['cc_expires'] = str_pad($__vadsMultiResponse->get('expiry_month'), 2, '0', STR_PAD_LEFT) . substr($__vadsMultiResponse->get('expiry_year'), 2);
		
				// let's borrow the cc_owner field to store transaction id
				$order->info['cc_owner'] = '-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Transaction: ' . $__vadsMultiResponse->get('trans_id');
				
				//update order status
				$order->info['order_status'] = MODULE_PAYMENT___VADS_MULTI_ORDER_STATUS;
				$orderStatusQuery = array('orders_id' => $__vadsMultiResponse->get('order_id'),
						'orders_status_id' => MODULE_PAYMENT___VADS_MULTI_ORDER_STATUS,
						'date_added' => 'now()',
						'customer_notified' => '0'
				);
				xtc_db_perform(TABLE_ORDERS_STATUS_HISTORY, $orderStatusQuery);
				
				// Let checkout_process.php finish the job
				return false;
			}
				
		} else {
			// payment process failed
			$order->info['order_status'] ='99';
			$orderStatusQuery = array('orders_id' => $__vadsMultiResponse->get('order_id'),
					'orders_status_id' => '99',
					'date_added' => 'now()',
					'customer_notified' => '0'
			);
			xtc_db_perform(TABLE_ORDERS_STATUS_HISTORY, $orderStatusQuery);
			
			if($fromServer) {
				die($__vadsMultiResponse->getOutputForGateway('payment_ko'));
			} else {
				$messageStack->add_session('header', MODULE_PAYMENT___VADS_PAYMENT_ERROR, 'error');
				xtc_redirect(xtc_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
				die();
			}
		}
	}

	/**
	 * Post-processing after the order has been finalised
	 */
	function after_process() {
		global $__vadsMultiResponse, $messageStack;
		
		// this function is called only when payment was successful and the order is not registered yet
		
		$fromServer = $__vadsMultiResponse->get('hash');
		
		// reset cart to allow new checkout process
		$_SESSION['cart']->reset(true);
		
		if($fromServer) {
			die ($__vadsMultiResponse->getOutputForGateway('payment_ok'));
		} else {
			$this->_clear_session_vars();
			
			// payment confirmed by client retun, show a warning if TEST mode
			if(MODULE_PAYMENT___VADS_MULTI_CTX_MODE == 'TEST') {
				xtc_output_warning(MODULE_PAYMENT___VADS_CHECK_URL_WARN . '<br />' . MODULE_PAYMENT___VADS_CHECK_URL_WARN_DETAIL);
			}
			
			xtc_redirect(xtc_href_link(FILENAME_CHECKOUT_SUCCESS, '', 'SSL'));
			require(DIR_WS_INCLUDES . 'application_bottom.php');
			die();
		}
	}
	
	// unregister session variables used during checkout
	function _clear_session_vars() {
		xtc_session_unregister('sendto');
		xtc_session_unregister('billto');
		xtc_session_unregister('shipping');
		xtc_session_unregister('payment');
		xtc_session_unregister('comments');
	}

	/**
	 * Return true / 1 if the module is installed
	 * @return unknown_type
	 */
	function check() {
		if (!isset($this->_check)) {
			$check_query = xtc_db_query("SELECT configuration_value FROM " . TABLE_CONFIGURATION .
										" WHERE configuration_key = 'MODULE_PAYMENT___VADS_MULTI_STATUS'");
			$this->_check = xtc_db_num_rows($check_query);
		}
		return $this->_check;
	}
	
	
	/**
	 * Build and execute a query for the install() function
	 * Parameters have to be escaped before
	 *
	 * @param string $title
	 * @param string $key
	 * @param string $value
	 * @param string $description
	 * @param string $group_id
	 * @param string $sort_order
	 * @param string $date_added
	 * @param string $set_function
	 * @param string $use_function
	 * @return
	 */
	function _install_query($key, $value, $group_id, $sort_order, $set_function=null, $use_function=null) {
		$prefix = 'MODULE_PAYMENT___VADS_';
		
		// Build query
		$query  = "";
		$query .= "INSERT INTO " . TABLE_CONFIGURATION . " ( configuration_key, configuration_value, configuration_group_id, sort_order, date_added";
		$query .= isset($set_function) ? ", set_function" : "";
		$query .= isset($use_function) ? ", use_function" : "";
		$query .= ") VALUES ('". $prefix . 'MULTI_' . $key . "'";
		$query .= ", '".$value."'";
		$query .= ", '".$group_id."'";
		$query .= ", '".$sort_order."'";
		$query .= ", NOW()";
		$query .= isset($set_function) ? ", '".$set_function."'" : "";
		$query .= isset($use_function) ? ", '".$use_function."'" : "";
		$query .= ");";
		// execute;
		xtc_db_query($query);
	}
	
	/**
	 * Module install (register admin-managed parameters in database)
	 */
	function install() {
		// Ex: _install_query($key, $value, $group_id, $sort_order, $set_function=null, $use_function=null)
		// Gambio specific parameters
		$this->_install_query('STATUS', '1', 6, 1, '__vads_cfg_draw_pull_down_bools(', '__vads_get_bool_title');
		$this->_install_query('SORT_ORDER', '0', 6, 2);
		$this->_install_query('ALLOWED', '', 6, 3 );
		$this->_install_query('ZONE', '0', 6, 4, 'xtc_cfg_pull_down_zone_classes(', 'xtc_get_zone_class_title');
		
		// gateway access parameters
		$this->_install_query('SITE_ID', '###SITE_ID###', 6, 10);
		$this->_install_query('KEY_TEST', '###KEY_TEST###', 6, 11);
		$this->_install_query('KEY_PROD', '###KEY_PROD###', 6, 12);
		$this->_install_query('CTX_MODE', 'TEST', 6, 13, "xtc_cfg_select_option(array(\'TEST\', \'PRODUCTION\'),");
		$this->_install_query('PLATFORM_URL', '###GATEWAY###', 6, 14);
		
		$this->_install_query('LANGUAGE', '###LANGUAGE###', 6, 21, '__vads_cfg_draw_pull_down_langs(', '__vads_get_lang_title');
		$this->_install_query('AVAILABLE_LANGUAGES', '', 6, 22, '__vads_cfg_draw_pull_down_multi_langs(', '__vads_get_multi_lang_title');
		$this->_install_query('CAPTURE_DELAY', '', 6, 23);
		$this->_install_query('VALIDATION_MODE', '', 6, 24, '__vads_cfg_draw_pull_down_validation_modes(', '__vads_get_validation_mode_title');
		$this->_install_query('PAYMENT_CARDS', '', 6, 25, '__vads_cfg_draw_pull_down_cards(', '__vads_get_card_title');
		$this->_install_query('3DS_MIN_AMOUNT', '', 6, 26);
		
		// amount restriction
		$this->_install_query('AMOUNT_MIN', '', 6, 30);
		$this->_install_query('AMOUNT_MAX', '', 6, 31);
			
		// Multi-payment parameters
		$this->_install_query('OPTIONS', '', 6, 40, '__vads_cfg_draw_table_multi_options(', '__vads_get_multi_options');
		
		// gateway return parameters
		$this->_install_query('REDIRECT_ENABLED', '0', 6, 50, '__vads_cfg_draw_pull_down_bools(', '__vads_get_bool_title');
		$this->_install_query('REDIRECT_SUCCESS_TIMEOUT', 5, 6, 51);
		$this->_install_query('REDIRECT_SUCCESS_MESSAGE', '###SUCCESS_MSG###', 6, 52);
		$this->_install_query('REDIRECT_ERROR_TIMEOUT', 5, 6, 53);
		$this->_install_query('REDIRECT_ERROR_MESSAGE', '###ERROR_MSG###', 6, 54);
		$this->_install_query('RETURN_MODE', 'GET', 6, 55, "xtc_cfg_select_option(array(\'GET\', \'POST\'), ");
		$this->_install_query('ORDER_STATUS', '0', 6, 56, 'xtc_cfg_pull_down_order_statuses(', 'xtc_get_order_status_name');
	}

	/**
	 * Module deletion
	 */
	function remove() {
		$keys = $this->keys();
		
		foreach($keys as $key) {
			xtc_db_query("DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = '$key'");
		}
	}

	/**
	 * Returns the names of module's parameters
	 * @return array[int]string
	 */
	function keys() {
		return array(
				'MODULE_PAYMENT___VADS_MULTI_STATUS', 
				'MODULE_PAYMENT___VADS_MULTI_SORT_ORDER',
				'MODULE_PAYMENT___VADS_MULTI_ALLOWED',
				'MODULE_PAYMENT___VADS_MULTI_ZONE',
			
				'MODULE_PAYMENT___VADS_MULTI_SITE_ID',
				'MODULE_PAYMENT___VADS_MULTI_KEY_TEST', 
				'MODULE_PAYMENT___VADS_MULTI_KEY_PROD',
				'MODULE_PAYMENT___VADS_MULTI_CTX_MODE', 
				'MODULE_PAYMENT___VADS_MULTI_PLATFORM_URL',
			
				'MODULE_PAYMENT___VADS_MULTI_LANGUAGE',
				'MODULE_PAYMENT___VADS_MULTI_AVAILABLE_LANGUAGES',
				'MODULE_PAYMENT___VADS_MULTI_CAPTURE_DELAY',
				'MODULE_PAYMENT___VADS_MULTI_VALIDATION_MODE',
				'MODULE_PAYMENT___VADS_MULTI_PAYMENT_CARDS',
				'MODULE_PAYMENT___VADS_MULTI_3DS_MIN_AMOUNT',
				
				'MODULE_PAYMENT___VADS_MULTI_AMOUNT_MIN',
				'MODULE_PAYMENT___VADS_MULTI_AMOUNT_MAX',
				
				'MODULE_PAYMENT___VADS_MULTI_OPTIONS',
				
				'MODULE_PAYMENT___VADS_MULTI_REDIRECT_ENABLED',
				'MODULE_PAYMENT___VADS_MULTI_REDIRECT_SUCCESS_TIMEOUT',
				'MODULE_PAYMENT___VADS_MULTI_REDIRECT_SUCCESS_MESSAGE',
				'MODULE_PAYMENT___VADS_MULTI_REDIRECT_ERROR_TIMEOUT',
				'MODULE_PAYMENT___VADS_MULTI_REDIRECT_ERROR_MESSAGE',
				'MODULE_PAYMENT___VADS_MULTI_RETURN_MODE',
				'MODULE_PAYMENT___VADS_MULTI_ORDER_STATUS'
		);
	}

	/**
	 * Try to guess what will be the order's id when Gambio will register it at the end of the payment process.
	 * This is only used to set order_id in the request to the payment gateway. It might be inconsistent with the
	 * final Gambio order id (in cases like two clients going to the payment gateway at the same time...)
	 * 
	 * @return int
	 */
	function _guess_order_id(){
		$sql = "SELECT MAX(orders_id) FROM " . TABLE_ORDERS;

		$res = xtc_db_query($sql);

		if(xtc_db_num_rows($res) == 0) {
			return 0;
		} else {
			return mysql_result($res, 0, 0) + 1;
		}
	}
	
	/**
	 * Test if order corresponding to entered trans_id is already saved.
	 *
	 * @return boolean true if order already saved
	 */
	function _is_order_paid() {
		global $__vadsMultiResponse;
		
		$orderId = $__vadsMultiResponse->get('order_id');
		$customerId = $__vadsMultiResponse->get('cust_id');
		$transId = $__vadsMultiResponse->get('trans_id');
		
		$query = xtc_db_query("SELECT * FROM " . TABLE_ORDERS .
				" WHERE orders_id >= $orderId" .
				" AND customers_id = $customerId" .
				" AND cc_owner LIKE '%Transaction: " . $transId . "'");
		
		return xtc_db_num_rows($query) > 0;
	}
}
?>