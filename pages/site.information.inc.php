<?php
/**
 * site.information.inc.php
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

// INFORMATION CONTENT
////////////////////////////////////////////////////////////////////////////////
echo '
<div class="rex-addon-output">
  <h2 class="rex-hl2">'. $I18N->msg($strAddonName.'_help_headline') .'</h2>
  <div class="rex-addon-content">
    <div class= "addon-template">
      <p>'. $I18N->msg($strAddonName.'_help_infotext_1') .'</p>
      <p>'. $I18N->msg($strAddonName.'_help_infotext_2') .'</p>
      <p>'. $I18N->msg($strAddonName.'_help_infotext_3') .'</p>
      <ul>
        <li>'. $I18N->msg($strAddonName.'_help_functionfile_name_1') .' oder '. $I18N->msg($strAddonName.'_help_classfile_name_1') .'</li>
        <li>'. $I18N->msg($strAddonName.'_help_functionfile_name_2') .' oder '. $I18N->msg($strAddonName.'_help_classfile_name_2') .'</li>
        <li>'. $I18N->msg($strAddonName.'_help_functionfile_name_3') .' oder '. $I18N->msg($strAddonName.'_help_classfile_name_3') .'</li>
      </ul>
      <p>'. $I18N->msg($strAddonName.'_help_infotext_4') .'</p>
    </div>
  </div>
</div>';
