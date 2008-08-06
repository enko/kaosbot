<?php

require_once(KAOSBOT_BASEDIR . "/core/misc.php");

  // administers all event types and event functions

class EventHandler
{
  /**
   * @var array Elements of this array should look like this ("eventtype" => function)
   */
  private $eventFunctions = array();

  private $validEvents = array("message","presence", "session_start", "timer");

  public function addEvent($type,$function) {
    if (in_array($type,$this->validEvents)) {
      if (is_callable($function)) {
	$this->eventFunctions = array_merge($this->eventFunctions, array($type => $function));
	printf("Successfully registered function %s (%s-type)\n",$function, $type);
      }
    }
  }

  public function processEvents($conn, $payload) {
    foreach ($this->eventFunctions as $type => $function ) {
      if ($payload[0] == $type) {
	$function($conn, $payload);
      }
    }

  }

} 

$eventhandler = Singleton::getInstance('EventHandler');