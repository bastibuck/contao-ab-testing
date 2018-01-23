<?php

/**
 * @package     A/B-Testing
 * @author      Basti Buck (http://www.bastibuck.de)
 * @license     LGPLv3+
 * @copyright   Basti Buck (http://www.bastibuck.de)
 */

namespace Bastibuck\ABTesting\ContaoManager;

use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;

// load dependencies
use Contao\CoreBundle\ContaoCoreBundle;
use Bastibuck\ABTesting\BastibuckABTestingBundle;

class ContaoManagerPlugin implements BundlePluginInterface
{
    /**
     * Register Bundle in application
     *
     * @param ParserInterface $parser
     * @return ConfigInterface[]
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(BastibuckABTestingBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class])
        ];
    }
}

