<?php
/**
 * 
 * Event controller for Theatre module.
 * 
 * @author ovidiu.bute
 *
 */
class Theatre_EventController extends Zend_Rest_Controller
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
     * (non-PHPdoc)
     * @see Zend_Rest_Controller::indexAction()
     */
    public function indexAction()
    {
    	Zend_Json::$useBuiltinEncoderDecoder = true;
    	$event = new Theatre_Model_Mapper_EventMapper();
    	
    	$requestParams = $_GET;
    	if (empty($requestParams)) {
    		$eventList = $event->fetchAll();
    	} else {
    		$eventList = $event->findByParams($requestParams);
    	}
    	
    	if (!empty($eventList)) {
    		$eventWrapper = new Theatre_Model_Wrapper_Event($eventList);
    		$this->getResponse()
    			 ->appendBody(Zend_Json::encode($eventWrapper));
    	} else {
    		$this->getResponse()
        		 ->setHttpResponseCode(404);	
    	}
    }

    /**
     * (non-PHPdoc)
     * @see Zend_Rest_Controller::getAction()
     */
    public function getAction()
    {
    	Zend_Json::$useBuiltinEncoderDecoder = true;
        $eventMapper = new Theatre_Model_Mapper_EventMapper();
        $event = new Theatre_Model_Event();
        $eventMapper->find($this->_getParam('id',false), $event);
        if (($id = $event->getId()) !== null) {
        	$this->getResponse()
        		 ->setHttpResponseCode(200)
        		 ->appendBody(Zend_Json::encode($event));
        } else {
        	$this->getResponse()
        		 ->setHttpResponseCode(404);
        }
    }
    
    /**
     * (non-PHPdoc)
     * @see Zend_Rest_Controller::postAction()
     */
    public function postAction()
    {
    	$this->getResponse()
             ->setHttpResponseCode(501);
    }
    
    /**
     * (non-PHPdoc)
     * @see Zend_Rest_Controller::putAction()
     */
    public function putAction()
    {
       	$this->getResponse()
             ->setHttpResponseCode(501);
    }
    
    /**
     * (non-PHPdoc)
     * @see Zend_Rest_Controller::deleteAction()
     */
    public function deleteAction()
    {
		$this->getResponse()
             ->setHttpResponseCode(501);
    }
}