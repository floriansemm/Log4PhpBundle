<?php
namespace FS\Log4PhpBundle\DataCollector;

class Log {
	private $logContent = '';
	private $logEntries = array();
	
	const ROOT_NODE_TAG_NAME = 'logEntries';
	
	public function __construct($logContent) {
		$this->logContent = $logContent;
		
		$dom = new \DOMDocument('1.0', 'UTF-8');
		$loaded = @$dom->loadXML($this->logContent);

		if (!$loaded) {
			if (!$loaded = @$dom->loadXML($this->addRootNode())) {
				throw new \RuntimeException('can not load log content');				
			}
		}
		
		foreach ($this->getChildLogEntries($dom) as $logEntryXml) {
			if (preg_match('/log4php:eventSet/', $logEntryXml->getNodePath())) {
				$this->logEntries[] = new LogEntry($logEntryXml);
			}
		}
	}
	
	private function getChildLogEntries(\DOMDocument $dom) {
		if ($root = $dom->getElementsByTagName(self::ROOT_NODE_TAG_NAME)->item(0)->childNodes) {
			return $root;
		}
		
		return array();
	}
	
	private function addRootNode() {
		return '<'.self::ROOT_NODE_TAG_NAME.'>'.$this->logContent.'</'.self::ROOT_NODE_TAG_NAME.'>';
	}
	
	public function getLogEntries() {
		return $this->logEntries;
	}
}

?>