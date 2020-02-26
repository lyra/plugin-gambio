<?php
/**
 * Copyright © Lyra Network.
 * This file is part of Lyra plugin for Gambio. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL v2)
 */

include_once 'lyra_common.php';

## CATALOG MESSAGES ##
define('MODULE_PAYMENT_LYRA_MULTI_TEXT_TITLE', "Lyra Collect - Payment in installments");
//define('MODULE_PAYMENT_LYRA_MULTI_SHORT_TITLE', "Lyra Collect - Payment in several times");

## ADMINISTRATION INTERFACE - MODULE SETTINGS ##
define('MODULE_PAYMENT_LYRA_MULTI_STATUS_TITLE', "Module status");
define('MODULE_PAYMENT_LYRA_MULTI_STATUS_DESC', "Enables / disables this payment method.");
define('MODULE_PAYMENT_LYRA_MULTI_SORT_ORDER_TITLE', "Display order");
define('MODULE_PAYMENT_LYRA_MULTI_SORT_ORDER_DESC', "Display order. The smaller appears first.");
define('MODULE_PAYMENT_LYRA_MULTI_ZONE_TITLE', "Payment area");
define('MODULE_PAYMENT_LYRA_MULTI_ZONE_DESC', "If an area is selected, this payment mode will only be available for it.");
define('MODULE_PAYMENT_LYRA_MULTI_ALLOWED_TITLE', "Allowed zones");
define('MODULE_PAYMENT_LYRA_MULTI_ALLOWED_DESC', "Please Enter each Zone for which this module should be enabled (e.g. \"UK,DE\"). If left empty, all zones are allowed.");

## ADMINISTRATION INTERFACE - PLATFORM SETTINGS ##
define('MODULE_PAYMENT_LYRA_MULTI_SITE_ID_TITLE', "Shop ID");
define('MODULE_PAYMENT_LYRA_MULTI_SITE_ID_DESC', "The identifier provided by Lyra Collect.");
define('MODULE_PAYMENT_LYRA_MULTI_KEY_TEST_TITLE', "Key in test mode");
define('MODULE_PAYMENT_LYRA_MULTI_KEY_TEST_DESC', "Key provided by Lyra Collect for test mode (available in Lyra Expert Back Office).");
define('MODULE_PAYMENT_LYRA_MULTI_KEY_PROD_TITLE', "Key in production mode");
define('MODULE_PAYMENT_LYRA_MULTI_KEY_PROD_DESC', "Key provided by Lyra Collect (available in Lyra Expert Back Office after enabling production mode).");
define('MODULE_PAYMENT_LYRA_MULTI_CTX_MODE_TITLE', "Mode");
define('MODULE_PAYMENT_LYRA_MULTI_CTX_MODE_DESC', "The context mode of this module.");
define('MODULE_PAYMENT_LYRA_MULTI_SIGN_ALGO_TITLE', "Signature algorithm");
define('MODULE_PAYMENT_LYRA_MULTI_SIGN_ALGO_DESC', "Algorithm used to compute the payment form signature. Selected algorithm must be the same as one configured in the Lyra Expert Back Office.");
define('MODULE_PAYMENT_LYRA_MULTI_PLATFORM_URL_TITLE', "Payment page URL");
define('MODULE_PAYMENT_LYRA_MULTI_PLATFORM_URL_DESC', "Link to the payment page.");

## ADMINISTRATION INTERFACE - PAYMENT SETTINGS ##
define('MODULE_PAYMENT_LYRA_MULTI_LANGUAGE_TITLE', "Default language");
define('MODULE_PAYMENT_LYRA_MULTI_LANGUAGE_DESC', "Default language on the payment page.");
define('MODULE_PAYMENT_LYRA_MULTI_AVAILABLE_LANGUAGES_TITLE', "Available languages");
define('MODULE_PAYMENT_LYRA_MULTI_AVAILABLE_LANGUAGES_DESC', "Languages available on the payment page. If you do not select any, all the supported languages will be available.");
define('MODULE_PAYMENT_LYRA_MULTI_CAPTURE_DELAY_TITLE', "Capture delay");
define('MODULE_PAYMENT_LYRA_MULTI_CAPTURE_DELAY_DESC', "The number of days before the bank capture (adjustable in your Lyra Expert Back Office).");
define('MODULE_PAYMENT_LYRA_MULTI_VALIDATION_MODE_TITLE', "Validation mode");
define('MODULE_PAYMENT_LYRA_MULTI_VALIDATION_MODE_DESC', "If manual is selected, you will have to confirm payments manually in your Lyra Expert Back Office.");
define('MODULE_PAYMENT_LYRA_MULTI_PAYMENT_CARDS_TITLE', "Card Types");
define('MODULE_PAYMENT_LYRA_MULTI_PAYMENT_CARDS_DESC', "The card type(s) that can be used for the payment. Select none to use gateway configuration.");
define('MODULE_PAYMENT_LYRA_MULTI_3DS_MIN_AMOUNT_TITLE', "Disable 3DS");
define('MODULE_PAYMENT_LYRA_MULTI_3DS_MIN_AMOUNT_DESC', "Amount below which 3DS will be disabled. Needs subscription to selective 3DS option. For more information, refer to the module documentation.");

