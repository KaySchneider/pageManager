var addPageMenu = function () {
    this.ne = new newElements();
    this.pageId = null;
    this.pageTabs = null;
    this.menuItems = new Array();
}

/**
 * init the page menue
 */
addPageMenu.prototype.init = function (pageOptions) {
    this.pageId = pageOptions.id;
    this.pageTabs = pageOptions.tabs;
    this.createMenuContainer();
    this.menuItems = new Array();
}


addPageMenu.prototype.createMenuContainer = function () {
    var containter = this.ne.createNewDiv("leftMen");
    $('.bigBoxRight').append(containter);
}
/**
 * @params array item (htmlElement)
 */
addPageMenu.prototype.addMenuItem = function (item) {
    //wich types do we need in this case
    //showAllPageTabs!
    //
    this.menuItems.push(item);
}

/**
 * 
 * added all array Element to the leftHand Menu Item
 */
addPageMenu.prototype.writeMenuItem = function () {
    $(".leftMen").html("");
    $(this.menuItems).each(function (key,item) {
        console.log(item);
        $(".leftMen").append(item);
    });
//$("#leftMen").append();
}

