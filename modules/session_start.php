<?php

require_once(KAOSBOT_BASEDIR . "/core/eventhandler.php");

function processSessionStart($conn, $payload) {
  print "Session Start\n";
  $conn->getRoster();
  $conn->presence($status="Cheese!");
}
$eventhandler->addEvent('session_start','processSessionStart');
