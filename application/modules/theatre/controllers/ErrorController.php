<?php
/**
 * 
 * Error controller for Theatre module.
 * 
 * @author ovidiu.bute
 *
 */
class Theatre_ErrorController extends Zend_Controller_Action
{
	/**
     * (non-PHPdoc)
     * @see Zend_Controller_Action::init()
     */
	public function init()
    {
        $this->_helper->viewRenderer->setNoRender(true);
    }
    
    /**
     * 
     * Default error action.
     */
    public function errorAction()
    {
        $errors = $this->_getParam('error_handler');
        
        if (!$errors || !$errors instanceof ArrayObject) {
            return;
        }
        
        switch ($errors->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                // 404 error -- controller or action not found
                $this->getResponse()->setHttpResponseCode(404);
                $priority = Zend_Log::NOTICE;
                break;
            default:
                // application error
                $this->getResponse()->setHttpResponseCode(500);
                $priority = Zend_Log::CRIT;
                break;
        }
        
        // Log exception, if logger available
        if ($log = $this->getLog()) {
            $log->log($errors->exception, $priority, $errors->exception);
        }
    }

    /**
     * 
     * Get application log.
     */
    public function getLog()
    {
        $bootstrap = $this->getInvokeArg('bootstrap')->getResource('modules')->offsetGet('theatre');
        if (!$bootstrap->hasResource('log')) {
            return false;
        }
        $log = $bootstrap->getResource('log');
        return $log;
    }
}