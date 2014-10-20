<?php
/**
 * 
 * EventSchedule model for Theatre module.
 * @author ovidiu.bute
 *
 */
class Theatre_Model_EventSchedule
{
	protected $_id;
	protected $_timestamp;
	
	/**
	 * 
	 * Generate JSON.
	 */
	public function toJson()
    {
    	return Zend_Json::encode(array(
    		'id' 				=>	$this->_id,
    		'timestamp'			=> 	$this->_timestamp,
    	));
    }
    
    /**
     * 
     * Generic setter.
     * @param string $name
     * @param mixed $value
     */
	public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid event_schedule property');
        }
        $this->$method($value);
    }
    
    /**
     * 
     * Generic getter.
     * @param string $name
     */
	public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid event_schedule property');
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
    
	public function setTimestamp($timestamp)
    {
    	$this->_timestamp = (string) $timestamp;
    	return $this;
    }
    
    public function getTimestamp()
    {
    	return $this->_timestamp;
    }
}