<?php
namespace FS\Log4PhpBundle;

use Symfony\Component\HttpKernel\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;
use FS\Log4PhpBundle\Wrapper\Log4PhpWrapper;

/**
 *
 * @author Florian Semm
 */
class Logger implements LoggerInterface {
    /**
     *
     * @var LoggerRoot 
     */
    private $logger = null;
    
    /**
     *
     * @var array 
     */
    private $config = array();
        
    /**
     *
     * @var array 
     */
    private $messages = array();
    
    public function configureLogger(array $config) {
        $this->config = $config;
        
        Log4PhpWrapper::configure($this->config, 'LoggerConfiguratorPhp');
        
        $this->logger = Log4PhpWrapper::getRootLogger();
    }
    
    private function getLogger(array $context = array()) {
        $logger = $this->logger;
        
        if (array_key_exists('app', $context)) {
            $logger = Log4PhpWrapper::getLogger($context['app']);
        }
        
        return $logger;
    }    
    
    private function addMessage($message, $prio, $loggerName = 'root') {
        $message = array(
                'timestamp'    => time(),
                'message'      => $message,
                'priority'     => $prio,
                'priorityName' => $prio,
                'context'      => $loggerName,
            );
        
        if (false == array_key_exists($prio, $this->messages)) {
            $this->messages[$prio] = array();
        }
        
        $messagesOfPrio = $this->messages[$prio];
        $messagesOfPrio[] = $message;
        $this->messages[$prio] = $messagesOfPrio;
    }
    
    public function alert($message, array $context = array()) {
        $logger = $this->getLogger($context);
        $this->addMessage($message, 'alert', $logger->getName());
        
        $this->logger->error($message);
    }

    public function crit($message, array $context = array()) {
        $logger = $this->getLogger($context);
        $this->addMessage($message, 'critical', $logger->getName());
        
        $this->logger->fatal($message);
    }

    public function debug($message, array $context = array()) {
        $logger = $this->getLogger($context);
        $this->addMessage($message, 'debug', $logger->getName());
        
        $this->logger->debug($message);
    }

    public function emerg($message, array $context = array()) {
        $logger = $this->getLogger($context);
        $this->addMessage($message, 'emerg', $logger->getName());
        
        $this->logger->fatal($message);
    }

    public function err($message, array $context = array()) {  
        $logger = $this->getLogger($context);
        $this->addMessage($message, 'error', $logger->getName());
        
        $this->logger->error($message);
    }

    public function info($message, array $context = array()) {
        $logger = $this->getLogger($context);
        $this->addMessage($message, 'info', $logger->getName());
        
        $logger->info($message);
    }

    public function notice($message, array $context = array()) {
        $logger = $this->getLogger($context);
        $this->addMessage($message, 'notice', $logger->getName());
        
        $this->logger->info($message);
    }

    public function warn($message, array $context = array()) {
        $logger = $this->getLogger($context);
        $this->addMessage($message, 'warning', $logger->getName());
        
        $this->logger->warn($message);
    }

    public function getLogs() {
        return $this->messages;
    }
}

?>
