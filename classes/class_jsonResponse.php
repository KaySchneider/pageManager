<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 *
 * Lightwight MVC Framework for the projekt sinpFrame Pirate Version
 * This is the response Object!!
 * In body muss die view geschrieben werden!
 * Body wird noch einsam und allein von den Commands geschrieben
 * dies wieder Rückgängig machen
 * Der Body wird nur vom view Objekt geschrieben!
 */

class jsonResponse implements Response {

    private $status = '200 OK';
    private $headers = array();
    private $body = null;
    const REQUEST_TYPE = 'json';

    public function setStatus($status) {
        $this->status = $status;
    }

    public function addHeader($name, $value) {
        $this->headers[$name] = $value;
    }

    /*
     * write every data line into an array
     * you can catch this on the js side
     */

    public function write($data) {
        $this->data[] = $data;
    }

    public function flush() {
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        if (is_array($this->headers)) {
            foreach ($this->headers as $name => $value) {
                header("{$name}: {$value}");
            }
        }
        //make here an json decode
        print json_encode($this->data);

        $this->headers = array();
        $this->data = null;
    }
    
    public function getRequestType() {
        return self::REQUEST_TYPE;
    }

}

?>
