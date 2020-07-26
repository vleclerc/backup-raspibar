<?php
class DBFactory
{
  public static function load($dbType)
  {
    $class = 'DB_' . $dbType;
    
    if (file_exists($chemin = __DIR__ . '/'.$class . '.php'))
    {
      return new $class;
    }
    else
    {
      throw new RuntimeException('class ' . $class . ' was not found.');
    }
  }
}