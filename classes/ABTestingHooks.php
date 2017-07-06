<?php

/**
 * @package     A/B-Testing
 * @author      Basti Buck (http://www.bastibuck.de)
 * @license     LGPL
 * @copyright   Basti Buck, 2017
 */

namespace Bastibuck;

/**
 * class providing hooks functions
 */
class ABTestingHooks {

  /**
   * return static custom page icon for A/B testing page
   */
  public function returnPageIcon($objPage, $image) {

    if(strpos($image, 'ab_testing') !== false) {

      $image = str_replace('gif', 'png', $image); // 3.5 file type
      $image = str_replace('svg', 'png', $image); // 4.x file type
      $image = 'system/modules/ab_testing/assets/'.$image;
    }

    return $image;
  }
}
