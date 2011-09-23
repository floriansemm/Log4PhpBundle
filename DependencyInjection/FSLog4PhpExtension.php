<?php

namespace FS\Log4PhpBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;

/**
 * Description of Log4PhpExtension
 *
 * @author Florian
 */
class FSLog4PhpExtension extends Extension {
    public function load(array $configs, ContainerBuilder $container) {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        
        $container->getDefinition('php4log.logger')->addMethodCall('configureLogger', $configs);
        
        $container->setAlias('logger', 'php4log.logger');
        

    }

    public function getAlias() {
        return 'fs_log4_php';
    } 
}

?>
