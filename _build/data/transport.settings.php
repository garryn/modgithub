<?php
/**
 * System Settings for modGitHub
 *
 * @package modgithub
 * @subpackage build
 */
$settings = array();
$settings['mgh.user']= $modx->newObject('modSystemSetting');
$settings['mgh.user']->fromArray(array(
    'key' => 'mgh.user',
    'value' => '',
    'xtype' => 'textfield',
    'namespace' => 'modgithub',
    'area' => 'Authentication',
),'',true,true);

$settings['mgh.api_token']= $modx->newObject('modSystemSetting');
$settings['mgh.api_token']->fromArray(array(
    'key' => 'mgh.api_token',
    'value' => '',
    'xtype' => 'textfield',
    'namespace' => 'modgithub',
    'area' => 'Authentication',
),'',true,true);

return $settings;