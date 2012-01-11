var addInputForm = function () {
    this.ne = new newElements();
    this.pageId = null;
}

addInputForm.prototype.createOuterBox = function () {
    var div = this.ne.createNewDiv("formBox");
    div.setAttribute("id","formOuter");
    var closeX = this.createPText('x');
    closeX.setAttribute('class', 'close');
    $(closeX).click(function () {
        console.log("x");
        $('.formBox').remove();
    } );
    div.appendChild(closeX);
    return div;
}

addInputForm.prototype.createSection = function () {
    var div = this.ne.createNewDiv("section");
    return div;
}

addInputForm.prototype.createForm = function () {
    var formEl = this.ne.createNewEl("form");
    return formEl;
}

/**
 * this is p text
 */
addInputForm.prototype.createPText = function (textx) {
    var sectionlabel = this.ne.createNewP();
    var sectionTxt = this.ne.createText(textx);
    sectionlabel.appendChild(sectionTxt);
    
    return sectionlabel;
    
}


/**
 * add some controls to the form
 */
addInputForm.prototype.addControls = function () {
    var section = this.createSection();
    var label = this.createPText("FanGate:");
    var controls = "Off<input type='radio' class='_fangate' name='fangate' value='off' /> On <input type='radio' class='_fangate' name='fangate' value='on' /> <br/><b>add custom HTML<b/>";
    section.appendChild(label);
    section.innerHTML = section.innerHTML + controls;
    //ad actions, view and hide the fangate Box
    
    return section;
}

addInputForm.prototype.createInputArea = function () {
    var options = [{
        name:'cols',
        value:'50'
    },{
        name:'rows',
        value:'10'
    },

    {
        name:'id',
        value:'tabContent'
    }];
    var div = this.ne.createNewEl("textarea", "formInsert",options);
    return div;
}

addInputForm.prototype.createInputAreaIsFan = function () {
   
    var frame = this.ne.createNewDiv("_isFanTxtAr");
    
    var label = this.createPText('isFan content:');
    
    var options = [{
        name:'cols',
        value:'50'
    },{
        name:'rows',
        value:'10'
    },

    {
        name:'id',
        value:'tabContentisFan'
    }];
    var div = this.ne.createNewEl("textarea", "formInsert",options);
    
    frame.appendChild(label);
    frame.appendChild(div);
    return frame;
}

addInputForm.prototype.addDeleteBtn = function () {
    var buttonLabel = this.createPText('delete tab');
    var button = this.ne.createNewDiv('button red right');
    button.setAttribute('id', 'submitTabContent');
    button.appendChild(buttonLabel);
    (function(addInObj) {
        $(button).click(function () {
            addInObj.deleteTab();
        });
    })(this);
    return button;
}
addInputForm.prototype.deleteTab = function () {
    check = confirm('Are you sure to delete this tab from your page?');

    if(check == true) {
        //createNewTabCommand
        pageControlObj.addWaitScreen();
        var arguments = {
            'mode':'createNewTab',
            'pageId':this.pageId, 
            'tabId': this.tabId,
            'pageAccessToken':this.accessToken
            };
        $.ajax({
            type: "POST",
            url: "index.php",
            data: arguments,
            dataType:'json',
            success: function(data)
            {
              
          
                //reload everything after delete the content
                facebookHelper.getPagesDetails(pageControlObj.pageId,pageControlObj.actAccessToken );
            }
        });
    }
}

addInputForm.prototype.addSubmitBtn = function () {
    var buttonLabel = this.createPText('save');
    var button = this.ne.createNewDiv('button');
    button.setAttribute('id', 'submitTabContent');
    button.appendChild(buttonLabel);
    (function(addInObj) {
        $(button).click(function () {
            addInObj.checkSendForm();
        });
    })(this);
    return button;
}

