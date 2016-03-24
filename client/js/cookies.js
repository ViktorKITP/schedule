"use strict";

const cookies = {
  setStartPageHideCheck(startPageHideCheck) {
    $.cookie('startPageHideCheck', startPageHideCheck, {
      expires: 69,
      path: '/'
    });
  },
  getStartPageHideCheck() {
    return $.cookie('startPageHideCheck');
  },
};
