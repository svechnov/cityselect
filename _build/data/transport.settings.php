<?php

$settings = array();

$tmp = array(
	'token' => array(
		'xtype' => 'textfield',
		'value' => '',
		'area' => 'cityselect_main',
	),
	'key' => array(
		'xtype' => 'textfield',
		'value' => '',
		'area' => 'cityselect_main',
	),
	'name_db_sxgeo' => array(
		'xtype' => 'textfield',
		'value' => 'SxGeoCity.dat',
		'area' => 'cityselect_main',
	),
	//временные
/*
	'assets_path' => array(
		'xtype' => 'textfield',
		'value' => '{base_path}cityselect/assets/components/cityselect/',
		'area' => 'cityselect_main',
	),
	'assets_url' => array(
		'xtype' => 'textfield',
		'value' => '/cityselect/assets/components/cityselect/',
		'area' => 'cityselect_main',
	),
	'core_path' => array(
		'xtype' => 'textfield',
		'value' => '{base_path}cityselect/core/components/cityselect/',
		'area' => 'cityselect_main',
	),
*/
	//временные
/*

	'frontend_js' => array(
		'xtype' => 'textfield',
		'value' => '[[+assetsUrl]]js/default.js',
		'area' => 'cityselect_main',
	),
	'frontend_css' => array(
		'xtype' => 'textfield',
		'value' => '[[+assetsUrl]]css/default.css',
		'area' => 'cityselect_main',
	),
*/
);

foreach ($tmp as $k => $v) {
	/* @var modSystemSetting $setting */
	$setting = $modx->newObject('modSystemSetting');
	$setting->fromArray(array_merge(
		array(
			'key' => 'cityselect_'.$k,
			'namespace' => PKG_NAME_LOWER,
		), $v
	),'',true,true);

	$settings[] = $setting;
}

unset($tmp);
return $settings;
