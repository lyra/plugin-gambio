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
define('MODULE_PAYMENT_LYRA_TECHNICAL_ERROR', "Ocurrió un error en el proceso de pago.");
define('MODULE_PAYMENT_LYRA_PAYMENT_ERROR', "Su pago no fue aceptado. Intente realizar de nuevo el pedido.");
define('MODULE_PAYMENT_LYRA_CHECK_URL_WARN', "La validación automática no ha funcionado. ¿Configuró correctamente la URL de notificación en su Back Office Lyra Expert?");
define('MODULE_PAYMENT_LYRA_CHECK_URL_WARN_DETAIL', "Para entender el problema, lea la documentación del módulo:<br />&nbsp;&nbsp;&nbsp;- Capítulo « Leer detenidamente antes de continuar »<br />&nbsp;&nbsp;&nbsp;- Capítulo « Configuración de la URL de notificación »");
define('MODULE_PAYMENT_LYRA_GOING_INTO_PROD_INFO', "<p><u>IR A PRODUCTION</u></p>Si desea saber cómo poner su tienda en modo production, lea los capítulos « Proceder a la fase de prueba » y « Paso de una tienda al modo producción » en la documentación del módulo.");
define('MODULE_PAYMENT_LYRA_REDIRECT_MESSAGE', 'Redirección a la tienda en unos momentos...');

## ADMINISTRATION INTERFACE - INFORMATIONS ##
define('MODULE_PAYMENT_LYRA_MODULE_INFORMATION', "INFORMACIÓN DEL MÓDULO");
define('MODULE_PAYMENT_LYRA_DEVELOPED_BY', "Desarrollado por");
define('MODULE_PAYMENT_LYRA_CONTACT_EMAIL', "Contáctenos");
define('MODULE_PAYMENT_LYRA_PLUGIN_VERSION', "Versión del módulo");
define('MODULE_PAYMENT_LYRA_GATEWAY_VERSION', "Versión del portal");
define('MODULE_PAYMENT_LYRA_CHECK_URL', "URL de notificación");
define('MODULE_PAYMENT_LYRA_CHECK_URL_DESC', "URL a copiar en el Back Office Lyra Expert > Configuración > Reglas de notificación.");

## ADMINISTRATION INTERFACE - MISC CONSTANTS ##
define('MODULE_PAYMENT_LYRA_LANGUAGE_FRENCH', "Francés");
define('MODULE_PAYMENT_LYRA_LANGUAGE_GERMAN', "Alemán");
define('MODULE_PAYMENT_LYRA_LANGUAGE_ENGLISH', "Inglés");
define('MODULE_PAYMENT_LYRA_LANGUAGE_SPANISH', "Español");
define('MODULE_PAYMENT_LYRA_LANGUAGE_CHINESE', "Chino");
define('MODULE_PAYMENT_LYRA_LANGUAGE_ITALIAN', "Italiano");
define('MODULE_PAYMENT_LYRA_LANGUAGE_JAPANESE', "Japonés");
define('MODULE_PAYMENT_LYRA_LANGUAGE_PORTUGUESE', "Portugués");
define('MODULE_PAYMENT_LYRA_LANGUAGE_DUTCH', "Holandés");
define('MODULE_PAYMENT_LYRA_LANGUAGE_SWEDISH', "Sueco");
define('MODULE_PAYMENT_LYRA_LANGUAGE_RUSSIAN', "Ruso");
define('MODULE_PAYMENT_LYRA_LANGUAGE_POLISH', "Polaco");
define('MODULE_PAYMENT_LYRA_LANGUAGE_TURKISH', "Turco");

define('MODULE_PAYMENT_LYRA_VALUE_False', "Deshabilitado");
define('MODULE_PAYMENT_LYRA_VALUE_True', "Habilitado");

define('MODULE_PAYMENT_LYRA_VALIDATION_DEFAULT', "Configuración del Back Office Lyra Expert");
define('MODULE_PAYMENT_LYRA_VALIDATION_0', "Automático");
define('MODULE_PAYMENT_LYRA_VALIDATION_1', "Manual");
