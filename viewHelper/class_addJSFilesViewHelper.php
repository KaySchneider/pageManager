<?php

class addJSFilesViewHelper implements ViewHelper {
    public function execute($args=array()) {
        $reg = registry::getInstance();
        $cssFiles = $reg->getJSFiles();
        if($cssFiles == NULL) {
            return "NO JS FILES WARNING";
        }
        elseif(! is_array($cssFiles)) {
            return "NO JS FILES NO ARRAY";
        }
        /**
         * build the complete insert link for css Files!
         */
        $returnStr = "";
        
        foreach($cssFiles as $file) {
             
            $returnStr .= '<script src="js/' . $file . '" language="javascript"></script>';
        }
        
        return $returnStr;
            
    }
}
?>
