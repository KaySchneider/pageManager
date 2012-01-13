<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:og="http://opengraphprotocol.org/schema/"
      xmlns:fb="http://www.facebook.com/2008/fbml" >
    <head>
        <?php
        print $this->addMetaTags();
        ?>
        <title><?php print $this->addHeaderInfo(); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- insert here minifyed versions of all css and js files -->
        <?php print $this->addHeaderCSS(); ?>


        <?php print $this->addJSFiles(); ?>

        <meta name="keywords" content="" />
        <meta name="description" content="<?php print $this->addHeaderDescription(); ?>" />
        <meta name="author" content="Kay Schneider" />
        <meta name="copyright" content="2012, Kay Schneider, hack the graph" />
        <meta name="revisit-after" content="2 Days" />
        <meta name="expires" content="never" />
    </head>
    <body >

        <div id="chat_invite_container" style="position: absolute; left: 100px; top: 200px"></div>
        <div id="fb-root"></div>
        
        <?php
        /**
         *  content output
         */
        print $this->vars['content'];
        ?>







        <!-- add here facebooks js api -->
        <script>
            var appId = <?php echo APP_ID ?>;
            //save the original signed request in an javascript param
        
            var pageControlObj;
            $('document').ready(function() {
                //make an instance of the Object pageControl in the file js/pageControl.js
                try {
                    pageControlObj = new pageControl();
                } catch(e) {
                    console.log(e,"ERRRO");
                }
            });
        
            /**
             * load the all.js from the javscript facebook sdk asynchronusly
             */
            (function() {
                var e = document.createElement('script');
                e.src = document.location.protocol + '//connect.facebook.net/<?php print USER_LOCALE; ?>/all.js'; //insert here the locale of the user, than the correct langauge of the all.js will be loaded
                e.async = true;
                document.getElementById('fb-root').appendChild(e);
            }()); 
          
        </script>



    </body>
</html>
