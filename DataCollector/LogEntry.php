<?php
namespace FS\Log4PhpBundle\DataCollector;

class LogEntry {
	private $node = null;
	
	private $message = '';
	private $logger = '';
	private $level = '';
	private $timestamp = 0;
	
	public function __construct(\DOMNode $node) {
		if ($event = $this->getLogEvent($node)) {
			$this->logger = $event->attributes->getNamedItem('logger')->textContent;
			$this->level = $event->attributes->getNamedItem('level')->textContent;
			$this->timestamp = $event->attributes->getNamedItem('timestamp')->textContent;			
		}
		
		$this->message = $this->getLogMessage($event);
	}
	
	private function getLogMessage(\DOMNode $node) {
		if ($messageNode = $node->childNodes->item(1)) {
			$text = rtrim($messageNode->textContent);
			return ltrim($text);
		}
		
		return '';
	}
	
	private function getLogEvent(\DOMNode $node) {
		if ($event = $node->childNodes->item(1)) {
			return $event;
		}
		
		return null;
	}
	
	/**
	 * @return the $message
	 */
	public function getMessage() {
		return $this->message;
	}

	/**
	 * @return the $logger
	 */
	public function getLogger() {
		return $this->logger;
	}

	/**
	 * @return the $level
	 */
	public function getLevel() {
		return $this->level;
	}

	/**
	 * @return the $timestamp
	 */
	public function getTimestamp() {
		return $this->timestamp;
	}

	
	
}

?>