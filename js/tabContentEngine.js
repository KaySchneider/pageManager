/**
 * this engine renders the form and so on
 */
var tabContentEngine = function () {
    
}

tabContentEngine.prototype.CreateForm = function (pageId) {
    //ad first check if we have had some content in the database for this pageId
}

tabContentEngine.prototype.checkServers = function (pageId) {
    var dataString = {mode:'checkTab',pageId:pageId};
    $.ajax({
            type: "POST",
            url: "index.php",
            data: dataString,
            dataType:'json',
            success: function(data)
            {
               console.log(data);
            }
        });
}



