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
    var options = [{name:'cols',value:'50'},{name:'rows',value:'10'},
                   {name:'id',value:'tabContent'}];
    var div = this.ne.createNewEl("textarea", "formInsert",options);
    return div;
}

addInputForm.prototype.createInputAreaIsFan = function () {
    var frame = this.ne.createNewDiv("_isFanTxtAr");
    
    var label = this.createPText('isFan content:');
    
    var options = [{name:'cols',value:'50'},{name:'rows',value:'10'},
                   {name:'id',value:'tabContentisFan'}];
    var div = this.ne.createNewEl("textarea", "formInsert",options);
    
    frame.appendChild(label);
    frame.appendChild(div);
    return frame;
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
    var content = $('#tabContent');
    var isFanContent = $('.#tabContentIsFan');
    if(isFanContent.length <= 0 ) {
        var fanGate = true;
    }
    var arguments = {
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
                alert("data saved");
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

addInputForm.prototype.createFormElements = function (pageId) {
    var OuterBox = this.createOuterBox();
    
    var sectionControls = this.addControls();
    var FormEl = this.createForm();
    var textBox = this.createInputArea();
    
    var subBtn = this.addSubmitBtn();
    
    OuterBox.appendChild(FormEl);
    FormEl.appendChild(sectionControls);
    FormEl.appendChild(textBox);
    FormEl.appendChild(subBtn);
    return OuterBox;
}

