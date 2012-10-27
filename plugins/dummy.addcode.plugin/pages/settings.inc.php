<?php
/**
* Addcode Dummy Plugin
*
* @package redaxo 4.3.x/4.4.x
* @version 0.0.0
*/

$myself = 'dummy.addcode.plugin';

// UPDATE/WRITE USER SETTINGS
////////////////////////////////////////////////////////////////////////////////
if ($func == 'save_settings')
{
  $REX['ADDON']['addcode']['PLUGIN'][$myself]['foo']   = rex_request('foo','int');
  $REX['ADDON']['addcode']['PLUGIN'][$myself]['bar']  = rex_request('bar','int');

  $content =
'$REX["ADDON"]["addcode"]["PLUGIN"]["'.$myself.'"]["foo"]   = '.rex_request('foo','int').';
$REX["ADDON"]["addcode"]["PLUGIN"]["'.$myself.'"]["bar"]  = '.rex_request('bar','int').';
';

  $file = $REX['INCLUDE_PATH'].'/addons/addcode/plugins/'.$myself.'/config.inc.php';
  rex_replace_dynamic_contents($file, $content);
  echo rex_info('Einstellungen wurden gespeichert.');
}

// FORM
return
'
<div class="rex-form-row">
  <p class="rex-form-col-a rex-form-text">
    <label for="foo">foo: </label>
    <input id="foo" class="rex-form-text" type="text" name="foo" value="'.
    $REX['ADDON']['addcode']['PLUGIN'][$myself]['foo'].
    '" />
  </p>
</div><!-- /rex-form-row -->


<div class="rex-form-row">
  <p class="rex-form-col-a rex-form-text">
    <label for="bar">bar: </label>
    <input id="bar" class="rex-form-text" type="text" name="bar" value="'.
    $REX['ADDON']['addcode']['PLUGIN'][$myself]['bar'].
    '" />
  </p>
</div><!-- /rex-form-row -->

';
