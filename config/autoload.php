<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2017 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'Bastibuck',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'Bastibuck\ABTestingHooks'       => 'system/modules/ab_testing/classes/ABTestingHooks.php',

	// Pages
	'Bastibuck\PageABTesting' => 'system/modules/ab_testing/pages/PageABTesting.php',
));
