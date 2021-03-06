<?php
/**
 * Copyright © Lyra Network.
 * This file is part of Lyra Collect plugin for Gambio. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL v2)
 */

require_once (DIR_FS_CATALOG . 'includes/classes/lyra_tools.php');

## CATALOG MESSAGES ##
define('MODULE_PAYMENT_LYRA_TECHNICAL_ERROR', "An error occurred in the payment process.");
define('MODULE_PAYMENT_LYRA_PAYMENT_ERROR', "Your payment was not accepted. Please, try to re-order.");
define('MODULE_PAYMENT_LYRA_CHECK_URL_WARN', "The automatic validation has not worked. Have you correctly set up the notification URL in the Lyra Expert Back Office?");
define('MODULE_PAYMENT_LYRA_CHECK_URL_WARN_DETAIL', "For understanding the problem, please read the documentation of the module:<br />&nbsp;&nbsp;&nbsp;- Chapter « To read carefully before going further »<br />&nbsp;&nbsp;&nbsp;- Chapter « Notification URL settings »");
define('MODULE_PAYMENT_LYRA_GOING_INTO_PROD_INFO', "<p><u>GOING INTO PRODUCTION</u></p>You want to know how to put your shop into production mode, please read chapters « Proceeding to test phase » and « Shifting the shop to production mode » in the documentation of the module.");
define('MODULE_PAYMENT_LYRA_REDIRECT_MESSAGE', 'Redirection to shop in a few seconds...');

## ADMINISTRATION INTERFACE - INFORMATIONS ##
define('MODULE_PAYMENT_LYRA_MODULE_INFORMATION', "MODULE INFORMATION");
define('MODULE_PAYMENT_LYRA_DEVELOPED_BY', "Developed by");
define('MODULE_PAYMENT_LYRA_CONTACT_EMAIL', "Contact us");
define('MODULE_PAYMENT_LYRA_PLUGIN_VERSION', "Module version");
define('MODULE_PAYMENT_LYRA_GATEWAY_VERSION', "Gateway version");
define('MODULE_PAYMENT_LYRA_CHECK_URL', "Notification URL");
define('MODULE_PAYMENT_LYRA_CHECK_URL_DESC', "URL to copy into your Lyra Expert Back Office > Settings > Notification rules.");

## ADMINISTRATION INTERFACE - MISC CONSTANTS ##
define('MODULE_PAYMENT_LYRA_LANGUAGE_FRENCH', "French");
define('MODULE_PAYMENT_LYRA_LANGUAGE_GERMAN', "German");
define('MODULE_PAYMENT_LYRA_LANGUAGE_ENGLISH', "English");
define('MODULE_PAYMENT_LYRA_LANGUAGE_SPANISH', "Spanish");
define('MODULE_PAYMENT_LYRA_LANGUAGE_CHINESE', "Chinese");
define('MODULE_PAYMENT_LYRA_LANGUAGE_ITALIAN', "Italian");
define('MODULE_PAYMENT_LYRA_LANGUAGE_JAPANESE', "Japanese");
define('MODULE_PAYMENT_LYRA_LANGUAGE_PORTUGUESE', "Portuguese");
define('MODULE_PAYMENT_LYRA_LANGUAGE_DUTCH', "Dutch");
define('MODULE_PAYMENT_LYRA_LANGUAGE_SWEDISH', "Swedish");
define('MODULE_PAYMENT_LYRA_LANGUAGE_RUSSIAN', "Russian");
define('MODULE_PAYMENT_LYRA_LANGUAGE_POLISH', "Polish");
define('MODULE_PAYMENT_LYRA_LANGUAGE_TURKISH', "Turkish");

define('MODULE_PAYMENT_LYRA_VALUE_False', "Disabled");
define('MODULE_PAYMENT_LYRA_VALUE_True', "Enabled");

define('MODULE_PAYMENT_LYRA_VALIDATION_DEFAULT', "Lyra Expert Back Office configuration");
define('MODULE_PAYMENT_LYRA_VALIDATION_0', "Automatic");
define('MODULE_PAYMENT_LYRA_VALIDATION_1', "Manual");
