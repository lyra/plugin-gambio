<?php
/**
 * Copyright © Lyra Network.
 * This file is part of Lyra Collect plugin for Gambio. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL v2)
 */

include_once 'lyra_common.php';

## CATALOG MESSAGES ##
define('MODULE_PAYMENT_LYRA_TEXT_TITLE', "Lyra Collect - Standard payment");
define('MODULE_PAYMENT_LYRA_FRONT_TITLE', "Payment by credit card");

## ADMINISTRATION INTERFACE - MODULE SETTINGS ##
define('MODULE_PAYMENT_LYRA_STATUS_TITLE', "Activation");
define('MODULE_PAYMENT_LYRA_STATUS_DESC', "Enables / disables this payment method.");
define('MODULE_PAYMENT_LYRA_SORT_ORDER_TITLE', "Display order");
define('MODULE_PAYMENT_LYRA_SORT_ORDER_DESC', "Display order. The smaller appears first.");
define('MODULE_PAYMENT_LYRA_ZONE_TITLE', "Payment area");
define('MODULE_PAYMENT_LYRA_ZONE_DESC', "If an area is selected, this payment mode will only be available for it.");
define('MODULE_PAYMENT_LYRA_ALLOWED_TITLE', "Allowed zones");
define('MODULE_PAYMENT_LYRA_ALLOWED_DESC', "Please Enter each Zone for which this module should be enabled (e.g. \"UK, DE\"). If left empty, all zones are allowed.");

## ADMINISTRATION INTERFACE - PLATFORM SETTINGS ##
define('MODULE_PAYMENT_LYRA_SITE_ID_TITLE', "Shop ID");
define('MODULE_PAYMENT_LYRA_SITE_ID_DESC', "The identifier provided by Lyra Collect.");
define('MODULE_PAYMENT_LYRA_KEY_TEST_TITLE', "Key in test mode");
define('MODULE_PAYMENT_LYRA_KEY_TEST_DESC', "Key provided by Lyra Collect for test mode (available in Lyra Expert Back Office).");
define('MODULE_PAYMENT_LYRA_KEY_PROD_TITLE', "Key in production mode");
define('MODULE_PAYMENT_LYRA_KEY_PROD_DESC', "Key provided by Lyra Collect (available in Lyra Expert Back Office after enabling production mode).");
define('MODULE_PAYMENT_LYRA_CTX_MODE_TITLE', "Mode");
define('MODULE_PAYMENT_LYRA_CTX_MODE_DESC', "The context mode of this module.");
define('MODULE_PAYMENT_LYRA_SIGN_ALGO_TITLE', "Signature algorithm");
define('MODULE_PAYMENT_LYRA_SIGN_ALGO_DESC', "Algorithm used to compute the payment form signature. Selected algorithm must be the same as one configured in the Lyra Expert Back Office." . (! lyra_tools::$lyra_plugin_features['shatwo'] ? "<br /><b>The HMAC-SHA-256 algorithm should not be activated if it is not yet available in the Lyra Expert Back Office, the feature will be available soon.</b>" : ''));
define('MODULE_PAYMENT_LYRA_PLATFORM_URL_TITLE', "Payment page URL");
define('MODULE_PAYMENT_LYRA_PLATFORM_URL_DESC', "Link to the payment page.");

