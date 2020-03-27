<?php
/**
 * Copyright © Lyra Network.
 * This file is part of Lyra Collect plugin for Gambio. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL v2)
 */

class Lyra_multiCheckoutSuccessExtender extends Lyra_multiCheckoutSuccessExtender_parent
{
    public function proceed()
    {
        parent::proceed();

        $lyra_multi_messages = '';

        if (isset($_SESSION['lyra_multi_prodfaq_message'])) {
            $lyra_multi_messages .= '<div class="alert alert-success">
                                        <strong>'
                                            . $_SESSION['lyra_multi_prodfaq_message'] .
                                        '</strong>
                                    </div>';
            unset($_SESSION['lyra_multi_prodfaq_message']);
        }

        if (isset($_SESSION['lyra_multi_warn_ipn_message'])) {
            $lyra_multi_messages .= '<div class="alert alert-info">
                                        <strong>'
                                            . $_SESSION['lyra_multi_warn_ipn_message'] .
                                        '</strong>
                                    </div>';
            unset($_SESSION['lyra_multi_warn_ipn_message']);
        }

        $this->html_output_array[] = $lyra_multi_messages;
    }
}
