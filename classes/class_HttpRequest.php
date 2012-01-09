<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
class HttpRequest implements Request {
    private $parameters;
    private $parseSignedRequestEngine;
    
    public function  __construct() {
        $this->parameters = $_REQUEST;
        $this->parseSignedRequestEngine = new signedRequest();
        $this->parseSignedRequestEngine->execute($this);

    }

    public function issetParameter($name) {
        return isset($this->parameters[$name]);
    }

    public  function getParameter($name) {
        if(isset($this->parameters[$name])) {
            return $this->parameters[$name];
        }
        else
            return null;
    }

    public function getParameterNames() {
        return array_keys($this->parameters);
    }

    public function getHeader($name) {
        $name = 'HTTP_' . strtoupper($str_replace('-','_',$name));
        if(isset($_SERVER[$name])) {
            return $_SERVER[$name];
        }
        else
            return null;
    }

    public function getCookies() {
        if(!isset($_SERVER['HTTP_COOKIE']) ) {
            return null;
        }
        $cookieRAW =  $_SERVER['HTTP_COOKIE'];
        $cookieRA = explode(';',$cookieRAW);
        //$cookies = explode();
        if(is_array($cookieRA)) {
            $cData = array();
            foreach($cookieRA as $cook) {
                $cData[] = explode('|',$cook);
            }
            $rturn = array();
           // var_dump($cData);
            foreach($cData as $Bdata) {
                foreach($Bdata as $data) {
                    $keyValue = explode('=',$data);
                    //var_dump($keyValue);
                    $rturn[$keyValue[0]] = $keyValue[1];
                }

            }
        }
        return $rturn;
    }

    public function getRemoteAddress() {
        return $_SERVER['REMOTE_ADDR'];
    }
}
?>
