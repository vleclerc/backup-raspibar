<?php

class Server {

    protected static $instance;
  
    protected $options = [];

    protected function __construct() { 
    }

    protected function __clone() { 

    }
    
    public static function getInstance()
    {
      if (!isset(self::$instance))
      {
        self::$instance = new self;
      }
      return self::$instance;
    }

    protected function init(){
        var_dump($this->options);
        if($this->options['env'] == "local"){
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
        } else {
            ini_set('display_errors', 0);
            ini_set('display_startup_errors', 0);
        }
    }

    public function start($options=[]){
        $this->options = $options;
        $this->init();
        $request = new Request();
        $controller = new $request->controller;
        echo $controller->{$request->action}($request->parameter);
    }
}