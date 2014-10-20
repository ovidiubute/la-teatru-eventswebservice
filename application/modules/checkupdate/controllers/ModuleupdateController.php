<?php
/**
 * 
 * Moduleupdate controller for Checkupdate module.
 * 
 * @author ovidiu.bute
 *
 */
class Checkupdate_ModuleupdateController extends Zend_Rest_Controller
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
    	$module_update = new Checkupdate_Model_Mapper_ModuleupdateMapper();
    	
    	$requestParams = $_GET;
    	if (!empty($requestParams)) {
    	    $result = $module_update->getLatestUpdateTimestamp($requestParams);
    	    if ($result == null) {
    	        $this->getResponse()
    	             ->setHttpResponseCode(404);
    	    } else {
	    	    $this->getResponse()  
	    	         ->appendBody(Zend_Json::encode($result));
    	    }
    	} else {
    		$this->getResponse()
    		     ->setHttpResponseCode(400);
    	}
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