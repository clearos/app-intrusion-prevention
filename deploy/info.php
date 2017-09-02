<?php

/////////////////////////////////////////////////////////////////////////////
// General information
/////////////////////////////////////////////////////////////////////////////

$app['basename'] = 'intrusion_prevention';
$app['version'] = '2.4.0';
$app['release'] = '1';
$app['vendor'] = 'ClearFoundation';
$app['packager'] = 'ClearFoundation';
$app['license'] = 'GPLv3';
$app['license_core'] = 'LGPLv3';
$app['description'] = lang('intrusion_prevention_app_description');

/////////////////////////////////////////////////////////////////////////////
// App name and categories
/////////////////////////////////////////////////////////////////////////////

$app['name'] = lang('intrusion_prevention_app_name');
$app['category'] = lang('base_category_gateway');
$app['subcategory'] = lang('base_subcategory_intrusion_protection');

/////////////////////////////////////////////////////////////////////////////
// Controllers
/////////////////////////////////////////////////////////////////////////////

$app['controllers']['blocked_list']['title'] = lang('intrusion_prevention_blocked_list');
$app['controllers']['white_list']['title'] = lang('intrusion_prevention_white_list');

/////////////////////////////////////////////////////////////////////////////
// Packaging
/////////////////////////////////////////////////////////////////////////////

$app['requires'] = array(
    'app-intrusion-detection >= 2.1.7',
    'app-network',
);

$app['core_requires'] = array(
    'app-network-core >= 1:1.4.70',
    'app-intrusion-detection-core >= 1:2.1.7',
    'snort >= 2.9.6.2-8',
    'app-firewall-core >= 1:2.4.0',
);

$app['core_file_manifest'] = array(
    'snortsam.php'=> array('target' => '/var/clearos/base/daemon/snortsam.php'),
    'intrusion_prevention.conf'=> array(
        'target' => '/etc/clearos/intrusion_prevention.conf',
        'config' => TRUE,
        'config_params' => 'noreplace',
    ),
    'webconfig-whitelist.conf' => array(
        'target' => '/etc/snortsam.d/webconfig-whitelist.conf',
        'mode' => '0644',
        'config' => TRUE,
        'config_params' => 'noreplace',
    ),
);

$app['core_directory_manifest'] = array(
    '/var/clearos/intrusion_prevention' => array(),
    '/var/clearos/intrusion_prevention/backup' => array(),
);

$app['delete_dependency'] = array(
    'app-intrusion-prevention-core',
);
