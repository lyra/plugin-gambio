<?php
/**
 * Copyright © Lyra Network.
 * This file is part of Lyra plugin for Gambio. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL v2)
 */

class lyra_tools
{
    private static $GATEWAY_CODE = 'Lyra';
    private static $GATEWAY_NAME = 'Lyra Collect';
    private static $BACKOFFICE_NAME = 'Lyra Expert';
    private static $GATEWAY_URL = 'https://secure.lyra.com/vads-payment/';
    private static $SITE_ID = '12345678';
    private static $KEY_TEST = '1111111111111111';
    private static $KEY_PROD = '2222222222222222';
    private static $CTX_MODE = 'TEST';
    private static $SIGN_ALGO = 'SHA-256';
    private static $LANGUAGE = 'en';
    private static $SUPPORT_EMAIL = 'support-ecommerce@lyra-collect.com';

    private static $CMS_IDENTIFIER = 'Gambio_3.x';
    private static $PLUGIN_VERSION = '2.0.0';
    private static $GATEWAY_VERSION = 'V2';

    public static function getDefault($name)
    {
        if (! is_string($name)) {
            return '';
        }

        if (! isset(self::$$name)) {
            return '';
        }

        return self::$$name;
    }
}