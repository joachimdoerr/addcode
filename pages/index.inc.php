<?php
/**
 * index.inc.php
 *
 * @copyright Copyright (c) 2012 by Doerr Softwaredevelopment
 * @author mail[at]joachim-doerr[dot]com Joachim Doerr
 *
 * @author (contributing) https://github.com/jdlx/
 * @author (contributing) Gregor Harlan https://github.com/gharlan/
 *
 * @package redaxo 4.4.x/4.5.x
 * @version 2.2.0
 */

// ADDON IDENTIFIER
////////////////////////////////////////////////////////////////////////////////
$strAddonName = 'addcode';
$strAddonPath = $REX['INCLUDE_PATH'].'/addons/'.$strAddonName.'/';


// GET PARAMS
////////////////////////////////////////////////////////////////////////////////
$strPage = rex_request('page', 'string', $strAddonName);
$subpage = rex_request('subpage', 'string');
$strFunc = rex_request('func', 'string');
$id      = rex_request('id', 'int');

// BACKEND CSS
////////////////////////////////////////////////////////////////////////////////
$includes = '
<!-- ADDCODE -->
  <link rel="stylesheet" type="text/css" href="../files/addons/addcode/backend.css" media="screen, projection, print" />
<!-- /ADDCODE -->
';
$include_func = 'return $params["subject"].\''.$includes.'\';';
rex_register_extension('PAGE_HEADER', create_function('$params',$include_func));


// INCLUDE PARSER FUNCTION
////////////////////////////////////////////////////////////////////////////////
require_once $REX['INCLUDE_PATH'].'/addons/addcode/functions/function.addcode_incparse.inc.php';


// REX BACKEND LAYOUT TOP
//////////////////////////////////////////////////////////////////////////////
include_once( $REX['INCLUDE_PATH'].'/layout/top.php' );


// TITLE & SUBPAGE NAVIGATION
//////////////////////////////////////////////////////////////////////////////
rex_title($I18N->msg($strAddonName.'_title').' <span>'.$REX['ADDON']['version'][$strAddonName].'<span>', $REX['ADDON']['pages'][$strAddonName]);


// INCLUDE SUBPAGE
/////////////////////////////////////////////////////////////////////////////
require_once( $strAddonPath . '/pages/site.'. ( $subpage=='' ? 'information' : $subpage ) .'.inc.php' );

// REX BACKEND LAYOUT BOTTOM
//////////////////////////////////////////////////////////////////////////////
include_once( $REX['INCLUDE_PATH'].'/layout/bottom.php' );
