"use strict";

var tagCreator = function(tag) {
  this.item = document.createElement(tag);
};

tagCreator.prototype.tagId = function(id) {
  item.select(this.item).attr("id", id);
};

tagCreator.prototype.tagClass = function(className) {
  item.select(this.item).attr("class", className);
};

tagCreator.prototype.tagContent = function(content) {
  item.select(this.item).html(content);
};

tagCreator.prototype.source = function(src) {
  item.select(this.item).attr("src", src);
};

tagCreator.prototype.addAttr = function(attribute, attributeValue) {
  item.select(this.item).attr(attribute, attributeValue);
};

tagCreator.prototype.showIn = function(place) {
  item.select(place).append(this.item);
};

tagCreator.prototype.showOn = function(place) {
  item.select(place).prepend(this.item);
};
