const $ = require('jquery');

const Helpers = {
  request(action, data) {
    const requestData = $.extend(data, { 'action': action });

    return $.get(document.body.dataset.ajaxUrl, requestData);
  },

  convertToObject(params) {
    const object = {};

    params.forEach(param => {
      object[param.name] = param.value;
    });

    return object;
  }
};

export default Helpers;
