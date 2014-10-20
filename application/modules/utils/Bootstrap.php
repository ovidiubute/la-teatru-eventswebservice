<?php
/**
 * 
 * Bootstrap for Utils module
 * @author ovidiu.bute
 *
 */
class Utils_Bootstrap extends Zend_Application_Module_Bootstrap
{
	/**
	 * Initialize the logging system.
	 */
	protected function _initLoggingSystem()
	{
		$this->bootstrap('log');
		$log = $this->getResource('log');

		Events_Logger_Utils::initialize($log);
	}
}