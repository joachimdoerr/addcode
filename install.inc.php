<?php
/**
 * install.inc.php
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

// ADDON IDENTIFIER AUS GET PARAMS
////////////////////////////////////////////////////////////////////////////////
$strAddonName = rex_request('addonname','string');


// LOAD I18N FILE
////////////////////////////////////////////////////////////////////////////////
$I18N->appendFile(dirname(__FILE__) . '/lang/');


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
	$REX['ADDON']['installmsg'][$strAddonName] = str_replace('###version###', $requiered_REX, $I18N->msg($strAddonName.'_install_need_rex'));
	$REX['ADDON']['install'][$strAddonName] = 0;
	$do_install = false;
}


// CHECK PHP VERSION
////////////////////////////////////////////////////////////////////////////////
if (intval(PHP_VERSION) < $requiered_PHP)
{
	$REX['ADDON']['installmsg'][$strAddonName] = str_replace('###version###', $requiered_PHP, $I18N->msg($strAddonName.'_install_need_php'));
	$REX['ADDON']['install'][$strAddonName] = 0;
	$do_install = false;
}


// DO INSTALL
////////////////////////////////////////////////////////////////////////////////
if ($do_install)
{
	$REX['ADDON']['install'][$strAddonName] = 1;
}
