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
define('MODULE_PAYMENT_LYRA_TECHNICAL_ERROR', "Une erreur est survenue durant le processus de paiement.");
define('MODULE_PAYMENT_LYRA_PAYMENT_ERROR', "Votre paiement n'a pas été accepté. Veuillez repasser votre commande.");
define('MODULE_PAYMENT_LYRA_CHECK_URL_WARN', "La validation automatique n'a pas fonctionné. Avez-vous configuré correctement l'URL de notification dans le Back Office Lyra Expert?");
define('MODULE_PAYMENT_LYRA_CHECK_URL_WARN_DETAIL', "Afin de comprendre la problématique, reportez vous à la documentation du module:<br />&nbsp;&nbsp;&nbsp;- Chapitre « A lire attentivement avant d'aller loin »<br />&nbsp;&nbsp;&nbsp;- Chapitre « Paramétrage de l'URL de notification »");
define('MODULE_PAYMENT_LYRA_GOING_INTO_PROD_INFO', "<p><u>PASSAGE EN PRODUCTION</u></p>Vous souhaitez savoir comment passer votre boutique en production, merci de consulter les chapitres « Procéder à la phase des tests » et « Passage d'une boutique en mode production » de la documentation du module.");
define('MODULE_PAYMENT_LYRA_REDIRECT_MESSAGE', 'Redirection vers la boutique dans quelques instants...');

## ADMINISTRATION INTERFACE - INFORMATIONS ##
define('MODULE_PAYMENT_LYRA_MODULE_INFORMATION', "INFORMATIONS SUR LE MODULE");
define('MODULE_PAYMENT_LYRA_DEVELOPED_BY', "Développé par");
define('MODULE_PAYMENT_LYRA_CONTACT_EMAIL', "Courriel de contact");
define('MODULE_PAYMENT_LYRA_PLUGIN_VERSION', "Version du module");
define('MODULE_PAYMENT_LYRA_GATEWAY_VERSION', "Version de la plateforme");
define('MODULE_PAYMENT_LYRA_CHECK_URL', "URL de notification");
define('MODULE_PAYMENT_LYRA_CHECK_URL_DESC', "URL à copier dans le Back Office Lyra Expert > Paramétrage > Règles de notifications.");

## ADMINISTRATION INTERFACE - MISC CONSTANTS ##
define('MODULE_PAYMENT_LYRA_LANGUAGE_FRENCH', "Français");
define('MODULE_PAYMENT_LYRA_LANGUAGE_GERMAN', "Allemand");
define('MODULE_PAYMENT_LYRA_LANGUAGE_ENGLISH', "Anglais");
define('MODULE_PAYMENT_LYRA_LANGUAGE_SPANISH', "Espagnol");
define('MODULE_PAYMENT_LYRA_LANGUAGE_CHINESE', "Chinois");
define('MODULE_PAYMENT_LYRA_LANGUAGE_ITALIAN', "Italien");
define('MODULE_PAYMENT_LYRA_LANGUAGE_JAPANESE', "Japonais");
define('MODULE_PAYMENT_LYRA_LANGUAGE_PORTUGUESE', "Portugais");
define('MODULE_PAYMENT_LYRA_LANGUAGE_DUTCH', "Néerlandais");
define('MODULE_PAYMENT_LYRA_LANGUAGE_SWEDISH', "Suédois");
define('MODULE_PAYMENT_LYRA_LANGUAGE_RUSSIAN', "Russe");
define('MODULE_PAYMENT_LYRA_LANGUAGE_POLISH', "Polonais");
define('MODULE_PAYMENT_LYRA_LANGUAGE_TURKISH', "Turc");

define('MODULE_PAYMENT_LYRA_VALUE_False', "Désactivé");
define('MODULE_PAYMENT_LYRA_VALUE_True', "Activé");

define('MODULE_PAYMENT_LYRA_VALIDATION_DEFAULT', "Configuration Back Office Lyra Expert");
define('MODULE_PAYMENT_LYRA_VALIDATION_0', "Automatique");
define('MODULE_PAYMENT_LYRA_VALIDATION_1', "Manuel");
