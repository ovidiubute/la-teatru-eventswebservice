<?php
/**
 * 
 * Bootstrap class for Application.
 * @author ovidiu.bute
 *
 */
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    /**
     * 
     * Initialize the REST route.
     */
	protected function _initRestRoute()
	{
	    $this->bootstrap('frontController');
	    $frontController = Zend_Controller_Front::getInstance();
		
	    $restRoute = new Zend_Rest_Route($frontController);
	    $frontController->getRouter()->addRoute('default', $restRoute);
	}
	
	/**
	 * 
	 * Initialize Zend Configuration object.
	 */
	protected function _initConfig()
	{
	    $config = new Zend_Config($this->getOptions(), true);
	    Zend_Registry::set('config', $config);
	    return $config;
	}
}

