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
        			->arrayNode('viewer')
	        			->beforeNormalization()
		        			->ifTrue(function($v){
		        				return $v['view_all_logs'];
		        			})
		        			->then(function($v){
		        				$v['log_files'] = array();
		        				return $v;
		        			})
		        			->end()        			
        				->children()
	        				->booleanNode('view_all_logs')->end()
	        				->arrayNode('log_files')
                                ->prototype('scalar')->end()
	        				->end()
        				->end()
        			->end()
                    ->arrayNode('renderers')
                        ->defaultNull()
                        ->useAttributeAsKey('name')
                        ->prototype('array')
                            ->children()
                                ->scalarNode('renderedClass')->cannotBeEmpty()->end()
                                ->scalarNode('renderingClass')->cannotBeEmpty()->end()
                            ->end()                        
                        ->end()
                    ->end()
                    ->scalarNode('threshold')->defaultNull()->end()
                    ->arrayNode('appenders')               
                        ->requiresAtLeastOneElement()
                        ->useAttributeAsKey('name')
                        ->prototype('array')
                            ->children()
                                ->scalarNode('class')->end()
                                ->arrayNode('layout')
                                    ->children()                                        
                                        ->scalarNode('class')->cannotBeEmpty()->end()
                                        ->arrayNode('params')
                                            ->useAttributeAsKey('name')
                                            ->prototype('scalar')->end()
                                        ->end()
                                    ->end()    
                                ->end()
                                ->arrayNode('filters')                
                                    ->useAttributeAsKey('name')
                                    ->prototype('array')   
                                        ->children()
                                            ->scalarNode('class')->cannotBeEmpty()->end()
                                            ->arrayNode('params')
                                                ->useAttributeAsKey('name')
                                                ->prototype('scalar')->end()
                                            ->end()
                                        ->end()    
                                    ->end()        
                                ->end()
                                ->arrayNode('params')
                                    ->useAttributeAsKey('key')
                                    ->prototype('scalar')->end()
                                ->end()
                                ->scalarNode('threshold')->defaultNull()->end()
                            ->end()
                         ->end()               
                     ->end()
                     ->arrayNode('rootLogger')
                        ->children()
                            ->scalarNode('level')->end()
                            ->arrayNode('appenders')->prototype('scalar')->end()                                    
                        ->end()
                     ->end()
                ->end()
                     ->arrayNode('loggers')                
                        ->requiresAtLeastOneElement()
                        ->useAttributeAsKey('name')
                        ->prototype('array')                         
                            ->children()
                                ->scalarNode('level')->end()
                                ->booleanNode('additivity')->defaultTrue()->end()    
                                ->arrayNode('appenders')->prototype('scalar')->end()
                            ->end()
                         ->end() 
                     ->end()
                 ->end();
        
        return $treeBuilder->buildTree();
    }
}

?>
