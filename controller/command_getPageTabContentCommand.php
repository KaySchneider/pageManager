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

class getPageTabContentCommand implements command {

    public function execute(Request $request, Response $response) {
        $req = registry::getInstance();
        $db = ATdb::get_instance();

        //get the facebook object and at it to the worker
    //    $facebook = facebookFactory::getInstance();
   //     $fbObject = $facebook->getFacebook();
  //      $fbWorker = new FacebookOperation($fbObject);

        $page = new tabContent($request->getParameter('pageId'));
        $PageArr = $page->getPageTab();

        /**
         * check here if the FanGate is active 
         */
        if (!isset($PageArr['content']) || $PageArr['content'] == NULL) {
            $output['error'] = true ;
        } else {
            if ($PageArr['fangate'] === true) {
                $output['isFanContent'] = $PageArr['contentIsFan'];
                $output['fanGate'] = TRUE;
            }

            $output['content'] = $PageArr['content'];
        }

        print json_encode($output);
        die();
    }

}

?>