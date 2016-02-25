"use strict";

function aboutPageShow() {
  genDivAnimIn();
  item.clear("#general-container");
  let a = new tagCreator("a");
  a.tagContent("github rep");
  a.addAttr("href", "https://github.com/ViktorKITP/schedule");
  a.showIn("#general-container");
}
