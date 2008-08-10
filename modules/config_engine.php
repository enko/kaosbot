<?php

require_once(KAOSBOT_BASEDIR . '/config/config.php');

class ConfigEngine
{
  public function GetValue($key) {
    $query = "SELECT value FROM settings WHERE [key] = ?";
    $query = $database->prepare($query, array('string'));
    $result = $query->execute($key)->fetchRow(MDB2_FETCHMODE_OBJECT);
    return $result->value;
  }

  public function GetValueDefault($key,$default) {
    if (($result = GetValue($key)) != "") {
      return $result;
    } else {
      return $default;
    }
  }

  public function SetValue($key,$value) {
    $query = "UPDATE settings SET value = ? WHERE [key] = ?";
    $query = $database->prepare($query,array('string','string'));
    $result = $query->execute($value,$key);
  }

}


$configengine = Singleton::getInstance('ConfigEngine');