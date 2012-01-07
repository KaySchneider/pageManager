var validate =  function () {
}

validate.prototype.onlynumbers = function (str) {

    if (isNaN(parseFloat(str)) || parseFloat(str) != str) 
    {
        return false;
    }
    return true

}
validate.prototype.email = function (str) 
{ 
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,9})$/;
    return reg.test(str);
}

validate.prototype.datum = function (str)
{
    if(strlen(str) != 10) {
        return false;
    }
    if(substr_count(str, ".") != 2) {
        return false;
    }
    var temp = explode(".", str);
    if(!(validate_onlynumbers(temp[0]) && validate_onlynumbers(temp[1]) && validate_onlynumbers(temp[2])))
    {
        return false;
    }
    return true;
}

validate.prototype.datum18year = function (str)
{
    if(strlen(str) != 10) {
        return false;
    }
    if(substr_count(str, ".") != 2) {
        return false;
    }
    var temp = explode(".", str);
    if(!(validate_onlynumbers(temp[0]) && validate_onlynumbers(temp[1]) && validate_onlynumbers(temp[2])))
    {
        return false;
    }

    var tag = 16;
    var monat  = 11;
    var jahr = 1993;
    temp[0] = parseInt(temp[0]);
    temp[1] = parseInt(temp[1]);
    temp[2] = parseInt(temp[2]);

    if(temp[2] > jahr)
    {
        return false;
    }
    if(temp[2] == jahr)
    {
        if(temp[1] == monat)
        {
            if(temp[0] > tag) {
                return false;
            }
        }
        if(temp[1] > monat)
        {
            return false;
        }
    }

    return true;
}

/**
 * assign this all to the snipFrame Object
 */
if(typeof(snipFrame) == 'object') {
    snipFrame.validate = new validate();
}