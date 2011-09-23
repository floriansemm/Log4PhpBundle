<?php
namespace FS\Log4PhpBundle;

use Symfony\Component\HttpKernel\Log\LoggerInterface;
use FS\Log4PhpBundle\Wrapper\Log4PhpWrapper;

/**
 * Description of Logger
 *
 * @author Florian
 */
class Logger implements LoggerInterface {
    /**
     *
     * @var LoggerRoot 
     */
    private $logger = null;
    
    private $config = array();
        
    public function configureLogger(array $config) {
        $this->config = $config;
        
        Log4PhpWrapper::configure($this->config, 'LoggerConfiguratorPhp');
        
        $this->logger = Log4PhpWrapper::getRootLogger();
    }
    
    public function alert($message, array $context = array()) {
        
    }

    public function crit($message, array $context = array()) {
        
    }

    public function debug($message, array $context = array()) {
        
    }

    public function emerg($message, array $context = array()) {
        
    }

    public function err($message, array $context = array()) {          
        $this->logger->error($message);
    }

    public function info($message, array $context = array()) {
        
    }

    public function notice($message, array $context = array()) {
        
    }

    public function warn($message, array $context = array()) {
        
    }

}

?>
