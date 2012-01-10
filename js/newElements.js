var newElements = function () {
    
}
/*
 * @params string elementName exp. "b","p","input"
 * @params string className  exp. "foo"
 * @params Array contains object arguments exp [{'name':'id','value':'test'}, {'name':'name','value':'noMore'}]
 */
newElements.prototype.createNewEl = function (elementName , className, arguments) {
    var divEl = document.createElement(elementName);
    if(typeof className != "undefined") {
        divEl.setAttribute('class', className);
    }
    
    if(typeof arguments != "undefined") {
        $(arguments).each(function(val,item) {
            divEl.setAttribute(item.name, item.value);
        });
    }
    
    return divEl;
}

newElements.prototype.createNewDiv = function (className) {
    var divEl = document.createElement('div');
    if(typeof className != "undefined") {
        divEl.setAttribute('class', className);
    }
    
    return divEl;
}

newElements.prototype.createNewP = function (className) {
    var divEl = document.createElement('p');
    if(typeof className != "undefined") {
        divEl.setAttribute('class', className);
    }
    
    return divEl;
}

newElements.prototype.createText = function (text) {
    var divEl = document.createTextNode(text);
    
    
    return divEl;
}
