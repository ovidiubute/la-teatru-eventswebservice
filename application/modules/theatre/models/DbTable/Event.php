<?php
/**
 * 
 * Table model for Event table.
 * @author ovidiu.bute
 *
 */
class Theatre_Model_DbTable_Event extends Zend_Db_Table_Abstract
{
	protected $_name = 'th_event';
	
	protected $_referenceMap = array(
		'Venue' => array(
			'columns'		=> array('venue_id'),
			'refTableClass'	=> 'Theatre_Model_DbTable_Venue',
			'refColumns'	=> array('id')
		),
	);
}