<?php
/**
 * Redaxo Addon Addcode
 *
 * @copyright Copyright (c) 2012 by Doerr Softwaredevelopment
 * @author mail[at]joachim-doerr[dot]com Joachim Doerr
 *
 * @author (contributing) https://github.com/jdlx/
 * @author (contributing) https://github.com/gregorharlan/
 *
 * @package redaxo 4.4.x/4.5.x/4.6.x
 * @version 2.5.3
 */

/**
 * CLASS rex_checkbox
 *
 * @author http://rexdev.de
 *
 * @package redaxo 4.5.x
 * @version 0.5.0
 */

class rex_multicheckbox extends rex_select
{
  private $mode;
  private $uid;
  public  $tooltip;
  public  $label;
  private static  $inject_assets = true;

  function __construct()
  {
    parent::init();
    self::factory();
  }


  public function factory()
  {
    $this->mode    = get_called_class();
    $this->uid     = 'uid'.time();
    $this->label   = get_called_class();
    $this->tooltip = 'CLICK: toggle children / DBLCLICK: check children';
  }


  public function setLabel($str)
  {
    $this->label = $str;
  }


  public function setAssetInject($bool)
  {
    self::$inject_assets = (bool) $bool;
  }


  public function get()
  {
    self::injectAssets('widget');

    return self::getWidget();
  }


  public function getElement($type = 'widget')
  {
    self::injectAssets($type);

    switch($type)
    {
      case'widget':
        return self::getWidget();
      break;
      case'label':
        return self::getLabel();
      break;
      case'js':
        return self::getJS();
      break;
      case'css':
        return self::getCSS();
      break;
      case'all':
        return self::getCSS().PHP_EOL.self::getLabel().PHP_EOL.self::getWidget().PHP_EOL.self::getJS();
      break;
    }
  }


  public function getWidget()
  {
    self::injectAssets('widget');

    $wrap_attrs = $this->attributes;
    unset($wrap_attrs['size']);
    unset($wrap_attrs['multiple']);
    unset($wrap_attrs['name']);
    if(!isset($wrap_attrs['class'])) {
      $wrap_attrs['class'] = 'multicheckbox';
    } else {
      $wrap_attrs['class'] .= ' multicheckbox';
    }

    if(!isset($wrap_attrs['id'])) {
      $wrap_attrs['id'] = $this->uid;
    }

    $wrap_attr = '';
    foreach($wrap_attrs as $name => $value)
    {
      $wrap_attr .= ' '. $name .'="'. $value .'"';
    }

    $ausgabe = PHP_EOL.'<span'.$wrap_attr.'>'.PHP_EOL;

    foreach ($this->options as $optgroup => $options) {
      $this->currentOptgroup = $optgroup;
      if ($optgroupLabel = isset($this->optgroups[$optgroup]) ? $this->optgroups[$optgroup] : null) {
        $ausgabe .= '  <span class="optgroup">' . PHP_EOL;
        $ausgabe .= '  <strong class="optgroup-label" title="'.$this->tooltip.'">' . htmlspecialchars($optgroupLabel) . '</strong>' . PHP_EOL;
      }
      if (is_array($options)) {
        $ausgabe .= $this->_outGroup(0);
      }
      if ($optgroupLabel) {
        $ausgabe .= '  </span><!-- .optgroup -->'.PHP_EOL;
      }
    }

    $ausgabe .= '</span>'.PHP_EOL;
    return $ausgabe;
  }


  public function getLabel()
  {
    self::injectAssets('label');

    if(!isset($this->attributes['id'])) {
      $this->attributes['id'] = $this->uid;
    }
    return '<label for="'.$this->attributes['id'].'" title="click to toggle children, dblcklick to check all children">'.htmlspecialchars($this->label).'</label>';
  }


  public function getJS()
  {
    return rex_get_file_contents(dirname(__FILE__).'/class.rex_checkbox.global.js');
  }


  public function getCSS()
  {
    return rex_get_file_contents(dirname(__FILE__).'/class.rex_checkbox.global.css');
  }


