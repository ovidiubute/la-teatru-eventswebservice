<?php 
/**
 * 
 * Moduleupdate model for Checkupdate module.
 * @author ovidiu.bute
 *
 */
class Checkupdate_Model_Moduleupdate 
{
	protected $_id;
	protected $_module;
	protected $_controller;
	protected $_lastUpdate;
	protected $_countryCode;

	public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }
    
    public function toJson()
    {
    	return Zend_Json::encode(array(
    		'id' 			=> $this->_id,
    		'module'		=> $this->_module,
    		'controller'	=> $this->_controller,
			'lastUpdate'	=> $this->_lastUpdate,
			'countryCode'	=> $this->_countryCode,
    	));
    }
    
	public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid module update property');
        }
        $this->$method($value);
    }
    
	public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid module update property');
        }
        return $this->$method();
    }
    
	public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }
    
    public function setId($id)
    {
    	$this->_id = (int) $id;
    	return $this;
    }
    
    public function getId()
    {
    	return $this->_id;
    }
    
	public function setModule($module)
    {
    	$this->_module = $module;
    	return $this;
    }
    
    public function getModule()
    {
    	return $this->_module;
    }
    
	public function setController($controller)
    {
    	$this->_controller = $controller;
    	return $this;
    }
    
    public function getController()
    {
    	return $this->_controller;
    }
    
	public function setLastUpdate($lastUpdate)
    {
    	$this->_lastUpdate = $lastUpdate;
    	return $this;
    }
    
    public function getLastUpdate()
    {
    	return $this->_lastUpdate;
    }
    
	public function setCountryCode($countryCode)
    {
    	$this->_countryCode = $countryCode;
    	return $this;
    }
    
    public function getCountryCode()
    {
    	return $this->_countryCode;
    }
}