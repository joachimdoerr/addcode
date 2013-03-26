<?php
/**
 *
 * @package redaxo 4.3.x/4.4.x
 * @version 1.2.1
 */


// PARAMS & ROOT DIR
////////////////////////////////////////////////////////////////////////////////
$mypage      = rex_request('page', 'string');
$subpage     = rex_request('subpage', 'string');
$plugin      = rex_request('plugin', 'string');
$func        = rex_request('func', 'string');
$plugin_root = $REX['INCLUDE_PATH'].'/addons/addcode/plugins/';

// BUILD PLUGIN NAVIGATION
////////////////////////////////////////////////////////////////////////////////
$ac_plugins = $REX['ADDON']['plugins']['addcode'];
$pluginnav  = $separator = '';
foreach($ac_plugins['status'] as $this_plugin => $status)
{
  if($status == 1)
  {
    if($plugin=='') $plugin = $this_plugin; // first active plugin as default

    if ($plugin != $this_plugin)
    {
      $pluginnav .= $separator.'<a href="?page=addcode&subpage='.$subpage.'&plugin='.$this_plugin.'" class="plugin">'.$ac_plugins['title'][$this_plugin].'</a>';
    }
    else
    {
      $pluginnav .= $separator.'<span class="plugin">'.$ac_plugins['title'][$this_plugin].'</span>';
    }
    $separator = ' | ';
  }
}


// PLUGINS NAVI
$pluginnav = $pluginnav == '' ? 'Es sind keine Plugins installiert/aktiviert.' : $pluginnav;
echo '
<div class="rex-addon-output addcode-plugins">
  <h2 class="rex-hl2" style="font-size:1em;border-bottom:0;">'.$pluginnav.'</h2>
</div>';


// PLUGIN FORM WRAPPER
////////////////////////////////////////////////////////////////////////////////
$form = $plugin_root.$plugin.'/pages/settings.inc.php';
if(file_exists($form))
{
  $form = include $plugin_root.$plugin.'/pages/settings.inc.php';
  echo '
  <div class="rex-addon-output addcode-plugins">
    <div class="rex-form">

      <form action="index.php" method="post">
        <input type="hidden" name="page" value="addcode" />
        <input type="hidden" name="subpage" value="plugins" />
        <input type="hidden" name="plugin" value="'.$plugin.'" />
        <input type="hidden" name="func" value="save_settings" />

        <fieldset class="rex-form-col-1">
          <legend style="font-size:1.2em">Settings</legend>
            <div class="rex-form-wrapper">

              '.$form;

  if(!isset($nosubmit))
  {
    echo '
              <div class="rex-form-row rex-form-element-v2">
                <p class="rex-form-submit">
                  <input class="rex-form-submit" type="submit" id="sendit" name="sendit" value="Einstellungen speichern" />
                </p>
              </div><!-- /rex-form-row -->';
  }

  echo '
              </div><!-- /rex-form-wrapper -->
        </fieldset>
      </form>
    </div><!-- /rex-form -->
  </div><!-- /rex-addon-output -->
  ';
}


// PLUGIN INFO WRAPPER
////////////////////////////////////////////////////////////////////////////////
$help = $plugin_root.$plugin.'/pages/help.textile';
if(file_exists($help))
{
  echo '
  <div class="rex-addon-output addcode-plugins">
    <h2 class="rex-hl2" style="font-size:1.2em">Infos</h2>
    <p style="float:right;color:gray;padding:16px 20px 0 0;">Version: '.$REX['ADDON']['plugins']['addcode']['version'][$plugin].'</p>

    <div class="rex-addon-content">

    '.addcode_incparse($plugin_root,$plugin.'/pages/help.textile','textile',true).'

    </div><!-- /rex-addon-content -->
  </div><!-- /rex-addon-output -->
  ';
}

// JS OPEN LINKS IN NEW WIN DOW VIA CLASS
////////////////////////////////////////////////////////////////////////////////
echo '
<script type="text/javascript">
jQuery(document).ready(function(){
  jQuery("a.blank").attr("target","_blank");
});
</script>
';