  public function _outOption($name, $value, $level = 0, $attributes = array())
  {
    $name  = htmlspecialchars($name);
    $value = htmlspecialchars($value);

    $bsps = '';
    if ($level > 0)
      $bsps = str_repeat('&nbsp;&nbsp;&nbsp;', $level);

    if ($this->option_selected !== null && in_array($value, $this->option_selected)) {
      $attributes['checked'] = 'checked';
    } else {
      unset($attributes['checked']);
    }
    $attributes['id']   = $this->attributes['id'].'_'.preg_replace('@\W@','_',$value);
    $attributes['name'] = $this->attributes['name'];

    $attr = '';
    foreach($attributes as $n => $v)
    {
      $attr .= ' '. $n .'="'. $v .'"';
    }

    $out  = '    <input type="checkbox" value="'.$value.'" '.$attr.' name="'.$attributes['name'].'">'.PHP_EOL;
    $out .= '    <label for="'.$attributes['id'].'">'.$bsps.$name.'</label>'.PHP_EOL;

    return $out;
  }


  private function copyAssets()
  {
    global $REX;

    $js  = $REX['FRONTEND_PATH'].'/files/addons/addcode/class.rex_checkbox.global.js';
    if(!file_exists($js)) {
      copy(dirname(__FILE__).'/class.rex_checkbox.global.js', $js);
    }
    $css = $REX['FRONTEND_PATH'].'/files/addons/addcode/class.rex_checkbox.global.css';
    if(!file_exists($css)) {
      copy(dirname(__FILE__).'/class.rex_checkbox.global.css', $css);
    }
  }


  public function injectAssets($get_type)
  {
    if($get_type == 'all') {
      self::$inject_assets = false;
      return;
    }

    if(self::$inject_assets) {
      self::copyAssets();
      rex_register_extension(
        'OUTPUT_FILTER',
        function($params)
        {
          $head   = PHP_EOL.
                    '<!-- rex_checkbox CSS -->'.PHP_EOL.
                    '  <link rel="stylesheet" type="text/css" href="../files/addons/addcode/class.rex_checkbox.global.css" media="screen, projection, print" />'.PHP_EOL.
                    '<!-- /rex_checkbox CSS -->'.PHP_EOL;
          $params['subject'] = str_replace('</head>', $head.'</head>', $params['subject']);

          $body   = PHP_EOL.
                    '<!-- rex_checkbox JS -->'.PHP_EOL.
                    '  <script src="../files/addons/addcode/class.rex_checkbox.global.js"></script>'.PHP_EOL.
                    '<!-- /rex_checkbox JS -->'.PHP_EOL;
          return str_replace('</body>', $body.'</body>', $params['subject']);
        }
      );
      self::$inject_assets = false;
    }
  }


} // class


class rex_checkbox extends rex_multicheckbox
{
  function __construct() {
    rex_multicheckbox::factory();
  }
}


class rex_category_checkbox extends rex_multicheckbox
{
  private $ignore_offlines;
  private $clang;
  private $check_perms;
  private $rootId;
  private $loaded;

  function rex_category_checkbox($ignore_offlines = false, $clang = false, $check_perms = true, $add_homepage = true)
  {
    $this->ignore_offlines = $ignore_offlines;
    $this->clang           = $clang;
    $this->check_perms     = $check_perms;
    $this->add_homepage    = $add_homepage;
    $this->rootId          = null;
    $this->loaded          = false;

    parent::factory();
  }

  /**
   * Kategorie-Id oder ein Array von Kategorie-Ids als Wurzelelemente der Select-Box.
   *
   * @param $rootId mixed Kategorie-Id oder Array von Kategorie-Ids zur Identifikation der Wurzelelemente.
   */
  public function setRootId($rootId)
  {
    $this->rootId = $rootId;
  }

  protected function addCatOptions()
  {
    global $REX;

    if($this->add_homepage)
      $this->addOption('Homepage', 0);

    if($this->rootId !== null)
    {
      if(is_array($this->rootId))
      {
        foreach($this->rootId as $rootId)
        {
          if($rootCat = OOCategory::getCategoryById($rootId, $this->clang))
          {
            $this->addCatOption($rootCat, 0);
          }
        }
      }
      else
      {
        if($rootCat = OOCategory::getCategoryById($this->rootId, $this->clang))
        {
          $this->addCatOption($rootCat, 0);
        }
      }
    }
    else
    {
      if(!$this->check_perms || $REX['USER']->isAdmin() || $REX['USER']->hasPerm('csw[0]'))
      {
        if($rootCats = OOCategory :: getRootCategories($this->ignore_offlines, $this->clang))
        {
          foreach($rootCats as $rootCat)
          {
            $this->addCatOption($rootCat);
          }
        }
      }
      elseif($REX['USER']->hasMountpoints())
      {
        $mountpoints = $REX['USER']->getMountpoints();
        foreach($mountpoints as $id)
        {
          $cat = OOCategory::getCategoryById($id, $this->clang);
          if ($cat && !$REX['USER']->hasCategoryPerm($cat->getParentId()))
            $this->addCatOption($cat, 0);
        }
      }
    }
  }

