<?php
/**
###COMMON_PHP_FILE_HEADER###
*/

include_once '__vads_common.php';

## CATALOG MESSAGES ##
define('MODULE_PAYMENT___VADS_TEXT_TITLE', "###BANKNAME### - Credit Card Payment");

## ADMINISTRATION INTERFACE - MODULE SETTINGS ##
define('MODULE_PAYMENT___VADS_STATUS_TITLE', "Module status");
define('MODULE_PAYMENT___VADS_STATUS_DESC', "Enables / disables the ###BANKNAME### payment module.");
define('MODULE_PAYMENT___VADS_SORT_ORDER_TITLE', "Display order");
define('MODULE_PAYMENT___VADS_SORT_ORDER_DESC', "Display order. The smaller appears first.");
define('MODULE_PAYMENT___VADS_ZONE_TITLE', "Payment area");
define('MODULE_PAYMENT___VADS_ZONE_DESC', "If an area is selected, this payment mode will only be available for it.");
define('MODULE_PAYMENT___VADS_ALLOWED_TITLE', "Allowed zones");
define('MODULE_PAYMENT___VADS_ALLOWED_DESC', "Please Enter each Zone for which this module should be enabled (e.g. \"UK,DE\"). If left empty, all zones are allowed.");

## ADMINISTRATION INTERFACE - PLATFORM SETTINGS ##
define('MODULE_PAYMENT___VADS_SITE_ID_TITLE', "Site ID");
define('MODULE_PAYMENT___VADS_SITE_ID_DESC', "The identifier provided by your bank.");
define('MODULE_PAYMENT___VADS_KEY_TEST_TITLE', "Certificate in test mode");
define('MODULE_PAYMENT___VADS_KEY_TEST_DESC', "Certificate provided by your bank for test mode(available on the ###BANKNAME### back-office).");
define('MODULE_PAYMENT___VADS_KEY_PROD_TITLE', "Certificate in production mode");
define('MODULE_PAYMENT___VADS_KEY_PROD_DESC', "Certificate provided by your bank (available on the ###BANKNAME### back-office after going into production).");
define('MODULE_PAYMENT___VADS_CTX_MODE_TITLE', "Mode");
define('MODULE_PAYMENT___VADS_CTX_MODE_DESC', "The context mode of this module.");
define('MODULE_PAYMENT___VADS_PLATFORM_URL_TITLE', "Platform URL");
define('MODULE_PAYMENT___VADS_PLATFORM_URL_DESC', "Link to the payment platform.");

## ADMINISTRATION INTERFACE - PAYMENT SETTINGS ##
define('MODULE_PAYMENT___VADS_LANGUAGE_TITLE', "Default language");
define('MODULE_PAYMENT___VADS_LANGUAGE_DESC', "Default language on the payment page.");
define('MODULE_PAYMENT___VADS_AVAILABLE_LANGUAGES_TITLE', "Available languages");
define('MODULE_PAYMENT___VADS_AVAILABLE_LANGUAGES_DESC', "Available languages on payment page. Select none to use gateway configuration.");
define('MODULE_PAYMENT___VADS_CAPTURE_DELAY_TITLE', "Capture delay");
define('MODULE_PAYMENT___VADS_CAPTURE_DELAY_DESC', "The number of days before the bank restoration (adjustable in your ###BANKNAME### back-office).");
define('MODULE_PAYMENT___VADS_VALIDATION_MODE_TITLE', "Validation mode");
define('MODULE_PAYMENT___VADS_VALIDATION_MODE_DESC', "If manual is selected, you will have to confirm payments manually in your ###BANKNAME### back-office.");
define('MODULE_PAYMENT___VADS_PAYMENT_CARDS_TITLE', "Card Types");
define('MODULE_PAYMENT___VADS_PAYMENT_CARDS_DESC', "The card type(s) that can be used for the payment. Select none to use gateway configuration.");
define('MODULE_PAYMENT___VADS_3DS_MIN_AMOUNT_TITLE', "Minimum amount to activate 3DS");
define('MODULE_PAYMENT___VADS_3DS_MIN_AMOUNT_DESC', "Needs subscription to Selective 3-D Secure option.");

## ADMINISTRATION INTERFACE - AMOUNT RESTRICTIONS SETTINGS ##
define('MODULE_PAYMENT___VADS_AMOUNT_MIN_TITLE', "Minimum amount");
define('MODULE_PAYMENT___VADS_AMOUNT_MIN_DESC', "Minimum amount to activate this payment method.");
define('MODULE_PAYMENT___VADS_AMOUNT_MAX_TITLE', "Maximum amount");
define('MODULE_PAYMENT___VADS_AMOUNT_MAX_DESC', "Maximum amount to activate this payment method.");

## ADMINISTRATION INTERFACE - BACK TO STORE SETTINGS ##
define('MODULE_PAYMENT___VADS_REDIRECT_ENABLED_TITLE', "Automatic forward");
define('MODULE_PAYMENT___VADS_REDIRECT_ENABLED_DESC', "If enabled, the client is automaticly forwarded to your site at the end of the payment process.");
define('MODULE_PAYMENT___VADS_REDIRECT_SUCCESS_TIMEOUT_TITLE', "Success forward timeout");
define('MODULE_PAYMENT___VADS_REDIRECT_SUCCESS_TIMEOUT_DESC', "Time in seconds (0-300) before the client is automatically forwarded to your site when the payment was successful.");
define('MODULE_PAYMENT___VADS_REDIRECT_SUCCESS_MESSAGE_TITLE', "Success forward message");
define('MODULE_PAYMENT___VADS_REDIRECT_SUCCESS_MESSAGE_DESC', "Message posted on the payment platform before forwarding when the payment was successful.");
define('MODULE_PAYMENT___VADS_REDIRECT_ERROR_TIMEOUT_TITLE', "Failure forward timeout");
define('MODULE_PAYMENT___VADS_REDIRECT_ERROR_TIMEOUT_DESC', "Time in seconds (0-300) before the client is automatically forwarded to your site when the payment failed.");
define('MODULE_PAYMENT___VADS_REDIRECT_ERROR_MESSAGE_TITLE', "Failure forward message");
define('MODULE_PAYMENT___VADS_REDIRECT_ERROR_MESSAGE_DESC', "Message posted on the payment platform before forwarding when the payment failed.");
define('MODULE_PAYMENT___VADS_RETURN_MODE_TITLE', "Return mode");
define('MODULE_PAYMENT___VADS_RETURN_MODE_DESC', "Method that will be used for transmitting the payment result from the payment gateway to your store.");
define('MODULE_PAYMENT___VADS_ORDER_STATUS_TITLE', "Order Status");
define('MODULE_PAYMENT___VADS_ORDER_STATUS_DESC', "Defining the status of orders paid by the ###BANKNAME### payment method.");
?>