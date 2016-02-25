"use strict";

function scheduleShow(course, group) {
  genDivAnimIn();
  item.clear("#general-container");
  getData.schedule(course, group, function success(data) {
    let counter = 0;
    for (let obj in data) {
      h3(obj, "#general-container");
      tableCreate(data[obj], "schedule-" + counter, "tr-" + counter, "thead-" + counter, "tbody-" + counter, "#general-container");
      counter++;
    }
  });
}
