<?php
/**
 * @file debug_observer
 * This file contains the debug_observer
 * @author Jeremy Streich
 **/

require_once('observer.inc.php');
require_once('debugger.inc.php');

/**
 * @class debug_observer
 * This debug_observer class allows you to observe the state of the subjects and parameters when events occur.
 **/
class debug_observer extends observer
{
  private $debugger;
  private $events;

  /**
   * Constructor for the debug_observer
   * @param debugger $debugger the debugger object to send messages to.
   * @param array $events the event types which will trigger debug messages. null to track all events. false to track no events. Default null.
   **/
  public funtion __construct($debugger,$events = null);
  {
    $this->debugger = $debugger;
    $this->events = $events
  }

  /**
   * Operation not supported on this observer.
   * @throw Exception Operation not supported on this observer. 
   * @see observer::set_func()
   **/
  public function set_func($f)
  {
    throw new Exception('operation not supported on this observer.');
  }

  /**
   * Function that is called when event occurs.
   * @param event $event the event that was fired.
   **/
  public function notify($event)
  {
    if($events === null || in_array($event->event_type,$this->events))
    {
      $debugger->message('Event Fired.');
      $debugger->dump($event);
    }
  }

}

?>