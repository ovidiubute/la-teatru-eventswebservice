<?php
/**
 * 
 * EventSchedule wrapper class for Theatre module.
 * Used to generate JSON of each EventSchedule object contained in the array.
 * 
 * @author ovidiu.bute
 *
 */
class Theatre_Model_Wrapper_EventSchedule
{
	private $_eventScheduleList;
	
	/**
	 * 
	 * Constructor.
	 * @param array $events List of EventSchedule objects.
	 */
	public function __construct(Array $eventScheduleList)
	{
		if (!empty($eventScheduleList) && $eventScheduleList != null) {
			$this->_eventScheduleList = $eventScheduleList;
		}
	}
	
	/**
	 * 
	 * Add schedule object to array.
	 * @param int $timestamp
	 */
	public function addSchedule($timestamp) {
		$schedule =  new Theatre_Model_EventSchedule();
		$schedule->setTimestamp($timestamp);
		
		$this->_eventScheduleList[] = $schedule;
	}
	
	/**
	 * 
	 * Generate JSON from array.
	 */
	public function toJson()
	{
		$out = '[';
		foreach ($this->_eventScheduleList as $eventSchedule) {
			$out .= $eventSchedule->toJson();
			$out .= ',';	
		}
		$out = substr($out,0,-1);
		$out .= ']';
		
		return $out;
	}
	
	public function toArray()
	{
		$out = array();
		foreach ($this->_eventScheduleList as $eventSchedule)
		{
			$out[] = $eventSchedule->getTimestamp();
		}
		return $out;
	}
}