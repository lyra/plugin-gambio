<?php
/**
 * Copyright © Lyra Network.
 * This file is part of Lyra plugin for Gambio. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL v2)
 */

/**
 * This file is an access point for the Lyra Collect payment gateway to validate an order.
 */

// restore session if this is a server call.
if(key_exists('vads_hash', $_POST) && isset($_POST['vads_hash']) && key_exists('vads_result', $_POST) && isset($_POST['vads_result'])) {
    $osCsid = substr($_POST['vads_order_info'], strlen('session_id='));
    $_POST['osCsid'] = $osCsid;
    $_GET['osCsid'] = $osCsid;

    // for cookie based sessions ...
    $_COOKIE['osCsid'] = $osCsid;
    $_COOKIE['cookie_test'] = 'please_accept_for_session';
}

require_once 'checkout_process.php';
