<?php

$cityselect = $modx->getService('cityselect','cityselect',$modx->getOption('cityselect_core_path',null,$modx->getOption('core_path').'components/cityselect/').'model/cityselect/',$scriptProperties);
if (!($cityselect instanceof cityselect)) return '';

$cityselect->initialize($modx->context->key);
/**
 * Do your snippet code here. This demo grabs 5 items from our custom table.
 */
$tpl = $modx->getOption('tpl',$scriptProperties,'tpl.CitySelect.example', true);

/** @var modChunk $chunk */
if (!$chunk = $modx->getObject('modChunk', array('name' => $tpl))) {
	return $modx->lexicon('cityselect_err_chunk', array('name' => $tpl));
}


/* output */
$output = $chunk->getContent();

$city = "cityselect";
if (empty($_COOKIE['city_name'])) {

	$SxGeo = new SxGeo($modx->getOption('cityselect_assets_path',null,$modx->getOption('assets_path').'components/cityselect/').'data/SxGeoCity.dat');
	$Sx_arr = $SxGeo->getCityFull($_SERVER['REMOTE_ADDR']);
	if (!empty($Sx_arr["city"]["name_ru"])) $_COOKIE['city_name'] = $Sx_arr["city"]["name_ru"];
	else $_COOKIE['city_name'] = $modx->lexicon('cityselect_is_unknown');
}

$modx->setPlaceholder($city, $_COOKIE['city_name']);


$toPlaceholder = $modx->getOption('toPlaceholder',$scriptProperties,false);

if (!empty($toPlaceholder)) {
	/* if using a placeholder, output nothing and set output to specified placeholder */
	$modx->setPlaceholder($toPlaceholder,$output);
	return '';
}

/* by default just return output */
return $output;