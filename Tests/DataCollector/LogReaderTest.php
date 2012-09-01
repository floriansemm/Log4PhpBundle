<?php

namespace FS\Log4PhpBundle\Tests\DataCollector;

use FS\Log4PhpBundle\DataCollector\LogReader;

/**
 *  test case.
 */
class LogReaderTest extends \PHPUnit_Framework_TestCase {

	private function getLogFile($filename) {
		$logContent = dirname(__FILE__).'/../Resources/'.$filename;
		return $logContent;
	}
	
	public function testGetLogEntries_ValidInputLogContent() {
		$log = new LogReader($this->getLogFile('info.xml'));
		$this->assertEquals(2, count($log->getLogFile()->getLogEntries()));
	}
	
	/**
	 * @expectedException \RuntimeException
	 */
	public function testReaderLogFile_FileNotExist() {
		$log = new LogReader('some/not/existing/path/file.log');
	}
	
	public function testReadLogFile_FileIsEmtpy() {
		$log = new LogReader($this->getLogFile('empty.log'));
		$this->assertEquals(0, count($log->getLogFile()->getLogEntries()));
	}
	
	public function testReadLogFile_FileContainsNotXml() {
		$log = new LogReader($this->getLogFile('not_xml.log'));
		$this->assertEquals(0, count($log->getLogFile()->getLogEntries()));
	}	
}

