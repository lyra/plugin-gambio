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
define('MODULE_PAYMENT_LYRA_MULTI_TEXT_TITLE', "Lyra Collect - Pago en cuotas");
define('MODULE_PAYMENT_LYRA_MULTI_SHORT_TITLE', "Pago con tarjeta de crédito en cuotas");

## ADMINISTRATION INTERFACE - MODULE SETTINGS ##
define('MODULE_PAYMENT_LYRA_MULTI_STATUS_TITLE', "Activación");
define('MODULE_PAYMENT_LYRA_MULTI_STATUS_DESC', "Habilita/deshabilita este método de pago.");
define('MODULE_PAYMENT_LYRA_MULTI_SORT_ORDER_TITLE', "Orden de visualización");
define('MODULE_PAYMENT_LYRA_MULTI_SORT_ORDER_DESC', "Orden de visualización. El más pequeño aparece primero.");
define('MODULE_PAYMENT_LYRA_MULTI_ZONE_TITLE', "Área de pago");
define('MODULE_PAYMENT_LYRA_MULTI_ZONE_DESC', "Si se selecciona un área, este modo de pago solo estará disponible para ella.");
define('MODULE_PAYMENT_LYRA_MULTI_ALLOWED_TITLE', "Zonas permitidas");
define('MODULE_PAYMENT_LYRA_MULTI_ALLOWED_DESC', "Ingrese cada zona para la cual este módulo debe estar habilitado (por ejemplo, \"UK, DE \"). Si se deja vacío, todas las zonas están permitidas.");

## ADMINISTRATION INTERFACE - PLATFORM SETTINGS ##
define('MODULE_PAYMENT_LYRA_MULTI_SITE_ID_TITLE', "Identificador de tienda");
define('MODULE_PAYMENT_LYRA_MULTI_SITE_ID_DESC', "El identificador proporcionado por Lyra Collect.");
define('MODULE_PAYMENT_LYRA_MULTI_KEY_TEST_TITLE', "Clave en modo test");
define('MODULE_PAYMENT_LYRA_MULTI_KEY_TEST_DESC', "Clave proporcionada por Lyra Collect para modo test (disponible en el Back Office Lyra Expert).");
define('MODULE_PAYMENT_LYRA_MULTI_KEY_PROD_TITLE', "Clave en modo production");
define('MODULE_PAYMENT_LYRA_MULTI_KEY_PROD_DESC', "Clave proporcionada por Lyra Collect (disponible en el Back Office Lyra Expert después de habilitar el modo production).");
define('MODULE_PAYMENT_LYRA_MULTI_CTX_MODE_TITLE', "Modo");
define('MODULE_PAYMENT_LYRA_MULTI_CTX_MODE_DESC', "El modo de contexto de este módulo.");
define('MODULE_PAYMENT_LYRA_MULTI_SIGN_ALGO_TITLE', "Algoritmo de firma");
define('MODULE_PAYMENT_LYRA_MULTI_SIGN_ALGO_DESC', "Algoritmo usado para calcular la firma del formulario de pago. El algoritmo seleccionado debe ser el mismo que el configurado en el Back Office Lyra Expert." . (! lyra_tools::$lyra_plugin_features['shatwo'] ? "<br /><b>El algoritmo HMAC-SHA-256 no se debe activar si aún no está disponible en el Back Office Lyra Expert, la función estará disponible pronto.</b>" : ''));
define('MODULE_PAYMENT_LYRA_MULTI_PLATFORM_URL_TITLE', "URL de página de pago");
define('MODULE_PAYMENT_LYRA_MULTI_PLATFORM_URL_DESC', "Enlace a la página de pago.");

## ADMINISTRATION INTERFACE - PAYMENT SETTINGS ##
define('MODULE_PAYMENT_LYRA_MULTI_LANGUAGE_TITLE', "Idioma por defecto");
define('MODULE_PAYMENT_LYRA_MULTI_LANGUAGE_DESC', "Idioma por defecto en la página de pago.");
define('MODULE_PAYMENT_LYRA_MULTI_AVAILABLE_LANGUAGES_TITLE', "Idiomas disponibles");
define('MODULE_PAYMENT_LYRA_MULTI_AVAILABLE_LANGUAGES_DESC', "Idiomas disponibles en la página de pago. Si no selecciona ninguno, todos los idiomas compatibles estarán disponibles.");
define('MODULE_PAYMENT_LYRA_MULTI_CAPTURE_DELAY_TITLE', "Plazo de captura");
define('MODULE_PAYMENT_LYRA_MULTI_CAPTURE_DELAY_DESC', "El número de días antes de la captura del pago (ajustable en su Back Office Lyra Expert).");
define('MODULE_PAYMENT_LYRA_MULTI_VALIDATION_MODE_TITLE', "Modo de validación");
define('MODULE_PAYMENT_LYRA_MULTI_VALIDATION_MODE_DESC', "Si se selecciona manual, deberá confirmar los pagos manualmente en su Back Office Lyra Expert.");
define('MODULE_PAYMENT_LYRA_MULTI_PAYMENT_CARDS_TITLE', "Tipos de tarjeta");
define('MODULE_PAYMENT_LYRA_MULTI_PAYMENT_CARDS_DESC', "El tipo(s) de tarjeta que se puede usar para el pago. No haga ninguna selección para usar la configuración del portal.");
define('MODULE_PAYMENT_LYRA_MULTI_3DS_MIN_AMOUNT_TITLE', "Deshabilitar 3DS");
define('MODULE_PAYMENT_LYRA_MULTI_3DS_MIN_AMOUNT_DESC', "Monto por debajo del cual se deshabilitará 3DS. Requiere suscripción a la opción 3DS selectivo. Para más información, consulte la documentación del módulo.");

