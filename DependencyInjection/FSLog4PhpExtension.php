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

        if ($config['viewer']['view_all_logs'] == true) {
			foreach ($config['appenders'] as $appenderName => $appenderConfig) {
				if (isset($appenderConfig['params']) && isset($appenderConfig['params']['file'])) {
					$config['viewer']['log_files'][] = $appenderConfig['params']['file'];
				}
			}
    	}
        
		$container->getDefinition('log4php.data_collector.alllogs')->addMethodCall('setLogFile', array($config['viewer']['log_files']));
        $container->getDefinition('log4php.logger')->addMethodCall('configureLogger', array($config));
        
        $container->setAlias('logger', 'log4php.logger');
    }

    public function getAlias() {
        return 'fs_log4_php';
    } 
}

?>
