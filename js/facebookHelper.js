var facebookHelper = function() {
    this.user_authorized = '';
    this.signed_request = '';
    this.authMethod = 'new';
    console.log("inti");
}

facebookHelper.prototype.wallpost = function (titel, text, url, logo, function_yes, function_no) {
    // Wenn Variablen leer, Standardwerte
    if(titel == "") {
        titel = "WALLPOST_TITLE";
    }
    if(text == "") {
        text = "WALLPOST_TEXT";
    }
    if(logo == "") {
        //TODO: insert a url from the php backend!
        logo = "http://szumpe.sc-dev.de/lh_mileonaire/files/wallpost.jpg";
    }
    if(url == "") {
        //TODO:insert the url from the PHP backend
        url = "http://www.facebook.com/pages/First-page/195313637211061?sk=app_312914012055272";
    }

    FB.ui(
    {
        method: 'stream.publish',
        attachment: {
            name: titel,
            description: (
            text
        ),
            href: url, 

            "media": [
                { 
                    "type": "image", 
                    "src": logo, 
                    "href": url
                }]

        }
    },
    function(response) {

        if (response && response.post_id) {
            if(typeof function_yes == 'function') function_yes();
        } else {
            if(typeof function_no == 'function') function_no();
        }
    }
  
);
}
// Aufruf Facebook-Wallpost-Funktion framework_fb_wall2wall(Ziel-UserID, "Titel", "Text", "URL des Posts", "Url der Wallpost-Grafik", "Aufruf-Funktion bei Erfolg", "Aufruf-Funktion bei Überspringen");
facebookHelper.prototype.wall2wall = function (targetid, titel, text, url, logo, function_yes, function_no)
{

    // Wenn Variablen leer, Standardwerte
    if(logo == "") {
        logo = "http://szumpe.sc-dev.de/lh_mileonaire/files/wallpost.jpg";
    }
    if(url == "") {
        url = "http://szumpe.sc-dev.de/lh_mileonaire/";
    }

    FB.ui(
    {
        method: 'stream.publish', 
        target_id: targetid, 
        attachment: {
            name: titel,
            description: (
            text
        ),
            href: url,

            "media": [
                {
                    "type": "image",
                    "src": logo,
                    "href": url
                }]

        }
    },
    function(response) {

        if (response && response.post_id) {
            if(typeof function_yes == 'function') function_yes();
        } else {
            if(typeof function_no == 'function') function_no();
        }
    }

);
}

// Aufruf Facebook-Invite-Funktion framework_fb_invite("Titel", "Text", "Aufruf-Funktion bei Erfolg", "Aufruf-Funktion bei Überspringen");
facebookHelper.prototype.invite = function(titel, text, function_yes, function_no)
{
    if(titel == "") {
        titel = "WALLPOST_TITLE";
    }
    if(text == "") {
        text = "WALLPOST_TEXT";
    }

    FB.ui(
    {
        method: 'apprequests',
    
        title: titel,
        message: text

    },
    function(response) {
        if (response && response.request_ids) {
            if(typeof function_yes == 'function') function_yes();
        } else {
            if(typeof function_no == 'function') function_no();
        }
    }
);

}

// Aufruf Facebook-Authorize-Funktion (Layer) framework_fb_authorize("Aufruf-Funktion bei Erfolg", "Aufruf-Funktion bei Überspringen");
facebookHelper.prototype.authorize = function(function_yes, function_no)
{
    (function (fbHelper)  {
        if(fbHelper.authMethod == 'new') {
            FB.getLoginStatus(function(response) {
     
                if (response.authResponse) {
                    console.log(fbHelper);
                    // logged in and connected user, someone you know
                    fbHelper.user_authorized = response.authResponse.uid;
                    fbHelper.signed_request = response.authResponse.signedRequest;
                    if(typeof function_yes == 'function') function_yes();
                } else if (response.session) {
                    console.log(fbHelper, 'second');
                    // logged in and connected user, someone you know
                    fbHelper.user_authorized = response.session.uid;
                    fbHelper.signed_request = response.session.signedRequest;
                    console.log(fbHelper, 'second');
                    if(typeof function_yes == 'function') function_yes();
                } else {
           
                    FB.login(function(response) {
                        console.log(fbHelper);
                        if (response.authResponse) {
                            fbHelper.user_authorized = response.authResponse.userID;
                            fbHelper.signed_request = response.authResponse.signedRequest;
                            if(typeof function_yes == 'function') function_yes();
                        } else if (response.session) {
                            fbHelper.user_authorized = response.session.userID;
                            fbHelper.signed_request = response.session.signedRequest;
                            if(typeof function_yes == 'function') function_yes();
                        } else {
                            if(typeof function_no == 'function') function_no();
                        }
                
                    }, { scope : 'email' } 
                );
                }

        
            });
        
        }
    })(this); 
}

/**
 * returns the signed request from facebook
 */
facebookHelper.prototype.getSignedRequest = function () {
    return this.signed_request;
}

facebookHelper.prototype.getUserId = function () {
    return this.user_authorized;  
}

facebookHelper.prototype.getAuthStatus = function () {
    
}



/**
 * assign this object to the snipFrame Object
 */
if(typeof(snipFrame) == 'object') {
    snipFrame.facebookHelper = new facebookHelper();
}