  protected function addCatOption(/*OOCategory*/ $cat, $group = null)
  {
    global $REX;

    if(!$this->check_perms ||
        $this->check_perms && $REX['USER']->hasCategoryPerm($cat->getId(),FALSE))
    {
      $cid = $cat->getId();
      $cname = $cat->getName();

      if($REX['USER']->hasPerm('advancedMode[]'))
        $cname .= ' ['. $cid .']';

      if($group === null)
        $group = $cat->getParentId();

      $this->addOption($cname, $cid, $cid, $group);
      $childs = $cat->getChildren($this->ignore_offlines, $this->clang);
      if (is_array($childs))
      {
        foreach ($childs as $child)
        {
          $this->addCatOption($child);
        }
      }
    }
  }

  public function get()
  {
    if(!$this->loaded)
    {
      $this->addCatOptions();
      $this->loaded = true;
    }

    return parent::get();
  }

  public function _outGroup($re_id, $level = 0, $optgroups = false)
  {
    global $REX;
    if ($level > 100)
    {
      // nur mal so zu sicherheit .. man weiss nie ;)
      echo "select->_outGroup overflow ($groupname)";
      exit;
    }

    $ausgabe = '';
    $group = $this->_getGroup($re_id);
    foreach ($group as $option)
    {
      $name = $option[0];
      $value = $option[1];
      $id = $option[2];
      if($id==0 || !$this->check_perms || ($this->check_perms && $REX['USER']->hasCategoryPerm($option[2],TRUE)))
      {
          $ausgabe .= $this->_outOption($name, $value, $level);
      }elseif(($this->check_perms && $REX['USER']->hasCategoryPerm($option[2],FALSE)))
      {
        $level--;
      }

      $subgroup = $this->_getGroup($id, true);
      if ($subgroup !== false)
      {
        $ausgabe .= $this->_outGroup($id, $level +1);
      }
    }
    return $ausgabe;
  }

}


class rex_mediacategory_checkbox extends rex_multicheckbox
{
  public $check_perms;
  public $rootId;
  private $loaded;

  public function rex_mediacategory_checkbox($check_perms = true)
  {
    $this->check_perms = $check_perms;
    $this->rootId = null;
    $this->loaded = false;

    parent::factory();
  }

  /**
   * Kategorie-Id oder ein Array von Kategorie-Ids als Wurzelelemente der Select-Box.
   *
   * @param $rootId mixed Kategorie-Id oder Array von Kategorie-Ids zur Identifikation der Wurzelelemente.
   */
  /*public*/ function setRootId($rootId)
  {
    $this->rootId = $rootId;
  }

  /*protected*/ function addCatOptions()
  {
    if($this->rootId !== null)
    {
      if(is_array($this->rootId))
      {
        foreach($this->rootId as $rootId)
        {
          if($rootCat = OOMediaCategory::getCategoryById($rootId))
          {
            $this->addCatOption($rootCat);
          }
        }
      }
      else
      {
        if($rootCat = OOMediaCategory::getCategoryById($this->rootId))
        {
          $this->addCatOption($rootCat);
        }
      }
    }
    else
    {
      if ($rootCats = OOMediaCategory::getRootCategories())
      {
        foreach($rootCats as $rootCat)
        {
          $this->addCatOption($rootCat);
        }
      }
    }
  }

  /*protected*/ function addCatOption(/*OOMediaCategory*/ $mediacat)
  {
    global $REX;

    if(!$this->check_perms ||
        $this->check_perms && $REX['USER']->hasMediaCategoryPerm($mediacat->getId()))
    {
      $mid = $mediacat->getId();
      $mname = $mediacat->getName();

      if($REX['USER']->hasPerm('advancedMode[]'))
        $mname .= ' ['. $mid .']';

      $this->addOption($mname, $mid, $mid, $mediacat->getParentId());
      $childs = $mediacat->getChildren();
      if (is_array($childs))
      {
        foreach ($childs as $child)
        {
          $this->addCatOption($child);
        }
      }
    }
  }

  public function get()
  {
    if(!$this->loaded)
    {
      $this->addCatOptions();
      $this->loaded = true;
    }

    return parent::get();
  }
}
