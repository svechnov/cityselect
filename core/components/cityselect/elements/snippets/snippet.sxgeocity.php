<?php
/**
 * Created by PhpStorm.
 * User: vgrish
 * Date: 15.06.14
 * Time: 12:50
 */
$cityselect = $modx->getService('cityselect','cityselect',$modx->getOption('cityselect_core_path',null,$modx->getOption('core_path').'components/cityselect/').'model/cityselect/',$scriptProperties);
if (!($cityselect instanceof cityselect)) return '';

$SxGeo = new SxGeo($modx->getOption('cityselect_assets_path',null,$modx->getOption('asssets_path').'components/cityselect/').'data/SxGeoCity.dat');

$ip = $_SERVER['REMOTE_ADDR'];

$Sx_arr = $SxGeo->getCityFull($ip);
/*
 * Array
(
    [city] => Array
        (
            [id] => 524901
            [lat] => 55.75222
            [lon] => 37.61556
            [name_ru] => Москва
            [name_en] => Moscow
        )

    [region] => Array
        (
            [id] => 524894
            [name_ru] => Москва
            [name_en] => Moskva
            [iso] => RU-MOW
        )

    [country] => Array
        (
            [id] => 185
            [iso] => RU
            [continent] => EU
            [lat] => 60
            [lon] => 100
            [name_ru] => Россия
            [name_en] => Russia
        )

)
 */
return $Sx_arr["city"]["name_ru"];
