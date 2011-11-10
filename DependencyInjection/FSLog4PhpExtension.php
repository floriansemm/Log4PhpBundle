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

        $container->getDefinition('php4log.logger')->addMethodCall('configureLogger', array($config));
        
        $container->setAlias('logger', 'php4log.logger');
        

    }

    public function getAlias() {
        return 'fs_log4_php';
    } 
}

?>
