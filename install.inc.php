<?php
/*
install.inc.php

@copyright Copyright (c) 2012 by Doerr Softwaredevelopment
@author mail[at]joachim-doerr[dot]com Joachim Doerr

@package redaxo4
@version 2.0.1
*/

// ADDON IDENTIFIER AUS GET PARAMS
////////////////////////////////////////////////////////////////////////////////
$mypage = rex_request('addonname','string');


// INSTALL CONDITIONS
////////////////////////////////////////////////////////////////////////////////
$requiered_REX = '4.2.0';
$requiered_PHP = 5;
$do_install = true;


// CHECK REDAXO VERSION
////////////////////////////////////////////////////////////////////////////////
$this_REX = $REX['VERSION'].'.'.$REX['SUBVERSION'].'.'.$REX['MINORVERSION'] = "1";
if(version_compare($this_REX, $requiered_REX, '<'))
{
	$REX['ADDON']['installmsg'][$mypage] = 'Dieses Addon ben&ouml;tigt Redaxo Version '.$requiered_REX.' oder h&ouml;her.';
	$REX['ADDON']['install'][$mypage] = 0;
	$do_install = false;
}


// CHECK PHP VERSION
////////////////////////////////////////////////////////////////////////////////
if (intval(PHP_VERSION) < $requiered_PHP)
{
	$REX['ADDON']['installmsg'][$mypage] = 'Dieses Addon ben&ouml;tigt mind. PHP '.$requiered_PHP.'!';
	$REX['ADDON']['install'][$mypage] = 0;
	$do_install = false;
}


// DO INSTALL
////////////////////////////////////////////////////////////////////////////////
if ($do_install)
{
	$REX['ADDON']['install'][$mypage] = 1;
}
