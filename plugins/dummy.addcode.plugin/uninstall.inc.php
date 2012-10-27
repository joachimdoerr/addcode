<?php
/**
* Addcode Dummy Plugin
*
* @package redaxo 4.3.x/4.4.x
* @version 0.0.0
*/



$error = '';

if ($error != '')
  $REX['ADDON']['installmsg']['dummy.addcode.plugin'] = $error;
else
  $REX['ADDON']['install']['dummy.addcode.plugin'] = 0;
