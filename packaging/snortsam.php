<?php

///////////////////////////////////////////////////////////////////////////////
// B O O T S T R A P
///////////////////////////////////////////////////////////////////////////////

$bootstrap = getenv('CLEAROS_BOOTSTRAP') ? getenv('CLEAROS_BOOTSTRAP') : '/usr/clearos/framework/shared';
require_once $bootstrap . '/bootstrap.php';

///////////////////////////////////////////////////////////////////////////////
// T R A N S L A T I O N S
///////////////////////////////////////////////////////////////////////////////

clearos_load_language('intrusion_prevention');

///////////////////////////////////////////////////////////////////////////////
// C O N F I G L E T
///////////////////////////////////////////////////////////////////////////////
// pid_file does not exist for snortsam

$configlet = array(
	'title' => lang('intrusion_prevention_app_name'),
	'package' => 'snort',
	'process_name' => 'snortsam',
	'reloadable' => TRUE,
	'url' => '/app/intrusion_prevention'
);
