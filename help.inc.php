<?php
/**
 * help.inc.php
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

// ADDON IDENTIFIER
////////////////////////////////////////////////////////////////////////////////
$strAddonName = "addcode";


// LOAD I18N FILE
////////////////////////////////////////////////////////////////////////////////
if (!OOAddon::isAvailable($strAddonName))
{
  $I18N->appendFile(dirname(__FILE__) . '/lang/');
}


// HELP CONTENT
////////////////////////////////////////////////////////////////////////////////
?>
<p style="margin-bottom:15px;"><?php echo $I18N->msg('addcode_help_infotext_1'); ?></p>
<p style="margin-bottom:15px;"><?php echo $I18N->msg('addcode_help_infotext_2'); ?></p>
<p><?php echo $I18N->msg('addcode_help_infotext_3'); ?></p>
<ul style="margin-left:20px;">
<?php
echo '
  <li>'. $I18N->msg('addcode_help_functionfile_name_1') .' oder '. $I18N->msg('addcode_help_classfile_name_1') .'</li>
  <li>'. $I18N->msg('addcode_help_functionfile_name_2') .' oder '. $I18N->msg('addcode_help_classfile_name_2') .'</li>
  <li>'. $I18N->msg('addcode_help_functionfile_name_3') .' oder '. $I18N->msg('addcode_help_classfile_name_3') .'</li>
';
?>
</ul>
<p><?php echo $I18N->msg('addcode_help_infotext_4'); ?></p>
