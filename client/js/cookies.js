"use strict";

var cookies = {
    setStartPageHideCheck: function(startPageHideCheck) {
        $.cookie('startPageHideCheck', startPageHideCheck, { expires: 62, path: '/' });
    },
    getStartPageHideCheck: function() {
        return $.cookie('startPageHideCheck');
    }
};