## ADMINISTRATION INTERFACE - AMOUNT RESTRICTIONS SETTINGS ##
define('MODULE_PAYMENT_LYRA_MULTI_AMOUNT_MIN_TITLE', "Minimum amount");
define('MODULE_PAYMENT_LYRA_MULTI_AMOUNT_MIN_DESC', "Minimum amount to activate this payment method.");
define('MODULE_PAYMENT_LYRA_MULTI_AMOUNT_MAX_TITLE', "Maximum amount");
define('MODULE_PAYMENT_LYRA_MULTI_AMOUNT_MAX_DESC', "Maximum amount to activate this payment method.");

## ADMINISTRATION INTERFACE - BACK TO STORE SETTINGS ##
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_ENABLED_TITLE', "Automatic redirection");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_ENABLED_DESC', "If enabled, the buyer is automatically redirected to your site at the end of the payment.");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_SUCCESS_TIMEOUT_TITLE', "Redirection timeout on success");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_SUCCESS_TIMEOUT_DESC', "Time in seconds (0-300) before the buyer is automatically redirected to your website after a successful payment.");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_SUCCESS_MESSAGE_TITLE', "Redirection message on success");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_SUCCESS_MESSAGE_DESC', "Message displayed on the payment page prior to redirection after a successful payment.");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_ERROR_TIMEOUT_TITLE', "Redirection timeout on failure");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_ERROR_TIMEOUT_DESC', "Time in seconds (0-300) before the buyer is automatically redirected to your website after a declined payment");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_ERROR_MESSAGE_TITLE', "Redirection message on failure");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_ERROR_MESSAGE_DESC', "Message displayed on the payment page prior to redirection after a declined payment.");
define('MODULE_PAYMENT_LYRA_MULTI_RETURN_MODE_TITLE', "Return mode");
define('MODULE_PAYMENT_LYRA_MULTI_RETURN_MODE_DESC', "Method that will be used for transmitting the payment result from the payment page to your shop.");
define('MODULE_PAYMENT_LYRA_MULTI_ORDER_STATUS_TITLE', "Order Status");
define('MODULE_PAYMENT_LYRA_MULTI_ORDER_STATUS_DESC', "Defines the status of orders paid with this payment mode.");

## ADMINISTRATION INTERFACE - MISC CONSTANTS ##
define('MODULE_PAYMENT_LYRA_MULTI_VALUE_False', "Disabled");
define('MODULE_PAYMENT_LYRA_MULTI_VALUE_True', "Enabled");

define('MODULE_PAYMENT_LYRA_MULTI_VALIDATION_DEFAULT', "Lyra Expert Back Office configuration");
define('MODULE_PAYMENT_LYRA_MULTI_VALIDATION_0', "Automatic");
define('MODULE_PAYMENT_LYRA_MULTI_VALIDATION_1', "Manual");

## ADMINISTRATION INTERFACE - MULTI PAYMENT SETTINGS ##
define('MODULE_PAYMENT_LYRA_MULTI_OPTIONS_TITLE', "Payment options");
define('MODULE_PAYMENT_LYRA_MULTI_OPTIONS_DESC', "Click on \"Add\" button to configure one or more payment options. <br /><b>Label : </b>The option label to display on the frontend. <br /><b>Min amount : </b>Minimum amount to enable the payment option. <br /><b>Max amount : </b>Maximum amount to enable the payment option. <br /><b>Count : </b>Total number of payments. <br /><b>Period : </b>Delay (in days) between payments. <br /><b>1st payment : </b>Amount of first payment, in percentage of total amount. If empty, all payments will have the same amount.<br /><b>Do not forget to click on \"Update\" button to save your modifications.</b>");
define('MODULE_PAYMENT_LYRA_MULTI_OPTIONS_LABEL', "Label");
define('MODULE_PAYMENT_LYRA_MULTI_OPTIONS_MIN_AMOUNT', "Min amount");
define('MODULE_PAYMENT_LYRA_MULTI_OPTIONS_MAX_AMOUNT', "Max amount");
define('MODULE_PAYMENT_LYRA_MULTI_OPTIONS_CONTRACT', "Contract");
define('MODULE_PAYMENT_LYRA_MULTI_OPTIONS_COUNT', "Count");
define('MODULE_PAYMENT_LYRA_MULTI_OPTIONS_PERIOD', "Period");
define('MODULE_PAYMENT_LYRA_MULTI_OPTIONS_FIRST', "1st payment");
define('MODULE_PAYMENT_LYRA_MULTI_OPTIONS_ADD', "Add");
define('MODULE_PAYMENT_LYRA_MULTI_OPTIONS_DELETE', "Delete");

define('MODULE_PAYMENT_LYRA_MULTI_WARNING', "ATTENTION: The payment in installments feature activation is subject to the prior agreement of Société Générale.<br />If you enable this feature while you have not the associated option, an error 10000 – INSTALLMENTS_NOT_ALLOWED or 07 - PAYMENT_CONFIG will occur and the buyer will not be able to pay.");
