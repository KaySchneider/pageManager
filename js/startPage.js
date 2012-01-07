/**
 * proof of concept for the new framework
 *
 *
 */
var startPage = function () {
    $(startPagebutton).click(function () {
        startPageObj.showFacebookname();
    });
};

/**
 * diplay the current users name
 */
startPage.prototype.showFacebookname = function () {
    /*
     * 
     */
    
    snipFrame.facebookHelper.authorize(function() {console.log("yes") }, function() {console.log("no")});
    console.log(snipFrame.facebookHelper.getUserId() );
}   


/*
 * assign the things 
 * after the document is ready
 * and it will be init
 *
 */
$(document).ready(function() {
    startPageObj = new startPage();
});