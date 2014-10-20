<?php
/**
 * 
 * Event model for Theatre module.
 * @author ovidiu.bute
 *
 */
class Theatre_Model_Event
{
	protected $_id;
	protected $_venueId;
	protected $_title;
	protected $_detailsStory;
	protected $_detailsTechnical;
	protected $_detailsCast;
	protected $_author;
	protected $_ticketPrice;
	protected $_hall;
	protected $_scheduleWrapper;
	
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
    		'id' 				=>	$this->_id,
    	    'venueId'			=>  $this->_venueId,
    		'title'				=>	$this->_title,
    		'detailsStory'		=>	$this->_detailsStory,
			'detailsTechnical'	=>	$this->_detailsTechnical,
			'detailsCast'		=>	$this->_detailsCast,
			'author'			=>	$this->_author,
    		'ticketPrice'		=>	$this->_ticketPrice,
    		'hall'				=>	$this->_hall,
    		'scheduleList'		=>	$this->_scheduleWrapper->toArray(),
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
            throw new Exception('Invalid event property');
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
            throw new Exception('Invalid event property');
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
    
    public function setVenueId($id)
    {
    	$this->_venueId = (int) $id;
    	return $this;
    }
    
    public function getVenueId()
    {
    	return $this->_venueId;
    }
    
	public function setTitle($title)
    {
        $this->_title = (string) $title;
        return $this;
    }
    
    public function getTitle()
    {
    	return $this->_title;
    }
    
	public function setDetailsStory($detailsStory)
    {
        $this->_detailsStory = (string) $detailsStory;
        return $this;
    }
    
    public function getDetailsStory()
    {
    	return $this->_detailsStory;
    }
    
	public function setDetailsTechnical($detailsTechnical)
    {
        $this->_detailsTechnical = (string) $detailsTechnical;
        return $this;
    }
    
    public function getDetailsTechnical()
    {
    	return $this->_detailsTechnical;
    }
    
	public function setDetailsCast($detailsCast)
    {
        $this->_detailsCast = (string) $detailsCast;
        return $this;
    }
    
    public function getDetailsCast()
    {
    	return $this->_detailsCast;
    }
    
	public function setAuthor($author)
    {
        $this->_author = (string) $author;
        return $this;
    }
    
    public function getAuthor()
    {
    	return $this->_author;
    }
    
    public function setTicketPrice($ticketPrice)
    {
    	$this->_ticketPrice = $ticketPrice;
    	return $this;
    }
    
    public function getTicketPrice()
    {
    	return $this->_ticketPrice;
    }
    
    public function setHall($hall)
    {
    	$this->_hall = $hall;
    	return $this;
    }
    
    public function getHall()
    {
    	return $this->_hall;
    }
    
    public function setScheduleWrapper(Theatre_Model_Wrapper_EventSchedule $scheduleWrapper)
    {
    	$this->_scheduleWrapper = $scheduleWrapper;
    	return $this;
    }
    
    public function getScheduleWrapper()
    {
    	return $this->_scheduleWrapper;
    }
}