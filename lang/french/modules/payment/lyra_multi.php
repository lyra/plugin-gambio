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

define('MODULE_PAYMENT_LYRA_MULTI_TEXT_TITLE', "Lyra Collect - Paiement en plusieurs fois");
//define('MODULE_PAYMENT_LYRA_MULTI_SHORT_TITLE', "Lyra Collect - paiement en plusieurs fois");

// ## ADMINISTRATION INTERFACE - MODULE SETTINGS ##
define('MODULE_PAYMENT_LYRA_MULTI_STATUS_TITLE', "État du module");
define('MODULE_PAYMENT_LYRA_MULTI_STATUS_DESC', "Active / désactive cette méthode de paiement.");
define('MODULE_PAYMENT_LYRA_MULTI_SORT_ORDER_TITLE', "Ordre d'affichage");
define('MODULE_PAYMENT_LYRA_MULTI_SORT_ORDER_DESC', "Le plus petit apparaitra en premier.");
define('MODULE_PAYMENT_LYRA_MULTI_ZONE_TITLE', "Zone de paiement");
define('MODULE_PAYMENT_LYRA_MULTI_ZONE_DESC', "Si une zone est choisie, ce mode de paiement ne sera effectif que pour celle-ci.");
define('MODULE_PAYMENT_LYRA_MULTI_ALLOWED_TITLE', "Zones autorisées");
define('MODULE_PAYMENT_LYRA_MULTI_ALLOWED_DESC', "Veuillez entrer chaque zone pour lequel ce module devrait être activé (par exemple: \"UK,DE\"). Si vide, toutes les zones seront autorisées.");

## ADMINISTRATION INTERFACE - PLATFORM SETTINGS ##
define('MODULE_PAYMENT_LYRA_MULTI_SITE_ID_TITLE', "Identifiant boutique");
define('MODULE_PAYMENT_LYRA_MULTI_SITE_ID_DESC', "L'identifiant fourni par Lyra Collect");
define('MODULE_PAYMENT_LYRA_MULTI_KEY_TEST_TITLE', "Clé en mode test");
define('MODULE_PAYMENT_LYRA_MULTI_KEY_TEST_DESC', "Clé fournie par Lyra Collect pour le mode test (disponible sur le Back Office Lyra Expert).");
define('MODULE_PAYMENT_LYRA_MULTI_KEY_PROD_TITLE', "Clé en mode production");
define('MODULE_PAYMENT_LYRA_MULTI_KEY_PROD_DESC', "Clé fournie par Lyra Collect (disponible sur le Back Office Lyra Expert après passage en production).");
define('MODULE_PAYMENT_LYRA_MULTI_CTX_MODE_TITLE', "Mode");
define('MODULE_PAYMENT_LYRA_MULTI_CTX_MODE_DESC', "Mode de fonctionnement du module.");
define('MODULE_PAYMENT_LYRA_MULTI_SIGN_ALGO_TITLE', "Algorithme de signature");
define('MODULE_PAYMENT_LYRA_SIGN_ALGO_DESC', "Algorithme utilisé pour calculer la signature du formulaire de paiement. L'algorithme sélectionné doit être le même que celui configuré sur le Back Office Lyra Expert.");
define('MODULE_PAYMENT_LYRA_MULTI_PLATFORM_URL_TITLE', "URL de la page de paiement");
define('MODULE_PAYMENT_LYRA_MULTI_PLATFORM_URL_DESC', "URL vers laquelle l'acheteur sera redirigé pour le paiement.");

## ADMINISTRATION INTERFACE - PAYMENT SETTINGS ##
define('MODULE_PAYMENT_LYRA_MULTI_LANGUAGE_TITLE', "Langue par défaut");
define('MODULE_PAYMENT_LYRA_MULTI_LANGUAGE_DESC', "Sélectionner la langue par défaut à utiliser sur la page de paiement.");
define('MODULE_PAYMENT_LYRA_MULTI_AVAILABLE_LANGUAGES_TITLE', "Langues disponibles");
define('MODULE_PAYMENT_LYRA_MULTI_AVAILABLE_LANGUAGES_DESC', "Sélectionner les langues à proposer sur la page de paiement. Ne rien sélectionner pour utiliser la configuration de la plateforme.");
define('MODULE_PAYMENT_LYRA_MULTI_CAPTURE_DELAY_TITLE', "Délai avant remise en banque");
define('MODULE_PAYMENT_LYRA_MULTI_CAPTURE_DELAY_DESC', "Le nombre de jours avant la remise en banque (paramétrable sur votre Back Office Lyra Expert).");
define('MODULE_PAYMENT_LYRA_MULTI_VALIDATION_MODE_TITLE', "Mode de validation");
define('MODULE_PAYMENT_LYRA_MULTI_VALIDATION_MODE_DESC', "En mode manuel, vous devrez confirmer les paiements dans le Back Office Lyra Expert.");
define('MODULE_PAYMENT_LYRA_MULTI_PAYMENT_CARDS_TITLE', "Types de carte");
define('MODULE_PAYMENT_LYRA_MULTI_PAYMENT_CARDS_DESC', "Le(s) type(s) de carte pouvant être utilisé(s) pour le paiement. Ne rien sélectionner pour utiliser la configuration de la plateforme.");
define('MODULE_PAYMENT_LYRA_MULTI_3DS_MIN_AMOUNT_TITLE', "Désactiver 3DS");
define('MODULE_PAYMENT_LYRA_MULTI_3DS_MIN_AMOUNT_DESC', "Montant en dessous duquel 3DS sera désactivé. Nécessite la souscription à l'option 3DS sélectif. Pour plus d'informations, reportez-vous à la documentation du module.");

