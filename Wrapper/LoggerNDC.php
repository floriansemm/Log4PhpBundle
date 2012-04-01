<?php
namespace FS\Log4PhpBundle\Wrapper;

/**
 * 
 * @author Florian Semm
 *
 */
class LoggerNDC {
	
	/* (non-PHPdoc)
	 * @see LoggerNDC::clear()
	 */
	public function clear() {
		\LoggerNDC::clear();
	}

	/* (non-PHPdoc)
	 * @see LoggerNDC::get()
	 */
	public function get() {
		return \LoggerNDC::get();		
	}

	/* (non-PHPdoc)
	 * @see LoggerNDC::getDepth()
	 */
	public function getDepth() {
		return \LoggerNDC::getDepth();
		
	}

	/* (non-PHPdoc)
	 * @see LoggerNDC::peek()
	 */
	public function peek() {
		return \LoggerNDC::peek();
	}

	/* (non-PHPdoc)
	 * @see LoggerNDC::pop()
	 */
	public function pop() {
		return \LoggerNDC::pop();
	}

	/* (non-PHPdoc)
	 * @see LoggerNDC::push()
	 */
	public function push($message) {
		\LoggerNDC::push($message);
	}

	/* (non-PHPdoc)
	 * @see LoggerNDC::remove()
	 */
	public function remove() {
		\LoggerNDC::remove();
	}

	/* (non-PHPdoc)
	 * @see LoggerNDC::setMaxDepth()
	 */
	public static function setMaxDepth($maxDepth) {
		\LoggerNDC::setMaxDepth($maxDepth);
	}
}

?>