<?php

/**
 * @package     A/B-Testing
 * @author      Basti Buck (http://www.bastibuck.de)
 * @license     LGPL-3.0-or-later
 * @copyright   Basti Buck, 2017
 */

namespace Bastibuck;

/**
 * adds a new page type to Contao
 */
class PageABTesting extends \Frontend
{
  /**
   * Redirect evenly to selected pages
   */
  public function generate($objPage)
  {
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
    $objNextPage = \PageModel::findPublishedById($intNextPage);

    // Forward page does not exist - 404
    if ($objNextPage === null)
    {
      $objHandler = new $GLOBALS['TL_PTY']['error_404']();
      $objHandler->generate($intNextPage);
    }


    // taken from PageForward (Contao Core) - START ////////
    $strGet = '';
    $strQuery = \Environment::get('queryString');
    $arrQuery = array();

    // Extract the query string keys
    if ($strQuery != '')
    {
      $arrChunks = explode('&', $strQuery);

      foreach ($arrChunks as $strChunk)
      {
        list($k) = explode('=', $strChunk, 2);
        $arrQuery[] = $k;
      }
    }

    // Add $_GET parameters
    if (!empty($_GET))
    {
      foreach (array_keys($_GET) as $key)
      {
        if (\Config::get('disableAlias') && $key == 'id')
        {
          continue;
        }

        if (\Config::get('addLanguageToUrl') && $key == 'language')
        {
          continue;
        }

        // Ignore the query string parameters (see #5867)
        if (in_array($key, $arrQuery))
        {
          continue;
        }

        // Ignore the auto_item parameter (see #5886)
        if ($key == 'auto_item')
        {
          $strGet .= '/' . \Input::get($key);
        }
        else
        {
          $strGet .= '/' . $key . '/' . \Input::get($key);
        }
      }
    }

    // Append the query string (see #5867)
    if ($strQuery != '')
    {
      $strQuery = '?' . $strQuery;
    }
    // taken from PageForward (Contao Core) - END ////////

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

    // redirect to new page
    $this->redirect($objNextPage->getFrontendUrl($strGet) . $strQuery);
    }
  }
