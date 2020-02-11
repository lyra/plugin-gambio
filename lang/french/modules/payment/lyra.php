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
define('MODULE_PAYMENT_LYRA_TEXT_TITLE', "Lyra Collect - paiement par carte bancaire");

## ADMINISTRATION INTERFACE - MODULE SETTINGS ##
define('MODULE_PAYMENT_LYRA_STATUS_TITLE', "État du module");
define('MODULE_PAYMENT_LYRA_STATUS_DESC', "Activer / désactiver le module de paiement Lyra Collect.");
define('MODULE_PAYMENT_LYRA_SORT_ORDER_TITLE', "Ordre d'affichage");
define('MODULE_PAYMENT_LYRA_SORT_ORDER_DESC', "Le plus petit apparaitra en premier.");
define('MODULE_PAYMENT_LYRA_ZONE_TITLE', "Zone de paiement");
define('MODULE_PAYMENT_LYRA_ZONE_DESC', "Si une zone est choisie, ce mode de paiement ne sera effectif que pour celle-ci.");
define('MODULE_PAYMENT_LYRA_ALLOWED_TITLE', "Zones autorisées");
define('MODULE_PAYMENT_LYRA_ALLOWED_DESC', "Veuillez entrer chaque zone pour lequel ce module devrait être activé (par exemple: \"UK,DE\"). Si vide, toutes les zones seront autorisées.");

## ADMINISTRATION INTERFACE - PLATFORM SETTINGS ##
define('MODULE_PAYMENT_LYRA_SITE_ID_TITLE', "Identifiant du site");
define('MODULE_PAYMENT_LYRA_SITE_ID_DESC', "Identifiant fourni par votre banque.");
define('MODULE_PAYMENT_LYRA_KEY_TEST_TITLE', "Certificat en mode test");
define('MODULE_PAYMENT_LYRA_KEY_TEST_DESC', "Certificat fourni par Lyra Collect pour le mode test (disponible sur le back-office de votre boutique).");
define('MODULE_PAYMENT_LYRA_KEY_PROD_TITLE', "Certificat en mode production");
define('MODULE_PAYMENT_LYRA_KEY_PROD_DESC', "Certificat fourni par Lyra Collect (disponible sur le back-office de votre boutique après passage en production).");
define('MODULE_PAYMENT_LYRA_CTX_MODE_TITLE', "Mode");
define('MODULE_PAYMENT_LYRA_CTX_MODE_DESC', "Mode de fonctionnement du module.");
define('MODULE_PAYMENT_LYRA_PLATFORM_URL_TITLE', "URL de la plateforme");
define('MODULE_PAYMENT_LYRA_PLATFORM_URL_DESC', "URL vers laquelle le client sera redirigé pour le paiement.");

## ADMINISTRATION INTERFACE - PAYMENT SETTINGS ##
define('MODULE_PAYMENT_LYRA_LANGUAGE_TITLE', "Langue par défaut");
define('MODULE_PAYMENT_LYRA_LANGUAGE_DESC', "Sélectionner la langue par défaut à utiliser sur la page de paiement.");
define('MODULE_PAYMENT_LYRA_AVAILABLE_LANGUAGES_TITLE', "Langues disponibles");
define('MODULE_PAYMENT_LYRA_AVAILABLE_LANGUAGES_DESC', "Langues disponibles sur la page de paiement. Ne rien sélectionner pour utiliser la configuration de la plateforme.");
define('MODULE_PAYMENT_LYRA_CAPTURE_DELAY_TITLE', "Délai avant remise en banque");
define('MODULE_PAYMENT_LYRA_CAPTURE_DELAY_DESC', "Le nombre de jours avant la remise en banque (paramétrable sur votre back-office Lyra Collect).");
define('MODULE_PAYMENT_LYRA_VALIDATION_MODE_TITLE', "Mode de validation");
define('MODULE_PAYMENT_LYRA_VALIDATION_MODE_DESC', "En mode manuel, vous devrez confirmer les paiements dans le back-office de votre boutique.");
define('MODULE_PAYMENT_LYRA_PAYMENT_CARDS_TITLE', "Types de carte");
define('MODULE_PAYMENT_LYRA_PAYMENT_CARDS_DESC', "Le(s) type(s) de carte pouvant être utilisé(s) pour le paiement. Ne rien sélectionner pour utiliser la configuration de la plateforme.");
define('MODULE_PAYMENT_LYRA_3DS_MIN_AMOUNT_TITLE', "Montant minimum pour lequel activer 3DS");
define('MODULE_PAYMENT_LYRA_3DS_MIN_AMOUNT_DESC', "Nécessite la souscription à l'option 3-D Secure sélectif.");

## ADMINISTRATION INTERFACE - AMOUNT RESTRICTIONS SETTINGS ##
define('MODULE_PAYMENT_LYRA_AMOUNT_MIN_TITLE', "Montant minimum");
define('MODULE_PAYMENT_LYRA_AMOUNT_MIN_DESC', "Montant minimum pour lequel cette méthode de paiement est disponible.");
define('MODULE_PAYMENT_LYRA_AMOUNT_MAX_TITLE', "Montant maximum");
define('MODULE_PAYMENT_LYRA_AMOUNT_MAX_DESC', "Montant maximum pour lequel cette méthode de paiement est disponible.");

## ADMINISTRATION INTERFACE - BACK TO STORE SETTINGS ##
define('MODULE_PAYMENT_LYRA_REDIRECT_ENABLED_TITLE', "Redirection automatique");
define('MODULE_PAYMENT_LYRA_REDIRECT_ENABLED_DESC', "Si activée, le client sera redirigé automatiquement vers votre site à la fin du processus de paiement.");
define('MODULE_PAYMENT_LYRA_REDIRECT_SUCCESS_TIMEOUT_TITLE', "Temps avant redirection (succès)");
define('MODULE_PAYMENT_LYRA_REDIRECT_SUCCESS_TIMEOUT_DESC', "Temps en secondes (0-300) avant que le client ne soit redirigé automatiquement vers votre site lorsque le paiement a réussi.");
define('MODULE_PAYMENT_LYRA_REDIRECT_SUCCESS_MESSAGE_TITLE', "Message avant redirection (succès)");
define('MODULE_PAYMENT_LYRA_REDIRECT_SUCCESS_MESSAGE_DESC', "Message affiché sur la plateforme de paiement avant redirection lorsque le paiement a réussi.");
define('MODULE_PAYMENT_LYRA_REDIRECT_ERROR_TIMEOUT_TITLE', "Temps avant redirection (échec)");
define('MODULE_PAYMENT_LYRA_REDIRECT_ERROR_TIMEOUT_DESC', "Temps en secondes (0-300) avant que le client ne soit redirigé automatiquement vers votre site lorsque le paiement a échoué.");
define('MODULE_PAYMENT_LYRA_REDIRECT_ERROR_MESSAGE_TITLE', "Message avant redirection (échec)");
define('MODULE_PAYMENT_LYRA_REDIRECT_ERROR_MESSAGE_DESC', "Message affiché sur la plateforme de paiement avant redirection, lorsque le paiement a échoué.");
define('MODULE_PAYMENT_LYRA_RETURN_MODE_TITLE', "Mode de retour");
define('MODULE_PAYMENT_LYRA_RETURN_MODE_DESC', "Façon dont le client transmettra le résultat du paiement lors de son retour à la boutique.");
define('MODULE_PAYMENT_LYRA_ORDER_STATUS_TITLE', "Statut des commandes");
define('MODULE_PAYMENT_LYRA_ORDER_STATUS_DESC', "Definir le statut des commandes payées par ce mode de paiement.");
