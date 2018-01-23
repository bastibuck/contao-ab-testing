<?php

/**
 * @package     A/B-Testing
 * @author      Basti Buck (http://www.bastibuck.de)
 * @license     LGPL
 * @copyright   Basti Buck, 2017
 */

// Palettes
$GLOBALS['TL_DCA']['tl_page']['palettes']['ab_testing'] = '
  {title_legend},title,alias,type;
  {redirect_legend},ab_pages,ab_cookie_name,ab_cookie_expires;
  {protected_legend:hide},protected;
  {chmod_legend:hide},includeChmod;
  {expert_legend:hide},cssClass,sitemap,hide,guests;
  {tabnav_legend:hide},tabindex,accesskey;
  {publish_legend},published;
';

// Fields
$GLOBALS['TL_DCA']['tl_page']['fields']['ab_lastPage'] = array
(
  'sql'                     => "int(10) unsigned NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_page']['fields']['ab_pages'] = array
(
  'label'                   => &$GLOBALS['TL_LANG']['tl_page']['ab_pages'],
  'exclude'                 => true,
  'inputType'               => 'pageTree',
  'foreignKey'              => 'tl_page.title',
  'save_callback' => array
  (
    array('Bastibuck\tl_page', 'checkABPages')
  ),
  'eval'                    => array
  (
    'multiple'    => true,
    'fieldType'   => 'checkbox',
    'mandatory'   => true),
  'sql'                     => "blob NULL",
  'relation'                => array
  (
    'type'        => 'hasMany',
    'load'        => 'lazy'
  )
);

$GLOBALS['TL_DCA']['tl_page']['fields']['ab_cookie_name'] = array
(
  'label'                   => &$GLOBALS['TL_LANG']['tl_page']['ab_cookie_name'],
  'exclude'                 => true,
  'inputType'               => 'text',
  'eval'                    => array
  (
    'tl_class'    => 'w50',
    'mandatory'   => true
  ),
  'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_page']['fields']['ab_cookie_expires'] = array
(
  'label'                   => &$GLOBALS['TL_LANG']['tl_page']['ab_cookie_expires'],
  'exclude'                 => true,
  'inputType'               => 'text',
  'default'                 => 0,
  'eval'                    => array
  (
    'rgxp'        => 'natural',
    'tl_class'    => 'w50',
    'mandatory'   => true
  ),
  'sql'                     => "int(10) unsigned NOT NULL default '0'"
);


/**
 * class providing small functions for tl_page
 */
class tl_page extends \Backend {
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
