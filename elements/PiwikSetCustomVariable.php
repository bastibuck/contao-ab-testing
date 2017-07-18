<?php

/**
 * @package     A/B-Testing
 * @author      Basti Buck (http://www.bastibuck.de)
 * @license     LGPL
 * @copyright   Basti Buck, 2017
 */

namespace Bastibuck;

class PiwikSetCustomVariable extends \ContentElement
{
  protected $strTemplate = 'ce_piwik_setCustomVar';

  public function generate()
  {
    if (TL_MODE == 'BE')
    {
      $objTemplate = new \BackendTemplate('be_wildcard');
      $objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['CTE']['piwik_setCustomVariable'][0]). ' ###';
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
