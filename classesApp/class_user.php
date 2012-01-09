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
    
    public function __construct() {
        $this->db = ATdb::get_instance();
    }
    
    /**
     * calls the facebook graph api to get the data
     * for the actually userid in this object
     */
    private final function getUserDataFromFB() {
        //get the user data from the database
        $sql = "";
    }
    
    /**
     * automatically saves changes of the userobject in the database
     * if they were setted from outside via setter
     */
    private final function updateUserInDatabase() {
        
    }
   
    
    public final function getUserName() {
        
    }
    
    public final function getUserFirstName() {
        
    }
    
    public final function getUserLastName() {
        
    }
    
    /*+
     * returns the distinct id (system)
     */
    public final function getDistinctid() {
        
    }
    
    /*
     *returns the facebook id 
     */
    public final function getFacebookId() {
        
    }

    /**
     * refreshed the user from the database
     */
    public  final function refreshUser() {
        
    }
    
    public final function setUserId() {
        
    }
    
}
?>
