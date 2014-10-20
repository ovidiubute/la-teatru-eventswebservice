<?php
/**
 * 
 * Event mapper class for Theatre module.
 * @author ovidiu.bute
 *
 */
class Theatre_Model_Mapper_EventMapper
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
            $this->setDbTable('Theatre_Model_DbTable_Event');
        }
        return $this->_dbTable;
    }
    
    /**
     * 
     * Saves object to DB.
     * @param Theatre_Model_Event $event
     */
	public function save(Theatre_Model_Event $event)
    {
        $data = array(
            'title'   			=> $event->getTitle(),
            'venueId'           => $event->getVenueId(),
        	'detailsStory'		=> $event->getDetailsStory(),
        	'detailsTechnical'	=> $event->getDetailsTechnical(),
            'detailsCast' 		=> $event->getDetailsCast(),
            'author' 			=> $event->getAuthor(),
        	'ticketPrice'		=> $event->getTicketPrice(),
        	'hall'				=> $event->getHall(),
        );
 
        if (null === ($id = $event->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
    
    /**
     * 
     * Find object by ID.
     * @param int                 $id    The ID.
     * @param Theatre_Model_Event $event The Event object.
     */
	public function find($id, Theatre_Model_Event $event)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $event->setId($row->id)
              ->setVenueId($row->venue_id)
              ->setTitle($row->title)
              ->setDetailsStory($row->details_story)
              ->setDetailsTechnical($row->details_technical)
              ->setDetailsCast($row->details_cast)
              ->setAuthor($row->author)
              ->setTicketPrice($row->ticket_price)
              ->setHall($row->hall);
        $eventScheduleRowset = $row->findDependentRowset('Theatre_Model_DbTable_EventSchedule');
        $eventScheduleList = array();
        foreach ($eventScheduleRowset as $row) {
        	$eventSchedule = new Theatre_Model_EventSchedule();
        	$eventScheduleList[] = $eventSchedule->setId($row->id)->setTimestamp($row->timestamp);
        }
        $event->setScheduleWrapper(new Theatre_Model_Wrapper_EventSchedule($eventScheduleList));
    }
    
    /**
     * 
     * Find Event objects by parameters.
     * @param Array $params
     */
    public function findByParams(Array $params)
    {
    	if (isset($params['timestamp_start'])) {
    		$dateStart = new Zend_Date($params['timestamp_start']);
    		if (isset($params['venue_id']) && is_numeric($params['venue_id']) && $params['venue_id'] > 0) {
    		    $sql = "SELECT th_event.*, th_event_schedule.timestamp
    		       	 	FROM th_event
    		       	 	JOIN th_event_schedule ON th_event.id=th_event_schedule.event_id
    		       	 	WHERE th_event.venue_id = :venue_id AND th_event_schedule.timestamp >= :timestamp
    		       	 	ORDER BY th_event_schedule.timestamp, th_event.title";
    		    $stmt = $this->getDbTable()->getAdapter()->query($sql, 
    		        array(
    		        	':timestamp' => $dateStart->toString("yyyy-MM-dd HH:mm:ss"),
    		            ':venue_id'  => $params['venue_id']
    		        ));
    		} elseif (isset($params['city_id']) && is_numeric($params['city_id']) && $params['city_id'] > 0) {
    		    $sql = "SELECT th_event.*, th_event_schedule.timestamp
    		       	 	FROM th_event
    		       	 	JOIN th_venue ON th_venue.id=th_event.venue_id
    		       	 	JOIN th_city ON th_venue.city_id=th_city.id
    		       	 	JOIN th_event_schedule ON th_event.id=th_event_schedule.event_id
    		       	 	WHERE th_venue.city_id = :city_id AND th_event_schedule.timestamp >= :timestamp
    		       	 	ORDER BY th_event_schedule.timestamp, th_event.title";
    		    $stmt = $this->getDbTable()->getAdapter()->query($sql, 
    		        array(
    		        	':timestamp' => $dateStart->toString("yyyy-MM-dd HH:mm:ss"),
    		            ':city_id'   => $params['city_id']
    		        ));
    		} else {
        		$sql = "SELECT th_event.*, th_event_schedule.timestamp
        		        FROM th_event
        		        JOIN th_event_schedule ON th_event.id=th_event_schedule.event_id
        		        WHERE th_event_schedule.timestamp >= :timestamp
        		        ORDER BY th_event_schedule.timestamp, th_event.title";
        		$stmt = $this->getDbTable()->getAdapter()->query($sql, array(':timestamp' => $dateStart->toString("yyyy-MM-dd HH:mm:ss")));
    		}
        	// Execute query
    		$resultSet = $stmt->fetchAll();
    		
    		if (0 == count($resultSet)) {
	            return;
	        }
	        
	        $entries   = array();
	        foreach ($resultSet as $row) {
	        	if (!isset($entries[$row['id']])) {
		            $entry = new Theatre_Model_Event();
		            $entry->setId($row['id'])
		                  ->setVenueId($row['venue_id'])
		             	  ->setTitle($row['title'])
			              ->setDetailsStory($row['details_story'])
			              ->setDetailsTechnical($row['details_technical'])
			              ->setDetailsCast($row['details_cast'])
			              ->setAuthor($row['author'])
			              ->setTicketPrice($row['ticket_price'])
			              ->setHall($row['hall']);
			        $eventScheduleList = array();
			        $schedule = new Theatre_Model_EventSchedule();
			        $schedule->setTimestamp($row['timestamp']);
			        $eventScheduleList[] = $schedule;
			        $entry->setScheduleWrapper(new Theatre_Model_Wrapper_EventSchedule($eventScheduleList));
		            $entries[$row['id']] = $entry;
	        	} else {
	        		$entries[$row['id']]->scheduleWrapper->addSchedule($row['timestamp']);
	        	}
	        }
	        return $entries;
    	}
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
                 ->order("title ASC")
        );
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Theatre_Model_Event();
            $entry->setId($row->id)
                  ->setVenueId($row->venue_id)
            	  ->setTitle($row->title)
            	  ->setDetailsStory($row->details_story)
	              ->setDetailsTechnical($row->details_technical)
	              ->setDetailsCast($row->details_cast)
	              ->setAuthor($row->author)
	              ->setTicketPrice($row->ticket_price)
	              ->setHall($row->hall);
			$eventScheduleRowset = $row->findDependentRowset('Theatre_Model_DbTable_EventSchedule');
	        $eventScheduleList = array();
	        foreach ($eventScheduleRowset as $scheduleRow) {
	        	$eventSchedule = new Theatre_Model_EventSchedule();
	        	$eventScheduleList[] = $eventSchedule->setId($scheduleRow->id)->setTimestamp($scheduleRow->timestamp);
	        }
	        $entry->setScheduleWrapper(new Theatre_Model_Wrapper_EventSchedule($eventScheduleList));                  
            $entries[] = $entry;
        }
        return $entries;
    }
}