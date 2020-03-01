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

define('MODULE_PAYMENT_LYRA_MULTI_TEXT_TITLE', "Lyra Collect - Zahlung in mehrere Optionen");
define('MODULE_PAYMENT_LYRA_MULTI_SHORT_TITLE', "Ratenzahlung mit EC-/Kreditkarte");

## ADMINISTRATION INTERFACE - MODULE SETTINGS ##
define('MODULE_PAYMENT_LYRA_MULTI_STATUS_TITLE', "Modulstatus");
define('MODULE_PAYMENT_LYRA_MULTI_STATUS_DESC', "Aktiviert / Deaktiviert dieses Zahlungsmodus.");
define('MODULE_PAYMENT_LYRA_MULTI_SORT_ORDER_TITLE', "Anzeigereihenfolge");
define('MODULE_PAYMENT_LYRA_MULTI_SORT_ORDER_DESC', "Anzeigereihenfolge: Von klein nach gross.");
define('MODULE_PAYMENT_LYRA_MULTI_ZONE_TITLE', "Zahlungsraum");
define('MODULE_PAYMENT_LYRA_MULTI_ZONE_DESC', "Ist ein Zahlungsraum ausgewählt, so wird diese Zahlungsart nur für diesen verfügbar sein.");
define('MODULE_PAYMENT_LYRA_MULTI_ALLOWED_TITLE', "Erlaubte Zonen");
define('MODULE_PAYMENT_LYRA_MULTI_ALLOWED_DESC', "Geben Sie einzeln die Zonen an, welche für dieses Modul erlaubt sein sollen. (z.B. AT,DE (wenn leer, werden alle Zonen erlaubt)).");

## ADMINISTRATION INTERFACE - PLATFORM SETTINGS ##
define('MODULE_PAYMENT_LYRA_MULTI_SITE_ID_TITLE', "Shop ID");
define('MODULE_PAYMENT_LYRA_MULTI_SITE_ID_DESC', "Der von Lyra Collect Benutzer.");
define('MODULE_PAYMENT_LYRA_MULTI_KEY_TEST_TITLE', "Schlüssel im Testbetrieb");
define('MODULE_PAYMENT_LYRA_MULTI_KEY_TEST_DESC', "Schlüssel, das von Lyra Collect zu Testzwecken bereitgestellt wird (im Lyra Expert Back Office verfügbar).");
define('MODULE_PAYMENT_LYRA_MULTI_KEY_PROD_TITLE', "Schlüssel im Produktivbetrieb");
define('MODULE_PAYMENT_LYRA_MULTI_KEY_PROD_DESC', "Von Lyra Collect bereitgestelltes Schlüssel (im Lyra Expert Back Office verfügbar, nachdem der Produktionsmodus aktiviert wurde).");
define('MODULE_PAYMENT_LYRA_MULTI_CTX_MODE_TITLE', "Modus");
define('MODULE_PAYMENT_LYRA_MULTI_CTX_MODE_DESC', "Funktionsweise dieses Moduls.");
define('MODULE_PAYMENT_LYRA_MULTI_SIGN_ALGO_TITLE', "Signaturalgorithmus");
define('MODULE_PAYMENT_LYRA_MULTI_SIGN_ALGO_DESC', "Algorithmus zur Berechnung der Zahlungsformsignatur. Der ausgewählte Algorithmus muss derselbe sein, wie er im Lyra Expert Back Office." . (! lyra_tools::$lyra_plugin_features['shatwo'] ? "<br /><b>Der HMAC-SHA-256-Algorithmus sollte nicht aktiviert werden, wenn er noch nicht im Lyra Expert Back Office verfügbar ist. Die Funktion wird in Kürze verfügbar sein.</b>" : ''));
define('MODULE_PAYMENT_LYRA_MULTI_PLATFORM_URL_TITLE', "Schnittstellen-URL");
define('MODULE_PAYMENT_LYRA_MULTI_PLATFORM_URL_DESC', "Link zur Zahlung.");

