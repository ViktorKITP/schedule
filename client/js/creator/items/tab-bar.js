"use strict";

var tabBar = function(place, tabId) {
  let ul = new tagCreator("ul");
  ul.tagClass("nav nav-tabs");
  ul.tagId(this.tabId = tabId);
  ul.showIn(this.place = place);
};

tabBar.prototype.li = function(linkId, active) {
  let li = new tagCreator("li");
  li.tagId(this.linkId = linkId);
  if (active) {
    li.tagClass("active");
  }
  li.showIn("#" + this.tabId);
};

tabBar.prototype.anchor = function(name, href) {
  this.href = href;
  let a = new tagCreator("a");
  a.addAttr("data-toggle", "tab");
  a.addAttr("href", "#" + href);
  a.tagContent(name);
  a.showIn("#" + this.linkId);
};

tabBar.prototype.tabContent = function(tabContentId) {
  let div = new tagCreator("div");
  div.tagClass("tab-content");
  div.tagId(this.tabContentId = tabContentId);
  div.showIn(this.place);
};

tabBar.prototype.buttons = function(buttonId, content, onclickFunc, active) {
  let place = new tagCreator("div");
  place.tagId(this.href);
  if (active) {
    place.tagClass("tab-pane fade padding-tab active in");
  } else {
    place.tagClass("tab-pane fade padding-tab");
  }
  place.showIn("#" + this.tabContentId);
  button(buttonId, content, onclickFunc, "#" + this.href);
};

function tabBarCreate(data, id, place) {
  let counter = 0;
  let tab = new tabBar(place, id);
  tab.tabContent("button-place");
  for (let title in data) {
    if (counter == 0) {
      tab.li("tab-" + counter++, true);
    } else {
      tab.li("tab-" + counter++, false);
    }
    tab.anchor(title, "title-id-" + counter++);
    for (let content in data[title]) {
      if (counter == 2) {
        tab.buttons("group", data[title][content], "scheduleShow(" + "'" + title + "'" + ", " + "'" + data[title][content] + "'" + "), " +
        "cookies.setCourseAndGroupCookike(" + "'" + title + "'" + ", " + "'" + data[title][content] + "'" + ")", true);
      } else {
        tab.buttons("group", data[title][content], "scheduleShow(" + "'" + title + "'" + ", " + "'" + data[title][content] + "'" + "), " +
        "cookies.setCourseAndGroupCookike(" + "'" + title + "'" + ", " + "'" + data[title][content] + "'" + ")", false);
      }
    }
  }
}
