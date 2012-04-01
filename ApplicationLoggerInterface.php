<?php
namespace FS\Log4PhpBundle;

use Symfony\Component\HttpKernel\Log\LoggerInterface;

interface ApplicationLoggerInterface extends LoggerInterface {
	
	/**
	 * @return \LoggerNDC
	 */
	public function getLoggerMDC();
	
	/**
	 * @return \LoggerMDC
	 */
	public function getLoggerNDC();
}

?>