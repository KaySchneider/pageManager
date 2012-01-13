$('document').ready(function () {
    fbEnsureInitObj(resizeMe); 
});

function resizeMe() {
    console.log("setSize");
    FB.Canvas.setSize();
}
/**
* if the all.js is loaded make the init
*/
window.fbAsyncInit = function() {
    console.log("ju");
    FB.init({
        appId  : appId,
        status : true, // check login status
        cookie : true, // enable cookies to allow the server to access the session
        xfbml  : true,  // parse XFBML
        oauth : true
    });
    fbApiInit = true; //init flag
    FB.Canvas.setSize();
};

function fbEnsureInitObj( method) {
    if(!window.fbApiInit) {
        setTimeout(function() {
            fbEnsureInitObj(method);
        }, 50);
    } else {
        console.log(method);
        if(method) {
            method();
        }
    }
}


/**
             * load the all.js from the javscript facebook sdk asynchronusly
             */
