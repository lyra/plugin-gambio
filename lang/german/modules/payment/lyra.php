<?php
/**
 * Copyright © Lyra Network.
 * This file is part of PayZen plugin for Gambio. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL v2)
 */

include_once 'lyra_common.php';

## CATALOG MESSAGES ##
define('MODULE_PAYMENT_LYRA_TEXT_TITLE', "Lyra Collect - Sichere Zahlung per EC/-Kreditkarte");

## ADMINISTRATION INTERFACE - MODULE SETTINGS ##
define('MODULE_PAYMENT_LYRA_STATUS_TITLE', "Lyra Collect-Modul aktivieren");
define('MODULE_PAYMENT_LYRA_STATUS_DESC', "Möchten Sie die Lyra Collect-Zahlungsart akzeptieren?");
define('MODULE_PAYMENT_LYRA_SORT_ORDER_TITLE', "Anzeigereihenfolge");
define('MODULE_PAYMENT_LYRA_SORT_ORDER_DESC', "Anzeigereihenfolge: Von klein nach gross.");
define('MODULE_PAYMENT_LYRA_ZONE_TITLE', "Zahlungsraum");
define('MODULE_PAYMENT_LYRA_ZONE_DESC', "Ist ein Zahlungsraum ausgewählt, so wird diese Zahlungsart nur für diesen verfügbar sein.");
define('MODULE_PAYMENT_LYRA_ALLOWED_TITLE', "Erlaubte Zonen");
define('MODULE_PAYMENT_LYRA_ALLOWED_DESC', "Geben Sie einzeln die Zonen an, welche für dieses Modul erlaubt sein sollen. (z.B. AT,DE (wenn leer, werden alle Zonen erlaubt)).");

## ADMINISTRATION INTERFACE - PLATFORM SETTINGS ##
define('MODULE_PAYMENT_LYRA_SITE_ID_TITLE', "Site ID");
define('MODULE_PAYMENT_LYRA_SITE_ID_DESC', "Kennung, die von Ihrer Bank bereitgestellt wird.");
define('MODULE_PAYMENT_LYRA_KEY_TEST_TITLE', "Zertifikat im Testbetrieb");
define('MODULE_PAYMENT_LYRA_KEY_TEST_DESC', "Zertifikat, das von Ihrer Bank zu Testzwecken bereitgestellt wird (im Lyra Collect-System verfügbar).");
define('MODULE_PAYMENT_LYRA_KEY_PROD_TITLE', "Zertifikat im Produktivbetrieb");
define('MODULE_PAYMENT_LYRA_KEY_PROD_DESC', "Von Ihrer Bank bereitgestelltes Zertifikat (im Lyra Collect-System verfügbar).");
define('MODULE_PAYMENT_LYRA_CTX_MODE_TITLE', "Modus");
define('MODULE_PAYMENT_LYRA_CTX_MODE_DESC', "Kontextmodus dieses Moduls.");
define('MODULE_PAYMENT_LYRA_PLATFORM_URL_TITLE', "Plattform-URL");
define('MODULE_PAYMENT_LYRA_PLATFORM_URL_DESC', "Link zur Bezahlungsplattform.");

## ADMINISTRATION INTERFACE - PAYMENT SETTINGS ##
define('MODULE_PAYMENT_LYRA_LANGUAGE_TITLE', "Standardsprache");
define('MODULE_PAYMENT_LYRA_LANGUAGE_DESC', "Wählen Sie bitte die Spracheinstellung der Zahlungsseiten aus.");
define('MODULE_PAYMENT_LYRA_AVAILABLE_LANGUAGES_TITLE', "Verfügbare Sprachen");
define('MODULE_PAYMENT_LYRA_AVAILABLE_LANGUAGES_DESC', "Verfügbare Sprachen der Zahlungsseite. Nichts auswählen, um die Einstellung der Zahlungsplattform zu benutzen.");
define('MODULE_PAYMENT_LYRA_CAPTURE_DELAY_TITLE', "Einzugsfrist");
define('MODULE_PAYMENT_LYRA_CAPTURE_DELAY_DESC', "Anzahl der Tage bis zum Einzug der Zahlung (Einstellung über Ihr Lyra Collect-System).");
define('MODULE_PAYMENT_LYRA_VALIDATION_MODE_TITLE', "Bestätigungsmodus");
define('MODULE_PAYMENT_LYRA_VALIDATION_MODE_DESC', "Bei manueller Eingabe müssen Sie Zahlungen manuell in Ihrem Banksystem bestätigen.");
define('MODULE_PAYMENT_LYRA_PAYMENT_CARDS_TITLE', "Kartentypen");
define('MODULE_PAYMENT_LYRA_PAYMENT_CARDS_DESC', "Liste der/die für die Zahlung verfügbare(n) Kartentyp(en), durch Semikolon getrennt.");
define('MODULE_PAYMENT_LYRA_3DS_MIN_AMOUNT_TITLE', "Mindestbetrag zur Aktivierung von 3DS");
define('MODULE_PAYMENT_LYRA_3DS_MIN_AMOUNT_DESC', "Muss für die Option Selektives 3-D Secure freigeschaltet sein.");

