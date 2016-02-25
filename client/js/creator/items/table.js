"use strict";

var table = function(id, place) {
  let table = new tagCreator("table");
  table.tagClass("table table-hover");
  table.tagId(this.tableId = id);
  table.showIn(place);
};

table.prototype.thead = function(id) {
  let thead = new tagCreator("thead");
  thead.tagId(this.theadId = id);
  thead.showIn("#" + this.tableId);
};

table.prototype.tr = function(id, head) {
  let tr = new tagCreator("tr");
  tr.tagId(this.trId = id);
  if (head) {
    tr.showIn("#" + this.theadId);
  } else {
    tr.showIn("#" + this.tbodyId);
  }
};

table.prototype.th = function(title) {
  let th = new tagCreator("th");
  th.tagContent(title);
  th.showIn("#" + this.trId);
};

table.prototype.tbody = function(id) {
  let tbody = new tagCreator("tbody");
  tbody.tagId(this.tbodyId = id);
  tbody.showIn("#" + this.tableId);
};

table.prototype.td = function(cell) {
  let td = new tagCreator("td");
  td.tagContent(cell);
  td.showIn("#" + this.trId);
};

function tableCreate(data, tableId, trId, theadId, tbodyId, place) {
  let tableTag = new table(tableId, place);
  tableTag.thead(theadId);
  tableTag.tr(trId, true);
  tableTag.th("Время");
  tableTag.th("Предмет");
  tableTag.tbody(tbodyId);
  let counter = 0;
  for (let obj in data) {
    tableTag.tr(trId + "tbody-" + counter, false);
    tableTag.td(obj);
    tableTag.td(data[obj]);
    counter++;
  }
}
