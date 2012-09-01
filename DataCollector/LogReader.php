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
		$this->logContent = @file_get_contents($logFile);
		
		if ($this->logContent == false) {
			throw new \RuntimeException(sprintf('Cant read file %s', $logFile));
		}

		libxml_use_internal_errors(true);
		$dom = new \DOMDocument('1.0', 'utf-8');
		$dom->strictErrorChecking = false;
		$dom->recover = true;
		$loaded = @$dom->loadXML($this->addRootNode());
		$this->logFile = new LogFile($logFile);
		
		if ($loaded) {
			$this->logFile = $this->parseXML($dom, $this->logFile);
		}	
	}
	
	private function parseXML(\DOMDocument $dom, LogFile $logfile) {
		foreach ($this->getChildLogEntries($dom) as $logEntryXml) {
			if (preg_match('/log4php:eventSet/', $logEntryXml->getNodePath())) {
				$logfile->addLogEntry(new LogEntry($logEntryXml));
			}
		}
		
		return $logfile;
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