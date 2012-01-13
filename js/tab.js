$(document).ready(function () {
   fbEnsureInitObj(resizeMe); 
});

function resizeMe() {
    FB.Canvas.setAutoResize();
}
/**
* if the all.js is loaded make the init
*/
window.fbAsyncInit = function() {
    FB.init({
        appId  : appId,
        status : true, // check login status
        cookie : true, // enable cookies to allow the server to access the session
        xfbml  : true,  // parse XFBML
        oauth : true
    });
    fbApiInit = true; //init flag
    FB.Canvas.setAutoResize();
};

function fbEnsureInitObj( method) {
    if(!window.fbApiInit) {
       setTimeout(function() {
            fbEnsureInitObj(method);
        }, 50);
    } else {
        if(method) {
            method();
        }
    }
}