## ADMINISTRATION INTERFACE - AMOUNT RESTRICTIONS SETTINGS ##
define('MODULE_PAYMENT_LYRA_MULTI_AMOUNT_MIN_TITLE', "Monto mínimo");
define('MODULE_PAYMENT_LYRA_MULTI_AMOUNT_MIN_DESC', "Monto mínimo para activar este método de pago.");
define('MODULE_PAYMENT_LYRA_MULTI_AMOUNT_MAX_TITLE', "Monto máximo");
define('MODULE_PAYMENT_LYRA_MULTI_AMOUNT_MAX_DESC', "Monto máximo para activar este método de pago.");

## ADMINISTRATION INTERFACE - BACK TO STORE SETTINGS ##
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_ENABLED_TITLE', "Redirección automática");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_ENABLED_DESC', "Si está habilitada, el comprador es redirigido automáticamente a su sitio al final del pago.");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_SUCCESS_TIMEOUT_TITLE', "Tiempo de espera de la redirección en pago exitoso");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_SUCCESS_TIMEOUT_DESC', "Tiempo en segundos (0-300) antes de que el comprador sea redirigido automáticamente a su sitio web después de un pago exitoso.");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_SUCCESS_MESSAGE_TITLE', "Mensaje de redirección en pago exitoso");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_SUCCESS_MESSAGE_DESC', "Mensaje mostrado en la página de pago antes de la redirección después de un pago exitoso.");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_ERROR_TIMEOUT_TITLE', "Tiempo de espera de la redirección en pago rechazado");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_ERROR_TIMEOUT_DESC', "Tiempo en segundos (0-300) antes de que el comprador sea redirigido automáticamente a su sitio web después de un pago rechazado.");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_ERROR_MESSAGE_TITLE', "Mensaje de redirección en pago rechazado");
define('MODULE_PAYMENT_LYRA_MULTI_REDIRECT_ERROR_MESSAGE_DESC', "Mensaje mostrado en la página de pago antes de la redirección después de un pago rechazado.");
define('MODULE_PAYMENT_LYRA_MULTI_RETURN_MODE_TITLE', "Modo de retorno");
define('MODULE_PAYMENT_LYRA_MULTI_RETURN_MODE_DESC', "Método que se usará para transmitir el resultado del pago de la página de pago a su tienda.");
define('MODULE_PAYMENT_LYRA_MULTI_ORDER_STATUS_TITLE', "Order Status");
define('MODULE_PAYMENT_LYRA_MULTI_ORDER_STATUS_DESC', "Defines the status of orders paid with this payment mode.");

## ADMINISTRATION INTERFACE - MISC CONSTANTS ##
define('MODULE_PAYMENT_LYRA_MULTI_VALUE_False', "Deshabilitado");
define('MODULE_PAYMENT_LYRA_MULTI_VALUE_True', "Habilitado");

define('MODULE_PAYMENT_LYRA_MULTI_VALIDATION_DEFAULT', "Configuración del Back Office Lyra Expert");
define('MODULE_PAYMENT_LYRA_MULTI_VALIDATION_0', "Automático");
define('MODULE_PAYMENT_LYRA_MULTI_VALIDATION_1', "Manual");

## ADMINISTRATION INTERFACE - MULTI PAYMENT SETTINGS ##
define('MODULE_PAYMENT_LYRA_MULTI_OPTIONS_TITLE', "Opciones de pago");
define('MODULE_PAYMENT_LYRA_MULTI_OPTIONS_DESC', "Haga clic en el botón \"Agregar\" para configurar una o más opciones de pago.<br /><b>Etiqueta:</b> La etiqueta de opción a mostrar en el frontend.<br /><b>Monto mínimo:</b> Monto mínimo para habilitar la opción de pago.<br /><b>Monto máximo:</b> Monto máximo para habilitar la opción de pago.<b>Afiliación:</b> ID de la afiliación a usar con la opción.<br /><b>Conteo:</b> Número total de vencimientos.<br /><b>Periodo:</b> Plazo (en días) entre vencimientos.<br /><b>Primer vencimiento:</b> Monto del primer vencimiento, en porcentaje del monto total. Si está vacío, todos los vencimientos tendrán el mismo monto.<br /><b>No olvide hacer clic en el botón \"Actualizar\" para guardar sus modificaciones.</b>");
define('MODULE_PAYMENT_LYRA_MULTI_OPTIONS_LABEL', "Etiqueta");
define('MODULE_PAYMENT_LYRA_MULTI_OPTIONS_MIN_AMOUNT', "Monto mínimo");
define('MODULE_PAYMENT_LYRA_MULTI_OPTIONS_MAX_AMOUNT', "Monto máximo");
define('MODULE_PAYMENT_LYRA_MULTI_OPTIONS_CONTRACT', "Afiliación");
define('MODULE_PAYMENT_LYRA_MULTI_OPTIONS_COUNT', "Conteo");
define('MODULE_PAYMENT_LYRA_MULTI_OPTIONS_PERIOD', "Periodo");
define('MODULE_PAYMENT_LYRA_MULTI_OPTIONS_FIRST', "Primer vencimiento");
define('MODULE_PAYMENT_LYRA_MULTI_OPTIONS_ADD', "Agregar");
define('MODULE_PAYMENT_LYRA_MULTI_OPTIONS_DELETE', "Eliminar");

define('MODULE_PAYMENT_LYRA_MULTI_WARNING', "ATENCIÓN: La activación de la función de pago en cuotas está sujeta al acuerdo previo de Societé Générale.<br />Si habilita esta función cuando no tiene la opción asociada, ocurrirá un error 10000 – INSTALLMENTS_NOT_ALLOWED o 07 - PAYMENT_CONFIG y el comprador no podrá pagar.");
