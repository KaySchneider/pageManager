
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
    FB.Canvas.setSize({
        width: 700, 
        height: 800
    });
};
function fbEnsureInitObj(obj, method) {
    if(!window.fbApiInit) {
       setTimeout(function() {
            console.log(window.fbApiInit);
            fbEnsureInitObj(obj,method);
        }, 50);
    } else {
        if(obj) {
            obj.__call(method);
        }
    }
}
