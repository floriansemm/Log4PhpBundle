<?php

namespace FS\Log4PhpBundle\DependencyInjection\Configuration;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration for Log4Php
 *
 * @author Florian Semm
 */
class Configuration implements ConfigurationInterface {
    
    /**
     *
     * @return NodeInterface 
     */
    public function getConfigTreeBuilder() {
        $treeBuilder = new TreeBuilder();
        
        $rootNode = $treeBuilder->root('fs_php4_log', 'array');
        $rootNode->children()
                    ->arrayNode('appenders')
                        ->requiresAtLeastOneElement()
                        ->useAttributeAsKey('name')
                        ->prototype('array')                         
                            ->children()
                                ->scalarNode('class')->end()
                                ->arrayNode('layout')
                                    ->children()
                                        ->scalarNode('class')->end()
                                    ->end()    
                                ->end()
                                ->arrayNode('options')
                                    ->useAttributeAsKey('key')
                                    ->prototype('scalar')->end()
                                ->end()   
                            ->end()
                         ->end()               
                     ->end()
                     ->arrayNode('rootLogger')
                        ->children()
                            ->scalarNode('level')->end()
                            ->arrayNode('appenders')->prototype('scalar')->end()                                    
                        ->end()
                     ->end()
                 ->end();
        
        return $treeBuilder->buildTree();
    }
}

?>
