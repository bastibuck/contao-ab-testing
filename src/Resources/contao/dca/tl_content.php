<?php

/**
 * @package     A/B-Testing
 * @author      Basti Buck (http://www.bastibuck.de)
 * @license     LGPL-3.0-or-later
 * @copyright   Basti Buck, 2017
 */

// Palettes
$GLOBALS['TL_DCA']['tl_content']['palettes']['piwik_setCustomVariable'] = '
  {type_legend},type;
  {piwik_legend},customVar_index,customVar_name,customVar_value,customVar_scope;
';

// Fields
$GLOBALS['TL_DCA']['tl_content']['fields']['customVar_index'] = array
(
  'label'                   => &$GLOBALS['TL_LANG']['tl_content']['customVar_index'],
  'exclude'                 => true,
  'inputType'               => 'radio',
  'options'                 => array('1', '2', '3', '4', '5'),
  'default'                 => '1',
  'eval'                    => array
  (
    'tl_class'    => 'autoheight',
    'mandatory'   => true
  ),
  'sql'                     => "int(1) NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['customVar_name'] = array
(
  'label'                   => &$GLOBALS['TL_LANG']['tl_content']['customVar_name'],
  'exclude'                 => true,
  'inputType'               => 'text',
  'eval'                    => array
  (
    'tl_class'    => 'w50 clr',
    'mandatory'   => true
  ),
  'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['customVar_value'] = array
(
  'label'                   => &$GLOBALS['TL_LANG']['tl_content']['customVar_value'],
  'exclude'                 => true,
  'inputType'               => 'text',
  'eval'                    => array
  (
    'tl_class'    => 'w50',
    'mandatory'   => true
  ),
  'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['customVar_scope'] = array
(
  'label'                   => &$GLOBALS['TL_LANG']['tl_content']['customVar_scope'],
  'exclude'                 => true,
  'inputType'               => 'radio',
  'options'                 => array('visit', 'page'),
  'default'                 => 'visit',
  'reference'               => &$GLOBALS['TL_LANG']['tl_content']['customVar_scope']['options'],
  'eval'                    => array
  (
    'tl_class'    => 'w50',
    'mandatory'   => true
  ),
  'sql'                     => "varchar(255) NOT NULL default ''"
);
