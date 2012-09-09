<?php
namespace FS\Log4PhpBundle\DataCollector;

class LogFile {
	private $logEvents = array();
	private $logFileName = '';

	/**
	 * @param string $logFileName
	 */
	public function __construct($logFileName) {
		$this->logFileName = $logFileName;
	}
	
	/**
	 * @param LogEntry $event
	 */
	public function addLogEvent(LogEvent $event) {
		$this->logEvents[] = $event;
	}
	
	/**
	 * @return array
	 */
	public function getLogEntries() {
		$logEntries = array();
		
		foreach ($this->logEvents as $event) {
			$logEntries = array_merge($logEntries, $event->getLogEntries());
		}
		
		
		return $logEntries;
	}

	/**
	 * @return string
	 */
	public function getLogFileName() {
		return $this->logFileName;
	}
	
}

?>