## ADMINISTRATION INTERFACE - AMOUNT RESTRICTIONS SETTINGS ##
define('MODULE_PAYMENT_LYRA_AMOUNT_MIN_TITLE', "Mindestbetrag");
define('MODULE_PAYMENT_LYRA_AMOUNT_MIN_DESC', "Mindestbetrag für die Nutzung dieser Zahlungsweise.");
define('MODULE_PAYMENT_LYRA_AMOUNT_MAX_TITLE', "Höchstbetrag");
define('MODULE_PAYMENT_LYRA_AMOUNT_MAX_DESC', "Höchstbetrag für die Nutzung dieser Zahlungsweise.");

## ADMINISTRATION INTERFACE - BACK TO STORE SETTINGS ##
define('MODULE_PAYMENT_LYRA_REDIRECT_ENABLED_TITLE', "Automatische Weiterleitung");
define('MODULE_PAYMENT_LYRA_REDIRECT_ENABLED_DESC', "Ist diese Einstellung aktiviert, wird der Kunde am Ende des Bezahlvorgangs automatisch auf Ihre Seite weitergeleitet.");
define('MODULE_PAYMENT_LYRA_REDIRECT_SUCCESS_TIMEOUT_TITLE', "Zeitbeschränkung Weiterleitung im Erfolgsfall");
define('MODULE_PAYMENT_LYRA_REDIRECT_SUCCESS_TIMEOUT_DESC', "Zeitspanne in Sekunden (0-300) bis zur automatischen Weiterleitung des Kunden auf Ihre Seite nach erfolgter Zahlung.");
define('MODULE_PAYMENT_LYRA_REDIRECT_SUCCESS_MESSAGE_TITLE', "Weiterleitungs-Nachricht im Erfolgsfall");
define('MODULE_PAYMENT_LYRA_REDIRECT_SUCCESS_MESSAGE_DESC', "Nachricht, die nach erfolgter Zahlung und vor der Weiterleitung auf der Plattform angezeigt wird.");
define('MODULE_PAYMENT_LYRA_REDIRECT_ERROR_TIMEOUT_TITLE', "Zeitbeschränkung Weiterleitung nach Ablehnung");
define('MODULE_PAYMENT_LYRA_REDIRECT_ERROR_TIMEOUT_DESC', "Zeitspanne in Sekunden (0-300) bis zur automatischen Weiterleitung des Kunden auf Ihre Seite nach fehlgeschlagener Zahlung.");
define('MODULE_PAYMENT_LYRA_REDIRECT_ERROR_MESSAGE_TITLE', "Weiterleitungs-Nachricht nach Ablehnung");
define('MODULE_PAYMENT_LYRA_REDIRECT_ERROR_MESSAGE_DESC', "Nachricht, die nach fehlgeschlagener Zahlung und vor der Weiterleitung auf der Plattform angezeigt wird.");
define('MODULE_PAYMENT_LYRA_RETURN_MODE_TITLE', 'Übermittlungs-Modus');
define('MODULE_PAYMENT_LYRA_RETURN_MODE_DESC', 'Methode, die zur Übermittlung des Zahlungsergebnisses von der Zahlungsschnittstelle an Ihren Shop verwendet wird.');
define('MODULE_PAYMENT_LYRA_ORDER_STATUS_TITLE', "Bestellstatus");
define('MODULE_PAYMENT_LYRA_ORDER_STATUS_DESC', "Definiert den Status von Bestellungen, die über die Lyra Collect-Zahlungsart bezahlt wurden.");
