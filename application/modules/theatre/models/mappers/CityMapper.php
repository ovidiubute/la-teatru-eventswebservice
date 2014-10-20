<?php
/**
 * 
 * City mapper class for Theatre module.
 * @author ovidiu.bute
 *
 */
class Theatre_Model_Mapper_CityMapper
{
	protected $_dbTable;
	
	/**
	 * 
	 * Set table object.
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
     * Get table object.
     */
	public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Theatre_Model_DbTable_City');
        }
        return $this->_dbTable;
    }
    
    /**
     * 
     * Save object to DB.
     * @param Theatre_Model_City $city
     */
	public function save(Theatre_Model_City $city)
    {
        $data = array(
            'name'   		=> $city->getName(),
        	'lat'			=> $city->getWebsite(),
        	'lng'			=> $city->getAddress(),
            'countryCode' 	=> $city->getLatitude(),
        );
 
        if (null === ($id = $city->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
    
    /**
     * 
     * Find City object by ID.
     * @param int                $id     The ID.
     * @param Theatre_Model_City $city   The City object.
     */
	public function find($id, Theatre_Model_City $city)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $city->setId($row->id)
             ->setName($row->name)
             ->setLatitude($row->lat)
             ->setLongitude($row->lng)
             ->setCountryCode($row->country_code);
    }
    
    /**
     * 
     * Find City objects by parameters.
     * @param Array $params GET params.
     */
    public function findByParams(Array $params)
    {
    	if (isset($params['countryCode'])) {
    		$resultSet = $this->getDbTable()->fetchAll(
    		    $this->getDbTable()
    		         ->select()
    		         ->where('country_code=:country_code AND hidden=:hidden')
    		         ->order('name ASC')
    		         ->bind(
    		             array(
    		         		':country_code'  =>   addslashes($params['countryCode']),
    		         		':hidden'        =>   0
    		             )
    		         )
    		 );

    		if (0 == count($resultSet)) {
	            return;
	        }
	        
	        $entries   = array();
	        foreach ($resultSet as $row) {
	            $entry = new Theatre_Model_City();
	            $entry->setId($row->id)
	            	  ->setName($row->name)
	             	  ->setLatitude($row->lat)
	             	  ->setLongitude($row->lng)
	             	  ->setCountryCode($row->country_code);
	            $entries[] = $entry;
	        }
	        return $entries;
    	} else {
    	    return;
    	}
    }
    
    /**
     * 
     * Get all objects from DB.
     */
	public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll(
            $this->getDbTable()
                 ->select()
                 ->where('hidden=:hidden')
                 ->order('name ASC')
                 ->bind(array(':hidden' => 0))
        );
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Theatre_Model_City();
            $entry->setId($row->id)
            	  ->setName($row->name)
             	  ->setLatitude($row->lat)
             	  ->setLongitude($row->lng)
             	  ->setCountryCode($row->country_code);
            $entries[] = $entry;
        }
        return $entries;
    }
}