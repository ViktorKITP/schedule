"use strict";

function startPageShow() {
  genDivAnimIn();
  item.clear("#general-container");
  let start = new startPage();
  start.menu();
  if (cookies.getStartPageHideCheck() === undefined) {
    start.information();
  }
}

var startPage = function() {
  let startPageDiv = new tagCreator("div");
  startPageDiv.tagId("start-page");
  startPageDiv.showIn("#general-container");
}

startPage.prototype.information = function() {
  let startText = ["Здравствуй.", "На этом сайте ты можешь посмотреть расписание занятий Воронежского государственного" +
    " технического университета, факультета ФИТКБ. Бесплатно, без регистрации и смс."
  ];
  let header = new tagCreator("header");
  header.tagClass("jumbotron");
  header.tagId("start-header");
  header.showOn("#general-container");
  let welcome = new tagCreator("h1");
  welcome.tagContent(startText[0]);
  welcome.showIn("#start-header");
  let info = new tagCreator("p");
  info.tagContent(startText[1]);
  info.showIn("#start-header");
  let hideButton = new tagCreator("a");
  hideButton.tagClass("btn btn-primary btn-large");
  hideButton.tagContent("Скрыть это сообщение");
  hideButton.addAttr("onclick", "hideInfo(), cookies.setStartPageHideCheck(false)");
  hideButton.showIn("#start-header");
};

startPage.prototype.menu = function() {
  getData.groups(function(data) {
    tabBarCreate(data, "tab", "#general-container");
  });
};

function hideInfo() {
  item.select("#start-header").animateCss("fadeOut");
  delay(function() {
    item.remove("#start-header")
  }, 1000);
}
