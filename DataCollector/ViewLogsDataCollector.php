<?php

namespace FS\Log4PhpBundle\DataCollector;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

/**
 *
 * @author Florian Semm
 */
class ViewLogsDataCollector extends DataCollector {
    
    /**
     *
     * @var \FS\Log4PhpBundle\Logger 
     */
    private $logger;
    
    private $logFiles = array();
    
    public function collect(Request $request, Response $response, \Exception $exception = null) {
    	
    	$logs = array();
    	foreach ($this->logFiles as $logFile) {
    		$logReader = new LogReader($logFile);
    		
    		$this->data['logs'][] = $logReader->getLogFile();
    	}
    }
    
    public function setLogFile(array $logFiles) {
    	$this->logFiles = $logFiles;
    }
    
    public function getLogs() {
        return isset($this->data['logs'])? $this->data['logs']:array();
    }
    
    public function getName() {
        return 'alllogs';
    }
}

?>
