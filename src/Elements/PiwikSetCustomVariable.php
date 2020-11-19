<?php

/**
 * @package     A/B-Testing
 * @author      Basti Buck (http://www.bastibuck.de)
 * @license     LGPL-3.0-or-later
 */

namespace Bastibuck\ABTesting\Elements;

class PiwikSetCustomVariable extends \ContentElement
{
  public function generate()
  {
    if (TL_MODE == 'BE')
    {
      $objTemplate = new \BackendTemplate('be_wildcard');

      $customVarValues = '<span class="tl_gray" style="font-weight: bold">[';
      $customVarValues .= $this->customVar_index.', ';
      $customVarValues .= '\''.$this->customVar_name.'\', ';
      $customVarValues .= '\''.$this->customVar_value.'\', ';
      $customVarValues .= '\''.$this->customVar_scope.'\'';
      $customVarValues .= ']</span>';

      $wildCard = utf8_strtoupper($GLOBALS['TL_LANG']['CTE']['piwik_setCustomVariable'][0]);

      $objTemplate->wildcard = "### {$wildCard} {$customVarValues}";

      return $objTemplate->parse();
    }

    return parent::generate();
  }

  public function compile()
  {
    $scriptHtml = "<script>
      var _paq = _paq || [];
      _paq.push(['setCustomVariable',
        {$this->customVar_index},
        '{$this->customVar_name}',
        '{$this->customVar_value}',
        '{$this->customVar_scope}'
      ]);
    </script>";

    $GLOBALS['TL_HEAD'][] = $scriptHtml;
  }
}
