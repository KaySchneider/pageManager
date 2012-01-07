<?php
/**
 * base command
 * this is the mother of all other commands
 *
 */

class baseCommand implements command {
    /**
     * the commands dont need some db shit
     * the commands needs fas access to facebook 
     * Operations
     */
    
    private $facebook;
   
    
    public function __construct() {
       
    }
}
?>
