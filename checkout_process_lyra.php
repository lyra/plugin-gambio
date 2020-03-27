<?php
/**
 * Copyright © Lyra Network.
 * This file is part of Lyra Collect plugin for Gambio. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL v2)
 */

/**
 * This file is an access point for the Lyra Collect payment gateway to validate an order.
 */

// Restore session if this is a server call.
if (key_exists('vads_hash', $_POST) && isset($_POST['vads_hash']) && key_exists( 'vads_result', $_POST) && isset($_POST['vads_result'])) {
    global $fromServer;
    $fromServer = $_POST['vads_hash'];

    $parts = explode('&', $_POST['vads_order_info']);
    $session_id = substr($parts[0], strlen('session_id='));
    $use_cookies = substr($parts[1], strlen('use_cookies='));
    $session_cache_limiter = substr($parts[2], strlen('session_cache_limiter='));

    session_id($session_id);
    ini_set('session.use_cookies', $use_cookies);
    session_cache_limiter($session_cache_limiter);
}

require_once 'checkout_process.php';
