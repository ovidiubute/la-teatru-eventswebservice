<?php
/**
 * 
 * Bootstrap class for Checkupdate module.
 * @author obu
 *
 */
class Checkupdate_Bootstrap extends Zend_Application_Module_Bootstrap
{
	/**
	 * Initialize the logging system.
	 */
	protected function _initLoggingSystem()
	{
		$this->bootstrap('log');
		$log = $this->getResource('log');

		Events_Logger_Checkupdate::initialize($log);
	}
}