<?php
/**
 * start here with the page Layout! For the overview... 
 * loads all the "big" boxes and load it then via javascript!s 
 */
?>
<div class="fb1">
    <h1 class="hgh">page manager </h1> 
    <div class="likeContainer" >
        <fb:like href="http://www.facebook.com/apps/application.php?id=<?php print APP_ID ?>" show_faces="false" width="200" font="tahoma"></fb:like>
    </div>
    <div class="clearDiv" ></div>
</div>
<div class="grid" >
    <div class="menLeft">
        <div class="search" >
            <input  type="text" id="search" />
        </div>
        <!-- add here the pages stuff -->
        <div class="_innerC" >

        </div>

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