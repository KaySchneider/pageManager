<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 *
 *Lightwight MVC Framework for the projekt sinpFrame Pirate Version
 * This is the response Object!!
 * In body muss die view geschrieben werden!
 * Body wird noch einsam und allein von den Commands geschrieben
 * dies wieder Rückgängig machen
 * Der Body wird nur vom view Objekt geschrieben!
 */
class HttpResponse implements Response {
    private $status = '200 OK';
    private $headers = array();
    private $body = null;
    const REQUEST_TYPE = 'http';

    public function setStatus($status) {
        $this->status = $status;
    }

    public function addHeader($name,$value) {
        $this->headers[$name] = $value;
    }

    public function write($data) {
        $this->body .= $data;
    }
    public function flush() {
       header("HTTP/1.0 {$this->status}");
        foreach($this->headers as $name=>$value){
            header("{$name}: {$value}");
        } 
        print $this->body;
        $this->headers = array();
        $this->data = null;
    }
    
    /**
     * returns the current type of an request.
     * This is for each request class specific
     * @return type 
     */
    public function getRequestType() {
        return self::REQUEST_TYPE;
    }
}
?>