## ADMINISTRATION INTERFACE - PAYMENT SETTINGS ##
define('MODULE_PAYMENT_LYRA_MULTI_LANGUAGE_TITLE', "Standardsprache");
define('MODULE_PAYMENT_LYRA_MULTI_LANGUAGE_DESC', "Standardsprache auf Zahlungsseite.");
define('MODULE_PAYMENT_LYRA_MULTI_AVAILABLE_LANGUAGES_TITLE', "Verfügbare Sprachen");
define('MODULE_PAYMENT_LYRA_MULTI_AVAILABLE_LANGUAGES_DESC', "Die Sprache auswählen, die auf die Bezahlungsseite vorgeschlagen werden.Wenn Sie keine auswählen, werden alle unterstützten Sprachen verfügbar.");
define('MODULE_PAYMENT_LYRA_MULTI_CAPTURE_DELAY_TITLE', "Einzugsfrist");
define('MODULE_PAYMENT_LYRA_MULTI_CAPTURE_DELAY_DESC', "Anzahl der Tage bis zum Einzug der Zahlung (Einstellung über Ihr Lyra Expert Back Office).");
define('MODULE_PAYMENT_LYRA_MULTI_VALIDATION_MODE_TITLE', "Bestätigungsmodus");
define('MODULE_PAYMENT_LYRA_MULTI_VALIDATION_MODE_DESC', "Bei manueller Eingabe müssen Sie Zahlungen manuell in Ihrem Lyra Expert Back Office bestätigen.");
define('MODULE_PAYMENT_LYRA_MULTI_PAYMENT_CARDS_TITLE', "Art der Kreditkarten");
define('MODULE_PAYMENT_LYRA_MULTI_PAYMENT_CARDS_DESC', "Wählen Sie die zur Zahlung verfügbaren Kartentypen aus. Nichts auswählen, um die Einstellung der Zahlungsplattform zu benutzen.");
define('MODULE_PAYMENT_LYRA_MULTI_3DS_MIN_AMOUNT_TITLE', "3DS deaktivieren");
define('MODULE_PAYMENT_LYRA_MULTI_3DS_MIN_AMOUNT_DESC', "Betrag, unter dem 3DS deaktiviert wird. Muss für die Option Selektives 3DS freigeschaltet sein. Weitere Informationen finden Sie in der Moduldokumentation.");

## ADMINISTRATION INTERFACE - AMOUNT RESTRICTIONS SETTINGS ##
define('MODULE_PAYMENT_LYRA_MULTI_AMOUNT_MIN_TITLE', "Mindestbetrag");
define('MODULE_PAYMENT_LYRA_MULTI_AMOUNT_MIN_DESC', "Mindestbetrag dieser Zahlungsmethode zu aktivieren.");
define('MODULE_PAYMENT_LYRA_MULTI_AMOUNT_MAX_TITLE', "Höchstbetrag");
define('MODULE_PAYMENT_LYRA_MULTI_AMOUNT_MAX_DESC', "Maximale Anzahl dieser Zahlungsmethode verfügbar.");

