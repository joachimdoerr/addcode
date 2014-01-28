<?php
/**
* phpQuery - Addcode Plugin
*
* @package redaxo 4.5.x
* @version 0.1.0
* @author  jdlx c/o rexdev.de
*/


// ADDON IDENTIFIER & ROOT DIR
////////////////////////////////////////////////////////////////////////////////
$myself = 'phpquery.addcode.plugin';
$myroot = $REX['INCLUDE_PATH'].'/addons/addcode/plugins/'.$myself;


// REX COMMONS
////////////////////////////////////////////////////////////////////////////////
$REX['ADDON']['version'][$myself]     = '0.1.0';
$REX['ADDON']['title'][$myself]       = 'phpQuery';
$REX['ADDON']['author'][$myself]      = 'rexdev.de';
$REX['ADDON']['supportpage'][$myself] = 'forum.redaxo.de';
$REX['ADDON']['perm'][$myself]        = $myself.'[]';
$REX['PERM'][]                        = $myself.'[]';


// MAIN
////////////////////////////////////////////////////////////////////////////////
require_once $myroot.'/vendor/punkave/phpQuery/phpQuery/phpQuery.php';
