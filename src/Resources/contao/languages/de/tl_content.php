<?php

/**
 * @package     A/B-Testing
 * @author      Basti Buck (http://www.bastibuck.de)
 * @license     LGPL-3.0-or-later
 */

// Legends
$GLOBALS['TL_LANG']['tl_content']['piwik_legend'] = 'Matomo / PIWIK: Custom Variable';

// Fields
$GLOBALS['TL_LANG']['tl_content']['customVar_index'] = array('Index', 'Index, auf dem die Variable gespeichert werden soll.');
$GLOBALS['TL_LANG']['tl_content']['customVar_name'] = array('Name', 'Name der Custom Variable (bspw. \'Landingpage\')');
$GLOBALS['TL_LANG']['tl_content']['customVar_value'] = array('Wert', 'Der Wert, der in diesem Fall unter der Variable gespeichert werden soll.');
$GLOBALS['TL_LANG']['tl_content']['customVar_scope'] = array('Scope', 'Soll die Variable für den ganzen Besuch oder die einzelne Seite gelten?');

// Options
$GLOBALS['TL_LANG']['tl_content']['customVar_scope']['options']['visit'] = 'Besuch';
$GLOBALS['TL_LANG']['tl_content']['customVar_scope']['options']['page'] = 'Seite';