## ADMINISTRATION INTERFACE - PAYMENT SETTINGS ##
define('MODULE_PAYMENT_LYRA_LANGUAGE_TITLE', "Default language");
define('MODULE_PAYMENT_LYRA_LANGUAGE_DESC', "Default language on the payment page.");
define('MODULE_PAYMENT_LYRA_AVAILABLE_LANGUAGES_TITLE', "Available languages");
define('MODULE_PAYMENT_LYRA_AVAILABLE_LANGUAGES_DESC', "Languages available on the payment page. If you do not select any, all the supported languages will be available.");
define('MODULE_PAYMENT_LYRA_CAPTURE_DELAY_TITLE', "Capture delay");
define('MODULE_PAYMENT_LYRA_CAPTURE_DELAY_DESC', "The number of days before the bank capture (adjustable in your Lyra Expert Back Office).");
define('MODULE_PAYMENT_LYRA_VALIDATION_MODE_TITLE', "Validation mode");
define('MODULE_PAYMENT_LYRA_VALIDATION_MODE_DESC', "If manual is selected, you will have to confirm payments manually in your Lyra Expert Back Office.");
define('MODULE_PAYMENT_LYRA_PAYMENT_CARDS_TITLE', "Card types");
define('MODULE_PAYMENT_LYRA_PAYMENT_CARDS_DESC', "The card type(s) that can be used for the payment. Select none to use gateway configuration.");
define('MODULE_PAYMENT_LYRA_3DS_MIN_AMOUNT_TITLE', "Disable 3DS");
define('MODULE_PAYMENT_LYRA_3DS_MIN_AMOUNT_DESC', "Amount below which 3DS will be disabled. Needs subscription to selective 3DS option. For more information, refer to the module documentation.");

## ADMINISTRATION INTERFACE - AMOUNT RESTRICTIONS SETTINGS ##
define('MODULE_PAYMENT_LYRA_AMOUNT_MIN_TITLE', "Minimum amount");
define('MODULE_PAYMENT_LYRA_AMOUNT_MIN_DESC', "Minimum amount to activate this payment method.");
define('MODULE_PAYMENT_LYRA_AMOUNT_MAX_TITLE', "Maximum amount");
define('MODULE_PAYMENT_LYRA_AMOUNT_MAX_DESC', "Maximum amount to activate this payment method.");

## ADMINISTRATION INTERFACE - BACK TO STORE SETTINGS ##
define('MODULE_PAYMENT_LYRA_REDIRECT_ENABLED_TITLE', "Automatic redirection");
define('MODULE_PAYMENT_LYRA_REDIRECT_ENABLED_DESC', "If enabled, the buyer is automatically redirected to your site at the end of the payment.");
define('MODULE_PAYMENT_LYRA_REDIRECT_SUCCESS_TIMEOUT_TITLE', "Redirection timeout on success");
define('MODULE_PAYMENT_LYRA_REDIRECT_SUCCESS_TIMEOUT_DESC', "Time in seconds (0-300) before the buyer is automatically redirected to your website after a successful payment.");
define('MODULE_PAYMENT_LYRA_REDIRECT_SUCCESS_MESSAGE_TITLE', "Redirection message on success");
define('MODULE_PAYMENT_LYRA_REDIRECT_SUCCESS_MESSAGE_DESC', "Message displayed on the payment page prior to redirection after a successful payment.");
define('MODULE_PAYMENT_LYRA_REDIRECT_ERROR_TIMEOUT_TITLE', "Redirection timeout on failure");
define('MODULE_PAYMENT_LYRA_REDIRECT_ERROR_TIMEOUT_DESC', "Time in seconds (0-300) before the buyer is automatically redirected to your website after a declined payment");
define('MODULE_PAYMENT_LYRA_REDIRECT_ERROR_MESSAGE_TITLE', "Redirection message on failure");
define('MODULE_PAYMENT_LYRA_REDIRECT_ERROR_MESSAGE_DESC', "Message displayed on the payment page prior to redirection after a declined payment.");
define('MODULE_PAYMENT_LYRA_RETURN_MODE_TITLE', "Return mode");
define('MODULE_PAYMENT_LYRA_RETURN_MODE_DESC', "Method that will be used for transmitting the payment result from the payment page to your shop.");
define('MODULE_PAYMENT_LYRA_ORDER_STATUS_TITLE', "Order Status");
define('MODULE_PAYMENT_LYRA_ORDER_STATUS_DESC', "Defines the status of orders paid with this payment mode.");
