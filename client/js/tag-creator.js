"use strict";

var item = {
    select: function(idOrClass) {
        return $(idOrClass);
    },
    clear: function(id) {
        item.select(id).html("");
    },
    clearValue: function(id) {
        item.select(id).val("");
    },
    remove: function(idOrClass) {
        item.select(idOrClass).remove();
    }
};

function createItem(tag) {
    this.item = document.createElement(tag);
}

createItem.prototype.itemId = function(id) {
    item.select(this.item).attr("id", id);
};

createItem.prototype.itemClass = function(className) {
    item.select(this.item).attr("class", className);
};

createItem.prototype.content = function(content) {
    item.select(this.item).html(content);
};

createItem.prototype.source = function(src) {
    item.select(this.item).attr("src", src);
};

createItem.prototype.addAttr = function(attribute, attributeValue) {
    item.select(this.item).attr(attribute, attributeValue);
};

createItem.prototype.showIn = function(spaceIdOrClass) {
    item.select(spaceIdOrClass).append(this.item);
};

createItem.prototype.showOn = function(spaceIdOrClass) {
    item.select(spaceIdOrClass).prepend(this.item);
};