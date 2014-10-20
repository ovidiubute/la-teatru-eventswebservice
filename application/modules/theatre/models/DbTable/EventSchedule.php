<?php
/**
 * 
 * Table model for EventSchedule table.
 * @author ovidiu.bute
 *
 */
class Theatre_Model_DbTable_EventSchedule extends Zend_Db_Table_Abstract
{
	protected $_name = 'th_event_schedule';
	
	protected $_referenceMap = array(
		'Event' => array(
			'columns'		=> array('event_id'),
			'refTableClass'	=> 'Theatre_Model_DbTable_Event',
			'refColumns'	=> array('id')
		),
	);
}