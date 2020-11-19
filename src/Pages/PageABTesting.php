<?php

/**
 * @package     A/B-Testing
 * @author      Basti Buck (http://www.bastibuck.de)
 * @license     LGPL-3.0-or-later
 */

namespace Bastibuck\ABTesting\Pages;

/**
 * adds a new page type to Contao
 */
class PageABTesting extends \PageRegular
{
  /**
   * Redirect evenly to selected pages
   */  
  public function getResponse($objPage, $blnCheckRequest = false)
  {
    global $objPage;

    // array of AB pages
    $arrABPages = deserialize($objPage->ab_pages);

    // redirect returning visitors (if page still is within test)
    if(in_array(\Input::cookie($objPage->ab_cookie_name), $arrABPages)) {
      $intNextPage = \Input::cookie($objPage->ab_cookie_name);
      $returningVisitor = true;
    }
    // redirect first time visitor
    else {
      // get the next page to redirect to
      if($objPage->ab_lastPage != 0) {
        $intLastKey = array_search($objPage->ab_lastPage, $arrABPages);
        $intNextPage = $arrABPages[$intLastKey + 1];

        // get first page in array if last entry was reached
        if(!$intNextPage) {
          $intNextPage = $arrABPages[0];
        }
      }
      // get first page in AB pages on first ever visit
      else {
        $intNextPage = $arrABPages[0];
      }
    }
    
    // get next page object (returns FALSE if it's not published or found)
    $objNextPage = \PageModel::findWithDetails($intNextPage);
    
    // Forward page does not exist - 404
    if ($objNextPage === null)
    {
      $objHandler = new $GLOBALS['TL_PTY']['error_404']();
      $objHandler->generate($intNextPage);
    }
    
    // returning visitors
    if(!$returningVisitor) {
      // set new value for last page redirected
      \Database::getInstance()
      ->prepare('UPDATE tl_page SET ab_lastPage = ? WHERE id = ?')
      ->execute($objNextPage->id, $objPage->id);
    }
    
    // set/renew a cookie to identify returning visitors
    if($objPage->ab_cookie_expires == 0) {
      $intExpires = 0; // end of session
    }
    else {
      $intExpires = time() + $objPage->ab_cookie_expires;
    }
    $this->setCookie($objPage->ab_cookie_name, $objNextPage->id, $intExpires);
    
    // set Page object
    $objNextPage->noSearch = 1; // deactivate adding page to search index

    // render new page
    $objPage = $objNextPage;
    return parent::getResponse($objPage, $blnCheckRequest);
    }
  }
