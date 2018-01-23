<?php

/**
 * @package     A/B-Testing
 * @author      Basti Buck (http://www.bastibuck.de)
 * @license     LGPL-3.0-or-later
 * @copyright   Basti Buck, 2017
 */

namespace Bastibuck\ABTesting\Elements;

class PiwikSetCustomVariable extends \ContentElement
{
  protected $strTemplate = 'ce_piwik_setCustomVar';

  public function generate()
  {
    if (TL_MODE == 'BE')
    {
      $objTemplate = new \BackendTemplate('be_wildcard');
      $objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['CTE']['piwik_setCustomVariable'][0]). ' ###';
      $strBuildTitle = '<span class="tl_gray" style="font-weight: normal">[';
      $strBuildTitle .= $this->customVar_index.', ';
      $strBuildTitle .= '\''.$this->customVar_name.'\', ';
      $strBuildTitle .= '\''.$this->customVar_value.'\', ';
      $strBuildTitle .= '\''.$this->customVar_scope.'\'';
      $strBuildTitle .= ']</span>';
      $objTemplate->title = $strBuildTitle;
      return $objTemplate->parse();
    }

    return parent::generate();
  }

  public function compile()
  {
    $arrCustomVariable = array
    (
      'index' => $this->customVar_index,
      'name'  => '"'.$this->customVar_name.'"',
      'value' => '"'.$this->customVar_value.'"',
      'scope' => '"'.$this->customVar_scope.'"'
    );

    $this->Template->customVar = $arrCustomVariable;
  }


}
