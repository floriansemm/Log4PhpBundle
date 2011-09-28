<?php

namespace FS\Log4PhpBundle\DependencyInjection;

use FS\Log4PhpBundle\DependencyInjection\Configuration\Configuration;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;

/**
 *
 * @author Florian Semm
 */
class FSLog4PhpExtension extends Extension {
    public function load(array $configs, ContainerBuilder $container) {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        
        $processor     = new Processor();
        $configuration = new Configuration();

        $config = $processor->process($configuration->getConfigTreeBuilder(), $configs);        
        $configs = $this->mergeOptions($configs);    
        
        $container->getDefinition('php4log.logger')->addMethodCall('configureLogger', $configs);
        
        $container->setAlias('logger', 'php4log.logger');
        

    }
    
    private function mergeOptions(array $configs) {        
        foreach ($configs[0]['appenders'] as $appenderName => $appenderOptions) {
            if (true === array_key_exists('options', $appenderOptions)) {
                $specialApenderOptions = $appenderOptions['options'];
                unset($appenderOptions['options']);
                
                $configs[0]['appenders'][$appenderName] = array_merge($specialApenderOptions, $appenderOptions);
            }
        }
        
        return $configs;
    }

    public function getAlias() {
        return 'fs_log4_php';
    } 
}

?>
