<?php

$properties = array();

$tmp = array(
	'tpl' => array(
		'type' => 'textfield',
		'value' => 'tpl.CitySelect.example',
	),
	'frontend_css' => array(
		'type' => 'textfield',
		'value' => '[[+assetsUrl]]css/default.css',
	),
	'frontend_js' => array(
		'type' => 'textfield',
		'value' => '[[+assetsUrl]]js/default.js',
	),
);

foreach ($tmp as $k => $v) {
	$properties[] = array_merge(
		array(
			'name' => $k,
			'desc' => PKG_NAME_LOWER . '_prop_' . $k,
			'lexicon' => PKG_NAME_LOWER . ':properties',
		), $v
	);
}

return $properties;