<?php

/**
 * @package     A/B-Testing
 * @author      Basti Buck (http://www.bastibuck.de)
 * @license     LGPL-3.0-or-later
 * @copyright   Basti Buck, 2017
 */

/**
 * add new Page type
 */
$GLOBALS['TL_PTY']['ab_testing'] = 'Bastibuck\ABTesting\Pages\PageABTesting';

/**
 * add new CEs
 */
$GLOBALS['TL_CTE']['ab_testing'] = array(
  'piwik_setCustomVariable'		=> 'Bastibuck\ABTesting\Elements\PiwikSetCustomVariable'
);

/**
 * Hooks
 */
// get static custom icon
$GLOBALS['TL_HOOKS']['getPageStatusIcon'][] = array('Bastibuck\ABTesting\Hooks\ABTestingHooks', 'returnPageIcon');
