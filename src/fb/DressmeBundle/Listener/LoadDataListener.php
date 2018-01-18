<?php

namespace fb\DressmeBundle\Listener;

use AncaRebeca\FullCalendarBundle\Model\FullCalendarEvent;
use fb\DressmeBundle\Entity\CalendarEvent as MyCustomEvent;

class LoadDataListener
{
    /**
     * @param CalendarEvent $calendarEvent
     *
     * @return FullCalendarEvent[]
     */
    public function loadData(CalendarEvent $calendarEvent)
    {

    	 $startDate = $calendarEvent->getStart();
   		 $endDate = $calendarEvent->getEnd();
		 $filters = $calendarEvent->getFilters();
	
    	 //You may want do a custom query to populate the events
    	 new CalendarEvent($calendarEvent);
    	 $calendarEvent->addEvent(new MyCustomEvent('Event Title 1', new \DateTime()));
    	 $calendarEvent->addEvent(new MyCustomEvent('Event Title 2', new \DateTime()));
    }
}