<?php
/**
 * Copyright © Lyra Network.
 * This file is part of Lyra plugin for Gambio. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL v2)
 */

class LyraCheckoutSuccessExtender extends LyraCheckoutSuccessExtender_parent
{
      public function proceed()
    {
        parent::proceed();

        $lyra_messages = '';

        if(isset($_SESSION['lyra_prodfaq_message'])) {
            $lyra_messages .= '<div class="alert alert-success">
                                  <strong>' .
                                       $_SESSION['lyra_prodfaq_message'] .
                                  '</strong>
                              </div>';
            unset($_SESSION['lyra_prodfaq_message']);
        }

        if(isset($_SESSION['lyra_warn_ipn_message']))
        {
            $lyra_messages .= '<div class="alert alert-info">
                                   <strong>' .
                                       $_SESSION['lyra_warn_ipn_message'] .
                                   '</strong>
                               </div>';
            unset($_SESSION['lyra_warn_ipn_message']);
        }

        $this->html_output_array[] = $lyra_messages;

    }
}
