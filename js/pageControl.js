var pageControl = function () {
    (function (pageObj) {
        userEnsureInitObj(pageObj,"init");    
    })(this);
    this.actAccessToken = null;
    this.signedRequest = null;
    var img = new Image();
    img.src = 'img/waiting.gif'
    this.waitImg = img;
    this.ne = new newElements();
    this.form = new addInputForm();
    this.menu = new addPageMenu();
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
    else if( message.message == 'installTab') {
        this.showAllTabs(message.data);
    } else if (message.message == 'receiveTabs') {
        this.addTabCreator(message.data);
    }
}

/**
 * insert the form to edit the custom tab content
 */
pageControl.prototype.addTabCreator = function (data) {
    /**
     * check at first if our tab is in the data
     */
    (function(pcObj){
        pcObj.TabisInstalled = undefined;
        $(data.data).each(function (item,value) {
            //is our Tab there ?
            console.log(value);
            if(typeof value.application != 'undefined' && value.application != null) {
                if(value.application.id == appId) {
                    //the tab is an pageTab of this app
                    console.log(value);
                    $('#addNewPageTab').remove();//remove the new pageTab button
                    var Outer = pcObj.ne.createNewEl('div');
                    var inner = pcObj.ne.createNewDiv();
                    if(typeof value.custom_name == "undefined" || value.custom_name == 'iframe_canvas' ) {
                        value.custom_name = value.name;
                    }
                    var txtInner = pcObj.ne.createText(value.custom_name);
                    inner.appendChild(txtInner);
                    Outer.appendChild(inner);
                 
                    //refresh the menu and print the new values
                    pcObj.tabId = value.id;
                    pcObj.TabisInstalled = true;
                    //add the edit Me icon to the top Menue
                    var likes = pcObj.ne.createNewDiv("headerInfoBox");
                    var likesNum = pcObj.ne.createText("edit custom tab:" );
                    likes.appendChild(likesNum);
                    likes.appendChild(inner);
                    var refD = document.getElementsByClassName("clear");
                    refD[0].parentNode.insertBefore(likes, refD[0]);
                    $(likes).click(function () {
                        console.log(pcObj);
                        pcObj.EditPageTab();
                    });
                //todo:remove the force load! But for this time 
                //this is an must have because nobody used it
                    
                }
            }
        });
        
        if(typeof pcObj.TabisInstalled == 'undefined' ) {
            //
            var TopContent = pcObj.createNewTabElement(pcObj.pageId,pcObj.actAccessToken);
            var refD = document.getElementsByClassName("clear");
            refD[0].parentNode.insertBefore(TopContent, refD[0]);
        }
    })(this);
    
}

/**
 *  shows the pageTab edit form window
 */
pageControl.prototype.EditPageTab = function () {
    if($('.formBox').length <=0) {  
        var FormControl = this.form.createFormElements(this.pageId, this.actAccessToken,this.tabId);
        $(".bigBoxRight").append(FormControl);
        //after inject this to the document. add some evnts
        this.form.addEvents();
    }
}

pageControl.prototype.showPageFeed = function ( message ) {
    $('#feed');
//console.log(message);
}

pageControl.prototype.showAllTabs = function ( message ) {
    if(message == true || message == 'true') {
        console.log(message);
        //reload all the tabs of the page
        facebookHelper.receiveAllTabs(this.pageId,this.actAccessToken);
    } else {
        alert("installation of custom tab failed! Try again");
    }
}


/**
 * parse the pagesObject from facebook
 */
pageControl.prototype.parsePages = function (message) {
    console.log(message);
    $('._innerC').html("");
    this.pages = message.data;
    /**
     * build here the html
     */
    (function (Objpages){
        
        $(Objpages.pages).each(function ( value, item ) {
            var Insert = $('._innerC');
            var div = document.createElement('div');
            var p = document.createElement('p');
            var txt = document.createTextNode(item.name);
            p.setAttribute('kaid' , item.id );
            p.setAttribute('arid' , value );
            p.appendChild(txt);
            div.appendChild(p);
            Insert.append(div);
        });
        
        $('.menLeft div p').click(function () {
            Objpages.loadPageData(this.getAttribute('kaid'), this.getAttribute('arid'));
        });
    })(this);
}

