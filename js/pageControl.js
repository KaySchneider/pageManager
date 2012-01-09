var pageControl = function () {
    (function (pageObj) {
        userEnsureInitObj(pageObj,"init");    
    })(this);
    this.signedRequest = null;
       var img = new Image();
    img.src = 'img/waiting.gif'
    this.waitImg = img;
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

  
   
    this.getSignedRequest();
    this.addEvents();
    this.loadDefaultContent();
    this.pages;
}

pageControl.prototype.loadDefaultContent = function () {
    $('._innerC').append(this.getWait('innerC'));
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
    } else if (message.message == 'pageData') {
        this.parsePageDetail(message.data);
    } else if( message.message == 'pageFeed') {
        this.showPageFeed(message.data);
    }
}

pageControl.prototype.showPageFeed = function ( message ) {
    $('#feed');
    console.log(message);
}


pageControl.prototype.parsePages = function (message) {
    console.log(message, 'PARSEPAGES');
    $('._innerC').html("");
    this.pages = message.data;
    /**
     * build here the html
     */
    (function (Objpages){
        
        $(Objpages.pages).each(function ( value, item ) {
            console.log(value,item, 'BUH');
            var Insert = $('._innerC');
            var div = document.createElement('div');
            var p = document.createElement('p');
            var txt = document.createTextNode(item.name);
            p.setAttribute('kaid' , item.id );
            p.setAttribute('arid' , item.id );
            p.appendChild(txt);
            div.appendChild(p);
            Insert.append(div);

        });
        
        $('.menLeft div p').click(function () {
            console.log(this);
            Objpages.loadPageData(this.getAttribute('kaid'), this.getAttribute('arid'));
        });
    })(this);
}

pageControl.prototype.parsePageDetail = function (pageDetails) {
    console.log(pageDetails);
    //parse here the page details
    var name = document.createElement("div");
    var nameTxt = document.createTextNode(pageDetails.name);
    name.appendChild(nameTxt);
    var categ = document.createElement("div");
    var categTxt = document.createTextNode(pageDetails.category);
    categ.appendChild(categTxt);
    var divC = document.createElement("div");
    var likes = document.createElement("div");
    var likesTxt = document.createTextNode(pageDetails.likes);
    
    var waitDivBox = document.createElement('div');
    waitDivBox.setAttribute('id', 'feed');
    var waitMsg = document.createTextNode('wait for me');
    waitDivBox.appendChild(waitMsg);
    
    
    
    likes.appendChild(likesTxt);
    divC.appendChild(name);
    divC.appendChild(categ);
    divC.appendChild(likes);
    divC.appendChild(waitDivBox);
    facebookHelper.getLastFeed(pageDetails.id); 
    $('.bigBoxRight').html(divC);
} 

pageControl.prototype.loadPageData = function (kaId,arId) {
    console.log(kaId, arId);
    var pageToken = this.pages[arId];
    $('.bigBoxRight').append( this.getWait('bigBoxRight') );
    facebookHelper.getPagesDetails(kaId,pageToken);
    
};
 
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
pageControl.prototype.getWait = function (id) {
    var newWait = this.waitImg;
    newWait.setAttribute('id', id);
    return newWait;
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
    FB.Canvas.setSize({
        width: 800, 
        height: 800
    });

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

// SearchEngineFilterBox!
$(document).ready(function () {
    $('#search').keyup(function(event) {
        var search_text = $('#search').val();
        var rg = new RegExp(search_text,'i');
        $('._innerC div p').each(function(){
            if($.trim($(this).html()).search(rg) == -1) {
                $(this).parent().css('display', 'none');
                $(this).css('display', 'none');
                $(this).next().css('display', 'none');
                $(this).next().next().css('display', 'none');
            }	
            else {
                $(this).parent().css('display', '');
                $(this).css('display', '');
                $(this).next().css('display', '');
                $(this).next().next().css('display', '');
            }
        });
    });
});
 
$('#search_clear').click(function() {
    $('#search').val('');	
 
    $('._innerC div p').each(function(){
        $(this).parent().css('display', '');
        $(this).css('display', '');
        $(this).next().css('display', '');
        $(this).next().next().css('display', '');
    });
});
        
