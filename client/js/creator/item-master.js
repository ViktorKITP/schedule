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
