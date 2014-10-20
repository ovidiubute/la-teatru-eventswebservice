<?php
/**
 * 
 * Event wrapper class for Theatre module.
 * Used to generate JSON of each Event object contained in the array.
 * 
 * @author ovidiu.bute
 *
 */
class Theatre_Model_Wrapper_Event
{
	public $_events;
	
	/**
	 * 
	 * Constructor.
	 * @param array $events List of Event objects.
	 */
	public function __construct(Array $events)
	{
		if (!empty($events) && $events != null) {
			$this->_events = $events;
		}
	}
	
	/**
	 * 
	 * Generate JSON from array.
	 */
	public function toJson()
	{
		$out = '[';
		foreach ($this->_events as $event) {
			$out .= $event->toJson();
			$out .= ',';	
		}
		$out = substr($out,0,-1);
		$out .= ']';
		
		return $out;
	}
}