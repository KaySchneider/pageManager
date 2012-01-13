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
//add here the purifier autoloader! We only need them here!
require BASEPATH . DIRECTORY_SEPARATOR . 'addOns' . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR . 'HTMLPurifier.auto.php';

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
            //if the user isnt an admin of this pageId
            if(!isset($isAdmin['can_post']) || $isAdmin['can_post'] == FALSE) {
               echo json_encode(array('result'=>'ok') );
               die();
            }
            $pageId = $request->getParameter('pageId');
            //if the pageId is empty, in this case die and say everything is alright
            if(empty( $pageId) ) {
                 echo json_encode(array('result'=>'ok') );
                 die();
            }
            //check if the user is connected isnt die!
            $user = $fbWorker->checkLoginState();
            $userId = $user['user_id'];
            if(empty( $userId) ) {
                echo json_encode(array('result'=>'ok') );
                die();
            }
        //tabContent now save it
        $tabContent = new tabContent($pageId);
        //now clean the content of bad and dirty attacks to the user...
        $config = HTMLPurifier_Config::createDefault();
        $config->set('Cache.DefinitionImpl', null);
         $purifier = new HTMLPurifier($config);
         
         $clean_html_content = $purifier->purify($request->getParameter('content'));
         $clean_html_isFan = $purifier->purify($request->getParameter('isFanContent'));
        $tabContent->saveDataToDB($request->getParameter('fanGate'), $clean_html_content, $clean_html_isFan , $userId);
        echo json_encode(array('result'=>'ok') );
        die();
        }

}
?>