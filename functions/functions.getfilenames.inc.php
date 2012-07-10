<?php
/*
functions.getfilenames.inc.php

@copyright  Copyright (c) 2012 by Doerr Softwaredevelopment
@author     Joachim Doerr <mail@doerr-softwaredevelopment.com>
@version    $Id$
*/

if(!function_exists('getfilenames')) {
  function getfilenames($folder) {
    $arrFiles = glob($folder."/*.*");
    if(is_array($arrFiles)) {
      $arrFileNames = array();
      foreach ($arrFiles as $strFileName) {
        $arrFileNames[] = $strFileName;
      }
      return $arrFileNames;
    }
  }
}

?>