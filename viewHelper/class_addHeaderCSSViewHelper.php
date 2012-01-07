<?php

class addHeaderCSSViewHelper implements ViewHelper {
    public function execute($args=array()) {
        $reg = registry::getInstance();
        $cssFiles = $reg->getCSSFiles();
        if($cssFiles == NULL) {
            return "NO CSS FILES WARNING";
        }
        elseif(! is_array($cssFiles)) {
            return "NO CSS FILES NO ARRAY";
        }
        /**
         * build the complete insert link for css Files!
         */
        $returnStr = "";
        
        foreach($cssFiles as $file) {
            $returnStr .= '<link rel="stylesheet" type="text/css" href="'.CSS_DIR.''.$file.'"/>';;
        }
        
        return $returnStr;
            
    }
}
?>
