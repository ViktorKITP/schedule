"use strict";

var display = {
    startPage: function(check) {
        if (check == undefined) {
            var startText = ["Здравствуй.", "На этом сайте ты можешь посмотреть расписание занятий Воронежского государственного" +
            " технического университета, факультета ФИТКБ. Бесплатно, без регистрации и смс."];
            var header = new createItem("header");
            header.itemClass("jumbotron");
            header.itemId("start-header");
            header.showIn("#general-container");
            var welcome = new createItem("h1");
            welcome.content(startText[0]);
            welcome.showIn("#start-header");
            var info = new createItem("p");
            info.content(startText[1]);
            info.showIn("#start-header");
            var hideButton = new createItem("a");
            hideButton.itemClass("btn btn-primary btn-large");
            hideButton.content("Скрыть это сообщение");
            hideButton.addAttr("onclick", "display.hideStartPage(), cookies.setStartPageHideCheck(false)");
            hideButton.showIn("#start-header");
        }
        display.menu();
    },
    hideStartPage: function() {
        item.select("#start-header").animateCss("fadeOut");
        delay(function() { item.remove("#start-header") }, 1000);
    },
    menu: function() {
        var counter = 0;
        getData.groups(function (data) {
            var coursesAndGroupsTab = new tabPlace("#general-container", "tab");
            for (var courseId in data) {
                var courseNumber = courseId.split("-");
                if (counter == 0) { coursesAndGroupsTab.tab("tab-" + counter++, true); }
                else { coursesAndGroupsTab.tab("tab-" + counter++, false); }
                coursesAndGroupsTab.panel(courseNumber[0] + " курс", "course-id-" + counter++);
                coursesAndGroupsTab.fullContentPlace("button-place");
                for (var groupId in data[courseId]) {
                    if (counter == 2) { coursesAndGroupsTab.buttonInTab("group", data[courseId][groupId], "#", true); }
                    else { coursesAndGroupsTab.buttonInTab("group", data[courseId][groupId], "#", false); }
                }
            }
        });
    }
};