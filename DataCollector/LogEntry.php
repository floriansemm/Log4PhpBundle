<?php
namespace FS\Log4PhpBundle\DataCollector;

class LogEntry {
	private $message = '';
	private $logger = '';
	private $level = '';
	private $timestamp = 0;
	
	/**
	 * @param \DOMNode $node
	 */
	public function __construct(\DOMNode $node) {
		if ($event = $this->getLogEvent($node)) {
			$this->logger = $this->logAttributes($event, 'logger');
			$this->level = $this->logAttributes($event, 'level');
			$this->timestamp = $this->logAttributes($event, 'timestamp');			
		}
		
		$this->message = $this->getLogMessage($event);
	}
	
	private function logAttributes($event, $attributeName) {
		if ($attribute = $event->attributes->getNamedItem($attributeName)) {
			return $attribute->textContent;
		}
		
		return '';
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

	/**
	 * @return string
	 */
	public function getDate() {
		$timestamp = $this->timestamp / 1000;
		
		return date('H:i:s d.m.Y', $timestamp);
	}	
	
}

?>