<?php

class tabContent {

    private $pageId;
    private $fangate = FALSE; //boolean, if we need an fan gate
    private $content = NULL; //standard content
    private $contentIsFan = FALSE; //this is the isFan Content
    private $db;
    
    

    /**
     * it will be a great Idear to add more than only one pageApp
     * then i will need more than one accesstoken for the app
     * example: 4 machines on github and one database instance on clearDB
     */
    public function __construct($pageId) {
        $this->db = ATdb::get_instance();
        $this->pageId = $pageId;
    }
    
    public function getPageTab() {
        $this->loadDataDB();
        return array(
            'fangate'=>$this->fangate,
            'content'=>$this->content,
            'contentIsFan'=>$this->contentIsFan
        );
    }

    private function loadDataDB() {
        $sql = "SELECT * FROM tab WHERE pageId = \"" . mysql_real_escape_string($this->pageId) . "\"";
        $db = $this->db->query($sql);
        $tabContent = $this->db->get_row();
        //setting here the objectdata
        $this->content = $tabContent['content'];
        if(empty($tabContent['contentIsFan'] )) {
            $this->fangate = false;
        } else {
            $this->fangate = true;
        }
        $this->contentIsFan = $tabContent['contentIsFan'];
    }
    
    /**
     * checks if an page id exists in the database
     * @param string $pageId
     * @return boolean / TRUE if page exists FALSE if dont 
     */
    public function checkIsInDb($pageId) {
        $isInDB = "SELECT * FROM tab WHERE pageId=\"" .  mysql_real_escape_string($pageId) ."\"";
        $this->db->query($isInDB);
        $check = $this->db->get_row();
        if(isset($check['pageId'])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * save the tabcontent in the database
     * @param type $fangate
     * @param type $content
     * @param type $contentIsFan
     * @param type $userId 
     */
    public function saveDataToDB($fangate, $content, $contentIsFan, $userId) {
        //check if exists
        if($contentIsFan == 'null') {
            $contentIsFan = '';
        }
        if($this->checkIsInDb($this->pageId)) {
           $sql = 'UPDATE  tab 
                    SET content = "'.  mysql_real_escape_string($content).'",
                        contentIsFan = "'. mysql_real_escape_string($contentIsFan) .'"
                   WHERE pageId = "'.mysql_real_escape_string($this->pageId).'"
                  '; 
        } else {
        $sql = "INSERT INTO tab 
                    (pageId,content,userid,contentIsFan)
                values(
                    \"" . mysql_real_escape_string($this->pageId) . "\",
                    \"" . mysql_real_escape_string($content) . "\",  
                    \"" . mysql_real_escape_string($userId) . "\", 
                    \"" . mysql_real_escape_string($contentIsFan) . "\"
               )
               ";
        }
        $this->db->query($sql);
        print mysql_error();
    }

}

?>
