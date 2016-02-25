"use strict";

function button(buttonId, content, onclickFunc, place) {
  let button = new tagCreator("a");
  button.tagClass("btn btn-default");
  button.tagId(buttonId);
  button.tagContent(content);
  button.addAttr("onclick", onclickFunc);
  button.showIn(place);
}

function h3(content, place) {
  let h3 = new tagCreator("h3");
  h3.tagContent(content);
  h3.showIn(place);
}

function errorMsg(text) {
  let div = new tagCreator("div");
  div.tagClass("alert alert-danger");
  div.tagId("errorPlace");
  div.addAttr("role", "alert");
  div.showOn("#general-container");
  let errorText = new tagCreator("p");
  errorText.tagContent(text);
  errorText.showIn("#errorPlace");
}
