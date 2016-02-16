"use strict";

var display = {
    startPage: function() {
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
        display.menu();
    },
    menu: function() {
        var counter = 0;
        var courseCounter = 1;
        getData.groups(function (data) {
            var coursesAndGroupsTab = new tabPlace("#general-container", "tab");
            for (var courseId in data) {
                coursesAndGroupsTab.tab("tab-" + counter++);
                coursesAndGroupsTab.panel(courseCounter++ + " курс", "course-id-" + counter++);
                coursesAndGroupsTab.fullContentPlace("button-place");
                for (var groupId in data[courseId]) {
                    coursesAndGroupsTab.buttonInTab("group", data[courseId][groupId], "#");
                }
            }
        });
    }
};