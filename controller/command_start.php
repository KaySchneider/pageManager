<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * Wenn nichts gesetzt ist dann hole die komplette �bersicht!
*/


class startPageCommand implements command {

    public function execute(Request $request, Response $response) {
        $req = registry::getInstance();
        $renderEngine = $req->getView();
        $renderOverview = new render('start');
        
        //test the heroku database
        $db = ATdb::get_instance();
        var_dump($db);
        $renderOverview->renderView();

        $renderEngine->assign('content', $renderOverview->getHtml() );
        $req->setView($renderEngine);
    }

}
?>

