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
define('MODULE_PAYMENT_LYRA_TECHNICAL_ERROR', "Ein Fehler ist bei dem Zahlungsvorgang unterlaufen.");
define('MODULE_PAYMENT_LYRA_PAYMENT_ERROR', "Ihre Zahlung wurde abgelehnt. Bitte führen Sie den Bestellvorgang erneut durch.");
define('MODULE_PAYMENT_LYRA_CHECK_URL_WARN', "Die automatische Bestätigung hat nicht funktioniert. Haben Sie die Server URL im Lyra Expert Back Office richtig eingestellt?");
define('MODULE_PAYMENT_LYRA_CHECK_URL_WARN_DETAIL', "Nähere Informationen zu diesem Problem entnehmen Sie bitte der Moduldokumentation:<br />&nbsp;&nbsp;&nbsp;- Kapitel « Bitte vor dem Weiterlesen aufmerksam lesen »<br />&nbsp;&nbsp;&nbsp;- Kapitel « Benachrichtigung-URL Einstellungen »");
define('MODULE_PAYMENT_LYRA_GOING_INTO_PROD_INFO', "<p><u>UMSTELLUNG AUF PRODUKTIONSUMFELD</u></p>Sie möchten wissen, wie Sie auf Produktionsumfeld umstellen können, bitte lesen Sie die Kapitel « Weiter zur Testphase » und « Verschieben des Shops in den Produktionsumfeld » in der Dokumentation des Moduls.");
define('MODULE_PAYMENT_LYRA_REDIRECT_MESSAGE', 'Weiterleitung zum Shop in Kürze...');

## ADMINISTRATION INTERFACE - INFORMATIONS ##
define('MODULE_PAYMENT_LYRA_MODULE_INFORMATION', "MODULINFORMATIONEN");
define('MODULE_PAYMENT_LYRA_DEVELOPED_BY', "Entwickelt von");
define('MODULE_PAYMENT_LYRA_CONTACT_EMAIL', "E-Mail-Adresse");
define('MODULE_PAYMENT_LYRA_PLUGIN_VERSION', "Modulversion");
define('MODULE_PAYMENT_LYRA_GATEWAY_VERSION', "Kompatibel mit Zahlungsschnittstelle");
define('MODULE_PAYMENT_LYRA_CHECK_URL', "Benachrichtigung-URL");
define('MODULE_PAYMENT_LYRA_CHECK_URL_DESC', "URL, die Sie in Ihre Lyra Expert Back Office kopieren sollen > Einstellung > Regeln der Benachrichtigungen.");

## ADMINISTRATION INTERFACE - MISC CONSTANTS ##
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

define('MODULE_PAYMENT_LYRA_VALUE_False', "Deaktiviert");
define('MODULE_PAYMENT_LYRA_VALUE_True', "Aktiviert");

define('MODULE_PAYMENT_LYRA_VALIDATION_DEFAULT', "Lyra Expert Back Office Konfiguration");
define('MODULE_PAYMENT_LYRA_VALIDATION_0', "Automatisch");
define('MODULE_PAYMENT_LYRA_VALIDATION_1', "Manuell");
