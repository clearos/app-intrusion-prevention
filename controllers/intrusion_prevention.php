<?php

/**
 * Intrusion prevention controller.
 *
 * @category   apps
 * @package    intrusion-prevention
 * @subpackage controllers
 * @author     ClearFoundation <developer@clearfoundation.com>
 * @copyright  2011 ClearFoundation
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       http://www.clearfoundation.com/docs/developer/apps/intrusion_prevention/
 */

///////////////////////////////////////////////////////////////////////////////
//
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.
//
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
// C L A S S
///////////////////////////////////////////////////////////////////////////////

/**
 * Intrusion prevention controller.
 *
 * @category   apps
 * @package    intrusion-prevention
 * @subpackage controllers
 * @author     ClearFoundation <developer@clearfoundation.com>
 * @copyright  2011 ClearFoundation
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       http://www.clearfoundation.com/docs/developer/apps/intrusion_prevention/
 */

class Intrusion_Prevention extends ClearOS_Controller
{
    /**
     * Intrusion prevention server overview.
     *
     * @return view
     */

    function index()
    {
        // Load libraries
        //---------------

        $this->lang->load('intrusion_prevention');

        // Load views
        //-----------

        $views = array(
            'intrusion_prevention/server',
            'intrusion_prevention/white_list',
            'intrusion_prevention/blocked_list'
        );

        $this->page->view_forms($views, lang('intrusion_prevention_app_name'));
    }

    /**
     * Block details controller
     *
     * @return view
     */

    function block_details($ipsid)
    {
        // Load libraries
        //---------------

        $this->load->library('intrusion_detection/Snort');
        $this->load->library('intrusion_prevention/SnortSam');
        $this->lang->load('intrusion_prevention');
        $this->lang->load('intrusion_detection');

        // Load view data
        //---------------

        list($sid, $ip) = explode(':', $ipsid, 2);

        try {
            $data['ip'] = $ip;
            $data['details'] = $this->snort->get_rule_details($sid);
        } catch (Exception $e) {
            $this->page->view_exception($e);
            return;
        }

        // Load views
        //-----------

        $this->page->view_form('block_details',
            $data, lang('intrusion_prevention_details'));
    }
}

// vi: expandtab shiftwidth=4 softtabstop=4 tabstop=4
