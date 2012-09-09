<?php
namespace FS\Log4PhpBundle\DataCollector;

class LogEvent {
	private $logEntries = array();
	
	public function __construct(\DOMNode $node) {
		if ($node->childNodes) {
			foreach ($node->childNodes as $logevent) {
				if ($logevent instanceof \DOMText) {
					continue;
				}
				
				$this->logEntries[] = new LogEntry($logevent);
			}
			
			
		}
	}
	
	public function getLogEntries() {
		return $this->logEntries;
	}
}

?>