<?php
/**
 * 
 * Venue controller for Theatre module.
 * 
 * @author ovidiu.bute
 *
 */
class Theatre_VenueController extends Zend_Rest_Controller
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
    	$venue = new Theatre_Model_Mapper_VenueMapper();
    	
    	$requestParams = $_GET;
    	if (empty($requestParams)) {
    		$venueList = $venue->fetchAll();
    	} else {
    		$venueList = $venue->findByParams($requestParams);
    	}
    	
    	if (!empty($venueList)) {
    		$venueWrapper = new Theatre_Model_Wrapper_Venue($venueList);
    		$this->getResponse()
    			 ->appendBody(Zend_Json::encode($venueWrapper));
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
        $venueMapper = new Theatre_Model_Mapper_VenueMapper();
        $venue = new Theatre_Model_Venue();
        $venueMapper->find($this->_getParam('id',0), $venue);
        if (($id = $venue->getId()) !== null) {
        	$this->getResponse()
        		 ->appendBody(Zend_Json::encode($venue));
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