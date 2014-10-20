<?php
/**
 * 
 * Venue wrapper class for Theatre module.
 * Used to generate JSON of each Venue object contained in the array.
 * 
 * @author ovidiu.bute
 *
 */
class Theatre_Model_Wrapper_Venue
{
	public $_venues;
	
	/**
	 * 
	 * Constructor.
	 * @param array $events List of Venue objects.
	 */
	public function __construct(Array $venues)
	{
		if (!empty($venues) && $venues != null) {
			$this->_venues = $venues;
		}
	}
	
	/**
	 * 
	 * Generate JSON from array.
	 */
	public function toJson()
	{
		$out = '[';
		foreach ($this->_venues as $venue) {
			$out .= $venue->toJson();
			$out .= ',';	
		}
		$out = substr($out,0,-1);
		$out .= ']';
		
		return $out;
	}
}