<?php

class Singleton
{
  static private $instances = array();
  
  static public function getInstance($className)
  {
    if (!isset(self::$instances[$className]))
      {
	self::$instances[$className] = new $className();
      }
    return self::$instances[$className];
  }
}