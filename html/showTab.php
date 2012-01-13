<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:og="http://opengraphprotocol.org/schema/"
      xmlns:fb="http://www.facebook.com/2008/fbml" >
    <head>
        <script src="js/jquery-1.6.min.js" language="javascript"></script>
        <script src="js/tab.js" language="javascript"></script>
        <link rel="stylesheet" type="text/css" href="css/tab.css"/>
    <body>
        <div id="fb-root" ></div>
        <div class="content">
            <?php
            print $this->vars['content'];
            ?>
        </div>
        <div class="footer"
             <span>powerd by <a target="_blank" href="https://apps.facebook.com/pagehelper/">pageManager</a>!</span>
        </div>
        <script type="text/javascript">
              var appId = <?php echo APP_ID ?>;
            (function() {
                var e = document.createElement('script');
                e.src = document.location.protocol + '//connect.facebook.net/<?php print USER_LOCALE; ?>/all.js'; //insert here the locale of the user, than the correct langauge of the all.js will be loaded
                e.async = true;
                document.getElementById('fb-root').appendChild(e);
            }()); 
        </script>
    </body>
</html>