/**
 * add an new custom page tab to an facebook page
 *
 */
pageControl.prototype.createNewTabElement = function (pageId,pageAccessToken) {
    this.pageId = pageId;
    
    var tab = document.createElement("div");
    tab.setAttribute('id','addNewPageTab');
    var TabTxt = document.createTextNode("+ add new Page Tab");
    (function (pcObj,tab){
        
        $(tab).click(function () {
            facebookHelper.installNewTab(pcObj.pageId,pageAccessToken);
        });
        
    })(this,tab);
    tab.appendChild(TabTxt);
    
    return tab;
    
}
pageControl.prototype.parsePageDetail = function (pageDetails) {
    //call all the tabs
    console.log(this.pageId);
    facebookHelper.receiveAllTabs(this.pageId,this.actAccessToken);
    //console.log(pageDetails);
    //parse here the page details
    
    var name = this.ne.createNewDiv("headerInfoBox");
    var nameP = this.ne.createNewP();
    var nameTxt = this.ne.createText(pageDetails.name);
    nameP.appendChild(nameTxt)
    name.appendChild( nameP );
    var categP = this.ne.createNewP();
    var categTxt = this.ne.createText('category:'+pageDetails.category);
    categP.appendChild(categTxt);
    name.appendChild(categP);
    
    var divC = this.ne.createNewDiv("headerInfoWrapper");
   
    var likes = this.ne.createNewDiv("headerInfoBox");
    var likesNum = this.ne.createNewP("bnum");
    var likesTitle = this.ne.createNewP();
    var likesTxtHi = this.ne.createText('total Fans:');
    likesTitle.appendChild(likesTxtHi);
    var likesTxt = this.ne.createText(pageDetails.likes);
    likesNum.appendChild(likesTitle);
    likesNum.appendChild(likesTxt)
    likes.appendChild(likesNum);
    
    var peopleTalkCont = this.ne.createNewDiv("headerInfoBox");
    var peopleTalkHi = this.ne.createNewP().appendChild(this.ne.createText('People talking about:'));
    var peopleTalkNum = this.ne.createNewP("bnum") ;
    var num = this.ne.createText(pageDetails.talking_about_count );
    
    
    peopleTalkNum.appendChild(num);
    peopleTalkCont.appendChild(peopleTalkHi);
    peopleTalkCont.appendChild(peopleTalkNum);
    var waitDivBox = this.ne.createNewDiv();
    //waitDivBox.setAttribute('id', 'feed');
    // var waitMsg = this.ne.createText('wait for me');
    //waitDivBox.appendChild(waitMsg);
    
    
   
    divC.appendChild(name);
 
    divC.appendChild(likes);
    divC.appendChild(peopleTalkCont);
    //insert clear
    var clear = this.ne.createNewDiv('clear');
    divC.appendChild(clear);
    //divC.appendChild(waitDivBox);

    //facebookHelper.getLastFeed(pageDetails); 
    $('.bigBoxRight').html(divC);
    this.menu.init({
        id:pageDetails.id
    });
  
    //  var men = this.createNewTabElement(pageDetails.id,this.actAccessToken);
    //receive all the menuItems
    //this.menu.addMenuItem(men);
    this.menu.writeMenuItem();

} 

/**
 * 
 */
pageControl.prototype.loadPageData = function (kaId,arId) {
    this.pageId = kaId;
    var pageToken = this.pages[arId];
    this.actAccessToken = pageToken.access_token;
    $('.bigBoxRight').append( this.getWait('bigBoxRight') );
    facebookHelper.getPagesDetails(kaId,pageToken.access_token);
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
        
