<?php
/**
 * this is an large page object, wich includes all the pages in an
 * big array! 
 */
class page {
    
    private $userId;
    private $distinctId;
    
    private $pages;//array wich considers the pages objects
    
    
    public function __construct($facebookUserId) {
        $this->db = ATdb::get_instance();
        $this->userId = $facebookUserId;
        $facebook = facebookFactory::getInstance();
        $fbObject = $facebook->getFacebook();
        $this->facebookOperation = new FacebookOperation($fbObject);
        //load the user
        $this->getPageDataFromFB();
    }
    
    /**
     * Selects all the user Pages in this case!
     * generates an single Page object out of every single
     */
    private final function getPageDataFromFB() {
        //get the user data from the database
        $sql = "SELECT * FROM page WHERE fbid = \"" . mysql_real_escape_string($this->userId) . "\"";
        $this->db->query($sql);
        //if empty create user
        $user = $this->db->get_row();
        if(!isset($user['id'])) {
            //this is an new user.....
            $this->generateUser();
        } else {
            //set the vars in this object
            $this->facebookNameFirst = $user['firstName'];
            $this->facebookNameLast = $user['lastName'];
            $this->locale = $user['locale'];
            $this->link = $user['link'];
            $this->distinct_id = $user['id'];
        }
    }
    
    /**
     * automatically saves changes of the userobject in the database
     * if they were setted from outside via setter
     */
    private final function updateUserInDatabase() {
        //there is actually nothing what we want to update..
        //maybe we set an callback liveupdates for the user data fields!
    }
   
     /**
     * automatically saves changes of the userobject in the database
     * if they were setted from outside via setter
     */
    private final function generateUser() {
        //genereate an user!
        
        //receive the users information
        $user = $this->facebookOperation->getMe();
        
        //var_dump($user);
        $sql = "INSERT INTO page (fbid,locale,firstName, lastName,link,language,gender)
                values (
                    '". mysql_real_escape_string($user['id']) . "',
                    '". mysql_real_escape_string($user['locale']) ."',
                    '". mysql_real_escape_string($user['first_name']) ."',
                    '". mysql_real_escape_string($user['last_name']) ."',
                    '". mysql_real_escape_string($user['link']) ."',  
                    '". "" ."', 
                    '". mysql_real_escape_string($user['gender']) ."' 
                )
                ";
        $this->db->query($sql);
        //call the getData again!
        $this->getPageDataFromFB();
        
    }
}
?>