addInputForm.prototype.checkSendForm = function () {
    //check the fields filled out 
    //check what for fields there are in the form //fangate yes/no
    
    var fanGate = false;
    var content = document.getElementById("tabContent").value;
    try {
        var isFanContent = document.getElementById('tabContentisFan').value;
    
        if(typeof isFanContent != 'undefined' ) {
            fanGate = true;
        }
    } catch( e) {
        console.log(e);
        var isFanContent = null;
    }
    var arguments = new Object();
   //show wait screen
   pageControlObj.addWaitScreen();
    arguments = {
        'mode':'saveContent',
        'fanGate':fanGate,
        'pageId' : this.pageId,
        'content':content,
        'isFanContent':isFanContent
    };
    console.log(arguments);
    //send the data to the server
    $.ajax({
        type: "POST",
        url: "index.php",
        data: arguments,
        dataType:'json',
        success: function(data)
        {
            //set on success the parsed data out of the signed request
            console.log(data);
            pageControlObj.removeWaitScreen();
        }
    });
    
}


addInputForm.prototype.addEvents = function () {
    (function (addInObj) { 
        $('._fangate').click(function(){
            console.log(this);
            if(this.value == 'on') {
                //check if this is already in the dom
                console.log($('._isFanTxtAr').length);
                if($('._isFanTxtAr').length <=0) {
                    
                    var isFan = addInObj.createInputAreaIsFan();
                    console.log(document.getElementById('formOuter'),document.getElementById('submitTabContent'),isFan);
                    var refD = document.getElementById("submitTabContent");
                    refD.parentNode.insertBefore(isFan, refD);
                //$('.formBox').append(isFan);
                }
            } else if (this.value == 'off') {
                $('._isFanTxtAr').remove();
            }
        }); 
    })(this);
}

addInputForm.prototype.getPageContent = function () {
    /**
     * TODO: add an waiter gif to the form and block the form
     * while the request is not done!!
     */
   
    (function(adIarg){
        var arguments = {
            'mode':'getPageTabContent',
            'pageId' : adIarg.pageId
        };
        $.ajax({
            type: "POST",
            url: "index.php",
            data: arguments,
            dataType:'json',
            success: function(data)
            {
          
                //set on success the parsed data out of the signed request
                if(typeof data.error == 'undefined'  || typeof data.error == undefined)  {
         
                    adIarg.parsePageContentInject(data);
                }
                pageControlObj.removeWaitScreen();
            }
        });
    })(this);
}

addInputForm.prototype.parsePageContentInject = function (data) {
    console.log(data , "result" );
    //prepare the form elements for the new input field
    if(data.fanGate == true && data.isFanContent != 'null') {
        var isFan = this.createInputAreaIsFan();
        console.log(document.getElementById('formOuter'),document.getElementById('submitTabContent'),isFan);
        var refD = document.getElementById("submitTabContent");
        refD.parentNode.insertBefore(isFan, refD);
        document.getElementById('tabContentisFan').value = data.isFanContent;
    }
    
    //add here the values if there were any values into the form
    if(data.content != null) {
        document.getElementById('tabContent').value = data.content;
    }
}

addInputForm.prototype.createFormElements = function (pageId,accessToken,tabId) {
     //add wait screen
    pageControlObj.addWaitScreen();
    this.pageId = pageId;
    this.accessToken = accessToken;
    this.tabId = tabId;
    
    var OuterBox = this.createOuterBox();
    
    var sectionControls = this.addControls();
    var FormEl = this.createForm();
    var textBox = this.createInputArea();
    
    var subBtn = this.addSubmitBtn();
    var deleteBtn = this.addDeleteBtn();
    var clearer = this.ne.createNewDiv('clearDiv');
    OuterBox.appendChild(FormEl);
    FormEl.appendChild(sectionControls);    
    FormEl.appendChild(textBox);
    FormEl.appendChild(clearer);
    FormEl.appendChild(subBtn);
    FormEl.appendChild(deleteBtn);
    this.getPageContent();
    return OuterBox;
}

