<?php

class singlePage {

    private $pageId;
    private $distinctId;
    private $authToken; //the authToken for this page, granted by the graph api

    //the pages must be every time loaded from facebook. I cant save the accessToken in the
    //database!

    public function __construct($pageId, $distinctId, $authToken = FALSE) {
        $facebook = facebookFactory::getInstance();
        $fbObject = $facebook->getFacebook();
        $this->facebookOperation = new FacebookOperation($fbObject);

        $this->pageId = $pageId;
        $this->distinctId = $distinctId;
        $this->authToken = $authToken;
    }

    private final function buildPageObj() {
        
    }

    private final function updatePageObj() {
        
    }

    /**
     * adds an tab to an page 
     */
    public function addTabPage($options) {
        
    }

    /**
     * receives all the tabs for an page 
     */
    public function getTabPage() {
        
    }

    /**
     *  deletes an tab for the facebook page
     */
    public function deleteTabPage($tabId) {
        
    }

}

?>
