var addInputForm = function () {
    this.ne = new newElements();
}

addInputForm.prototype.createOuterBox = function () {
    var div = this.ne.createNewDiv("formBox");
    return div;
}

addInputForm.prototype.createInputArea = function () {
    var options = [{name:'cols',value:'40'},{name:'rows',value:'10'},
                   {name:'id',value:'tabContent'}];
    var div = this.ne.createNewEl("textarea", "formInsert",options);
    return div;
}

addInputForm.prototype.createFormElements = function () {
    var OuterBox = this.createOuterBox();
    var textBox = this.createInputArea();
    
    OuterBox.appendChild(textBox);
    
    return OuterBox;
}

