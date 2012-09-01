<?php
namespace FS\Log4PhpBundle\DataCollector;

class LogFile {
	private $logEntries = array();
	private $logFileName = '';
	
	public function __construct($logFileName) {
		$this->logFileName = $logFileName;
	}
	
	public function addLogEntry(LogEntry $entry) {
		$this->logEntries[] = $entry;
	}
	
	/**
	 * @return array
	 */
	public function getLogEntries() {
		return $this->logEntries;
	}

	/**
	 * @return string
	 */
	public function getLogFileName() {
		return $this->logFileName;
	}
	
}

?>