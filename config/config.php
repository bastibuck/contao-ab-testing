<?php

/**
 * @package     A/B-Testing
 * @author      Basti Buck (http://www.bastibuck.de)
 * @license     LGPL
 * @copyright   Basti Buck, 2017
 */

/**
 * add new Page type
 */
$GLOBALS['TL_PTY']['ab_testing'] = 'PageABTesting';

/**
 * Hooks
 */
// get static custom icon
$GLOBALS['TL_HOOKS']['getPageStatusIcon'][] = array('ABTestingHooks', 'returnPageIcon');
