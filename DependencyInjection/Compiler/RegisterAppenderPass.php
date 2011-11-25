<?php

namespace FS\Log4PhpBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class RegisterAppenderPass implements CompilerPassInterface {
	public function process(ContainerBuilder $container) {
		$services = $container->findTaggedServiceIds('logger.appender');
		
		foreach ($services as $id => $definition) {

			$appenderConfig = $definition[0];
		    if (!isset($appenderConfig['id'])) {
    			throw new \RuntimeException('The parameter id forLoggerAppender is required.');
    		}
    		
    		$logger = '';
    		if (isset($appenderConfig['logger'])) {
    			$logger = $appenderConfig['logger'];
    		}
    		
			$container->getDefinition($id)->addMethodCall('setName', array($appenderConfig['id']));
			$container->getDefinition('log4php.logger')->addMethodCall('addAppender', array($id, $logger));
		}
		
		
	}
}
