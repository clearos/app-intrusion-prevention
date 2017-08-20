<?php

/**
 * Intrusion prevention block details view.
 *
 * @category   apps
 * @package    intrusion-prevention
 * @subpackage views
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
// Load dependencies
///////////////////////////////////////////////////////////////////////////////

$this->lang->load('intrusion_prevention');
$this->lang->load('network');

///////////////////////////////////////////////////////////////////////////////
// Form open
///////////////////////////////////////////////////////////////////////////////

echo form_open('/intrusion_prevention');
echo form_header(lang('intrusion_prevention_details'));

///////////////////////////////////////////////////////////////////////////////
// Form fields
///////////////////////////////////////////////////////////////////////////////

echo field_banner("<h3><b>{$details['desc']}</b></h3>");

echo field_banner(sprintf('<div>%s: <strong>%s</strong></div>',
    lang('intrusion_prevention_source_address'), $ip));
echo field_banner(sprintf('<div>%s: %sr%s (%s)</div>',
    lang('intrusion_prevention_security_id'), $details['sid'],
    $details['rev'], $details['classtype']));

echo field_banner('&nbsp;');

$refid = 1;
foreach ($details['ref'] as $ref) {
    echo field_banner(sprintf('Reference %d:', $refid++));
    echo field_banner(sprintf(
        '<div style="padding-left: 8px">' .
        '<a href="%s" target="_blank">%s</a></div>', $ref, $ref));
    echo field_banner('&nbsp;');
}
if ($refid != 1) {
    echo field_banner(sprintf('<div>%s</div>',
        lang('intrusion_prevention_reference_warning')));
    echo field_banner('&nbsp;');
}

echo field_button_set(
    array(
        anchor_custom('/app/intrusion_prevention/blocked_list/exempt/' . $ip,
            lang('intrusion_prevention_white_list'), 'high'),
        anchor_delete('/app/intrusion_prevention/blocked_list/delete/' . $ip),
        anchor_cancel('/app/intrusion_prevention')
    )
);

///////////////////////////////////////////////////////////////////////////////
// Form close
///////////////////////////////////////////////////////////////////////////////

echo form_footer();
echo form_close();

// vi: expandtab shiftwidth=4 softtabstop=4 tabstop=4
