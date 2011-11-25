<?php

namespace FS\Log4PhpBundle;

use Symfony\Component\DependencyInjection\Compiler\PassConfig;

use FS\Log4PhpBundle\DependencyInjection\Compiler\RegisterAppenderPass;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
/**
 *
 * @author Florian Semm
 */
class FSLog4PhpBundle extends Bundle {
	public function build(ContainerBuilder $container) {
		parent::build($container);
		
		$container->addCompilerPass(new RegisterAppenderPass(), PassConfig::TYPE_BEFORE_OPTIMIZATION);
	}
}

?>
