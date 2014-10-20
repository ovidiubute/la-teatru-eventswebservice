<?php
/**
 * 
 * Index controller for Theatre module.
 * 
 * @author ovidiu.bute
 *
 */
class Theatre_IndexController extends Zend_Controller_Action
{
    /**
     * (non-PHPdoc)
     * @see Zend_Controller_Action::init()
     */
    public function init()
    {
    }

    /**
     * 
     * Default action.
     */
    public function indexAction()
    {
        $this->getResponse()
             ->setHttpResponseCode(501);
    }
}

