<?php
/**
 * start here with the page Layout! For the overview... 
 * loads all the "big" boxes and load it then via javascript!s 
 */
?>
<div class="grid" >
    <div class="menLeft">
        <!-- add here the pages stuff -->
        
    </div>
    <div class="bigBoxRight">
        <!-- add here the startPage Stuff -->
        
    </div>
</div> 


<script language="text/javascript" >
    $('document').ready(function() {
        //make an instance of the Object pageControl in the file js/pageControl.js
        pageControlObj = new pageControl();
    });    
</script>