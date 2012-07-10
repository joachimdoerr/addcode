<?php
/*
help.inc.php

@copyright  Copyright (c) 2012 by Doerr Softwaredevelopment
@author     Joachim Doerr <mail@doerr-softwaredevelopment.com>
@version    $Id$
*/
 
if (!isset($mode)) { $mode = ''; }
switch ($mode) {
  case 'changelog': $file = '_changelog.txt'; break;
  default: $file = '_readme.txt'; 
}

echo str_replace( '+', '&nbsp;&nbsp;+', nl2br( file_get_contents( dirname( __FILE__) .'/'. $file)));
