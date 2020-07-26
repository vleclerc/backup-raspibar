<?php

class Request {
    
    public $controller = '';
    
    public $action = '';
    
    public $parameter = null;
    
    const DEFAULT_CONTROLLER = 'index';
    const CONTROLLER_SUFFIX = 'Controller';
    const ACTION_SUFFIX = 'Action';
    
    public function __construct(){
        
        $uri = $_SERVER['REQUEST_URI'];
        if(substr($uri, 0, 1) == '/'){
            $uri = str_replace('/','',$uri);
        }
        
        switch($uri){
            case 'users':
            case 'gpio':
                $this->controller = ucfirst($uri) . self::CONTROLLER_SUFFIX;
                break;
            default:
                $this->controller =  ucfirst(self::DEFAULT_CONTROLLER) . self::CONTROLLER_SUFFIX;
        }
        
        switch($_SERVER['REQUEST_METHOD']){
            case 'POST':
            case 'GET':
            case 'PUT':
            case 'DELETE':
                $this->action = strtolower($_SERVER['REQUEST_METHOD']) . self::ACTION_SUFFIX;
                break;
            default:
                var_dump('FATAL ERROR : METHOD UNAUTHORIZED'); die;
        }
        
        $data = json_decode(file_get_contents('php://input'), true);
        $this->parameter = $data;
    }
}