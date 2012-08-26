<?php

namespace FS\Log4PhpBundle\Tests\DataCollector;

use FS\Log4PhpBundle\DataCollector\Log;

/**
 *  test case.
 */
class LogTest extends \PHPUnit_Framework_TestCase {

	private function getLogContent($filename) {
		$logContent = dirname(__FILE__).'/../Resources/'.$filename;
		$logContent = file_get_contents($logContent);
		return $logContent;
	}
	
	public function testGetLogEntries_ValidInputLogContent() {
		$logContent = $this->getLogContent('info.xml');
		$log = new Log($logContent);
		$this->assertEquals(6, count($log->getLogEntries()));
	}
	
}

