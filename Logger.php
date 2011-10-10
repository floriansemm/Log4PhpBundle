<?php
namespace FS\Log4PhpBundle;

use Symfony\Component\HttpKernel\Log\LoggerInterface;
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
        
    public function configureLogger(array $config) {
        $this->config = $config;
        
        Log4PhpWrapper::configure($this->config, 'LoggerConfiguratorPhp');
        
        $this->logger = Log4PhpWrapper::getRootLogger();
    }
    
    public function getLogger($name) {
        $this->logger = Log4PhpWrapper::getLogger($name);
        
        return $this;
    }
    
    public function alert($message, array $context = array()) {
        $this->logger->error($message);
    }

    public function crit($message, array $context = array()) {
        $this->logger->fatal($message);
    }

    public function debug($message, array $context = array()) {
        $this->logger->debug($message);
    }

    public function emerg($message, array $context = array()) {
        $this->logger->fatal($message);
    }

    public function err($message, array $context = array()) {          
        $this->logger->error($message);
    }

    public function info($message, array $context = array()) {
        $this->logger->info($message);
    }

    public function notice($message, array $context = array()) {
        $this->logger->info($message);
    }

    public function warn($message, array $context = array()) {
        $this->logger->warn($message);
    }

}

?>
