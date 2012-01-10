<?php

class tabContent {
    
    private $pageId;
    private $fangate =FALSE;//boolean, if we need an fan gate
    private $content;//standard content
    private $contentIsFan = FALSE;//this is the isFan Content
    private $db;
    /**
     *it will be a great Idear to add more than only one pageApp
     *then i will need more than one accesstoken for the app
     * example: 4 machines on github and one database instance on clearDB
     */
    public function __construct($pageId) {
        $this->db = ATdb::get_instance();
        $this->pageId;
    }
    
    private function loadDataDB() {
        $sql = "SELECT * FROM tab WHERE pageId = \"" . mysql_real_escape_string($this->pageId) . "\"";
        $db = $this->db->query($sql);
        $tabContent = $this->db->get_row();
        //setting here the objectdata
        $this->content = $tabContent['content'];
       
    }
}
?>
