<?php 
/**
 * 
 * Moduleupdate mapper class for checkupdate module.
 * @author ovidiu.bute
 *
 */
class Checkupdate_Model_Mapper_ModuleupdateMapper
{
	protected $_dbTable;
	
	/**
	 * 
	 * Set table object.
	 * 
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
            $this->setDbTable('Checkupdate_Model_DbTable_Moduleupdate');
        }
        return $this->_dbTable;
    }
    
    /**
     * 
     * Get the timestamp at which the requested module/controller 
     * @param   array                          $requestParams      GET parameters.
     * @return  Checkupdate_Model_Moduleupdate $check              Result object.
     */
	public function getLatestUpdateTimestamp($requestParams)
    {
    	if (empty($requestParams)) {
    		return null;
    	}
    	
    	if ($requestParams['module'] && $requestParams['controller']) {
    		$module = addslashes($requestParams['module']);
    		$controller = addslashes($requestParams['controller']);
    	}
        $row = $this->getDbTable()->fetchRow(
        	array("module = '$module' AND controller = '$controller'")
        );
        if (0 == count($row)) {
            return;
        }
        $check = new Checkupdate_Model_Moduleupdate();

        $date = new Zend_Date($row->last_update);
        $check->setId($row->id)
             ->setModule($row->module)
             ->setController($row->controller)
             ->setLastUpdate($date->getTimestamp())
             ->setCountryCode($row->country_code);
             
		return $check;
    }
}