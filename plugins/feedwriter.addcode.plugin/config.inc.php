<?php
/**
* FeedWriter - Addcode Plugin
*
* @package redaxo 4.5.x
* @version 1.0.0
* @author  Redaxo Plugin: http://rexdev.de
* @author  Library:       https://github.com/ajaxray/FeedWriter
*/


// ADDON IDENTIFIER & ROOT DIR
////////////////////////////////////////////////////////////////////////////////
$myself = 'feedwriter.addcode.plugin';
$myroot = $REX['INCLUDE_PATH'].'/addons/addcode/plugins/'.$myself;


// REX COMMONS
////////////////////////////////////////////////////////////////////////////////
$REX['ADDON']['version'][$myself]     = '1.0.0';
$REX['ADDON']['title'][$myself]       = 'FeedWriter';
$REX['ADDON']['author'][$myself]      = 'rexdev.de';
$REX['ADDON']['supportpage'][$myself] = 'rexdev.de';
$REX['ADDON']['perm'][$myself]        = $myself.'[]';
$REX['PERM'][]                        = $myself.'[]';


// MAIN
////////////////////////////////////////////////////////////////////////////////
require_once $myroot.'/vendor/ajaxray/FeedWriter/FeedTypes.php';
