<?php
/**
###COMMON_PHP_FILE_HEADER###
*/

include_once '__vads_common.php';

## CATALOG MESSAGES ##
define('MODULE_PAYMENT___VADS_TEXT_TITLE', "###BANKNAME### - paiement par carte bancaire");

## ADMINISTRATION INTERFACE - MODULE SETTINGS ##
define('MODULE_PAYMENT___VADS_STATUS_TITLE', "État du module");
define('MODULE_PAYMENT___VADS_STATUS_DESC', "Activer / désactiver le module de paiement ###BANKNAME###.");
define('MODULE_PAYMENT___VADS_SORT_ORDER_TITLE', "Ordre d'affichage");
define('MODULE_PAYMENT___VADS_SORT_ORDER_DESC', "Le plus petit apparaitra en premier.");
define('MODULE_PAYMENT___VADS_ZONE_TITLE', "Zone de paiement");
define('MODULE_PAYMENT___VADS_ZONE_DESC', "Si une zone est choisie, ce mode de paiement ne sera effectif que pour celle-ci.");
define('MODULE_PAYMENT___VADS_ALLOWED_TITLE', "Zones autorisées");
define('MODULE_PAYMENT___VADS_ALLOWED_DESC', "Veuillez entrer chaque zone pour lequel ce module devrait être activé (par exemple: \"UK,DE\"). Si vide, toutes les zones seront autorisées.");

## ADMINISTRATION INTERFACE - PLATFORM SETTINGS ##
define('MODULE_PAYMENT___VADS_SITE_ID_TITLE', "Identifiant du site");
define('MODULE_PAYMENT___VADS_SITE_ID_DESC', "Identifiant fourni par votre banque.");
define('MODULE_PAYMENT___VADS_KEY_TEST_TITLE', "Certificat en mode test");
define('MODULE_PAYMENT___VADS_KEY_TEST_DESC', "Certificat fourni par ###BANKNAME### pour le mode test (disponible sur le back-office de votre boutique).");
define('MODULE_PAYMENT___VADS_KEY_PROD_TITLE', "Certificat en mode production");
define('MODULE_PAYMENT___VADS_KEY_PROD_DESC', "Certificat fourni par ###BANKNAME### (disponible sur le back-office de votre boutique après passage en production).");
define('MODULE_PAYMENT___VADS_CTX_MODE_TITLE', "Mode");
define('MODULE_PAYMENT___VADS_CTX_MODE_DESC', "Mode de fonctionnement du module.");
define('MODULE_PAYMENT___VADS_PLATFORM_URL_TITLE', "URL de la plateforme");
define('MODULE_PAYMENT___VADS_PLATFORM_URL_DESC', "URL vers laquelle le client sera redirigé pour le paiement.");

## ADMINISTRATION INTERFACE - PAYMENT SETTINGS ##
define('MODULE_PAYMENT___VADS_LANGUAGE_TITLE', "Langue par défaut");
define('MODULE_PAYMENT___VADS_LANGUAGE_DESC', "Sélectionner la langue par défaut à utiliser sur la page de paiement.");
define('MODULE_PAYMENT___VADS_AVAILABLE_LANGUAGES_TITLE', "Langues disponibles");
define('MODULE_PAYMENT___VADS_AVAILABLE_LANGUAGES_DESC', "Langues disponibles sur la page de paiement. Ne rien sélectionner pour utiliser la configuration de la plateforme.");
define('MODULE_PAYMENT___VADS_CAPTURE_DELAY_TITLE', "Délai avant remise en banque");
define('MODULE_PAYMENT___VADS_CAPTURE_DELAY_DESC', "Le nombre de jours avant la remise en banque (paramétrable sur votre back-office ###BANKNAME###).");
define('MODULE_PAYMENT___VADS_VALIDATION_MODE_TITLE', "Mode de validation");
define('MODULE_PAYMENT___VADS_VALIDATION_MODE_DESC', "En mode manuel, vous devrez confirmer les paiements dans le back-office de votre boutique.");
define('MODULE_PAYMENT___VADS_PAYMENT_CARDS_TITLE', "Types de carte");
define('MODULE_PAYMENT___VADS_PAYMENT_CARDS_DESC', "Le(s) type(s) de carte pouvant être utilisé(s) pour le paiement. Ne rien sélectionner pour utiliser la configuration de la plateforme.");
define('MODULE_PAYMENT___VADS_3DS_MIN_AMOUNT_TITLE', "Montant minimum pour lequel activer 3DS");
define('MODULE_PAYMENT___VADS_3DS_MIN_AMOUNT_DESC', "Nécessite la souscription à l'option 3-D Secure sélectif.");

## ADMINISTRATION INTERFACE - AMOUNT RESTRICTIONS SETTINGS ##
define('MODULE_PAYMENT___VADS_AMOUNT_MIN_TITLE', "Montant minimum");
define('MODULE_PAYMENT___VADS_AMOUNT_MIN_DESC', "Montant minimum pour lequel cette méthode de paiement est disponible.");
define('MODULE_PAYMENT___VADS_AMOUNT_MAX_TITLE', "Montant maximum");
define('MODULE_PAYMENT___VADS_AMOUNT_MAX_DESC', "Montant maximum pour lequel cette méthode de paiement est disponible.");

## ADMINISTRATION INTERFACE - BACK TO STORE SETTINGS ##
define('MODULE_PAYMENT___VADS_REDIRECT_ENABLED_TITLE', "Redirection automatique");
define('MODULE_PAYMENT___VADS_REDIRECT_ENABLED_DESC', "Si activée, le client sera redirigé automatiquement vers votre site à la fin du processus de paiement.");
define('MODULE_PAYMENT___VADS_REDIRECT_SUCCESS_TIMEOUT_TITLE', "Temps avant redirection (succès)");
define('MODULE_PAYMENT___VADS_REDIRECT_SUCCESS_TIMEOUT_DESC', "Temps en secondes (0-300) avant que le client ne soit redirigé automatiquement vers votre site lorsque le paiement a réussi.");
define('MODULE_PAYMENT___VADS_REDIRECT_SUCCESS_MESSAGE_TITLE', "Message avant redirection (succès)");
define('MODULE_PAYMENT___VADS_REDIRECT_SUCCESS_MESSAGE_DESC', "Message affiché sur la plateforme de paiement avant redirection lorsque le paiement a réussi.");
define('MODULE_PAYMENT___VADS_REDIRECT_ERROR_TIMEOUT_TITLE', "Temps avant redirection (échec)");
define('MODULE_PAYMENT___VADS_REDIRECT_ERROR_TIMEOUT_DESC', "Temps en secondes (0-300) avant que le client ne soit redirigé automatiquement vers votre site lorsque le paiement a échoué.");
define('MODULE_PAYMENT___VADS_REDIRECT_ERROR_MESSAGE_TITLE', "Message avant redirection (échec)");
define('MODULE_PAYMENT___VADS_REDIRECT_ERROR_MESSAGE_DESC', "Message affiché sur la plateforme de paiement avant redirection, lorsque le paiement a échoué.");
define('MODULE_PAYMENT___VADS_RETURN_MODE_TITLE', "Mode de retour");
define('MODULE_PAYMENT___VADS_RETURN_MODE_DESC', "Façon dont le client transmettra le résultat du paiement lors de son retour à la boutique.");
define('MODULE_PAYMENT___VADS_ORDER_STATUS_TITLE', "Statut des commandes");
define('MODULE_PAYMENT___VADS_ORDER_STATUS_DESC', "Definir le statut des commandes payées par ce mode de paiement.");

?>