<?php 

/**
 * @package     A/B-Testing
 * @author      Basti Buck (http://www.bastibuck.de)
 * @license     LGPL-3.0-or-later
 * @copyright   Basti Buck, 2017
 */

namespace Bastibuck\ABTesting\DCA;

/**
 * Helpful methods for DCA 
 */
class Backend extends \Backend {

    /**
     * Prevent circular references
     */
    public function checkABPages($serializedPages, \DataContainer $dc)
    {
      if (in_array($dc->id, deserialize($serializedPages)))
      {
        throw new \Exception($GLOBALS['TL_LANG']['ERR']['circularReference']);
      }
  
      return $serializedPages;
    }
  
  }