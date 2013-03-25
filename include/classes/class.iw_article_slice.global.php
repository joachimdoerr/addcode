<?php
/**
 * @author winteringo[at]gmail.com Ingo Winter
 * usage: $slices = iw_article_slice::get_slices_for_article($article_id, $clang_id, $ctype_id, $module_id);
 * return: array of slice objects sorted by prio
 *
 */
class iw_article_slice{

  private static $slices = array();

  private static function order_slices ()
  {
    $i = 0;
    $ordered_slices = array(self::$slices['0']);
    while (count($ordered_slices) < count(self::$slices))
    {
      $ordered_slices[] = self::$slices[$ordered_slices[$i]['id']];
      $i++;
    }
    self::$slices = $ordered_slices;
  }

  private static function filter_slices_by_modultyp_id ($modultyp_id)
  {
    foreach (self::$slices as $key => $val)
    {
      if ($val['modultyp_id'] != $modultyp_id)
      {
        unset(self::$slices[$key]);
      }
    }
    self::$slices = array_merge(self::$slices);
  }
  
  private static function filter_slices_by_ctype_id ($ctype_id)
  {
    foreach (self::$slices as $key => $val)
    {
      if ($val['ctype_id'] != $ctype_id)
      {
        unset(self::$slices[$key]);
      }
    }
    self::$slices = array_merge(self::$slices);
  }

  public static function get_slices_for_article ($article_id, $clang_id = FALSE, $ctype_id = FALSE, $modultyp_id = FALSE)
  {
    global $REX;
    self::$slices = array();
    $sql = rex_sql::factory();
    $qry = '
SELECT id, re_article_slice_id, modultyp_id, ctype, clang  
FROM '.$REX['TABLE_PREFIX'].'article_slice 
WHERE article_id='.$article_id;
    if ($clang_id !== FALSE)
    {
      $qry .= ' AND clang = '.$clang_id;
    }
    $sql->setQuery($qry);
    
    while ($sql->hasNext())
    {
      self::$slices[$sql->getValue('re_article_slice_id')] = array(
        'id' => $sql->getValue('id'),
        'clang_id' => $sql->getValue('clang'),
        'ctype_id' => $sql->getValue('ctype'),
        'modultyp_id' => $sql->getValue('modultyp_id')
      );
      $sql->next();
    }
    if (count(self::$slices) > 1)
    {  
      self::order_slices();
    }
    if (count(self::$slices) && $modultyp_id !== FALSE)
    {
      self::filter_slices_by_modultyp_id($modultyp_id);
    }
    if (count(self::$slices) && $ctype_id !== FALSE)
    {
      self::filter_slices_by_ctype_id ($ctype_id);
    }
    if (count(self::$slices))
    {
      foreach (self::$slices as $key => $val)
      {
        self::$slices[$key] = OOArticleSlice::getArticleSliceById($val['id'], $val['clang_id']);
      }      
    }
    return self::$slices;
  }

}
