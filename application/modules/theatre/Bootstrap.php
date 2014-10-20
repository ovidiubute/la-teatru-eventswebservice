<?php
/**
 * 
 * Bootstrap for Theatre module
 * @author ovidiu.bute
 *
 */
class Theatre_Bootstrap extends Zend_Application_Module_Bootstrap
{
	/**
	 * Initialize the logging system.
	 */
	protected function _initLoggingSystem()
	{
		$this->bootstrap('log');
		$log = $this->getResource('log');

		Events_Logger_Theatre::initialize($log);
	}
}