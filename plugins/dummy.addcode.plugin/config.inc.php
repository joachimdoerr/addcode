<?php
/**
* Addcode Dummy Plugin
*
* @package redaxo 4.3.x/4.4.x
* @version 0.0.0
*/


// ADDON IDENTIFIER & ROOT DIR
////////////////////////////////////////////////////////////////////////////////
$myself = 'dummy.addcode.plugin';
$myroot = $REX['INCLUDE_PATH'].'/addons/addcode/plugins/'.$myself;


// REX COMMONS
////////////////////////////////////////////////////////////////////////////////
$Revision = '';
$REX['ADDON'][$myself]['VERSION'] = array
(
'VERSION'      => 0,
'MINORVERSION' => 0,
'SUBVERSION'   => 0
);
$REX['ADDON']['version'][$myself]     = implode('.', $REX['ADDON'][$myself]['VERSION']);
$REX['ADDON']['title'][$myself]       = 'Dummy';
$REX['ADDON']['author'][$myself]      = 'rexdev.de';
$REX['ADDON']['supportpage'][$myself] = 'forum.redaxo.de';
$REX['ADDON']['perm'][$myself]        = $myself.'[]';
$REX['PERM'][]                        = $myself.'[]';

// SETTINGS
////////////////////////////////////////////////////////////////////////////////
$REX['ADDON']['addcode']['PLUGIN']['dummy.addcode.plugin']['cachefile'] = $REX['INCLUDE_PATH'].'/generated/files/dummy.addcode.plugin_cache.php';
// --- DYN
$REX["ADDON"]["addcode"]["PLUGIN"]["dummy.addcode.plugin"]["foo"]   = 123;
$REX["ADDON"]["addcode"]["PLUGIN"]["dummy.addcode.plugin"]["bar"]  = 0;
// --- /DYN


// MAIN
////////////////////////////////////////////////////////////////////////////////
