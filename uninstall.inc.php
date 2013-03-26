<?php
/**
 * uninstall.inc.php
 *
 * @copyright Copyright (c) 2012 by Doerr Softwaredevelopment
 * @author mail[at]joachim-doerr[dot]com Joachim Doerr
 * @author (contributing) https://github.com/jdlx/
 *
 * @package redaxo 4.4.x/4.5.x
 * @version 2.1.0
 */

// ADDON IDENTIFIER AUS GET PARAMS
////////////////////////////////////////////////////////////////////////////////
$strAddonName = rex_request('addonname','string');


$REX['ADDON']['install'][$strAddonName] = 0;
