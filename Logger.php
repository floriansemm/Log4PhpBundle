<?php
namespace FS\Log4PhpBundle;

use FS\Log4PhpBundle\Wrapper\LoggerMDC;

use FS\Log4PhpBundle\Wrapper\LoggerNDC;

use Symfony\Component\HttpKernel\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;
use FS\Log4PhpBundle\Wrapper\Logger as Log4phpLogger;

/**
 *
 * @author Florian Semm
 */
class Logger implements ApplicationLoggerInterface {
    /**
     *
     * @var LoggerRoot 
     */
    private $logger = null;
        
    /**
     *
     * @var array 
     */
    private $messages = array();
    
    private $container;
    
    public function __construct($container) {
    	$this->container = $container;
    }
    
    public function configureLogger(array $config) {
        Log4phpLogger::configure($config);
        
        $this->logger = Log4phpLogger::getRootLogger();
    }
    
    /**
     * 
     * @param array $context
     * @return \Logger
     */
    private function getLogger(array $context = array()) {
        $logger = $this->logger;
        
        if (array_key_exists('logger', $context)) {
            $logger = Log4phpLogger::getLogger($context['logger']);
        }
        
        return $logger;
    } 

    /**
     * @return LoggerMDC
     */
    public function getLoggerMDC() {
    	return new LoggerMDC();
    }
    
    /**
     * @return LoggerNDC
     */
    public function getLoggerNDC() {
		return new LoggerNDC();    	
    }    
    
    /**
     * 
     * @param string $appenderName
     * @param string $logger
     */
    public function addAppender($appenderId, $logger = '') {
    	if (!$this->logger instanceof \Logger) {
    		return;
    	}

    	$context = array();
    	if ($logger != '') {
    		$context['app'] = $logger;
    	}
    	
    	$logger = $this->getLogger($context);
    	$logger->addAppender($this->container->get($appenderId));
    }
    
    private function addMessage($message, $priority, $loggerName = 'root') {
        $message = array(
                'timestamp'    => time(),
                'message'      => $message,
                'priority'     => $priority,
                'priorityName' => $priority,
                'context'      => $loggerName,
            );
        
        if (false == array_key_exists($priority, $this->messages)) {
            $this->messages[$priority] = array();
        }
        
        $messagesOfPrio = $this->messages[$priority];
        $messagesOfPrio[] = $message;
        $this->messages[$priority] = $messagesOfPrio;
        ksort($this->messages);
    }
    
    public function alert($message, array $context = array()) {
        $logger = $this->getLogger($context);
        $this->addMessage($message, 'alert', $logger->getName());
        
        $logger->error($message);
    }

    public function crit($message, array $context = array()) {
        $logger = $this->getLogger($context);
        $this->addMessage($message, 'critical', $logger->getName());
        
        $logger->fatal($message);
    }

    public function debug($message, array $context = array()) {
        $logger = $this->getLogger($context);
        $this->addMessage($message, 'debug', $logger->getName());
        
        $logger->debug($message);
    }

    public function emerg($message, array $context = array()) {
        $logger = $this->getLogger($context);
        $this->addMessage($message, 'emerg', $logger->getName());
        
        $logger->fatal($message);
    }

    public function err($message, array $context = array()) {  
        $logger = $this->getLogger($context);
        $this->addMessage($message, 'error', $logger->getName());
        
        $logger->error($message);
    }

    public function info($message, array $context = array()) {
        $logger = $this->getLogger($context);
        $this->addMessage($message, 'info', $logger->getName());
        
        $logger->info($message);
    }

    public function notice($message, array $context = array()) {
        $logger = $this->getLogger($context);
        $this->addMessage($message, 'notice', $logger->getName());
        
        $logger->info($message);
    }

    public function warn($message, array $context = array()) {
        $logger = $this->getLogger($context);
        $this->addMessage($message, 'warning', $logger->getName());
        
        $logger->warn($message);
    }

    public function getLogs() {
        return $this->messages;
    }
}

?>
