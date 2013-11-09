<?php

$DYN = '';

$db = rex_sql::factory();
foreach($db->getArray('SELECT * FROM `rex_country_codes` ORDER BY `iso_3166_1_alpha_2` ASC;') as $c)
{
  $DYN .= "
    '".$c['iso_3166_1_alpha_2']."' => array(
      'iso_3166_1_alpha_3' => '".addcslashes($c['iso_3166_1_alpha_3'],"'")."',
      'iso_3166_1_numeric' => '".addcslashes($c['iso_3166_1_numeric'],"'")."',
      'ccTLD'              => '".addcslashes($c['ccTLD'],"'")."',
      'name_EN'            => '".addcslashes($c['name_EN'],"'")."',
      'name_DE'            => '".addcslashes($c['name_DE'],"'")."',
      'name_ES'            => '".addcslashes($c['name_ES'],"'")."',
      'name_FR'            => '".addcslashes($c['name_FR'],"'")."',
      'name_IT'            => '".addcslashes($c['name_IT'],"'")."',
      'name_PT'            => '".addcslashes($c['name_PT'],"'")."'
      ),";
}

rex_replace_dynamic_contents($REX['INCLUDE_PATH'].'/addons/addcode/include/classes/class.rex_standards.global.inc.php',$DYN);

?>
