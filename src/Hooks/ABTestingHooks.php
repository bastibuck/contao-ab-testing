<?php

/**
 * @package     A/B-Testing
 * @author      Basti Buck (http://www.bastibuck.de)
 * @license     LGPL-3.0-or-later
 * @copyright   Basti Buck, 2017
 */

namespace Bastibuck\ABTesting\Hooks;

/**
 * class providing hooks functions
 */
class ABTestingHooks {

  /**
   * return static custom page icon for A/B testing page
   */
  public function returnPageIcon($objPage, $image) {

    if(strpos($image, 'ab_testing') !== false) {
      $image = str_replace('svg', 'png', $image);
      $image = 'bundles/bastibuckabtesting/'.$image;
    }

    return $image;
  }
}
