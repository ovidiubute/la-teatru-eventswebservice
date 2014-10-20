<?php
/**
 * 
 * City controller for Theatre module.
 * 
 * @author ovidiu.bute
 *
 */
class Theatre_CityController extends Zend_Rest_Controller
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
    	$city = new Theatre_Model_Mapper_CityMapper();
    	
    	$requestParams = $_GET;
    	if (empty($requestParams)) {
	    	$cityList = $city->fetchAll();
    	} else {
    		$cityList = $city->findByParams($requestParams);
    	}
    	
    	if (!empty($cityList)) {
    		$cityWrapper = new Theatre_Model_Wrapper_City($cityList);
    		$this->getResponse()
    			 ->appendBody(Zend_Json::encode($cityWrapper));
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
        $cityMapper = new Theatre_Model_Mapper_CityMapper();
        $city = new Theatre_Model_City();
        $cityMapper->find($this->_getParam('id',false), $city);
        if (($id = $city->getId()) !== null) {
        	$this->getResponse()
        		 ->setHttpResponseCode(200)
        		 ->appendBody(Zend_Json::encode($city));
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