## ADMINISTRATION INTERFACE - AMOUNT RESTRICTIONS SETTINGS ##
define('MODULE_PAYMENT_LYRA_MULTI_AMOUNT_MIN_TITLE', "Montant minimum");
define('MODULE_PAYMENT_LYRA_MULTI_AMOUNT_MIN_DESC', "Montant minimum pour lequel cette méthode de paiement est disponible.");
define('MODULE_PAYMENT_LYRA_MULTI_AMOUNT_MAX_TITLE', "Montant maximum");
define('MODULE_PAYMENT_LYRA_MULTI_AMOUNT_MAX_DESC', "Montant maximum pour lequel cette méthode de paiement est disponible.");

## ADMINISTRATION INTERFACE - BACK TO STORE SETTINGS ##
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_ENABLED_TITLE', "Redirection automatique");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_ENABLED_DESC', "Si activée, l'acheteur sera redirigé automatiquement vers votre site à la fin du paiement.");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_SUCCESS_TIMEOUT_TITLE', "Temps avant redirection (succès)");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_SUCCESS_TIMEOUT_DESC', "Temps en secondes (0-300) avant que l'acheteur ne soit redirigé automatiquement vers votre site lorsque le paiement a réussi");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_SUCCESS_MESSAGE_TITLE', "Message avant redirection (succès)");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_SUCCESS_MESSAGE_DESC', "Message affiché sur la page de paiement avant redirection lorsque le paiement a réussi.");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_ERROR_TIMEOUT_TITLE', "Temps avant redirection (échec)");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_ERROR_TIMEOUT_DESC', "Temps en secondes (0-300) avant que l'acheteur ne soit redirigé automatiquement vers votre site lorsque le paiement a échoué");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_ERROR_MESSAGE_TITLE', "Message avant redirection (échec)");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_ERROR_MESSAGE_DESC', "Message affiché sur la page de paiement avant redirection, lorsque le paiement a échoué.");
define('MODULE_PAYMENT_LYRA_MULTI_RETURN_MODE_TITLE', "Mode de retour");
define('MODULE_PAYMENT_LYRA_MULTI_RETURN_MODE_DESC', "Façon dont l'acheteur transmettra le résultat du paiement lors de son retour à la boutique.");
define('MODULE_PAYMENT_LYRA_MULTI_ORDER_STATUS_TITLE', "Statut des commandes");
define('MODULE_PAYMENT_LYRA_MULTI_ORDER_STATUS_DESC', "Définir le statut des commandes payées par ce mode de paiement.");

## ADMINISTRATION INTERFACE - MISC CONSTANTS ##
define('MODULE_PAYMENT_LYRA_MULTI_VALUE_False', "Désactivé");
define('MODULE_PAYMENT_LYRA_MULTI_VALUE_True', "Activé");

## ADMINISTRATION INTERFACE - MULTI PAYMENT SETTINGS ##
define('MODULE_PAYMENT_LYRA_OPTIONS_TITLE', "Options de paiement");
define('MODULE_PAYMENT_LYRA_OPTIONS_DESC', "Cliquer sur le bouton \"Ajouter\" pour configurer une ou plusieurs options de paiement. <br /><b>Libellé : </b>Texte décrivant l'option de paiement multiple. <br /><b>Montant min : </b>Montant minimum pour proposer l'option. <br /><b>Montant max : </b>Montant maximum pour proposer l'option. <br /><b>Nombre : </b>Nombre total d'échéances. <br /><b>Période : </b>Délai entre deux échéances (en jours). <br /><b>1er paiement : </b>Montant de la première échéance en pourcentage du total. Si vide, toutes les échéances auront le même montant.<br /><b>N'oubliez pas de cliquer sur le bouton \"Mise à jour\" afin de sauvegarder vos modifications.</b>");
define('MODULE_PAYMENT_LYRA_OPTIONS_LABEL', "Libellé");
define('MODULE_PAYMENT_LYRA_OPTIONS_MIN_AMOUNT', "Montant min");
define('MODULE_PAYMENT_LYRA_OPTIONS_MAX_AMOUNT', "Montant max");
define('MODULE_PAYMENT_LYRA_OPTIONS_CONTRACT', "Contrat");
define('MODULE_PAYMENT_LYRA_OPTIONS_COUNT', "Nombre");
define('MODULE_PAYMENT_LYRA_OPTIONS_PERIOD', "Période");
define('MODULE_PAYMENT_LYRA_OPTIONS_FIRST', "1er paiement");
define('MODULE_PAYMENT_LYRA_OPTIONS_ADD', "Ajouter");
define('MODULE_PAYMENT_LYRA_OPTIONS_DELETE', "Supprimer");
