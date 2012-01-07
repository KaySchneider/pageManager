<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
class registry {
    protected static $instance = null;
    private $values;
    private $session = TRUE; //set Session handler true=on False=off
    
    const KEY_VIEW = 'view';
    const KEY_USER = 'user';
    const KEY_RESPONSE = 'response';
    const KEY_REQUEST = 'request';
    const KEY_CATEG = 'categ';
    const KEY_USERID = 'userID';
    const KEY_ADD_HEADER = 'header';
    const KEY_ADD_DESCRIPTION = 'description';
    const KEY_META_TAG = 'meta';
    const SIGNED_REQUEST = 'signedRequest';
    const SIGNED_REQUEST_USER_ID = 'signedRequestUserId';
    const KEY_USER_LOCALE = 'userlocae';
    const KEY_CSS_FILES = 'cssFiles';
    const KEY_JS_FILES = 'jsFiles';
    
    public static function getInstance() {
        if(self::$instance === null) {
            self::$instance = new registry();
        }
        return self::$instance;
    }

    protected  function  __construct() {

    }

    protected function  __clone() {

    }
    
    /**
     * read the saved data from the session
     */
    protected function sessionReader() {
          if($this->session) {
            //set here things wich wouldnt be save in the session
              if(isset(   $_SESSION['registry'] )) {
                    $unserialize = unserialize($_SESSION['registry']);
                    $this->values = $unserialize;
              }       
        }
    }


    /*
     * the session handler, 
     * saves all the data if possible in the session
     */
    protected function sessionHandler() {
        if($this->session) {
            //set here things wich wouldnt be save in the session
            $serialize = serialize($this->values);
            $_SESSION['registry'] = $serialize;
        }
    }

    protected function set($key,$value) {
        $this->values[$key] = $value;
        //save the data in the session
        $this->sessionHandler();
    }

    protected function get($key) {
        if(isset($this->values[$key])) {
            return $this->values[$key];
        }
        return null;
    }

    /**
     * Zur Speicherung eines View Objektes.
     * Hier soll die Hauptview abgelegt werden
     * damit die Commands ihre erzeugten views in
     * den content bereich schreiben können
     * @param render $view
     */
    public function setView(render $view) {
        $this->set(self::KEY_VIEW, $view);
    }

    public function getView() {
        return $this->get(self::KEY_VIEW);
    }

    public function setUser(user $user) {
        $this->set(self::KEY_USER, $user);
    }

    public function getUser() {
        return $this->get(self::KEY_USER);
    }

    public function setResponse(Response $response) {
        $this->set(self::KEY_RESPONSE,$response);
    }

    public function getResponse() {
        return $this->get(self::KEY_RESPONSE);
    }

    public function setRequest(Request $request) {
        return $this->set(self::KEY_REQUEST, $request);
    }

    public function getRequest() {
        return $this->get(self::KEY_REQUEST);
    }

    public function getCateg() {
        return $this->get(self::KEY_CATEG);
    }

    public function setCateg($categ) {
      $oldData = $this->get(self::KEY_CATEG);
      if(is_array($oldData))
          $insertCateg = array_merge($oldData, $categ);
      else
          $insertCateg = $categ;
        $this->set(self::KEY_CATEG, $insertCateg);
    }

    public function setUserAuto(array $userID) {
        $this->set(self::KEY_USERID, $userID);
    }

    public function getUserAuto() {
        return $this->get(self::KEY_USERID);
    }

    public function setHeader($headerString) {
        $this->set(self::KEY_ADD_HEADER,$headerString);
    }

    public function getHeader() {
        return $this->get(self::KEY_ADD_HEADER);
    }

    public function setDescription($description) {
        $this->set(self::KEY_ADD_DESCRIPTION, $description);
    }

    public function getDescription() {
        return $this->get(self::KEY_ADD_DESCRIPTION);
    }

    /**
     * set the signed Request of facebook
     * @param string $signedRequest 
     */
    public function setSignedRequest($signedRequest) {
        $this->set(self::SIGNED_REQUEST, $signedRequest);
    }
    
    /**
     * get the signed request of facebook
     * @return type 
     */
    public function getSignedRequest() {
        return $this->get(self::SIGNED_REQUEST);
    }
    
    public function setFacebookUserId($userid) {
        $this->set(self::SIGNED_REQUEST_USER_ID, $userid);
    }
    
    public function getUserLocale() {
        return $this->get(self::KEY_USER_LOCALE);
    }
    
    public function setUserLocale($userLocale) {
        $this->set(self::KEY_USER_LOCALE, $userLocale);
    }
    
    /**
     * setter for the css header files! All Standard files will be added
     * at the index.php... everything else will be added in the commands
     * @param string $filename 
     */
    public function setCSSFiles($filename) {
        $arr = $this->get(self::KEY_CSS_FILES);
        if($arr == null ) {
            $insert = array($filename);
        } elseif(is_array($arr)) {
            $insert = array_merge($arr,array($filename) );
        }
        $this->set(self::KEY_CSS_FILES, $insert);
    }
    
    public function getCSSFiles() {
        return $this->get(self::KEY_CSS_FILES);
    }
    
    public function setJSFiles($filename) {
        $arr = $this->get(self::KEY_JS_FILES);
        if($arr == null ) {
            $insert = array($filename);
        } elseif(is_array($arr)) {
            $insert = array_merge($arr,array($filename) );
        }
        $this->set(self::KEY_JS_FILES, $insert);
    }
    
    public function getJSFiles() {
        return $this->get(self::KEY_JS_FILES);
    }
    
    /**
     * get the userid of facebook
     * @return type 
     */
    public function getFacebookUserId() {
        return $this->get(self::SIGNED_REQUEST_USER_ID);
    }
    
    public function setMetaTag($metaTagsArray) {
        $this->set(self::KEY_META_TAG, $metaTagsArray);
    }

    public function getMetaTag() {
        return $this->get(self::KEY_META_TAG);
    }
}
?>
