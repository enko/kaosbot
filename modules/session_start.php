<?php

require_once(KAOSBOT_BASEDIR . "/core/eventhandler.php");
require_once(KAOSBOT_BASEDIR . "/core/config_engine.php");

function processSessionStart($conn, $payload) {
  print "Session Start\n";
  $conn->getRoster();
  $conn->presence($status=$configengine->GetValueDefault('statusmessage','Cheeese :)'));
}
$eventhandler->addEvent('session_start','processSessionStart');
