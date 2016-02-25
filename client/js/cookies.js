"use strict";

var cookies = {
  setStartPageHideCheck: function(startPageHideCheck) {
    $.cookie('startPageHideCheck', startPageHideCheck, {
      expires: 69,
      path: '/'
    });
  },
  getStartPageHideCheck: function() {
    return $.cookie('startPageHideCheck');
  },
  setCourseAndGroupCookike: function(course, group) {
    $.cookie('course', course, {
      expires: 69,
      path: '/'
    });
    $.cookie('group', group, {
      expires: 69,
      path: '/'
    });
  },
  getCourseCookie: function() {
    return $.cookie('course');
  },
  getGroupCookie: function() {
    return $.cookie('group');
  }
};
