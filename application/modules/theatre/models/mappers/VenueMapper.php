<?php
/**
 * 
 * Venue mapper class for Theatre module.
 * @author ovidiu.bute
 *
 */
class Theatre_Model_Mapper_VenueMapper
{
	protected $_dbTable;
	
	/**
	 * 
	 * Sets the table object.
	 * @param Zend_Db_Table_Abstract $dbTable
	 * @throws Exception
	 */
	public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }
    
    /**
     * 
     * Get the table object.
     */
	public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Theatre_Model_DbTable_Venue');
        }
        return $this->_dbTable;
    }
    
    /**
     * 
     * Insert or update the current Venue object to DB.
     * @param Theatre_Model_Venue $venue
     */
	public function save(Theatre_Model_Venue $venue)
    {
        $data = array(
            'name'   	=> $venue->getName(),
        	'website'	=> $venue->getWebsite(),
        	'address'	=> $venue->getAddress(),
            'lat' 		=> $venue->getLatitude(),
            'lng' 		=> $venue->getLongitude(),
        );
 
        if (null === ($id = $venue->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
    
    /**
     * 
     * Find the Venue object by ID.
     * @param int                 $id    The ID.
     * @param Theatre_Model_Venue $venue The Venue object.
     */
	public function find($id, Theatre_Model_Venue $venue)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $venue->setId($row->id)
              ->setCityId($row->city_id)
              ->setName($row->name)
              ->setWebsite($row->website)
              ->setAddress($row->address)
              ->setLatitude($row->lat)
              ->setLongitude($row->lng);
    }
    
    /**
     * 
     * Find the Venue objects by parameters.
     * @param Array $params GET parameters.
     */
    public function findByParams(Array $params)
    {
    	if (isset($params['city_id']) && is_numeric($params['city_id']) &&
    	          $params['city_id'] > 0) {
    	    $resultSet = $this->getDbTable()->fetchAll(
    	        $this->getDbTable()
    	             ->select()
    	             ->where('city_id=? and hidden=0',$params['city_id'])
    	             ->order('name ASC')
    	    );
    		
    		if (0 == count($resultSet)) {
	            return;
	        }
	        
	        $entries   = array();
	        foreach ($resultSet as $row) {
	        	$entry = new Theatre_Model_Venue();
            	$entry->setId($row->id)
            	      ->setCityId($row->city_id)
                  	  ->setName($row->name)
                  	  ->setWebsite($row->website)
                  	  ->setAddress($row->address)
                  	  ->setLatitude($row->lat)
                  	  ->setLongitude($row->lng);
            	$entries[] = $entry;
	        }
	        return $entries;
    	} elseif (isset($params['countryCode'])) {
    	    $sql = "SELECT th_venue.* FROM th_venue
    	            JOIN th_city ON th_city.id=th_venue.city_id
    	            WHERE th_city.country_code=:country_code AND th_city.hidden=0 AND th_venue.hidden=0
    	            ORDER BY name ASC";
    	    $stmt = $this->getDbTable()->getAdapter()->query($sql,array(':country_code'=>addslashes($params['countryCode'])));
    	    $resultSet = $stmt->fetchAll(Zend_Db::FETCH_OBJ);
    		
    		if (0 == count($resultSet)) {
	            return;
	        }
	        
	        $entries   = array();
	        foreach ($resultSet as $row) {
	        	$entry = new Theatre_Model_Venue();
            	$entry->setId($row->id)
            	      ->setCityId($row->city_id)
                  	  ->setName($row->name)
                  	  ->setWebsite($row->website)
                  	  ->setAddress($row->address)
                  	  ->setLatitude($row->lat)
                  	  ->setLongitude($row->lng);
            	$entries[] = $entry;
	        }
	        return $entries;
    	}
    	return array();
    }
    
    /**
     * 
     * Fetch all objects from DB.
     */
	public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll(
            $this->getDbTable()
                 ->select()
                 ->where('hidden=?',0)
                 ->order('name ASC') 
        );
        
        if (0 == count($resultSet)) {
	        return;
	    }
        
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Theatre_Model_Venue();
            $entry->setId($row->id)
                  ->setCityId($row->city_id)
                  ->setName($row->name)
                  ->setWebsite($row->website)
                  ->setAddress($row->address)
                  ->setLatitude($row->lat)
                  ->setLongitude($row->lng);
            $entries[] = $entry;
        }
        return $entries;
    }
}