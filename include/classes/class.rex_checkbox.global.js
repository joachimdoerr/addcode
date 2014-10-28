
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
 * CLASS rex_checkbox JS support file
 *
 * @author http://rexdev.de
 *
 * @package redaxo 4.5.x
 * @version 0.5.0
 */


(function($){ // jQuery noConflict /////////////////////////////////////////////
  $('.rex-form-select .multicheckbox').parent('p').addClass('rex-form-multicheckbox');

  $('.rex-form-multicheckbox > label,.multicheckbox .optgroup .optgroup-label').on('click dblclick',function(c){
    n = c.target.nodeName == 'LABEL' ? $(this).next('.multicheckbox:not(.disabled)').find('input') : $(this).nextAll('input');
    n.each($.proxy(function(i,e){
      $(e).prop('checked',(c.type==='click' ? !$(e).prop("checked") : true));
    },c));
  });

})(jQuery); // end jQuery noConflict ///////////////////////////////////////////
