<?php
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

class saveContentCommand implements command {
 
    public function execute(Request $request, Response $response) {
        $req = registry::getInstance();
        
        $renderEngine = $req->getView();
        //set the view// here start.php
        $db =  ATdb::get_instance();
        /**
         *we should recheck here the ownership of the pageTab
         *because an hacker can attack this script
         */

            //get the facebook object and at it to the worker
            $facebook = facebookFactory::getInstance();
            $fbObject = $facebook->getFacebook();
            $fbWorker = new FacebookOperation($fbObject);
            $isAdmin =  $fbWorker->getPageInfo($request->getParameter('pageId'), $request->getParameter('accessToken'));
            if(!isset($isAdmin['can_post']) || $isAdmin['can_post'] == FALSE) {
                die();
            }
            $pageId = $request->getParameter('pageId');
            if(empty( $pageId) )
                die("there was an error");
            $user = $fbWorker->checkLoginState();
            $userId = $user['user_id'];
        //tabContent
        $tabContent = new tabContent($pageId);
        $tabContent->saveDataToDB($request->getParameter('fanGate'), $request->getParameter('content'), $request->getParameter('isFanContent'), $userId);
        die("ok");
        }

}
?>