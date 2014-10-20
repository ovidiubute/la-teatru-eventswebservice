<?php
/**
 * 
 * Venue model for Theatre module.
 * @author ovidiu.bute
 *
 */
class Theatre_Model_Venue
{
	protected $_id;
	protected $_cityId;
	protected $_name;
	protected $_latitude;
	protected $_longitude;
	protected $_website;
	protected $_address;
	
	/**
	 * 
	 * Constructor.
	 * @param array $options
	 */
	public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }
    
    /**
	 * 
	 * Generate JSON.
	 */
    public function toJson()
    {
    	return Zend_Json::encode(array(
    		'id' 		=> $this->_id,
    	    'cityId'	=> $this->_cityId,
    		'name'		=> $this->_name,
    		'latitude'	=> $this->_latitude,
			'longitude'	=> $this->_longitude,
			'website'	=> $this->_website,
			'address'	=> $this->_address,
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
            throw new Exception('Invalid venue property');
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
            throw new Exception('Invalid venue property');
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
    
    public function setCityId($id)
    {
    	$this->_cityId = (int) $id;
    	return $this;
    }
    
    public function getCityId()
    {
    	return $this->_cityId;
    }
    
	public function setName($name)
    {
        $this->_name = (string) $name;
        return $this;
    }
    
    public function getName()
    {
    	return $this->_name;
    }
    
	public function setWebsite($website)
    {
        $this->_website = (string) $website;
        return $this;
    }
    
    public function getWebsite()
    {
    	return $this->_website;
    }
    
	public function setAddress($address)
    {
        $this->_address = (string) $address;
        return $this;
    }
    
    public function getAddress()
    {
    	return $this->_address;
    }
    
	public function setLatitude($latitude)
    {
        $this->_latitude = (float) $latitude;
        return $this;
    }
    
    public function getLatitude()
    {
    	return $this->_latitude;
    }
    
	public function setLongitude($longitude)
    {
        $this->_longitude = (float) $longitude;
        return $this;
    }
    
    public function getLongitude()
    {
    	return $this->_longitude;
    }
}