## ADMINISTRATION INTERFACE - BACK TO STORE SETTINGS ##
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_ENABLED_TITLE', "Automatische Weiterleitung");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_ENABLED_DESC', "Falls erlaubt, der Kaufer wurde automatisch am Ende des Zahlungsprozesses auf Ihre Webseite weitergeleitet.");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_SUCCESS_TIMEOUT_TITLE', "Erfolgreiche timeout Umleitung");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_SUCCESS_TIMEOUT_DESC', "Zeit in Sekunden (0-300), bevor der Käufer automatisch zu Ihrer Shop umgeleitet wird, als die Bezahlung erfolgreich wurde.");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_SUCCESS_MESSAGE_TITLE', "Erfolgreiche Meldung vor Umleitung");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_SUCCESS_MESSAGE_DESC', "Meldung auf die Zahlungsseite vor Umleitung als die Zahlung ist erfolgreich.");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_ERROR_TIMEOUT_TITLE', "Umleitung-Timeout auf Fehler");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_ERROR_TIMEOUT_DESC', "Zeit in Sekunden (0-300) bevor der Käufer automatisch zu Ihrer Shop umgeleitet wird, als die Bezahlung verweigert wurde.");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_ERROR_MESSAGE_TITLE', "Umleitung Timeout auf Fehler");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_ERROR_MESSAGE_DESC', "Meldung angezeigt auf die Zahlungsseite vor Umleitung nach der verweigerten Zahlung.");
define('MODULE_PAYMENT_LYRA_MULTI_RETURN_MODE_TITLE', 'Übermittlungs-Modus');
define('MODULE_PAYMENT_LYRA_MULTI_RETURN_MODE_DESC', 'Methode, die für die Übermittlung des Zahlungsvorgang benützt wird, kommt aus der Bezahlungsseite zu Ihrem Geschäft.');
define('MODULE_PAYMENT_LYRA_MULTI_ORDER_STATUS_TITLE', "Bestellungen Status");
define('MODULE_PAYMENT_LYRA_MULTI_ORDER_STATUS_DESC', "Der Status der bezahlten Bestellungen durch dieses Beszahlungsmittel definieren.");

## ADMINISTRATION INTERFACE - MISC CONSTANTS ##
define('MODULE_PAYMENT_LYRA_MULTI_VALUE_False', "Deaktiviert");
define('MODULE_PAYMENT_LYRA_MULTI_VALUE_True', "Aktiviert");

## ADMINISTRATION INTERFACE - MULTI PAYMENT SETTINGS ##
define('MODULE_PAYMENT_LYRA_MULTI_OPTIONS_TITLE', "Zahlungsoptionen");
define('MODULE_PAYMENT_LYRA_MULTI_OPTIONS_DESC', "Auf die Taste \"Hinzufügen\" aufklicken, um ein oder mehrere Zahlungsoptionen aufzubauen. <br /><b>Label: </b>Text, das die Option für mehrere Bezahlung beschreibt. <br /><b>Mindestbetrag : </b>Mindestbetrag um diese Option zu vorschlagen. <br /><b>Höchstbetrag : </b>Höchtsbetrag, um diese Option zu vorschlagen. <br /><b>Zahl : </b>gesamte Zahl von Zahlungen. <br /><b>Zeitraum: </b>Zeit zwischen zwei Zahlungen (in Tages). <br /><b>Erste Zahlung: </b>Betrag der ersten Zahlung ins gesamtes Prozent. Wenn leer, alle Zahlungen werden den gleichen Betrag haben.<br /><b>Vergessen Sie nicht, auf die Taste \"Aktualisieren\" zu klicken um Ihre Veränderungen zu speichern.</b>");
define('MODULE_PAYMENT_LYRA_MULTI_OPTIONS_LABEL', "Kennzeichnung");
define('MODULE_PAYMENT_LYRA_MULTI_OPTIONS_MIN_AMOUNT', "Mindestbetrag");
define('MODULE_PAYMENT_LYRA_MULTI_OPTIONS_MAX_AMOUNT', "Höchstbetrag");
define('MODULE_PAYMENT_LYRA_MULTI_OPTIONS_CONTRACT', "Vertrag");
define('MODULE_PAYMENT_LYRA_MULTI_OPTIONS_COUNT', "Anzahl");
define('MODULE_PAYMENT_LYRA_MULTI_OPTIONS_PERIOD', "Zeitraum");
define('MODULE_PAYMENT_LYRA_MULTI_OPTIONS_FIRST', "Erste Zahlung");
define('MODULE_PAYMENT_LYRA_MULTI_OPTIONS_ADD', "Hinzufügen");
define('MODULE_PAYMENT_LYRA_MULTI_OPTIONS_DELETE', "Löschen");

define('MODULE_PAYMENT_LYRA_MULTI_WARNING', "ATTENTION: The payment in installments feature activation is subject to the prior agreement of Société Générale.<br />If you enable this feature while you have not the associated option, an error 10000 – INSTALLMENTS_NOT_ALLOWED or 07 - PAYMENT_CONFIG will occur and the buyer will not be able to pay.");
