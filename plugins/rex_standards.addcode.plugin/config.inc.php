<?php
/**
* rex_standards - Addcode Plugin
*
* @package redaxo 4.3.x/4.4.x/4.5.x
* @version 1.0.0
*/


// ADDON IDENTIFIER & ROOT DIR
////////////////////////////////////////////////////////////////////////////////
$myself = 'rex_standards.addcode.plugin';
$myroot = $REX['INCLUDE_PATH'].'/addons/addcode/plugins/'.$myself;


// REX COMMONS
////////////////////////////////////////////////////////////////////////////////
$REX['ADDON'][$myself]['VERSION'] = array
(
'VERSION'      => 1,
'MINORVERSION' => 0,
'SUBVERSION'   => 0
);
$REX['ADDON']['version'][$myself]     = implode('.', $REX['ADDON'][$myself]['VERSION']);
$REX['ADDON']['title'][$myself]       = 'Rex Standards';
$REX['ADDON']['author'][$myself]      = 'rexdev.de';
$REX['ADDON']['supportpage'][$myself] = 'forum.redaxo.de';
$REX['ADDON']['perm'][$myself]        = $myself.'[]';
$REX['PERM'][]                        = $myself.'[]';

// SETTINGS
////////////////////////////////////////////////////////////////////////////////

// --- DYN
// --- /DYN


// INCLUDES
////////////////////////////////////////////////////////////////////////////////
require_once $myroot.'/classes/class.rex_standards.inc.php';
