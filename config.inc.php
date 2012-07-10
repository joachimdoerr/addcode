<?php
/*
config.inc.php

@copyright  Copyright (c) 2012 by Doerr Softwaredevelopment
@author     Joachim Doerr <mail@doerr-softwaredevelopment.com>
@version    $Id$
*/

$mypage = "addcode";

$strAddonPath = '';
$strAddonPath = $REX['INCLUDE_PATH'].'/addons/'.$mypage;

$REX['ADDON']['page'][$mypage] = array($mypage);
$REX['ADDON']['version'][$mypage] = "1.1";
$REX['ADDON']['author'][$mypage] = "Joachim Doerr";
$REX['ADDON']['supportpage'][$mypage] = 'forum.redaxo.de';

include($strAddonPath."/functions/functions.getfilenames.inc.php");

if ($REX['REDAXO'] === true) { $devpath = '../'; } else { $devpath = ''; }

$strClassDir = $devpath."site/include/classes/";
$strFunctionsDir = $devpath."site/include/functions/";

if (file_exists($strClassDir) && is_dir($strClassDir)) { $arrAdd['inc'][] = getfilenames($strClassDir); }
if (file_exists($strFunctionsDir) && is_dir($strFunctionsDir)) { $arrAdd['inc'][] = getfilenames($strFunctionsDir); }

$arrAdd['inc'][] = getfilenames($strAddonPath."/include/classes/");
$arrAdd['inc'][] = getfilenames($strAddonPath."/include/functions/");

foreach ($arrAdd['inc'] as $arrAdd['inc_files']) {
  if (count($arrAdd['inc_files'])>0) {
    foreach ($arrAdd['inc_files'] as $arrAdd['file_id']=>$arrAdd['file_name']) {
      
      unset($arrAdd['itis']);
      // chmod($arrAdd['file_name'],0777);
      
      if (strpos(basename($arrAdd['file_name']), "frontend") > 0) { $arrAdd['itis']['frontend'] = true; } else { $arrAdd['itis']['frontend'] = false; }
      if (strpos(basename($arrAdd['file_name']), "backend") > 0) { $arrAdd['itis']['backend'] = true; } else { $arrAdd['itis']['backend'] = false; }
      if (strpos(basename($arrAdd['file_name']), "global") > 0) { $arrAdd['itis']['global'] = true; } else { $arrAdd['itis']['global'] = false; }
      
      if ($arrAdd['itis']['frontend'] === true || $arrAdd['itis']['global'] === true) {
        if ($REX['REDAXO'] !== true) include_once($arrAdd['file_name']);
      }
      if ($arrAdd['itis']['backend'] === true || $arrAdd['itis']['global'] === true) {
        if ($REX['REDAXO'] === true) include_once($arrAdd['file_name']);
      }
    }
  }
}