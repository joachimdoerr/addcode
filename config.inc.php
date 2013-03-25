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
$REX['ADDON'][$strAddonName]['VERSION'] = array('VERSION' => 2, 'MINORVERSION' => 0, 'SUBVERSION' => 2);

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
$arrPaths = array(0 => $REX['INCLUDE_PATH'].'/../../'.$REX['ADDON']['settings']['addcode']['diversity_path'], 1 => $strAddonPath."/include/");
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
  
  $infoPage = new rex_be_page($I18N->msg($strAddonName.'_information'), array(
  'page'    => $strAddonName,
  'subpage' =>'information'));
  $infoPage->setHref('index.php?page='.$strAddonName.'&subpage=information');
  
  $settingsPage = new rex_be_page($I18N->msg($strAddonName.'_settings'), array(
  'page'    => $strAddonName,
  'subpage' =>'settings'));
  $settingsPage->setHref('index.php?page='.$strAddonName.'&subpage=settings');
  
  $REX['ADDON']['pages'][$strAddonName] = array (
    $infoPage, $settingsPage
  );
  
  if(file_exists(dirname(__FILE__).'/plugins')!=false && is_dir(dirname(__FILE__).'/plugins')!=false)
  {
    $pluginsPage = new rex_be_page($I18N->msg($strAddonName.'_plugins'), array(
        'page' => $strAddonName,
        'subpage' => 'plugins'
      )
    );
    $pluginsPage->setHref('index.php?page=addcode&subpage=plugins');
    $REX['ADDON']['pages'][$strAddonName][] = $pluginsPage;
  }
  
  // RESET DEFINE AND DEFAULTS
  ////////////////////////////////////////////////////////////////////////////////
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
      $arrClasses = glob("$strPath/classes/class.*.$strKey.*php");
      $arrFunctions = glob("$strPath/functions/function.*$strKey*php");
      
      if (is_array($arrClasses) === true)
      {
        array_walk($arrClasses,create_function('$v,$i', 'return require_once($v);')); 
      }
      if (is_array($arrFunctions) === true)
      {
        array_walk($arrFunctions,create_function('$v,$i', 'return require_once($v);')); 
      }
    }
  }
}
