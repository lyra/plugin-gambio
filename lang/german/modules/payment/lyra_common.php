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

## CATALOG MESSAGES ##
define('MODULE_PAYMENT_LYRA_TECHNICAL_ERROR', "Ein Fehler ist während dem Zahlungsvorgang unterlaufen.");
define('MODULE_PAYMENT_LYRA_PAYMENT_ERROR', "Ihre Bestellung konnte nicht bestätigt werden.  Die Zahlung wurde nicht angenommen.");
define('MODULE_PAYMENT_LYRA_CHECK_URL_WARN', "Es konnte keine automatische Benachrichtigung erstellt werden. Bitte prüfen Sie, ob die Benachrichtigung-URL in Ihrem Lyra Expert Back Office korrekt eingerichtet ist?");
define('MODULE_PAYMENT_LYRA_CHECK_URL_WARN_DETAIL', "Nähere Informationen zu diesem Problem entnehmen Sie bitte der Moduldokumentation: <br />&nbsp;&nbsp;&nbsp;- Kapitel &laquo; Bitte vor dem Weiterlesen aufmerksam lesen &raquo;<br />&nbsp;&nbsp;&nbsp;- Kapitel &laquo; Benachrichtigung-URL Einstellungen &raquo;");
define('MODULE_PAYMENT_LYRA_GOING_INTO_PROD_INFO', "<p><u>UMSTELLUNG AUF PRODUKTIONSUMFELD</u></p>Sie möchten wissen, wie Sie auf Produktionsumfeld umstellen können, bitte lesen Sie die Kapitel « Weiter zur Testphase » und « Verschieben des Shops in den Produktionsumfeld » in der Dokumentation des Moduls");

## ADMINISTRATION INTERFACE - INFORMATIONS ##
define('MODULE_PAYMENT_LYRA_MODULE_INFORMATION', "MODULINFORMATIONEN");
define('MODULE_PAYMENT_LYRA_DEVELOPED_BY', "Entwickelt von");
define('MODULE_PAYMENT_LYRA_CONTACT_EMAIL', "E-Mail-Adresse");
define('MODULE_PAYMENT_LYRA_PLUGIN_VERSION', "Modulversion");
define('MODULE_PAYMENT_LYRA_GATEWAY_VERSION', "Kompatibel mit Zahlungsschnittstelle");
define('MODULE_PAYMENT_LYRA_CHECK_URL', "Benachrichtigung-URL zur Eintragung in Ihr Shopsystem: <br />");

## ADMINISTRATION INTERFACE - MISC CONSTANTS ##
define('MODULE_PAYMENT_LYRA_VALUE_False', "Deaktiviert");
define('MODULE_PAYMENT_LYRA_VALUE_True', "Aktiviert");

define('MODULE_PAYMENT_LYRA_VALIDATION_DEFAULT', "Lyra Expert Back Office Konfiguration");
define('MODULE_PAYMENT_LYRA_VALIDATION_0', "Auto");
define('MODULE_PAYMENT_LYRA_VALIDATION_1', "Manuell");

define('MODULE_PAYMENT_LYRA_LANGUAGE_FRENCH', "Französisch");
define('MODULE_PAYMENT_LYRA_LANGUAGE_GERMAN', "Deutsch");
define('MODULE_PAYMENT_LYRA_LANGUAGE_ENGLISH', "Englisch");
define('MODULE_PAYMENT_LYRA_LANGUAGE_SPANISH', "Spanisch");
define('MODULE_PAYMENT_LYRA_LANGUAGE_CHINESE', "Chinesisch");
define('MODULE_PAYMENT_LYRA_LANGUAGE_ITALIAN', "Italienisch");
define('MODULE_PAYMENT_LYRA_LANGUAGE_JAPANESE', "Japanisch");
define('MODULE_PAYMENT_LYRA_LANGUAGE_PORTUGUESE', "Portugiesisch");
define('MODULE_PAYMENT_LYRA_LANGUAGE_DUTCH', "Niederländisch");
define('MODULE_PAYMENT_LYRA_LANGUAGE_SWEDISH', "Schwedisch");
define('MODULE_PAYMENT_LYRA_LANGUAGE_RUSSIAN', "Russisch");
define('MODULE_PAYMENT_LYRA_LANGUAGE_POLISH', "Polnisch");
define('MODULE_PAYMENT_LYRA_LANGUAGE_TURKISH', "Türkisch");
