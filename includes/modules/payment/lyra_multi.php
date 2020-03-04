<?php
/**
 * Copyright © Lyra Network.
 * This file is part of Lyra plugin for Gambio. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL v2)
 */

require_once (DIR_FS_CATALOG . 'includes/classes/lyra_tools.php');

if (lyra_tools::$lyra_plugin_features['multi']) {
    // Include Lyra Collect API class.
    require_once(DIR_FS_CATALOG . 'inc/xtc_output_warning.inc.php');
    require_once (DIR_FS_CATALOG . 'includes/classes/lyra_api.php');
    require_once (DIR_FS_CATALOG . 'includes/classes/lyra_request.php');
    require_once (DIR_FS_CATALOG . 'includes/classes/lyra_response.php');

    // Include the admin configuration functions.
    include_once (DIR_FS_CATALOG . 'admin/includes/functions/lyra_output.php');

    // Load module language file.
    $language = $_SESSION['language'];
    include_once(DIR_FS_CATALOG . "lang/$language/modules/payment/lyra_multi.php");

    /**
     * Main class implementing Lyra Collect multiple payment module for OSC.
     */
    class lyra_multi {
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
        function lyra_multi()
        {
            global $order;

            // Initialize code.
            $this->code = 'lyra_multi';

            // Initialize title.
            $this->title = MODULE_PAYMENT_LYRA_MULTI_TEXT_TITLE;

            // Initialize description.
            $this->description  = lyra_tools::$lyra_plugin_features['restrictmulti'] ?
                        '<p style="background-color: #FFFFE0; border: 1px solid #E6DB55; font-size: 13px;  margin: 0 0 20px; padding: 10px;">' .
                                MODULE_PAYMENT_LYRA_MULTI_WARNING . '</p>'
                        : '';
            $this->description .= '<b>' . MODULE_PAYMENT_LYRA_MODULE_INFORMATION . '</b>';
            $this->description .= '<br/><br/>';

            $this->description .= '<table class="infoBoxContent">';
            $this->description .= '<tr><td style="text-align: right;">' . MODULE_PAYMENT_LYRA_DEVELOPED_BY . ' : </td><td><a href="https://www.lyra.com/" target="_blank"><b>Lyra Network</b></a></td></tr>';
            $this->description .= '<tr><td style="text-align: right;">' . MODULE_PAYMENT_LYRA_CONTACT_EMAIL . ' : </td><td><a href="mailto:' . lyra_tools::getDefault('SUPPORT_EMAIL') . '"><b>' . lyra_tools::getDefault('SUPPORT_EMAIL') . '</b></a></td></tr>';
            $this->description .= '<tr><td style="text-align: right;">' . MODULE_PAYMENT_LYRA_PLUGIN_VERSION . ' : </td><td><b>' . lyra_tools::getDefault('PLUGIN_VERSION') . '</b></td></tr>';
            $this->description .= '<tr><td style="text-align: right;">' . MODULE_PAYMENT_LYRA_GATEWAY_VERSION . ' : </td><td><b>' . lyra_tools::getDefault('GATEWAY_VERSION') . '</b></td></tr>';
            $this->description .= '</table>';

            $this->description .= '<br/>';
            $this->description .= MODULE_PAYMENT_LYRA_CHECK_URL . '<b>' . HTTP_SERVER . DIR_WS_CATALOG . 'checkout_process_lyra.php</b>';
            $this->description .= '<hr />';

            // Initialize enabled.
            $this->enabled = defined('MODULE_PAYMENT_LYRA_MULTI_STATUS') && MODULE_PAYMENT_LYRA_MULTI_STATUS === 'True';

            // Initialize sort_order.
            defined('MODULE_PAYMENT_LYRA_MULTI_SORT_ORDER') ? $this->sort_order = MODULE_PAYMENT_LYRA_MULTI_SORT_ORDER : $this->sort_order = '';

            defined('MODULE_PAYMENT_LYRA_MULTI_PLATFORM_URL') ? $this->form_action_url = MODULE_PAYMENT_LYRA_MULTI_PLATFORM_URL : $this->form_action_url = '';

            if (defined('MODULE_PAYMENT_LYRA_MULTI_ORDER_STATUS') && (int)MODULE_PAYMENT_LYRA_MULTI_ORDER_STATUS > 0) {
                $this->order_status = MODULE_PAYMENT_LYRA_MULTI_ORDER_STATUS;
            }

            // If there's an order to treat, start preliminary payment zone check.
            if (is_object($order)) {
                $this->update_status();
            }
        }

        /**
         * Payment zone and amount restriction checks
         */
        function update_status()
        {
            global $order;

            if (!$this->enabled) {
                return;
            }

            // Check customer zone.
            if ((int)MODULE_PAYMENT_LYRA_MULTI_ZONE > 0) {
                $flag = false;
                $check_query = xtc_db_query("SELECT zone_id FROM " . TABLE_ZONES_TO_GEO_ZONES .
                    " WHERE geo_zone_id = '" . MODULE_PAYMENT_LYRA_MULTI_ZONE .
                    "' AND zone_country_id = '" . $order->billing['country']['id'] .
                    "' ORDER BY zone_id ASC;");
                while ($check = xtc_db_fetch_array($check_query)) {
                    if (($check['zone_id'] < 1) || ($check['zone_id'] === $order->billing['zone_id'])) {
                        $flag = true;
                        break;
                    }
                }

                if (!$flag) {
                    $this->enabled = false;
                }
            }

            // Check amount restrictions.
            if ((MODULE_PAYMENT_LYRA_MULTI_AMOUNT_MIN !== '' && $order->info['total'] < MODULE_PAYMENT_LYRA_MULTI_AMOUNT_MIN)
                || (MODULE_PAYMENT_LYRA_MULTI_AMOUNT_MAX !== '' && $order->info['total'] > MODULE_PAYMENT_LYRA_MULTI_AMOUNT_MAX)) {
                    $this->enabled = false;
                }

                // Check currency.
                $defaultCurrency = (defined('USE_DEFAULT_LANGUAGE_CURRENCY') && USE_DEFAULT_LANGUAGE_CURRENCY === 'true') ? LANGUAGE_CURRENCY : DEFAULT_CURRENCY;
                if (!LyraApi::findCurrencyByAlphaCode($order->info['currency']) && !LyraApi::findCurrencyByAlphaCode($defaultCurrency)) {
                    // Currency is not supported, module is not available.
                    $this->enabled = false;
                }

                // Check multi payment options.
                $options = $this->get_available_options();
                if (count($options) <= 0) {
                    $this->enabled = false;
                }
        }

        function get_available_options()
        {
            global $order;

            $amount = $order->info['total'];

            $options = MODULE_PAYMENT_LYRA_MULTI_OPTIONS ?
                            json_decode(stripslashes(MODULE_PAYMENT_LYRA_MULTI_OPTIONS), true) :
                            array();

            $availOptions = array();
            if (is_array($options) && count($options) > 0) {
                foreach ($options as $code => $option) {
                    if (empty($option)) {
                        continue;
                    }

                    if ((!$option['min_amount'] || $amount >= $option['min_amount'])
                        && (!$option['max_amount'] || $amount <= $option['max_amount'])) {
                            // Option will be available.
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
        function javascript_validation()
        {
            return false;
        }

        /**
         * Parameters for what the payment option will look like in the list
         * @return array
         */
        function selection()
        {
            $this->update_status();
            if (!$this->enabled) {
                return null;
            }

            $selection = array(
                'id' => $this->code,
                'module' => MODULE_PAYMENT_LYRA_MULTI_SHORT_TITLE,
                'logo_url' => xtc_href_link('images/lyra_multi.png', '', 'SSL', false, false, false, true, true)
            );


            $selection['fields'][] = array(
                'title' => '<b style="display:none"></b>',
                'field' => xtc_draw_radio_field('lyra_multi_hidden', '', false, 'style="display:none"'),
            );

            $first = true;
            foreach ($this->get_available_options() as $code => $option) {
                $styleTitle = $first ? ' style="display: block; margin-top: -30px;"' : '';
                $styleRadio = $first ? 'style="margin-top: -19px;"' : 'style="margin-top: 10px;"';
                $selection['fields'][] = array(
                    'title' => "<b$styleTitle>" . $option['label'] . "</b>",
                    'field' => xtc_draw_radio_field('lyra_multi_option', $code, $first, $styleRadio),
                );

                $first = false;
            }

            return $selection;
        }

        /**
         * Server-side checks after payment selection : We let the platform do all the validation itself
         * @return false
         */
        function pre_confirmation_check()
        {
            return false;
        }

        /**
         * Server-size checks before payment confirmation :  We let the platform do all the validation itself
         * @return false
         */
        function confirmation()
        {
            return false;
        }

        /**
         * Prepare the form that will be sent to the payment gateway
         * @return string
         */
        function process_button()
        {
            global $order, $xtPrice ;

            // Load Lyra Collect payment API.
            $lyraMultiRequest = new LyraRequest();

            // Admin configuration parameters.
            $configParams = array(
                'site_id', 'key_test', 'key_prod', 'ctx_mode','sign_algo', 'platform_url', 'available_languages',
                'capture_delay', 'validation_mode', 'payment_cards', 'redirect_success_timeout',
                'redirect_success_message', 'redirect_error_timeout', 'redirect_error_message', 'return_mode'
            );

            foreach ($configParams as $name) {
                $lyraMultiRequest->set($name, constant('MODULE_PAYMENT_LYRA_MULTI_' . strtoupper($name)));
            }

            // Set redirection auto.
            $lyraMultiRequest->set('redirect_enabled', constant('MODULE_PAYMENT_LYRA_MULTI_' . strtoupper('redirect_enabled')) === 'True'? 1 : 0);

            // Get the shop language code.
            $query = xtc_db_query("SELECT code FROM " . TABLE_LANGUAGES . " WHERE languages_id = " . $_SESSION['languages_id']);
            $langData = xtc_db_fetch_array($query);
            $lyraLanguage = LyraApi::isSupportedLanguage($langData['code']) ?
            strtolower($langData['code']) :
            MODULE_PAYMENT_LYRA_MULTI_LANGUAGE;

            // Get the currency to use.
            $currencyValue = $order->info['currency_value'];
            $lyraCurrency = LyraApi::findCurrencyByAlphaCode($order->info['currency']);
            if (!$lyraCurrency) {
                // Currency is not supported, use the default shop currency.
                $defaultCurrency = (defined('USE_DEFAULT_LANGUAGE_CURRENCY') && USE_DEFAULT_LANGUAGE_CURRENCY === 'true') ?
                LANGUAGE_CURRENCY : DEFAULT_CURRENCY;

                $lyraCurrency = LyraApi::findCurrencyByAlphaCode($defaultCurrency);
                $currencyValue = 1;
            }

            // Calculate amount ...
            $total = round($order->info['total'] * $currencyValue, $xtPrice->get_decimal_places($lyraCurrency->getAlpha3()));

            // Activate 3ds ?.
            $threedsMpi = null;
            if (MODULE_PAYMENT_LYRA_MULTI_3DS_MIN_AMOUNT !== '' && $order->info['total'] < MODULE_PAYMENT_LYRA_MULTI_3DS_MIN_AMOUNT) {
                $threedsMpi = '2';
            }

            // Other parameters.
            $version = '';
            $coo_versioninfo = MainFactory::create_object('VersionInfo');
            foreach ($coo_versioninfo->get_shop_versioninfo() as $key => $value) {
                $version = $key;
            }

            $data = array(
                // Order info.
                'amount' => $lyraCurrency->convertAmountToInteger($total),
                'order_id' => $this->_guess_order_id(),
                'contrib' => lyra_tools::getDefault('CMS_IDENTIFIER') . '_' . lyra_tools::getDefault('PLUGIN_VERSION') . '/' . $version . '/' . PHP_VERSION,
                'order_info' => 'session_id=' . session_id() . '&use_cookies=' . ini_get('session.use_cookies') . '&session_cache_limiter=' . session_cache_limiter(),

                // Misc data.
                'currency' => $lyraCurrency->getNum(),
                'language' => $lyraLanguage,
                'threeds_mpi' => $threedsMpi,
                'url_return' => xtc_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL'),

                // Customer info.
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

            // Delivery data.
            if ($order->delivery !== false) {
                $data['ship_to_first_name'] = $order->delivery['firstname'];
                $data['ship_to_last_name'] = $order->delivery['lastname'];
                $data['ship_to_street'] = $order->delivery['street_address'];
                $data['ship_to_street2'] = $order->delivery['suburb'];
                $data['ship_to_city'] = $order->delivery['city'];
                $data['ship_to_state'] = $order->delivery['state'];

                $countryCode = $order->delivery['country']['iso_code_2'];
                if ($countryCode === 'FX') { // FX not recognized as a country code by PayPal.
                    $countryCode = 'FR';
                }

                $data['ship_to_country'] = $countryCode;
                $data['ship_to_zip'] = $order->delivery['postcode'];
            }

            // Set multi payment options.
            $options = $this->get_available_options();
            $option = is_array($options[$_POST['lyra_multi_option']]) ? $options[$_POST['lyra_multi_option']] : array() ;

            $first = (key_exists('first', $option) && $option['first'] !== '') ?
            $lyraCurrency->convertAmountToInteger(($option['first'] / 100) * $total) :
            NULL;

            // Override cb contract.
            $data['contracts'] = $option['contract'] ? 'CB=' . $option['contract'] : null;

            $lyraMultiRequest->setFromArray($data);
            $lyraMultiRequest->setMultiPayment(NULL /* use already set amount */, $first, $option['count'], $option['period']);

            return $lyraMultiRequest->getRequestHtmlFields();
        }

        /**
         * Verify client data after he returned from payment gateway
         */
        function before_process()
        {
            global $order, $lyraMultiResponse, $messageStack, $fromServer;

            $data = !$fromServer && MODULE_PAYMENT_LYRA_MULTI_RETURN_MODE === 'GET' ? $_GET : $_POST;
            $lyraMultiResponse = new LyraResponse(
                $data,
                MODULE_PAYMENT_LYRA_MULTI_CTX_MODE,
                MODULE_PAYMENT_LYRA_MULTI_KEY_TEST,
                MODULE_PAYMENT_LYRA_MULTI_KEY_PROD,
                MODULE_PAYMENT_LYRA_MULTI_SIGN_ALGO
            );

            // Check authenticity.
            if (!$lyraMultiResponse->isAuthentified()) {
                if ($fromServer) {
                    die($lyraMultiResponse->getOutputForGateway('auth_fail'));
                } else {
                    $_SESSION[$this->code . '_error'] = MODULE_PAYMENT_LYRA_TECHNICAL_ERROR;
                    xtc_redirect(xtc_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_error=' . $this->code, 'SSL', true));
                    die();
                }
            }

            // Messages to display on payment result page.
            if (lyra_tools::$lyra_plugin_features['prodfaq'] && MODULE_PAYMENT_LYRA_MULTI_CTX_MODE === 'TEST') {
                $messageStack->add_session('header', MODULE_PAYMENT_LYRA_GOING_INTO_PROD_INFO . '<a href="###PRODFAQ_URL###" target="_blank">###PRODFAQ_URL###</a>', 'success');
            }

            // Act according to case.
            if ($lyraMultiResponse->isAcceptedPayment()) {
                // Successful payment.
                if ($this->_is_order_paid()) {
                    if ($fromServer) {
                        die ($lyraMultiResponse->getOutputForGateway('payment_ok_already_done'));
                    } else {
                        $this->_clear_session_vars();
                        xtc_redirect(xtc_href_link(FILENAME_CHECKOUT_SUCCESS, '', 'SSL', true));
                        die();
                    }
                } else {
                    // Update order payment data.
                    $multiSettings = $lyraMultiResponse->get('payment_config');
                    $sub = substr($multiSettings, strpos($multiSettings,'count=')+strlen('count='),strlen($multiSettings));
                    $nbCount = substr($sub,0,strpos($sub,';'));
                    $order->info['cc_type'] = $lyraMultiResponse->get('card_brand') . ' - ' . $nbCount . 'x';
                    $order->info['cc_number'] = $lyraMultiResponse->get('card_number');
                    $order->info['cc_expires'] = str_pad($lyraMultiResponse->get('expiry_month'), 2, '0', STR_PAD_LEFT) . substr($lyraMultiResponse->get('expiry_year'), 2);

                    // Let's borrow the cc_owner field to store transaction id.
                    $order->info['cc_owner'] = '-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Transaction: ' . $lyraMultiResponse->get('trans_id');

                    // Update order status
                    $order->info['order_status'] = MODULE_PAYMENT_LYRA_MULTI_ORDER_STATUS;
                    $orderStatusQuery = array('orders_id' => $lyraMultiResponse->get('order_id'),
                        'orders_status_id' => MODULE_PAYMENT_LYRA_MULTI_ORDER_STATUS,
                        'date_added' => 'now()',
                        'customer_notified' => '0'
                    );
                    xtc_db_perform(TABLE_ORDERS_STATUS_HISTORY, $orderStatusQuery);

                    // Let checkout_process.php finish the job.
                    return false;
                }

            } else {
                // Payment process failed.
                $order->info['order_status'] ='99';
                $orderStatusQuery = array('orders_id' => $lyraMultiResponse->get('order_id'),
                    'orders_status_id' => '99',
                    'date_added' => 'now()',
                    'customer_notified' => '0'
                );
                xtc_db_perform(TABLE_ORDERS_STATUS_HISTORY, $orderStatusQuery);

                if ($fromServer) {
                    die($lyraMultiResponse->getOutputForGateway('payment_ko'));
                } else {
                    $_SESSION[$this->code . '_error'] = MODULE_PAYMENT_LYRA_PAYMENT_ERROR;
                    xtc_redirect(xtc_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_error=' . $this->code, 'SSL'));
                    die();
                }
            }
        }

        function get_error()
        {
            $error = false;
            if (isset($_SESSION[$this->code . '_error'])) {
                $error = array(
                    'error' => $_SESSION[$this->code . '_error']
                );
                unset($_SESSION[$this->code . '_error']);
            }

            return $error;
        }

        /**
         * Post-processing after the order has been finalised
         */
        function after_process()
        {
            global $lyraMultiResponse, $fromServer;

            // This function is called only when payment was successful and the order is not registered yet.

            // Reset cart to allow new checkout process.
            $_SESSION['cart']->reset(true);

            if ($fromServer) {
                die ($lyraMultiResponse->getOutputForGateway('payment_ok'));
            } else {
                $this->_clear_session_vars();

                // Payment confirmed by client retun, show a warning if TEST mode.
                if (MODULE_PAYMENT_LYRA_MULTI_CTX_MODE === 'TEST') {
                    xtc_output_warning(MODULE_PAYMENT_LYRA_CHECK_URL_WARN . '<br />' . MODULE_PAYMENT_LYRA_CHECK_URL_WARN_DETAIL);
                }

                xtc_redirect(xtc_href_link(FILENAME_CHECKOUT_SUCCESS, '', 'SSL'));
                require(DIR_WS_INCLUDES . 'application_bottom.php');
                die();
            }
        }

        // Unregister session variables used during checkout.
        function _clear_session_vars()
        {
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
        function check()
        {
            if (!isset($this->_check)) {
                $check_query = xtc_db_query("SELECT configuration_value FROM " . TABLE_CONFIGURATION .
                    " WHERE configuration_key = 'MODULE_PAYMENT_LYRA_MULTI_STATUS'");
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
        function _install_query($key, $value, $group_id, $sort_order, $set_function = null, $use_function = null)
        {
            $prefix = 'MODULE_PAYMENT_LYRA_';

            // Build query.
            $query  = "";
            $query .= "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added";
            $query .= isset($set_function) ? ", set_function" : "";
            $query .= isset($use_function) ? ", use_function" : "";
            $query .= ") VALUES ('" . $prefix . 'MULTI_' . $key . "'";
            $query .= ", '" . $value . "'";
            $query .= ", '" . $group_id . "'";
            $query .= ", '" . $sort_order . "'";
            $query .= ", NOW()";
            $query .= isset($set_function) ? ", '" . $set_function . "'" : "";
            $query .= isset($use_function) ? ", '" . $use_function . "'" : "";
            $query .= ");";
            // Execute.
            xtc_db_query($query);
        }

        /**
         * Module install (register admin-managed parameters in database)
         */
        function install()
        {
            // Ex: _install_query($key, $value, $group_id, $sort_order, $set_function = null, $use_function = null).
            // Gambio specific parameters.
            $this->_install_query('STATUS', 'True', 6, 1, "gm_cfg_select_option(array(\'True\', \'False\'), ", 'lyra_get_bool_title');
            $this->_install_query('SORT_ORDER', '0', 6, 2);
            $this->_install_query('ALLOWED', '', 6, 3);
            $this->_install_query('ZONE', '0', 6, 4, 'xtc_cfg_pull_down_zone_classes(', 'xtc_get_zone_class_title');

            // Gateway access parameters.
            $this->_install_query('SITE_ID', lyra_tools::getDefault('SITE_ID'), 6, 10);

            $function = "xtc_cfg_select_option(array(\'PRODUCTION\'),";
            if (! lyra_tools::$lyra_plugin_features['qualif']) {
                $function = "xtc_cfg_select_option(array(\'TEST\', \'PRODUCTION\'),";
                $this->_install_query('KEY_TEST', lyra_tools::getDefault('KEY_TEST'), 6, 11);
            }


            $this->_install_query('KEY_PROD', lyra_tools::getDefault('KEY_PROD'), 6, 12);
            $this->_install_query('CTX_MODE', lyra_tools::getDefault('CTX_MODE'), 6, 13, $function);
            $this->_install_query('SIGN_ALGO', lyra_tools::getDefault('SIGN_ALGO'),6, 14, 'lyra_cfg_draw_pull_down_sign_algos(', 'lyra_get_sign_algo_title');
            $this->_install_query('PLATFORM_URL', lyra_tools::getDefault('GATEWAY_URL'), 6, 15);

            $this->_install_query('LANGUAGE', lyra_tools::getDefault('LANGUAGE'), 6, 21, 'lyra_cfg_draw_pull_down_langs(', 'lyra_get_lang_title');
            $this->_install_query('AVAILABLE_LANGUAGES', '', 6, 22, 'lyra_cfg_draw_pull_down_multi_langs(', 'lyra_get_multi_lang_title');
            $this->_install_query('CAPTURE_DELAY', '', 6, 23);
            $this->_install_query('VALIDATION_MODE', '', 6, 24, 'lyra_cfg_draw_pull_down_validation_modes(', 'lyra_get_validation_mode_title');
            $this->_install_query('PAYMENT_CARDS', '', 6, 25, 'lyra_cfg_draw_pull_down_cards(', 'lyra_get_card_title');
            $this->_install_query('3DS_MIN_AMOUNT', '', 6, 26);

            // Amount restriction.
            $this->_install_query('AMOUNT_MIN', '', 6, 30);
            $this->_install_query('AMOUNT_MAX', '', 6, 31);

            // Multi-payment parameters.
            $this->_install_query('OPTIONS', '', 6, 40, 'lyra_cfg_draw_table_multi_options(', 'lyra_get_multi_options');

            // Gateway return parameters.
            $this->_install_query('REDIRECT_ENABLED', 'False', 6, 50, "gm_cfg_select_option(array(\'True\', \'False\'), ", 'lyra_get_bool_title');
            $this->_install_query('REDIRECT_SUCCESS_TIMEOUT', 5, 6, 51);
            $this->_install_query('REDIRECT_SUCCESS_MESSAGE', 'Redirection to shop in a few seconds...', 6, 52);
            $this->_install_query('REDIRECT_ERROR_TIMEOUT', 5, 6, 53);
            $this->_install_query('REDIRECT_ERROR_MESSAGE', 'Redirection to shop in a few seconds...', 6, 54);
            $this->_install_query('RETURN_MODE', 'GET', 6, 55, "xtc_cfg_select_option(array(\'GET\', \'POST\'), ");
            $this->_install_query('ORDER_STATUS', '0', 6, 56, 'xtc_cfg_pull_down_order_statuses(', 'xtc_get_order_status_name');
        }

        /**
         * Module deletion
         */
        function remove()
        {
            $keys = $this->keys();

            foreach ($keys as $key) {
                xtc_db_query("DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = '$key'");
            }
        }

        /**
         * Returns the names of module's parameters
         * @return array[int]string
         */
        function keys()
        {
            $keys = array();
            $keys[] = 'MODULE_PAYMENT_LYRA_MULTI_STATUS';
            $keys[] = 'MODULE_PAYMENT_LYRA_MULTI_SORT_ORDER';
            $keys[] = 'MODULE_PAYMENT_LYRA_MULTI_ALLOWED';
            $keys[] = 'MODULE_PAYMENT_LYRA_MULTI_ZONE';

            $keys[] = 'MODULE_PAYMENT_LYRA_MULTI_SITE_ID';

            if (! lyra_tools::$lyra_plugin_features['qualif']) {
                $keys[] = 'MODULE_PAYMENT_LYRA_MULTI_KEY_TEST';
            }

            $keys[] = 'MODULE_PAYMENT_LYRA_MULTI_KEY_PROD';
            $keys[] = 'MODULE_PAYMENT_LYRA_MULTI_CTX_MODE';
            $keys[] = 'MODULE_PAYMENT_LYRA_MULTI_SIGN_ALGO';
            $keys[] = 'MODULE_PAYMENT_LYRA_MULTI_PLATFORM_URL';

            $keys[] = 'MODULE_PAYMENT_LYRA_MULTI_LANGUAGE';
            $keys[] = 'MODULE_PAYMENT_LYRA_MULTI_AVAILABLE_LANGUAGES';
            $keys[] = 'MODULE_PAYMENT_LYRA_MULTI_CAPTURE_DELAY';
            $keys[] = 'MODULE_PAYMENT_LYRA_MULTI_VALIDATION_MODE';
            $keys[] = 'MODULE_PAYMENT_LYRA_MULTI_PAYMENT_CARDS';
            $keys[] = 'MODULE_PAYMENT_LYRA_MULTI_3DS_MIN_AMOUNT';

            $keys[] = 'MODULE_PAYMENT_LYRA_MULTI_AMOUNT_MIN';
            $keys[] = 'MODULE_PAYMENT_LYRA_MULTI_AMOUNT_MAX';

            $keys[] = 'MODULE_PAYMENT_LYRA_MULTI_OPTIONS';

            $keys[] = 'MODULE_PAYMENT_LYRA_MULTI_REDIRECT_ENABLED';
            $keys[] = 'MODULE_PAYMENT_LYRA_MULTI_REDIRECT_SUCCESS_TIMEOUT';
            $keys[] = 'MODULE_PAYMENT_LYRA_MULTI_REDIRECT_SUCCESS_MESSAGE';
            $keys[] = 'MODULE_PAYMENT_LYRA_MULTI_REDIRECT_ERROR_TIMEOUT';
            $keys[] = 'MODULE_PAYMENT_LYRA_MULTI_REDIRECT_ERROR_MESSAGE';
            $keys[] = 'MODULE_PAYMENT_LYRA_MULTI_RETURN_MODE';
            $keys[] = 'MODULE_PAYMENT_LYRA_MULTI_ORDER_STATUS';

            return $keys;
        }

        /**
         * Try to guess what will be the order's id when Gambio will register it at the end of the payment process.
         * This is only used to set order_id in the request to the payment gateway. It might be inconsistent with the
         * final Gambio order id (in cases like two clients going to the payment gateway at the same time...)
         *
         * @return int
         */
        function _guess_order_id()
        {
            $order_query = xtc_db_query("SELECT MAX(orders_id) FROM " . TABLE_ORDERS);
            $order_data = xtc_db_fetch_array($order_query);
            $order_id = reset($order_data);

            return $order_id? $order_id : 0;
        }

        /**
         * Test if order corresponding to entered trans_id is already saved.
         *
         * @return boolean true if order already saved
         */
        function _is_order_paid()
        {
            global $lyraMultiResponse;

            $orderId = $lyraMultiResponse->get('order_id');
            $customerId = $lyraMultiResponse->get('cust_id');
            $transId = $lyraMultiResponse->get('trans_id');

            $query = xtc_db_query("SELECT * FROM " . TABLE_ORDERS .
                " WHERE orders_id >= $orderId" .
                " AND customers_id = $customerId" .
                " AND cc_owner LIKE '%Transaction: " . $transId . "'");

            return xtc_db_num_rows($query) > 0;
        }
    }
}
