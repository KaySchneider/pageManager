<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * Wenn nichts gesetzt ist dann hole die komplette �bersicht!
 *
 * Start Page Command sollte direkt mit der Datensammlung beginnen!
*/

/*
 * die commands müssen benutzerfreundlicher werden!
 * Es ist wünschenswert wenn ich eine Zentrale Stelle 
 * habe an der ich mir die gewünschten Objekte holen kann
 * und welche von der betreffenden Stelle mit der config 
 * neu erstellt werden, mit Hilfe der Informationen aus der
 * config Addresse.
 * 
 *  
 * 
 */

class getSignedRequestCommand implements command {
 
    public function execute(Request $request, Response $response) {
        $req = registry::getInstance();
        $req->setJSFiles('pageControl.js');
        $db =  ATdb::get_instance();
        

        //get the facebook object and at it to the worker
        $facebook = facebookFactory::getInstance();
        $fbObject = $facebook->getFacebook();
        $fbWorker = new FacebookOperation($fbObject);
        $parsedRequest = $fbObject->getSignedRequest();
        echo json_encode($parsedRequest);
        die();
    }

}
?>