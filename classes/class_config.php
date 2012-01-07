<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class config  {
    private $requestType;
    private $facebookScope;
    private $options;
    static $instance;
    const KEY_REQUEST = 'request';
    const VALUE_REQUEST_HTTP = 'http';
    const VALUE_REQUEST_JSON = 'json';
    
    private function __construct() {
        
    }
    
    /**
     * sets the current options
     */
    private function optionsSet() {
        
    }
    
    /**
     * implement of singleton
     */
    private function __clone() {
        
    } 
    
    /**
     * implements singleton
     * @return type 
     */
    static function &getInstance() {
        if(typeof(self::$instance) != object) {
            self::$instance = new config();
        }
        return self::$instance;
    }
    
    public function setRequestType($requestType) {
        $this->optionsSet();
    }
    
    /**
     * shares request and response type!
     */
    public function getRequestType() {
        
    }
}
?>
