<?php
/**
 * site.settings.inc.php
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

// SAVE SETTINGS ACTION
////////////////////////////////////////////////////////////////////////////////
if ($strFunc == 'update')
{
  $DYN  = '$REX["ADDON"]["settings"]["'.$strAddonName.'"]["diversity_path"] = "'.rex_post('diversity_path', 'string').'";';
  $PATH = $strAddonPath.'/settings.inc.php';

  if(rex_replace_dynamic_contents($PATH, $DYN))
  {
    // UPDATE REX
    $REX['ADDON']['settings'][$strAddonName]['diversity_path'] = rex_post('diversity_path', 'string');
    echo rex_info($I18N->msg($strAddonName.'_success_save'));
  }
  else
  {
    echo rex_warning($I18N->msg($strAddonName.'_error_save'));
  }
}


// SETTINGS FORM
////////////////////////////////////////////////////////////////////////////////
echo '
<div class="rex-addon-output">
  <h2 class="rex-hl2">'. $I18N->msg($strAddonName.'_settings') .'</h2>
  <div class="rex-area">
    <div class="rex-form">
    <form action="index.php?page='.$strAddonName.'" method="post">
      <fieldset class="rex-form-col-1">
        <div class="rex-form-wrapper">
          <input type="hidden" name="func" value="update" />
          <div class="rex-form-row">
            <p class="rex-form-text">
              <label for="diversity_path">'.$I18N->msg($strAddonName.'_diversity_path').':</label>
              <input type="text" id="diversity_path" name="diversity_path" value="'.$REX['ADDON']['settings'][$strAddonName]['diversity_path'].'" />
            </p>
          </div>
          <div class="rex-form-row">
            <p>
              <input type="submit" class="rex-form-submit" name="FUNC_UPDATE" value="'.$I18N->msg($strAddonName.'_save').'" />
            </p>
          </div>
        </div>
      </fieldset>
    </form>
    </div>
  </div>
</div>
';
