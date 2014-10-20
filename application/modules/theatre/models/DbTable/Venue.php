<?php
/**
 * 
 * Table model for Venue table.
 * @author ovidiu.bute
 *
 */
class Theatre_Model_DbTable_Venue extends Zend_Db_Table_Abstract
{
	protected $_name = 'th_venue';
	
	protected $_referenceMap = array(
		'City' => array(
			'columns'		=> array('city_id'),
			'refTableClass'	=> 'Theatre_Model_DbTable_City',
			'refColumns'	=> array('id')
		),
	);
}