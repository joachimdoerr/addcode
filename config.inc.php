<?php
/*
config.inc.php

@copyright Copyright (c) 2012 by Doerr Softwaredevelopment
@author mail[at]joachim-doerr[dot]com Joachim Doerr

@package redaxo4
@version 2.0.1
*/

// ADDON IDENTIFIER AUS ORDNERNAMEN ABLEITEN
////////////////////////////////////////////////////////////////////////////////
$strAddonName = "addcode";
$strAddonPath = $REX['INCLUDE_PATH']. '/addons/' .$strAddonName;


// ADDON REX COMMONS
////////////////////////////////////////////////////////////////////////////////
$REX['ADDON']['rxid'][$strAddonName] = '995';
$REX['ADDON']['page'][$strAddonName] = $strAddonName;
$REX['ADDON']['name'][$strAddonName] = $strAddonName;
$REX['ADDON'][$strAddonName]['VERSION'] = array('VERSION' => 2, 'MINORVERSION' => 0, 'SUBVERSION' => 1);

$REX['ADDON']['version'][$strAddonName]     = implode('.', $REX['ADDON'][$strAddonName]['VERSION']);
$REX['ADDON']['author'][$strAddonName]      = 'Joachim Doerr';
$REX['ADDON']['supportpage'][$strAddonName] = 'forum.redaxo.de';

$REX['ADDON']['perm'][$strAddonName] = $strAddonName.'[]';	//Allows to add this addon as Startpage
$REX['EXTRAPERM'][] = $strAddonName.'[settings]';	  //Allows Addon specific restrictions (i.e. for Plugins)


// INCLUDES GLOBAL
////////////////////////////////////////////////////////////////////////////////
require_once( $strAddonPath .'/settings.inc.php' );


// SET DEFINE AND DEFAULTS
////////////////////////////////////////////////////////////////////////////////
$arrPaths = array(0 => $REX['ADDON']['settings']['addcode']['diversity_path'], 1 => $strAddonPath. '/include/');
$arrLoadingKeys = array(0 => 'frontend', 1 => 'global');


// REDAXO BACKEND
////////////////////////////////////////////////////////////////////////////////
if ($REX['REDAXO'] === true)
{
  // LOAD I18N FILE
  ////////////////////////////////////////////////////////////////////////////////
  $I18N->appendFile(dirname(__FILE__) . '/lang/');
  
  // ADDON MENU
  ////////////////////////////////////////////////////////////////////////////////
  if($REX['USER'])
  {
    if($REX['USER']->hasPerm($strAddonName.'[settings]'))
    {
      $REX['ADDON']['name'][$strAddonName] = $I18N->msg($strAddonName.'_name');
    }
  }
  
  // RESET DEFINE AND DEFAULTS
  ////////////////////////////////////////////////////////////////////////////////
  $arrPaths[0] = '../' .$REX['ADDON']['settings']['addcode']['diversity_path'];
  $arrLoadingKeys[0] = 'backend';
}


// AUTO INCLUDE FUNCTIONS & CLASSES
////////////////////////////////////////////////////////////////////////////////
foreach ($arrLoadingKeys as $strKey)
{
  foreach ($arrPaths as $strPath)
  {
    if (file_exists($strPath) === true)
    {
      array_walk(glob("$strPath/classes/class.*.$strKey.inc.php"),create_function('$v,$i', 'return require_once($v);'));
      array_walk(glob("$strPath/functions/function.*.$strKey.inc.php"),create_function('$v,$i', 'return require_once($v);'));
    }
  }
}
