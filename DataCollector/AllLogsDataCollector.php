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
    
    public function __construct($logger) {
        $this->logger = $logger;
    }
    
    public function collect(Request $request, Response $response, \Exception $exception = null) {
        if ($this->logger instanceof \FS\Log4PhpBundle\Logger) {
            $this->data = array(
                'logs' => $this->logger->getLogs()
            );
        } else {
            $this->data = array();
        }
    }
    
    public function getLogs() {
        return isset($this->data['logs'])? $this->data['logs']:array();
    }
    
    public function getName() {
        return 'alllogs';
    }
}

?>
