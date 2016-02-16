"use strict";

var getData = {
    data: function(url, callback) {
        $.getJSON(url, function success(data) {
            callback(data);
        });
    },
    groups: function(callback) {
        getData.data('json/groups.json', function success(data) {
            callback(data);
        });
    },
    schedule: function(course, group, callback) {
        getData.data("json/schedules" + course + "/" + group + ".json",
            function success(data) {
                callback(data);
            });
    }
};