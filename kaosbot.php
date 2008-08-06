<?php

// activate full error reporting
//error_reporting(E_ALL & E_STRICT);

require_once 'XMPPHP/XMPP.php';
require_once 'config/config.php';
require_once 'core/eventhandler.php';

require_once 'modules/simple.php';


#Use XMPPHP_Log::LEVEL_VERBOSE to get more logging for error reports
#If this doesn't work, are you running 64-bit PHP with < 5.2.6?
$conn = new XMPPHP_XMPP($hostname, $port, $user, $password, $resource, $hostname, $printlog=true, $loglevel=XMPPHP_Log::LEVEL_INFO);
$conn->autoSubscribe();

try {
  $conn->connect();
  while(!$conn->isDisconnected()) {
    $payloads = $conn->processUntil(array('message', 'presence', 'end_stream', 'session_start'));
    foreach($payloads as $event) {
      $eventhandler->processEvents($conn, $event);
    }
  }
} catch(XMPPHP_Exception $e) {
  die($e->getMessage());
  }
