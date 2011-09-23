<?php

namespace FS\Log4PhpBundle\DependencyInjection\Configuration;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Description of Configuration
 *
 * @author Florian
 */
class Configuration implements ConfigurationInterface {
    
    public function getConfigTreeBuilder() {
        $treeBuilder = new TreeBuilder();
    }
}

?>
