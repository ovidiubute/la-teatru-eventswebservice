<?php
/**
 * 
 * Time controller for Utils module.
 * 
 * @author ovidiu.bute
 *
 */
class Utils_TimeController extends Zend_Rest_Controller
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
    	$dateTime = new Zend_Date();
    	
    	$dateTimeWrapper = array();
    	$dateTimeWrapper['serverTime'] = $dateTime->getTimestamp();
        $dateTimeWrapper['serverTimezone'] = $dateTime->getTimezone();
    	$this->getResponse()  
	    	 ->appendBody(Zend_Json::encode((object)$dateTimeWrapper));
    }

    /**
     * (non-PHPdoc)
     * @see Zend_Rest_Controller::getAction()
     */
    public function getAction()
    {
        $this->getResponse()
             ->setHttpResponseCode(501);
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