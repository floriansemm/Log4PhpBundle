<?php

namespace FS\Log4PhpBundle\Tests\DataCollector;

use FS\Log4PhpBundle\DataCollector\LogReader;

/**
 *  test case.
 */
class LogTest extends \PHPUnit_Framework_TestCase {

	private function getLogFile($filename) {
		$logContent = dirname(__FILE__).'/../Resources/'.$filename;
		return $logContent;
	}
	
	public function testGetLogEntries_ValidInputLogContent() {
		$log = new LogReader($this->getLogFile('info.xml'));
		$this->assertEquals(2, count($log->getLogFile()->getLogEntries()));
	}
	
}

