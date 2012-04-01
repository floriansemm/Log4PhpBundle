<?php
namespace FS\Log4PhpBundle\Wrapper;

/**
 * 
 * @author Florian Semm
 *
 */
class LoggerMDC {
	
	/**
	 * @see \LoggerMDC::put()
	 */
	public function put($key, $value) {
		\LoggerMDC::put($key, $value);
	}

	/**
	 * @see \LoggerMDC:get()
	 */
	public function get($key) {
		return \LoggerMDC::get($key);
	}
	
	/**
	 * @see \LoggerMDC::remove()
	 */
	public function remove($key) {
		\LoggerMDC::remove($key);
	}
}

?>