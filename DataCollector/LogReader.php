<?php
namespace FS\Log4PhpBundle\DataCollector;

class LogReader {
	private $logContent = '';
	
	/**
	 * @var LogFile
	 */
	private $logFile = array();
	
	const ROOT_NODE_TAG_NAME = 'root';
	
	public function __construct($logFile) {
		$this->logContent = $logContent = file_get_contents($logFile);
		
		$dom = new \DOMDocument('1.0', 'utf-8');
		$dom->recover = true;
		$dom->loadXML($this->addRootNode());
			
		$this->logFile = new LogFile($logFile);
		foreach ($this->getChildLogEntries($dom) as $logEntryXml) {
			if (preg_match('/log4php:eventSet/', $logEntryXml->getNodePath())) {
				$this->logFile->addLogEntry(new LogEntry($logEntryXml));
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
		return '<'.self::ROOT_NODE_TAG_NAME.'>'.$this->logContent.'</log4php:eventSet></'.self::ROOT_NODE_TAG_NAME.'>';
	}
	
	/**
	 * 
	 * @return \FS\Log4PhpBundle\DataCollector\LogFile
	 */
	public function getLogFile() {
		return $this->logFile;
	}
}

?>