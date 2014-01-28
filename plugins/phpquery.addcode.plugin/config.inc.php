<?php
/**
* phpQuery - Addcode Plugin
*
* @package redaxo 4.5.x
* @version 1.0.0
* @author  Redaxo Plugin: http://rexdev.de
* @author  Library:       https://github.com/punkave/phpQuery
*/


// ADDON IDENTIFIER & ROOT DIR
////////////////////////////////////////////////////////////////////////////////
$myself = 'phpquery.addcode.plugin';
$myroot = $REX['INCLUDE_PATH'].'/addons/addcode/plugins/'.$myself;


// REX COMMONS
////////////////////////////////////////////////////////////////////////////////
$REX['ADDON']['version'][$myself]     = '1.0.0';
$REX['ADDON']['title'][$myself]       = 'phpQuery';
$REX['ADDON']['author'][$myself]      = 'rexdev.de';
$REX['ADDON']['supportpage'][$myself] = 'forum.redaxo.de';
$REX['ADDON']['perm'][$myself]        = $myself.'[]';
$REX['PERM'][]                        = $myself.'[]';


// MAIN
////////////////////////////////////////////////////////////////////////////////
require_once $myroot.'/vendor/punkave/phpQuery/phpQuery/phpQuery.php';
