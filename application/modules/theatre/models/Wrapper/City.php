<?php
/**
 * 
 * City wrapper class for Theatre module.
 * Used to generate JSON of each City object contained in the array.
 * 
 * @author ovidiu.bute
 *
 */
class Theatre_Model_Wrapper_City
{
	public $_cities;
	
	/**
	 * 
	 * Constructor.
	 * @param array $events List of City objects.
	 */
	public function __construct(Array $cities)
	{
		if (!empty($cities) && $cities != null) {
			$this->_cities = $cities;
		}
	}
	
	/**
	 * 
	 * Generate JSON from array.
	 */
	public function toJson()
	{
		$out = '[';
		foreach ($this->_cities as $cities) {
			$out .= $cities->toJson();
			$out .= ',';
		}
		$out = substr($out,0,-1);
		$out .= ']';
		
		return $out;
	}
}