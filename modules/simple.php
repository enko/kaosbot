<?php

function processMessages($conn, $payload) {
  $pl = $payload[1];
  print "---------------------------------------------------------------------------------\n";
  print "Message from: {$pl['from']}\n";
  if($pl['subject']) print "Subject: {$pl['subject']}\n";
  print $pl['body'] . "\n";
  print "---------------------------------------------------------------------------------\n";
  $conn->message($pl['from'], $body="Thanks for sending me \"{$pl['body']}\".", $type=$pl['type']);
  if($pl['body'] == 'quit') $conn->disconnect();
  if($pl['body'] == 'break') $conn->send("</end>");  
  }
$eventhandler->addEvent("message", 'processMessages');


function processPresence($conn, $payload) {
  $pl = $payload[1];
  print "Presence: {$pl['from']} [{$pl['show']}] {$pl['status']}\n";
}
$eventhandler->addEvent("presence",'processPresence');