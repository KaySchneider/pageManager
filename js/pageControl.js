var pageControl = function () {
    (function (pageObj) {
        userEnsureInitObj(pageObj,"init");    
    })(this);
    this.signedRequest = null;
    console.log("buh");
    facebookHelper.registForLoginChange(this,'receiveMessage');
    
}

/**
 * extend the object facebookHelper from the snipFrameBaseMehtod
 */
pageControl.prototype = new baseMethod(['pageControlObj']);


/**
 * start the pageControl first when the facebook sdk is loaded
 */
pageControl.prototype.init = function () {
    FB.Canvas.setSize({
        width: 840, 
        height: 480
    });
    this.getSignedRequest();
    this.addEvents();
    this.loadDefaultContent();
    this.pages;
}

pageControl.prototype.loadDefaultContent = function () {
    this.UserPages();
}

/**
 * load the content.. build the pages stuff!
 */
pageControl.prototype.UserPages = function () {
    facebookHelper.getUserPages();
}

/**
 * receive user data
 */
pageControl.prototype.receiveMessage = function (message) {
    if(message.message == 'pages') {
        this.parsePages(message.data);
    }
}

pageControl.prototype.parsePages = function (message) {
    console.log(message);
    this.pages = message.data;
    /**
     * build here the html
     */
    
    $(this.pages).each(function ( value, item ) {
        console.log(value,item);
        var Insert = $('.menLeft');
        var div = document.createElement('div');
        var p = document.createElement('p');
        var txt = document.createTextNode(item.name);
        txt.kaId = item.id;
        p.appendChild(txt);
        div.appendChild(p);
        Insert.append(div);
        
    });
}
 
 
/**
 * get the parsed signed_request object
 * from the ajax backend
 */
pageControl.prototype.getSignedRequest = function () {
    /**
     * send the unparsed signed_request to the ajax backend
     */
    (function(pCObj){
        var dataString = { 
            mode:'getSignedRequest'
         
        };
   
        $.ajax({
            type: "POST",
            url: "index.php",
            data: dataString,
            dataType:'json',
            success: function(data)
            {
                //set on success the parsed data out of the signed request
                pCObj.signedRequest = data;
            }
        });
    })(this);
}

/**
 * getter for the parsed signed request object
 */ 
pageControl.prototype.getParsedRequest = function () {
    if(this.signedRequest != null) {
        return this.signedRequest;
    } else {
        return false;
    }
}

pageControl.prototype.showError = function (errorArr) {
   var max = errorArr.length;
   //clean the error 
   $('#error').html("");
   
   for(i=0;i<=max;i++) {
       //print out the array in the document
       var errorElement = document.createElement('p');
       var inText = document.createTextNode(errorArr[i]);
       errorElement.appendChild(inText);
       $('#error').append(errorElement);
   }
}

/**
 *add some events to the page
 */
pageControl.prototype.addEvents = function () {
    (function (eventObj) {
       
    })(this);
   
}
function yes() {
    //call again the init
    pageControlObj.init();
}

function no() {
    alert("you must login to the app to use it... sorry");
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
    //FB.Canvas.setAutoResize();

    

};

/**
 * make sure that the facebook init is done
 * before maken an facebook call through the js 
 * facebook sdk ( all.js ) 
 */
function fbEnsureInit(callback) {
    if(!window.fbApiInit) {
        setTimeout(function() {
            fbEnsureInit(callback);
        }, 50);
    } else {
        if(callback) {
            callback();
        }
    }
}
        
