<?php

namespace FS\Log4PhpBundle\Tests\DataCollector;


use FS\Log4PhpBundle\DataCollector\LogEntry;

/**
 *  test case.
 */
class LogEntryTest extends \PHPUnit_Framework_TestCase {

	private function getLogContent($filename) {
		$logContent = dirname(__FILE__).'/../Resources/'.$filename;
		$logContent = file_get_contents($logContent);
		
		$dom =  new \DOMDocument('1.0', 'UTF-8');
		$dom->loadXML($logContent);
		
		$eventSet = $dom->getElementsByTagName('root')->item(0)->childNodes->item(1);
		
		return $eventSet;
	}
	
	public function testGetAllLogInformations_ValidInputLogContent() {
		$node = $this->getLogContent('event_set.xml');
		
		$logEntry = new LogEntry($node);
		
		$expectedLogger = 'root';
		$expectedLevel = 'INFO';
		$expectedTimestamp = '1345986293867';
		$expectedLogMessage = 'my log message';
		
		$this->assertEquals($expectedLogger, $logEntry->getLogger(), 'logger');
		$this->assertEquals($expectedLevel, $logEntry->getLevel(), 'level');
		$this->assertEquals($expectedTimestamp, $logEntry->getTimestamp(), 'timestamp');
		$this->assertEquals($expectedLogMessage, $logEntry->getMessage(), 'message');
	}
	
}

