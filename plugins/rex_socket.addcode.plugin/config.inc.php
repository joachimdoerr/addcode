<?php
/**
* rex_socket - Addcode Plugin
*
* @package redaxo 4.3.x/4.4.x/4.5.x
* @version 1.0.0
* @link https://github.com/gharlan/redaxo4_socket
*
* @author Gregor Harlan
* @author https://github.com/gharlan
*/


// ADDON IDENTIFIER & ROOT DIR
////////////////////////////////////////////////////////////////////////////////
$myself = 'rex_socket.addcode.plugin';
$myroot = $REX['INCLUDE_PATH'].'/addons/addcode/plugins/'.$myself;


// REX COMMONS
////////////////////////////////////////////////////////////////////////////////
$REX['ADDON']['version'][$myself]     = '1.0.0';
$REX['ADDON']['title'][$myself]       = 'Rex Socket';
$REX['ADDON']['author'][$myself]      = 'Gregor Harlan';
$REX['ADDON']['supportpage'][$myself] = 'forum.redaxo.de';
$REX['ADDON']['perm'][$myself]        = $myself.'[]';
$REX['PERM'][]                        = $myself.'[]';

// SETTINGS
////////////////////////////////////////////////////////////////////////////////

// --- DYN
// --- /DYN


// INCLUDES
////////////////////////////////////////////////////////////////////////////////
if(!class_exists('rex_socket')){
  require_once $myroot.'/vendor/gharlan/redaxo4_socket/socket.php';
  require_once $myroot.'/vendor/gharlan/redaxo4_socket/socket_proxy.php';
  require_once $myroot.'/vendor/gharlan/redaxo4_socket/socket_response.php';
}
