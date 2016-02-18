"use strict";

var getData = {
    data: function(url, callback) {
        $.getJSON(url, function success(data) {
            callback(data);
        }).fail(function error() {
            errorMsg("Error 404, file not found.");
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