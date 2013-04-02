<?php
/**
 * site.includes.inc.php
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

// PARAMS & ROOT DIR
////////////////////////////////////////////////////////////////////////////////
$mypage      = rex_request('page', 'string');
$subpage     = rex_request('subpage', 'string');
$type        = rex_request('type' , 'string', 'classes');
$scope       = rex_request('scope' , 'string', 'global');
$func        = rex_request('func', 'string');
$type_root   = $type == 'classes'
             ? $REX['INCLUDE_PATH'].'/addons/addcode/include/classes/'
             : $REX['INCLUDE_PATH'].'/addons/addcode/include/functions/';

// BUILD SCOPE NAVIGATION
////////////////////////////////////////////////////////////////////////////////
$sub_nav  = $separator = '';

foreach(array('global','frontend','backend') as $this_scope )
{
  if($scope=='') $scope = $this_scope; // first active plugin as default

  if ($scope != $this_scope)
  {
    $sub_nav .= $separator.'<a href="?page=addcode&subpage='.$subpage.'&type='.$type.'&scope='.$this_scope.'" class="plugin">'.$this_scope.'</a>';
  }
  else
  {
    $sub_nav .= $separator.'<span class="plugin">'.$this_scope.'</span>';
  }
  $separator = ' | ';
}


// PLUGINS NAVI
$sub_nav = $sub_nav == '' ? 'Es sind keine Klassen/Funktionen verfügbar.' : $sub_nav;
echo '
<div class="rex-addon-output addcode-plugins">
  <h2 class="rex-hl2" style="font-size:1em;border-bottom:0;">'.$sub_nav.'</h2>
</div>';


// GET INSTALLED CLASSES
////////////////////////////////////////////////////////////////////////////////
$includes = $type == 'classes'
          ? (array) glob($type_root.'class.*.'.$scope.'.php')
          : (array) glob($type_root.'function.*.'.$scope.'.php');

foreach($includes as $include)
{
  $parts = pathinfo($include);
  // PLUGIN INFO WRAPPER
  ////////////////////////////////////////////////////////////////////////////////
  $help = $type_root.$parts['filename'].'.textile';
  $html = file_exists($help)
        ? addcode_incparse($type_root,$parts['filename'].'.textile','textile',true)
        : '(no description available)';

    echo '
    <div class="rex-addon-output addcode-plugins">
      <h2 class="rex-hl2" style="font-size:1.2em">'.$parts['basename'].'</h2>
      <div class="rex-addon-content">
      '.$html.'
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

