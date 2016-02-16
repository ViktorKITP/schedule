"use strict";

function button(buttonId, content, onclickFunc, spaceIdOrClass) {
    var button = new createItem("a");
    button.itemClass("btn btn-default");
    button.itemId(buttonId);
    button.content(content);
    button.addAttr("onclick", onclickFunc);
    button.showIn(spaceIdOrClass);
}

function hr(spaceIdOrClass) {
    var hr = new createItem("hr");
    hr.showIn(spaceIdOrClass);
}

function tabPlace(spaceIdOrClass, tabId) {
    var ul = new createItem("ul");
    ul.itemClass("nav nav-tabs");
    ul.itemId(this.tabId = tabId);
    ul.showIn(this.spaceIdOrClass = spaceIdOrClass);
}

tabPlace.prototype.tab = function(linkId) {
    var li = new createItem("li");
    li.itemId(this.linkId = linkId);
    li.showIn("#" + this.tabId);
};

tabPlace.prototype.panel = function(name, href) {
    this.href = href;
    var a = new createItem("a");
    a.addAttr("data-toggle", "tab");
    a.addAttr("href", "#" + href);
    a.content(name);
    a.showIn("#" + this.linkId);
};

tabPlace.prototype.fullContentPlace = function(fullContentPlaceId) {
    var div = new createItem("div");
    div.itemClass("tab-content");
    div.itemId(this.contentPlaceId = fullContentPlaceId);
    div.showIn(this.spaceIdOrClass);
};

tabPlace.prototype.buttonInTab = function(buttonId, content, onclickFunc) {
    var place = new createItem("div");
    place.itemId(this.href);
    place.itemClass("tab-pane fade padding-tab");
    place.showIn("#" + this.contentPlaceId);
    button(buttonId, content, onclickFunc, "#" + this.href);
};
