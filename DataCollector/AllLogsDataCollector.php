<?php

namespace FS\Log4PhpBundle\DataCollector;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

/**
 *
 * @author Florian Semm
 */
class AllLogsDataCollector extends DataCollector {
    
    /**
     *
     * @var \FS\Log4PhpBundle\Logger 
     */
    private $logger;
    
    private $logFiles = array();
    
    public function collect(Request $request, Response $response, \Exception $exception = null) {
    	foreach ($this->logFiles as $logFile) {
    		$logContent = file_get_contents($logFile);
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
