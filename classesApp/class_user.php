<?php
/*
 * the user class.
 * this class managed the user data by itself.
 * You can read the data via getter and set a small
 * pieces of data from outside
 * if you want more functions in your command... 
 * make a new user class and extend from this one
 */
class user  {
    //defines user properties
    private $userId;
    private $locale;
    private $facebookNameFirst;
    private $facebookNameLast;
    private $link;
    private $language;
    private $name;
    private $distinct_id;
    private $ip;
    
    //defines system
    private $db;
    private $validate;
    private $facebookOperation;
    
    public function __construct($facebookUserId) {
        $this->db = ATdb::get_instance();
        $this->userId = $facebookUserId;
        $facebook = facebookFactory::getInstance();
        $fbObject = $facebook->getFacebook();
        $this->facebookOperation = new FacebookOperation($fbObject);
        //load the user
        $this->getUserDataFromFB();
    }
    
    /**
     * calls the facebook graph api to get the data
     * for the actually userid in this object
     */
    private final function getUserDataFromFB() {
        //get the user data from the database
        $sql = "SELECT * FROM user WHERE fbid = \"" . mysql_real_escape_string($this->userId) . "\"";
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
        $sql = "INSERT INTO user (fbid,locale,firstName, lastName,link,language,gender)
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
        $this->getUserDataFromFB();
        
    }
    
    public final function getUserName() {
       return $this->facebookNameFirst . " " . $this->facebookNameLast;
    }
    
    public final function getUserFirstName() {
        return $this->facebookNameFirst;
    }
    
    public final function getUserLastName() {
        return $this->facebookNameLast;;
    }
    
    /*+
     * returns the distinct id (system)
     */
    public final function getDistinctid() {
        return $this->distinct_id;
    }
    
    /*
     *returns the facebook id 
     */
    public final function getFacebookId() {
        return $this->userId;
    }

    /**
     * refreshed the user from the database
     */
    public  final function refreshUser() {
        $this->getUserDataFromFB();
    }
    
    public final function setUserId() {
        //do nothing
    }
    
}
?>
