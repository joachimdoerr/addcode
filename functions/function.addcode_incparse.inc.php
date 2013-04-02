<?php
/**
 * function.addcode_incparse.inc.php
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

/**
 * Include or parse content from various sources to HTML
 *
 * @author https://github.com/jdlx/
 * @package redaxo 4.3.x/4.4.x
 */
function addcode_incparse($root, $source, $parsemode, $return=false)
{

  switch ($parsemode)
  {
    case 'textile':
    $source  = $root.$source;
    $content = file_get_contents($source);
    $html    = addcode_textileparser($content, $return);
    break;

    case 'txt':
    $source  = $root.$source;
    $content = file_get_contents($source);
    $html    =  '<pre class="plain">'.$content.'</pre>';
    break;

    case 'raw':
    $source  = $root.$source;
    $content = file_get_contents($source);
    $html    = $content;
    break;

    case 'php':
    $source = $root.$source;
    $html   =  addcode_include_contents($source);
    break;



    case 'iframe':
    $html = '<iframe src="'.$source.'" width="99%" height="600px"></iframe>';
    break;

    case 'jsopenwin':
    $html = 'Externer link: <a href="'.$source.'">'.$source.'</a>
    <script language="JavaScript">
    <!--
    window.open(\''.$source.'\',\''.$source.'\');
    //-->
    </script>';
    break;

    case 'extlink':
    $html = 'Externer link: <a href="'.$source.'">'.$source.'</a>';
    break;
  }

  if($return==true) {
    return $html;
  }

  echo $html;
}


/**
 * Parse Textile and return or echo
 *
 * @author https://github.com/jdlx/
 * @package redaxo 4.3.x/4.4.x
 */
function addcode_textileparser($textile, $return=false)
{
  $html = '';

  if(OOAddon::isAvailable("textile"))
  {
    if($textile!='')
    {
      $textile = htmlspecialchars_decode($textile,ENT_QUOTES);
      $textile = str_replace('<br />','',$textile);

      $html = rex_lang_is_utf8()
            ? rex_a79_textile($textile)
            : utf8_decode(rex_a79_textile($textile));
    }
  }
  else
  {
    $html = rex_warning('WARNUNG: Das <a href="index.php?page=addon">Textile Addon</a> ist nicht aktiviert! Der Text wird ungeparst angezeigt..');
    $html .= '<pre>'.$textile.'</pre>';
  }

  if($return==true) {
    return $html;
  }

  echo $html;
}


// http://php.net/manual/de/function.include.php
////////////////////////////////////////////////////////////////////////////////
function addcode_include_contents($filename) {
  if (is_file($filename)) {
    ob_start();
    include $filename;
    $contents = ob_get_contents();
    ob_end_clean();
    return $contents;
  }
  return false;
}

