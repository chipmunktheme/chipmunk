"use strict";
self["webpackHotUpdatechipmunk"]("theme",{

/***/ "./resources/scripts/modules/actions.js":
/*!**********************************************!*\
  !*** ./resources/scripts/modules/actions.js ***!
  \**********************************************/
/***/ ((module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! axios */ 9669);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_0__);
/* provided dependency */ var __react_refresh_utils__ = __webpack_require__(/*! ./node_modules/@pmmmwh/react-refresh-webpack-plugin/lib/runtime/RefreshUtils.js */ "./node_modules/@pmmmwh/react-refresh-webpack-plugin/lib/runtime/RefreshUtils.js");
__webpack_require__.$Refresh$.runtime = __webpack_require__(/*! ./node_modules/react-refresh/runtime.js */ "./node_modules/react-refresh/runtime.js");


const Actions = {
  http: null,

  init() {
    let element = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : document;
    const {
      ajaxUrl,
      loginUrl
    } = window;
    this.settings = {
      ajaxUrl,
      loginUrl
    };
    this.triggers = Array.from(element.querySelectorAll('[data-action]:not([data-type])'));
    this.http = axios__WEBPACK_IMPORTED_MODULE_0___default().create({
      transformRequest: [data => {
        // Prefix the action name
        data.set('action', "chipmunk_".concat(data.get('action')));
        return data;
      }]
    });
    this.triggers.forEach(trigger => {
      if (!trigger.dataset.listening) {
        if (trigger.hasAttribute('action')) {
          trigger.addEventListener('submit', this.handleEvent.bind(this));
        } else {
          trigger.addEventListener('click', this.handleEvent.bind(this));
        } // Only bind the event once on this element


        trigger.dataset.listening = true;
      }
    });
  },

  handleEvent(ev, trigger) {
    if (ev) {
      if (!trigger) {
        trigger = ev.currentTarget;
      }

      ev.preventDefault();
      ev.stopPropagation();
    }

    this.runActions(trigger, [{
      data: trigger.dataset
    }]);
  },

  runActions(trigger, actions) {
    const requests = [];

    if (actions && actions.length) {
      // Enable loading indicator
      trigger.classList.add('is-loading'); // Disable the current trigger

      trigger.setAttribute('disabled', true); // Loop through the actions provided

      actions.forEach(action => {
        const formData = new FormData(trigger.hasAttribute('action') ? trigger : document.createElement('form')); // Extend formData with trigger data attributes

        Object.keys(action.data).forEach(key => {
          formData.append(key, action.data[key]);
        }); // Assign callback function

        action.callback = action.callback || this.callbacks[action.data.action] || (() => {}); // Assign new request


        requests.push(this.http.post(this.settings.ajaxUrl, formData));
      }); // Run concurrent action

      axios__WEBPACK_IMPORTED_MODULE_0___default().all(requests).then(axios__WEBPACK_IMPORTED_MODULE_0___default().spread(function () {
        for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
          args[_key] = arguments[_key];
        }

        args.forEach((arg, index) => {
          setTimeout(() => {
            actions[index].callback(trigger, arg.data, actions[index].data.action); // Disable loading indicator

            trigger.classList.remove('is-loading'); // Enable the current trigger

            trigger.removeAttribute('disabled');
          }, 250);
        });
      }));
    }
  },

  handlers: {
    toggle: (trigger, _ref, action) => {
      let {
        success,
        data
      } = _ref;

      if (success) {
        const targets = document.querySelectorAll("[data-action=\"".concat(action, "\"][data-action-post-id=\"").concat(data.post, "\"]"));
        targets.forEach(target => {
          target.classList[data.status]('is-active');
          target.innerHTML = data.content;
        });
      } else {
        if (undefined.settings.loginUrl) {
          window.location = undefined.settings.loginUrl;
        }
      }
    }
  },
  callbacks: {
    submit_resource: (trigger, _ref2, action) => {
      let {
        success,
        data
      } = _ref2;
      const element = trigger.querySelector("[data-action-element=".concat(action, "]"));
      const message = trigger.querySelector("[data-action-message=".concat(action, "]"));

      if (message) {
        message.style.display = null;
        message.dataset.status = success ? 'success' : 'error';
        message.innerHTML = data;

        if (success) {
          element.style.display = 'none';
        }
      }
    },
    load_posts: (trigger, _ref3, action) => {
      let {
        success,
        data
      } = _ref3;
      const element = document.querySelector("[data-action-element=".concat(action, "]"));

      if (element) {
        if (success) {
          element.insertAdjacentHTML('beforeend', data);
          trigger.dataset.page = parseInt(trigger.dataset.page, 10) + 1;
        } else {
          trigger.parentNode.insertAdjacentHTML('beforeend', "<p class=\"l-header__copy\">".concat(data, "</p>"));
          trigger.parentNode.removeChild(trigger);
        } // Rebind actions listeners


        Actions.init(element);
      }
    },
    toggle_bookmark: (trigger, response, action) => {
      Actions.handlers.toggle(trigger, response, action);
    },
    toggle_upvote: (trigger, response, action) => {
      Actions.handlers.toggle(trigger, response, action);
    },
    submit_rating: (trigger, _ref4) => {
      let {
        success,
        data
      } = _ref4;
      const element = document.querySelector("[data-action-rating=\"".concat(data.post, "\"]"));

      if (element) {
        if (success) {
          element.innerHTML = data.content;
        }
      }
    }
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Actions);

const $ReactRefreshModuleId$ = __webpack_require__.$Refresh$.moduleId;
const $ReactRefreshCurrentExports$ = __react_refresh_utils__.getModuleExports(
	$ReactRefreshModuleId$
);

function $ReactRefreshModuleRuntime$(exports) {
	if (true) {
		let errorOverlay;
		if (true) {
			errorOverlay = false;
		}
		let testMode;
		if (typeof __react_refresh_test__ !== 'undefined') {
			testMode = __react_refresh_test__;
		}
		return __react_refresh_utils__.executeRuntime(
			exports,
			$ReactRefreshModuleId$,
			module.hot,
			errorOverlay,
			testMode
		);
	}
}

if (typeof Promise !== 'undefined' && $ReactRefreshCurrentExports$ instanceof Promise) {
	$ReactRefreshCurrentExports$.then($ReactRefreshModuleRuntime$);
} else {
	$ReactRefreshModuleRuntime$($ReactRefreshCurrentExports$);
}

/***/ })

},
/******/ function(__webpack_require__) { // webpackRuntimeModules
/******/ /* webpack/runtime/getFullHash */
/******/ (() => {
/******/ 	__webpack_require__.h = () => ("7527262387514c390b0f")
/******/ })();
/******/ 
/******/ }
);
//# sourceMappingURL=theme.c55dd0953e669e5d68f7.hot-update.js.map