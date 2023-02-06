/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "../../../../../../node_modules/@roots/bud-support/lib/css-loader/index.cjs??css!../../../../../../node_modules/postcss-loader/dist/cjs.js??postcss!../../../../../../node_modules/resolve-url-loader/index.js??resolveUrl!../../../../../../node_modules/sass-loader/dist/cjs.js??sass-loader!./styles/theme.scss":
/*!*************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ../../../../../../node_modules/@roots/bud-support/lib/css-loader/index.cjs??css!../../../../../../node_modules/postcss-loader/dist/cjs.js??postcss!../../../../../../node_modules/resolve-url-loader/index.js??resolveUrl!../../../../../../node_modules/sass-loader/dist/cjs.js??sass-loader!./styles/theme.scss ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_css_loader_dist_runtime_noSourceMaps_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../../../../node_modules/css-loader/dist/runtime/noSourceMaps.js */ "../../../../../../node_modules/css-loader/dist/runtime/noSourceMaps.js");
/* harmony import */ var _node_modules_css_loader_dist_runtime_noSourceMaps_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_css_loader_dist_runtime_noSourceMaps_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../../../../node_modules/css-loader/dist/runtime/api.js */ "../../../../../../node_modules/css-loader/dist/runtime/api.js");
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_1__);
// Imports


var ___CSS_LOADER_EXPORT___ = _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_1___default()((_node_modules_css_loader_dist_runtime_noSourceMaps_js__WEBPACK_IMPORTED_MODULE_0___default()));
// Module
___CSS_LOADER_EXPORT___.push([module.id, "@charset \"UTF-8\";\n/*!\n ** Project:      Chipmunk Theme\n ** Author:       Made by Less\n ** Author URI:   https://madebyless.com\n ** ------------------------------------\n */\n/*\n** Tools - Align\n** ----------------------------------------------------------------------------- */\n/*\n** Tools - Breakpoints\n** ----------------------------------------------------------------------------- */\n/*\n** Tools - Cover\n** ----------------------------------------------------------------------------- */\n/*\n** Tools - Dropdown\n** ----------------------------------------------------------------------------- */\n/*\n** Tools - Line clamp\n** ----------------------------------------------------------------------------- */\n/*\n** Tools - Loader\n** ----------------------------------------------------------------------------- */\n/*\n** Tools - Settings\n** ----------------------------------------------------------------------------- */\n/*\n** Tools - Spacers\n** ----------------------------------------------------------------------------- */\n/*\n** Tools - Typography\n** ----------------------------------------------------------------------------- */\n/*\n** Variables - Buttons\n** ----------------------------------------------------------------------------- */\nbody {\n  --chipmunk--button--border-width: 1px;\n  --chipmunk--button--border-radius: 100vmin;\n  --chipmunk--button--font-size: 0.875em;\n}\n/*\n** Variables - Colors\n** ----------------------------------------------------------------------------- */\nbody {\n  --chipmunk--color--accent: #5b5c89;\n  --chipmunk--color--black: #1d1d1d;\n  --chipmunk--color--gray-dark: #444;\n  --chipmunk--color--gray: #777;\n  --chipmunk--color--gray-light: #cdcdcd;\n  --chipmunk--color--gray-lighter: #e6e6e6;\n  --chipmunk--color--gray-lightest: #ededed;\n  --chipmunk--color--white: #fafafa;\n  --chipmunk--color--status-success: #4f8a10;\n  --chipmunk--color--status-warning: #9f6000;\n  --chipmunk--color--status-info: #369bf8;\n  --chipmunk--color--status-error: #f74444;\n  --chipmunk--color--primary: var(--chipmunk--color--accent);\n  --chipmunk--color--link: var(--chipmunk--color--accent);\n  --chipmunk--color--background: var(--chipmunk--color--gray-lightest);\n  --chipmunk--color--section: var(--chipmunk--color--white);\n}\n/*\n** Variables - Layers\n** ----------------------------------------------------------------------------- */\nbody {\n  --chipmunk--layer--negative: -1;\n  --chipmunk--layer--neutral: 0;\n  --chipmunk--layer--base: 1;\n  --chipmunk--layer--utils: 5;\n  --chipmunk--layer--dropdown: 15;\n  --chipmunk--layer--overlay: 20;\n  --chipmunk--layer--head: 25;\n  --chipmunk--layer--top: 30;\n  --chipmunk--layer--search: 35;\n  --chipmunk--layer--popup: 40;\n}\n/*\n** Variables - Layout\n** ----------------------------------------------------------------------------- */\nbody {\n  --chipmunk--layout--container-width: 110rem;\n  --chipmunk--layout--container-gutter: max(2.4rem, min(5vw, 7.2rem));\n  --chipmunk--layout--column-gutter: calc(var(--chipmunk--layout--container-width) * 0.025);\n  --chipmunk--layout--content-width: 8;\n  --chipmunk--layout--popup-width: 80rem;\n  --chipmunk--layout--tile-padding: 1rem;\n}\n/*\n** Variables - Miscellaneous\n** ----------------------------------------------------------------------------- */\nbody {\n  --chipmunk--transition-duration: 0.25s;\n  --chipmunk--spacer: 1.25em;\n  --chipmunk--border-opacity: 0.075;\n  --chipmunk--border-radius: 0.5rem;\n  --chipmunk--logo-height: 4rem;\n}\n/*\n** Variables - Typography\n** ----------------------------------------------------------------------------- */\nbody {\n  --chipmunk--font--system: -apple-system, BlinkMacSystemFont, \"Segoe UI\", roboto, oxygen, ubuntu, cantarell,\n    \"Open Sans\", \"Helvetica Neue\", sans-serif;\n  --chipmunk--font--mono: menlo, consolas, monaco, monospace;\n  --chipmunk--typography--font-family: var(--chipmunk--font--system);\n  --chipmunk--typography--font-size: 1.6rem;\n  --chipmunk--typography--line-height: 1.618;\n  --chipmunk--typography--scale: 1.25;\n  --chipmunk--typography--small: var(--chipmunk--typography--font-size);\n  --chipmunk--typography--normal: var(--chipmunk--typography--small) * var(--chipmunk--typography--scale);\n  --chipmunk--typography--medium: var(--chipmunk--typography--normal) * var(--chipmunk--typography--scale);\n  --chipmunk--typography--large: var(--chipmunk--typography--medium) * var(--chipmunk--typography--scale);\n  --chipmunk--typography--xlarge: var(--chipmunk--typography--large) * var(--chipmunk--typography--scale);\n  --chipmunk--typography--huge: var(--chipmunk--typography--xlarge) * var(--chipmunk--typography--scale);\n  --chipmunk--typography--heading-font-family: var(--chipmunk--font--system);\n  --chipmunk--typography--content-size: 1.25em;\n}\n/*\n** Placeholders - Box\n** ----------------------------------------------------------------------------- */\n.c-page-head, .l-section:not([class*=theme]):not([class*=intro]) + .l-section:not([class*=theme]), .l-section--theme-light {\n  position: relative;\n  z-index: var(--chipmunk--layer--base);\n  box-shadow: 0 1px 0 0 rgba(0, 0, 0,var(--chipmunk--border-opacity)), 0 -1px 0 0 rgba(0, 0, 0,var(--chipmunk--border-opacity));\n}\n/*\n** Placeholders - Button\n** ----------------------------------------------------------------------------- */\n.wp-block-button__link, .c-stats__button, .c-members__form .button-primary, .c-button {\n  display: inline-block;\n  padding: 0.5em 1.75em;\n  background-color: transparent;\n  border: var(--chipmunk--button--border-width) solid transparent;\n  font-size: var(--chipmunk--button--font-size);\n  line-height: normal;\n  text-align: center;\n  white-space: nowrap;\n}\n.c-stats__button, .c-button {\n  border-radius: var(--chipmunk--button--border-radius);\n}\n.is-style-squared .wp-block-button__link {\n  border-radius: 0;\n}\n.wp-block-button__link:not(.has-background), .c-members__form .button-primary, .c-button--primary {\n  background-color: var(--chipmunk--color--primary);\n  color: var(--chipmunk--color--white);\n}\n.wp-block-button__link:not([disabled]):hover:not(.has-background), .c-members__form .button-primary:not([disabled]):hover, .c-button--primary:not([disabled]):hover {\n  background-color: transparent;\n  border-color: currentColor;\n  color: var(--chipmunk--color--primary);\n}\n.is-style-outline .wp-block-button__link:not(.has-background), .c-button--primary-outline {\n  background-color: transparent;\n  border-color: currentColor;\n  color: var(--chipmunk--color--primary);\n}\n.is-style-outline .wp-block-button__link:not([disabled]):hover:not(.has-background), .c-button--primary-outline:not([disabled]):hover {\n  background-color: var(--chipmunk--color--primary);\n  border-color: transparent;\n  color: var(--chipmunk--color--white);\n}\n.c-button--secondary {\n  background-color: var(--chipmunk--color--gray);\n  color: var(--chipmunk--color--white);\n}\n.c-button--secondary:not([disabled]):hover {\n  background-color: transparent;\n  border-color: currentColor;\n  color: var(--chipmunk--color--gray);\n}\n.c-button--secondary-outline {\n  background-color: transparent;\n  border-color: currentColor;\n  color: var(--chipmunk--color--gray);\n}\n.c-button--secondary-outline:not([disabled]):hover {\n  background-color: var(--chipmunk--color--gray);\n  border-color: transparent;\n  color: var(--chipmunk--color--white);\n}\n.c-button--white {\n  background-color: var(--chipmunk--color--white);\n  color: var(--chipmunk--color--white);\n}\n.c-button--white:not([disabled]):hover {\n  background-color: transparent;\n  border-color: currentColor;\n  color: var(--chipmunk--color--white);\n}\n.c-button--white-outline {\n  background-color: transparent;\n  border-color: currentColor;\n  color: var(--chipmunk--color--white);\n}\n.c-button--white-outline:not([disabled]):hover {\n  background-color: var(--chipmunk--color--white);\n  border-color: transparent;\n  color: var(--chipmunk--color--primary);\n}\n/*\n** Placeholders - Caption\n** ----------------------------------------------------------------------------- */\n.c-profile__description figcaption, .c-content figcaption, .c-profile__description cite, .c-content cite,\n.c-profile__description footer,\n.c-content footer, .c-profile__description blockquote:not([class*=block]) cite, .c-content blockquote:not([class*=block]) cite {\n  margin: clamp(\n    calc(var(--chipmunk--spacer) * 0.5),\n    1 * 1vw,\n    calc(var(--chipmunk--spacer) * 1)\n  ) 0 0;\n  color: var(--chipmunk--color--gray);\n  font-size: 0.875em;\n  word-wrap: break-word;\n}\n.c-profile__description .alignwide > figcaption, .c-content .alignwide > figcaption,\n.c-profile__description .alignfull > figcaption,\n.c-content .alignfull > figcaption {\n  margin-left: var(--chipmunk--layout--container-gutter);\n  margin-right: var(--chipmunk--layout--container-gutter);\n}\n.c-profile__description cite, .c-content cite,\n.c-profile__description footer,\n.c-content footer {\n  display: inline-block;\n}\n.c-profile__description cite:not(:first-child), .c-content cite:not(:first-child),\n.c-profile__description footer:not(:first-child),\n.c-content footer:not(:first-child) {\n  margin-top: calc(var(--chipmunk--typography--line-height) * 1 * 1em);\n}\n.c-profile__description cite::before, .c-content cite::before,\n.c-profile__description footer::before,\n.c-content footer::before {\n  content: \"– \";\n}\n/*\n** Placeholders - Container\n** ----------------------------------------------------------------------------- */\n.c-overlay__inner, .l-container {\n  width: 100%;\n  margin-right: auto;\n  margin-left: auto;\n  max-width: min(var(--chipmunk--layout--container-width), 100vw - var(--chipmunk--layout--container-gutter) * 2);\n}\n/*\n** Placeholders - Copy\n** ----------------------------------------------------------------------------- */\n.c-profile__description h1:not(:first-child), .c-content h1:not(:first-child),\n.c-profile__description h2:not(:first-child),\n.c-content h2:not(:first-child),\n.c-profile__description h3:not(:first-child),\n.c-content h3:not(:first-child),\n.c-profile__description h4:not(:first-child),\n.c-content h4:not(:first-child),\n.c-profile__description h5:not(:first-child),\n.c-content h5:not(:first-child),\n.c-profile__description h6:not(:first-child),\n.c-content h6:not(:first-child) {\n  margin-top: calc(var(--chipmunk--typography--line-height) * 1 * 1em);\n}\n.c-profile__description h1 + ul:not(:first-child), .c-content h1 + ul:not(:first-child),\n.c-profile__description h1 + ol:not(:first-child),\n.c-content h1 + ol:not(:first-child),\n.c-profile__description h2 + ul:not(:first-child),\n.c-content h2 + ul:not(:first-child),\n.c-profile__description h2 + ol:not(:first-child),\n.c-content h2 + ol:not(:first-child),\n.c-profile__description h3 + ul:not(:first-child),\n.c-content h3 + ul:not(:first-child),\n.c-profile__description h3 + ol:not(:first-child),\n.c-content h3 + ol:not(:first-child),\n.c-profile__description h4 + ul:not(:first-child),\n.c-content h4 + ul:not(:first-child),\n.c-profile__description h4 + ol:not(:first-child),\n.c-content h4 + ol:not(:first-child),\n.c-profile__description h5 + ul:not(:first-child),\n.c-content h5 + ul:not(:first-child),\n.c-profile__description h5 + ol:not(:first-child),\n.c-content h5 + ol:not(:first-child),\n.c-profile__description h6 + ul:not(:first-child),\n.c-content h6 + ul:not(:first-child),\n.c-profile__description h6 + ol:not(:first-child),\n.c-content h6 + ol:not(:first-child) {\n  margin-top: 0;\n}\n.c-profile__description p:not([class*=block]):not(:first-child), .c-content p:not([class*=block]):not(:first-child),\n.c-profile__description ul:not([class*=block]):not(:first-child),\n.c-content ul:not([class*=block]):not(:first-child),\n.c-profile__description ol:not([class*=block]):not(:first-child),\n.c-content ol:not([class*=block]):not(:first-child),\n.c-profile__description blockquote:not([class*=block]):not(:first-child),\n.c-content blockquote:not([class*=block]):not(:first-child),\n.c-profile__description table:not([class*=block]):not(:first-child),\n.c-content table:not([class*=block]):not(:first-child),\n.c-profile__description pre:not([class*=block]):not(:first-child),\n.c-content pre:not([class*=block]):not(:first-child),\n.c-profile__description code:not([class*=block]):not(:first-child),\n.c-content code:not([class*=block]):not(:first-child),\n.c-profile__description iframe:not([class*=block]):not(:first-child),\n.c-content iframe:not([class*=block]):not(:first-child),\n.c-profile__description .wp-caption:not([class*=block]):not(:first-child),\n.c-content .wp-caption:not([class*=block]):not(:first-child) {\n  margin-top: calc(var(--chipmunk--typography--line-height) * 1 * 1em);\n}\n.c-profile__description ul:not([class*=block]), .c-content ul:not([class*=block]),\n.c-profile__description ol:not([class*=block]),\n.c-content ol:not([class*=block]) {\n  padding-left: calc(var(--chipmunk--typography--line-height) * 1 * 1em);\n  list-style-position: inside;\n}\n.c-profile__description ul:not([class*=block]) li:not(:first-child), .c-content ul:not([class*=block]) li:not(:first-child),\n.c-profile__description ol:not([class*=block]) li:not(:first-child),\n.c-content ol:not([class*=block]) li:not(:first-child) {\n  margin-top: calc(var(--chipmunk--typography--line-height) * 0.25 * 1em);\n}\n.c-profile__description ul:not([class*=block]) ul, .c-content ul:not([class*=block]) ul,\n.c-profile__description ul:not([class*=block]) ol,\n.c-content ul:not([class*=block]) ol,\n.c-profile__description ol:not([class*=block]) ul,\n.c-content ol:not([class*=block]) ul,\n.c-profile__description ol:not([class*=block]) ol,\n.c-content ol:not([class*=block]) ol {\n  padding-top: calc(var(--chipmunk--typography--line-height) * 0.25 * 1em);\n  padding-left: calc(var(--chipmunk--typography--line-height) * 1 * 1em);\n}\n.c-profile__description ul:not([class*=block]), .c-content ul:not([class*=block]) {\n  list-style: disc;\n}\n.c-profile__description ol:not([class*=block]), .c-content ol:not([class*=block]) {\n  list-style: decimal;\n}\n.c-profile__description iframe, .c-content iframe {\n  display: block;\n  width: 100%;\n  background-color: var(--chipmunk--color--white);\n}\n.c-profile__description blockquote:not([class*=block]) p, .c-content blockquote:not([class*=block]) p {\n  font-size: 1.2em;\n  line-height: 1.5;\n}\n.c-profile__description blockquote:not([class*=block]) em, .c-content blockquote:not([class*=block]) em {\n  font-style: normal;\n}\n.c-profile__description table, .c-content table {\n  min-width: 100%;\n  table-layout: fixed;\n  border: 1px solid var(--chipmunk--color--gray);\n  border-spacing: 0;\n  border-collapse: collapse;\n  font-size: 0.8em;\n}\n@media (min-width: 680px) {\n  .c-profile__description table, .c-content table {\n    border-width: 2px;\n  }\n}\n.c-profile__description table thead, .c-content table thead {\n  background-color: var(--chipmunk--color--white);\n  font-weight: bold;\n  text-align: left;\n}\n.c-profile__description table td, .c-content table td,\n.c-profile__description table th,\n.c-content table th {\n  padding: 0.5em 1em;\n  border: 1px solid var(--chipmunk--color--gray);\n  vertical-align: top;\n}\n@media (min-width: 680px) {\n  .c-profile__description table td, .c-content table td,\n  .c-profile__description table th,\n  .c-content table th {\n    border-width: 2px;\n  }\n}\n.c-profile__description hr:not([class]), .c-content hr:not([class]) {\n  border-bottom: 2px solid var(--chipmunk--color--gray-lighter);\n}\n.c-profile__description strong, .c-content strong,\n.c-profile__description b,\n.c-content b {\n  font-weight: bold;\n}\n.c-profile__description em, .c-content em,\n.c-profile__description i,\n.c-content i {\n  font-style: italic;\n}\n.c-profile__description pre, .c-content pre {\n  font-family: var(--chipmunk--font--mono);\n  font-size: 0.8125em;\n  line-height: 1.75;\n  white-space: nowrap;\n  overflow: auto;\n  tab-size: 4;\n}\n@media (min-width: 1024px) {\n  .c-profile__description .alignwide > figcaption, .c-content .alignwide > figcaption {\n    margin-left: 0;\n    margin-right: 0;\n  }\n}\n.c-content--type {\n  font-size: var(--chipmunk--typography--content-size);\n}\n/*\n** Placeholders - Dropdown\n** ----------------------------------------------------------------------------- */\n.u-dropdown__link, .c-menu-primary .sub-menu .menu-item > a {\n  position: relative;\n  display: block;\n  width: 100%;\n  padding: 0.25em 1em;\n  text-align: inherit;\n}\n.u-dropdown__link:hover, .c-menu-primary .sub-menu .menu-item > a:hover {\n  opacity: 0.8;\n}\n/*\n** Placeholders - Form\n** ----------------------------------------------------------------------------- */\n.c-members__form input[type=text],\n.c-members__form input[type=email],\n.c-members__form input[type=url],\n.c-members__form input[type=password],\n.c-members__form textarea, .c-form__input {\n  display: block;\n  width: 100%;\n  padding: 0.25em 0;\n  background-color: transparent;\n  border: 0;\n  border-bottom: 0.1em solid currentColor;\n  border-radius: 0;\n  color: inherit;\n  font-size: inherit;\n  text-align: inherit;\n  resize: none;\n  -webkit-appearance: none;\n          appearance: none;\n}\n.c-members__form input[type=text]:not([rows]),\n.c-members__form input[type=email]:not([rows]),\n.c-members__form input[type=url]:not([rows]),\n.c-members__form input[type=password]:not([rows]),\n.c-members__form textarea:not([rows]), .c-form__input:not([rows]) {\n  overflow: hidden;\n  text-overflow: ellipsis;\n  white-space: nowrap;\n}\n.c-members__form input[type=text]::placeholder,\n.c-members__form input[type=email]::placeholder,\n.c-members__form input[type=url]::placeholder,\n.c-members__form input[type=password]::placeholder,\n.c-members__form textarea::placeholder, .c-form__input::placeholder {\n  color: inherit;\n  opacity: 0.5;\n}\n.c-members__form input[type=text]:focus,\n.c-members__form input[type=email]:focus,\n.c-members__form input[type=url]:focus,\n.c-members__form input[type=password]:focus,\n.c-members__form textarea:focus, .c-form__input:focus {\n  outline: none;\n}\n.c-members__form input[type=number][type=text]::-webkit-inner-spin-button,\n.c-members__form input[type=number][type=email]::-webkit-inner-spin-button,\n.c-members__form input[type=number][type=url]::-webkit-inner-spin-button,\n.c-members__form input[type=number][type=password]::-webkit-inner-spin-button,\n.c-members__form textarea[type=number]::-webkit-inner-spin-button, [type=number].c-form__input::-webkit-inner-spin-button, .c-members__form input[type=number][type=text]::-webkit-outer-spin-button,\n.c-members__form input[type=number][type=email]::-webkit-outer-spin-button,\n.c-members__form input[type=number][type=url]::-webkit-outer-spin-button,\n.c-members__form input[type=number][type=password]::-webkit-outer-spin-button,\n.c-members__form textarea[type=number]::-webkit-outer-spin-button, [type=number].c-form__input::-webkit-outer-spin-button {\n  -webkit-appearance: none;\n          appearance: none;\n}\n.c-members__form input[type=text]:-webkit-autofill,\n.c-members__form input[type=email]:-webkit-autofill,\n.c-members__form input[type=url]:-webkit-autofill,\n.c-members__form input[type=password]:-webkit-autofill,\n.c-members__form textarea:-webkit-autofill, .c-form__input:-webkit-autofill {\n  animation-delay: 1s;\n  animation-name: autofill;\n  animation-fill-mode: both;\n}\n/*\n** Placeholders - Heading\n** ----------------------------------------------------------------------------- */\n.c-heading, .c-profile__description h1, .c-content h1,\n.c-profile__description h2,\n.c-content h2,\n.c-profile__description h3,\n.c-content h3,\n.c-profile__description h4,\n.c-content h4,\n.c-profile__description h5,\n.c-content h5,\n.c-profile__description h6,\n.c-content h6 {\n  font-family: var(--chipmunk--typography--heading-font-family);\n  font-weight: 700;\n  line-height: calc(1.5rem + 1.5ex);\n}\n.c-heading--h6, .c-profile__description h6, .c-content h6 {\n  font-size: var(--chipmunk--typography--small);\n}\n.c-heading--h5, .c-profile__description h5, .c-content h5 {\n  font-size: clamp(var(--chipmunk--typography--small), 1rem + 1vw, var(--chipmunk--typography--normal));\n  font-size: clamp(var(--chipmunk--typography--small), 1rem + var(--chipmunk--typography--normal--preferred, 1vw), var(--chipmunk--typography--normal));\n}\n.c-heading--h4, .c-profile__description h4, .c-content h4 {\n  font-size: clamp(var(--chipmunk--typography--normal), 1rem + 2vw, var(--chipmunk--typography--medium));\n  font-size: clamp(var(--chipmunk--typography--normal), 1rem + var(--chipmunk--typography--medium--preferred, 2vw), var(--chipmunk--typography--medium));\n}\n.c-heading--h3, .c-profile__description h3, .c-content h3 {\n  font-size: clamp(var(--chipmunk--typography--medium), 1rem + 3vw, var(--chipmunk--typography--large));\n  font-size: clamp(var(--chipmunk--typography--medium), 1rem + var(--chipmunk--typography--large--preferred, 3vw), var(--chipmunk--typography--large));\n}\n.c-heading--h2, .c-profile__description h2, .c-content h2 {\n  font-size: clamp(var(--chipmunk--typography--large), 1rem + 4vw, var(--chipmunk--typography--xlarge));\n  font-size: clamp(var(--chipmunk--typography--large), 1rem + var(--chipmunk--typography--xlarge--preferred, 4vw), var(--chipmunk--typography--xlarge));\n}\n.c-heading--h1, .c-profile__description h1, .c-content h1 {\n  font-size: clamp(var(--chipmunk--typography--xlarge), 1rem + 5vw, var(--chipmunk--typography--huge));\n  font-size: clamp(var(--chipmunk--typography--xlarge), 1rem + var(--chipmunk--typography--huge--preferred, 5vw), var(--chipmunk--typography--huge));\n}\n/*\n** Placeholders - Link\n** ----------------------------------------------------------------------------- */\n.c-profile__description a:not([class]), .c-content a:not([class]) {\n  color: var(--chipmunk--color--link);\n}\n.c-profile__description a:not([class]):hover, .c-content a:not([class]):hover, .c-profile__description a:not([class]):focus, .c-content a:not([class]):focus {\n  opacity: 0.8;\n}\n.c-stats__button, a,\nbutton {\n  color: inherit;\n  cursor: pointer;\n  text-decoration: none;\n  -webkit-user-drag: none;\n  transition-duration: var(--chipmunk--transition-duration);\n  transition-property: color, background-color, border-color, outline, box-shadow, opacity, outline, transform;\n}\n.c-stats__button:focus, a:focus,\nbutton:focus {\n  outline: none;\n}\n/*\n** Generic - Animations\n** ----------------------------------------------------------------------------- */\n@keyframes button-spin {\n  from {\n    transform: rotate(0);\n  }\n  to {\n    transform: rotate(360deg);\n  }\n}\n@keyframes grow {\n  0%, 100% {\n    transform: translate3d(0, 0, 0) scale(1);\n  }\n  50% {\n    transform: translate3d(0, 0, 0) scale(1.5);\n  }\n}\n/*\n** Generic - Reset\n** ----------------------------------------------------------------------------- */\n*,\n*::before,\n*::after {\n  box-sizing: border-box;\n}\n* {\n  margin: 0;\n  padding: 0;\n  background: none;\n  border: 0;\n  color: inherit;\n  font-family: inherit;\n  font-size: inherit;\n  font-style: inherit;\n  font-weight: inherit;\n  line-height: inherit;\n  text-align: inherit;\n  text-transform: inherit;\n}\n:root {\n  height: 100%;\n  font-size: 62.5%;\n  -ms-overflow-style: -ms-autohiding-scrollbar;\n  overflow-y: scroll;\n  -webkit-text-size-adjust: 100%;\n          text-size-adjust: 100%;\n  -webkit-font-smoothing: antialiased;\n  -moz-osx-font-smoothing: grayscale;\n  text-rendering: optimizeLegibility;\n  word-wrap: break-word;\n  word-wrap: break-word;\n  -ms-word-break: break-all;\n  word-break: break-all;\n  word-break: break-word;\n}\n:root :where(img) {\n  height: auto;\n  max-width: 100%;\n}\nbutton {\n  background: none;\n  border: 0;\n  border-radius: 0;\n  -webkit-appearance: none;\n          appearance: none;\n}\nul,\nol {\n  list-style: none;\n}\nsub,\nsup {\n  position: relative;\n  font-size: 0.75em;\n  line-height: 0;\n  vertical-align: baseline;\n}\nsup {\n  top: -0.5em;\n}\nsub {\n  bottom: -0.4em;\n}\n/*\n** Vendor - Flickity\n** ----------------------------------------------------------------------------- */\n/* prevent page scrolling when flickity is fullscreen */\n.is-flickity-fullscreen {\n  overflow: hidden;\n}\n.flickity-enabled {\n  position: relative;\n}\n.flickity-enabled:focus {\n  outline: none;\n}\n.flickity-enabled.is-draggable {\n  -webkit-user-select: none;\n          user-select: none;\n}\n.flickity-enabled.is-draggable .flickity-viewport {\n  cursor: grab;\n}\n.flickity-enabled.is-draggable .flickity-viewport.is-pointer-down {\n  cursor: grabbing;\n}\n.flickity-enabled.is-fade .flickity-slider > * {\n  pointer-events: none;\n}\n.flickity-enabled.is-fade .flickity-slider > .is-selected {\n  pointer-events: auto;\n}\n.flickity-viewport {\n  overflow: hidden;\n  position: relative;\n  height: 100%;\n  transition: height 0.25s;\n}\n.is-fullscreen .flickity-viewport {\n  transition: none;\n}\n.flickity-slider {\n  position: absolute;\n  width: 100%;\n  height: 100%;\n}\n.flickity-button {\n  display: block;\n  position: absolute;\n  bottom: 100%;\n  z-index: var(--chipmunk--layer--utils);\n  width: 1em;\n  height: 1em;\n  margin-bottom: calc(var(--chipmunk--layout--column-gutter) * 0.5 + 0.2em);\n  font-size: 1.25em;\n  transition-property: font-size, opacity;\n  transition-duration: var(--chipmunk--transition-duration);\n}\n.flickity-button.previous {\n  right: calc(var(--chipmunk--layout--column-gutter) * 0.5 + 1em + (var(--chipmunk--spacer) * 0.5));\n  right: calc(var(--chipmunk--layout--column-gutter) * 0.5 + 1em + calc(var(--chipmunk--spacer) * 0.5));\n}\n.flickity-button.next {\n  right: calc(var(--chipmunk--layout--column-gutter) * 0.5);\n}\n.flickity-button svg {\n  display: block;\n  height: 1em;\n  width: 1em;\n  fill: currentColor;\n  stroke: none;\n}\n.flickity-button:not([disabled]):hover {\n  cursor: pointer;\n  opacity: 0.75;\n}\n.flickity-button[disabled] {\n  opacity: 0.5;\n  pointer-events: none;\n}\n/*\n** Layout - Body\n** ----------------------------------------------------------------------------- */\n.l-body {\n  display: flex;\n  flex-direction: column;\n  min-height: 100%;\n  position: relative;\n  background-color: var(--chipmunk--color--background);\n  color: var(--chipmunk--color--black);\n  font-size: var(--chipmunk--typography--font-size);\n  font-family: var(--chipmunk--typography--font-family);\n  line-height: var(--chipmunk--typography--line-height);\n  overflow: hidden;\n}\n.l-body::after {\n  content: \"\";\n  position: absolute;\n  top: 0;\n  right: 0;\n  bottom: 0;\n  left: 0;\n  z-index: calc(var(--chipmunk--layer--popup) - 1);\n  background-color: rgba(0, 0, 0, 0.85);\n  opacity: 0;\n  pointer-events: none;\n  transform: translateX(-300%);\n  transition: opacity var(--chipmunk--transition-duration), transform 0s var(--chipmunk--transition-duration);\n}\n.l-body.has-popup-open::after {\n  opacity: 1;\n  transform: translateX(0);\n  pointer-events: all;\n  transition: opacity var(--chipmunk--transition-duration) 0s, transform 0s 0s;\n}\n.l-body > #wpadminbar {\n  position: fixed;\n}\n/*\n** Layout - Component\n** ----------------------------------------------------------------------------- */\n.l-component:not(:first-child) {\n  margin-top: calc(var(--chipmunk--spacer) * 1.25);\n}\n.l-component--md:not(:first-child) {\n  margin-top: calc(var(--chipmunk--spacer) * 2.5);\n}\n.l-component--lg:not(:first-child) {\n  margin-top: calc(var(--chipmunk--spacer) * 5);\n}\n/*\n** Layout - Container\n** ----------------------------------------------------------------------------- */\n/*\n** Layout - Header\n** ----------------------------------------------------------------------------- */\n.l-header {\n  display: flex;\n  justify-content: space-between;\n  flex-wrap: wrap;\n  gap: calc(var(--chipmunk--spacer) * 1);\n}\n.l-header__copy {\n  color: var(--chipmunk--color--gray);\n}\n.l-header__copy a:hover {\n  color: var(--chipmunk--color--black);\n}\n@media (min-width: 1024px) {\n  .l-header__copy {\n    width: 100%;\n    padding-right: calc(33.3% - var(--chipmunk--layout--column-gutter) * 0.25);\n  }\n}\n/*\n** Layout - Section\n** ----------------------------------------------------------------------------- */\n.l-section {\n  padding-top: clamp(\n    calc(var(--chipmunk--spacer) * 2.5),\n    5 * 1vw,\n    calc(var(--chipmunk--spacer) * 5)\n  );\n  padding-bottom: clamp(\n    calc(var(--chipmunk--spacer) * 2.5),\n    5 * 1vw,\n    calc(var(--chipmunk--spacer) * 5)\n  );\n}\n.l-section--compact {\n  padding-top: clamp(\n    calc(var(--chipmunk--spacer) * 1.25),\n    2.5 * 1vw,\n    calc(var(--chipmunk--spacer) * 2.5)\n  );\n  padding-bottom: clamp(\n    calc(var(--chipmunk--spacer) * 1.25),\n    2.5 * 1vw,\n    calc(var(--chipmunk--spacer) * 2.5)\n  );\n}\n.l-section--double {\n  padding-top: clamp(\n    calc(var(--chipmunk--spacer) * 5),\n    10 * 1vw,\n    calc(var(--chipmunk--spacer) * 10)\n  );\n  padding-bottom: clamp(\n    calc(var(--chipmunk--spacer) * 5),\n    10 * 1vw,\n    calc(var(--chipmunk--spacer) * 10)\n  );\n}\n.l-section--theme-light {\n  background-color: var(--chipmunk--color--section);\n}\n.l-section--theme-primary {\n  background-color: var(--chipmunk--color--primary);\n  color: var(--chipmunk--color--white);\n}\n.l-section--intro + .l-section:not([class*=theme]) {\n  padding-top: 0;\n}\n.l-section--sticky {\n  margin-top: auto;\n}\n.l-section--sticky + .l-section--sticky {\n  margin-top: 0;\n}\n.l-section__title {\n  margin-right: auto;\n}\n/*\n** Layout - Wrapper\n** ----------------------------------------------------------------------------- */\n.l-wrapper {\n  width: 100%;\n  margin-right: auto;\n  margin-left: auto;\n}\n@media (min-width: 1024px) {\n  .l-wrapper {\n    width: calc(var(--chipmunk--layout--content-width) / 12 * 100%);\n  }\n}\n/*\n** Component - Button\n** ----------------------------------------------------------------------------- */\n/*\n** Component - Comment\n** ----------------------------------------------------------------------------- */\n.c-comment:not(:first-child),\n.c-comment .children:not(:first-child) {\n  margin-top: clamp(\n    calc(var(--chipmunk--spacer) * 1),\n    2 * 1vw,\n    calc(var(--chipmunk--spacer) * 2)\n  );\n}\n.c-comment__body {\n  display: flex;\n  flex-wrap: nowrap;\n}\n.c-comment__body + .children {\n  margin-left: calc(3.2rem + (var(--chipmunk--spacer) * 1));\n  margin-left: calc(3.2rem + calc(var(--chipmunk--spacer) * 1));\n}\n.c-comment__image {\n  width: 3.2rem;\n  margin-right: calc(var(--chipmunk--spacer) * 1);\n}\n.c-comment__image img {\n  border-radius: var(--chipmunk--button--border-radius);\n}\n.c-comment__info {\n  flex: 1;\n  display: flex;\n  flex-wrap: wrap;\n  align-items: center;\n  justify-content: flex-start;\n  gap: calc(var(--chipmunk--typography--line-height) * 0.5 * 1em);\n}\n.c-comment__title {\n  display: inline-block;\n  vertical-align: middle;\n}\n.c-comment__date {\n  display: block;\n  color: var(--chipmunk--color--gray);\n  font-size: 0.9em;\n  transition: color var(--chipmunk--transition-duration);\n}\n@media (min-width: 1024px) {\n  .c-comment__date {\n    color: var(--chipmunk--color--gray-light);\n  }\n  .c-comment__body:hover .c-comment__date {\n    color: var(--chipmunk--color--gray);\n  }\n}\n.c-comment__content {\n  width: 100%;\n}\n.c-comment__reply a {\n  display: inline-flex;\n  align-items: center;\n  gap: clamp(\n    calc(var(--chipmunk--spacer) * 0.25),\n    0.5 * 1vw,\n    calc(var(--chipmunk--spacer) * 0.5)\n  );\n  color: var(--chipmunk--color--gray);\n  font-size: 0.875em;\n}\n.c-comment__reply a:hover {\n  color: var(--chipmunk--color--black);\n}\n.c-comment__note {\n  color: var(--chipmunk--color--gray);\n  font-size: 0.875em;\n}\n/*\n** Component - Content\n** ----------------------------------------------------------------------------- */\n/*\n** Component - Entry\n** ----------------------------------------------------------------------------- */\n.c-entry {\n  display: flex;\n  align-items: flex-start;\n  flex-direction: column;\n  gap: calc(var(--chipmunk--spacer) * 2);\n}\n.c-entry__tile {\n  grid-column: 1/-1;\n}\n.c-entry__hero {\n  position: relative;\n  display: flex;\n  flex-direction: column;\n  justify-content: flex-end;\n  width: 100%;\n  min-height: 42rem;\n  max-height: 70rem;\n  overflow: hidden;\n}\n.c-entry__hero::after {\n  content: \"\";\n  position: absolute;\n  top: 0;\n  right: 0;\n  bottom: 0;\n  left: 0;\n  background-image: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.5));\n  pointer-events: none;\n}\n.c-entry__hero > img,\n.c-entry__hero > svg,\n.c-entry__hero > video {\n  position: absolute;\n  top: 0;\n  right: 0;\n  bottom: 0;\n  left: 0;\n  height: 100%;\n  width: 100%;\n  object-fit: cover;\n  -webkit-user-select: none;\n          user-select: none;\n  pointer-events: none;\n}\n.c-entry__details {\n  position: relative;\n  z-index: var(--chipmunk--layer--base);\n  display: flex;\n  flex-direction: column;\n  justify-content: flex-end;\n  min-height: 56.25vw;\n}\n.c-entry__details:not(:first-child) {\n  color: var(--chipmunk--color--white);\n}\n.c-entry__image {\n  width: 100%;\n}\n@media (max-width: 1023.98px) {\n  .c-entry__image.wp-block-image, .c-entry__image.wp-block-cover, .c-entry__image.wp-block-cover-image, .c-entry__image.wp-block-gallery, .c-entry__image.wp-block-embed, .c-entry__image.wp-block-columns {\n    width: 100vw;\n    margin-left: 50%;\n    transform: translateX(-50%);\n  }\n}\n@media (min-width: 1024px) {\n  .c-entry__image {\n    width: calc(100vw - (var(--chipmunk--layout--container-gutter) * 2));\n    width: calc(100vw - calc(var(--chipmunk--layout--container-gutter) * 2));\n    margin-left: 50%;\n    transform: translateX(-50%);\n    max-width: var(--chipmunk--layout--container-width);\n  }\n}\n.c-entry__image[href]:hover {\n  opacity: 0.9;\n}\n.c-entry__title a {\n  display: inline-block;\n}\n.c-entry__title a:hover {\n  color: var(--chipmunk--color--black);\n}\n.c-entry__stats:not(:first-child) {\n  margin-top: clamp(\n    calc(var(--chipmunk--spacer) * 0.75),\n    1.5 * 1vw,\n    calc(var(--chipmunk--spacer) * 1.5)\n  );\n}\n.c-entry__author {\n  display: flex;\n  align-items: center;\n  gap: clamp(\n    calc(var(--chipmunk--spacer) * 0.375),\n    0.75 * 1vw,\n    calc(var(--chipmunk--spacer) * 0.75)\n  );\n  font-size: 0.875em;\n}\n.c-entry__content {\n  width: 100%;\n}\n.c-entry__content:empty {\n  display: none;\n}\n.c-entry__description {\n  display: -webkit-box; /* stylelint-disable-line value-no-vendor-prefix */\n  -webkit-box-orient: vertical; /* stylelint-disable-line property-no-vendor-prefix */\n  -webkit-line-clamp: 3;\n  overflow: hidden;\n}\n.c-entry__footer {\n  display: flex;\n  align-items: center;\n  flex-wrap: wrap;\n  gap: clamp(\n    calc(var(--chipmunk--spacer) * 0.5),\n    1 * 1vw,\n    calc(var(--chipmunk--spacer) * 1)\n  ) clamp(\n    calc(var(--chipmunk--spacer) * 1),\n    2 * 1vw,\n    calc(var(--chipmunk--spacer) * 2)\n  );\n}\n.c-entry__extras:empty,\n.c-entry__footer:empty {\n  display: none;\n}\n/*\n** Component - Filter\n** ----------------------------------------------------------------------------- */\n.c-filter {\n  display: flex;\n  align-items: center;\n}\n.c-filter__group {\n  flex-basis: 100%;\n  display: flex;\n  flex-direction: column;\n  gap: clamp(\n    calc(var(--chipmunk--spacer) * 0.5),\n    1 * 1vw,\n    calc(var(--chipmunk--spacer) * 1)\n  ) calc(var(--chipmunk--spacer) * 2);\n}\n@media (min-width: 680px) {\n  .c-filter__group {\n    flex-basis: auto;\n    flex-direction: row;\n  }\n}\n.c-filter__title {\n  color: var(--chipmunk--color--gray);\n  font-size: 0.875em;\n  white-space: nowrap;\n}\n.c-filter__title:not(:last-child) {\n  margin-right: calc(var(--chipmunk--typography--line-height) * 0.75 * 1em);\n}\n@media (min-width: 1024px) {\n  .c-filter__title {\n    font-size: 1em;\n  }\n}\n/*\n** Component - Form\n** ----------------------------------------------------------------------------- */\n.c-form {\n  display: grid;\n  grid-template-columns: repeat(1, 1fr);\n  grid-gap: clamp(\n    calc(var(--chipmunk--spacer) * 0.75),\n    1.5 * 1vw,\n    calc(var(--chipmunk--spacer) * 1.5)\n  );\n  gap: clamp(\n    calc(var(--chipmunk--spacer) * 0.75),\n    1.5 * 1vw,\n    calc(var(--chipmunk--spacer) * 1.5)\n  );\n  width: 100%;\n  text-align: left;\n  transition: opacity var(--chipmunk--transition-duration);\n}\n@media (min-width: 680px) {\n  .c-form {\n    grid-template-columns: repeat(2, 1fr);\n  }\n}\n.c-form.is-loading::after {\n  font-size: 5rem;\n}\n.c-form [data-consent] {\n  display: none;\n}\n.c-form [data-consent].is-visible {\n  display: flex;\n}\n.c-form > p {\n  grid-column: 1/-1;\n  color: var(--chipmunk--color--gray-dark);\n}\n.c-form > p input[type=checkbox] {\n  margin-right: 0.25em;\n  vertical-align: -0.05em;\n}\n.c-form.is-loading {\n  opacity: 0.25;\n}\n.c-form--inline {\n  grid-template-columns: repeat(1, 1fr);\n}\n.c-form--narrow {\n  max-width: 36rem;\n}\n.c-form__content {\n  display: contents;\n}\n.c-form__field {\n  position: relative;\n  display: flex;\n  flex-wrap: wrap;\n  align-items: flex-start;\n  gap: calc(var(--chipmunk--typography--line-height) * 0.5 * 1em);\n  grid-column: span 1;\n}\n@media (min-width: 680px) {\n  .c-form__field--separated:not(:first-child) {\n    margin-top: clamp(\n    calc(var(--chipmunk--spacer) * 0.75),\n    1.5 * 1vw,\n    calc(var(--chipmunk--spacer) * 1.5)\n  );\n  }\n}\n.c-form__field--cta {\n  align-items: center;\n  justify-content: space-between;\n  gap: clamp(\n    calc(var(--chipmunk--spacer) * 0.75),\n    1.5 * 1vw,\n    calc(var(--chipmunk--spacer) * 1.5)\n  );\n}\n@media (min-width: 680px) {\n  .c-form__field--cta:not(:first-child) {\n    margin-top: clamp(\n    calc(var(--chipmunk--spacer) * 0.5),\n    1 * 1vw,\n    calc(var(--chipmunk--spacer) * 1)\n  );\n  }\n}\n.c-form__field--center {\n  justify-content: center;\n}\n.c-form__field--wide {\n  grid-column: 1/-1;\n}\n.c-form__input {\n  font-size: 1.25em;\n}\n.c-form__input--default {\n  font-size: 1em;\n}\n.c-form--inline .c-form__input {\n  padding-right: 2em;\n}\n.c-form__button {\n  position: absolute;\n  top: 0;\n  right: 0;\n  padding: 0.5em 0.25em;\n  font-size: 1.25em;\n}\n.c-form__button:hover {\n  opacity: 0.8;\n}\n.c-form__input--default + .c-form__button {\n  font-size: 1em;\n}\n.c-form__label {\n  display: block;\n  width: 100%;\n  font-weight: bold;\n  font-size: 0.9em;\n  cursor: pointer;\n}\n.c-form__label:not(:last-child) {\n  margin-bottom: 0.5em;\n}\n.c-form__label span {\n  margin-left: 0.5em;\n  color: var(--chipmunk--color--gray);\n  font-weight: normal;\n}\n.c-form__select {\n  position: relative;\n  width: 100%;\n}\n.c-form__select select {\n  padding-right: 1.5em;\n  cursor: pointer;\n}\n.c-form__select::after {\n  content: \"\";\n  display: block;\n  position: absolute;\n  top: 50%;\n  right: 0;\n  width: 0.66em;\n  height: 0.33em;\n  background-color: currentColor;\n  -webkit-clip-path: polygon(100% 0%, 0 0%, 50% 100%);\n          clip-path: polygon(100% 0%, 0 0%, 50% 100%);\n  transform: translateY(-50%);\n}\n.c-form__checkbox {\n  display: flex;\n  gap: calc(var(--chipmunk--typography--line-height) * 0.5 * 1em);\n  margin-right: auto;\n  font-size: 0.875em;\n}\n.c-form__checkbox [type=checkbox],\n.c-form__checkbox [type=radio] {\n  position: relative;\n  flex-shrink: 0;\n  height: 1.25em;\n  width: 1.25em;\n  margin-top: 0.2em;\n  border: 0.1em solid currentColor;\n  border-radius: var(--chipmunk--button--border-radius);\n  -webkit-appearance: none;\n          appearance: none;\n  outline: none;\n}\n.c-form__checkbox [type=checkbox]::after,\n.c-form__checkbox [type=radio]::after {\n  content: \"\";\n  display: none;\n  position: absolute;\n  left: 0.4em;\n  top: 0.2em;\n  border: solid #fff;\n  border-width: 0 0.1em 0.1em 0;\n  border-color: currentColor;\n  height: 0.6em;\n  width: 0.3em;\n  transform: rotate(45deg);\n}\n.c-form__checkbox [type=checkbox]:checked::after,\n.c-form__checkbox [type=radio]:checked::after {\n  display: block;\n}\n.c-form__checkbox p {\n  flex: 1;\n  opacity: 0.8;\n}\n.c-form__message {\n  width: 100%;\n  grid-column: span 2;\n}\n.c-form__message:empty {\n  display: none;\n}\n.c-form__message[data-status=success] {\n  color: var(--chipmunk--color--status-success);\n}\n.c-form__message[data-status=error] {\n  color: var(--chipmunk--color--status-error);\n}\n.c-popup .c-form__message {\n  max-width: 60rem;\n  margin-left: auto;\n  margin-right: auto;\n  text-align: center;\n}\n.c-form__info {\n  grid-column: 1/-1;\n  color: var(--chipmunk--color--gray-dark);\n}\n.c-form__info a:hover {\n  color: var(--chipmunk--color--gray-dark);\n}\n.c-form__info--success, .c-form__info--success a {\n  color: var(--chipmunk--color--status-success);\n}\n.c-form__info--warning, .c-form__info--warning a {\n  color: var(--chipmunk--color--status-warning);\n}\n.c-form__info--error, .c-form__info--error a {\n  color: var(--chipmunk--color--status-error);\n}\n.c-form__error {\n  height: 100%;\n  width: 100%;\n  color: var(--chipmunk--color--status-error);\n  font-size: 1.4rem;\n}\n.c-form__error:empty {\n  display: none;\n}\n.c-form__link[href] {\n  display: inline-block;\n  margin: 0.5em 0;\n  color: var(--chipmunk--color--gray);\n  font-size: 0.8125em;\n}\n.c-form__link[href]:hover {\n  color: var(--chipmunk--color--black);\n}\n@media (min-width: 680px) {\n  .c-form__link[href] {\n    margin: 0;\n    font-size: 0.875em;\n  }\n}\n/*\n** Component - Heading\n** ----------------------------------------------------------------------------- */\n.c-heading small {\n  color: var(--chipmunk--color--gray);\n}\n.c-heading__link {\n  display: inline-block;\n  cursor: pointer;\n  opacity: 0.5;\n  transition: opacity var(--chipmunk--transition-duration);\n}\n.c-heading__link:hover, .c-heading__link:focus {\n  opacity: 0.75;\n}\n.c-heading__link.is-active {\n  opacity: 1;\n}\n/*\n** Component - Lead\n** ----------------------------------------------------------------------------- */\n.c-lead {\n  display: flex;\n  flex-direction: column;\n}\n.c-lead--center {\n  align-items: center;\n  text-align: center;\n}\n.c-lead__content:not(:first-child) {\n  margin-top: calc(var(--chipmunk--typography--line-height) * 0.5 * 1em);\n}\n.c-lead__cta:not(:first-child) {\n  margin-top: calc(var(--chipmunk--typography--line-height) * 1.5 * 1em);\n}\n/*\n** Component - Media\n** ----------------------------------------------------------------------------- */\n.c-media {\n  display: block;\n  overflow: hidden;\n}\n.c-media > img,\n.c-media > svg,\n.c-media > video,\n.c-media > iframe {\n  display: block;\n  width: 100%;\n  height: 100%;\n  object-fit: cover;\n}\n/* Aspect variants\n    ========================================================================== */\n.c-media--9-21 {\n  aspect-ratio: 9/21;\n}\n.c-media--9-16 {\n  aspect-ratio: 9/16;\n}\n.c-media--2-3 {\n  aspect-ratio: 2/3;\n}\n.c-media--3-4 {\n  aspect-ratio: 3/4;\n}\n.c-media--1-1 {\n  aspect-ratio: 1/1;\n}\n.c-media--4-3 {\n  aspect-ratio: 4/3;\n}\n.c-media--3-2 {\n  aspect-ratio: 3/2;\n}\n.c-media--16-9 {\n  aspect-ratio: 16/9;\n}\n.c-media--21-9 {\n  aspect-ratio: 21/9;\n}\n/*\n** Component - Members\n** ----------------------------------------------------------------------------- */\n.c-members__form p[class^=login-] {\n  display: flex;\n  flex-direction: column;\n  align-items: flex-start;\n}\n.c-members__form p[class^=login-]:not(:first-child) {\n  margin-top: clamp(\n    calc(var(--chipmunk--spacer) * 1),\n    2 * 1vw,\n    calc(var(--chipmunk--spacer) * 2)\n  );\n}\n.c-members__form p[class^=login-] label {\n  color: var(--chipmunk--color--gray);\n}\n.c-members__form .login-remember {\n  font-size: 1.6rem;\n}\n.c-members__form .login-remember label {\n  cursor: pointer;\n}\n.c-members__form .login-remember input[type=checkbox] {\n  display: inline-block;\n  margin-right: 0.5em;\n}\n.c-members__form .login-remember input[type=checkbox]:focus {\n  outline: none;\n}\n.c-members__form .forgot-password {\n  display: inline-block;\n  margin-top: calc(var(--chipmunk--spacer) * 1);\n  font-size: 1.6rem;\n}\n/*\n** Component - Menu mobile\n** ----------------------------------------------------------------------------- */\n.c-menu-mobile {\n  display: flex;\n  justify-content: space-between;\n  flex-direction: column;\n  overflow-x: hidden;\n}\n@media (min-width: 680px) {\n  .c-menu-mobile {\n    font-size: 1.125em;\n  }\n}\n.c-menu-mobile > .menu-item > a[href] {\n  padding-top: 0.5em;\n  padding-bottom: 0.5em;\n}\n.c-menu-mobile > .menu-item > a[href]:hover {\n  color: var(--chipmunk--color--black);\n}\n.c-menu-mobile > .menu-item.current-menu-item > a, .c-menu-mobile > .menu-item.current-menu-ancestor > a, .c-menu-mobile > .menu-item.current-page-ancestor > a {\n  color: var(--chipmunk--color--black);\n}\n.c-menu-mobile .menu-item {\n  position: relative;\n}\n.c-menu-mobile .menu-item a {\n  display: block;\n  padding-top: 0.25em;\n  padding-bottom: 0.25em;\n}\n.c-menu-mobile .menu-item.menu-item-has-children a {\n  padding-right: calc((var(--chipmunk--typography--line-height) * 1 * 1em) + 1em - 0.75em);\n  padding-right: calc(calc(var(--chipmunk--typography--line-height) * 1 * 1em) + 1em - 0.75em);\n}\n.c-menu-mobile .menu-toggle {\n  position: absolute;\n  right: 0;\n  top: 0;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n  height: calc((var(--chipmunk--typography--line-height) * 1 * 1em) + 1em);\n  height: calc(calc(var(--chipmunk--typography--line-height) * 1 * 1em) + 1em);\n  width: calc((var(--chipmunk--typography--line-height) * 1 * 1em) + 1em);\n  width: calc(calc(var(--chipmunk--typography--line-height) * 1 * 1em) + 1em);\n  margin-right: -0.75em;\n  opacity: 0.5;\n  transition: transform var(--chipmunk--transition-duration);\n}\n.c-menu-mobile .sub-menu {\n  display: none;\n  border-left: 1px solid var(--chipmunk--color--gray-lighter);\n}\n.c-menu-mobile .sub-menu .menu-item {\n  margin-left: 1em;\n}\n.c-menu-mobile .sub-menu .menu-item > a {\n  position: relative;\n  display: block;\n}\n.c-menu-mobile .sub-menu .menu-item > a:hover {\n  opacity: 0.8;\n}\n.c-menu-mobile .sub-menu .menu-toggle {\n  height: calc((var(--chipmunk--typography--line-height) * 1 * 1em) + 0.5em);\n  height: calc(calc(var(--chipmunk--typography--line-height) * 1 * 1em) + 0.5em);\n  width: calc((var(--chipmunk--typography--line-height) * 1 * 1em) + 0.5em);\n  width: calc(calc(var(--chipmunk--typography--line-height) * 1 * 1em) + 0.5em);\n  margin-right: -0.5em;\n}\n.c-menu-mobile .is-expanded > .menu-toggle {\n  transform: rotate(180deg);\n}\n.c-menu-mobile .is-expanded > .sub-menu {\n  display: block;\n}\n/*\n** Component - Menu primary\n** ----------------------------------------------------------------------------- */\n.c-menu-primary .menu {\n  display: flex;\n  flex-direction: row;\n  flex-wrap: wrap;\n  justify-content: flex-start;\n  gap: 0.25em clamp(\n    calc(var(--chipmunk--spacer) * 1),\n    2 * 1vw,\n    calc(var(--chipmunk--spacer) * 2)\n  );\n}\n.c-menu-primary .menu > .menu-item > a {\n  display: block;\n}\n.c-menu-primary .menu > .menu-item > a:hover {\n  opacity: 0.8;\n}\n.c-menu-primary .menu > .menu-item.current-menu-item > a, .c-menu-primary .menu > .menu-item.current-menu-ancestor > a, .c-menu-primary .menu > .menu-item.current-page-ancestor > a {\n  color: var(--chipmunk--color--black);\n}\n.c-menu-primary .menu-item.menu-item-has-children {\n  position: relative;\n}\n.c-menu-primary .menu-item.menu-item-has-children > a::after {\n  content: \"\";\n  display: inline-block;\n  height: 0.35em;\n  width: 0.35em;\n  margin-left: 0.5em;\n  border-style: solid;\n  border-width: 0.075em 0.075em 0 0;\n  vertical-align: 0.25em;\n  opacity: 0.5;\n  transform: rotate(135deg);\n}\n.c-menu-primary .sub-menu {\n  min-width: 17.5rem;\n  max-width: 20rem;\n}\n.c-menu-primary .sub-menu .menu-item > a::after {\n  position: absolute;\n  top: 50%;\n  right: 1em;\n  margin-left: 0;\n  margin-top: -0.25em;\n  vertical-align: baseline;\n  vertical-align: initial;\n  transform: rotate(45deg);\n}\n.c-menu-primary .sub-menu .menu-item.menu-item-has-children > a {\n  padding-right: 2em;\n}\n.c-menu-primary .sub-menu.theme-light {\n  position: absolute;\n  top: calc(100% + 1.5rem);\n  z-index: var(--chipmunk--layer--dropdown);\n  padding-top: 0.5em;\n  padding-bottom: 0.5em;\n  background-color: var(--chipmunk--color--section);\n  border-radius: var(--chipmunk--border-radius);\n  border: 1px solid var(--chipmunk--color--gray-lighter);\n  color: var(--chipmunk--color--black);\n  font-size: 1.4rem;\n  opacity: 0;\n  pointer-events: none;\n  transform: translate3d(0, 0.75rem, 0);\n  transition-property: opacity, transform;\n  transition-duration: var(--chipmunk--transition-duration);\n  left: 0;\n  text-align: left;\n}\n.c-menu-primary .sub-menu.theme-light::before, .c-menu-primary .sub-menu.theme-light::after {\n  content: \"\";\n  display: block;\n  position: absolute;\n  bottom: 100%;\n}\n.c-menu-primary .sub-menu.theme-light::before {\n  height: 1.5rem;\n  left: 0;\n  right: 0;\n}\n.c-menu-primary .sub-menu.theme-light::after {\n  border: 0.75rem solid transparent;\n  border-bottom-color: var(--chipmunk--color--section);\n  filter: drop-shadow(0 -1px 0 var(--chipmunk--color--gray-lighter));\n  left: 1.5rem;\n}\n.c-menu-primary .sub-menu.theme-light ul {\n  top: calc(0.5em - 1.5rem);\n  right: auto;\n  left: calc(100% + 1.5rem);\n}\n.c-menu-primary .sub-menu.theme-light ul::before {\n  height: auto;\n  width: 1.5rem;\n  top: 0;\n  bottom: 0;\n  right: 100%;\n  left: auto;\n}\n.c-menu-primary .sub-menu.theme-light ul::after {\n  border-bottom-color: transparent;\n  bottom: auto;\n  top: 1.5rem;\n  left: -1.5rem;\n  border-right-color: var(--chipmunk--color--section);\n  filter: drop-shadow(-1px 0 0 var(--chipmunk--color--gray-lighter));\n}\n.c-menu-primary .sub-menu.theme-dark {\n  position: absolute;\n  top: calc(100% + 1.5rem);\n  z-index: var(--chipmunk--layer--dropdown);\n  padding-top: 0.5em;\n  padding-bottom: 0.5em;\n  background-color: var(--chipmunk--color--black);\n  border-radius: var(--chipmunk--border-radius);\n  border: 1px solid transparent;\n  color: var(--chipmunk--color--section);\n  font-size: 1.4rem;\n  opacity: 0;\n  pointer-events: none;\n  transform: translate3d(0, 0.75rem, 0);\n  transition-property: opacity, transform;\n  transition-duration: var(--chipmunk--transition-duration);\n  left: 0;\n  text-align: left;\n}\n.c-menu-primary .sub-menu.theme-dark::before, .c-menu-primary .sub-menu.theme-dark::after {\n  content: \"\";\n  display: block;\n  position: absolute;\n  bottom: 100%;\n}\n.c-menu-primary .sub-menu.theme-dark::before {\n  height: 1.5rem;\n  left: 0;\n  right: 0;\n}\n.c-menu-primary .sub-menu.theme-dark::after {\n  border: 0.75rem solid transparent;\n  border-bottom-color: var(--chipmunk--color--black);\n  filter: drop-shadow(0 -1px 0 transparent);\n  left: 1.5rem;\n}\n.c-menu-primary .sub-menu.theme-dark ul {\n  top: calc(0.5em - 1.5rem);\n  right: auto;\n  left: calc(100% + 1.5rem);\n}\n.c-menu-primary .sub-menu.theme-dark ul::before {\n  height: auto;\n  width: 1.5rem;\n  top: 0;\n  bottom: 0;\n  right: 100%;\n  left: auto;\n}\n.c-menu-primary .sub-menu.theme-dark ul::after {\n  border-bottom-color: transparent;\n  bottom: auto;\n  top: 1.5rem;\n  left: -1.5rem;\n  border-right-color: var(--chipmunk--color--black);\n  filter: drop-shadow(-1px 0 0 transparent);\n}\n.c-menu-primary .menu-item-has-children:hover > .sub-menu,\n.c-menu-primary .menu-item-has-children:focus > .sub-menu {\n  opacity: 1;\n  pointer-events: all;\n  transform: translate3d(0, 0, 0);\n}\n/*\n** Component - Menu secondary\n** ----------------------------------------------------------------------------- */\n.c-menu-secondary {\n  display: inline-flex;\n  flex-direction: column;\n  gap: clamp(\n    calc(var(--chipmunk--spacer) * 0.25),\n    0.5 * 1vw,\n    calc(var(--chipmunk--spacer) * 0.5)\n  );\n}\n.c-menu-secondary__item {\n  position: relative;\n  line-height: 1.4;\n}\n.c-menu-secondary__link {\n  display: inline-block;\n  color: var(--chipmunk--color--gray);\n}\n.c-menu-secondary__link[href]:hover, .c-menu-secondary__link[title]:hover, .c-menu-secondary__link[type]:hover {\n  color: var(--chipmunk--color--black);\n}\n/*\n** Component - Menu socials\n** ----------------------------------------------------------------------------- */\n.c-menu-socials {\n  display: flex;\n  align-items: center;\n  flex-wrap: wrap;\n  gap: clamp(\n    calc(var(--chipmunk--spacer) * 0.25),\n    0.5 * 1vw,\n    calc(var(--chipmunk--spacer) * 0.5)\n  );\n}\n.c-menu-socials__title:not(:last-child) {\n  margin-right: clamp(\n    calc(var(--chipmunk--spacer) * 0.25),\n    0.5 * 1vw,\n    calc(var(--chipmunk--spacer) * 0.5)\n  );\n}\n.c-menu-socials__list {\n  display: contents;\n}\n.c-menu-socials__link {\n  display: flex;\n  align-items: center;\n  justify-content: center;\n  height: 2em;\n  width: 2em;\n  border: var(--chipmunk--button--border-width) solid var(--chipmunk--color--gray-light);\n  border-radius: var(--chipmunk--button--border-radius);\n  color: var(--chipmunk--color--gray);\n  font-size: var(--chipmunk--button--font-size);\n  line-height: 1;\n  text-align: center;\n}\n.c-menu-socials__link:hover {\n  border-color: var(--chipmunk--color--primary);\n  color: var(--chipmunk--color--primary);\n  opacity: 0.75;\n  transform: scale(1.05);\n}\n/*\n** Component - Menu toolbox\n** ----------------------------------------------------------------------------- */\n.c-menu-toolbox__dropdown {\n  display: flex;\n  align-items: center;\n  gap: clamp(\n    calc(var(--chipmunk--spacer) * 0.25),\n    0.5 * 1vw,\n    calc(var(--chipmunk--spacer) * 0.5)\n  );\n}\n.is-open .c-menu-toolbox__dropdown .u-icon {\n  transform: scale(-1);\n}\n/*\n** Component - Overlay\n** ----------------------------------------------------------------------------- */\n.c-overlay {\n  position: fixed;\n  top: 0;\n  right: 0;\n  bottom: 0;\n  left: 0;\n  z-index: var(--chipmunk--layer--overlay);\n  display: flex;\n  background-color: var(--chipmunk--color--background);\n  opacity: 0;\n  transform: translate3d(0, 2rem, 0);\n  pointer-events: none;\n  backface-visibility: hidden;\n  transition: opacity, transform;\n  transition-duration: var(--chipmunk--transition-duration);\n}\n.has-nav-open .c-overlay {\n  opacity: 1;\n  transform: translate3d(0, 0, 0);\n  pointer-events: all;\n}\n.c-overlay .container {\n  height: 100%;\n}\n.c-overlay__inner {\n  display: flex;\n  flex-direction: column;\n  justify-content: center;\n  height: calc(100% - 0px);\n  height: calc(100% - var(--header-height, 0px));\n  margin-top: 0;\n  margin-top: var(--header-height, 0);\n  padding-top: clamp(\n    calc(var(--chipmunk--spacer) * 2.5),\n    5 * 1vw,\n    calc(var(--chipmunk--spacer) * 5)\n  );\n  padding-bottom: clamp(\n    calc(var(--chipmunk--spacer) * 2.5),\n    5 * 1vw,\n    calc(var(--chipmunk--spacer) * 5)\n  );\n}\n.c-overlay__menu {\n  flex: 1;\n  display: flex;\n  flex-direction: column;\n  overflow: auto;\n}\n.c-overlay__bottom:not(:first-child) {\n  margin-top: 5vh;\n}\n/*\n** Component - Page foot\n** ----------------------------------------------------------------------------- */\n.c-page-foot a:hover,\n.c-page-foot button:hover {\n  color: var(--chipmunk--color--black);\n}\n.c-page-foot__inner {\n  display: flex;\n  flex-direction: column;\n  align-items: flex-start;\n  justify-content: space-between;\n  gap: var(--chipmunk--layout--column-gutter);\n}\n@media (min-width: 680px) {\n  .c-page-foot__inner {\n    flex-direction: row;\n    text-align: left;\n  }\n}\n.c-page-foot__column {\n  display: flex;\n  flex-direction: column;\n  gap: clamp(\n    calc(var(--chipmunk--spacer) * 0.5),\n    1 * 1vw,\n    calc(var(--chipmunk--spacer) * 1)\n  );\n  width: 100%;\n}\n@media (min-width: 680px) {\n  .c-page-foot__column:first-child {\n    width: 50%;\n    margin-right: auto;\n  }\n}\n@media (min-width: 680px) {\n  .c-page-foot__column:not(:first-child) {\n    width: 33.3333333333%;\n  }\n}\n@media (min-width: 1024px) {\n  .c-page-foot__column:not(:first-child) {\n    width: 16.6666666667%;\n  }\n}\n.c-page-foot__description {\n  color: var(--chipmunk--color--gray);\n}\n.c-page-foot__copy,\n.c-page-foot__credits {\n  color: var(--chipmunk--color--gray);\n  text-align: center;\n}\n@media (min-width: 680px) {\n  .c-page-foot__copy,\n  .c-page-foot__credits {\n    text-align: left;\n  }\n}\n.c-page-foot__credits {\n  display: inline-flex;\n  align-items: center;\n  justify-content: center;\n  gap: calc(var(--chipmunk--spacer) * 0.5);\n  white-space: nowrap;\n}\n.c-page-foot__credits svg {\n  width: auto;\n  height: calc(var(--chipmunk--typography--line-height) * 1 * 1em);\n  fill: currentColor;\n}\n/*\n** Component - Page head\n** ----------------------------------------------------------------------------- */\n.c-page-head {\n  z-index: var(--chipmunk--layer--head);\n  background-color: var(--chipmunk--color--section);\n}\n.c-page-head.is-sticky {\n  top: 0;\n  right: 0;\n  bottom: auto;\n  left: 0;\n}\n.admin-bar .c-page-head.is-sticky {\n  top: 4.6rem;\n}\n@media (min-width: 783px) {\n  .admin-bar .c-page-head.is-sticky {\n    top: 3.2rem;\n  }\n}\n.c-page-head__inner {\n  padding-top: clamp(\n    calc(var(--chipmunk--spacer) * 1),\n    2 * 1vw,\n    calc(var(--chipmunk--spacer) * 2)\n  );\n  padding-bottom: clamp(\n    calc(var(--chipmunk--spacer) * 1),\n    2 * 1vw,\n    calc(var(--chipmunk--spacer) * 2)\n  );\n  position: relative;\n  display: flex;\n  align-items: center;\n  justify-content: space-between;\n  gap: clamp(\n    calc(var(--chipmunk--spacer) * 1),\n    2 * 1vw,\n    calc(var(--chipmunk--spacer) * 2)\n  );\n  min-height: var(--chipmunk--logo-height);\n  transition-property: padding;\n  transition-duration: var(--chipmunk--transition-duration);\n}\n.is-condensed .is-sticky .c-page-head__inner {\n  padding-top: clamp(\n    calc(var(--chipmunk--spacer) * 0.5),\n    1 * 1vw,\n    calc(var(--chipmunk--spacer) * 1)\n  );\n  padding-bottom: clamp(\n    calc(var(--chipmunk--spacer) * 0.5),\n    1 * 1vw,\n    calc(var(--chipmunk--spacer) * 1)\n  );\n}\n.c-page-head__logo {\n  flex-shrink: 0;\n  color: var(--chipmunk--color--primary);\n  font-weight: bold;\n}\n.c-page-head__logo a {\n  display: block;\n}\n.c-page-head__logo a:hover {\n  color: var(--chipmunk--color--black);\n}\n.c-page-head__logo img {\n  display: inline-block;\n  width: auto;\n  height: var(--chipmunk--logo-height);\n  vertical-align: middle;\n}\n.c-page-head__cta {\n  display: flex;\n  align-items: center;\n  justify-content: flex-end;\n  gap: calc(var(--chipmunk--spacer) * 0.75);\n  margin-left: auto;\n}\n.c-page-head__search {\n  position: absolute;\n  top: -100%;\n  right: 0;\n  bottom: 100%;\n  left: 0;\n  z-index: var(--chipmunk--layer--base);\n  display: flex;\n  align-items: center;\n  gap: calc(var(--chipmunk--spacer) * 1);\n  background-color: var(--chipmunk--color--section);\n  opacity: 0;\n  pointer-events: none;\n  transition-property: bottom, top, opacity;\n  transition-duration: calc(var(--chipmunk--transition-duration) * 1.5);\n}\n.has-search-open .c-page-head__search {\n  top: 0;\n  bottom: 0;\n  opacity: 1;\n  pointer-events: all;\n}\n.c-page-head__search .c-form__error {\n  display: none;\n  position: absolute;\n  top: 50%;\n  right: 3em;\n  max-width: 50%;\n  font-size: 1.2rem;\n  line-height: 1.25;\n  text-align: right;\n  pointer-events: none;\n  transform: translateY(-50%);\n}\n@media (min-width: 680px) {\n  .c-page-head__search .c-form__error {\n    display: flex;\n    align-items: center;\n    justify-content: flex-end;\n  }\n}\n.c-page-head__placeholder {\n  height: 0;\n  height: var(--header-height, 0);\n}\n/*\n** Component - Pagination\n** ----------------------------------------------------------------------------- */\n.c-pagination {\n  display: flex;\n  align-items: center;\n  justify-content: space-between;\n  gap: clamp(\n    calc(var(--chipmunk--spacer) * 0.25),\n    0.5 * 1vw,\n    calc(var(--chipmunk--spacer) * 0.5)\n  ) clamp(\n    calc(var(--chipmunk--spacer) * 0.5),\n    1 * 1vw,\n    calc(var(--chipmunk--spacer) * 1)\n  );\n}\n.c-pagination__title {\n  color: var(--chipmunk--color--gray);\n}\n.c-pagination__item:last-child {\n  text-align: right;\n}\n.c-pagination__item a,\n.c-pagination__item span {\n  display: inline-flex;\n  align-items: center;\n  gap: clamp(\n    calc(var(--chipmunk--spacer) * 0.25),\n    0.5 * 1vw,\n    calc(var(--chipmunk--spacer) * 0.5)\n  );\n}\n.c-pagination__item a[href]:hover,\n.c-pagination__item span[href]:hover {\n  color: var(--chipmunk--color--primary);\n}\n.c-pagination__item .u-icon {\n  font-size: 1.25em;\n}\n.c-pagination__item--disabled {\n  visibility: hidden;\n}\n.c-pagination__button {\n  margin-left: auto;\n  margin-right: auto;\n}\n/*\n** Component - Popup\n** ----------------------------------------------------------------------------- */\n.c-popup {\n  position: fixed;\n  top: 0;\n  right: 0;\n  bottom: 0;\n  left: 0;\n  z-index: var(--chipmunk--layer--popup);\n  overflow: hidden;\n  pointer-events: none;\n  transform: translateX(-300%);\n  transition: transform 0s var(--chipmunk--transition-duration);\n}\n.has-popup-open .c-popup {\n  transform: translateX(0);\n  pointer-events: all;\n  transition: none;\n}\n.c-popup__close {\n  position: absolute;\n  top: clamp(\n    calc(var(--chipmunk--spacer) * 1),\n    2 * 1vw,\n    calc(var(--chipmunk--spacer) * 2)\n  );\n  right: clamp(\n    calc(var(--chipmunk--spacer) * 1),\n    2 * 1vw,\n    calc(var(--chipmunk--spacer) * 2)\n  );\n  z-index: var(--chipmunk--layer--utils);\n  color: var(--chipmunk--color--black);\n  line-height: 1;\n  transition-property: opacity, color;\n  transition-duration: calc(var(--chipmunk--transition-duration) * 1.5);\n}\n.c-popup__close:hover {\n  color: var(--chipmunk--color--primary);\n}\n.c-popup__content {\n  position: absolute;\n  top: 50%;\n  left: 50%;\n  width: calc(100% - var(--chipmunk--layout--container-gutter) * 2);\n  max-height: calc(100% - var(--chipmunk--layout--column-gutter) * 2);\n  max-width: min(var(--chipmunk--layout--popup-width), 100vw - var(--chipmunk--layout--container-gutter) * 2);\n  margin-top: 5%;\n  padding: clamp(\n    calc(var(--chipmunk--spacer) * 2),\n    4 * 1vw,\n    calc(var(--chipmunk--spacer) * 4)\n  );\n  background-color: var(--chipmunk--color--section);\n  color: var(--chipmunk--color--black);\n  opacity: 0;\n  overflow: auto;\n  -webkit-overflow-scrolling: touch;\n  transform: translate3d(-50%, -50%, 0);\n  transition: opacity calc(var(--chipmunk--transition-duration) * 1.5), margin calc(var(--chipmunk--transition-duration) * 1.5);\n}\n.has-popup-open .c-popup__content {\n  opacity: 1;\n  margin-top: 0;\n}\n.c-popup__content > img {\n  width: auto;\n  height: auto;\n  max-height: 100%;\n  margin: auto;\n}\n/*\n** Component - Profile\n** ----------------------------------------------------------------------------- */\n.c-profile {\n  display: flex;\n  align-items: flex-start;\n  gap: clamp(\n    calc(var(--chipmunk--spacer) * 0.75),\n    1.5 * 1vw,\n    calc(var(--chipmunk--spacer) * 1.5)\n  );\n}\n.c-profile__avatar {\n  max-width: 10rem;\n}\n@media (min-width: 680px) {\n  .c-profile__avatar {\n    max-width: 12.8rem;\n  }\n}\n.c-profile__avatar img {\n  height: auto;\n}\n.c-profile__content {\n  flex: 1;\n  display: flex;\n  flex-direction: column;\n  gap: clamp(\n    calc(var(--chipmunk--spacer) * 0.75),\n    1.5 * 1vw,\n    calc(var(--chipmunk--spacer) * 1.5)\n  );\n}\n.c-profile__meta {\n  display: flex;\n  flex-wrap: wrap;\n  align-items: center;\n  gap: clamp(\n    calc(var(--chipmunk--spacer) * 1.25),\n    2.5 * 1vw,\n    calc(var(--chipmunk--spacer) * 2.5)\n  );\n}\n.c-profile__stats {\n  color: var(--chipmunk--color--gray);\n}\n/*\n** Component - Promo\n** ----------------------------------------------------------------------------- */\n.c-promo {\n  display: block;\n  width: 100%;\n}\n/*\n** Component - Ratings\n** ----------------------------------------------------------------------------- */\n.c-ratings {\n  display: flex;\n  align-items: center;\n  gap: calc(var(--chipmunk--typography--line-height) * 0.5 * 1em) calc(var(--chipmunk--typography--line-height) * 0.5 * 1em);\n}\n.c-ratings__form {\n  display: flex;\n  flex-direction: row-reverse;\n  margin-top: 0.125em;\n}\n.c-ratings__form > input {\n  position: absolute;\n  left: -9999em;\n  opacity: 0;\n}\n.c-ratings__button {\n  color: var(--chipmunk--color--gray-light);\n  padding: 0.1em;\n  cursor: pointer;\n  transition: color var(--chipmunk--transition-duration);\n}\n:not(.is-active) > .c-ratings__button.is-selected, :not(.is-active) > .c-ratings__button.is-selected ~ .c-ratings__button {\n  color: var(--chipmunk--color--gray);\n}\n.c-ratings__button.is-active, .c-ratings__button.is-active ~ .c-ratings__button {\n  color: var(--chipmunk--color--primary);\n}\n[class]:hover > .c-ratings__button, [class]:hover > .c-ratings__button ~ .c-ratings__button {\n  color: var(--chipmunk--color--gray-light);\n}\n[class]:hover > .c-ratings__button:hover, [class]:hover > .c-ratings__button:hover ~ .c-ratings__button {\n  color: var(--chipmunk--color--primary);\n}\n.c-ratings__button.is-active {\n  animation-name: grow;\n  animation-timing-function: ease-in-out;\n  animation-duration: calc(var(--chipmunk--transition-duration) * 2);\n}\n.c-ratings__result strong {\n  font-weight: bold;\n}\n.c-ratings__result small {\n  margin-left: 0.5em;\n  opacity: 0.5;\n}\n/*\n** Component - Resource\n** ----------------------------------------------------------------------------- */\n.c-resource {\n  display: flex;\n  flex-wrap: wrap;\n  align-items: center;\n  gap: clamp(\n    calc(var(--chipmunk--spacer) * 1.25),\n    2.5 * 2.5vw,\n    calc(var(--chipmunk--spacer) * 2.5)\n  ) calc(var(--chipmunk--spacer) * 2.5);\n}\n.c-resource__content,\n.c-resource__media {\n  flex-basis: 100%;\n}\n@media (min-width: 1024px) {\n  .c-resource__content,\n  .c-resource__media {\n    flex-basis: calc(50% - (var(--chipmunk--spacer) * 1.25));\n    flex-basis: calc(50% - calc(var(--chipmunk--spacer) * 1.25));\n    order: 3;\n  }\n  .c-resource__content--full,\n  .c-resource__media--full {\n    flex-basis: 100%;\n  }\n}\n.c-resource__content {\n  display: flex;\n  flex-direction: column;\n  justify-content: space-between;\n  align-self: stretch;\n  gap: calc(var(--chipmunk--spacer) * 1.25);\n}\n.c-resource__media {\n  display: block;\n}\n.c-resource__media[href]:hover {\n  opacity: 0.9;\n}\n.c-resource__head {\n  display: flex;\n  flex-wrap: wrap;\n  align-items: center;\n  justify-content: space-between;\n  gap: clamp(\n    calc(var(--chipmunk--spacer) * 1.25),\n    2.5 * 1vw,\n    calc(var(--chipmunk--spacer) * 2.5)\n  ) calc(var(--chipmunk--spacer) * 1.25);\n  width: 100%;\n}\n.c-resource__info {\n  display: flex;\n  flex-direction: column;\n  gap: calc(var(--chipmunk--spacer) * 1.25);\n  margin-bottom: auto;\n}\n.c-resource__title a:hover {\n  color: var(--chipmunk--color--gray-dark);\n}\n.c-resource__description p:not(:first-child) {\n  margin-top: calc(var(--chipmunk--typography--line-height) * 0.5 * 1em);\n}\n.c-resource__actions {\n  display: flex;\n  align-items: center;\n  flex-wrap: wrap;\n  gap: clamp(\n    calc(var(--chipmunk--spacer) * 0.25),\n    0.5 * 1vw,\n    calc(var(--chipmunk--spacer) * 0.5)\n  ) clamp(\n    calc(var(--chipmunk--spacer) * 0.5),\n    1 * 1vw,\n    calc(var(--chipmunk--spacer) * 1)\n  );\n}\n@media (min-width: 1024px) {\n  .c-resource__actions {\n    justify-content: flex-start;\n  }\n}\n.c-resource__actions:empty,\n.c-resource__extras:empty {\n  display: none;\n}\n/*\n** Component - Stats\n** ----------------------------------------------------------------------------- */\n.c-stats {\n  display: flex;\n  align-items: center;\n  flex-wrap: wrap;\n  gap: calc(var(--chipmunk--spacer) * 0.5) calc(var(--chipmunk--spacer) * 1);\n  font-size: 0.8125em;\n}\n.c-stats__item,\n.c-stats__button > span {\n  display: flex;\n  align-items: center;\n  flex-wrap: wrap;\n  gap: 0.5em;\n}\n.c-stats__item {\n  color: var(--chipmunk--color--gray);\n}\n.c-stats__item a:hover {\n  color: var(--chipmunk--color--gray-dark);\n}\n.c-stats__item .u-icon {\n  font-size: 1.25em;\n}\n.c-stats__item > span:not([class]) {\n  display: contents;\n}\n.c-stats__item > a:not([class]):not(:last-child)::after,\n.c-stats__item > span:not([class]):not(:last-child)::after {\n  content: \",\";\n}\n.c-entry__hero .c-stats__item, .c-tile--tile .c-stats__item {\n  color: inherit;\n  opacity: 0.75;\n}\n.c-entry__hero .c-stats__item a:hover, .c-tile--tile .c-stats__item a:hover {\n  color: inherit;\n  opacity: 0.8;\n}\n.c-stats__button {\n  padding-left: 0.75em;\n  padding-right: 0.75em;\n  border-color: var(--chipmunk--color--gray);\n  font-size: inherit;\n  backface-visibility: hidden;\n}\n.c-stats__button > span {\n  transition: opacity var(--chipmunk--transition-duration);\n}\n.c-stats__button.is-loading {\n  position: relative;\n}\n.c-stats__button.is-loading > span {\n  opacity: 0;\n}\n.c-stats__button.is-loading::after {\n  position: absolute;\n  content: \"\";\n  top: 50%;\n  left: 50%;\n  margin-top: -0.5em;\n  margin-left: -0.5em;\n  width: 1em;\n  height: 1em;\n  border-radius: 50%;\n  border-color: currentColor transparent transparent;\n  border-style: solid;\n  border-width: 1px;\n  box-shadow: 0 0 0 1px transparent;\n  animation: button-spin 0.6s linear;\n  animation-iteration-count: infinite;\n}\n.c-stats__button:not(.is-active):hover {\n  color: var(--chipmunk--color--primary);\n  border-color: var(--chipmunk--color--primary);\n}\n.c-stats__button.is-active {\n  background-color: var(--chipmunk--color--primary);\n  border-color: transparent;\n  color: var(--chipmunk--color--white);\n}\n.c-stats__button .u-icon {\n  display: inline-block;\n  backface-visibility: hidden;\n}\n/*\n** Component - Tabs\n** ----------------------------------------------------------------------------- */\n.c-tabs {\n  display: flex;\n  flex-direction: column;\n  gap: var(--chipmunk--layout--column-gutter);\n  width: 100%;\n}\n.c-tabs__title {\n  display: flex;\n  align-items: center;\n  flex-wrap: wrap;\n  gap: clamp(\n    calc(var(--chipmunk--spacer) * 0.25),\n    0.5 * 1vw,\n    calc(var(--chipmunk--spacer) * 0.5)\n  ) clamp(\n    calc(var(--chipmunk--spacer) * 0.75),\n    1.5 * 1vw,\n    calc(var(--chipmunk--spacer) * 1.5)\n  );\n  padding-right: 3.5em;\n}\n.c-tabs__item {\n  display: none;\n}\n.c-tabs__item.is-active {\n  display: block;\n}\n/*\n** Component - Tile\n** ----------------------------------------------------------------------------- */\n.c-tile {\n  display: flex;\n  position: relative;\n  transition: opacity var(--chipmunk--transition-duration);\n}\n.c-tile--wide {\n  grid-column: 1/-1;\n}\n.flickity-enabled .c-tile {\n  width: 100%;\n  padding: calc(var(--chipmunk--layout--column-gutter) * 0.5);\n}\n@media (min-width: 680px) {\n  .flickity-enabled .c-tile:not(.c-tile--wide) {\n    width: 50%;\n  }\n}\n@media (min-width: 1024px) {\n  .flickity-enabled .c-tile:not(.c-tile--wide) {\n    width: 33.333%;\n  }\n}\n.flickity-resize .c-tile {\n  min-height: 100%;\n}\n.c-tile__list {\n  display: grid;\n  grid-gap: var(--chipmunk--layout--column-gutter);\n  gap: var(--chipmunk--layout--column-gutter);\n}\n@media (min-width: 0) {\n  .c-tile__list {\n    grid-template-columns: repeat(1, 1fr);\n  }\n}\n@media (min-width: 680px) {\n  .c-tile__list {\n    grid-template-columns: repeat(2, 1fr);\n  }\n}\n@media (min-width: 1024px) {\n  .c-tile__list {\n    grid-template-columns: repeat(3, 1fr);\n  }\n}\n.c-tile__list--separated {\n  row-gap: clamp(\n    calc(var(--chipmunk--spacer) * 2.5),\n    5 * 1vw,\n    calc(var(--chipmunk--spacer) * 5)\n  );\n}\n.c-tile__list--start {\n  align-items: flex-start;\n}\n.c-tile__list--center {\n  align-items: center;\n}\n.c-tile__list--end {\n  align-items: flex-end;\n}\n.c-tile__list.flickity-enabled {\n  display: block;\n  width: calc(100% + var(--chipmunk--layout--column-gutter));\n  margin: calc(var(--chipmunk--layout--column-gutter) * -0.5);\n}\n.c-tile__list .flickity-viewport {\n  transition: height 0s;\n}\n.c-tile__inner {\n  position: relative;\n  display: flex;\n  flex-direction: column;\n  gap: calc(var(--chipmunk--spacer) * 1);\n  width: 100%;\n  overflow: hidden;\n}\n.c-tile__inner[href]:hover {\n  opacity: 0.9;\n}\n.c-tile--card .c-tile__inner, .c-tile--wide .c-tile__inner {\n  background-color: var(--chipmunk--color--section);\n  border-radius: var(--chipmunk--border-radius);\n  box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);\n}\n@media (min-width: 680px) {\n  .c-tile--wide .c-tile__inner {\n    gap: calc(var(--chipmunk--spacer) * 1.5);\n    flex-direction: row;\n  }\n}\n.c-tile__image {\n  position: relative;\n  background-color: var(--chipmunk--color--gray-light);\n  transition: opacity var(--chipmunk--transition-duration);\n}\n.c-tile__image:not([class*=c-media--]) {\n  aspect-ratio: 4/3;\n}\n.c-tile__image > img,\n.c-tile__image > svg,\n.c-tile__image > video,\n.c-tile__image > iframe {\n  transition: transform var(--chipmunk--transition-duration) ease-in-out 0.05s;\n}\n.c-tile__image > img:not(:first-child),\n.c-tile__image > svg:not(:first-child),\n.c-tile__image > video:not(:first-child),\n.c-tile__image > iframe:not(:first-child) {\n  position: absolute;\n  top: 0;\n  right: 0;\n  bottom: 0;\n  left: 0;\n}\n.c-tile__image > img:nth-of-type(2),\n.c-tile__image > svg:nth-of-type(2),\n.c-tile__image > video:nth-of-type(2),\n.c-tile__image > iframe:nth-of-type(2) {\n  transform: translateX(25%);\n}\n[href]:hover .c-tile__image > img:nth-of-type(2),\n[href]:hover .c-tile__image > svg:nth-of-type(2),\n[href]:hover .c-tile__image > video:nth-of-type(2),\n[href]:hover .c-tile__image > iframe:nth-of-type(2) {\n  transform: translateX(33.3%);\n}\n.c-tile__image > img:nth-of-type(3),\n.c-tile__image > svg:nth-of-type(3),\n.c-tile__image > video:nth-of-type(3),\n.c-tile__image > iframe:nth-of-type(3) {\n  transform: translateX(50%);\n}\n[href]:hover .c-tile__image > img:nth-of-type(3),\n[href]:hover .c-tile__image > svg:nth-of-type(3),\n[href]:hover .c-tile__image > video:nth-of-type(3),\n[href]:hover .c-tile__image > iframe:nth-of-type(3) {\n  transform: translateX(66.6%);\n}\n.c-tile__image[href]:hover {\n  opacity: 0.9;\n}\n.c-tile--card .c-tile__image:not(:empty) {\n  margin: var(--chipmunk--layout--tile-padding);\n  margin-bottom: 0;\n}\n.c-tile--wide .c-tile__image:not(:empty) {\n  margin: var(--chipmunk--layout--tile-padding);\n  margin-bottom: 0;\n}\n@media (min-width: 680px) {\n  .c-tile--wide .c-tile__image:not(:empty) {\n    width: 40%;\n    margin-bottom: var(--chipmunk--layout--tile-padding);\n    margin-right: 0;\n  }\n}\n@media (min-width: 1024px) {\n  .c-tile--wide .c-tile__image:not(:empty) {\n    width: 25%;\n  }\n}\n.c-tile__image::after {\n  content: \"\";\n  position: absolute;\n  top: 0;\n  right: 0;\n  bottom: 0;\n  left: 0;\n  background-color: var(--chipmunk--color--primary);\n  opacity: 0.05;\n}\n.c-tile__content {\n  display: flex;\n  flex-direction: column;\n  justify-content: space-between;\n  gap: calc(var(--chipmunk--spacer) * 1);\n  flex: 1;\n  padding: calc(var(--chipmunk--spacer) * 1);\n  color: var(--chipmunk--color--black);\n}\n@media (min-width: 680px) {\n  .c-tile__content {\n    padding: calc(var(--chipmunk--spacer) * 1.5);\n  }\n}\n.c-tile__content--dimmed {\n  background-color: rgba(0, 0, 0, 0.75);\n  color: var(--chipmunk--color--white);\n}\n.c-tile__content--primary {\n  background-color: var(--chipmunk--color--primary);\n  color: var(--chipmunk--color--white);\n}\n.c-tile--tile .c-tile__content {\n  position: absolute;\n  top: 0;\n  right: 0;\n  bottom: 0;\n  left: 0;\n  z-index: var(--chipmunk--layer--base);\n}\n@media (min-width: 680px) {\n  .c-tile--card .c-tile__content:not(:first-child) {\n    padding: calc(var(--chipmunk--spacer) * 1);\n    padding-top: 0;\n  }\n}\n.c-tile--blank .c-tile__content {\n  padding: 0;\n}\n.c-tile--wide .c-tile__content:not(:first-child) {\n  padding-top: 0;\n}\n@media (min-width: 680px) {\n  .c-tile--wide .c-tile__content:not(:first-child) {\n    padding: calc(var(--chipmunk--spacer) * 1.5);\n    padding-left: 0;\n  }\n}\n.c-tile__info {\n  display: flex;\n  flex-direction: column;\n  align-items: flex-start;\n  flex: 1;\n}\n.c-tile__head {\n  display: flex;\n  flex-wrap: wrap;\n  justify-content: space-between;\n  gap: calc(var(--chipmunk--spacer) * 0.75);\n  width: 100%;\n}\n.c-tile__title {\n  flex: 1;\n  color: inherit;\n}\n.c-tile__title a {\n  display: inline-block;\n}\n.c-tile__title a:hover {\n  opacity: 0.8;\n}\n.c-tile--tile .c-tile__title {\n  display: -webkit-box; /* stylelint-disable-line value-no-vendor-prefix */\n  -webkit-box-orient: vertical; /* stylelint-disable-line property-no-vendor-prefix */\n  -webkit-line-clamp: 2;\n  overflow: hidden;\n}\n.c-tile__icon {\n  margin: -0.15em;\n  padding: 0.15em;\n  opacity: 0.66;\n  cursor: pointer;\n  vertical-align: middle;\n  transition: opacity var(--chipmunk--transition-duration);\n  transform: translateY(0.5em);\n}\n.c-tile__icon .u-icon {\n  display: block;\n}\n.c-tile__icon:hover {\n  opacity: 1;\n}\n.c-tile__copy {\n  display: -webkit-box; /* stylelint-disable-line value-no-vendor-prefix */\n  -webkit-box-orient: vertical; /* stylelint-disable-line property-no-vendor-prefix */\n  -webkit-line-clamp: 2;\n  overflow: hidden;\n  width: 100%;\n  font-size: 0.875em;\n  opacity: 0.85;\n}\n.c-tile--card .c-tile__copy {\n  opacity: 1;\n}\n@media (min-width: 680px) {\n  .c-tile--wide .c-tile__copy {\n    display: -webkit-box; /* stylelint-disable-line value-no-vendor-prefix */\n    -webkit-box-orient: vertical; /* stylelint-disable-line property-no-vendor-prefix */\n    -webkit-line-clamp: 3;\n    overflow: hidden;\n  }\n}\n@media (min-width: 1024px) {\n  .c-tile--wide .c-tile__copy {\n    margin-right: 10%;\n  }\n}\n.c-tile__stats {\n  margin-top: auto;\n}\n@media (min-width: 680px) {\n  .c-tile--wide .c-tile__stats .c-stats__item--upvotes {\n    order: 99;\n    margin-left: auto;\n  }\n}\n.c-tile__button {\n  align-self: start;\n}\n[href]:hover .c-tile__button, .c-tile__button[href]:hover {\n  background-color: var(--chipmunk--color--primary);\n  border-color: transparent;\n  color: var(--chipmunk--color--white);\n}\n.c-tile__status {\n  position: absolute;\n  bottom: 2rem;\n  left: 2rem;\n  z-index: var(--chipmunk--layer--base);\n  padding: 0.5em 0.75em;\n  background-color: var(--chipmunk--color--gray);\n  border-radius: var(--chipmunk--button--border-radius);\n  color: var(--chipmunk--color--white);\n  font-size: 0.75em;\n  line-height: 1;\n}\n.c-tile__status--publish {\n  background-color: var(--chipmunk--color--status-success);\n}\n.c-tile__status--trash {\n  background-color: var(--chipmunk--color--status-error);\n}\n/*\n** Component - Toolbox\n** ----------------------------------------------------------------------------- */\n.c-toolbox {\n  display: flex;\n  flex-direction: column;\n}\n@media (min-width: 680px) {\n  .c-toolbox {\n    align-items: center;\n    justify-content: space-between;\n    flex-direction: row;\n  }\n}\n.c-toolbox__cta {\n  display: flex;\n  align-items: center;\n  justify-content: center;\n  gap: clamp(\n    calc(var(--chipmunk--spacer) * 0.75),\n    1.5 * 1vw,\n    calc(var(--chipmunk--spacer) * 1.5)\n  );\n  margin-left: auto;\n}\n@media (min-width: 680px) {\n  .c-toolbox__cta {\n    justify-content: flex-end;\n  }\n}\n/*\n** Blocks / Buttons\n** ----------------------------------------------------------------------------- */\n.wp-block-buttons .wp-block-button {\n  display: inline-block;\n}\n.wp-block-buttons .wp-block-button:not(:first-child) {\n  margin-top: 0;\n}\n/*\n** Blocks / Code\n** ----------------------------------------------------------------------------- */\n.wp-block-code {\n  padding: 1em 1.25em;\n  background-color: var(--chipmunk--color--section);\n  border: 1px solid var(--chipmunk--color--gray-light);\n  border-radius: var(--chipmunk--border-radius);\n}\n/*\n** Blocks / Columns\n** ----------------------------------------------------------------------------- */\n.wp-block-columns {\n  row-gap: calc(var(--column-gutter) * 2);\n  column-gap: var(--column-gutter);\n}\n.wp-block-column[class]:not(:first-child) {\n  margin: 0;\n}\n/*\n** Blocks / Common\n** ----------------------------------------------------------------------------- */\n.wp-block-button[class],\n.wp-block-audio[class],\n.wp-block-archives[class],\n.wp-block-categories[class],\n.wp-block-latest-posts[class] {\n  margin-top: 0;\n  margin-bottom: 0;\n}\n.wp-block-button[class]:not(:first-child),\n.wp-block-audio[class]:not(:first-child),\n.wp-block-archives[class]:not(:first-child),\n.wp-block-categories[class]:not(:first-child),\n.wp-block-latest-posts[class]:not(:first-child) {\n  margin-top: calc(var(--chipmunk--typography--line-height) * 1 * 1em);\n}\n.wp-block-buttons[class],\n.wp-block-code[class],\n.wp-block-table[class],\n.wp-block-verse[class],\n.wp-block-preformatted[class] {\n  margin-top: 0;\n  margin-bottom: 0;\n}\n.wp-block-buttons[class]:not(:first-child),\n.wp-block-code[class]:not(:first-child),\n.wp-block-table[class]:not(:first-child),\n.wp-block-verse[class]:not(:first-child),\n.wp-block-preformatted[class]:not(:first-child) {\n  margin-top: clamp(\n    calc(var(--chipmunk--spacer) * 1.25),\n    2.5 * 1vw,\n    calc(var(--chipmunk--spacer) * 2.5)\n  );\n}\n.wp-block-image[class],\n.wp-block-cover[class],\n.wp-block-cover-image[class],\n.wp-block-gallery[class],\n.wp-block-embed[class],\n.wp-block-quote[class],\n.wp-block-pullquote[class],\n.wp-block-columns[class],\n.wp-block-text-columns[class] {\n  margin-top: 0;\n  margin-bottom: 0;\n}\n.wp-block-image[class]:not(:first-child),\n.wp-block-cover[class]:not(:first-child),\n.wp-block-cover-image[class]:not(:first-child),\n.wp-block-gallery[class]:not(:first-child),\n.wp-block-embed[class]:not(:first-child),\n.wp-block-quote[class]:not(:first-child),\n.wp-block-pullquote[class]:not(:first-child),\n.wp-block-columns[class]:not(:first-child),\n.wp-block-text-columns[class]:not(:first-child) {\n  margin-top: clamp(\n    calc(var(--chipmunk--spacer) * 1.25),\n    2.5 * 1vw,\n    calc(var(--chipmunk--spacer) * 2.5)\n  );\n}\n.wp-block-image[class]:not(:last-child),\n.wp-block-cover[class]:not(:last-child),\n.wp-block-cover-image[class]:not(:last-child),\n.wp-block-gallery[class]:not(:last-child),\n.wp-block-embed[class]:not(:last-child),\n.wp-block-quote[class]:not(:last-child),\n.wp-block-pullquote[class]:not(:last-child),\n.wp-block-columns[class]:not(:last-child),\n.wp-block-text-columns[class]:not(:last-child) {\n  margin-bottom: clamp(\n    calc(var(--chipmunk--spacer) * 1.25),\n    2.5 * 1vw,\n    calc(var(--chipmunk--spacer) * 2.5)\n  );\n}\n.wp-block-image[class].alignwide:not(:first-child), .wp-block-image[class].alignfull:not(:first-child),\n.wp-block-cover[class].alignwide:not(:first-child),\n.wp-block-cover[class].alignfull:not(:first-child),\n.wp-block-cover-image[class].alignwide:not(:first-child),\n.wp-block-cover-image[class].alignfull:not(:first-child),\n.wp-block-gallery[class].alignwide:not(:first-child),\n.wp-block-gallery[class].alignfull:not(:first-child),\n.wp-block-embed[class].alignwide:not(:first-child),\n.wp-block-embed[class].alignfull:not(:first-child),\n.wp-block-quote[class].alignwide:not(:first-child),\n.wp-block-quote[class].alignfull:not(:first-child),\n.wp-block-pullquote[class].alignwide:not(:first-child),\n.wp-block-pullquote[class].alignfull:not(:first-child),\n.wp-block-columns[class].alignwide:not(:first-child),\n.wp-block-columns[class].alignfull:not(:first-child),\n.wp-block-text-columns[class].alignwide:not(:first-child),\n.wp-block-text-columns[class].alignfull:not(:first-child) {\n  margin-top: clamp(\n    calc(var(--chipmunk--spacer) * 2.5),\n    5 * 1vw,\n    calc(var(--chipmunk--spacer) * 5)\n  );\n}\n.wp-block-image[class].alignwide:not(:last-child), .wp-block-image[class].alignfull:not(:last-child),\n.wp-block-cover[class].alignwide:not(:last-child),\n.wp-block-cover[class].alignfull:not(:last-child),\n.wp-block-cover-image[class].alignwide:not(:last-child),\n.wp-block-cover-image[class].alignfull:not(:last-child),\n.wp-block-gallery[class].alignwide:not(:last-child),\n.wp-block-gallery[class].alignfull:not(:last-child),\n.wp-block-embed[class].alignwide:not(:last-child),\n.wp-block-embed[class].alignfull:not(:last-child),\n.wp-block-quote[class].alignwide:not(:last-child),\n.wp-block-quote[class].alignfull:not(:last-child),\n.wp-block-pullquote[class].alignwide:not(:last-child),\n.wp-block-pullquote[class].alignfull:not(:last-child),\n.wp-block-columns[class].alignwide:not(:last-child),\n.wp-block-columns[class].alignfull:not(:last-child),\n.wp-block-text-columns[class].alignwide:not(:last-child),\n.wp-block-text-columns[class].alignfull:not(:last-child) {\n  margin-bottom: clamp(\n    calc(var(--chipmunk--spacer) * 2.5),\n    5 * 1vw,\n    calc(var(--chipmunk--spacer) * 5)\n  );\n}\n.wp-block-separator[class] {\n  margin-top: 0;\n  margin-bottom: 0;\n}\n.wp-block-separator[class]:not(:first-child) {\n  margin-top: clamp(\n    calc(var(--chipmunk--spacer) * 2.5),\n    5 * 1vw,\n    calc(var(--chipmunk--spacer) * 5)\n  );\n}\n.wp-block-separator[class]:not(:last-child) {\n  margin-bottom: clamp(\n    calc(var(--chipmunk--spacer) * 2.5),\n    5 * 1vw,\n    calc(var(--chipmunk--spacer) * 5)\n  );\n}\n@media (min-width: 680px) {\n  .alignleft {\n    float: left;\n    max-width: 66.6%;\n    margin-right: calc(var(--chipmunk--typography--line-height) * 1 * 1em);\n  }\n}\n@media (min-width: 1024px) {\n  .alignleft {\n    margin-left: calc((12 - var(--chipmunk--layout--content-width)) / 2 / var(--chipmunk--layout--content-width) * 100% * -1);\n  }\n}\n@media (min-width: 680px) {\n  .alignright {\n    float: right;\n    max-width: 66.6%;\n    margin-left: calc(var(--chipmunk--typography--line-height) * 1 * 1em);\n  }\n}\n@media (min-width: 1024px) {\n  .alignright {\n    margin-right: calc((12 - var(--chipmunk--layout--content-width)) / 2 / var(--chipmunk--layout--content-width) * 100% * -1);\n  }\n}\n@media (max-width: 1023.98px) {\n  .alignwide.wp-block-image, .alignwide.wp-block-cover, .alignwide.wp-block-cover-image, .alignwide.wp-block-gallery, .alignwide.wp-block-embed, .alignwide.wp-block-columns {\n    width: 100vw;\n    margin-left: 50%;\n    transform: translateX(-50%);\n  }\n}\n@media (min-width: 1024px) {\n  .alignwide {\n    width: calc(100vw - (var(--chipmunk--layout--container-gutter) * 2));\n    width: calc(100vw - calc(var(--chipmunk--layout--container-gutter) * 2));\n    margin-left: 50%;\n    transform: translateX(-50%);\n    max-width: var(--chipmunk--layout--container-width);\n  }\n}\n@media (max-width: 1023.98px) {\n  .alignfull.wp-block-image, .alignfull.wp-block-cover, .alignfull.wp-block-cover-image, .alignfull.wp-block-gallery, .alignfull.wp-block-embed, .alignfull.wp-block-columns {\n    width: 100vw;\n    margin-left: 50%;\n    transform: translateX(-50%);\n  }\n}\n@media (min-width: 1024px) {\n  .alignfull {\n    width: calc(100vw - (var(--chipmunk--layout--container-gutter) * 2));\n    width: calc(100vw - calc(var(--chipmunk--layout--container-gutter) * 2));\n    margin-left: 50%;\n    transform: translateX(-50%);\n    max-width: 256rem;\n  }\n}\n@media (max-width: 1023.98px) {\n  .alignfull.wp-block-separator.wp-block-image, .alignfull.wp-block-separator.wp-block-cover, .alignfull.wp-block-separator.wp-block-cover-image, .alignfull.wp-block-separator.wp-block-gallery, .alignfull.wp-block-separator.wp-block-embed, .alignfull.wp-block-separator.wp-block-columns {\n    width: 100vw;\n    margin-left: 50%;\n    transform: translateX(-50%);\n  }\n}\n@media (min-width: 1024px) {\n  .alignfull.wp-block-separator {\n    width: calc(100vw );\n    margin-left: 50%;\n    transform: translateX(-50%);\n    max-width: 256rem;\n  }\n}\n/*\n** Blocks / Embeds\n** ----------------------------------------------------------------------------- */\n.wp-block-video,\n.wp-block-embed {\n  position: relative;\n  aspect-ratio: 16/9;\n}\n.wp-block-video .wp-block-embed__wrapper,\n.wp-block-embed .wp-block-embed__wrapper {\n  display: contents;\n}\n.wp-block-video video,\n.wp-block-video iframe,\n.wp-block-embed video,\n.wp-block-embed iframe {\n  position: absolute;\n  top: 0;\n  right: 0;\n  bottom: 0;\n  left: 0;\n  width: 100%;\n  height: 100%;\n}\n/*\n** Blocks / Gallery\n** ----------------------------------------------------------------------------- */\n.wp-block-gallery {\n  --gallery-block--gutter-size: var(--chipmunk--layout--column-gutter);\n}\n/*\n** Blocks / Pullquote\n** ----------------------------------------------------------------------------- */\n.wp-block-pullquote {\n  padding-top: clamp(\n    calc(var(--chipmunk--spacer) * 1),\n    2 * 1vw,\n    calc(var(--chipmunk--spacer) * 2)\n  );\n  padding-bottom: clamp(\n    calc(var(--chipmunk--spacer) * 1),\n    2 * 1vw,\n    calc(var(--chipmunk--spacer) * 2)\n  );\n  border-top: 4px solid var(--chipmunk--color--gray);\n  border-bottom: 4px solid var(--chipmunk--color--gray);\n  text-align: center;\n}\n.wp-block-pullquote p {\n  font-size: 1.25em;\n}\n/*\n** Blocks / Quote\n** ----------------------------------------------------------------------------- */\n.wp-block-quote {\n  padding-left: calc(var(--chipmunk--typography--line-height) * 1 * 1em);\n  border-left: 0.1em solid var(--chipmunk--color--primary);\n}\n.wp-block-quote.is-large p {\n  font-size: 1.25em;\n  font-style: inherit;\n  line-height: inherit;\n}\n/*\n** Blocks / Separator\n** ----------------------------------------------------------------------------- */\n.wp-block-separator {\n  color: var(--chipmunk--color--gray-light);\n  border-top: 0;\n}\n.wp-block-separator:not(.is-style-wide):not(.is-style-dots) {\n  width: 10rem;\n  margin-left: auto;\n  margin-right: auto;\n}\n.wp-block-separator.is-style-wide {\n  border-bottom-width: 1px;\n}\n/*\n** Utils - Avatar\n** ----------------------------------------------------------------------------- */\n.u-avatar {\n  display: flex;\n  align-items: center;\n  justify-content: center;\n  height: 2em;\n  width: 2em;\n  background-color: var(--chipmunk--color--background);\n  border-radius: 50%;\n  color: var(--chipmunk--color--black);\n  font-size: 1em;\n}\n.u-avatar img {\n  width: 100%;\n  height: 100%;\n  border-radius: 50%;\n}\n/*\n** Utils - Responsive display\n** ----------------------------------------------------------------------------- */\n.u-visible-sm-inline {\n  display: none !important;\n}\n.u-visible-sm-inline-block {\n  display: none !important;\n}\n.u-visible-sm-block {\n  display: none !important;\n}\n.u-visible-sm-flex {\n  display: none !important;\n}\n@media (min-width: 0) {\n  .u-visible-sm-inline {\n    display: inline !important;\n  }\n  .u-visible-sm-inline-block {\n    display: inline-block !important;\n  }\n  .u-visible-sm-block {\n    display: block !important;\n  }\n  .u-visible-sm-flex {\n    display: flex !important;\n  }\n  .u-hidden-sm {\n    display: none !important;\n  }\n}\n.u-visible-md-inline {\n  display: none !important;\n}\n.u-visible-md-inline-block {\n  display: none !important;\n}\n.u-visible-md-block {\n  display: none !important;\n}\n.u-visible-md-flex {\n  display: none !important;\n}\n@media (min-width: 680px) {\n  .u-visible-md-inline {\n    display: inline !important;\n  }\n  .u-visible-md-inline-block {\n    display: inline-block !important;\n  }\n  .u-visible-md-block {\n    display: block !important;\n  }\n  .u-visible-md-flex {\n    display: flex !important;\n  }\n  .u-hidden-md {\n    display: none !important;\n  }\n}\n.u-visible-lg-inline {\n  display: none !important;\n}\n.u-visible-lg-inline-block {\n  display: none !important;\n}\n.u-visible-lg-block {\n  display: none !important;\n}\n.u-visible-lg-flex {\n  display: none !important;\n}\n@media (min-width: 1024px) {\n  .u-visible-lg-inline {\n    display: inline !important;\n  }\n  .u-visible-lg-inline-block {\n    display: inline-block !important;\n  }\n  .u-visible-lg-block {\n    display: block !important;\n  }\n  .u-visible-lg-flex {\n    display: flex !important;\n  }\n  .u-hidden-lg {\n    display: none !important;\n  }\n}\n/*\n** Utils - Dropdown\n** ----------------------------------------------------------------------------- */\n.u-dropdown--light {\n  position: absolute;\n  top: calc(100% + 1.5rem);\n  z-index: var(--chipmunk--layer--dropdown);\n  padding-top: 0.5em;\n  padding-bottom: 0.5em;\n  background-color: var(--chipmunk--color--section);\n  border-radius: var(--chipmunk--border-radius);\n  border: 1px solid var(--chipmunk--color--gray-lighter);\n  color: var(--chipmunk--color--black);\n  font-size: 1.4rem;\n  opacity: 0;\n  pointer-events: none;\n  transform: translate3d(0, 0.75rem, 0);\n  transition-property: opacity, transform;\n  transition-duration: var(--chipmunk--transition-duration);\n  right: 0;\n  text-align: right;\n}\n.u-dropdown--light::before, .u-dropdown--light::after {\n  content: \"\";\n  display: block;\n  position: absolute;\n  bottom: 100%;\n}\n.u-dropdown--light::before {\n  height: 1.5rem;\n  left: 0;\n  right: 0;\n}\n.u-dropdown--light::after {\n  border: 0.75rem solid transparent;\n  border-bottom-color: var(--chipmunk--color--section);\n  filter: drop-shadow(0 -1px 0 var(--chipmunk--color--gray-lighter));\n  right: 2.25rem;\n}\n.u-dropdown--light ul {\n  top: calc(0.5em - 2.25rem);\n  right: calc(100% + 1.5rem);\n  left: auto;\n}\n.u-dropdown--light ul::before {\n  height: auto;\n  width: 1.5rem;\n  top: 0;\n  bottom: 0;\n  right: auto;\n  left: 100%;\n}\n.u-dropdown--light ul::after {\n  border-bottom-color: transparent;\n  bottom: auto;\n  top: 2.25rem;\n  right: -1.5rem;\n  border-left-color: var(--chipmunk--color--section);\n  filter: drop-shadow(1px 0 0 var(--chipmunk--color--gray-lighter));\n}\n.u-dropdown--dark {\n  position: absolute;\n  top: calc(100% + 1.5rem);\n  z-index: var(--chipmunk--layer--dropdown);\n  padding-top: 0.5em;\n  padding-bottom: 0.5em;\n  background-color: var(--chipmunk--color--black);\n  border-radius: var(--chipmunk--border-radius);\n  border: 1px solid transparent;\n  color: var(--chipmunk--color--section);\n  font-size: 1.4rem;\n  opacity: 0;\n  pointer-events: none;\n  transform: translate3d(0, 0.75rem, 0);\n  transition-property: opacity, transform;\n  transition-duration: var(--chipmunk--transition-duration);\n  right: 0;\n  text-align: right;\n}\n.u-dropdown--dark::before, .u-dropdown--dark::after {\n  content: \"\";\n  display: block;\n  position: absolute;\n  bottom: 100%;\n}\n.u-dropdown--dark::before {\n  height: 1.5rem;\n  left: 0;\n  right: 0;\n}\n.u-dropdown--dark::after {\n  border: 0.75rem solid transparent;\n  border-bottom-color: var(--chipmunk--color--black);\n  filter: drop-shadow(0 -1px 0 transparent);\n  right: 2.25rem;\n}\n.u-dropdown--dark ul {\n  top: calc(0.5em - 2.25rem);\n  right: calc(100% + 1.5rem);\n  left: auto;\n}\n.u-dropdown--dark ul::before {\n  height: auto;\n  width: 1.5rem;\n  top: 0;\n  bottom: 0;\n  right: auto;\n  left: 100%;\n}\n.u-dropdown--dark ul::after {\n  border-bottom-color: transparent;\n  bottom: auto;\n  top: 2.25rem;\n  right: -1.5rem;\n  border-left-color: var(--chipmunk--color--black);\n  filter: drop-shadow(1px 0 0 transparent);\n}\n.is-open .u-dropdown {\n  opacity: 1;\n  pointer-events: all;\n  transform: translate3d(0, 0, 0);\n}\n.u-dropdown__link {\n  min-width: 12.5rem;\n  white-space: nowrap;\n}\n.u-dropdown__trigger {\n  position: relative;\n}\n/*\n** Utils - Hamburger\n** ----------------------------------------------------------------------------- */\n.u-hamburger {\n  --hamburger-width: 1.75em;\n  --hamburger-height: 0.66em;\n  --hamburger-weight: 2px;\n  --hamburger-color: currentColor;\n  --hamburger-duration: 0.25s;\n  --hamburger-radius: 3px;\n  position: relative;\n  width: var(--hamburger-width);\n  height: var(--hamburger-width);\n  cursor: pointer;\n}\n.u-hamburger:focus {\n  outline: none;\n}\n.u-hamburger > * {\n  position: relative;\n  width: 100%;\n  display: block;\n  height: var(--hamburger-weight);\n}\n.u-hamburger > *::before, .u-hamburger > *::after {\n  content: \"\";\n  position: absolute;\n  display: block;\n  width: 100%;\n  height: 100%;\n  background-color: var(--hamburger-color);\n  border-radius: var(--hamburger-radius);\n  transition: top var(--hamburger-duration) var(--hamburger-duration), bottom var(--hamburger-duration) var(--hamburger-duration), width var(--hamburger-duration) var(--hamburger-duration), transform var(--hamburger-duration) 0s, background-color var(--hamburger-duration) 0s;\n}\n.has-nav-open .u-hamburger > *::before, .has-nav-open .u-hamburger > *::after {\n  transition: top var(--hamburger-duration) 0s, bottom var(--hamburger-duration) 0s, width var(--hamburger-duration) 0s, transform var(--hamburger-duration) var(--hamburger-duration), background-color var(--hamburger-duration) var(--hamburger-duration);\n}\n.u-hamburger > *::before {\n  top: calc((var(--hamburger-height) * 0.5 - var(--hamburger-weight) * 0.5) * -1);\n}\n.has-nav-open .u-hamburger > *::before {\n  top: 0;\n  transform: rotate(45deg);\n}\n.u-hamburger > *::after {\n  width: calc(var(--hamburger-width) * 0.666);\n  bottom: calc((var(--hamburger-height) * 0.5 - var(--hamburger-weight) * 0.5) * -1);\n}\n.has-nav-open .u-hamburger > *::after {\n  width: 100%;\n  bottom: 0;\n  transform: rotate(-45deg);\n}\n/*\n** Utils - Hide\n** ----------------------------------------------------------------------------- */\n.u-hidden-visually {\n  border: 0 !important;\n  clip: rect(0 0 0 0) !important;\n  -webkit-clip-path: inset(50%) !important;\n          clip-path: inset(50%) !important;\n  height: 1px !important;\n  margin: -1px !important;\n  overflow: hidden !important;\n  padding: 0 !important;\n  position: absolute !important;\n  white-space: nowrap !important;\n  width: 1px !important;\n}\n/*\n** Utils - Icon\n** ----------------------------------------------------------------------------- */\n.u-icon {\n  display: block;\n  height: 100%;\n  width: 100%;\n}\n.u-icon--sm {\n  height: 0.75em;\n  width: 0.75em;\n}\n.u-icon--md {\n  height: 1em;\n  width: 1em;\n}\n.u-icon--lg {\n  height: 1.25em;\n  width: 1.25em;\n}\n/*\n** Utils - Loader\n** ----------------------------------------------------------------------------- */\n.u-loader > span {\n  transition: opacity var(--chipmunk--transition-duration);\n}\n.u-loader.is-loading {\n  position: relative;\n}\n.u-loader.is-loading > span {\n  opacity: 0;\n}\n.u-loader.is-loading::after {\n  position: absolute;\n  content: \"\";\n  top: 50%;\n  left: 50%;\n  margin-top: -0.5em;\n  margin-left: -0.5em;\n  width: 1em;\n  height: 1em;\n  border-radius: 50%;\n  border-color: currentColor transparent transparent;\n  border-style: solid;\n  border-width: 1px;\n  box-shadow: 0 0 0 1px transparent;\n  animation: button-spin 0.6s linear;\n  animation-iteration-count: infinite;\n}\n/*\n** Utils - Text\n** ----------------------------------------------------------------------------- */\n.u-text--center {\n  text-align: center;\n}\n.u-text--left {\n  text-align: left;\n}\n.u-text--right {\n  text-align: right;\n}", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./styles/theme.scss":
/*!***************************!*\
  !*** ./styles/theme.scss ***!
  \***************************/
/***/ ((module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../../../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "../../../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_style_loader_dist_runtime_styleDomAPI_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !../../../../../../../node_modules/style-loader/dist/runtime/styleDomAPI.js */ "../../../../../../node_modules/style-loader/dist/runtime/styleDomAPI.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_styleDomAPI_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_styleDomAPI_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _node_modules_style_loader_dist_runtime_insertBySelector_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../../../node_modules/style-loader/dist/runtime/insertBySelector.js */ "../../../../../../node_modules/style-loader/dist/runtime/insertBySelector.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_insertBySelector_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_insertBySelector_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _node_modules_style_loader_dist_runtime_setAttributesWithoutAttributes_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! !../../../../../../../node_modules/style-loader/dist/runtime/setAttributesWithoutAttributes.js */ "../../../../../../node_modules/style-loader/dist/runtime/setAttributesWithoutAttributes.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_setAttributesWithoutAttributes_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_setAttributesWithoutAttributes_js__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _node_modules_style_loader_dist_runtime_insertStyleElement_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! !../../../../../../../node_modules/style-loader/dist/runtime/insertStyleElement.js */ "../../../../../../node_modules/style-loader/dist/runtime/insertStyleElement.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_insertStyleElement_js__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_insertStyleElement_js__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _node_modules_style_loader_dist_runtime_styleTagTransform_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! !../../../../../../../node_modules/style-loader/dist/runtime/styleTagTransform.js */ "../../../../../../node_modules/style-loader/dist/runtime/styleTagTransform.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_styleTagTransform_js__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_styleTagTransform_js__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _node_modules_roots_bud_support_lib_css_loader_index_cjs_css_node_modules_postcss_loader_dist_cjs_js_postcss_node_modules_resolve_url_loader_index_js_resolveUrl_node_modules_sass_loader_dist_cjs_js_sass_loader_theme_scss__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! !!../../../../../../../node_modules/@roots/bud-support/lib/css-loader/index.cjs??css!../../../../../../../node_modules/postcss-loader/dist/cjs.js??postcss!../../../../../../../node_modules/resolve-url-loader/index.js??resolveUrl!../../../../../../../node_modules/sass-loader/dist/cjs.js??sass-loader!./theme.scss */ "../../../../../../node_modules/@roots/bud-support/lib/css-loader/index.cjs??css!../../../../../../node_modules/postcss-loader/dist/cjs.js??postcss!../../../../../../node_modules/resolve-url-loader/index.js??resolveUrl!../../../../../../node_modules/sass-loader/dist/cjs.js??sass-loader!./styles/theme.scss");

      
      
      
      
      
      
      
      
      

var options = {};

options.styleTagTransform = (_node_modules_style_loader_dist_runtime_styleTagTransform_js__WEBPACK_IMPORTED_MODULE_5___default());
options.setAttributes = (_node_modules_style_loader_dist_runtime_setAttributesWithoutAttributes_js__WEBPACK_IMPORTED_MODULE_3___default());

      options.insert = _node_modules_style_loader_dist_runtime_insertBySelector_js__WEBPACK_IMPORTED_MODULE_2___default().bind(null, "head");
    
options.domAPI = (_node_modules_style_loader_dist_runtime_styleDomAPI_js__WEBPACK_IMPORTED_MODULE_1___default());
options.insertStyleElement = (_node_modules_style_loader_dist_runtime_insertStyleElement_js__WEBPACK_IMPORTED_MODULE_4___default());

var update = _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_node_modules_roots_bud_support_lib_css_loader_index_cjs_css_node_modules_postcss_loader_dist_cjs_js_postcss_node_modules_resolve_url_loader_index_js_resolveUrl_node_modules_sass_loader_dist_cjs_js_sass_loader_theme_scss__WEBPACK_IMPORTED_MODULE_6__["default"], options);


if (true) {
  if (!_node_modules_roots_bud_support_lib_css_loader_index_cjs_css_node_modules_postcss_loader_dist_cjs_js_postcss_node_modules_resolve_url_loader_index_js_resolveUrl_node_modules_sass_loader_dist_cjs_js_sass_loader_theme_scss__WEBPACK_IMPORTED_MODULE_6__["default"].locals || module.hot.invalidate) {
    var isEqualLocals = function isEqualLocals(a, b, isNamedExport) {
  if (!a && b || a && !b) {
    return false;
  }

  var p;

  for (p in a) {
    if (isNamedExport && p === "default") {
      // eslint-disable-next-line no-continue
      continue;
    }

    if (a[p] !== b[p]) {
      return false;
    }
  }

  for (p in b) {
    if (isNamedExport && p === "default") {
      // eslint-disable-next-line no-continue
      continue;
    }

    if (!a[p]) {
      return false;
    }
  }

  return true;
};
    var isNamedExport = !_node_modules_roots_bud_support_lib_css_loader_index_cjs_css_node_modules_postcss_loader_dist_cjs_js_postcss_node_modules_resolve_url_loader_index_js_resolveUrl_node_modules_sass_loader_dist_cjs_js_sass_loader_theme_scss__WEBPACK_IMPORTED_MODULE_6__["default"].locals;
    var oldLocals = isNamedExport ? _node_modules_roots_bud_support_lib_css_loader_index_cjs_css_node_modules_postcss_loader_dist_cjs_js_postcss_node_modules_resolve_url_loader_index_js_resolveUrl_node_modules_sass_loader_dist_cjs_js_sass_loader_theme_scss__WEBPACK_IMPORTED_MODULE_6__ : _node_modules_roots_bud_support_lib_css_loader_index_cjs_css_node_modules_postcss_loader_dist_cjs_js_postcss_node_modules_resolve_url_loader_index_js_resolveUrl_node_modules_sass_loader_dist_cjs_js_sass_loader_theme_scss__WEBPACK_IMPORTED_MODULE_6__["default"].locals;

    module.hot.accept(
      /*! !!../../../../../../../node_modules/@roots/bud-support/lib/css-loader/index.cjs??css!../../../../../../../node_modules/postcss-loader/dist/cjs.js??postcss!../../../../../../../node_modules/resolve-url-loader/index.js??resolveUrl!../../../../../../../node_modules/sass-loader/dist/cjs.js??sass-loader!./theme.scss */ "../../../../../../node_modules/@roots/bud-support/lib/css-loader/index.cjs??css!../../../../../../node_modules/postcss-loader/dist/cjs.js??postcss!../../../../../../node_modules/resolve-url-loader/index.js??resolveUrl!../../../../../../node_modules/sass-loader/dist/cjs.js??sass-loader!./styles/theme.scss",
      __WEBPACK_OUTDATED_DEPENDENCIES__ => { /* harmony import */ _node_modules_roots_bud_support_lib_css_loader_index_cjs_css_node_modules_postcss_loader_dist_cjs_js_postcss_node_modules_resolve_url_loader_index_js_resolveUrl_node_modules_sass_loader_dist_cjs_js_sass_loader_theme_scss__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! !!../../../../../../../node_modules/@roots/bud-support/lib/css-loader/index.cjs??css!../../../../../../../node_modules/postcss-loader/dist/cjs.js??postcss!../../../../../../../node_modules/resolve-url-loader/index.js??resolveUrl!../../../../../../../node_modules/sass-loader/dist/cjs.js??sass-loader!./theme.scss */ "../../../../../../node_modules/@roots/bud-support/lib/css-loader/index.cjs??css!../../../../../../node_modules/postcss-loader/dist/cjs.js??postcss!../../../../../../node_modules/resolve-url-loader/index.js??resolveUrl!../../../../../../node_modules/sass-loader/dist/cjs.js??sass-loader!./styles/theme.scss");
(function () {
        if (!isEqualLocals(oldLocals, isNamedExport ? _node_modules_roots_bud_support_lib_css_loader_index_cjs_css_node_modules_postcss_loader_dist_cjs_js_postcss_node_modules_resolve_url_loader_index_js_resolveUrl_node_modules_sass_loader_dist_cjs_js_sass_loader_theme_scss__WEBPACK_IMPORTED_MODULE_6__ : _node_modules_roots_bud_support_lib_css_loader_index_cjs_css_node_modules_postcss_loader_dist_cjs_js_postcss_node_modules_resolve_url_loader_index_js_resolveUrl_node_modules_sass_loader_dist_cjs_js_sass_loader_theme_scss__WEBPACK_IMPORTED_MODULE_6__["default"].locals, isNamedExport)) {
                module.hot.invalidate();

                return;
              }

              oldLocals = isNamedExport ? _node_modules_roots_bud_support_lib_css_loader_index_cjs_css_node_modules_postcss_loader_dist_cjs_js_postcss_node_modules_resolve_url_loader_index_js_resolveUrl_node_modules_sass_loader_dist_cjs_js_sass_loader_theme_scss__WEBPACK_IMPORTED_MODULE_6__ : _node_modules_roots_bud_support_lib_css_loader_index_cjs_css_node_modules_postcss_loader_dist_cjs_js_postcss_node_modules_resolve_url_loader_index_js_resolveUrl_node_modules_sass_loader_dist_cjs_js_sass_loader_theme_scss__WEBPACK_IMPORTED_MODULE_6__["default"].locals;

              update(_node_modules_roots_bud_support_lib_css_loader_index_cjs_css_node_modules_postcss_loader_dist_cjs_js_postcss_node_modules_resolve_url_loader_index_js_resolveUrl_node_modules_sass_loader_dist_cjs_js_sass_loader_theme_scss__WEBPACK_IMPORTED_MODULE_6__["default"]);
      })(__WEBPACK_OUTDATED_DEPENDENCIES__); }
    )
  }

  module.hot.dispose(function() {
    update();
  });
}



       /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_roots_bud_support_lib_css_loader_index_cjs_css_node_modules_postcss_loader_dist_cjs_js_postcss_node_modules_resolve_url_loader_index_js_resolveUrl_node_modules_sass_loader_dist_cjs_js_sass_loader_theme_scss__WEBPACK_IMPORTED_MODULE_6__["default"] && _node_modules_roots_bud_support_lib_css_loader_index_cjs_css_node_modules_postcss_loader_dist_cjs_js_postcss_node_modules_resolve_url_loader_index_js_resolveUrl_node_modules_sass_loader_dist_cjs_js_sass_loader_theme_scss__WEBPACK_IMPORTED_MODULE_6__["default"].locals ? _node_modules_roots_bud_support_lib_css_loader_index_cjs_css_node_modules_postcss_loader_dist_cjs_js_postcss_node_modules_resolve_url_loader_index_js_resolveUrl_node_modules_sass_loader_dist_cjs_js_sass_loader_theme_scss__WEBPACK_IMPORTED_MODULE_6__["default"].locals : undefined);


/***/ }),

/***/ "../../../../../../node_modules/axios/index.js":
/*!*****************************************************!*\
  !*** ../../../../../../node_modules/axios/index.js ***!
  \*****************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

module.exports = __webpack_require__(/*! ./lib/axios */ "../../../../../../node_modules/axios/lib/axios.js");

/***/ }),

/***/ "../../../../../../node_modules/axios/lib/adapters/xhr.js":
/*!****************************************************************!*\
  !*** ../../../../../../node_modules/axios/lib/adapters/xhr.js ***!
  \****************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var utils = __webpack_require__(/*! ./../utils */ "../../../../../../node_modules/axios/lib/utils.js");
var settle = __webpack_require__(/*! ./../core/settle */ "../../../../../../node_modules/axios/lib/core/settle.js");
var cookies = __webpack_require__(/*! ./../helpers/cookies */ "../../../../../../node_modules/axios/lib/helpers/cookies.js");
var buildURL = __webpack_require__(/*! ./../helpers/buildURL */ "../../../../../../node_modules/axios/lib/helpers/buildURL.js");
var buildFullPath = __webpack_require__(/*! ../core/buildFullPath */ "../../../../../../node_modules/axios/lib/core/buildFullPath.js");
var parseHeaders = __webpack_require__(/*! ./../helpers/parseHeaders */ "../../../../../../node_modules/axios/lib/helpers/parseHeaders.js");
var isURLSameOrigin = __webpack_require__(/*! ./../helpers/isURLSameOrigin */ "../../../../../../node_modules/axios/lib/helpers/isURLSameOrigin.js");
var transitionalDefaults = __webpack_require__(/*! ../defaults/transitional */ "../../../../../../node_modules/axios/lib/defaults/transitional.js");
var AxiosError = __webpack_require__(/*! ../core/AxiosError */ "../../../../../../node_modules/axios/lib/core/AxiosError.js");
var CanceledError = __webpack_require__(/*! ../cancel/CanceledError */ "../../../../../../node_modules/axios/lib/cancel/CanceledError.js");
var parseProtocol = __webpack_require__(/*! ../helpers/parseProtocol */ "../../../../../../node_modules/axios/lib/helpers/parseProtocol.js");

module.exports = function xhrAdapter(config) {
  return new Promise(function dispatchXhrRequest(resolve, reject) {
    var requestData = config.data;
    var requestHeaders = config.headers;
    var responseType = config.responseType;
    var onCanceled;
    function done() {
      if (config.cancelToken) {
        config.cancelToken.unsubscribe(onCanceled);
      }

      if (config.signal) {
        config.signal.removeEventListener('abort', onCanceled);
      }
    }

    if (utils.isFormData(requestData) && utils.isStandardBrowserEnv()) {
      delete requestHeaders['Content-Type']; // Let the browser set it
    }

    var request = new XMLHttpRequest();

    // HTTP basic authentication
    if (config.auth) {
      var username = config.auth.username || '';
      var password = config.auth.password ? unescape(encodeURIComponent(config.auth.password)) : '';
      requestHeaders.Authorization = 'Basic ' + btoa(username + ':' + password);
    }

    var fullPath = buildFullPath(config.baseURL, config.url);

    request.open(config.method.toUpperCase(), buildURL(fullPath, config.params, config.paramsSerializer), true);

    // Set the request timeout in MS
    request.timeout = config.timeout;

    function onloadend() {
      if (!request) {
        return;
      }
      // Prepare the response
      var responseHeaders = 'getAllResponseHeaders' in request ? parseHeaders(request.getAllResponseHeaders()) : null;
      var responseData = !responseType || responseType === 'text' ||  responseType === 'json' ?
        request.responseText : request.response;
      var response = {
        data: responseData,
        status: request.status,
        statusText: request.statusText,
        headers: responseHeaders,
        config: config,
        request: request
      };

      settle(function _resolve(value) {
        resolve(value);
        done();
      }, function _reject(err) {
        reject(err);
        done();
      }, response);

      // Clean up request
      request = null;
    }

    if ('onloadend' in request) {
      // Use onloadend if available
      request.onloadend = onloadend;
    } else {
      // Listen for ready state to emulate onloadend
      request.onreadystatechange = function handleLoad() {
        if (!request || request.readyState !== 4) {
          return;
        }

        // The request errored out and we didn't get a response, this will be
        // handled by onerror instead
        // With one exception: request that using file: protocol, most browsers
        // will return status as 0 even though it's a successful request
        if (request.status === 0 && !(request.responseURL && request.responseURL.indexOf('file:') === 0)) {
          return;
        }
        // readystate handler is calling before onerror or ontimeout handlers,
        // so we should call onloadend on the next 'tick'
        setTimeout(onloadend);
      };
    }

    // Handle browser request cancellation (as opposed to a manual cancellation)
    request.onabort = function handleAbort() {
      if (!request) {
        return;
      }

      reject(new AxiosError('Request aborted', AxiosError.ECONNABORTED, config, request));

      // Clean up request
      request = null;
    };

    // Handle low level network errors
    request.onerror = function handleError() {
      // Real errors are hidden from us by the browser
      // onerror should only fire if it's a network error
      reject(new AxiosError('Network Error', AxiosError.ERR_NETWORK, config, request, request));

      // Clean up request
      request = null;
    };

    // Handle timeout
    request.ontimeout = function handleTimeout() {
      var timeoutErrorMessage = config.timeout ? 'timeout of ' + config.timeout + 'ms exceeded' : 'timeout exceeded';
      var transitional = config.transitional || transitionalDefaults;
      if (config.timeoutErrorMessage) {
        timeoutErrorMessage = config.timeoutErrorMessage;
      }
      reject(new AxiosError(
        timeoutErrorMessage,
        transitional.clarifyTimeoutError ? AxiosError.ETIMEDOUT : AxiosError.ECONNABORTED,
        config,
        request));

      // Clean up request
      request = null;
    };

    // Add xsrf header
    // This is only done if running in a standard browser environment.
    // Specifically not if we're in a web worker, or react-native.
    if (utils.isStandardBrowserEnv()) {
      // Add xsrf header
      var xsrfValue = (config.withCredentials || isURLSameOrigin(fullPath)) && config.xsrfCookieName ?
        cookies.read(config.xsrfCookieName) :
        undefined;

      if (xsrfValue) {
        requestHeaders[config.xsrfHeaderName] = xsrfValue;
      }
    }

    // Add headers to the request
    if ('setRequestHeader' in request) {
      utils.forEach(requestHeaders, function setRequestHeader(val, key) {
        if (typeof requestData === 'undefined' && key.toLowerCase() === 'content-type') {
          // Remove Content-Type if data is undefined
          delete requestHeaders[key];
        } else {
          // Otherwise add header to the request
          request.setRequestHeader(key, val);
        }
      });
    }

    // Add withCredentials to request if needed
    if (!utils.isUndefined(config.withCredentials)) {
      request.withCredentials = !!config.withCredentials;
    }

    // Add responseType to request if needed
    if (responseType && responseType !== 'json') {
      request.responseType = config.responseType;
    }

    // Handle progress if needed
    if (typeof config.onDownloadProgress === 'function') {
      request.addEventListener('progress', config.onDownloadProgress);
    }

    // Not all browsers support upload events
    if (typeof config.onUploadProgress === 'function' && request.upload) {
      request.upload.addEventListener('progress', config.onUploadProgress);
    }

    if (config.cancelToken || config.signal) {
      // Handle cancellation
      // eslint-disable-next-line func-names
      onCanceled = function(cancel) {
        if (!request) {
          return;
        }
        reject(!cancel || (cancel && cancel.type) ? new CanceledError() : cancel);
        request.abort();
        request = null;
      };

      config.cancelToken && config.cancelToken.subscribe(onCanceled);
      if (config.signal) {
        config.signal.aborted ? onCanceled() : config.signal.addEventListener('abort', onCanceled);
      }
    }

    if (!requestData) {
      requestData = null;
    }

    var protocol = parseProtocol(fullPath);

    if (protocol && [ 'http', 'https', 'file' ].indexOf(protocol) === -1) {
      reject(new AxiosError('Unsupported protocol ' + protocol + ':', AxiosError.ERR_BAD_REQUEST, config));
      return;
    }


    // Send the request
    request.send(requestData);
  });
};


/***/ }),

/***/ "../../../../../../node_modules/axios/lib/axios.js":
/*!*********************************************************!*\
  !*** ../../../../../../node_modules/axios/lib/axios.js ***!
  \*********************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var utils = __webpack_require__(/*! ./utils */ "../../../../../../node_modules/axios/lib/utils.js");
var bind = __webpack_require__(/*! ./helpers/bind */ "../../../../../../node_modules/axios/lib/helpers/bind.js");
var Axios = __webpack_require__(/*! ./core/Axios */ "../../../../../../node_modules/axios/lib/core/Axios.js");
var mergeConfig = __webpack_require__(/*! ./core/mergeConfig */ "../../../../../../node_modules/axios/lib/core/mergeConfig.js");
var defaults = __webpack_require__(/*! ./defaults */ "../../../../../../node_modules/axios/lib/defaults/index.js");

/**
 * Create an instance of Axios
 *
 * @param {Object} defaultConfig The default config for the instance
 * @return {Axios} A new instance of Axios
 */
function createInstance(defaultConfig) {
  var context = new Axios(defaultConfig);
  var instance = bind(Axios.prototype.request, context);

  // Copy axios.prototype to instance
  utils.extend(instance, Axios.prototype, context);

  // Copy context to instance
  utils.extend(instance, context);

  // Factory for creating new instances
  instance.create = function create(instanceConfig) {
    return createInstance(mergeConfig(defaultConfig, instanceConfig));
  };

  return instance;
}

// Create the default instance to be exported
var axios = createInstance(defaults);

// Expose Axios class to allow class inheritance
axios.Axios = Axios;

// Expose Cancel & CancelToken
axios.CanceledError = __webpack_require__(/*! ./cancel/CanceledError */ "../../../../../../node_modules/axios/lib/cancel/CanceledError.js");
axios.CancelToken = __webpack_require__(/*! ./cancel/CancelToken */ "../../../../../../node_modules/axios/lib/cancel/CancelToken.js");
axios.isCancel = __webpack_require__(/*! ./cancel/isCancel */ "../../../../../../node_modules/axios/lib/cancel/isCancel.js");
axios.VERSION = (__webpack_require__(/*! ./env/data */ "../../../../../../node_modules/axios/lib/env/data.js").version);
axios.toFormData = __webpack_require__(/*! ./helpers/toFormData */ "../../../../../../node_modules/axios/lib/helpers/toFormData.js");

// Expose AxiosError class
axios.AxiosError = __webpack_require__(/*! ../lib/core/AxiosError */ "../../../../../../node_modules/axios/lib/core/AxiosError.js");

// alias for CanceledError for backward compatibility
axios.Cancel = axios.CanceledError;

// Expose all/spread
axios.all = function all(promises) {
  return Promise.all(promises);
};
axios.spread = __webpack_require__(/*! ./helpers/spread */ "../../../../../../node_modules/axios/lib/helpers/spread.js");

// Expose isAxiosError
axios.isAxiosError = __webpack_require__(/*! ./helpers/isAxiosError */ "../../../../../../node_modules/axios/lib/helpers/isAxiosError.js");

module.exports = axios;

// Allow use of default import syntax in TypeScript
module.exports["default"] = axios;


/***/ }),

/***/ "../../../../../../node_modules/axios/lib/cancel/CancelToken.js":
/*!**********************************************************************!*\
  !*** ../../../../../../node_modules/axios/lib/cancel/CancelToken.js ***!
  \**********************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var CanceledError = __webpack_require__(/*! ./CanceledError */ "../../../../../../node_modules/axios/lib/cancel/CanceledError.js");

/**
 * A `CancelToken` is an object that can be used to request cancellation of an operation.
 *
 * @class
 * @param {Function} executor The executor function.
 */
function CancelToken(executor) {
  if (typeof executor !== 'function') {
    throw new TypeError('executor must be a function.');
  }

  var resolvePromise;

  this.promise = new Promise(function promiseExecutor(resolve) {
    resolvePromise = resolve;
  });

  var token = this;

  // eslint-disable-next-line func-names
  this.promise.then(function(cancel) {
    if (!token._listeners) return;

    var i;
    var l = token._listeners.length;

    for (i = 0; i < l; i++) {
      token._listeners[i](cancel);
    }
    token._listeners = null;
  });

  // eslint-disable-next-line func-names
  this.promise.then = function(onfulfilled) {
    var _resolve;
    // eslint-disable-next-line func-names
    var promise = new Promise(function(resolve) {
      token.subscribe(resolve);
      _resolve = resolve;
    }).then(onfulfilled);

    promise.cancel = function reject() {
      token.unsubscribe(_resolve);
    };

    return promise;
  };

  executor(function cancel(message) {
    if (token.reason) {
      // Cancellation has already been requested
      return;
    }

    token.reason = new CanceledError(message);
    resolvePromise(token.reason);
  });
}

/**
 * Throws a `CanceledError` if cancellation has been requested.
 */
CancelToken.prototype.throwIfRequested = function throwIfRequested() {
  if (this.reason) {
    throw this.reason;
  }
};

/**
 * Subscribe to the cancel signal
 */

CancelToken.prototype.subscribe = function subscribe(listener) {
  if (this.reason) {
    listener(this.reason);
    return;
  }

  if (this._listeners) {
    this._listeners.push(listener);
  } else {
    this._listeners = [listener];
  }
};

/**
 * Unsubscribe from the cancel signal
 */

CancelToken.prototype.unsubscribe = function unsubscribe(listener) {
  if (!this._listeners) {
    return;
  }
  var index = this._listeners.indexOf(listener);
  if (index !== -1) {
    this._listeners.splice(index, 1);
  }
};

/**
 * Returns an object that contains a new `CancelToken` and a function that, when called,
 * cancels the `CancelToken`.
 */
CancelToken.source = function source() {
  var cancel;
  var token = new CancelToken(function executor(c) {
    cancel = c;
  });
  return {
    token: token,
    cancel: cancel
  };
};

module.exports = CancelToken;


/***/ }),

/***/ "../../../../../../node_modules/axios/lib/cancel/CanceledError.js":
/*!************************************************************************!*\
  !*** ../../../../../../node_modules/axios/lib/cancel/CanceledError.js ***!
  \************************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var AxiosError = __webpack_require__(/*! ../core/AxiosError */ "../../../../../../node_modules/axios/lib/core/AxiosError.js");
var utils = __webpack_require__(/*! ../utils */ "../../../../../../node_modules/axios/lib/utils.js");

/**
 * A `CanceledError` is an object that is thrown when an operation is canceled.
 *
 * @class
 * @param {string=} message The message.
 */
function CanceledError(message) {
  // eslint-disable-next-line no-eq-null,eqeqeq
  AxiosError.call(this, message == null ? 'canceled' : message, AxiosError.ERR_CANCELED);
  this.name = 'CanceledError';
}

utils.inherits(CanceledError, AxiosError, {
  __CANCEL__: true
});

module.exports = CanceledError;


/***/ }),

/***/ "../../../../../../node_modules/axios/lib/cancel/isCancel.js":
/*!*******************************************************************!*\
  !*** ../../../../../../node_modules/axios/lib/cancel/isCancel.js ***!
  \*******************************************************************/
/***/ ((module) => {

"use strict";


module.exports = function isCancel(value) {
  return !!(value && value.__CANCEL__);
};


/***/ }),

/***/ "../../../../../../node_modules/axios/lib/core/Axios.js":
/*!**************************************************************!*\
  !*** ../../../../../../node_modules/axios/lib/core/Axios.js ***!
  \**************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var utils = __webpack_require__(/*! ./../utils */ "../../../../../../node_modules/axios/lib/utils.js");
var buildURL = __webpack_require__(/*! ../helpers/buildURL */ "../../../../../../node_modules/axios/lib/helpers/buildURL.js");
var InterceptorManager = __webpack_require__(/*! ./InterceptorManager */ "../../../../../../node_modules/axios/lib/core/InterceptorManager.js");
var dispatchRequest = __webpack_require__(/*! ./dispatchRequest */ "../../../../../../node_modules/axios/lib/core/dispatchRequest.js");
var mergeConfig = __webpack_require__(/*! ./mergeConfig */ "../../../../../../node_modules/axios/lib/core/mergeConfig.js");
var buildFullPath = __webpack_require__(/*! ./buildFullPath */ "../../../../../../node_modules/axios/lib/core/buildFullPath.js");
var validator = __webpack_require__(/*! ../helpers/validator */ "../../../../../../node_modules/axios/lib/helpers/validator.js");

var validators = validator.validators;
/**
 * Create a new instance of Axios
 *
 * @param {Object} instanceConfig The default config for the instance
 */
function Axios(instanceConfig) {
  this.defaults = instanceConfig;
  this.interceptors = {
    request: new InterceptorManager(),
    response: new InterceptorManager()
  };
}

/**
 * Dispatch a request
 *
 * @param {Object} config The config specific for this request (merged with this.defaults)
 */
Axios.prototype.request = function request(configOrUrl, config) {
  /*eslint no-param-reassign:0*/
  // Allow for axios('example/url'[, config]) a la fetch API
  if (typeof configOrUrl === 'string') {
    config = config || {};
    config.url = configOrUrl;
  } else {
    config = configOrUrl || {};
  }

  config = mergeConfig(this.defaults, config);

  // Set config.method
  if (config.method) {
    config.method = config.method.toLowerCase();
  } else if (this.defaults.method) {
    config.method = this.defaults.method.toLowerCase();
  } else {
    config.method = 'get';
  }

  var transitional = config.transitional;

  if (transitional !== undefined) {
    validator.assertOptions(transitional, {
      silentJSONParsing: validators.transitional(validators.boolean),
      forcedJSONParsing: validators.transitional(validators.boolean),
      clarifyTimeoutError: validators.transitional(validators.boolean)
    }, false);
  }

  // filter out skipped interceptors
  var requestInterceptorChain = [];
  var synchronousRequestInterceptors = true;
  this.interceptors.request.forEach(function unshiftRequestInterceptors(interceptor) {
    if (typeof interceptor.runWhen === 'function' && interceptor.runWhen(config) === false) {
      return;
    }

    synchronousRequestInterceptors = synchronousRequestInterceptors && interceptor.synchronous;

    requestInterceptorChain.unshift(interceptor.fulfilled, interceptor.rejected);
  });

  var responseInterceptorChain = [];
  this.interceptors.response.forEach(function pushResponseInterceptors(interceptor) {
    responseInterceptorChain.push(interceptor.fulfilled, interceptor.rejected);
  });

  var promise;

  if (!synchronousRequestInterceptors) {
    var chain = [dispatchRequest, undefined];

    Array.prototype.unshift.apply(chain, requestInterceptorChain);
    chain = chain.concat(responseInterceptorChain);

    promise = Promise.resolve(config);
    while (chain.length) {
      promise = promise.then(chain.shift(), chain.shift());
    }

    return promise;
  }


  var newConfig = config;
  while (requestInterceptorChain.length) {
    var onFulfilled = requestInterceptorChain.shift();
    var onRejected = requestInterceptorChain.shift();
    try {
      newConfig = onFulfilled(newConfig);
    } catch (error) {
      onRejected(error);
      break;
    }
  }

  try {
    promise = dispatchRequest(newConfig);
  } catch (error) {
    return Promise.reject(error);
  }

  while (responseInterceptorChain.length) {
    promise = promise.then(responseInterceptorChain.shift(), responseInterceptorChain.shift());
  }

  return promise;
};

Axios.prototype.getUri = function getUri(config) {
  config = mergeConfig(this.defaults, config);
  var fullPath = buildFullPath(config.baseURL, config.url);
  return buildURL(fullPath, config.params, config.paramsSerializer);
};

// Provide aliases for supported request methods
utils.forEach(['delete', 'get', 'head', 'options'], function forEachMethodNoData(method) {
  /*eslint func-names:0*/
  Axios.prototype[method] = function(url, config) {
    return this.request(mergeConfig(config || {}, {
      method: method,
      url: url,
      data: (config || {}).data
    }));
  };
});

utils.forEach(['post', 'put', 'patch'], function forEachMethodWithData(method) {
  /*eslint func-names:0*/

  function generateHTTPMethod(isForm) {
    return function httpMethod(url, data, config) {
      return this.request(mergeConfig(config || {}, {
        method: method,
        headers: isForm ? {
          'Content-Type': 'multipart/form-data'
        } : {},
        url: url,
        data: data
      }));
    };
  }

  Axios.prototype[method] = generateHTTPMethod();

  Axios.prototype[method + 'Form'] = generateHTTPMethod(true);
});

module.exports = Axios;


/***/ }),

/***/ "../../../../../../node_modules/axios/lib/core/AxiosError.js":
/*!*******************************************************************!*\
  !*** ../../../../../../node_modules/axios/lib/core/AxiosError.js ***!
  \*******************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var utils = __webpack_require__(/*! ../utils */ "../../../../../../node_modules/axios/lib/utils.js");

/**
 * Create an Error with the specified message, config, error code, request and response.
 *
 * @param {string} message The error message.
 * @param {string} [code] The error code (for example, 'ECONNABORTED').
 * @param {Object} [config] The config.
 * @param {Object} [request] The request.
 * @param {Object} [response] The response.
 * @returns {Error} The created error.
 */
function AxiosError(message, code, config, request, response) {
  Error.call(this);
  this.message = message;
  this.name = 'AxiosError';
  code && (this.code = code);
  config && (this.config = config);
  request && (this.request = request);
  response && (this.response = response);
}

utils.inherits(AxiosError, Error, {
  toJSON: function toJSON() {
    return {
      // Standard
      message: this.message,
      name: this.name,
      // Microsoft
      description: this.description,
      number: this.number,
      // Mozilla
      fileName: this.fileName,
      lineNumber: this.lineNumber,
      columnNumber: this.columnNumber,
      stack: this.stack,
      // Axios
      config: this.config,
      code: this.code,
      status: this.response && this.response.status ? this.response.status : null
    };
  }
});

var prototype = AxiosError.prototype;
var descriptors = {};

[
  'ERR_BAD_OPTION_VALUE',
  'ERR_BAD_OPTION',
  'ECONNABORTED',
  'ETIMEDOUT',
  'ERR_NETWORK',
  'ERR_FR_TOO_MANY_REDIRECTS',
  'ERR_DEPRECATED',
  'ERR_BAD_RESPONSE',
  'ERR_BAD_REQUEST',
  'ERR_CANCELED'
// eslint-disable-next-line func-names
].forEach(function(code) {
  descriptors[code] = {value: code};
});

Object.defineProperties(AxiosError, descriptors);
Object.defineProperty(prototype, 'isAxiosError', {value: true});

// eslint-disable-next-line func-names
AxiosError.from = function(error, code, config, request, response, customProps) {
  var axiosError = Object.create(prototype);

  utils.toFlatObject(error, axiosError, function filter(obj) {
    return obj !== Error.prototype;
  });

  AxiosError.call(axiosError, error.message, code, config, request, response);

  axiosError.name = error.name;

  customProps && Object.assign(axiosError, customProps);

  return axiosError;
};

module.exports = AxiosError;


/***/ }),

/***/ "../../../../../../node_modules/axios/lib/core/InterceptorManager.js":
/*!***************************************************************************!*\
  !*** ../../../../../../node_modules/axios/lib/core/InterceptorManager.js ***!
  \***************************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var utils = __webpack_require__(/*! ./../utils */ "../../../../../../node_modules/axios/lib/utils.js");

function InterceptorManager() {
  this.handlers = [];
}

/**
 * Add a new interceptor to the stack
 *
 * @param {Function} fulfilled The function to handle `then` for a `Promise`
 * @param {Function} rejected The function to handle `reject` for a `Promise`
 *
 * @return {Number} An ID used to remove interceptor later
 */
InterceptorManager.prototype.use = function use(fulfilled, rejected, options) {
  this.handlers.push({
    fulfilled: fulfilled,
    rejected: rejected,
    synchronous: options ? options.synchronous : false,
    runWhen: options ? options.runWhen : null
  });
  return this.handlers.length - 1;
};

/**
 * Remove an interceptor from the stack
 *
 * @param {Number} id The ID that was returned by `use`
 */
InterceptorManager.prototype.eject = function eject(id) {
  if (this.handlers[id]) {
    this.handlers[id] = null;
  }
};

/**
 * Iterate over all the registered interceptors
 *
 * This method is particularly useful for skipping over any
 * interceptors that may have become `null` calling `eject`.
 *
 * @param {Function} fn The function to call for each interceptor
 */
InterceptorManager.prototype.forEach = function forEach(fn) {
  utils.forEach(this.handlers, function forEachHandler(h) {
    if (h !== null) {
      fn(h);
    }
  });
};

module.exports = InterceptorManager;


/***/ }),

/***/ "../../../../../../node_modules/axios/lib/core/buildFullPath.js":
/*!**********************************************************************!*\
  !*** ../../../../../../node_modules/axios/lib/core/buildFullPath.js ***!
  \**********************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var isAbsoluteURL = __webpack_require__(/*! ../helpers/isAbsoluteURL */ "../../../../../../node_modules/axios/lib/helpers/isAbsoluteURL.js");
var combineURLs = __webpack_require__(/*! ../helpers/combineURLs */ "../../../../../../node_modules/axios/lib/helpers/combineURLs.js");

/**
 * Creates a new URL by combining the baseURL with the requestedURL,
 * only when the requestedURL is not already an absolute URL.
 * If the requestURL is absolute, this function returns the requestedURL untouched.
 *
 * @param {string} baseURL The base URL
 * @param {string} requestedURL Absolute or relative URL to combine
 * @returns {string} The combined full path
 */
module.exports = function buildFullPath(baseURL, requestedURL) {
  if (baseURL && !isAbsoluteURL(requestedURL)) {
    return combineURLs(baseURL, requestedURL);
  }
  return requestedURL;
};


/***/ }),

/***/ "../../../../../../node_modules/axios/lib/core/dispatchRequest.js":
/*!************************************************************************!*\
  !*** ../../../../../../node_modules/axios/lib/core/dispatchRequest.js ***!
  \************************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var utils = __webpack_require__(/*! ./../utils */ "../../../../../../node_modules/axios/lib/utils.js");
var transformData = __webpack_require__(/*! ./transformData */ "../../../../../../node_modules/axios/lib/core/transformData.js");
var isCancel = __webpack_require__(/*! ../cancel/isCancel */ "../../../../../../node_modules/axios/lib/cancel/isCancel.js");
var defaults = __webpack_require__(/*! ../defaults */ "../../../../../../node_modules/axios/lib/defaults/index.js");
var CanceledError = __webpack_require__(/*! ../cancel/CanceledError */ "../../../../../../node_modules/axios/lib/cancel/CanceledError.js");

/**
 * Throws a `CanceledError` if cancellation has been requested.
 */
function throwIfCancellationRequested(config) {
  if (config.cancelToken) {
    config.cancelToken.throwIfRequested();
  }

  if (config.signal && config.signal.aborted) {
    throw new CanceledError();
  }
}

/**
 * Dispatch a request to the server using the configured adapter.
 *
 * @param {object} config The config that is to be used for the request
 * @returns {Promise} The Promise to be fulfilled
 */
module.exports = function dispatchRequest(config) {
  throwIfCancellationRequested(config);

  // Ensure headers exist
  config.headers = config.headers || {};

  // Transform request data
  config.data = transformData.call(
    config,
    config.data,
    config.headers,
    config.transformRequest
  );

  // Flatten headers
  config.headers = utils.merge(
    config.headers.common || {},
    config.headers[config.method] || {},
    config.headers
  );

  utils.forEach(
    ['delete', 'get', 'head', 'post', 'put', 'patch', 'common'],
    function cleanHeaderConfig(method) {
      delete config.headers[method];
    }
  );

  var adapter = config.adapter || defaults.adapter;

  return adapter(config).then(function onAdapterResolution(response) {
    throwIfCancellationRequested(config);

    // Transform response data
    response.data = transformData.call(
      config,
      response.data,
      response.headers,
      config.transformResponse
    );

    return response;
  }, function onAdapterRejection(reason) {
    if (!isCancel(reason)) {
      throwIfCancellationRequested(config);

      // Transform response data
      if (reason && reason.response) {
        reason.response.data = transformData.call(
          config,
          reason.response.data,
          reason.response.headers,
          config.transformResponse
        );
      }
    }

    return Promise.reject(reason);
  });
};


/***/ }),

/***/ "../../../../../../node_modules/axios/lib/core/mergeConfig.js":
/*!********************************************************************!*\
  !*** ../../../../../../node_modules/axios/lib/core/mergeConfig.js ***!
  \********************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var utils = __webpack_require__(/*! ../utils */ "../../../../../../node_modules/axios/lib/utils.js");

/**
 * Config-specific merge-function which creates a new config-object
 * by merging two configuration objects together.
 *
 * @param {Object} config1
 * @param {Object} config2
 * @returns {Object} New object resulting from merging config2 to config1
 */
module.exports = function mergeConfig(config1, config2) {
  // eslint-disable-next-line no-param-reassign
  config2 = config2 || {};
  var config = {};

  function getMergedValue(target, source) {
    if (utils.isPlainObject(target) && utils.isPlainObject(source)) {
      return utils.merge(target, source);
    } else if (utils.isPlainObject(source)) {
      return utils.merge({}, source);
    } else if (utils.isArray(source)) {
      return source.slice();
    }
    return source;
  }

  // eslint-disable-next-line consistent-return
  function mergeDeepProperties(prop) {
    if (!utils.isUndefined(config2[prop])) {
      return getMergedValue(config1[prop], config2[prop]);
    } else if (!utils.isUndefined(config1[prop])) {
      return getMergedValue(undefined, config1[prop]);
    }
  }

  // eslint-disable-next-line consistent-return
  function valueFromConfig2(prop) {
    if (!utils.isUndefined(config2[prop])) {
      return getMergedValue(undefined, config2[prop]);
    }
  }

  // eslint-disable-next-line consistent-return
  function defaultToConfig2(prop) {
    if (!utils.isUndefined(config2[prop])) {
      return getMergedValue(undefined, config2[prop]);
    } else if (!utils.isUndefined(config1[prop])) {
      return getMergedValue(undefined, config1[prop]);
    }
  }

  // eslint-disable-next-line consistent-return
  function mergeDirectKeys(prop) {
    if (prop in config2) {
      return getMergedValue(config1[prop], config2[prop]);
    } else if (prop in config1) {
      return getMergedValue(undefined, config1[prop]);
    }
  }

  var mergeMap = {
    'url': valueFromConfig2,
    'method': valueFromConfig2,
    'data': valueFromConfig2,
    'baseURL': defaultToConfig2,
    'transformRequest': defaultToConfig2,
    'transformResponse': defaultToConfig2,
    'paramsSerializer': defaultToConfig2,
    'timeout': defaultToConfig2,
    'timeoutMessage': defaultToConfig2,
    'withCredentials': defaultToConfig2,
    'adapter': defaultToConfig2,
    'responseType': defaultToConfig2,
    'xsrfCookieName': defaultToConfig2,
    'xsrfHeaderName': defaultToConfig2,
    'onUploadProgress': defaultToConfig2,
    'onDownloadProgress': defaultToConfig2,
    'decompress': defaultToConfig2,
    'maxContentLength': defaultToConfig2,
    'maxBodyLength': defaultToConfig2,
    'beforeRedirect': defaultToConfig2,
    'transport': defaultToConfig2,
    'httpAgent': defaultToConfig2,
    'httpsAgent': defaultToConfig2,
    'cancelToken': defaultToConfig2,
    'socketPath': defaultToConfig2,
    'responseEncoding': defaultToConfig2,
    'validateStatus': mergeDirectKeys
  };

  utils.forEach(Object.keys(config1).concat(Object.keys(config2)), function computeConfigValue(prop) {
    var merge = mergeMap[prop] || mergeDeepProperties;
    var configValue = merge(prop);
    (utils.isUndefined(configValue) && merge !== mergeDirectKeys) || (config[prop] = configValue);
  });

  return config;
};


/***/ }),

/***/ "../../../../../../node_modules/axios/lib/core/settle.js":
/*!***************************************************************!*\
  !*** ../../../../../../node_modules/axios/lib/core/settle.js ***!
  \***************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var AxiosError = __webpack_require__(/*! ./AxiosError */ "../../../../../../node_modules/axios/lib/core/AxiosError.js");

/**
 * Resolve or reject a Promise based on response status.
 *
 * @param {Function} resolve A function that resolves the promise.
 * @param {Function} reject A function that rejects the promise.
 * @param {object} response The response.
 */
module.exports = function settle(resolve, reject, response) {
  var validateStatus = response.config.validateStatus;
  if (!response.status || !validateStatus || validateStatus(response.status)) {
    resolve(response);
  } else {
    reject(new AxiosError(
      'Request failed with status code ' + response.status,
      [AxiosError.ERR_BAD_REQUEST, AxiosError.ERR_BAD_RESPONSE][Math.floor(response.status / 100) - 4],
      response.config,
      response.request,
      response
    ));
  }
};


/***/ }),

/***/ "../../../../../../node_modules/axios/lib/core/transformData.js":
/*!**********************************************************************!*\
  !*** ../../../../../../node_modules/axios/lib/core/transformData.js ***!
  \**********************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var utils = __webpack_require__(/*! ./../utils */ "../../../../../../node_modules/axios/lib/utils.js");
var defaults = __webpack_require__(/*! ../defaults */ "../../../../../../node_modules/axios/lib/defaults/index.js");

/**
 * Transform the data for a request or a response
 *
 * @param {Object|String} data The data to be transformed
 * @param {Array} headers The headers for the request or response
 * @param {Array|Function} fns A single function or Array of functions
 * @returns {*} The resulting transformed data
 */
module.exports = function transformData(data, headers, fns) {
  var context = this || defaults;
  /*eslint no-param-reassign:0*/
  utils.forEach(fns, function transform(fn) {
    data = fn.call(context, data, headers);
  });

  return data;
};


/***/ }),

/***/ "../../../../../../node_modules/axios/lib/defaults/index.js":
/*!******************************************************************!*\
  !*** ../../../../../../node_modules/axios/lib/defaults/index.js ***!
  \******************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var utils = __webpack_require__(/*! ../utils */ "../../../../../../node_modules/axios/lib/utils.js");
var normalizeHeaderName = __webpack_require__(/*! ../helpers/normalizeHeaderName */ "../../../../../../node_modules/axios/lib/helpers/normalizeHeaderName.js");
var AxiosError = __webpack_require__(/*! ../core/AxiosError */ "../../../../../../node_modules/axios/lib/core/AxiosError.js");
var transitionalDefaults = __webpack_require__(/*! ./transitional */ "../../../../../../node_modules/axios/lib/defaults/transitional.js");
var toFormData = __webpack_require__(/*! ../helpers/toFormData */ "../../../../../../node_modules/axios/lib/helpers/toFormData.js");

var DEFAULT_CONTENT_TYPE = {
  'Content-Type': 'application/x-www-form-urlencoded'
};

function setContentTypeIfUnset(headers, value) {
  if (!utils.isUndefined(headers) && utils.isUndefined(headers['Content-Type'])) {
    headers['Content-Type'] = value;
  }
}

function getDefaultAdapter() {
  var adapter;
  if (typeof XMLHttpRequest !== 'undefined') {
    // For browsers use XHR adapter
    adapter = __webpack_require__(/*! ../adapters/xhr */ "../../../../../../node_modules/axios/lib/adapters/xhr.js");
  } else if (typeof process !== 'undefined' && Object.prototype.toString.call(process) === '[object process]') {
    // For node use HTTP adapter
    adapter = __webpack_require__(/*! ../adapters/http */ "../../../../../../node_modules/axios/lib/adapters/xhr.js");
  }
  return adapter;
}

function stringifySafely(rawValue, parser, encoder) {
  if (utils.isString(rawValue)) {
    try {
      (parser || JSON.parse)(rawValue);
      return utils.trim(rawValue);
    } catch (e) {
      if (e.name !== 'SyntaxError') {
        throw e;
      }
    }
  }

  return (encoder || JSON.stringify)(rawValue);
}

var defaults = {

  transitional: transitionalDefaults,

  adapter: getDefaultAdapter(),

  transformRequest: [function transformRequest(data, headers) {
    normalizeHeaderName(headers, 'Accept');
    normalizeHeaderName(headers, 'Content-Type');

    if (utils.isFormData(data) ||
      utils.isArrayBuffer(data) ||
      utils.isBuffer(data) ||
      utils.isStream(data) ||
      utils.isFile(data) ||
      utils.isBlob(data)
    ) {
      return data;
    }
    if (utils.isArrayBufferView(data)) {
      return data.buffer;
    }
    if (utils.isURLSearchParams(data)) {
      setContentTypeIfUnset(headers, 'application/x-www-form-urlencoded;charset=utf-8');
      return data.toString();
    }

    var isObjectPayload = utils.isObject(data);
    var contentType = headers && headers['Content-Type'];

    var isFileList;

    if ((isFileList = utils.isFileList(data)) || (isObjectPayload && contentType === 'multipart/form-data')) {
      var _FormData = this.env && this.env.FormData;
      return toFormData(isFileList ? {'files[]': data} : data, _FormData && new _FormData());
    } else if (isObjectPayload || contentType === 'application/json') {
      setContentTypeIfUnset(headers, 'application/json');
      return stringifySafely(data);
    }

    return data;
  }],

  transformResponse: [function transformResponse(data) {
    var transitional = this.transitional || defaults.transitional;
    var silentJSONParsing = transitional && transitional.silentJSONParsing;
    var forcedJSONParsing = transitional && transitional.forcedJSONParsing;
    var strictJSONParsing = !silentJSONParsing && this.responseType === 'json';

    if (strictJSONParsing || (forcedJSONParsing && utils.isString(data) && data.length)) {
      try {
        return JSON.parse(data);
      } catch (e) {
        if (strictJSONParsing) {
          if (e.name === 'SyntaxError') {
            throw AxiosError.from(e, AxiosError.ERR_BAD_RESPONSE, this, null, this.response);
          }
          throw e;
        }
      }
    }

    return data;
  }],

  /**
   * A timeout in milliseconds to abort a request. If set to 0 (default) a
   * timeout is not created.
   */
  timeout: 0,

  xsrfCookieName: 'XSRF-TOKEN',
  xsrfHeaderName: 'X-XSRF-TOKEN',

  maxContentLength: -1,
  maxBodyLength: -1,

  env: {
    FormData: __webpack_require__(/*! ./env/FormData */ "../../../../../../node_modules/axios/lib/helpers/null.js")
  },

  validateStatus: function validateStatus(status) {
    return status >= 200 && status < 300;
  },

  headers: {
    common: {
      'Accept': 'application/json, text/plain, */*'
    }
  }
};

utils.forEach(['delete', 'get', 'head'], function forEachMethodNoData(method) {
  defaults.headers[method] = {};
});

utils.forEach(['post', 'put', 'patch'], function forEachMethodWithData(method) {
  defaults.headers[method] = utils.merge(DEFAULT_CONTENT_TYPE);
});

module.exports = defaults;


/***/ }),

/***/ "../../../../../../node_modules/axios/lib/defaults/transitional.js":
/*!*************************************************************************!*\
  !*** ../../../../../../node_modules/axios/lib/defaults/transitional.js ***!
  \*************************************************************************/
/***/ ((module) => {

"use strict";


module.exports = {
  silentJSONParsing: true,
  forcedJSONParsing: true,
  clarifyTimeoutError: false
};


/***/ }),

/***/ "../../../../../../node_modules/axios/lib/env/data.js":
/*!************************************************************!*\
  !*** ../../../../../../node_modules/axios/lib/env/data.js ***!
  \************************************************************/
/***/ ((module) => {

module.exports = {
  "version": "0.27.2"
};

/***/ }),

/***/ "../../../../../../node_modules/axios/lib/helpers/bind.js":
/*!****************************************************************!*\
  !*** ../../../../../../node_modules/axios/lib/helpers/bind.js ***!
  \****************************************************************/
/***/ ((module) => {

"use strict";


module.exports = function bind(fn, thisArg) {
  return function wrap() {
    var args = new Array(arguments.length);
    for (var i = 0; i < args.length; i++) {
      args[i] = arguments[i];
    }
    return fn.apply(thisArg, args);
  };
};


/***/ }),

/***/ "../../../../../../node_modules/axios/lib/helpers/buildURL.js":
/*!********************************************************************!*\
  !*** ../../../../../../node_modules/axios/lib/helpers/buildURL.js ***!
  \********************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var utils = __webpack_require__(/*! ./../utils */ "../../../../../../node_modules/axios/lib/utils.js");

function encode(val) {
  return encodeURIComponent(val).
    replace(/%3A/gi, ':').
    replace(/%24/g, '$').
    replace(/%2C/gi, ',').
    replace(/%20/g, '+').
    replace(/%5B/gi, '[').
    replace(/%5D/gi, ']');
}

/**
 * Build a URL by appending params to the end
 *
 * @param {string} url The base of the url (e.g., http://www.google.com)
 * @param {object} [params] The params to be appended
 * @returns {string} The formatted url
 */
module.exports = function buildURL(url, params, paramsSerializer) {
  /*eslint no-param-reassign:0*/
  if (!params) {
    return url;
  }

  var serializedParams;
  if (paramsSerializer) {
    serializedParams = paramsSerializer(params);
  } else if (utils.isURLSearchParams(params)) {
    serializedParams = params.toString();
  } else {
    var parts = [];

    utils.forEach(params, function serialize(val, key) {
      if (val === null || typeof val === 'undefined') {
        return;
      }

      if (utils.isArray(val)) {
        key = key + '[]';
      } else {
        val = [val];
      }

      utils.forEach(val, function parseValue(v) {
        if (utils.isDate(v)) {
          v = v.toISOString();
        } else if (utils.isObject(v)) {
          v = JSON.stringify(v);
        }
        parts.push(encode(key) + '=' + encode(v));
      });
    });

    serializedParams = parts.join('&');
  }

  if (serializedParams) {
    var hashmarkIndex = url.indexOf('#');
    if (hashmarkIndex !== -1) {
      url = url.slice(0, hashmarkIndex);
    }

    url += (url.indexOf('?') === -1 ? '?' : '&') + serializedParams;
  }

  return url;
};


/***/ }),

/***/ "../../../../../../node_modules/axios/lib/helpers/combineURLs.js":
/*!***********************************************************************!*\
  !*** ../../../../../../node_modules/axios/lib/helpers/combineURLs.js ***!
  \***********************************************************************/
/***/ ((module) => {

"use strict";


/**
 * Creates a new URL by combining the specified URLs
 *
 * @param {string} baseURL The base URL
 * @param {string} relativeURL The relative URL
 * @returns {string} The combined URL
 */
module.exports = function combineURLs(baseURL, relativeURL) {
  return relativeURL
    ? baseURL.replace(/\/+$/, '') + '/' + relativeURL.replace(/^\/+/, '')
    : baseURL;
};


/***/ }),

/***/ "../../../../../../node_modules/axios/lib/helpers/cookies.js":
/*!*******************************************************************!*\
  !*** ../../../../../../node_modules/axios/lib/helpers/cookies.js ***!
  \*******************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var utils = __webpack_require__(/*! ./../utils */ "../../../../../../node_modules/axios/lib/utils.js");

module.exports = (
  utils.isStandardBrowserEnv() ?

  // Standard browser envs support document.cookie
    (function standardBrowserEnv() {
      return {
        write: function write(name, value, expires, path, domain, secure) {
          var cookie = [];
          cookie.push(name + '=' + encodeURIComponent(value));

          if (utils.isNumber(expires)) {
            cookie.push('expires=' + new Date(expires).toGMTString());
          }

          if (utils.isString(path)) {
            cookie.push('path=' + path);
          }

          if (utils.isString(domain)) {
            cookie.push('domain=' + domain);
          }

          if (secure === true) {
            cookie.push('secure');
          }

          document.cookie = cookie.join('; ');
        },

        read: function read(name) {
          var match = document.cookie.match(new RegExp('(^|;\\s*)(' + name + ')=([^;]*)'));
          return (match ? decodeURIComponent(match[3]) : null);
        },

        remove: function remove(name) {
          this.write(name, '', Date.now() - 86400000);
        }
      };
    })() :

  // Non standard browser env (web workers, react-native) lack needed support.
    (function nonStandardBrowserEnv() {
      return {
        write: function write() {},
        read: function read() { return null; },
        remove: function remove() {}
      };
    })()
);


/***/ }),

/***/ "../../../../../../node_modules/axios/lib/helpers/isAbsoluteURL.js":
/*!*************************************************************************!*\
  !*** ../../../../../../node_modules/axios/lib/helpers/isAbsoluteURL.js ***!
  \*************************************************************************/
/***/ ((module) => {

"use strict";


/**
 * Determines whether the specified URL is absolute
 *
 * @param {string} url The URL to test
 * @returns {boolean} True if the specified URL is absolute, otherwise false
 */
module.exports = function isAbsoluteURL(url) {
  // A URL is considered absolute if it begins with "<scheme>://" or "//" (protocol-relative URL).
  // RFC 3986 defines scheme name as a sequence of characters beginning with a letter and followed
  // by any combination of letters, digits, plus, period, or hyphen.
  return /^([a-z][a-z\d+\-.]*:)?\/\//i.test(url);
};


/***/ }),

/***/ "../../../../../../node_modules/axios/lib/helpers/isAxiosError.js":
/*!************************************************************************!*\
  !*** ../../../../../../node_modules/axios/lib/helpers/isAxiosError.js ***!
  \************************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var utils = __webpack_require__(/*! ./../utils */ "../../../../../../node_modules/axios/lib/utils.js");

/**
 * Determines whether the payload is an error thrown by Axios
 *
 * @param {*} payload The value to test
 * @returns {boolean} True if the payload is an error thrown by Axios, otherwise false
 */
module.exports = function isAxiosError(payload) {
  return utils.isObject(payload) && (payload.isAxiosError === true);
};


/***/ }),

/***/ "../../../../../../node_modules/axios/lib/helpers/isURLSameOrigin.js":
/*!***************************************************************************!*\
  !*** ../../../../../../node_modules/axios/lib/helpers/isURLSameOrigin.js ***!
  \***************************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var utils = __webpack_require__(/*! ./../utils */ "../../../../../../node_modules/axios/lib/utils.js");

module.exports = (
  utils.isStandardBrowserEnv() ?

  // Standard browser envs have full support of the APIs needed to test
  // whether the request URL is of the same origin as current location.
    (function standardBrowserEnv() {
      var msie = /(msie|trident)/i.test(navigator.userAgent);
      var urlParsingNode = document.createElement('a');
      var originURL;

      /**
    * Parse a URL to discover it's components
    *
    * @param {String} url The URL to be parsed
    * @returns {Object}
    */
      function resolveURL(url) {
        var href = url;

        if (msie) {
        // IE needs attribute set twice to normalize properties
          urlParsingNode.setAttribute('href', href);
          href = urlParsingNode.href;
        }

        urlParsingNode.setAttribute('href', href);

        // urlParsingNode provides the UrlUtils interface - http://url.spec.whatwg.org/#urlutils
        return {
          href: urlParsingNode.href,
          protocol: urlParsingNode.protocol ? urlParsingNode.protocol.replace(/:$/, '') : '',
          host: urlParsingNode.host,
          search: urlParsingNode.search ? urlParsingNode.search.replace(/^\?/, '') : '',
          hash: urlParsingNode.hash ? urlParsingNode.hash.replace(/^#/, '') : '',
          hostname: urlParsingNode.hostname,
          port: urlParsingNode.port,
          pathname: (urlParsingNode.pathname.charAt(0) === '/') ?
            urlParsingNode.pathname :
            '/' + urlParsingNode.pathname
        };
      }

      originURL = resolveURL(window.location.href);

      /**
    * Determine if a URL shares the same origin as the current location
    *
    * @param {String} requestURL The URL to test
    * @returns {boolean} True if URL shares the same origin, otherwise false
    */
      return function isURLSameOrigin(requestURL) {
        var parsed = (utils.isString(requestURL)) ? resolveURL(requestURL) : requestURL;
        return (parsed.protocol === originURL.protocol &&
            parsed.host === originURL.host);
      };
    })() :

  // Non standard browser envs (web workers, react-native) lack needed support.
    (function nonStandardBrowserEnv() {
      return function isURLSameOrigin() {
        return true;
      };
    })()
);


/***/ }),

/***/ "../../../../../../node_modules/axios/lib/helpers/normalizeHeaderName.js":
/*!*******************************************************************************!*\
  !*** ../../../../../../node_modules/axios/lib/helpers/normalizeHeaderName.js ***!
  \*******************************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var utils = __webpack_require__(/*! ../utils */ "../../../../../../node_modules/axios/lib/utils.js");

module.exports = function normalizeHeaderName(headers, normalizedName) {
  utils.forEach(headers, function processHeader(value, name) {
    if (name !== normalizedName && name.toUpperCase() === normalizedName.toUpperCase()) {
      headers[normalizedName] = value;
      delete headers[name];
    }
  });
};


/***/ }),

/***/ "../../../../../../node_modules/axios/lib/helpers/null.js":
/*!****************************************************************!*\
  !*** ../../../../../../node_modules/axios/lib/helpers/null.js ***!
  \****************************************************************/
/***/ ((module) => {

// eslint-disable-next-line strict
module.exports = null;


/***/ }),

/***/ "../../../../../../node_modules/axios/lib/helpers/parseHeaders.js":
/*!************************************************************************!*\
  !*** ../../../../../../node_modules/axios/lib/helpers/parseHeaders.js ***!
  \************************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var utils = __webpack_require__(/*! ./../utils */ "../../../../../../node_modules/axios/lib/utils.js");

// Headers whose duplicates are ignored by node
// c.f. https://nodejs.org/api/http.html#http_message_headers
var ignoreDuplicateOf = [
  'age', 'authorization', 'content-length', 'content-type', 'etag',
  'expires', 'from', 'host', 'if-modified-since', 'if-unmodified-since',
  'last-modified', 'location', 'max-forwards', 'proxy-authorization',
  'referer', 'retry-after', 'user-agent'
];

/**
 * Parse headers into an object
 *
 * ```
 * Date: Wed, 27 Aug 2014 08:58:49 GMT
 * Content-Type: application/json
 * Connection: keep-alive
 * Transfer-Encoding: chunked
 * ```
 *
 * @param {String} headers Headers needing to be parsed
 * @returns {Object} Headers parsed into an object
 */
module.exports = function parseHeaders(headers) {
  var parsed = {};
  var key;
  var val;
  var i;

  if (!headers) { return parsed; }

  utils.forEach(headers.split('\n'), function parser(line) {
    i = line.indexOf(':');
    key = utils.trim(line.substr(0, i)).toLowerCase();
    val = utils.trim(line.substr(i + 1));

    if (key) {
      if (parsed[key] && ignoreDuplicateOf.indexOf(key) >= 0) {
        return;
      }
      if (key === 'set-cookie') {
        parsed[key] = (parsed[key] ? parsed[key] : []).concat([val]);
      } else {
        parsed[key] = parsed[key] ? parsed[key] + ', ' + val : val;
      }
    }
  });

  return parsed;
};


/***/ }),

/***/ "../../../../../../node_modules/axios/lib/helpers/parseProtocol.js":
/*!*************************************************************************!*\
  !*** ../../../../../../node_modules/axios/lib/helpers/parseProtocol.js ***!
  \*************************************************************************/
/***/ ((module) => {

"use strict";


module.exports = function parseProtocol(url) {
  var match = /^([-+\w]{1,25})(:?\/\/|:)/.exec(url);
  return match && match[1] || '';
};


/***/ }),

/***/ "../../../../../../node_modules/axios/lib/helpers/spread.js":
/*!******************************************************************!*\
  !*** ../../../../../../node_modules/axios/lib/helpers/spread.js ***!
  \******************************************************************/
/***/ ((module) => {

"use strict";


/**
 * Syntactic sugar for invoking a function and expanding an array for arguments.
 *
 * Common use case would be to use `Function.prototype.apply`.
 *
 *  ```js
 *  function f(x, y, z) {}
 *  var args = [1, 2, 3];
 *  f.apply(null, args);
 *  ```
 *
 * With `spread` this example can be re-written.
 *
 *  ```js
 *  spread(function(x, y, z) {})([1, 2, 3]);
 *  ```
 *
 * @param {Function} callback
 * @returns {Function}
 */
module.exports = function spread(callback) {
  return function wrap(arr) {
    return callback.apply(null, arr);
  };
};


/***/ }),

/***/ "../../../../../../node_modules/axios/lib/helpers/toFormData.js":
/*!**********************************************************************!*\
  !*** ../../../../../../node_modules/axios/lib/helpers/toFormData.js ***!
  \**********************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var utils = __webpack_require__(/*! ../utils */ "../../../../../../node_modules/axios/lib/utils.js");

/**
 * Convert a data object to FormData
 * @param {Object} obj
 * @param {?Object} [formData]
 * @returns {Object}
 **/

function toFormData(obj, formData) {
  // eslint-disable-next-line no-param-reassign
  formData = formData || new FormData();

  var stack = [];

  function convertValue(value) {
    if (value === null) return '';

    if (utils.isDate(value)) {
      return value.toISOString();
    }

    if (utils.isArrayBuffer(value) || utils.isTypedArray(value)) {
      return typeof Blob === 'function' ? new Blob([value]) : Buffer.from(value);
    }

    return value;
  }

  function build(data, parentKey) {
    if (utils.isPlainObject(data) || utils.isArray(data)) {
      if (stack.indexOf(data) !== -1) {
        throw Error('Circular reference detected in ' + parentKey);
      }

      stack.push(data);

      utils.forEach(data, function each(value, key) {
        if (utils.isUndefined(value)) return;
        var fullKey = parentKey ? parentKey + '.' + key : key;
        var arr;

        if (value && !parentKey && typeof value === 'object') {
          if (utils.endsWith(key, '{}')) {
            // eslint-disable-next-line no-param-reassign
            value = JSON.stringify(value);
          } else if (utils.endsWith(key, '[]') && (arr = utils.toArray(value))) {
            // eslint-disable-next-line func-names
            arr.forEach(function(el) {
              !utils.isUndefined(el) && formData.append(fullKey, convertValue(el));
            });
            return;
          }
        }

        build(value, fullKey);
      });

      stack.pop();
    } else {
      formData.append(parentKey, convertValue(data));
    }
  }

  build(obj);

  return formData;
}

module.exports = toFormData;


/***/ }),

/***/ "../../../../../../node_modules/axios/lib/helpers/validator.js":
/*!*********************************************************************!*\
  !*** ../../../../../../node_modules/axios/lib/helpers/validator.js ***!
  \*********************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var VERSION = (__webpack_require__(/*! ../env/data */ "../../../../../../node_modules/axios/lib/env/data.js").version);
var AxiosError = __webpack_require__(/*! ../core/AxiosError */ "../../../../../../node_modules/axios/lib/core/AxiosError.js");

var validators = {};

// eslint-disable-next-line func-names
['object', 'boolean', 'number', 'function', 'string', 'symbol'].forEach(function(type, i) {
  validators[type] = function validator(thing) {
    return typeof thing === type || 'a' + (i < 1 ? 'n ' : ' ') + type;
  };
});

var deprecatedWarnings = {};

/**
 * Transitional option validator
 * @param {function|boolean?} validator - set to false if the transitional option has been removed
 * @param {string?} version - deprecated version / removed since version
 * @param {string?} message - some message with additional info
 * @returns {function}
 */
validators.transitional = function transitional(validator, version, message) {
  function formatMessage(opt, desc) {
    return '[Axios v' + VERSION + '] Transitional option \'' + opt + '\'' + desc + (message ? '. ' + message : '');
  }

  // eslint-disable-next-line func-names
  return function(value, opt, opts) {
    if (validator === false) {
      throw new AxiosError(
        formatMessage(opt, ' has been removed' + (version ? ' in ' + version : '')),
        AxiosError.ERR_DEPRECATED
      );
    }

    if (version && !deprecatedWarnings[opt]) {
      deprecatedWarnings[opt] = true;
      // eslint-disable-next-line no-console
      console.warn(
        formatMessage(
          opt,
          ' has been deprecated since v' + version + ' and will be removed in the near future'
        )
      );
    }

    return validator ? validator(value, opt, opts) : true;
  };
};

/**
 * Assert object's properties type
 * @param {object} options
 * @param {object} schema
 * @param {boolean?} allowUnknown
 */

function assertOptions(options, schema, allowUnknown) {
  if (typeof options !== 'object') {
    throw new AxiosError('options must be an object', AxiosError.ERR_BAD_OPTION_VALUE);
  }
  var keys = Object.keys(options);
  var i = keys.length;
  while (i-- > 0) {
    var opt = keys[i];
    var validator = schema[opt];
    if (validator) {
      var value = options[opt];
      var result = value === undefined || validator(value, opt, options);
      if (result !== true) {
        throw new AxiosError('option ' + opt + ' must be ' + result, AxiosError.ERR_BAD_OPTION_VALUE);
      }
      continue;
    }
    if (allowUnknown !== true) {
      throw new AxiosError('Unknown option ' + opt, AxiosError.ERR_BAD_OPTION);
    }
  }
}

module.exports = {
  assertOptions: assertOptions,
  validators: validators
};


/***/ }),

/***/ "../../../../../../node_modules/axios/lib/utils.js":
/*!*********************************************************!*\
  !*** ../../../../../../node_modules/axios/lib/utils.js ***!
  \*********************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var bind = __webpack_require__(/*! ./helpers/bind */ "../../../../../../node_modules/axios/lib/helpers/bind.js");

// utils is a library of generic helper functions non-specific to axios

var toString = Object.prototype.toString;

// eslint-disable-next-line func-names
var kindOf = (function(cache) {
  // eslint-disable-next-line func-names
  return function(thing) {
    var str = toString.call(thing);
    return cache[str] || (cache[str] = str.slice(8, -1).toLowerCase());
  };
})(Object.create(null));

function kindOfTest(type) {
  type = type.toLowerCase();
  return function isKindOf(thing) {
    return kindOf(thing) === type;
  };
}

/**
 * Determine if a value is an Array
 *
 * @param {Object} val The value to test
 * @returns {boolean} True if value is an Array, otherwise false
 */
function isArray(val) {
  return Array.isArray(val);
}

/**
 * Determine if a value is undefined
 *
 * @param {Object} val The value to test
 * @returns {boolean} True if the value is undefined, otherwise false
 */
function isUndefined(val) {
  return typeof val === 'undefined';
}

/**
 * Determine if a value is a Buffer
 *
 * @param {Object} val The value to test
 * @returns {boolean} True if value is a Buffer, otherwise false
 */
function isBuffer(val) {
  return val !== null && !isUndefined(val) && val.constructor !== null && !isUndefined(val.constructor)
    && typeof val.constructor.isBuffer === 'function' && val.constructor.isBuffer(val);
}

/**
 * Determine if a value is an ArrayBuffer
 *
 * @function
 * @param {Object} val The value to test
 * @returns {boolean} True if value is an ArrayBuffer, otherwise false
 */
var isArrayBuffer = kindOfTest('ArrayBuffer');


/**
 * Determine if a value is a view on an ArrayBuffer
 *
 * @param {Object} val The value to test
 * @returns {boolean} True if value is a view on an ArrayBuffer, otherwise false
 */
function isArrayBufferView(val) {
  var result;
  if ((typeof ArrayBuffer !== 'undefined') && (ArrayBuffer.isView)) {
    result = ArrayBuffer.isView(val);
  } else {
    result = (val) && (val.buffer) && (isArrayBuffer(val.buffer));
  }
  return result;
}

/**
 * Determine if a value is a String
 *
 * @param {Object} val The value to test
 * @returns {boolean} True if value is a String, otherwise false
 */
function isString(val) {
  return typeof val === 'string';
}

/**
 * Determine if a value is a Number
 *
 * @param {Object} val The value to test
 * @returns {boolean} True if value is a Number, otherwise false
 */
function isNumber(val) {
  return typeof val === 'number';
}

/**
 * Determine if a value is an Object
 *
 * @param {Object} val The value to test
 * @returns {boolean} True if value is an Object, otherwise false
 */
function isObject(val) {
  return val !== null && typeof val === 'object';
}

/**
 * Determine if a value is a plain Object
 *
 * @param {Object} val The value to test
 * @return {boolean} True if value is a plain Object, otherwise false
 */
function isPlainObject(val) {
  if (kindOf(val) !== 'object') {
    return false;
  }

  var prototype = Object.getPrototypeOf(val);
  return prototype === null || prototype === Object.prototype;
}

/**
 * Determine if a value is a Date
 *
 * @function
 * @param {Object} val The value to test
 * @returns {boolean} True if value is a Date, otherwise false
 */
var isDate = kindOfTest('Date');

/**
 * Determine if a value is a File
 *
 * @function
 * @param {Object} val The value to test
 * @returns {boolean} True if value is a File, otherwise false
 */
var isFile = kindOfTest('File');

/**
 * Determine if a value is a Blob
 *
 * @function
 * @param {Object} val The value to test
 * @returns {boolean} True if value is a Blob, otherwise false
 */
var isBlob = kindOfTest('Blob');

/**
 * Determine if a value is a FileList
 *
 * @function
 * @param {Object} val The value to test
 * @returns {boolean} True if value is a File, otherwise false
 */
var isFileList = kindOfTest('FileList');

/**
 * Determine if a value is a Function
 *
 * @param {Object} val The value to test
 * @returns {boolean} True if value is a Function, otherwise false
 */
function isFunction(val) {
  return toString.call(val) === '[object Function]';
}

/**
 * Determine if a value is a Stream
 *
 * @param {Object} val The value to test
 * @returns {boolean} True if value is a Stream, otherwise false
 */
function isStream(val) {
  return isObject(val) && isFunction(val.pipe);
}

/**
 * Determine if a value is a FormData
 *
 * @param {Object} thing The value to test
 * @returns {boolean} True if value is an FormData, otherwise false
 */
function isFormData(thing) {
  var pattern = '[object FormData]';
  return thing && (
    (typeof FormData === 'function' && thing instanceof FormData) ||
    toString.call(thing) === pattern ||
    (isFunction(thing.toString) && thing.toString() === pattern)
  );
}

/**
 * Determine if a value is a URLSearchParams object
 * @function
 * @param {Object} val The value to test
 * @returns {boolean} True if value is a URLSearchParams object, otherwise false
 */
var isURLSearchParams = kindOfTest('URLSearchParams');

/**
 * Trim excess whitespace off the beginning and end of a string
 *
 * @param {String} str The String to trim
 * @returns {String} The String freed of excess whitespace
 */
function trim(str) {
  return str.trim ? str.trim() : str.replace(/^\s+|\s+$/g, '');
}

/**
 * Determine if we're running in a standard browser environment
 *
 * This allows axios to run in a web worker, and react-native.
 * Both environments support XMLHttpRequest, but not fully standard globals.
 *
 * web workers:
 *  typeof window -> undefined
 *  typeof document -> undefined
 *
 * react-native:
 *  navigator.product -> 'ReactNative'
 * nativescript
 *  navigator.product -> 'NativeScript' or 'NS'
 */
function isStandardBrowserEnv() {
  if (typeof navigator !== 'undefined' && (navigator.product === 'ReactNative' ||
                                           navigator.product === 'NativeScript' ||
                                           navigator.product === 'NS')) {
    return false;
  }
  return (
    typeof window !== 'undefined' &&
    typeof document !== 'undefined'
  );
}

/**
 * Iterate over an Array or an Object invoking a function for each item.
 *
 * If `obj` is an Array callback will be called passing
 * the value, index, and complete array for each item.
 *
 * If 'obj' is an Object callback will be called passing
 * the value, key, and complete object for each property.
 *
 * @param {Object|Array} obj The object to iterate
 * @param {Function} fn The callback to invoke for each item
 */
function forEach(obj, fn) {
  // Don't bother if no value provided
  if (obj === null || typeof obj === 'undefined') {
    return;
  }

  // Force an array if not already something iterable
  if (typeof obj !== 'object') {
    /*eslint no-param-reassign:0*/
    obj = [obj];
  }

  if (isArray(obj)) {
    // Iterate over array values
    for (var i = 0, l = obj.length; i < l; i++) {
      fn.call(null, obj[i], i, obj);
    }
  } else {
    // Iterate over object keys
    for (var key in obj) {
      if (Object.prototype.hasOwnProperty.call(obj, key)) {
        fn.call(null, obj[key], key, obj);
      }
    }
  }
}

/**
 * Accepts varargs expecting each argument to be an object, then
 * immutably merges the properties of each object and returns result.
 *
 * When multiple objects contain the same key the later object in
 * the arguments list will take precedence.
 *
 * Example:
 *
 * ```js
 * var result = merge({foo: 123}, {foo: 456});
 * console.log(result.foo); // outputs 456
 * ```
 *
 * @param {Object} obj1 Object to merge
 * @returns {Object} Result of all merge properties
 */
function merge(/* obj1, obj2, obj3, ... */) {
  var result = {};
  function assignValue(val, key) {
    if (isPlainObject(result[key]) && isPlainObject(val)) {
      result[key] = merge(result[key], val);
    } else if (isPlainObject(val)) {
      result[key] = merge({}, val);
    } else if (isArray(val)) {
      result[key] = val.slice();
    } else {
      result[key] = val;
    }
  }

  for (var i = 0, l = arguments.length; i < l; i++) {
    forEach(arguments[i], assignValue);
  }
  return result;
}

/**
 * Extends object a by mutably adding to it the properties of object b.
 *
 * @param {Object} a The object to be extended
 * @param {Object} b The object to copy properties from
 * @param {Object} thisArg The object to bind function to
 * @return {Object} The resulting value of object a
 */
function extend(a, b, thisArg) {
  forEach(b, function assignValue(val, key) {
    if (thisArg && typeof val === 'function') {
      a[key] = bind(val, thisArg);
    } else {
      a[key] = val;
    }
  });
  return a;
}

/**
 * Remove byte order marker. This catches EF BB BF (the UTF-8 BOM)
 *
 * @param {string} content with BOM
 * @return {string} content value without BOM
 */
function stripBOM(content) {
  if (content.charCodeAt(0) === 0xFEFF) {
    content = content.slice(1);
  }
  return content;
}

/**
 * Inherit the prototype methods from one constructor into another
 * @param {function} constructor
 * @param {function} superConstructor
 * @param {object} [props]
 * @param {object} [descriptors]
 */

function inherits(constructor, superConstructor, props, descriptors) {
  constructor.prototype = Object.create(superConstructor.prototype, descriptors);
  constructor.prototype.constructor = constructor;
  props && Object.assign(constructor.prototype, props);
}

/**
 * Resolve object with deep prototype chain to a flat object
 * @param {Object} sourceObj source object
 * @param {Object} [destObj]
 * @param {Function} [filter]
 * @returns {Object}
 */

function toFlatObject(sourceObj, destObj, filter) {
  var props;
  var i;
  var prop;
  var merged = {};

  destObj = destObj || {};

  do {
    props = Object.getOwnPropertyNames(sourceObj);
    i = props.length;
    while (i-- > 0) {
      prop = props[i];
      if (!merged[prop]) {
        destObj[prop] = sourceObj[prop];
        merged[prop] = true;
      }
    }
    sourceObj = Object.getPrototypeOf(sourceObj);
  } while (sourceObj && (!filter || filter(sourceObj, destObj)) && sourceObj !== Object.prototype);

  return destObj;
}

/*
 * determines whether a string ends with the characters of a specified string
 * @param {String} str
 * @param {String} searchString
 * @param {Number} [position= 0]
 * @returns {boolean}
 */
function endsWith(str, searchString, position) {
  str = String(str);
  if (position === undefined || position > str.length) {
    position = str.length;
  }
  position -= searchString.length;
  var lastIndex = str.indexOf(searchString, position);
  return lastIndex !== -1 && lastIndex === position;
}


/**
 * Returns new array from array like object
 * @param {*} [thing]
 * @returns {Array}
 */
function toArray(thing) {
  if (!thing) return null;
  var i = thing.length;
  if (isUndefined(i)) return null;
  var arr = new Array(i);
  while (i-- > 0) {
    arr[i] = thing[i];
  }
  return arr;
}

// eslint-disable-next-line func-names
var isTypedArray = (function(TypedArray) {
  // eslint-disable-next-line func-names
  return function(thing) {
    return TypedArray && thing instanceof TypedArray;
  };
})(typeof Uint8Array !== 'undefined' && Object.getPrototypeOf(Uint8Array));

module.exports = {
  isArray: isArray,
  isArrayBuffer: isArrayBuffer,
  isBuffer: isBuffer,
  isFormData: isFormData,
  isArrayBufferView: isArrayBufferView,
  isString: isString,
  isNumber: isNumber,
  isObject: isObject,
  isPlainObject: isPlainObject,
  isUndefined: isUndefined,
  isDate: isDate,
  isFile: isFile,
  isBlob: isBlob,
  isFunction: isFunction,
  isStream: isStream,
  isURLSearchParams: isURLSearchParams,
  isStandardBrowserEnv: isStandardBrowserEnv,
  forEach: forEach,
  merge: merge,
  extend: extend,
  trim: trim,
  stripBOM: stripBOM,
  inherits: inherits,
  toFlatObject: toFlatObject,
  kindOf: kindOf,
  kindOfTest: kindOfTest,
  endsWith: endsWith,
  toArray: toArray,
  isTypedArray: isTypedArray,
  isFileList: isFileList
};


/***/ }),

/***/ "./scripts/modules/actions.js":
/*!************************************!*\
  !*** ./scripts/modules/actions.js ***!
  \************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! axios */ "../../../../../../node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_0__);

const Actions = {
  http: null,
  init() {
    let element = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : document;
    this.triggers = Array.from(element.querySelectorAll('[data-action]:not([data-type])'));
    this.http = axios__WEBPACK_IMPORTED_MODULE_0___default().create({
      transformRequest: [data => {
        // Prefix the action name
        data.set('action', `chipmunk_${data.get('action')}`);
        return data;
      }]
    });
    this.triggers.forEach(trigger => {
      if (!trigger.dataset.listening) {
        if (trigger.hasAttribute('action')) {
          trigger.addEventListener('submit', this.handleEvent.bind(this));
        } else {
          trigger.addEventListener('click', this.handleEvent.bind(this));
        }

        // Only bind the event once on this element
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
      trigger.classList.add('is-loading');

      // Disable the current trigger
      trigger.setAttribute('disabled', true);

      // Loop through the actions provided
      actions.forEach(action => {
        const formData = new FormData(trigger.hasAttribute('action') ? trigger : document.createElement('form'));

        // Extend formData with trigger data attributes
        Object.keys(action.data).forEach(key => {
          formData.append(key, action.data[key]);
        });

        // Assign callback function
        action.callback = action.callback || this.callbacks[action.data.action] || (() => {});

        // Assign new request
        requests.push(this.http.post(document.body.dataset.ajaxSource, formData));
      });

      // Run concurrent action
      axios__WEBPACK_IMPORTED_MODULE_0___default().all(requests).then(axios__WEBPACK_IMPORTED_MODULE_0___default().spread(function () {
        for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
          args[_key] = arguments[_key];
        }
        args.forEach((arg, index) => {
          setTimeout(() => {
            actions[index].callback(trigger, arg.data, actions[index].data.action);

            // Disable loading indicator
            trigger.classList.remove('is-loading');

            // Enable the current trigger
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
        const targets = document.querySelectorAll(`[data-action="${action}"][data-action-post-id="${data.post}"]`);
        targets.forEach(target => {
          target.classList[data.status]('is-active');
          target.innerHTML = data.content;
        });
      } else {
        const {
          loginUrl
        } = document.body.dataset;
        if (loginUrl) {
          window.location = loginUrl;
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
      const element = trigger.querySelector(`[data-action-element=${action}]`);
      const message = trigger.querySelector(`[data-action-message=${action}]`);
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
      const element = document.querySelector(`[data-action-element=${action}]`);
      if (element) {
        if (success) {
          element.insertAdjacentHTML('beforeend', data);
          trigger.dataset.page = parseInt(trigger.dataset.page, 10) + 1;
        } else {
          trigger.parentNode.insertAdjacentHTML('beforeend', `<p class="l-header__copy">${data}</p>`);
          trigger.parentNode.removeChild(trigger);
        }

        // Rebind actions listeners
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
      const element = document.querySelector(`[data-action-rating="${data.post}"]`);
      if (element) {
        if (success) {
          element.innerHTML = data.content;
        }
      }
    }
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Actions);

/***/ }),

/***/ "./scripts/modules/carousel.js":
/*!*************************************!*\
  !*** ./scripts/modules/carousel.js ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var flickity__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! flickity */ "../../../../../../node_modules/flickity/js/index.js");
/* harmony import */ var flickity__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(flickity__WEBPACK_IMPORTED_MODULE_0__);

const Carousel = {
  defaults: {
    cellAlign: 'left',
    draggable: true,
    contain: true,
    groupCells: true,
    pageDots: false,
    arrowShape: 'M43.536 11.464a5 5 0 0 1 .415 6.6l-.415.472L17.075 45H95a5 5 0 0 1 .583 9.966L95 55H17.075l26.46 26.464a5 5 0 0 1-6.6 7.487l-.47-.415-35-35a5.04 5.04 0 0 1-.483-.56l-.359-.556-.267-.563-.177-.527-.145-.743L0 50l.014-.376.087-.628.148-.557.22-.555.261-.488.335-.481.4-.45 35-35a5 5 0 0 1 7.07 0Z'
  },
  init() {
    let element = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : document;
    const carousels = Array.from(element.querySelectorAll('[data-carousel]'));

    // Defer initializing the carousel to make sure the fonts and images are loaded
    window.addEventListener('load', () => {
      carousels.forEach(carousel => {
        this.initCarousel(carousel, carousel.dataset.carousel ? JSON.parse(carousel.dataset.carousel) : {});
      });
    });

    // Refresh carousel on tab change
    window.addEventListener('tabs:show', ev => {
      const {
        hash
      } = ev.detail;
      if (hash) {
        const flkty = flickity__WEBPACK_IMPORTED_MODULE_0___default().data(`${hash} [data-carousel]`);
        if (flkty) {
          flkty.resize();
        }
      }
    });

    /* eslint no-underscore-dangle: 0 */
    /* eslint func-names: 'off' */
    (flickity__WEBPACK_IMPORTED_MODULE_0___default().prototype._createResizeClass) = function () {
      this.element.classList.add('flickity-resize');
    };
    flickity__WEBPACK_IMPORTED_MODULE_0___default().createMethods.push('_createResizeClass');
    const {
      resize
    } = (flickity__WEBPACK_IMPORTED_MODULE_0___default().prototype);
    (flickity__WEBPACK_IMPORTED_MODULE_0___default().prototype.resize) = function () {
      this.element.classList.remove('flickity-resize');
      resize.call(this);
      this.element.classList.add('flickity-resize');
    };
  },
  initCarousel(carousel) {
    let options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
    if (carousel.childElementCount > 1) {
      new (flickity__WEBPACK_IMPORTED_MODULE_0___default())(carousel, {
        ...Carousel.defaults,
        ...options
      });
    }
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Carousel);

/***/ }),

/***/ "./scripts/modules/consents.js":
/*!*************************************!*\
  !*** ./scripts/modules/consents.js ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const Consents = {
  init() {
    let element = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : document;
    this.consents = Array.from(element.querySelectorAll('[data-consent]'));
    this.consents.forEach(consent => {
      const form = consent.closest('form');
      const fields = Array.from(form.querySelectorAll('input, textarea'));
      form.addEventListener('submit', () => {
        consent.classList.add('is-visible');
      });
      fields.forEach(field => {
        field.addEventListener('focus', () => {
          consent.classList.add('is-visible');
        });
      });
    });
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Consents);

/***/ }),

/***/ "./scripts/modules/dropdown.js":
/*!*************************************!*\
  !*** ./scripts/modules/dropdown.js ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const Dropdown = {
  init() {
    let element = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : document;
    this.triggers = Array.from(element.querySelectorAll('[data-dropdown]'));
    this.triggers.forEach(trigger => {
      const event = trigger.dataset.dropdown;
      if (event === 'click') {
        trigger.addEventListener(event, ev => this.handleDropdown.call(this, ev, ev.currentTarget.parentNode), false);
      } else {
        trigger.addEventListener('mouseover', ev => this.handleDropdown.call(this, ev, ev.currentTarget, 'add'), false);
        trigger.addEventListener('mouseout', ev => this.handleDropdown.call(this, ev, ev.currentTarget, 'remove'), false);
      }
    });
    element.addEventListener('dropdown:close', this.closeDropdowns.bind(this), false);
  },
  handleDropdown(ev, element) {
    let method = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'toggle';
    if (ev) {
      ev.preventDefault();

      // Close other dropdowns
      this.closeDropdowns(element);
    }

    // Update dropdown class
    element.classList[method]('is-open');
  },
  closeDropdowns(exclude) {
    this.triggers.forEach(trigger => {
      if (trigger !== exclude && trigger.parentNode !== exclude) {
        this.handleDropdown(null, trigger, 'remove');
        this.handleDropdown(null, trigger.parentNode, 'remove');
      }
    });
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Dropdown);

/***/ }),

/***/ "./scripts/modules/dynamic-rows.js":
/*!*****************************************!*\
  !*** ./scripts/modules/dynamic-rows.js ***!
  \*****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const DynamicRows = {
  options: {
    rows: 5
  },
  init() {
    let element = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : document;
    this.inputs = Array.from(element.querySelectorAll('[data-dynamic-rows]'));
    this.inputs.forEach(input => {
      input.addEventListener('keyup', this.updateRows.bind(this, input));
    });
    window.addEventListener('load', () => {
      this.inputs.forEach(input => {
        this.updateRows(input);
      });
    });
  },
  updateRows(input) {
    if (!input.value) {
      return;
    }
    const style = window.getComputedStyle(input);
    const lineHeight = parseInt(style.getPropertyValue('line-height'), 10);
    const padding = parseInt(style.getPropertyValue('padding-top'), 10) + parseInt(style.getPropertyValue('padding-bottom'), 10);
    const rowLimit = parseInt(input.dataset.dynamicRows ?? this.options.rows, 10);
    const rows = parseInt((input.scrollHeight - padding) / lineHeight, 10);
    input.setAttribute('rows', rows > rowLimit ? rowLimit : rows);
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (DynamicRows);

/***/ }),

/***/ "./scripts/modules/events.js":
/*!***********************************!*\
  !*** ./scripts/modules/events.js ***!
  \***********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var lodash_throttle__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! lodash.throttle */ "../../../../../../node_modules/lodash.throttle/index.js");
/* harmony import */ var lodash_throttle__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(lodash_throttle__WEBPACK_IMPORTED_MODULE_0__);

const Events = {
  heightCalculated: false,
  init() {
    window.onload = () => setTimeout(this.handleLoad(), 250);
    window.onresize = lodash_throttle__WEBPACK_IMPORTED_MODULE_0___default()(this.handleResize, 200);
    window.onscroll = lodash_throttle__WEBPACK_IMPORTED_MODULE_0___default()(this.handleScroll, 50);
  },
  handleLoad() {
    Events.calculatePlaceholderHeight();
    Events.calculateScrollbarWidth();
    Events.handleScrollStatus();
  },
  handleResize() {
    Events.calculateScrollbarWidth();
    if (document.documentElement.scrollTop === 0) {
      Events.calculatePlaceholderHeight();
    }
  },
  handleScroll() {
    Events.handleScrollStatus();
  },
  /* Private functions */
  calculatePlaceholderHeight() {
    const root = document.documentElement;
    const objects = Array.from(document.querySelectorAll('[data-placehold-height]'));
    objects.forEach(object => {
      const name = object.dataset.placeholdHeight;
      root.style.setProperty(`--${name}-height`, `${object.clientHeight}px`);
      if (object.classList.contains('is-sticky')) {
        object.style.setProperty('position', 'fixed');
      }
    });
    this.heightCalculated = true;
  },
  calculateScrollbarWidth() {
    const root = document.documentElement;
    root.style.setProperty('--scrollbar-width', `${window.innerWidth - root.clientWidth}px`);
  },
  handleScrollStatus() {
    if (!this.heightCalculated) {
      return;
    }
    const body = document.documentElement;
    const scrolledClass = 'is-condensed';
    const offset = 50;
    const currentScroll = body.scrollTop;
    body.classList.toggle(scrolledClass, currentScroll > offset);
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Events);

/***/ }),

/***/ "./scripts/modules/expander.js":
/*!*************************************!*\
  !*** ./scripts/modules/expander.js ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const Expander = {
  init() {
    let element = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : document;
    this.triggers = Array.from(element.querySelectorAll('[data-expand]'));
    this.triggers.forEach(trigger => {
      trigger.addEventListener('click', this.handleExpander);
    });
  },
  handleExpander(ev) {
    ev.preventDefault();
    const target = document.querySelector(ev.currentTarget.dataset.expand);
    if (target) {
      target.classList.toggle('is-expanded');
    }
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Expander);

/***/ }),

/***/ "./scripts/modules/filter.js":
/*!***********************************!*\
  !*** ./scripts/modules/filter.js ***!
  \***********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var query_string__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! query-string */ "../../../../../../node_modules/query-string/index.js");

const Filter = {
  init() {
    let element = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : document;
    this.filters = Array.from(element.querySelectorAll('[data-filter]'));
    this.filters.forEach(filter => {
      filter.onchange = this.filterResults.bind(this);
    });
  },
  filterResults() {
    const params = query_string__WEBPACK_IMPORTED_MODULE_0__.parse(window.location.search);
    this.filters.forEach(filter => {
      const name = filter.dataset.filter;
      const {
        value
      } = filter;
      if (value !== '') {
        params[name] = value;
      } else {
        delete params[name];
      }
    });
    const search = query_string__WEBPACK_IMPORTED_MODULE_0__.stringify(params);
    const pageRegex = /\/page\/[0-9]+\//g;
    if (params.tag) {
      window.location.href = `${window.location.origin + window.location.pathname.replace(pageRegex, '/')}?${search}`;
    } else {
      window.location.search = search;
    }
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Filter);

/***/ }),

/***/ "./scripts/modules/panel.js":
/*!**********************************!*\
  !*** ./scripts/modules/panel.js ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const Panel = {
  init() {
    let element = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : document;
    this.triggers = Array.from(element.querySelectorAll('[data-panel]'));
    this.triggers.forEach(trigger => {
      trigger.addEventListener('click', this.handlePanel);
    });
    document.addEventListener('panel:close', this.closePanels.bind(this));
  },
  handlePanel(ev) {
    ev.preventDefault();
    const trigger = ev.currentTarget.dataset.panel;
    document.documentElement.classList.toggle(`has-${trigger}-open`);
  },
  closePanels() {
    this.triggers.forEach(trigger => {
      const triggerPanel = trigger.dataset.panel;
      const documentClasses = document.documentElement.classList;
      if (documentClasses.contains(`has-${triggerPanel}-open`)) {
        documentClasses.remove(`has-${triggerPanel}-open`);
      }
    });
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Panel);

/***/ }),

/***/ "./scripts/modules/popup.js":
/*!**********************************!*\
  !*** ./scripts/modules/popup.js ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const Popup = {
  init() {
    let element = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : document;
    this.triggers = Array.from(element.querySelectorAll('[data-popup]'));
    this.triggers.forEach(trigger => {
      trigger.removeEventListener('click', this.handlePopup);
      trigger.addEventListener('click', this.handlePopup);
    });
    window.addEventListener('load', this.handleHash.bind(this), false);
    document.addEventListener('popup:close', this.closePopup.bind(this));
  },
  handlePopup(ev) {
    let instance = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
    ev.preventDefault();
    const trigger = ev.currentTarget;
    const target = instance || trigger.dataset.popup;
    if (trigger && target) {
      Popup.openPopup();
    } else {
      Popup.closePopup();
    }
  },
  openPopup(ev) {
    if (ev) {
      ev.preventDefault();
    }

    // Add popup class
    document.body.classList.add('has-popup-open');

    // Add location hash
    window.history.pushState(null, null, '#submit');
  },
  closePopup() {
    // Remove popup class
    document.body.classList.remove('has-popup-open');

    // Remove location hash
    window.history.pushState(null, null, ' ');

    // Clear form
    setTimeout(() => this.clearForm(), 500);
  },
  handleHash() {
    if (window.location.hash === '#submit') {
      this.openPopup();
    }
  },
  clearForm() {
    const popup = document.querySelector('[data-popup-content]');
    if (popup) {
      const form = popup.querySelector('[data-action]');
      const element = popup.querySelector('[data-action-element]');
      const message = popup.querySelector('[data-action-message]');
      if (form && element && message && message.innerHTML) {
        // Clear form
        form.reset();

        // Show form fields
        element.style.display = null;

        // Clear message
        message.innerHTML = '';
      }
    }
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Popup);

/***/ }),

/***/ "./scripts/modules/ratings.js":
/*!************************************!*\
  !*** ./scripts/modules/ratings.js ***!
  \************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const Ratings = {
  init() {
    let element = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : document;
    this.triggers = Array.from(element.querySelectorAll('[data-rating]'));
    this.triggers.forEach(trigger => {
      trigger.addEventListener('click', this.handleClick);
    });
  },
  handleClick(ev) {
    const button = ev.currentTarget;
    const parent = button.parentNode;
    const children = Array.from(parent.children);
    children.forEach(el => {
      el.classList.toggle('is-active', el === button);
    });
    parent.classList.add('is-active');
    ev.preventDefault();
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Ratings);

/***/ }),

/***/ "./scripts/modules/tabs.js":
/*!*********************************!*\
  !*** ./scripts/modules/tabs.js ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* eslint-disable no-param-reassign */

const Tabs = {
  tabs: [],
  init() {
    let element = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : document;
    this.tabs = Array.from(element.querySelectorAll('[data-tabs]'));
    this.tabs.forEach(tabs => {
      tabs.toggles = Array.from(tabs.querySelectorAll('[data-tabs-toggle]'));
      tabs.panels = Array.from(tabs.querySelectorAll('[data-tabs-panel]'));
      this.bindTabs(tabs);
    });
    if (this.tabs.length === 1) {
      window.addEventListener('hashchange', () => {
        if (window.location.hash) {
          this.showTab(this.tabs[0], window.location.hash);
        }
      });
      window.addEventListener('tabs:show', e => {
        if (window.history.pushState && e.detail.hash) {
          window.history.pushState(null, null, e.detail.hash);
        }
      });
      if (window.location.hash) {
        window.addEventListener('load', this.showTab(this.tabs[0], window.location.hash), false);
      }
    }
  },
  bindTabs(tabs) {
    tabs.toggles.forEach(toggle => {
      toggle.addEventListener('click', ev => {
        ev.preventDefault();
        this.showTab(tabs, ev.currentTarget.getAttribute('href'));
      });
    });
  },
  showTab(tabs, hash) {
    const toggles = tabs.querySelectorAll(`[href='${hash}']`);
    const panel = tabs.querySelector(hash);
    if (toggles && panel) {
      tabs.toggles.forEach(el => {
        el.classList.remove('is-active');
      });
      tabs.panels.forEach(el => {
        el.classList.remove('is-active');
      });
      toggles.forEach(el => {
        el.classList.add('is-active');
      });
      panel.classList.add('is-active');
      if (window.dispatchEvent) {
        window.dispatchEvent(new CustomEvent('tabs:show', {
          detail: {
            hash
          }
        }));
      }
    }
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Tabs);

/***/ }),

/***/ "./scripts/modules/validate.js":
/*!*************************************!*\
  !*** ./scripts/modules/validate.js ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const Validate = {
  errorClass: 'c-form__error',
  init() {
    let element = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : document;
    this.forms = element.querySelectorAll('[data-validate], #commentform');
    this.forms.forEach(form => this.validate(form));
  },
  validate(form) {
    form.addEventListener('submit', ev => {
      const inputs = form.querySelectorAll('input:not([type="hidden"]), textarea, select');
      const invalidInputs = Array.from(inputs).filter(this.isInvalidElement);
      if (invalidInputs.length) {
        ev.preventDefault();
        ev.stopImmediatePropagation();
        inputs.forEach(input => {
          this.validateElement(input);
          input.addEventListener('input', this.validateElement);
        });
        invalidInputs[0].focus();
      }
    });
  },
  isInvalidElement(target) {
    const element = target instanceof Element ? target : target.target;
    return !element.checkValidity();
  },
  validateElement(target) {
    const element = target instanceof Element ? target : target.target;
    const elementName = element.name.toLowerCase();
    let message = element.closest('form').querySelector(`[data-validate-message="${elementName}"`);
    if (!element.checkValidity()) {
      if (!message) {
        message = document.createElement('div');
        message.classList.add(element.dataset.validateClass ?? this.errorClass);
        message.dataset.validateMessage = elementName;
        element.parentNode.appendChild(message);
      }
      message.innerHTML = element.validationMessage;
    } else if (message) {
      message.innerHTML = '';
    }
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Validate);

/***/ }),

/***/ "./scripts/modules/view-trigger.js":
/*!*****************************************!*\
  !*** ./scripts/modules/view-trigger.js ***!
  \*****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const ViewTrigger = {
  options: {
    threshold: [1]
  },
  init() {
    let element = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : document;
    if ('IntersectionObserver' in window) {
      // Create an intersection observers
      this.observeIntersections(element);
    }
  },
  observeIntersections(element) {
    this.triggers = element.querySelectorAll('[data-view-trigger]');
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        const trigger = entry.target;
        const event = entry.target.dataset.viewTrigger;
        if (entry && entry.isIntersecting) {
          trigger.dispatchEvent(new Event(event));
        }
      });
    }, this.options);
    if (this.triggers.length) {
      [].forEach.call(this.triggers, trigger => observer.observe(trigger));
    }
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (ViewTrigger);

/***/ }),

/***/ "./scripts/theme.js":
/*!**************************!*\
  !*** ./scripts/theme.js ***!
  \**************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _utils_ui__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./utils/ui */ "./scripts/utils/ui.js");
/* harmony import */ var _utils_panels__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./utils/panels */ "./scripts/utils/panels.js");
/*!
 ** Project:      Chipmunk Theme
 ** Author:       Made by Less
 ** Author URI:   https://madebyless.com
 ** ------------------------------------
 */




// Panels
_utils_panels__WEBPACK_IMPORTED_MODULE_1__["default"].init();

// UI
_utils_ui__WEBPACK_IMPORTED_MODULE_0__["default"].init();

/***/ }),

/***/ "./scripts/utils/panels.js":
/*!*********************************!*\
  !*** ./scripts/utils/panels.js ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const Panels = {
  init() {
    document.addEventListener('panels:close', () => {
      const bodyClasses = ['has-nav-open', 'has-search-open', 'has-popup-open'];
      document.documentElement.classList.remove(...bodyClasses);
      document.dispatchEvent(new CustomEvent('dropdown:close'));
      document.dispatchEvent(new CustomEvent('popup:close'));
    });
    document.addEventListener('keyup', this.keyListener);
    document.addEventListener('click', this.clickListener);
    document.addEventListener('touchend', this.clickListener);
  },
  keyListener(ev) {
    if (ev.keyCode === 27) {
      document.dispatchEvent(new CustomEvent('panels:close'));
    }
  },
  clickListener(ev) {
    const target = [ev.target];
    const path = ev.path || ev.composedPath && ev.composedPath();
    if (path) {
      if (!Panels.listenerMatcher(path, ['dropdown', 'dropdown-content'])) {
        document.dispatchEvent(new CustomEvent('dropdown:close'));
      }
    }
    if (target) {
      if (Panels.listenerMatcher(target, /popup($|\s)/)) {
        document.dispatchEvent(new CustomEvent('popup:close'));
      }
    }
  },
  listenerMatcher(path, keyword) {
    return path.some(element => {
      const isRegExp = keyword instanceof RegExp;
      const matchClass = element instanceof HTMLElement && element.className && (isRegExp ? keyword.test(element.className) : element.className.includes(keyword));
      const matchDataset = element instanceof HTMLElement && element.dataset && (Array.isArray(keyword) ? keyword.some(word => word in element.dataset) : keyword in element.dataset);
      return isRegExp ? matchClass : matchClass || matchDataset;
    });
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Panels);

/***/ }),

/***/ "./scripts/utils/ui.js":
/*!*****************************!*\
  !*** ./scripts/utils/ui.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _modules_panel__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../modules/panel */ "./scripts/modules/panel.js");
/* harmony import */ var _modules_dropdown__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../modules/dropdown */ "./scripts/modules/dropdown.js");
/* harmony import */ var _modules_expander__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../modules/expander */ "./scripts/modules/expander.js");
/* harmony import */ var _modules_carousel__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../modules/carousel */ "./scripts/modules/carousel.js");
/* harmony import */ var _modules_popup__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../modules/popup */ "./scripts/modules/popup.js");
/* harmony import */ var _modules_validate__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../modules/validate */ "./scripts/modules/validate.js");
/* harmony import */ var _modules_filter__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../modules/filter */ "./scripts/modules/filter.js");
/* harmony import */ var _modules_tabs__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../modules/tabs */ "./scripts/modules/tabs.js");
/* harmony import */ var _modules_consents__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../modules/consents */ "./scripts/modules/consents.js");
/* harmony import */ var _modules_dynamic_rows__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ../modules/dynamic-rows */ "./scripts/modules/dynamic-rows.js");
/* harmony import */ var _modules_view_trigger__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ../modules/view-trigger */ "./scripts/modules/view-trigger.js");
/* harmony import */ var _modules_ratings__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! ../modules/ratings */ "./scripts/modules/ratings.js");
/* harmony import */ var _modules_actions__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! ../modules/actions */ "./scripts/modules/actions.js");
/* harmony import */ var _modules_events__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! ../modules/events */ "./scripts/modules/events.js");














const Ui = {
  init(element) {
    _modules_panel__WEBPACK_IMPORTED_MODULE_0__["default"].init(element);
    _modules_dropdown__WEBPACK_IMPORTED_MODULE_1__["default"].init(element);
    _modules_expander__WEBPACK_IMPORTED_MODULE_2__["default"].init(element);
    _modules_carousel__WEBPACK_IMPORTED_MODULE_3__["default"].init(element);
    _modules_popup__WEBPACK_IMPORTED_MODULE_4__["default"].init(element);
    _modules_validate__WEBPACK_IMPORTED_MODULE_5__["default"].init(element);
    _modules_filter__WEBPACK_IMPORTED_MODULE_6__["default"].init(element);
    _modules_tabs__WEBPACK_IMPORTED_MODULE_7__["default"].init(element);
    _modules_consents__WEBPACK_IMPORTED_MODULE_8__["default"].init(element);
    _modules_dynamic_rows__WEBPACK_IMPORTED_MODULE_9__["default"].init(element);
    _modules_view_trigger__WEBPACK_IMPORTED_MODULE_10__["default"].init(element);
    _modules_ratings__WEBPACK_IMPORTED_MODULE_11__["default"].init(element);
    _modules_actions__WEBPACK_IMPORTED_MODULE_12__["default"].init(element);
    _modules_events__WEBPACK_IMPORTED_MODULE_13__["default"].init(element);
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Ui);

/***/ }),

/***/ "../../../../../../node_modules/css-loader/dist/runtime/api.js":
/*!*********************************************************************!*\
  !*** ../../../../../../node_modules/css-loader/dist/runtime/api.js ***!
  \*********************************************************************/
/***/ ((module) => {

"use strict";


/*
  MIT License http://www.opensource.org/licenses/mit-license.php
  Author Tobias Koppers @sokra
*/
module.exports = function (cssWithMappingToString) {
  var list = [];

  // return the list of modules as css string
  list.toString = function toString() {
    return this.map(function (item) {
      var content = "";
      var needLayer = typeof item[5] !== "undefined";
      if (item[4]) {
        content += "@supports (".concat(item[4], ") {");
      }
      if (item[2]) {
        content += "@media ".concat(item[2], " {");
      }
      if (needLayer) {
        content += "@layer".concat(item[5].length > 0 ? " ".concat(item[5]) : "", " {");
      }
      content += cssWithMappingToString(item);
      if (needLayer) {
        content += "}";
      }
      if (item[2]) {
        content += "}";
      }
      if (item[4]) {
        content += "}";
      }
      return content;
    }).join("");
  };

  // import a list of modules into the list
  list.i = function i(modules, media, dedupe, supports, layer) {
    if (typeof modules === "string") {
      modules = [[null, modules, undefined]];
    }
    var alreadyImportedModules = {};
    if (dedupe) {
      for (var k = 0; k < this.length; k++) {
        var id = this[k][0];
        if (id != null) {
          alreadyImportedModules[id] = true;
        }
      }
    }
    for (var _k = 0; _k < modules.length; _k++) {
      var item = [].concat(modules[_k]);
      if (dedupe && alreadyImportedModules[item[0]]) {
        continue;
      }
      if (typeof layer !== "undefined") {
        if (typeof item[5] === "undefined") {
          item[5] = layer;
        } else {
          item[1] = "@layer".concat(item[5].length > 0 ? " ".concat(item[5]) : "", " {").concat(item[1], "}");
          item[5] = layer;
        }
      }
      if (media) {
        if (!item[2]) {
          item[2] = media;
        } else {
          item[1] = "@media ".concat(item[2], " {").concat(item[1], "}");
          item[2] = media;
        }
      }
      if (supports) {
        if (!item[4]) {
          item[4] = "".concat(supports);
        } else {
          item[1] = "@supports (".concat(item[4], ") {").concat(item[1], "}");
          item[4] = supports;
        }
      }
      list.push(item);
    }
  };
  return list;
};

/***/ }),

/***/ "../../../../../../node_modules/css-loader/dist/runtime/noSourceMaps.js":
/*!******************************************************************************!*\
  !*** ../../../../../../node_modules/css-loader/dist/runtime/noSourceMaps.js ***!
  \******************************************************************************/
/***/ ((module) => {

"use strict";


module.exports = function (i) {
  return i[1];
};

/***/ }),

/***/ "../../../../../../node_modules/decode-uri-component/index.js":
/*!********************************************************************!*\
  !*** ../../../../../../node_modules/decode-uri-component/index.js ***!
  \********************************************************************/
/***/ ((module) => {

"use strict";

var token = '%[a-f0-9]{2}';
var singleMatcher = new RegExp('(' + token + ')|([^%]+?)', 'gi');
var multiMatcher = new RegExp('(' + token + ')+', 'gi');

function decodeComponents(components, split) {
	try {
		// Try to decode the entire string first
		return [decodeURIComponent(components.join(''))];
	} catch (err) {
		// Do nothing
	}

	if (components.length === 1) {
		return components;
	}

	split = split || 1;

	// Split the array in 2 parts
	var left = components.slice(0, split);
	var right = components.slice(split);

	return Array.prototype.concat.call([], decodeComponents(left), decodeComponents(right));
}

function decode(input) {
	try {
		return decodeURIComponent(input);
	} catch (err) {
		var tokens = input.match(singleMatcher) || [];

		for (var i = 1; i < tokens.length; i++) {
			input = decodeComponents(tokens, i).join('');

			tokens = input.match(singleMatcher) || [];
		}

		return input;
	}
}

function customDecodeURIComponent(input) {
	// Keep track of all the replacements and prefill the map with the `BOM`
	var replaceMap = {
		'%FE%FF': '\uFFFD\uFFFD',
		'%FF%FE': '\uFFFD\uFFFD'
	};

	var match = multiMatcher.exec(input);
	while (match) {
		try {
			// Decode as big chunks as possible
			replaceMap[match[0]] = decodeURIComponent(match[0]);
		} catch (err) {
			var result = decode(match[0]);

			if (result !== match[0]) {
				replaceMap[match[0]] = result;
			}
		}

		match = multiMatcher.exec(input);
	}

	// Add `%C2` at the end of the map to make sure it does not replace the combinator before everything else
	replaceMap['%C2'] = '\uFFFD';

	var entries = Object.keys(replaceMap);

	for (var i = 0; i < entries.length; i++) {
		// Replace all decoded components
		var key = entries[i];
		input = input.replace(new RegExp(key, 'g'), replaceMap[key]);
	}

	return input;
}

module.exports = function (encodedURI) {
	if (typeof encodedURI !== 'string') {
		throw new TypeError('Expected `encodedURI` to be of type `string`, got `' + typeof encodedURI + '`');
	}

	try {
		encodedURI = encodedURI.replace(/\+/g, ' ');

		// Try the built in decoder first
		return decodeURIComponent(encodedURI);
	} catch (err) {
		// Fallback to a more advanced decoder
		return customDecodeURIComponent(encodedURI);
	}
};


/***/ }),

/***/ "../../../../../../node_modules/desandro-matches-selector/matches-selector.js":
/*!************************************************************************************!*\
  !*** ../../../../../../node_modules/desandro-matches-selector/matches-selector.js ***!
  \************************************************************************************/
/***/ ((module, exports, __webpack_require__) => {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_RESULT__;/**
 * matchesSelector v2.0.2
 * matchesSelector( element, '.selector' )
 * MIT license
 */

/*jshint browser: true, strict: true, undef: true, unused: true */

( function( window, factory ) {
  /*global define: false, module: false */
  'use strict';
  // universal module definition
  if ( true ) {
    // AMD
    !(__WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
		__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
		(__WEBPACK_AMD_DEFINE_FACTORY__.call(exports, __webpack_require__, exports, module)) :
		__WEBPACK_AMD_DEFINE_FACTORY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
  } else {}

}( window, function factory() {
  'use strict';

  var matchesMethod = ( function() {
    var ElemProto = window.Element.prototype;
    // check for the standard method name first
    if ( ElemProto.matches ) {
      return 'matches';
    }
    // check un-prefixed
    if ( ElemProto.matchesSelector ) {
      return 'matchesSelector';
    }
    // check vendor prefixes
    var prefixes = [ 'webkit', 'moz', 'ms', 'o' ];

    for ( var i=0; i < prefixes.length; i++ ) {
      var prefix = prefixes[i];
      var method = prefix + 'MatchesSelector';
      if ( ElemProto[ method ] ) {
        return method;
      }
    }
  })();

  return function matchesSelector( elem, selector ) {
    return elem[ matchesMethod ]( selector );
  };

}));


/***/ }),

/***/ "../../../../../../node_modules/ev-emitter/ev-emitter.js":
/*!***************************************************************!*\
  !*** ../../../../../../node_modules/ev-emitter/ev-emitter.js ***!
  \***************************************************************/
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_RESULT__;/**
 * EvEmitter v1.1.0
 * Lil' event emitter
 * MIT License
 */

/* jshint unused: true, undef: true, strict: true */

( function( global, factory ) {
  // universal module definition
  /* jshint strict: false */ /* globals define, module, window */
  if ( true ) {
    // AMD - RequireJS
    !(__WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
		__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
		(__WEBPACK_AMD_DEFINE_FACTORY__.call(exports, __webpack_require__, exports, module)) :
		__WEBPACK_AMD_DEFINE_FACTORY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
  } else {}

}( typeof window != 'undefined' ? window : this, function() {

"use strict";

function EvEmitter() {}

var proto = EvEmitter.prototype;

proto.on = function( eventName, listener ) {
  if ( !eventName || !listener ) {
    return;
  }
  // set events hash
  var events = this._events = this._events || {};
  // set listeners array
  var listeners = events[ eventName ] = events[ eventName ] || [];
  // only add once
  if ( listeners.indexOf( listener ) == -1 ) {
    listeners.push( listener );
  }

  return this;
};

proto.once = function( eventName, listener ) {
  if ( !eventName || !listener ) {
    return;
  }
  // add event
  this.on( eventName, listener );
  // set once flag
  // set onceEvents hash
  var onceEvents = this._onceEvents = this._onceEvents || {};
  // set onceListeners object
  var onceListeners = onceEvents[ eventName ] = onceEvents[ eventName ] || {};
  // set flag
  onceListeners[ listener ] = true;

  return this;
};

proto.off = function( eventName, listener ) {
  var listeners = this._events && this._events[ eventName ];
  if ( !listeners || !listeners.length ) {
    return;
  }
  var index = listeners.indexOf( listener );
  if ( index != -1 ) {
    listeners.splice( index, 1 );
  }

  return this;
};

proto.emitEvent = function( eventName, args ) {
  var listeners = this._events && this._events[ eventName ];
  if ( !listeners || !listeners.length ) {
    return;
  }
  // copy over to avoid interference if .off() in listener
  listeners = listeners.slice(0);
  args = args || [];
  // once stuff
  var onceListeners = this._onceEvents && this._onceEvents[ eventName ];

  for ( var i=0; i < listeners.length; i++ ) {
    var listener = listeners[i]
    var isOnce = onceListeners && onceListeners[ listener ];
    if ( isOnce ) {
      // remove listener
      // remove before trigger to prevent recursion
      this.off( eventName, listener );
      // unset once flag
      delete onceListeners[ listener ];
    }
    // trigger listener
    listener.apply( this, args );
  }

  return this;
};

proto.allOff = function() {
  delete this._events;
  delete this._onceEvents;
};

return EvEmitter;

}));


/***/ }),

/***/ "../../../../../../node_modules/filter-obj/index.js":
/*!**********************************************************!*\
  !*** ../../../../../../node_modules/filter-obj/index.js ***!
  \**********************************************************/
/***/ ((module) => {

"use strict";

module.exports = function (obj, predicate) {
	var ret = {};
	var keys = Object.keys(obj);
	var isArr = Array.isArray(predicate);

	for (var i = 0; i < keys.length; i++) {
		var key = keys[i];
		var val = obj[key];

		if (isArr ? predicate.indexOf(key) !== -1 : predicate(key, val, obj)) {
			ret[key] = val;
		}
	}

	return ret;
};


/***/ }),

/***/ "../../../../../../node_modules/fizzy-ui-utils/utils.js":
/*!**************************************************************!*\
  !*** ../../../../../../node_modules/fizzy-ui-utils/utils.js ***!
  \**************************************************************/
/***/ ((module, exports, __webpack_require__) => {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/**
 * Fizzy UI utils v2.0.7
 * MIT license
 */

/*jshint browser: true, undef: true, unused: true, strict: true */

( function( window, factory ) {
  // universal module definition
  /*jshint strict: false */ /*globals define, module, require */

  if ( true ) {
    // AMD
    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [
      __webpack_require__(/*! desandro-matches-selector/matches-selector */ "../../../../../../node_modules/desandro-matches-selector/matches-selector.js")
    ], __WEBPACK_AMD_DEFINE_RESULT__ = (function( matchesSelector ) {
      return factory( window, matchesSelector );
    }).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
  } else {}

}( window, function factory( window, matchesSelector ) {

'use strict';

var utils = {};

// ----- extend ----- //

// extends objects
utils.extend = function( a, b ) {
  for ( var prop in b ) {
    a[ prop ] = b[ prop ];
  }
  return a;
};

// ----- modulo ----- //

utils.modulo = function( num, div ) {
  return ( ( num % div ) + div ) % div;
};

// ----- makeArray ----- //

var arraySlice = Array.prototype.slice;

// turn element or nodeList into an array
utils.makeArray = function( obj ) {
  if ( Array.isArray( obj ) ) {
    // use object if already an array
    return obj;
  }
  // return empty array if undefined or null. #6
  if ( obj === null || obj === undefined ) {
    return [];
  }

  var isArrayLike = typeof obj == 'object' && typeof obj.length == 'number';
  if ( isArrayLike ) {
    // convert nodeList to array
    return arraySlice.call( obj );
  }

  // array of single index
  return [ obj ];
};

// ----- removeFrom ----- //

utils.removeFrom = function( ary, obj ) {
  var index = ary.indexOf( obj );
  if ( index != -1 ) {
    ary.splice( index, 1 );
  }
};

// ----- getParent ----- //

utils.getParent = function( elem, selector ) {
  while ( elem.parentNode && elem != document.body ) {
    elem = elem.parentNode;
    if ( matchesSelector( elem, selector ) ) {
      return elem;
    }
  }
};

// ----- getQueryElement ----- //

// use element as selector string
utils.getQueryElement = function( elem ) {
  if ( typeof elem == 'string' ) {
    return document.querySelector( elem );
  }
  return elem;
};

// ----- handleEvent ----- //

// enable .ontype to trigger from .addEventListener( elem, 'type' )
utils.handleEvent = function( event ) {
  var method = 'on' + event.type;
  if ( this[ method ] ) {
    this[ method ]( event );
  }
};

// ----- filterFindElements ----- //

utils.filterFindElements = function( elems, selector ) {
  // make array of elems
  elems = utils.makeArray( elems );
  var ffElems = [];

  elems.forEach( function( elem ) {
    // check that elem is an actual element
    if ( !( elem instanceof HTMLElement ) ) {
      return;
    }
    // add elem if no selector
    if ( !selector ) {
      ffElems.push( elem );
      return;
    }
    // filter & find items if we have a selector
    // filter
    if ( matchesSelector( elem, selector ) ) {
      ffElems.push( elem );
    }
    // find children
    var childElems = elem.querySelectorAll( selector );
    // concat childElems to filterFound array
    for ( var i=0; i < childElems.length; i++ ) {
      ffElems.push( childElems[i] );
    }
  });

  return ffElems;
};

// ----- debounceMethod ----- //

utils.debounceMethod = function( _class, methodName, threshold ) {
  threshold = threshold || 100;
  // original method
  var method = _class.prototype[ methodName ];
  var timeoutName = methodName + 'Timeout';

  _class.prototype[ methodName ] = function() {
    var timeout = this[ timeoutName ];
    clearTimeout( timeout );

    var args = arguments;
    var _this = this;
    this[ timeoutName ] = setTimeout( function() {
      method.apply( _this, args );
      delete _this[ timeoutName ];
    }, threshold );
  };
};

// ----- docReady ----- //

utils.docReady = function( callback ) {
  var readyState = document.readyState;
  if ( readyState == 'complete' || readyState == 'interactive' ) {
    // do async to allow for other scripts to run. metafizzy/flickity#441
    setTimeout( callback );
  } else {
    document.addEventListener( 'DOMContentLoaded', callback );
  }
};

// ----- htmlInit ----- //

// http://jamesroberts.name/blog/2010/02/22/string-functions-for-javascript-trim-to-camel-case-to-dashed-and-to-underscore/
utils.toDashed = function( str ) {
  return str.replace( /(.)([A-Z])/g, function( match, $1, $2 ) {
    return $1 + '-' + $2;
  }).toLowerCase();
};

var console = window.console;
/**
 * allow user to initialize classes via [data-namespace] or .js-namespace class
 * htmlInit( Widget, 'widgetName' )
 * options are parsed from data-namespace-options
 */
utils.htmlInit = function( WidgetClass, namespace ) {
  utils.docReady( function() {
    var dashedNamespace = utils.toDashed( namespace );
    var dataAttr = 'data-' + dashedNamespace;
    var dataAttrElems = document.querySelectorAll( '[' + dataAttr + ']' );
    var jsDashElems = document.querySelectorAll( '.js-' + dashedNamespace );
    var elems = utils.makeArray( dataAttrElems )
      .concat( utils.makeArray( jsDashElems ) );
    var dataOptionsAttr = dataAttr + '-options';
    var jQuery = window.jQuery;

    elems.forEach( function( elem ) {
      var attr = elem.getAttribute( dataAttr ) ||
        elem.getAttribute( dataOptionsAttr );
      var options;
      try {
        options = attr && JSON.parse( attr );
      } catch ( error ) {
        // log error, do not initialize
        if ( console ) {
          console.error( 'Error parsing ' + dataAttr + ' on ' + elem.className +
          ': ' + error );
        }
        return;
      }
      // initialize
      var instance = new WidgetClass( elem, options );
      // make available via $().data('namespace')
      if ( jQuery ) {
        jQuery.data( elem, namespace, instance );
      }
    });

  });
};

// -----  ----- //

return utils;

}));


/***/ }),

/***/ "../../../../../../node_modules/flickity/js/add-remove-cell.js":
/*!*********************************************************************!*\
  !*** ../../../../../../node_modules/flickity/js/add-remove-cell.js ***!
  \*********************************************************************/
/***/ ((module, exports, __webpack_require__) => {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;// add, remove cell
( function( window, factory ) {
  // universal module definition
  if ( true ) {
    // AMD
    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [
      __webpack_require__(/*! ./flickity */ "../../../../../../node_modules/flickity/js/flickity.js"),
      __webpack_require__(/*! fizzy-ui-utils/utils */ "../../../../../../node_modules/fizzy-ui-utils/utils.js"),
    ], __WEBPACK_AMD_DEFINE_RESULT__ = (function( Flickity, utils ) {
      return factory( window, Flickity, utils );
    }).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
  } else {}

}( window, function factory( window, Flickity, utils ) {

'use strict';

// append cells to a document fragment
function getCellsFragment( cells ) {
  var fragment = document.createDocumentFragment();
  cells.forEach( function( cell ) {
    fragment.appendChild( cell.element );
  } );
  return fragment;
}

// -------------------------- add/remove cell prototype -------------------------- //

var proto = Flickity.prototype;

/**
 * Insert, prepend, or append cells
 * @param {[Element, Array, NodeList]} elems - Elements to insert
 * @param {Integer} index - Zero-based number to insert
 */
proto.insert = function( elems, index ) {
  var cells = this._makeCells( elems );
  if ( !cells || !cells.length ) {
    return;
  }
  var len = this.cells.length;
  // default to append
  index = index === undefined ? len : index;
  // add cells with document fragment
  var fragment = getCellsFragment( cells );
  // append to slider
  var isAppend = index == len;
  if ( isAppend ) {
    this.slider.appendChild( fragment );
  } else {
    var insertCellElement = this.cells[ index ].element;
    this.slider.insertBefore( fragment, insertCellElement );
  }
  // add to this.cells
  if ( index === 0 ) {
    // prepend, add to start
    this.cells = cells.concat( this.cells );
  } else if ( isAppend ) {
    // append, add to end
    this.cells = this.cells.concat( cells );
  } else {
    // insert in this.cells
    var endCells = this.cells.splice( index, len - index );
    this.cells = this.cells.concat( cells ).concat( endCells );
  }

  this._sizeCells( cells );
  this.cellChange( index, true );
};

proto.append = function( elems ) {
  this.insert( elems, this.cells.length );
};

proto.prepend = function( elems ) {
  this.insert( elems, 0 );
};

/**
 * Remove cells
 * @param {[Element, Array, NodeList]} elems - ELements to remove
 */
proto.remove = function( elems ) {
  var cells = this.getCells( elems );
  if ( !cells || !cells.length ) {
    return;
  }

  var minCellIndex = this.cells.length - 1;
  // remove cells from collection & DOM
  cells.forEach( function( cell ) {
    cell.remove();
    var index = this.cells.indexOf( cell );
    minCellIndex = Math.min( index, minCellIndex );
    utils.removeFrom( this.cells, cell );
  }, this );

  this.cellChange( minCellIndex, true );
};

/**
 * logic to be run after a cell's size changes
 * @param {Element} elem - cell's element
 */
proto.cellSizeChange = function( elem ) {
  var cell = this.getCell( elem );
  if ( !cell ) {
    return;
  }
  cell.getSize();

  var index = this.cells.indexOf( cell );
  this.cellChange( index );
};

/**
 * logic any time a cell is changed: added, removed, or size changed
 * @param {Integer} changedCellIndex - index of the changed cell, optional
 * @param {Boolean} isPositioningSlider - Positions slider after selection
 */
proto.cellChange = function( changedCellIndex, isPositioningSlider ) {
  var prevSelectedElem = this.selectedElement;
  this._positionCells( changedCellIndex );
  this._getWrapShiftCells();
  this.setGallerySize();
  // update selectedIndex
  // try to maintain position & select previous selected element
  var cell = this.getCell( prevSelectedElem );
  if ( cell ) {
    this.selectedIndex = this.getCellSlideIndex( cell );
  }
  this.selectedIndex = Math.min( this.slides.length - 1, this.selectedIndex );

  this.emitEvent( 'cellChange', [ changedCellIndex ] );
  // position slider
  this.select( this.selectedIndex );
  // do not position slider after lazy load
  if ( isPositioningSlider ) {
    this.positionSliderAtSelected();
  }
};

// -----  ----- //

return Flickity;

} ) );


/***/ }),

/***/ "../../../../../../node_modules/flickity/js/animate.js":
/*!*************************************************************!*\
  !*** ../../../../../../node_modules/flickity/js/animate.js ***!
  \*************************************************************/
/***/ ((module, exports, __webpack_require__) => {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;// animate
( function( window, factory ) {
  // universal module definition
  if ( true ) {
    // AMD
    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [
      __webpack_require__(/*! fizzy-ui-utils/utils */ "../../../../../../node_modules/fizzy-ui-utils/utils.js"),
    ], __WEBPACK_AMD_DEFINE_RESULT__ = (function( utils ) {
      return factory( window, utils );
    }).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
  } else {}

}( window, function factory( window, utils ) {

'use strict';

// -------------------------- animate -------------------------- //

var proto = {};

proto.startAnimation = function() {
  if ( this.isAnimating ) {
    return;
  }

  this.isAnimating = true;
  this.restingFrames = 0;
  this.animate();
};

proto.animate = function() {
  this.applyDragForce();
  this.applySelectedAttraction();

  var previousX = this.x;

  this.integratePhysics();
  this.positionSlider();
  this.settle( previousX );
  // animate next frame
  if ( this.isAnimating ) {
    var _this = this;
    requestAnimationFrame( function animateFrame() {
      _this.animate();
    } );
  }
};

proto.positionSlider = function() {
  var x = this.x;
  // wrap position around
  if ( this.options.wrapAround && this.cells.length > 1 ) {
    x = utils.modulo( x, this.slideableWidth );
    x -= this.slideableWidth;
    this.shiftWrapCells( x );
  }

  this.setTranslateX( x, this.isAnimating );
  this.dispatchScrollEvent();
};

proto.setTranslateX = function( x, is3d ) {
  x += this.cursorPosition;
  // reverse if right-to-left and using transform
  x = this.options.rightToLeft ? -x : x;
  var translateX = this.getPositionValue( x );
  // use 3D transforms for hardware acceleration on iOS
  // but use 2D when settled, for better font-rendering
  this.slider.style.transform = is3d ?
    'translate3d(' + translateX + ',0,0)' : 'translateX(' + translateX + ')';
};

proto.dispatchScrollEvent = function() {
  var firstSlide = this.slides[0];
  if ( !firstSlide ) {
    return;
  }
  var positionX = -this.x - firstSlide.target;
  var progress = positionX / this.slidesWidth;
  this.dispatchEvent( 'scroll', null, [ progress, positionX ] );
};

proto.positionSliderAtSelected = function() {
  if ( !this.cells.length ) {
    return;
  }
  this.x = -this.selectedSlide.target;
  this.velocity = 0; // stop wobble
  this.positionSlider();
};

proto.getPositionValue = function( position ) {
  if ( this.options.percentPosition ) {
    // percent position, round to 2 digits, like 12.34%
    return ( Math.round( ( position / this.size.innerWidth ) * 10000 ) * 0.01 ) + '%';
  } else {
    // pixel positioning
    return Math.round( position ) + 'px';
  }
};

proto.settle = function( previousX ) {
  // keep track of frames where x hasn't moved
  var isResting = !this.isPointerDown &&
      Math.round( this.x * 100 ) == Math.round( previousX * 100 );
  if ( isResting ) {
    this.restingFrames++;
  }
  // stop animating if resting for 3 or more frames
  if ( this.restingFrames > 2 ) {
    this.isAnimating = false;
    delete this.isFreeScrolling;
    // render position with translateX when settled
    this.positionSlider();
    this.dispatchEvent( 'settle', null, [ this.selectedIndex ] );
  }
};

proto.shiftWrapCells = function( x ) {
  // shift before cells
  var beforeGap = this.cursorPosition + x;
  this._shiftCells( this.beforeShiftCells, beforeGap, -1 );
  // shift after cells
  var afterGap = this.size.innerWidth - ( x + this.slideableWidth + this.cursorPosition );
  this._shiftCells( this.afterShiftCells, afterGap, 1 );
};

proto._shiftCells = function( cells, gap, shift ) {
  for ( var i = 0; i < cells.length; i++ ) {
    var cell = cells[i];
    var cellShift = gap > 0 ? shift : 0;
    cell.wrapShift( cellShift );
    gap -= cell.size.outerWidth;
  }
};

proto._unshiftCells = function( cells ) {
  if ( !cells || !cells.length ) {
    return;
  }
  for ( var i = 0; i < cells.length; i++ ) {
    cells[i].wrapShift( 0 );
  }
};

// -------------------------- physics -------------------------- //

proto.integratePhysics = function() {
  this.x += this.velocity;
  this.velocity *= this.getFrictionFactor();
};

proto.applyForce = function( force ) {
  this.velocity += force;
};

proto.getFrictionFactor = function() {
  return 1 - this.options[ this.isFreeScrolling ? 'freeScrollFriction' : 'friction' ];
};

proto.getRestingPosition = function() {
  // my thanks to Steven Wittens, who simplified this math greatly
  return this.x + this.velocity / ( 1 - this.getFrictionFactor() );
};

proto.applyDragForce = function() {
  if ( !this.isDraggable || !this.isPointerDown ) {
    return;
  }
  // change the position to drag position by applying force
  var dragVelocity = this.dragX - this.x;
  var dragForce = dragVelocity - this.velocity;
  this.applyForce( dragForce );
};

proto.applySelectedAttraction = function() {
  // do not attract if pointer down or no slides
  var dragDown = this.isDraggable && this.isPointerDown;
  if ( dragDown || this.isFreeScrolling || !this.slides.length ) {
    return;
  }
  var distance = this.selectedSlide.target * -1 - this.x;
  var force = distance * this.options.selectedAttraction;
  this.applyForce( force );
};

return proto;

} ) );


/***/ }),

/***/ "../../../../../../node_modules/flickity/js/cell.js":
/*!**********************************************************!*\
  !*** ../../../../../../node_modules/flickity/js/cell.js ***!
  \**********************************************************/
/***/ ((module, exports, __webpack_require__) => {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;// Flickity.Cell
( function( window, factory ) {
  // universal module definition
  if ( true ) {
    // AMD
    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [
      __webpack_require__(/*! get-size/get-size */ "../../../../../../node_modules/get-size/get-size.js"),
    ], __WEBPACK_AMD_DEFINE_RESULT__ = (function( getSize ) {
      return factory( window, getSize );
    }).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
  } else {}

}( window, function factory( window, getSize ) {

'use strict';

function Cell( elem, parent ) {
  this.element = elem;
  this.parent = parent;

  this.create();
}

var proto = Cell.prototype;

proto.create = function() {
  this.element.style.position = 'absolute';
  this.element.setAttribute( 'aria-hidden', 'true' );
  this.x = 0;
  this.shift = 0;
  this.element.style[ this.parent.originSide ] = 0;
};

proto.destroy = function() {
  // reset style
  this.unselect();
  this.element.style.position = '';
  var side = this.parent.originSide;
  this.element.style[ side ] = '';
  this.element.style.transform = '';
  this.element.removeAttribute('aria-hidden');
};

proto.getSize = function() {
  this.size = getSize( this.element );
};

proto.setPosition = function( x ) {
  this.x = x;
  this.updateTarget();
  this.renderPosition( x );
};

// setDefaultTarget v1 method, backwards compatibility, remove in v3
proto.updateTarget = proto.setDefaultTarget = function() {
  var marginProperty = this.parent.originSide == 'left' ? 'marginLeft' : 'marginRight';
  this.target = this.x + this.size[ marginProperty ] +
    this.size.width * this.parent.cellAlign;
};

proto.renderPosition = function( x ) {
  // render position of cell with in slider
  var sideOffset = this.parent.originSide === 'left' ? 1 : -1;

  var adjustedX = this.parent.options.percentPosition ?
    x * sideOffset * ( this.parent.size.innerWidth / this.size.width ) :
    x * sideOffset;

  this.element.style.transform = 'translateX(' +
    this.parent.getPositionValue( adjustedX ) + ')';
};

proto.select = function() {
  this.element.classList.add('is-selected');
  this.element.removeAttribute('aria-hidden');
};

proto.unselect = function() {
  this.element.classList.remove('is-selected');
  this.element.setAttribute( 'aria-hidden', 'true' );
};

/**
 * @param {Integer} shift - 0, 1, or -1
 */
proto.wrapShift = function( shift ) {
  this.shift = shift;
  this.renderPosition( this.x + this.parent.slideableWidth * shift );
};

proto.remove = function() {
  this.element.parentNode.removeChild( this.element );
};

return Cell;

} ) );


/***/ }),

/***/ "../../../../../../node_modules/flickity/js/drag.js":
/*!**********************************************************!*\
  !*** ../../../../../../node_modules/flickity/js/drag.js ***!
  \**********************************************************/
/***/ ((module, exports, __webpack_require__) => {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;// drag
( function( window, factory ) {
  // universal module definition
  if ( true ) {
    // AMD
    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [
      __webpack_require__(/*! ./flickity */ "../../../../../../node_modules/flickity/js/flickity.js"),
      __webpack_require__(/*! unidragger/unidragger */ "../../../../../../node_modules/unidragger/unidragger.js"),
      __webpack_require__(/*! fizzy-ui-utils/utils */ "../../../../../../node_modules/fizzy-ui-utils/utils.js"),
    ], __WEBPACK_AMD_DEFINE_RESULT__ = (function( Flickity, Unidragger, utils ) {
      return factory( window, Flickity, Unidragger, utils );
    }).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
  } else {}

}( window, function factory( window, Flickity, Unidragger, utils ) {

'use strict';

// ----- defaults ----- //

utils.extend( Flickity.defaults, {
  draggable: '>1',
  dragThreshold: 3,
} );

// ----- create ----- //

Flickity.createMethods.push('_createDrag');

// -------------------------- drag prototype -------------------------- //

var proto = Flickity.prototype;
utils.extend( proto, Unidragger.prototype );
proto._touchActionValue = 'pan-y';

// --------------------------  -------------------------- //

proto._createDrag = function() {
  this.on( 'activate', this.onActivateDrag );
  this.on( 'uiChange', this._uiChangeDrag );
  this.on( 'deactivate', this.onDeactivateDrag );
  this.on( 'cellChange', this.updateDraggable );
  // TODO updateDraggable on resize? if groupCells & slides change
};

proto.onActivateDrag = function() {
  this.handles = [ this.viewport ];
  this.bindHandles();
  this.updateDraggable();
};

proto.onDeactivateDrag = function() {
  this.unbindHandles();
  this.element.classList.remove('is-draggable');
};

proto.updateDraggable = function() {
  // disable dragging if less than 2 slides. #278
  if ( this.options.draggable == '>1' ) {
    this.isDraggable = this.slides.length > 1;
  } else {
    this.isDraggable = this.options.draggable;
  }
  if ( this.isDraggable ) {
    this.element.classList.add('is-draggable');
  } else {
    this.element.classList.remove('is-draggable');
  }
};

// backwards compatibility
proto.bindDrag = function() {
  this.options.draggable = true;
  this.updateDraggable();
};

proto.unbindDrag = function() {
  this.options.draggable = false;
  this.updateDraggable();
};

proto._uiChangeDrag = function() {
  delete this.isFreeScrolling;
};

// -------------------------- pointer events -------------------------- //

proto.pointerDown = function( event, pointer ) {
  if ( !this.isDraggable ) {
    this._pointerDownDefault( event, pointer );
    return;
  }
  var isOkay = this.okayPointerDown( event );
  if ( !isOkay ) {
    return;
  }

  this._pointerDownPreventDefault( event );
  this.pointerDownFocus( event );
  // blur
  if ( document.activeElement != this.element ) {
    // do not blur if already focused
    this.pointerDownBlur();
  }

  // stop if it was moving
  this.dragX = this.x;
  this.viewport.classList.add('is-pointer-down');
  // track scrolling
  this.pointerDownScroll = getScrollPosition();
  window.addEventListener( 'scroll', this );

  this._pointerDownDefault( event, pointer );
};

// default pointerDown logic, used for staticClick
proto._pointerDownDefault = function( event, pointer ) {
  // track start event position
  // Safari 9 overrides pageX and pageY. These values needs to be copied. #779
  this.pointerDownPointer = {
    pageX: pointer.pageX,
    pageY: pointer.pageY,
  };
  // bind move and end events
  this._bindPostStartEvents( event );
  this.dispatchEvent( 'pointerDown', event, [ pointer ] );
};

var focusNodes = {
  INPUT: true,
  TEXTAREA: true,
  SELECT: true,
};

proto.pointerDownFocus = function( event ) {
  var isFocusNode = focusNodes[ event.target.nodeName ];
  if ( !isFocusNode ) {
    this.focus();
  }
};

proto._pointerDownPreventDefault = function( event ) {
  var isTouchStart = event.type == 'touchstart';
  var isTouchPointer = event.pointerType == 'touch';
  var isFocusNode = focusNodes[ event.target.nodeName ];
  if ( !isTouchStart && !isTouchPointer && !isFocusNode ) {
    event.preventDefault();
  }
};

// ----- move ----- //

proto.hasDragStarted = function( moveVector ) {
  return Math.abs( moveVector.x ) > this.options.dragThreshold;
};

// ----- up ----- //

proto.pointerUp = function( event, pointer ) {
  delete this.isTouchScrolling;
  this.viewport.classList.remove('is-pointer-down');
  this.dispatchEvent( 'pointerUp', event, [ pointer ] );
  this._dragPointerUp( event, pointer );
};

proto.pointerDone = function() {
  window.removeEventListener( 'scroll', this );
  delete this.pointerDownScroll;
};

// -------------------------- dragging -------------------------- //

proto.dragStart = function( event, pointer ) {
  if ( !this.isDraggable ) {
    return;
  }
  this.dragStartPosition = this.x;
  this.startAnimation();
  window.removeEventListener( 'scroll', this );
  this.dispatchEvent( 'dragStart', event, [ pointer ] );
};

proto.pointerMove = function( event, pointer ) {
  var moveVector = this._dragPointerMove( event, pointer );
  this.dispatchEvent( 'pointerMove', event, [ pointer, moveVector ] );
  this._dragMove( event, pointer, moveVector );
};

proto.dragMove = function( event, pointer, moveVector ) {
  if ( !this.isDraggable ) {
    return;
  }
  event.preventDefault();

  this.previousDragX = this.dragX;
  // reverse if right-to-left
  var direction = this.options.rightToLeft ? -1 : 1;
  if ( this.options.wrapAround ) {
    // wrap around move. #589
    moveVector.x %= this.slideableWidth;
  }
  var dragX = this.dragStartPosition + moveVector.x * direction;

  if ( !this.options.wrapAround && this.slides.length ) {
    // slow drag
    var originBound = Math.max( -this.slides[0].target, this.dragStartPosition );
    dragX = dragX > originBound ? ( dragX + originBound ) * 0.5 : dragX;
    var endBound = Math.min( -this.getLastSlide().target, this.dragStartPosition );
    dragX = dragX < endBound ? ( dragX + endBound ) * 0.5 : dragX;
  }

  this.dragX = dragX;

  this.dragMoveTime = new Date();
  this.dispatchEvent( 'dragMove', event, [ pointer, moveVector ] );
};

proto.dragEnd = function( event, pointer ) {
  if ( !this.isDraggable ) {
    return;
  }
  if ( this.options.freeScroll ) {
    this.isFreeScrolling = true;
  }
  // set selectedIndex based on where flick will end up
  var index = this.dragEndRestingSelect();

  if ( this.options.freeScroll && !this.options.wrapAround ) {
    // if free-scroll & not wrap around
    // do not free-scroll if going outside of bounding slides
    // so bounding slides can attract slider, and keep it in bounds
    var restingX = this.getRestingPosition();
    this.isFreeScrolling = -restingX > this.slides[0].target &&
      -restingX < this.getLastSlide().target;
  } else if ( !this.options.freeScroll && index == this.selectedIndex ) {
    // boost selection if selected index has not changed
    index += this.dragEndBoostSelect();
  }
  delete this.previousDragX;
  // apply selection
  // TODO refactor this, selecting here feels weird
  // HACK, set flag so dragging stays in correct direction
  this.isDragSelect = this.options.wrapAround;
  this.select( index );
  delete this.isDragSelect;
  this.dispatchEvent( 'dragEnd', event, [ pointer ] );
};

proto.dragEndRestingSelect = function() {
  var restingX = this.getRestingPosition();
  // how far away from selected slide
  var distance = Math.abs( this.getSlideDistance( -restingX, this.selectedIndex ) );
  // get closet resting going up and going down
  var positiveResting = this._getClosestResting( restingX, distance, 1 );
  var negativeResting = this._getClosestResting( restingX, distance, -1 );
  // use closer resting for wrap-around
  var index = positiveResting.distance < negativeResting.distance ?
    positiveResting.index : negativeResting.index;
  return index;
};

/**
 * given resting X and distance to selected cell
 * get the distance and index of the closest cell
 * @param {Number} restingX - estimated post-flick resting position
 * @param {Number} distance - distance to selected cell
 * @param {Integer} increment - +1 or -1, going up or down
 * @returns {Object} - { distance: {Number}, index: {Integer} }
 */
proto._getClosestResting = function( restingX, distance, increment ) {
  var index = this.selectedIndex;
  var minDistance = Infinity;
  var condition = this.options.contain && !this.options.wrapAround ?
    // if contain, keep going if distance is equal to minDistance
    function( dist, minDist ) {
      return dist <= minDist;
    } : function( dist, minDist ) {
      return dist < minDist;
    };
  while ( condition( distance, minDistance ) ) {
    // measure distance to next cell
    index += increment;
    minDistance = distance;
    distance = this.getSlideDistance( -restingX, index );
    if ( distance === null ) {
      break;
    }
    distance = Math.abs( distance );
  }
  return {
    distance: minDistance,
    // selected was previous index
    index: index - increment,
  };
};

/**
 * measure distance between x and a slide target
 * @param {Number} x - horizontal position
 * @param {Integer} index - slide index
 * @returns {Number} - slide distance
 */
proto.getSlideDistance = function( x, index ) {
  var len = this.slides.length;
  // wrap around if at least 2 slides
  var isWrapAround = this.options.wrapAround && len > 1;
  var slideIndex = isWrapAround ? utils.modulo( index, len ) : index;
  var slide = this.slides[ slideIndex ];
  if ( !slide ) {
    return null;
  }
  // add distance for wrap-around slides
  var wrap = isWrapAround ? this.slideableWidth * Math.floor( index/len ) : 0;
  return x - ( slide.target + wrap );
};

proto.dragEndBoostSelect = function() {
  // do not boost if no previousDragX or dragMoveTime
  if ( this.previousDragX === undefined || !this.dragMoveTime ||
    // or if drag was held for 100 ms
    new Date() - this.dragMoveTime > 100 ) {
    return 0;
  }

  var distance = this.getSlideDistance( -this.dragX, this.selectedIndex );
  var delta = this.previousDragX - this.dragX;
  if ( distance > 0 && delta > 0 ) {
    // boost to next if moving towards the right, and positive velocity
    return 1;
  } else if ( distance < 0 && delta < 0 ) {
    // boost to previous if moving towards the left, and negative velocity
    return -1;
  }
  return 0;
};

// ----- staticClick ----- //

proto.staticClick = function( event, pointer ) {
  // get clickedCell, if cell was clicked
  var clickedCell = this.getParentCell( event.target );
  var cellElem = clickedCell && clickedCell.element;
  var cellIndex = clickedCell && this.cells.indexOf( clickedCell );
  this.dispatchEvent( 'staticClick', event, [ pointer, cellElem, cellIndex ] );
};

// ----- scroll ----- //

proto.onscroll = function() {
  var scroll = getScrollPosition();
  var scrollMoveX = this.pointerDownScroll.x - scroll.x;
  var scrollMoveY = this.pointerDownScroll.y - scroll.y;
  // cancel click/tap if scroll is too much
  if ( Math.abs( scrollMoveX ) > 3 || Math.abs( scrollMoveY ) > 3 ) {
    this._pointerDone();
  }
};

// ----- utils ----- //

function getScrollPosition() {
  return {
    x: window.pageXOffset,
    y: window.pageYOffset,
  };
}

// -----  ----- //

return Flickity;

} ) );


/***/ }),

/***/ "../../../../../../node_modules/flickity/js/flickity.js":
/*!**************************************************************!*\
  !*** ../../../../../../node_modules/flickity/js/flickity.js ***!
  \**************************************************************/
/***/ ((module, exports, __webpack_require__) => {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;// Flickity main
/* eslint-disable max-params */
( function( window, factory ) {
  // universal module definition
  if ( true ) {
    // AMD
    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [
      __webpack_require__(/*! ev-emitter/ev-emitter */ "../../../../../../node_modules/ev-emitter/ev-emitter.js"),
      __webpack_require__(/*! get-size/get-size */ "../../../../../../node_modules/get-size/get-size.js"),
      __webpack_require__(/*! fizzy-ui-utils/utils */ "../../../../../../node_modules/fizzy-ui-utils/utils.js"),
      __webpack_require__(/*! ./cell */ "../../../../../../node_modules/flickity/js/cell.js"),
      __webpack_require__(/*! ./slide */ "../../../../../../node_modules/flickity/js/slide.js"),
      __webpack_require__(/*! ./animate */ "../../../../../../node_modules/flickity/js/animate.js"),
    ], __WEBPACK_AMD_DEFINE_RESULT__ = (function( EvEmitter, getSize, utils, Cell, Slide, animatePrototype ) {
      return factory( window, EvEmitter, getSize, utils, Cell, Slide, animatePrototype );
    }).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
  } else { var _Flickity; }

}( window, function factory( window, EvEmitter, getSize,
    utils, Cell, Slide, animatePrototype ) {

/* eslint-enable max-params */
'use strict';

// vars
var jQuery = window.jQuery;
var getComputedStyle = window.getComputedStyle;
var console = window.console;

function moveElements( elems, toElem ) {
  elems = utils.makeArray( elems );
  while ( elems.length ) {
    toElem.appendChild( elems.shift() );
  }
}

// -------------------------- Flickity -------------------------- //

// globally unique identifiers
var GUID = 0;
// internal store of all Flickity intances
var instances = {};

function Flickity( element, options ) {
  var queryElement = utils.getQueryElement( element );
  if ( !queryElement ) {
    if ( console ) {
      console.error( 'Bad element for Flickity: ' + ( queryElement || element ) );
    }
    return;
  }
  this.element = queryElement;
  // do not initialize twice on same element
  if ( this.element.flickityGUID ) {
    var instance = instances[ this.element.flickityGUID ];
    if ( instance ) instance.option( options );
    return instance;
  }

  // add jQuery
  if ( jQuery ) {
    this.$element = jQuery( this.element );
  }
  // options
  this.options = utils.extend( {}, this.constructor.defaults );
  this.option( options );

  // kick things off
  this._create();
}

Flickity.defaults = {
  accessibility: true,
  // adaptiveHeight: false,
  cellAlign: 'center',
  // cellSelector: undefined,
  // contain: false,
  freeScrollFriction: 0.075, // friction when free-scrolling
  friction: 0.28, // friction when selecting
  namespaceJQueryEvents: true,
  // initialIndex: 0,
  percentPosition: true,
  resize: true,
  selectedAttraction: 0.025,
  setGallerySize: true,
  // watchCSS: false,
  // wrapAround: false
};

// hash of methods triggered on _create()
Flickity.createMethods = [];

var proto = Flickity.prototype;
// inherit EventEmitter
utils.extend( proto, EvEmitter.prototype );

proto._create = function() {
  // add id for Flickity.data
  var id = this.guid = ++GUID;
  this.element.flickityGUID = id; // expando
  instances[ id ] = this; // associate via id
  // initial properties
  this.selectedIndex = 0;
  // how many frames slider has been in same position
  this.restingFrames = 0;
  // initial physics properties
  this.x = 0;
  this.velocity = 0;
  this.originSide = this.options.rightToLeft ? 'right' : 'left';
  // create viewport & slider
  this.viewport = document.createElement('div');
  this.viewport.className = 'flickity-viewport';
  this._createSlider();

  if ( this.options.resize || this.options.watchCSS ) {
    window.addEventListener( 'resize', this );
  }

  // add listeners from on option
  for ( var eventName in this.options.on ) {
    var listener = this.options.on[ eventName ];
    this.on( eventName, listener );
  }

  Flickity.createMethods.forEach( function( method ) {
    this[ method ]();
  }, this );

  if ( this.options.watchCSS ) {
    this.watchCSS();
  } else {
    this.activate();
  }

};

/**
 * set options
 * @param {Object} opts - options to extend
 */
proto.option = function( opts ) {
  utils.extend( this.options, opts );
};

proto.activate = function() {
  if ( this.isActive ) {
    return;
  }
  this.isActive = true;
  this.element.classList.add('flickity-enabled');
  if ( this.options.rightToLeft ) {
    this.element.classList.add('flickity-rtl');
  }

  this.getSize();
  // move initial cell elements so they can be loaded as cells
  var cellElems = this._filterFindCellElements( this.element.children );
  moveElements( cellElems, this.slider );
  this.viewport.appendChild( this.slider );
  this.element.appendChild( this.viewport );
  // get cells from children
  this.reloadCells();

  if ( this.options.accessibility ) {
    // allow element to focusable
    this.element.tabIndex = 0;
    // listen for key presses
    this.element.addEventListener( 'keydown', this );
  }

  this.emitEvent('activate');
  this.selectInitialIndex();
  // flag for initial activation, for using initialIndex
  this.isInitActivated = true;
  // ready event. #493
  this.dispatchEvent('ready');
};

// slider positions the cells
proto._createSlider = function() {
  // slider element does all the positioning
  var slider = document.createElement('div');
  slider.className = 'flickity-slider';
  slider.style[ this.originSide ] = 0;
  this.slider = slider;
};

proto._filterFindCellElements = function( elems ) {
  return utils.filterFindElements( elems, this.options.cellSelector );
};

// goes through all children
proto.reloadCells = function() {
  // collection of item elements
  this.cells = this._makeCells( this.slider.children );
  this.positionCells();
  this._getWrapShiftCells();
  this.setGallerySize();
};

/**
 * turn elements into Flickity.Cells
 * @param {[Array, NodeList, HTMLElement]} elems - elements to make into cells
 * @returns {Array} items - collection of new Flickity Cells
 */
proto._makeCells = function( elems ) {
  var cellElems = this._filterFindCellElements( elems );

  // create new Flickity for collection
  var cells = cellElems.map( function( cellElem ) {
    return new Cell( cellElem, this );
  }, this );

  return cells;
};

proto.getLastCell = function() {
  return this.cells[ this.cells.length - 1 ];
};

proto.getLastSlide = function() {
  return this.slides[ this.slides.length - 1 ];
};

// positions all cells
proto.positionCells = function() {
  // size all cells
  this._sizeCells( this.cells );
  // position all cells
  this._positionCells( 0 );
};

/**
 * position certain cells
 * @param {Integer} index - which cell to start with
 */
proto._positionCells = function( index ) {
  index = index || 0;
  // also measure maxCellHeight
  // start 0 if positioning all cells
  this.maxCellHeight = index ? this.maxCellHeight || 0 : 0;
  var cellX = 0;
  // get cellX
  if ( index > 0 ) {
    var startCell = this.cells[ index - 1 ];
    cellX = startCell.x + startCell.size.outerWidth;
  }
  var len = this.cells.length;
  for ( var i = index; i < len; i++ ) {
    var cell = this.cells[i];
    cell.setPosition( cellX );
    cellX += cell.size.outerWidth;
    this.maxCellHeight = Math.max( cell.size.outerHeight, this.maxCellHeight );
  }
  // keep track of cellX for wrap-around
  this.slideableWidth = cellX;
  // slides
  this.updateSlides();
  // contain slides target
  this._containSlides();
  // update slidesWidth
  this.slidesWidth = len ? this.getLastSlide().target - this.slides[0].target : 0;
};

/**
 * cell.getSize() on multiple cells
 * @param {Array} cells - cells to size
 */
proto._sizeCells = function( cells ) {
  cells.forEach( function( cell ) {
    cell.getSize();
  } );
};

// --------------------------  -------------------------- //

proto.updateSlides = function() {
  this.slides = [];
  if ( !this.cells.length ) {
    return;
  }

  var slide = new Slide( this );
  this.slides.push( slide );
  var isOriginLeft = this.originSide == 'left';
  var nextMargin = isOriginLeft ? 'marginRight' : 'marginLeft';

  var canCellFit = this._getCanCellFit();

  this.cells.forEach( function( cell, i ) {
    // just add cell if first cell in slide
    if ( !slide.cells.length ) {
      slide.addCell( cell );
      return;
    }

    var slideWidth = ( slide.outerWidth - slide.firstMargin ) +
      ( cell.size.outerWidth - cell.size[ nextMargin ] );

    if ( canCellFit.call( this, i, slideWidth ) ) {
      slide.addCell( cell );
    } else {
      // doesn't fit, new slide
      slide.updateTarget();

      slide = new Slide( this );
      this.slides.push( slide );
      slide.addCell( cell );
    }
  }, this );
  // last slide
  slide.updateTarget();
  // update .selectedSlide
  this.updateSelectedSlide();
};

proto._getCanCellFit = function() {
  var groupCells = this.options.groupCells;
  if ( !groupCells ) {
    return function() {
      return false;
    };
  } else if ( typeof groupCells == 'number' ) {
    // group by number. 3 -> [0,1,2], [3,4,5], ...
    var number = parseInt( groupCells, 10 );
    return function( i ) {
      return ( i % number ) !== 0;
    };
  }
  // default, group by width of slide
  // parse '75%
  var percentMatch = typeof groupCells == 'string' &&
    groupCells.match( /^(\d+)%$/ );
  var percent = percentMatch ? parseInt( percentMatch[1], 10 ) / 100 : 1;
  return function( i, slideWidth ) {
    /* eslint-disable-next-line no-invalid-this */
    return slideWidth <= ( this.size.innerWidth + 1 ) * percent;
  };
};

// alias _init for jQuery plugin .flickity()
proto._init =
proto.reposition = function() {
  this.positionCells();
  this.positionSliderAtSelected();
};

proto.getSize = function() {
  this.size = getSize( this.element );
  this.setCellAlign();
  this.cursorPosition = this.size.innerWidth * this.cellAlign;
};

var cellAlignShorthands = {
  // cell align, then based on origin side
  center: {
    left: 0.5,
    right: 0.5,
  },
  left: {
    left: 0,
    right: 1,
  },
  right: {
    right: 0,
    left: 1,
  },
};

proto.setCellAlign = function() {
  var shorthand = cellAlignShorthands[ this.options.cellAlign ];
  this.cellAlign = shorthand ? shorthand[ this.originSide ] : this.options.cellAlign;
};

proto.setGallerySize = function() {
  if ( this.options.setGallerySize ) {
    var height = this.options.adaptiveHeight && this.selectedSlide ?
      this.selectedSlide.height : this.maxCellHeight;
    this.viewport.style.height = height + 'px';
  }
};

proto._getWrapShiftCells = function() {
  // only for wrap-around
  if ( !this.options.wrapAround ) {
    return;
  }
  // unshift previous cells
  this._unshiftCells( this.beforeShiftCells );
  this._unshiftCells( this.afterShiftCells );
  // get before cells
  // initial gap
  var gapX = this.cursorPosition;
  var cellIndex = this.cells.length - 1;
  this.beforeShiftCells = this._getGapCells( gapX, cellIndex, -1 );
  // get after cells
  // ending gap between last cell and end of gallery viewport
  gapX = this.size.innerWidth - this.cursorPosition;
  // start cloning at first cell, working forwards
  this.afterShiftCells = this._getGapCells( gapX, 0, 1 );
};

proto._getGapCells = function( gapX, cellIndex, increment ) {
  // keep adding cells until the cover the initial gap
  var cells = [];
  while ( gapX > 0 ) {
    var cell = this.cells[ cellIndex ];
    if ( !cell ) {
      break;
    }
    cells.push( cell );
    cellIndex += increment;
    gapX -= cell.size.outerWidth;
  }
  return cells;
};

// ----- contain ----- //

// contain cell targets so no excess sliding
proto._containSlides = function() {
  if ( !this.options.contain || this.options.wrapAround || !this.cells.length ) {
    return;
  }
  var isRightToLeft = this.options.rightToLeft;
  var beginMargin = isRightToLeft ? 'marginRight' : 'marginLeft';
  var endMargin = isRightToLeft ? 'marginLeft' : 'marginRight';
  var contentWidth = this.slideableWidth - this.getLastCell().size[ endMargin ];
  // content is less than gallery size
  var isContentSmaller = contentWidth < this.size.innerWidth;
  // bounds
  var beginBound = this.cursorPosition + this.cells[0].size[ beginMargin ];
  var endBound = contentWidth - this.size.innerWidth * ( 1 - this.cellAlign );
  // contain each cell target
  this.slides.forEach( function( slide ) {
    if ( isContentSmaller ) {
      // all cells fit inside gallery
      slide.target = contentWidth * this.cellAlign;
    } else {
      // contain to bounds
      slide.target = Math.max( slide.target, beginBound );
      slide.target = Math.min( slide.target, endBound );
    }
  }, this );
};

// -----  ----- //

/**
 * emits events via eventEmitter and jQuery events
 * @param {String} type - name of event
 * @param {Event} event - original event
 * @param {Array} args - extra arguments
 */
proto.dispatchEvent = function( type, event, args ) {
  var emitArgs = event ? [ event ].concat( args ) : args;
  this.emitEvent( type, emitArgs );

  if ( jQuery && this.$element ) {
    // default trigger with type if no event
    type += this.options.namespaceJQueryEvents ? '.flickity' : '';
    var $event = type;
    if ( event ) {
      // create jQuery event
      var jQEvent = new jQuery.Event( event );
      jQEvent.type = type;
      $event = jQEvent;
    }
    this.$element.trigger( $event, args );
  }
};

// -------------------------- select -------------------------- //

/**
 * @param {Integer} index - index of the slide
 * @param {Boolean} isWrap - will wrap-around to last/first if at the end
 * @param {Boolean} isInstant - will immediately set position at selected cell
 */
proto.select = function( index, isWrap, isInstant ) {
  if ( !this.isActive ) {
    return;
  }
  index = parseInt( index, 10 );
  this._wrapSelect( index );

  if ( this.options.wrapAround || isWrap ) {
    index = utils.modulo( index, this.slides.length );
  }
  // bail if invalid index
  if ( !this.slides[ index ] ) {
    return;
  }
  var prevIndex = this.selectedIndex;
  this.selectedIndex = index;
  this.updateSelectedSlide();
  if ( isInstant ) {
    this.positionSliderAtSelected();
  } else {
    this.startAnimation();
  }
  if ( this.options.adaptiveHeight ) {
    this.setGallerySize();
  }
  // events
  this.dispatchEvent( 'select', null, [ index ] );
  // change event if new index
  if ( index != prevIndex ) {
    this.dispatchEvent( 'change', null, [ index ] );
  }
  // old v1 event name, remove in v3
  this.dispatchEvent('cellSelect');
};

// wraps position for wrapAround, to move to closest slide. #113
proto._wrapSelect = function( index ) {
  var len = this.slides.length;
  var isWrapping = this.options.wrapAround && len > 1;
  if ( !isWrapping ) {
    return index;
  }
  var wrapIndex = utils.modulo( index, len );
  // go to shortest
  var delta = Math.abs( wrapIndex - this.selectedIndex );
  var backWrapDelta = Math.abs( ( wrapIndex + len ) - this.selectedIndex );
  var forewardWrapDelta = Math.abs( ( wrapIndex - len ) - this.selectedIndex );
  if ( !this.isDragSelect && backWrapDelta < delta ) {
    index += len;
  } else if ( !this.isDragSelect && forewardWrapDelta < delta ) {
    index -= len;
  }
  // wrap position so slider is within normal area
  if ( index < 0 ) {
    this.x -= this.slideableWidth;
  } else if ( index >= len ) {
    this.x += this.slideableWidth;
  }
};

proto.previous = function( isWrap, isInstant ) {
  this.select( this.selectedIndex - 1, isWrap, isInstant );
};

proto.next = function( isWrap, isInstant ) {
  this.select( this.selectedIndex + 1, isWrap, isInstant );
};

proto.updateSelectedSlide = function() {
  var slide = this.slides[ this.selectedIndex ];
  // selectedIndex could be outside of slides, if triggered before resize()
  if ( !slide ) {
    return;
  }
  // unselect previous selected slide
  this.unselectSelectedSlide();
  // update new selected slide
  this.selectedSlide = slide;
  slide.select();
  this.selectedCells = slide.cells;
  this.selectedElements = slide.getCellElements();
  // HACK: selectedCell & selectedElement is first cell in slide, backwards compatibility
  // Remove in v3?
  this.selectedCell = slide.cells[0];
  this.selectedElement = this.selectedElements[0];
};

proto.unselectSelectedSlide = function() {
  if ( this.selectedSlide ) {
    this.selectedSlide.unselect();
  }
};

proto.selectInitialIndex = function() {
  var initialIndex = this.options.initialIndex;
  // already activated, select previous selectedIndex
  if ( this.isInitActivated ) {
    this.select( this.selectedIndex, false, true );
    return;
  }
  // select with selector string
  if ( initialIndex && typeof initialIndex == 'string' ) {
    var cell = this.queryCell( initialIndex );
    if ( cell ) {
      this.selectCell( initialIndex, false, true );
      return;
    }
  }

  var index = 0;
  // select with number
  if ( initialIndex && this.slides[ initialIndex ] ) {
    index = initialIndex;
  }
  // select instantly
  this.select( index, false, true );
};

/**
 * select slide from number or cell element
 * @param {[Element, Number]} value - zero-based index or element to select
 * @param {Boolean} isWrap - enables wrapping around for extra index
 * @param {Boolean} isInstant - disables slide animation
 */
proto.selectCell = function( value, isWrap, isInstant ) {
  // get cell
  var cell = this.queryCell( value );
  if ( !cell ) {
    return;
  }

  var index = this.getCellSlideIndex( cell );
  this.select( index, isWrap, isInstant );
};

proto.getCellSlideIndex = function( cell ) {
  // get index of slides that has cell
  for ( var i = 0; i < this.slides.length; i++ ) {
    var slide = this.slides[i];
    var index = slide.cells.indexOf( cell );
    if ( index != -1 ) {
      return i;
    }
  }
};

// -------------------------- get cells -------------------------- //

/**
 * get Flickity.Cell, given an Element
 * @param {Element} elem - matching cell element
 * @returns {Flickity.Cell} cell - matching cell
 */
proto.getCell = function( elem ) {
  // loop through cells to get the one that matches
  for ( var i = 0; i < this.cells.length; i++ ) {
    var cell = this.cells[i];
    if ( cell.element == elem ) {
      return cell;
    }
  }
};

/**
 * get collection of Flickity.Cells, given Elements
 * @param {[Element, Array, NodeList]} elems - multiple elements
 * @returns {Array} cells - Flickity.Cells
 */
proto.getCells = function( elems ) {
  elems = utils.makeArray( elems );
  var cells = [];
  elems.forEach( function( elem ) {
    var cell = this.getCell( elem );
    if ( cell ) {
      cells.push( cell );
    }
  }, this );
  return cells;
};

/**
 * get cell elements
 * @returns {Array} cellElems
 */
proto.getCellElements = function() {
  return this.cells.map( function( cell ) {
    return cell.element;
  } );
};

/**
 * get parent cell from an element
 * @param {Element} elem - child element
 * @returns {Flickit.Cell} cell - parent cell
 */
proto.getParentCell = function( elem ) {
  // first check if elem is cell
  var cell = this.getCell( elem );
  if ( cell ) {
    return cell;
  }
  // try to get parent cell elem
  elem = utils.getParent( elem, '.flickity-slider > *' );
  return this.getCell( elem );
};

/**
 * get cells adjacent to a slide
 * @param {Integer} adjCount - number of adjacent slides
 * @param {Integer} index - index of slide to start
 * @returns {Array} cells - array of Flickity.Cells
 */
proto.getAdjacentCellElements = function( adjCount, index ) {
  if ( !adjCount ) {
    return this.selectedSlide.getCellElements();
  }
  index = index === undefined ? this.selectedIndex : index;

  var len = this.slides.length;
  if ( 1 + ( adjCount * 2 ) >= len ) {
    return this.getCellElements();
  }

  var cellElems = [];
  for ( var i = index - adjCount; i <= index + adjCount; i++ ) {
    var slideIndex = this.options.wrapAround ? utils.modulo( i, len ) : i;
    var slide = this.slides[ slideIndex ];
    if ( slide ) {
      cellElems = cellElems.concat( slide.getCellElements() );
    }
  }
  return cellElems;
};

/**
 * select slide from number or cell element
 * @param {[Element, String, Number]} selector - element, selector string, or index
 * @returns {Flickity.Cell} - matching cell
 */
proto.queryCell = function( selector ) {
  if ( typeof selector == 'number' ) {
    // use number as index
    return this.cells[ selector ];
  }
  if ( typeof selector == 'string' ) {
    // do not select invalid selectors from hash: #123, #/. #791
    if ( selector.match( /^[#.]?[\d/]/ ) ) {
      return;
    }
    // use string as selector, get element
    selector = this.element.querySelector( selector );
  }
  // get cell from element
  return this.getCell( selector );
};

// -------------------------- events -------------------------- //

proto.uiChange = function() {
  this.emitEvent('uiChange');
};

// keep focus on element when child UI elements are clicked
proto.childUIPointerDown = function( event ) {
  // HACK iOS does not allow touch events to bubble up?!
  if ( event.type != 'touchstart' ) {
    event.preventDefault();
  }
  this.focus();
};

// ----- resize ----- //

proto.onresize = function() {
  this.watchCSS();
  this.resize();
};

utils.debounceMethod( Flickity, 'onresize', 150 );

proto.resize = function() {
  // #1177 disable resize behavior when animating or dragging for iOS 15
  if ( !this.isActive || this.isAnimating || this.isDragging ) {
    return;
  }
  this.getSize();
  // wrap values
  if ( this.options.wrapAround ) {
    this.x = utils.modulo( this.x, this.slideableWidth );
  }
  this.positionCells();
  this._getWrapShiftCells();
  this.setGallerySize();
  this.emitEvent('resize');
  // update selected index for group slides, instant
  // TODO: position can be lost between groups of various numbers
  var selectedElement = this.selectedElements && this.selectedElements[0];
  this.selectCell( selectedElement, false, true );
};

// watches the :after property, activates/deactivates
proto.watchCSS = function() {
  var watchOption = this.options.watchCSS;
  if ( !watchOption ) {
    return;
  }

  var afterContent = getComputedStyle( this.element, ':after' ).content;
  // activate if :after { content: 'flickity' }
  if ( afterContent.indexOf('flickity') != -1 ) {
    this.activate();
  } else {
    this.deactivate();
  }
};

// ----- keydown ----- //

// go previous/next if left/right keys pressed
proto.onkeydown = function( event ) {
  // only work if element is in focus
  var isNotFocused = document.activeElement && document.activeElement != this.element;
  if ( !this.options.accessibility || isNotFocused ) {
    return;
  }

  var handler = Flickity.keyboardHandlers[ event.keyCode ];
  if ( handler ) {
    handler.call( this );
  }
};

Flickity.keyboardHandlers = {
  // left arrow
  37: function() {
    var leftMethod = this.options.rightToLeft ? 'next' : 'previous';
    this.uiChange();
    this[ leftMethod ]();
  },
  // right arrow
  39: function() {
    var rightMethod = this.options.rightToLeft ? 'previous' : 'next';
    this.uiChange();
    this[ rightMethod ]();
  },
};

// ----- focus ----- //

proto.focus = function() {
  // TODO remove scrollTo once focus options gets more support
  // https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/focus ...
  //    #Browser_compatibility
  var prevScrollY = window.pageYOffset;
  this.element.focus({ preventScroll: true });
  // hack to fix scroll jump after focus, #76
  if ( window.pageYOffset != prevScrollY ) {
    window.scrollTo( window.pageXOffset, prevScrollY );
  }
};

// -------------------------- destroy -------------------------- //

// deactivate all Flickity functionality, but keep stuff available
proto.deactivate = function() {
  if ( !this.isActive ) {
    return;
  }
  this.element.classList.remove('flickity-enabled');
  this.element.classList.remove('flickity-rtl');
  this.unselectSelectedSlide();
  // destroy cells
  this.cells.forEach( function( cell ) {
    cell.destroy();
  } );
  this.element.removeChild( this.viewport );
  // move child elements back into element
  moveElements( this.slider.children, this.element );
  if ( this.options.accessibility ) {
    this.element.removeAttribute('tabIndex');
    this.element.removeEventListener( 'keydown', this );
  }
  // set flags
  this.isActive = false;
  this.emitEvent('deactivate');
};

proto.destroy = function() {
  this.deactivate();
  window.removeEventListener( 'resize', this );
  this.allOff();
  this.emitEvent('destroy');
  if ( jQuery && this.$element ) {
    jQuery.removeData( this.element, 'flickity' );
  }
  delete this.element.flickityGUID;
  delete instances[ this.guid ];
};

// -------------------------- prototype -------------------------- //

utils.extend( proto, animatePrototype );

// -------------------------- extras -------------------------- //

/**
 * get Flickity instance from element
 * @param {[Element, String]} elem - element or selector string
 * @returns {Flickity} - Flickity instance
 */
Flickity.data = function( elem ) {
  elem = utils.getQueryElement( elem );
  var id = elem && elem.flickityGUID;
  return id && instances[ id ];
};

utils.htmlInit( Flickity, 'flickity' );

if ( jQuery && jQuery.bridget ) {
  jQuery.bridget( 'flickity', Flickity );
}

// set internal jQuery, for Webpack + jQuery v3, #478
Flickity.setJQuery = function( jq ) {
  jQuery = jq;
};

Flickity.Cell = Cell;
Flickity.Slide = Slide;

return Flickity;

} ) );


/***/ }),

/***/ "../../../../../../node_modules/flickity/js/index.js":
/*!***********************************************************!*\
  !*** ../../../../../../node_modules/flickity/js/index.js ***!
  \***********************************************************/
/***/ ((module, exports, __webpack_require__) => {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*!
 * Flickity v2.3.0
 * Touch, responsive, flickable carousels
 *
 * Licensed GPLv3 for open source use
 * or Flickity Commercial License for commercial use
 *
 * https://flickity.metafizzy.co
 * Copyright 2015-2021 Metafizzy
 */

( function( window, factory ) {
  // universal module definition
  if ( true ) {
    // AMD
    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [
      __webpack_require__(/*! ./flickity */ "../../../../../../node_modules/flickity/js/flickity.js"),
      __webpack_require__(/*! ./drag */ "../../../../../../node_modules/flickity/js/drag.js"),
      __webpack_require__(/*! ./prev-next-button */ "../../../../../../node_modules/flickity/js/prev-next-button.js"),
      __webpack_require__(/*! ./page-dots */ "../../../../../../node_modules/flickity/js/page-dots.js"),
      __webpack_require__(/*! ./player */ "../../../../../../node_modules/flickity/js/player.js"),
      __webpack_require__(/*! ./add-remove-cell */ "../../../../../../node_modules/flickity/js/add-remove-cell.js"),
      __webpack_require__(/*! ./lazyload */ "../../../../../../node_modules/flickity/js/lazyload.js"),
    ], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
		__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
		(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
  } else {}

} )( window, function factory( Flickity ) {
  return Flickity;
} );


/***/ }),

/***/ "../../../../../../node_modules/flickity/js/lazyload.js":
/*!**************************************************************!*\
  !*** ../../../../../../node_modules/flickity/js/lazyload.js ***!
  \**************************************************************/
/***/ ((module, exports, __webpack_require__) => {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;// lazyload
( function( window, factory ) {
  // universal module definition
  if ( true ) {
    // AMD
    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [
      __webpack_require__(/*! ./flickity */ "../../../../../../node_modules/flickity/js/flickity.js"),
      __webpack_require__(/*! fizzy-ui-utils/utils */ "../../../../../../node_modules/fizzy-ui-utils/utils.js"),
    ], __WEBPACK_AMD_DEFINE_RESULT__ = (function( Flickity, utils ) {
      return factory( window, Flickity, utils );
    }).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
  } else {}

}( window, function factory( window, Flickity, utils ) {
'use strict';

Flickity.createMethods.push('_createLazyload');
var proto = Flickity.prototype;

proto._createLazyload = function() {
  this.on( 'select', this.lazyLoad );
};

proto.lazyLoad = function() {
  var lazyLoad = this.options.lazyLoad;
  if ( !lazyLoad ) {
    return;
  }
  // get adjacent cells, use lazyLoad option for adjacent count
  var adjCount = typeof lazyLoad == 'number' ? lazyLoad : 0;
  var cellElems = this.getAdjacentCellElements( adjCount );
  // get lazy images in those cells
  var lazyImages = [];
  cellElems.forEach( function( cellElem ) {
    var lazyCellImages = getCellLazyImages( cellElem );
    lazyImages = lazyImages.concat( lazyCellImages );
  } );
  // load lazy images
  lazyImages.forEach( function( img ) {
    new LazyLoader( img, this );
  }, this );
};

function getCellLazyImages( cellElem ) {
  // check if cell element is lazy image
  if ( cellElem.nodeName == 'IMG' ) {
    var lazyloadAttr = cellElem.getAttribute('data-flickity-lazyload');
    var srcAttr = cellElem.getAttribute('data-flickity-lazyload-src');
    var srcsetAttr = cellElem.getAttribute('data-flickity-lazyload-srcset');
    if ( lazyloadAttr || srcAttr || srcsetAttr ) {
      return [ cellElem ];
    }
  }
  // select lazy images in cell
  var lazySelector = 'img[data-flickity-lazyload], ' +
    'img[data-flickity-lazyload-src], img[data-flickity-lazyload-srcset]';
  var imgs = cellElem.querySelectorAll( lazySelector );
  return utils.makeArray( imgs );
}

// -------------------------- LazyLoader -------------------------- //

/**
 * class to handle loading images
 * @param {Image} img - Image element
 * @param {Flickity} flickity - Flickity instance
 */
function LazyLoader( img, flickity ) {
  this.img = img;
  this.flickity = flickity;
  this.load();
}

LazyLoader.prototype.handleEvent = utils.handleEvent;

LazyLoader.prototype.load = function() {
  this.img.addEventListener( 'load', this );
  this.img.addEventListener( 'error', this );
  // get src & srcset
  var src = this.img.getAttribute('data-flickity-lazyload') ||
    this.img.getAttribute('data-flickity-lazyload-src');
  var srcset = this.img.getAttribute('data-flickity-lazyload-srcset');
  // set src & serset
  this.img.src = src;
  if ( srcset ) {
    this.img.setAttribute( 'srcset', srcset );
  }
  // remove attr
  this.img.removeAttribute('data-flickity-lazyload');
  this.img.removeAttribute('data-flickity-lazyload-src');
  this.img.removeAttribute('data-flickity-lazyload-srcset');
};

LazyLoader.prototype.onload = function( event ) {
  this.complete( event, 'flickity-lazyloaded' );
};

LazyLoader.prototype.onerror = function( event ) {
  this.complete( event, 'flickity-lazyerror' );
};

LazyLoader.prototype.complete = function( event, className ) {
  // unbind events
  this.img.removeEventListener( 'load', this );
  this.img.removeEventListener( 'error', this );

  var cell = this.flickity.getParentCell( this.img );
  var cellElem = cell && cell.element;
  this.flickity.cellSizeChange( cellElem );

  this.img.classList.add( className );
  this.flickity.dispatchEvent( 'lazyLoad', event, cellElem );
};

// -----  ----- //

Flickity.LazyLoader = LazyLoader;

return Flickity;

} ) );


/***/ }),

/***/ "../../../../../../node_modules/flickity/js/page-dots.js":
/*!***************************************************************!*\
  !*** ../../../../../../node_modules/flickity/js/page-dots.js ***!
  \***************************************************************/
/***/ ((module, exports, __webpack_require__) => {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;// page dots
( function( window, factory ) {
  // universal module definition
  if ( true ) {
    // AMD
    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [
      __webpack_require__(/*! ./flickity */ "../../../../../../node_modules/flickity/js/flickity.js"),
      __webpack_require__(/*! unipointer/unipointer */ "../../../../../../node_modules/unipointer/unipointer.js"),
      __webpack_require__(/*! fizzy-ui-utils/utils */ "../../../../../../node_modules/fizzy-ui-utils/utils.js"),
    ], __WEBPACK_AMD_DEFINE_RESULT__ = (function( Flickity, Unipointer, utils ) {
      return factory( window, Flickity, Unipointer, utils );
    }).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
  } else {}

}( window, function factory( window, Flickity, Unipointer, utils ) {

// -------------------------- PageDots -------------------------- //

'use strict';

function PageDots( parent ) {
  this.parent = parent;
  this._create();
}

PageDots.prototype = Object.create( Unipointer.prototype );

PageDots.prototype._create = function() {
  // create holder element
  this.holder = document.createElement('ol');
  this.holder.className = 'flickity-page-dots';
  // create dots, array of elements
  this.dots = [];
  // events
  this.handleClick = this.onClick.bind( this );
  this.on( 'pointerDown', this.parent.childUIPointerDown.bind( this.parent ) );
};

PageDots.prototype.activate = function() {
  this.setDots();
  this.holder.addEventListener( 'click', this.handleClick );
  this.bindStartEvent( this.holder );
  // add to DOM
  this.parent.element.appendChild( this.holder );
};

PageDots.prototype.deactivate = function() {
  this.holder.removeEventListener( 'click', this.handleClick );
  this.unbindStartEvent( this.holder );
  // remove from DOM
  this.parent.element.removeChild( this.holder );
};

PageDots.prototype.setDots = function() {
  // get difference between number of slides and number of dots
  var delta = this.parent.slides.length - this.dots.length;
  if ( delta > 0 ) {
    this.addDots( delta );
  } else if ( delta < 0 ) {
    this.removeDots( -delta );
  }
};

PageDots.prototype.addDots = function( count ) {
  var fragment = document.createDocumentFragment();
  var newDots = [];
  var length = this.dots.length;
  var max = length + count;

  for ( var i = length; i < max; i++ ) {
    var dot = document.createElement('li');
    dot.className = 'dot';
    dot.setAttribute( 'aria-label', 'Page dot ' + ( i + 1 ) );
    fragment.appendChild( dot );
    newDots.push( dot );
  }

  this.holder.appendChild( fragment );
  this.dots = this.dots.concat( newDots );
};

PageDots.prototype.removeDots = function( count ) {
  // remove from this.dots collection
  var removeDots = this.dots.splice( this.dots.length - count, count );
  // remove from DOM
  removeDots.forEach( function( dot ) {
    this.holder.removeChild( dot );
  }, this );
};

PageDots.prototype.updateSelected = function() {
  // remove selected class on previous
  if ( this.selectedDot ) {
    this.selectedDot.className = 'dot';
    this.selectedDot.removeAttribute('aria-current');
  }
  // don't proceed if no dots
  if ( !this.dots.length ) {
    return;
  }
  this.selectedDot = this.dots[ this.parent.selectedIndex ];
  this.selectedDot.className = 'dot is-selected';
  this.selectedDot.setAttribute( 'aria-current', 'step' );
};

PageDots.prototype.onTap = // old method name, backwards-compatible
PageDots.prototype.onClick = function( event ) {
  var target = event.target;
  // only care about dot clicks
  if ( target.nodeName != 'LI' ) {
    return;
  }

  this.parent.uiChange();
  var index = this.dots.indexOf( target );
  this.parent.select( index );
};

PageDots.prototype.destroy = function() {
  this.deactivate();
  this.allOff();
};

Flickity.PageDots = PageDots;

// -------------------------- Flickity -------------------------- //

utils.extend( Flickity.defaults, {
  pageDots: true,
} );

Flickity.createMethods.push('_createPageDots');

var proto = Flickity.prototype;

proto._createPageDots = function() {
  if ( !this.options.pageDots ) {
    return;
  }
  this.pageDots = new PageDots( this );
  // events
  this.on( 'activate', this.activatePageDots );
  this.on( 'select', this.updateSelectedPageDots );
  this.on( 'cellChange', this.updatePageDots );
  this.on( 'resize', this.updatePageDots );
  this.on( 'deactivate', this.deactivatePageDots );
};

proto.activatePageDots = function() {
  this.pageDots.activate();
};

proto.updateSelectedPageDots = function() {
  this.pageDots.updateSelected();
};

proto.updatePageDots = function() {
  this.pageDots.setDots();
};

proto.deactivatePageDots = function() {
  this.pageDots.deactivate();
};

// -----  ----- //

Flickity.PageDots = PageDots;

return Flickity;

} ) );


/***/ }),

/***/ "../../../../../../node_modules/flickity/js/player.js":
/*!************************************************************!*\
  !*** ../../../../../../node_modules/flickity/js/player.js ***!
  \************************************************************/
/***/ ((module, exports, __webpack_require__) => {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;// player & autoPlay
( function( window, factory ) {
  // universal module definition
  if ( true ) {
    // AMD
    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [
      __webpack_require__(/*! ev-emitter/ev-emitter */ "../../../../../../node_modules/ev-emitter/ev-emitter.js"),
      __webpack_require__(/*! fizzy-ui-utils/utils */ "../../../../../../node_modules/fizzy-ui-utils/utils.js"),
      __webpack_require__(/*! ./flickity */ "../../../../../../node_modules/flickity/js/flickity.js"),
    ], __WEBPACK_AMD_DEFINE_RESULT__ = (function( EvEmitter, utils, Flickity ) {
      return factory( EvEmitter, utils, Flickity );
    }).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
  } else {}

}( window, function factory( EvEmitter, utils, Flickity ) {

'use strict';

// -------------------------- Player -------------------------- //

function Player( parent ) {
  this.parent = parent;
  this.state = 'stopped';
  // visibility change event handler
  this.onVisibilityChange = this.visibilityChange.bind( this );
  this.onVisibilityPlay = this.visibilityPlay.bind( this );
}

Player.prototype = Object.create( EvEmitter.prototype );

// start play
Player.prototype.play = function() {
  if ( this.state == 'playing' ) {
    return;
  }
  // do not play if page is hidden, start playing when page is visible
  var isPageHidden = document.hidden;
  if ( isPageHidden ) {
    document.addEventListener( 'visibilitychange', this.onVisibilityPlay );
    return;
  }

  this.state = 'playing';
  // listen to visibility change
  document.addEventListener( 'visibilitychange', this.onVisibilityChange );
  // start ticking
  this.tick();
};

Player.prototype.tick = function() {
  // do not tick if not playing
  if ( this.state != 'playing' ) {
    return;
  }

  var time = this.parent.options.autoPlay;
  // default to 3 seconds
  time = typeof time == 'number' ? time : 3000;
  var _this = this;
  // HACK: reset ticks if stopped and started within interval
  this.clear();
  this.timeout = setTimeout( function() {
    _this.parent.next( true );
    _this.tick();
  }, time );
};

Player.prototype.stop = function() {
  this.state = 'stopped';
  this.clear();
  // remove visibility change event
  document.removeEventListener( 'visibilitychange', this.onVisibilityChange );
};

Player.prototype.clear = function() {
  clearTimeout( this.timeout );
};

Player.prototype.pause = function() {
  if ( this.state == 'playing' ) {
    this.state = 'paused';
    this.clear();
  }
};

Player.prototype.unpause = function() {
  // re-start play if paused
  if ( this.state == 'paused' ) {
    this.play();
  }
};

// pause if page visibility is hidden, unpause if visible
Player.prototype.visibilityChange = function() {
  var isPageHidden = document.hidden;
  this[ isPageHidden ? 'pause' : 'unpause' ]();
};

Player.prototype.visibilityPlay = function() {
  this.play();
  document.removeEventListener( 'visibilitychange', this.onVisibilityPlay );
};

// -------------------------- Flickity -------------------------- //

utils.extend( Flickity.defaults, {
  pauseAutoPlayOnHover: true,
} );

Flickity.createMethods.push('_createPlayer');
var proto = Flickity.prototype;

proto._createPlayer = function() {
  this.player = new Player( this );

  this.on( 'activate', this.activatePlayer );
  this.on( 'uiChange', this.stopPlayer );
  this.on( 'pointerDown', this.stopPlayer );
  this.on( 'deactivate', this.deactivatePlayer );
};

proto.activatePlayer = function() {
  if ( !this.options.autoPlay ) {
    return;
  }
  this.player.play();
  this.element.addEventListener( 'mouseenter', this );
};

// Player API, don't hate the ... thanks I know where the door is

proto.playPlayer = function() {
  this.player.play();
};

proto.stopPlayer = function() {
  this.player.stop();
};

proto.pausePlayer = function() {
  this.player.pause();
};

proto.unpausePlayer = function() {
  this.player.unpause();
};

proto.deactivatePlayer = function() {
  this.player.stop();
  this.element.removeEventListener( 'mouseenter', this );
};

// ----- mouseenter/leave ----- //

// pause auto-play on hover
proto.onmouseenter = function() {
  if ( !this.options.pauseAutoPlayOnHover ) {
    return;
  }
  this.player.pause();
  this.element.addEventListener( 'mouseleave', this );
};

// resume auto-play on hover off
proto.onmouseleave = function() {
  this.player.unpause();
  this.element.removeEventListener( 'mouseleave', this );
};

// -----  ----- //

Flickity.Player = Player;

return Flickity;

} ) );


/***/ }),

/***/ "../../../../../../node_modules/flickity/js/prev-next-button.js":
/*!**********************************************************************!*\
  !*** ../../../../../../node_modules/flickity/js/prev-next-button.js ***!
  \**********************************************************************/
/***/ ((module, exports, __webpack_require__) => {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;// prev/next buttons
( function( window, factory ) {
  // universal module definition
  if ( true ) {
    // AMD
    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [
      __webpack_require__(/*! ./flickity */ "../../../../../../node_modules/flickity/js/flickity.js"),
      __webpack_require__(/*! unipointer/unipointer */ "../../../../../../node_modules/unipointer/unipointer.js"),
      __webpack_require__(/*! fizzy-ui-utils/utils */ "../../../../../../node_modules/fizzy-ui-utils/utils.js"),
    ], __WEBPACK_AMD_DEFINE_RESULT__ = (function( Flickity, Unipointer, utils ) {
      return factory( window, Flickity, Unipointer, utils );
    }).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
  } else {}

}( window, function factory( window, Flickity, Unipointer, utils ) {
'use strict';

var svgURI = 'http://www.w3.org/2000/svg';

// -------------------------- PrevNextButton -------------------------- //

function PrevNextButton( direction, parent ) {
  this.direction = direction;
  this.parent = parent;
  this._create();
}

PrevNextButton.prototype = Object.create( Unipointer.prototype );

PrevNextButton.prototype._create = function() {
  // properties
  this.isEnabled = true;
  this.isPrevious = this.direction == -1;
  var leftDirection = this.parent.options.rightToLeft ? 1 : -1;
  this.isLeft = this.direction == leftDirection;

  var element = this.element = document.createElement('button');
  element.className = 'flickity-button flickity-prev-next-button';
  element.className += this.isPrevious ? ' previous' : ' next';
  // prevent button from submitting form http://stackoverflow.com/a/10836076/182183
  element.setAttribute( 'type', 'button' );
  // init as disabled
  this.disable();

  element.setAttribute( 'aria-label', this.isPrevious ? 'Previous' : 'Next' );

  // create arrow
  var svg = this.createSVG();
  element.appendChild( svg );
  // events
  this.parent.on( 'select', this.update.bind( this ) );
  this.on( 'pointerDown', this.parent.childUIPointerDown.bind( this.parent ) );
};

PrevNextButton.prototype.activate = function() {
  this.bindStartEvent( this.element );
  this.element.addEventListener( 'click', this );
  // add to DOM
  this.parent.element.appendChild( this.element );
};

PrevNextButton.prototype.deactivate = function() {
  // remove from DOM
  this.parent.element.removeChild( this.element );
  // click events
  this.unbindStartEvent( this.element );
  this.element.removeEventListener( 'click', this );
};

PrevNextButton.prototype.createSVG = function() {
  var svg = document.createElementNS( svgURI, 'svg' );
  svg.setAttribute( 'class', 'flickity-button-icon' );
  svg.setAttribute( 'viewBox', '0 0 100 100' );
  var path = document.createElementNS( svgURI, 'path' );
  var pathMovements = getArrowMovements( this.parent.options.arrowShape );
  path.setAttribute( 'd', pathMovements );
  path.setAttribute( 'class', 'arrow' );
  // rotate arrow
  if ( !this.isLeft ) {
    path.setAttribute( 'transform', 'translate(100, 100) rotate(180) ' );
  }
  svg.appendChild( path );
  return svg;
};

// get SVG path movmement
function getArrowMovements( shape ) {
  // use shape as movement if string
  if ( typeof shape == 'string' ) {
    return shape;
  }
  // create movement string
  return 'M ' + shape.x0 + ',50' +
    ' L ' + shape.x1 + ',' + ( shape.y1 + 50 ) +
    ' L ' + shape.x2 + ',' + ( shape.y2 + 50 ) +
    ' L ' + shape.x3 + ',50 ' +
    ' L ' + shape.x2 + ',' + ( 50 - shape.y2 ) +
    ' L ' + shape.x1 + ',' + ( 50 - shape.y1 ) +
    ' Z';
}

PrevNextButton.prototype.handleEvent = utils.handleEvent;

PrevNextButton.prototype.onclick = function() {
  if ( !this.isEnabled ) {
    return;
  }
  this.parent.uiChange();
  var method = this.isPrevious ? 'previous' : 'next';
  this.parent[ method ]();
};

// -----  ----- //

PrevNextButton.prototype.enable = function() {
  if ( this.isEnabled ) {
    return;
  }
  this.element.disabled = false;
  this.isEnabled = true;
};

PrevNextButton.prototype.disable = function() {
  if ( !this.isEnabled ) {
    return;
  }
  this.element.disabled = true;
  this.isEnabled = false;
};

PrevNextButton.prototype.update = function() {
  // index of first or last slide, if previous or next
  var slides = this.parent.slides;
  // enable is wrapAround and at least 2 slides
  if ( this.parent.options.wrapAround && slides.length > 1 ) {
    this.enable();
    return;
  }
  var lastIndex = slides.length ? slides.length - 1 : 0;
  var boundIndex = this.isPrevious ? 0 : lastIndex;
  var method = this.parent.selectedIndex == boundIndex ? 'disable' : 'enable';
  this[ method ]();
};

PrevNextButton.prototype.destroy = function() {
  this.deactivate();
  this.allOff();
};

// -------------------------- Flickity prototype -------------------------- //

utils.extend( Flickity.defaults, {
  prevNextButtons: true,
  arrowShape: {
    x0: 10,
    x1: 60, y1: 50,
    x2: 70, y2: 40,
    x3: 30,
  },
} );

Flickity.createMethods.push('_createPrevNextButtons');
var proto = Flickity.prototype;

proto._createPrevNextButtons = function() {
  if ( !this.options.prevNextButtons ) {
    return;
  }

  this.prevButton = new PrevNextButton( -1, this );
  this.nextButton = new PrevNextButton( 1, this );

  this.on( 'activate', this.activatePrevNextButtons );
};

proto.activatePrevNextButtons = function() {
  this.prevButton.activate();
  this.nextButton.activate();
  this.on( 'deactivate', this.deactivatePrevNextButtons );
};

proto.deactivatePrevNextButtons = function() {
  this.prevButton.deactivate();
  this.nextButton.deactivate();
  this.off( 'deactivate', this.deactivatePrevNextButtons );
};

// --------------------------  -------------------------- //

Flickity.PrevNextButton = PrevNextButton;

return Flickity;

} ) );


/***/ }),

/***/ "../../../../../../node_modules/flickity/js/slide.js":
/*!***********************************************************!*\
  !*** ../../../../../../node_modules/flickity/js/slide.js ***!
  \***********************************************************/
/***/ ((module, exports, __webpack_require__) => {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_RESULT__;// slide
( function( window, factory ) {
  // universal module definition
  if ( true ) {
    // AMD
    !(__WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
		__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
		(__WEBPACK_AMD_DEFINE_FACTORY__.call(exports, __webpack_require__, exports, module)) :
		__WEBPACK_AMD_DEFINE_FACTORY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
  } else {}

}( window, function factory() {
'use strict';

function Slide( parent ) {
  this.parent = parent;
  this.isOriginLeft = parent.originSide == 'left';
  this.cells = [];
  this.outerWidth = 0;
  this.height = 0;
}

var proto = Slide.prototype;

proto.addCell = function( cell ) {
  this.cells.push( cell );
  this.outerWidth += cell.size.outerWidth;
  this.height = Math.max( cell.size.outerHeight, this.height );
  // first cell stuff
  if ( this.cells.length == 1 ) {
    this.x = cell.x; // x comes from first cell
    var beginMargin = this.isOriginLeft ? 'marginLeft' : 'marginRight';
    this.firstMargin = cell.size[ beginMargin ];
  }
};

proto.updateTarget = function() {
  var endMargin = this.isOriginLeft ? 'marginRight' : 'marginLeft';
  var lastCell = this.getLastCell();
  var lastMargin = lastCell ? lastCell.size[ endMargin ] : 0;
  var slideWidth = this.outerWidth - ( this.firstMargin + lastMargin );
  this.target = this.x + this.firstMargin + slideWidth * this.parent.cellAlign;
};

proto.getLastCell = function() {
  return this.cells[ this.cells.length - 1 ];
};

proto.select = function() {
  this.cells.forEach( function( cell ) {
    cell.select();
  } );
};

proto.unselect = function() {
  this.cells.forEach( function( cell ) {
    cell.unselect();
  } );
};

proto.getCellElements = function() {
  return this.cells.map( function( cell ) {
    return cell.element;
  } );
};

return Slide;

} ) );


/***/ }),

/***/ "../../../../../../node_modules/get-size/get-size.js":
/*!***********************************************************!*\
  !*** ../../../../../../node_modules/get-size/get-size.js ***!
  \***********************************************************/
/***/ ((module, exports, __webpack_require__) => {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_RESULT__;/*!
 * getSize v2.0.3
 * measure size of elements
 * MIT license
 */

/* jshint browser: true, strict: true, undef: true, unused: true */
/* globals console: false */

( function( window, factory ) {
  /* jshint strict: false */ /* globals define, module */
  if ( true ) {
    // AMD
    !(__WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
		__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
		(__WEBPACK_AMD_DEFINE_FACTORY__.call(exports, __webpack_require__, exports, module)) :
		__WEBPACK_AMD_DEFINE_FACTORY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
  } else {}

})( window, function factory() {
'use strict';

// -------------------------- helpers -------------------------- //

// get a number from a string, not a percentage
function getStyleSize( value ) {
  var num = parseFloat( value );
  // not a percent like '100%', and a number
  var isValid = value.indexOf('%') == -1 && !isNaN( num );
  return isValid && num;
}

function noop() {}

var logError = typeof console == 'undefined' ? noop :
  function( message ) {
    console.error( message );
  };

// -------------------------- measurements -------------------------- //

var measurements = [
  'paddingLeft',
  'paddingRight',
  'paddingTop',
  'paddingBottom',
  'marginLeft',
  'marginRight',
  'marginTop',
  'marginBottom',
  'borderLeftWidth',
  'borderRightWidth',
  'borderTopWidth',
  'borderBottomWidth'
];

var measurementsLength = measurements.length;

function getZeroSize() {
  var size = {
    width: 0,
    height: 0,
    innerWidth: 0,
    innerHeight: 0,
    outerWidth: 0,
    outerHeight: 0
  };
  for ( var i=0; i < measurementsLength; i++ ) {
    var measurement = measurements[i];
    size[ measurement ] = 0;
  }
  return size;
}

// -------------------------- getStyle -------------------------- //

/**
 * getStyle, get style of element, check for Firefox bug
 * https://bugzilla.mozilla.org/show_bug.cgi?id=548397
 */
function getStyle( elem ) {
  var style = getComputedStyle( elem );
  if ( !style ) {
    logError( 'Style returned ' + style +
      '. Are you running this code in a hidden iframe on Firefox? ' +
      'See https://bit.ly/getsizebug1' );
  }
  return style;
}

// -------------------------- setup -------------------------- //

var isSetup = false;

var isBoxSizeOuter;

/**
 * setup
 * check isBoxSizerOuter
 * do on first getSize() rather than on page load for Firefox bug
 */
function setup() {
  // setup once
  if ( isSetup ) {
    return;
  }
  isSetup = true;

  // -------------------------- box sizing -------------------------- //

  /**
   * Chrome & Safari measure the outer-width on style.width on border-box elems
   * IE11 & Firefox<29 measures the inner-width
   */
  var div = document.createElement('div');
  div.style.width = '200px';
  div.style.padding = '1px 2px 3px 4px';
  div.style.borderStyle = 'solid';
  div.style.borderWidth = '1px 2px 3px 4px';
  div.style.boxSizing = 'border-box';

  var body = document.body || document.documentElement;
  body.appendChild( div );
  var style = getStyle( div );
  // round value for browser zoom. desandro/masonry#928
  isBoxSizeOuter = Math.round( getStyleSize( style.width ) ) == 200;
  getSize.isBoxSizeOuter = isBoxSizeOuter;

  body.removeChild( div );
}

// -------------------------- getSize -------------------------- //

function getSize( elem ) {
  setup();

  // use querySeletor if elem is string
  if ( typeof elem == 'string' ) {
    elem = document.querySelector( elem );
  }

  // do not proceed on non-objects
  if ( !elem || typeof elem != 'object' || !elem.nodeType ) {
    return;
  }

  var style = getStyle( elem );

  // if hidden, everything is 0
  if ( style.display == 'none' ) {
    return getZeroSize();
  }

  var size = {};
  size.width = elem.offsetWidth;
  size.height = elem.offsetHeight;

  var isBorderBox = size.isBorderBox = style.boxSizing == 'border-box';

  // get all measurements
  for ( var i=0; i < measurementsLength; i++ ) {
    var measurement = measurements[i];
    var value = style[ measurement ];
    var num = parseFloat( value );
    // any 'auto', 'medium' value will be 0
    size[ measurement ] = !isNaN( num ) ? num : 0;
  }

  var paddingWidth = size.paddingLeft + size.paddingRight;
  var paddingHeight = size.paddingTop + size.paddingBottom;
  var marginWidth = size.marginLeft + size.marginRight;
  var marginHeight = size.marginTop + size.marginBottom;
  var borderWidth = size.borderLeftWidth + size.borderRightWidth;
  var borderHeight = size.borderTopWidth + size.borderBottomWidth;

  var isBorderBoxSizeOuter = isBorderBox && isBoxSizeOuter;

  // overwrite width and height if we can get it from style
  var styleWidth = getStyleSize( style.width );
  if ( styleWidth !== false ) {
    size.width = styleWidth +
      // add padding and border unless it's already including it
      ( isBorderBoxSizeOuter ? 0 : paddingWidth + borderWidth );
  }

  var styleHeight = getStyleSize( style.height );
  if ( styleHeight !== false ) {
    size.height = styleHeight +
      // add padding and border unless it's already including it
      ( isBorderBoxSizeOuter ? 0 : paddingHeight + borderHeight );
  }

  size.innerWidth = size.width - ( paddingWidth + borderWidth );
  size.innerHeight = size.height - ( paddingHeight + borderHeight );

  size.outerWidth = size.width + marginWidth;
  size.outerHeight = size.height + marginHeight;

  return size;
}

return getSize;

});


/***/ }),

/***/ "../../../../../../node_modules/lodash.throttle/index.js":
/*!***************************************************************!*\
  !*** ../../../../../../node_modules/lodash.throttle/index.js ***!
  \***************************************************************/
/***/ ((module) => {

/**
 * lodash (Custom Build) <https://lodash.com/>
 * Build: `lodash modularize exports="npm" -o ./`
 * Copyright jQuery Foundation and other contributors <https://jquery.org/>
 * Released under MIT license <https://lodash.com/license>
 * Based on Underscore.js 1.8.3 <http://underscorejs.org/LICENSE>
 * Copyright Jeremy Ashkenas, DocumentCloud and Investigative Reporters & Editors
 */

/** Used as the `TypeError` message for "Functions" methods. */
var FUNC_ERROR_TEXT = 'Expected a function';

/** Used as references for various `Number` constants. */
var NAN = 0 / 0;

/** `Object#toString` result references. */
var symbolTag = '[object Symbol]';

/** Used to match leading and trailing whitespace. */
var reTrim = /^\s+|\s+$/g;

/** Used to detect bad signed hexadecimal string values. */
var reIsBadHex = /^[-+]0x[0-9a-f]+$/i;

/** Used to detect binary string values. */
var reIsBinary = /^0b[01]+$/i;

/** Used to detect octal string values. */
var reIsOctal = /^0o[0-7]+$/i;

/** Built-in method references without a dependency on `root`. */
var freeParseInt = parseInt;

/** Detect free variable `global` from Node.js. */
var freeGlobal = typeof global == 'object' && global && global.Object === Object && global;

/** Detect free variable `self`. */
var freeSelf = typeof self == 'object' && self && self.Object === Object && self;

/** Used as a reference to the global object. */
var root = freeGlobal || freeSelf || Function('return this')();

/** Used for built-in method references. */
var objectProto = Object.prototype;

/**
 * Used to resolve the
 * [`toStringTag`](http://ecma-international.org/ecma-262/7.0/#sec-object.prototype.tostring)
 * of values.
 */
var objectToString = objectProto.toString;

/* Built-in method references for those with the same name as other `lodash` methods. */
var nativeMax = Math.max,
    nativeMin = Math.min;

/**
 * Gets the timestamp of the number of milliseconds that have elapsed since
 * the Unix epoch (1 January 1970 00:00:00 UTC).
 *
 * @static
 * @memberOf _
 * @since 2.4.0
 * @category Date
 * @returns {number} Returns the timestamp.
 * @example
 *
 * _.defer(function(stamp) {
 *   console.log(_.now() - stamp);
 * }, _.now());
 * // => Logs the number of milliseconds it took for the deferred invocation.
 */
var now = function() {
  return root.Date.now();
};

/**
 * Creates a debounced function that delays invoking `func` until after `wait`
 * milliseconds have elapsed since the last time the debounced function was
 * invoked. The debounced function comes with a `cancel` method to cancel
 * delayed `func` invocations and a `flush` method to immediately invoke them.
 * Provide `options` to indicate whether `func` should be invoked on the
 * leading and/or trailing edge of the `wait` timeout. The `func` is invoked
 * with the last arguments provided to the debounced function. Subsequent
 * calls to the debounced function return the result of the last `func`
 * invocation.
 *
 * **Note:** If `leading` and `trailing` options are `true`, `func` is
 * invoked on the trailing edge of the timeout only if the debounced function
 * is invoked more than once during the `wait` timeout.
 *
 * If `wait` is `0` and `leading` is `false`, `func` invocation is deferred
 * until to the next tick, similar to `setTimeout` with a timeout of `0`.
 *
 * See [David Corbacho's article](https://css-tricks.com/debouncing-throttling-explained-examples/)
 * for details over the differences between `_.debounce` and `_.throttle`.
 *
 * @static
 * @memberOf _
 * @since 0.1.0
 * @category Function
 * @param {Function} func The function to debounce.
 * @param {number} [wait=0] The number of milliseconds to delay.
 * @param {Object} [options={}] The options object.
 * @param {boolean} [options.leading=false]
 *  Specify invoking on the leading edge of the timeout.
 * @param {number} [options.maxWait]
 *  The maximum time `func` is allowed to be delayed before it's invoked.
 * @param {boolean} [options.trailing=true]
 *  Specify invoking on the trailing edge of the timeout.
 * @returns {Function} Returns the new debounced function.
 * @example
 *
 * // Avoid costly calculations while the window size is in flux.
 * jQuery(window).on('resize', _.debounce(calculateLayout, 150));
 *
 * // Invoke `sendMail` when clicked, debouncing subsequent calls.
 * jQuery(element).on('click', _.debounce(sendMail, 300, {
 *   'leading': true,
 *   'trailing': false
 * }));
 *
 * // Ensure `batchLog` is invoked once after 1 second of debounced calls.
 * var debounced = _.debounce(batchLog, 250, { 'maxWait': 1000 });
 * var source = new EventSource('/stream');
 * jQuery(source).on('message', debounced);
 *
 * // Cancel the trailing debounced invocation.
 * jQuery(window).on('popstate', debounced.cancel);
 */
function debounce(func, wait, options) {
  var lastArgs,
      lastThis,
      maxWait,
      result,
      timerId,
      lastCallTime,
      lastInvokeTime = 0,
      leading = false,
      maxing = false,
      trailing = true;

  if (typeof func != 'function') {
    throw new TypeError(FUNC_ERROR_TEXT);
  }
  wait = toNumber(wait) || 0;
  if (isObject(options)) {
    leading = !!options.leading;
    maxing = 'maxWait' in options;
    maxWait = maxing ? nativeMax(toNumber(options.maxWait) || 0, wait) : maxWait;
    trailing = 'trailing' in options ? !!options.trailing : trailing;
  }

  function invokeFunc(time) {
    var args = lastArgs,
        thisArg = lastThis;

    lastArgs = lastThis = undefined;
    lastInvokeTime = time;
    result = func.apply(thisArg, args);
    return result;
  }

  function leadingEdge(time) {
    // Reset any `maxWait` timer.
    lastInvokeTime = time;
    // Start the timer for the trailing edge.
    timerId = setTimeout(timerExpired, wait);
    // Invoke the leading edge.
    return leading ? invokeFunc(time) : result;
  }

  function remainingWait(time) {
    var timeSinceLastCall = time - lastCallTime,
        timeSinceLastInvoke = time - lastInvokeTime,
        result = wait - timeSinceLastCall;

    return maxing ? nativeMin(result, maxWait - timeSinceLastInvoke) : result;
  }

  function shouldInvoke(time) {
    var timeSinceLastCall = time - lastCallTime,
        timeSinceLastInvoke = time - lastInvokeTime;

    // Either this is the first call, activity has stopped and we're at the
    // trailing edge, the system time has gone backwards and we're treating
    // it as the trailing edge, or we've hit the `maxWait` limit.
    return (lastCallTime === undefined || (timeSinceLastCall >= wait) ||
      (timeSinceLastCall < 0) || (maxing && timeSinceLastInvoke >= maxWait));
  }

  function timerExpired() {
    var time = now();
    if (shouldInvoke(time)) {
      return trailingEdge(time);
    }
    // Restart the timer.
    timerId = setTimeout(timerExpired, remainingWait(time));
  }

  function trailingEdge(time) {
    timerId = undefined;

    // Only invoke if we have `lastArgs` which means `func` has been
    // debounced at least once.
    if (trailing && lastArgs) {
      return invokeFunc(time);
    }
    lastArgs = lastThis = undefined;
    return result;
  }

  function cancel() {
    if (timerId !== undefined) {
      clearTimeout(timerId);
    }
    lastInvokeTime = 0;
    lastArgs = lastCallTime = lastThis = timerId = undefined;
  }

  function flush() {
    return timerId === undefined ? result : trailingEdge(now());
  }

  function debounced() {
    var time = now(),
        isInvoking = shouldInvoke(time);

    lastArgs = arguments;
    lastThis = this;
    lastCallTime = time;

    if (isInvoking) {
      if (timerId === undefined) {
        return leadingEdge(lastCallTime);
      }
      if (maxing) {
        // Handle invocations in a tight loop.
        timerId = setTimeout(timerExpired, wait);
        return invokeFunc(lastCallTime);
      }
    }
    if (timerId === undefined) {
      timerId = setTimeout(timerExpired, wait);
    }
    return result;
  }
  debounced.cancel = cancel;
  debounced.flush = flush;
  return debounced;
}

/**
 * Creates a throttled function that only invokes `func` at most once per
 * every `wait` milliseconds. The throttled function comes with a `cancel`
 * method to cancel delayed `func` invocations and a `flush` method to
 * immediately invoke them. Provide `options` to indicate whether `func`
 * should be invoked on the leading and/or trailing edge of the `wait`
 * timeout. The `func` is invoked with the last arguments provided to the
 * throttled function. Subsequent calls to the throttled function return the
 * result of the last `func` invocation.
 *
 * **Note:** If `leading` and `trailing` options are `true`, `func` is
 * invoked on the trailing edge of the timeout only if the throttled function
 * is invoked more than once during the `wait` timeout.
 *
 * If `wait` is `0` and `leading` is `false`, `func` invocation is deferred
 * until to the next tick, similar to `setTimeout` with a timeout of `0`.
 *
 * See [David Corbacho's article](https://css-tricks.com/debouncing-throttling-explained-examples/)
 * for details over the differences between `_.throttle` and `_.debounce`.
 *
 * @static
 * @memberOf _
 * @since 0.1.0
 * @category Function
 * @param {Function} func The function to throttle.
 * @param {number} [wait=0] The number of milliseconds to throttle invocations to.
 * @param {Object} [options={}] The options object.
 * @param {boolean} [options.leading=true]
 *  Specify invoking on the leading edge of the timeout.
 * @param {boolean} [options.trailing=true]
 *  Specify invoking on the trailing edge of the timeout.
 * @returns {Function} Returns the new throttled function.
 * @example
 *
 * // Avoid excessively updating the position while scrolling.
 * jQuery(window).on('scroll', _.throttle(updatePosition, 100));
 *
 * // Invoke `renewToken` when the click event is fired, but not more than once every 5 minutes.
 * var throttled = _.throttle(renewToken, 300000, { 'trailing': false });
 * jQuery(element).on('click', throttled);
 *
 * // Cancel the trailing throttled invocation.
 * jQuery(window).on('popstate', throttled.cancel);
 */
function throttle(func, wait, options) {
  var leading = true,
      trailing = true;

  if (typeof func != 'function') {
    throw new TypeError(FUNC_ERROR_TEXT);
  }
  if (isObject(options)) {
    leading = 'leading' in options ? !!options.leading : leading;
    trailing = 'trailing' in options ? !!options.trailing : trailing;
  }
  return debounce(func, wait, {
    'leading': leading,
    'maxWait': wait,
    'trailing': trailing
  });
}

/**
 * Checks if `value` is the
 * [language type](http://www.ecma-international.org/ecma-262/7.0/#sec-ecmascript-language-types)
 * of `Object`. (e.g. arrays, functions, objects, regexes, `new Number(0)`, and `new String('')`)
 *
 * @static
 * @memberOf _
 * @since 0.1.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is an object, else `false`.
 * @example
 *
 * _.isObject({});
 * // => true
 *
 * _.isObject([1, 2, 3]);
 * // => true
 *
 * _.isObject(_.noop);
 * // => true
 *
 * _.isObject(null);
 * // => false
 */
function isObject(value) {
  var type = typeof value;
  return !!value && (type == 'object' || type == 'function');
}

/**
 * Checks if `value` is object-like. A value is object-like if it's not `null`
 * and has a `typeof` result of "object".
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is object-like, else `false`.
 * @example
 *
 * _.isObjectLike({});
 * // => true
 *
 * _.isObjectLike([1, 2, 3]);
 * // => true
 *
 * _.isObjectLike(_.noop);
 * // => false
 *
 * _.isObjectLike(null);
 * // => false
 */
function isObjectLike(value) {
  return !!value && typeof value == 'object';
}

/**
 * Checks if `value` is classified as a `Symbol` primitive or object.
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is a symbol, else `false`.
 * @example
 *
 * _.isSymbol(Symbol.iterator);
 * // => true
 *
 * _.isSymbol('abc');
 * // => false
 */
function isSymbol(value) {
  return typeof value == 'symbol' ||
    (isObjectLike(value) && objectToString.call(value) == symbolTag);
}

/**
 * Converts `value` to a number.
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to process.
 * @returns {number} Returns the number.
 * @example
 *
 * _.toNumber(3.2);
 * // => 3.2
 *
 * _.toNumber(Number.MIN_VALUE);
 * // => 5e-324
 *
 * _.toNumber(Infinity);
 * // => Infinity
 *
 * _.toNumber('3.2');
 * // => 3.2
 */
function toNumber(value) {
  if (typeof value == 'number') {
    return value;
  }
  if (isSymbol(value)) {
    return NAN;
  }
  if (isObject(value)) {
    var other = typeof value.valueOf == 'function' ? value.valueOf() : value;
    value = isObject(other) ? (other + '') : other;
  }
  if (typeof value != 'string') {
    return value === 0 ? value : +value;
  }
  value = value.replace(reTrim, '');
  var isBinary = reIsBinary.test(value);
  return (isBinary || reIsOctal.test(value))
    ? freeParseInt(value.slice(2), isBinary ? 2 : 8)
    : (reIsBadHex.test(value) ? NAN : +value);
}

module.exports = throttle;


/***/ }),

/***/ "../../../../../../node_modules/query-string/index.js":
/*!************************************************************!*\
  !*** ../../../../../../node_modules/query-string/index.js ***!
  \************************************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";

const strictUriEncode = __webpack_require__(/*! strict-uri-encode */ "../../../../../../node_modules/strict-uri-encode/index.js");
const decodeComponent = __webpack_require__(/*! decode-uri-component */ "../../../../../../node_modules/decode-uri-component/index.js");
const splitOnFirst = __webpack_require__(/*! split-on-first */ "../../../../../../node_modules/split-on-first/index.js");
const filterObject = __webpack_require__(/*! filter-obj */ "../../../../../../node_modules/filter-obj/index.js");

const isNullOrUndefined = value => value === null || value === undefined;

const encodeFragmentIdentifier = Symbol('encodeFragmentIdentifier');

function encoderForArrayFormat(options) {
	switch (options.arrayFormat) {
		case 'index':
			return key => (result, value) => {
				const index = result.length;

				if (
					value === undefined ||
					(options.skipNull && value === null) ||
					(options.skipEmptyString && value === '')
				) {
					return result;
				}

				if (value === null) {
					return [...result, [encode(key, options), '[', index, ']'].join('')];
				}

				return [
					...result,
					[encode(key, options), '[', encode(index, options), ']=', encode(value, options)].join('')
				];
			};

		case 'bracket':
			return key => (result, value) => {
				if (
					value === undefined ||
					(options.skipNull && value === null) ||
					(options.skipEmptyString && value === '')
				) {
					return result;
				}

				if (value === null) {
					return [...result, [encode(key, options), '[]'].join('')];
				}

				return [...result, [encode(key, options), '[]=', encode(value, options)].join('')];
			};

		case 'colon-list-separator':
			return key => (result, value) => {
				if (
					value === undefined ||
					(options.skipNull && value === null) ||
					(options.skipEmptyString && value === '')
				) {
					return result;
				}

				if (value === null) {
					return [...result, [encode(key, options), ':list='].join('')];
				}

				return [...result, [encode(key, options), ':list=', encode(value, options)].join('')];
			};

		case 'comma':
		case 'separator':
		case 'bracket-separator': {
			const keyValueSep = options.arrayFormat === 'bracket-separator' ?
				'[]=' :
				'=';

			return key => (result, value) => {
				if (
					value === undefined ||
					(options.skipNull && value === null) ||
					(options.skipEmptyString && value === '')
				) {
					return result;
				}

				// Translate null to an empty string so that it doesn't serialize as 'null'
				value = value === null ? '' : value;

				if (result.length === 0) {
					return [[encode(key, options), keyValueSep, encode(value, options)].join('')];
				}

				return [[result, encode(value, options)].join(options.arrayFormatSeparator)];
			};
		}

		default:
			return key => (result, value) => {
				if (
					value === undefined ||
					(options.skipNull && value === null) ||
					(options.skipEmptyString && value === '')
				) {
					return result;
				}

				if (value === null) {
					return [...result, encode(key, options)];
				}

				return [...result, [encode(key, options), '=', encode(value, options)].join('')];
			};
	}
}

function parserForArrayFormat(options) {
	let result;

	switch (options.arrayFormat) {
		case 'index':
			return (key, value, accumulator) => {
				result = /\[(\d*)\]$/.exec(key);

				key = key.replace(/\[\d*\]$/, '');

				if (!result) {
					accumulator[key] = value;
					return;
				}

				if (accumulator[key] === undefined) {
					accumulator[key] = {};
				}

				accumulator[key][result[1]] = value;
			};

		case 'bracket':
			return (key, value, accumulator) => {
				result = /(\[\])$/.exec(key);
				key = key.replace(/\[\]$/, '');

				if (!result) {
					accumulator[key] = value;
					return;
				}

				if (accumulator[key] === undefined) {
					accumulator[key] = [value];
					return;
				}

				accumulator[key] = [].concat(accumulator[key], value);
			};

		case 'colon-list-separator':
			return (key, value, accumulator) => {
				result = /(:list)$/.exec(key);
				key = key.replace(/:list$/, '');

				if (!result) {
					accumulator[key] = value;
					return;
				}

				if (accumulator[key] === undefined) {
					accumulator[key] = [value];
					return;
				}

				accumulator[key] = [].concat(accumulator[key], value);
			};

		case 'comma':
		case 'separator':
			return (key, value, accumulator) => {
				const isArray = typeof value === 'string' && value.includes(options.arrayFormatSeparator);
				const isEncodedArray = (typeof value === 'string' && !isArray && decode(value, options).includes(options.arrayFormatSeparator));
				value = isEncodedArray ? decode(value, options) : value;
				const newValue = isArray || isEncodedArray ? value.split(options.arrayFormatSeparator).map(item => decode(item, options)) : value === null ? value : decode(value, options);
				accumulator[key] = newValue;
			};

		case 'bracket-separator':
			return (key, value, accumulator) => {
				const isArray = /(\[\])$/.test(key);
				key = key.replace(/\[\]$/, '');

				if (!isArray) {
					accumulator[key] = value ? decode(value, options) : value;
					return;
				}

				const arrayValue = value === null ?
					[] :
					value.split(options.arrayFormatSeparator).map(item => decode(item, options));

				if (accumulator[key] === undefined) {
					accumulator[key] = arrayValue;
					return;
				}

				accumulator[key] = [].concat(accumulator[key], arrayValue);
			};

		default:
			return (key, value, accumulator) => {
				if (accumulator[key] === undefined) {
					accumulator[key] = value;
					return;
				}

				accumulator[key] = [].concat(accumulator[key], value);
			};
	}
}

function validateArrayFormatSeparator(value) {
	if (typeof value !== 'string' || value.length !== 1) {
		throw new TypeError('arrayFormatSeparator must be single character string');
	}
}

function encode(value, options) {
	if (options.encode) {
		return options.strict ? strictUriEncode(value) : encodeURIComponent(value);
	}

	return value;
}

function decode(value, options) {
	if (options.decode) {
		return decodeComponent(value);
	}

	return value;
}

function keysSorter(input) {
	if (Array.isArray(input)) {
		return input.sort();
	}

	if (typeof input === 'object') {
		return keysSorter(Object.keys(input))
			.sort((a, b) => Number(a) - Number(b))
			.map(key => input[key]);
	}

	return input;
}

function removeHash(input) {
	const hashStart = input.indexOf('#');
	if (hashStart !== -1) {
		input = input.slice(0, hashStart);
	}

	return input;
}

function getHash(url) {
	let hash = '';
	const hashStart = url.indexOf('#');
	if (hashStart !== -1) {
		hash = url.slice(hashStart);
	}

	return hash;
}

function extract(input) {
	input = removeHash(input);
	const queryStart = input.indexOf('?');
	if (queryStart === -1) {
		return '';
	}

	return input.slice(queryStart + 1);
}

function parseValue(value, options) {
	if (options.parseNumbers && !Number.isNaN(Number(value)) && (typeof value === 'string' && value.trim() !== '')) {
		value = Number(value);
	} else if (options.parseBooleans && value !== null && (value.toLowerCase() === 'true' || value.toLowerCase() === 'false')) {
		value = value.toLowerCase() === 'true';
	}

	return value;
}

function parse(query, options) {
	options = Object.assign({
		decode: true,
		sort: true,
		arrayFormat: 'none',
		arrayFormatSeparator: ',',
		parseNumbers: false,
		parseBooleans: false
	}, options);

	validateArrayFormatSeparator(options.arrayFormatSeparator);

	const formatter = parserForArrayFormat(options);

	// Create an object with no prototype
	const ret = Object.create(null);

	if (typeof query !== 'string') {
		return ret;
	}

	query = query.trim().replace(/^[?#&]/, '');

	if (!query) {
		return ret;
	}

	for (const param of query.split('&')) {
		if (param === '') {
			continue;
		}

		let [key, value] = splitOnFirst(options.decode ? param.replace(/\+/g, ' ') : param, '=');

		// Missing `=` should be `null`:
		// http://w3.org/TR/2012/WD-url-20120524/#collect-url-parameters
		value = value === undefined ? null : ['comma', 'separator', 'bracket-separator'].includes(options.arrayFormat) ? value : decode(value, options);
		formatter(decode(key, options), value, ret);
	}

	for (const key of Object.keys(ret)) {
		const value = ret[key];
		if (typeof value === 'object' && value !== null) {
			for (const k of Object.keys(value)) {
				value[k] = parseValue(value[k], options);
			}
		} else {
			ret[key] = parseValue(value, options);
		}
	}

	if (options.sort === false) {
		return ret;
	}

	return (options.sort === true ? Object.keys(ret).sort() : Object.keys(ret).sort(options.sort)).reduce((result, key) => {
		const value = ret[key];
		if (Boolean(value) && typeof value === 'object' && !Array.isArray(value)) {
			// Sort object keys, not values
			result[key] = keysSorter(value);
		} else {
			result[key] = value;
		}

		return result;
	}, Object.create(null));
}

exports.extract = extract;
exports.parse = parse;

exports.stringify = (object, options) => {
	if (!object) {
		return '';
	}

	options = Object.assign({
		encode: true,
		strict: true,
		arrayFormat: 'none',
		arrayFormatSeparator: ','
	}, options);

	validateArrayFormatSeparator(options.arrayFormatSeparator);

	const shouldFilter = key => (
		(options.skipNull && isNullOrUndefined(object[key])) ||
		(options.skipEmptyString && object[key] === '')
	);

	const formatter = encoderForArrayFormat(options);

	const objectCopy = {};

	for (const key of Object.keys(object)) {
		if (!shouldFilter(key)) {
			objectCopy[key] = object[key];
		}
	}

	const keys = Object.keys(objectCopy);

	if (options.sort !== false) {
		keys.sort(options.sort);
	}

	return keys.map(key => {
		const value = object[key];

		if (value === undefined) {
			return '';
		}

		if (value === null) {
			return encode(key, options);
		}

		if (Array.isArray(value)) {
			if (value.length === 0 && options.arrayFormat === 'bracket-separator') {
				return encode(key, options) + '[]';
			}

			return value
				.reduce(formatter(key), [])
				.join('&');
		}

		return encode(key, options) + '=' + encode(value, options);
	}).filter(x => x.length > 0).join('&');
};

exports.parseUrl = (url, options) => {
	options = Object.assign({
		decode: true
	}, options);

	const [url_, hash] = splitOnFirst(url, '#');

	return Object.assign(
		{
			url: url_.split('?')[0] || '',
			query: parse(extract(url), options)
		},
		options && options.parseFragmentIdentifier && hash ? {fragmentIdentifier: decode(hash, options)} : {}
	);
};

exports.stringifyUrl = (object, options) => {
	options = Object.assign({
		encode: true,
		strict: true,
		[encodeFragmentIdentifier]: true
	}, options);

	const url = removeHash(object.url).split('?')[0] || '';
	const queryFromUrl = exports.extract(object.url);
	const parsedQueryFromUrl = exports.parse(queryFromUrl, {sort: false});

	const query = Object.assign(parsedQueryFromUrl, object.query);
	let queryString = exports.stringify(query, options);
	if (queryString) {
		queryString = `?${queryString}`;
	}

	let hash = getHash(object.url);
	if (object.fragmentIdentifier) {
		hash = `#${options[encodeFragmentIdentifier] ? encode(object.fragmentIdentifier, options) : object.fragmentIdentifier}`;
	}

	return `${url}${queryString}${hash}`;
};

exports.pick = (input, filter, options) => {
	options = Object.assign({
		parseFragmentIdentifier: true,
		[encodeFragmentIdentifier]: false
	}, options);

	const {url, query, fragmentIdentifier} = exports.parseUrl(input, options);
	return exports.stringifyUrl({
		url,
		query: filterObject(query, filter),
		fragmentIdentifier
	}, options);
};

exports.exclude = (input, filter, options) => {
	const exclusionFilter = Array.isArray(filter) ? key => !filter.includes(key) : (key, value) => !filter(key, value);

	return exports.pick(input, exclusionFilter, options);
};


/***/ }),

/***/ "../../../../../../node_modules/split-on-first/index.js":
/*!**************************************************************!*\
  !*** ../../../../../../node_modules/split-on-first/index.js ***!
  \**************************************************************/
/***/ ((module) => {

"use strict";


module.exports = (string, separator) => {
	if (!(typeof string === 'string' && typeof separator === 'string')) {
		throw new TypeError('Expected the arguments to be of type `string`');
	}

	if (separator === '') {
		return [string];
	}

	const separatorIndex = string.indexOf(separator);

	if (separatorIndex === -1) {
		return [string];
	}

	return [
		string.slice(0, separatorIndex),
		string.slice(separatorIndex + separator.length)
	];
};


/***/ }),

/***/ "../../../../../../node_modules/strict-uri-encode/index.js":
/*!*****************************************************************!*\
  !*** ../../../../../../node_modules/strict-uri-encode/index.js ***!
  \*****************************************************************/
/***/ ((module) => {

"use strict";

module.exports = str => encodeURIComponent(str).replace(/[!'()*]/g, x => `%${x.charCodeAt(0).toString(16).toUpperCase()}`);


/***/ }),

/***/ "../../../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js":
/*!********************************************************************************************!*\
  !*** ../../../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js ***!
  \********************************************************************************************/
/***/ ((module) => {

"use strict";


var stylesInDOM = [];

function getIndexByIdentifier(identifier) {
  var result = -1;

  for (var i = 0; i < stylesInDOM.length; i++) {
    if (stylesInDOM[i].identifier === identifier) {
      result = i;
      break;
    }
  }

  return result;
}

function modulesToDom(list, options) {
  var idCountMap = {};
  var identifiers = [];

  for (var i = 0; i < list.length; i++) {
    var item = list[i];
    var id = options.base ? item[0] + options.base : item[0];
    var count = idCountMap[id] || 0;
    var identifier = "".concat(id, " ").concat(count);
    idCountMap[id] = count + 1;
    var indexByIdentifier = getIndexByIdentifier(identifier);
    var obj = {
      css: item[1],
      media: item[2],
      sourceMap: item[3],
      supports: item[4],
      layer: item[5]
    };

    if (indexByIdentifier !== -1) {
      stylesInDOM[indexByIdentifier].references++;
      stylesInDOM[indexByIdentifier].updater(obj);
    } else {
      var updater = addElementStyle(obj, options);
      options.byIndex = i;
      stylesInDOM.splice(i, 0, {
        identifier: identifier,
        updater: updater,
        references: 1
      });
    }

    identifiers.push(identifier);
  }

  return identifiers;
}

function addElementStyle(obj, options) {
  var api = options.domAPI(options);
  api.update(obj);

  var updater = function updater(newObj) {
    if (newObj) {
      if (newObj.css === obj.css && newObj.media === obj.media && newObj.sourceMap === obj.sourceMap && newObj.supports === obj.supports && newObj.layer === obj.layer) {
        return;
      }

      api.update(obj = newObj);
    } else {
      api.remove();
    }
  };

  return updater;
}

module.exports = function (list, options) {
  options = options || {};
  list = list || [];
  var lastIdentifiers = modulesToDom(list, options);
  return function update(newList) {
    newList = newList || [];

    for (var i = 0; i < lastIdentifiers.length; i++) {
      var identifier = lastIdentifiers[i];
      var index = getIndexByIdentifier(identifier);
      stylesInDOM[index].references--;
    }

    var newLastIdentifiers = modulesToDom(newList, options);

    for (var _i = 0; _i < lastIdentifiers.length; _i++) {
      var _identifier = lastIdentifiers[_i];

      var _index = getIndexByIdentifier(_identifier);

      if (stylesInDOM[_index].references === 0) {
        stylesInDOM[_index].updater();

        stylesInDOM.splice(_index, 1);
      }
    }

    lastIdentifiers = newLastIdentifiers;
  };
};

/***/ }),

/***/ "../../../../../../node_modules/style-loader/dist/runtime/insertBySelector.js":
/*!************************************************************************************!*\
  !*** ../../../../../../node_modules/style-loader/dist/runtime/insertBySelector.js ***!
  \************************************************************************************/
/***/ ((module) => {

"use strict";


var memo = {};
/* istanbul ignore next  */

function getTarget(target) {
  if (typeof memo[target] === "undefined") {
    var styleTarget = document.querySelector(target); // Special case to return head of iframe instead of iframe itself

    if (window.HTMLIFrameElement && styleTarget instanceof window.HTMLIFrameElement) {
      try {
        // This will throw an exception if access to iframe is blocked
        // due to cross-origin restrictions
        styleTarget = styleTarget.contentDocument.head;
      } catch (e) {
        // istanbul ignore next
        styleTarget = null;
      }
    }

    memo[target] = styleTarget;
  }

  return memo[target];
}
/* istanbul ignore next  */


function insertBySelector(insert, style) {
  var target = getTarget(insert);

  if (!target) {
    throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");
  }

  target.appendChild(style);
}

module.exports = insertBySelector;

/***/ }),

/***/ "../../../../../../node_modules/style-loader/dist/runtime/insertStyleElement.js":
/*!**************************************************************************************!*\
  !*** ../../../../../../node_modules/style-loader/dist/runtime/insertStyleElement.js ***!
  \**************************************************************************************/
/***/ ((module) => {

"use strict";


/* istanbul ignore next  */
function insertStyleElement(options) {
  var element = document.createElement("style");
  options.setAttributes(element, options.attributes);
  options.insert(element, options.options);
  return element;
}

module.exports = insertStyleElement;

/***/ }),

/***/ "../../../../../../node_modules/style-loader/dist/runtime/setAttributesWithoutAttributes.js":
/*!**************************************************************************************************!*\
  !*** ../../../../../../node_modules/style-loader/dist/runtime/setAttributesWithoutAttributes.js ***!
  \**************************************************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


/* istanbul ignore next  */
function setAttributesWithoutAttributes(styleElement) {
  var nonce =  true ? __webpack_require__.nc : 0;

  if (nonce) {
    styleElement.setAttribute("nonce", nonce);
  }
}

module.exports = setAttributesWithoutAttributes;

/***/ }),

/***/ "../../../../../../node_modules/style-loader/dist/runtime/styleDomAPI.js":
/*!*******************************************************************************!*\
  !*** ../../../../../../node_modules/style-loader/dist/runtime/styleDomAPI.js ***!
  \*******************************************************************************/
/***/ ((module) => {

"use strict";


/* istanbul ignore next  */
function apply(styleElement, options, obj) {
  var css = "";

  if (obj.supports) {
    css += "@supports (".concat(obj.supports, ") {");
  }

  if (obj.media) {
    css += "@media ".concat(obj.media, " {");
  }

  var needLayer = typeof obj.layer !== "undefined";

  if (needLayer) {
    css += "@layer".concat(obj.layer.length > 0 ? " ".concat(obj.layer) : "", " {");
  }

  css += obj.css;

  if (needLayer) {
    css += "}";
  }

  if (obj.media) {
    css += "}";
  }

  if (obj.supports) {
    css += "}";
  }

  var sourceMap = obj.sourceMap;

  if (sourceMap && typeof btoa !== "undefined") {
    css += "\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))), " */");
  } // For old IE

  /* istanbul ignore if  */


  options.styleTagTransform(css, styleElement, options.options);
}

function removeStyleElement(styleElement) {
  // istanbul ignore if
  if (styleElement.parentNode === null) {
    return false;
  }

  styleElement.parentNode.removeChild(styleElement);
}
/* istanbul ignore next  */


function domAPI(options) {
  var styleElement = options.insertStyleElement(options);
  return {
    update: function update(obj) {
      apply(styleElement, options, obj);
    },
    remove: function remove() {
      removeStyleElement(styleElement);
    }
  };
}

module.exports = domAPI;

/***/ }),

/***/ "../../../../../../node_modules/style-loader/dist/runtime/styleTagTransform.js":
/*!*************************************************************************************!*\
  !*** ../../../../../../node_modules/style-loader/dist/runtime/styleTagTransform.js ***!
  \*************************************************************************************/
/***/ ((module) => {

"use strict";


/* istanbul ignore next  */
function styleTagTransform(css, styleElement) {
  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = css;
  } else {
    while (styleElement.firstChild) {
      styleElement.removeChild(styleElement.firstChild);
    }

    styleElement.appendChild(document.createTextNode(css));
  }
}

module.exports = styleTagTransform;

/***/ }),

/***/ "../../../../../../node_modules/unidragger/unidragger.js":
/*!***************************************************************!*\
  !*** ../../../../../../node_modules/unidragger/unidragger.js ***!
  \***************************************************************/
/***/ ((module, exports, __webpack_require__) => {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*!
 * Unidragger v2.4.0
 * Draggable base class
 * MIT license
 */

/*jshint browser: true, unused: true, undef: true, strict: true */

( function( window, factory ) {
  // universal module definition
  /*jshint strict: false */ /*globals define, module, require */

  if ( true ) {
    // AMD
    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [
      __webpack_require__(/*! unipointer/unipointer */ "../../../../../../node_modules/unipointer/unipointer.js")
    ], __WEBPACK_AMD_DEFINE_RESULT__ = (function( Unipointer ) {
      return factory( window, Unipointer );
    }).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
  } else {}

}( window, function factory( window, Unipointer ) {

'use strict';

// -------------------------- Unidragger -------------------------- //

function Unidragger() {}

// inherit Unipointer & EvEmitter
var proto = Unidragger.prototype = Object.create( Unipointer.prototype );

// ----- bind start ----- //

proto.bindHandles = function() {
  this._bindHandles( true );
};

proto.unbindHandles = function() {
  this._bindHandles( false );
};

/**
 * Add or remove start event
 * @param {Boolean} isAdd
 */
proto._bindHandles = function( isAdd ) {
  // munge isAdd, default to true
  isAdd = isAdd === undefined ? true : isAdd;
  // bind each handle
  var bindMethod = isAdd ? 'addEventListener' : 'removeEventListener';
  var touchAction = isAdd ? this._touchActionValue : '';
  for ( var i=0; i < this.handles.length; i++ ) {
    var handle = this.handles[i];
    this._bindStartEvent( handle, isAdd );
    handle[ bindMethod ]( 'click', this );
    // touch-action: none to override browser touch gestures. metafizzy/flickity#540
    if ( window.PointerEvent ) {
      handle.style.touchAction = touchAction;
    }
  }
};

// prototype so it can be overwriteable by Flickity
proto._touchActionValue = 'none';

// ----- start event ----- //

/**
 * pointer start
 * @param {Event} event
 * @param {Event or Touch} pointer
 */
proto.pointerDown = function( event, pointer ) {
  var isOkay = this.okayPointerDown( event );
  if ( !isOkay ) {
    return;
  }
  // track start event position
  // Safari 9 overrides pageX and pageY. These values needs to be copied. flickity#842
  this.pointerDownPointer = {
    pageX: pointer.pageX,
    pageY: pointer.pageY,
  };

  event.preventDefault();
  this.pointerDownBlur();
  // bind move and end events
  this._bindPostStartEvents( event );
  this.emitEvent( 'pointerDown', [ event, pointer ] );
};

// nodes that have text fields
var cursorNodes = {
  TEXTAREA: true,
  INPUT: true,
  SELECT: true,
  OPTION: true,
};

// input types that do not have text fields
var clickTypes = {
  radio: true,
  checkbox: true,
  button: true,
  submit: true,
  image: true,
  file: true,
};

// dismiss inputs with text fields. flickity#403, flickity#404
proto.okayPointerDown = function( event ) {
  var isCursorNode = cursorNodes[ event.target.nodeName ];
  var isClickType = clickTypes[ event.target.type ];
  var isOkay = !isCursorNode || isClickType;
  if ( !isOkay ) {
    this._pointerReset();
  }
  return isOkay;
};

// kludge to blur previously focused input
proto.pointerDownBlur = function() {
  var focused = document.activeElement;
  // do not blur body for IE10, metafizzy/flickity#117
  var canBlur = focused && focused.blur && focused != document.body;
  if ( canBlur ) {
    focused.blur();
  }
};

// ----- move event ----- //

/**
 * drag move
 * @param {Event} event
 * @param {Event or Touch} pointer
 */
proto.pointerMove = function( event, pointer ) {
  var moveVector = this._dragPointerMove( event, pointer );
  this.emitEvent( 'pointerMove', [ event, pointer, moveVector ] );
  this._dragMove( event, pointer, moveVector );
};

// base pointer move logic
proto._dragPointerMove = function( event, pointer ) {
  var moveVector = {
    x: pointer.pageX - this.pointerDownPointer.pageX,
    y: pointer.pageY - this.pointerDownPointer.pageY
  };
  // start drag if pointer has moved far enough to start drag
  if ( !this.isDragging && this.hasDragStarted( moveVector ) ) {
    this._dragStart( event, pointer );
  }
  return moveVector;
};

// condition if pointer has moved far enough to start drag
proto.hasDragStarted = function( moveVector ) {
  return Math.abs( moveVector.x ) > 3 || Math.abs( moveVector.y ) > 3;
};

// ----- end event ----- //

/**
 * pointer up
 * @param {Event} event
 * @param {Event or Touch} pointer
 */
proto.pointerUp = function( event, pointer ) {
  this.emitEvent( 'pointerUp', [ event, pointer ] );
  this._dragPointerUp( event, pointer );
};

proto._dragPointerUp = function( event, pointer ) {
  if ( this.isDragging ) {
    this._dragEnd( event, pointer );
  } else {
    // pointer didn't move enough for drag to start
    this._staticClick( event, pointer );
  }
};

// -------------------------- drag -------------------------- //

// dragStart
proto._dragStart = function( event, pointer ) {
  this.isDragging = true;
  // prevent clicks
  this.isPreventingClicks = true;
  this.dragStart( event, pointer );
};

proto.dragStart = function( event, pointer ) {
  this.emitEvent( 'dragStart', [ event, pointer ] );
};

// dragMove
proto._dragMove = function( event, pointer, moveVector ) {
  // do not drag if not dragging yet
  if ( !this.isDragging ) {
    return;
  }

  this.dragMove( event, pointer, moveVector );
};

proto.dragMove = function( event, pointer, moveVector ) {
  event.preventDefault();
  this.emitEvent( 'dragMove', [ event, pointer, moveVector ] );
};

// dragEnd
proto._dragEnd = function( event, pointer ) {
  // set flags
  this.isDragging = false;
  // re-enable clicking async
  setTimeout( function() {
    delete this.isPreventingClicks;
  }.bind( this ) );

  this.dragEnd( event, pointer );
};

proto.dragEnd = function( event, pointer ) {
  this.emitEvent( 'dragEnd', [ event, pointer ] );
};

// ----- onclick ----- //

// handle all clicks and prevent clicks when dragging
proto.onclick = function( event ) {
  if ( this.isPreventingClicks ) {
    event.preventDefault();
  }
};

// ----- staticClick ----- //

// triggered after pointer down & up with no/tiny movement
proto._staticClick = function( event, pointer ) {
  // ignore emulated mouse up clicks
  if ( this.isIgnoringMouseUp && event.type == 'mouseup' ) {
    return;
  }

  this.staticClick( event, pointer );

  // set flag for emulated clicks 300ms after touchend
  if ( event.type != 'mouseup' ) {
    this.isIgnoringMouseUp = true;
    // reset flag after 300ms
    setTimeout( function() {
      delete this.isIgnoringMouseUp;
    }.bind( this ), 400 );
  }
};

proto.staticClick = function( event, pointer ) {
  this.emitEvent( 'staticClick', [ event, pointer ] );
};

// ----- utils ----- //

Unidragger.getPointerPoint = Unipointer.getPointerPoint;

// -----  ----- //

return Unidragger;

}));


/***/ }),

/***/ "../../../../../../node_modules/unipointer/unipointer.js":
/*!***************************************************************!*\
  !*** ../../../../../../node_modules/unipointer/unipointer.js ***!
  \***************************************************************/
/***/ ((module, exports, __webpack_require__) => {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*!
 * Unipointer v2.4.0
 * base class for doing one thing with pointer event
 * MIT license
 */

/*jshint browser: true, undef: true, unused: true, strict: true */

( function( window, factory ) {
  // universal module definition
  /* jshint strict: false */ /*global define, module, require */
  if ( true ) {
    // AMD
    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [
      __webpack_require__(/*! ev-emitter/ev-emitter */ "../../../../../../node_modules/ev-emitter/ev-emitter.js")
    ], __WEBPACK_AMD_DEFINE_RESULT__ = (function( EvEmitter ) {
      return factory( window, EvEmitter );
    }).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
  } else {}

}( window, function factory( window, EvEmitter ) {

'use strict';

function noop() {}

function Unipointer() {}

// inherit EvEmitter
var proto = Unipointer.prototype = Object.create( EvEmitter.prototype );

proto.bindStartEvent = function( elem ) {
  this._bindStartEvent( elem, true );
};

proto.unbindStartEvent = function( elem ) {
  this._bindStartEvent( elem, false );
};

/**
 * Add or remove start event
 * @param {Boolean} isAdd - remove if falsey
 */
proto._bindStartEvent = function( elem, isAdd ) {
  // munge isAdd, default to true
  isAdd = isAdd === undefined ? true : isAdd;
  var bindMethod = isAdd ? 'addEventListener' : 'removeEventListener';

  // default to mouse events
  var startEvent = 'mousedown';
  if ( 'ontouchstart' in window ) {
    // HACK prefer Touch Events as you can preventDefault on touchstart to
    // disable scroll in iOS & mobile Chrome metafizzy/flickity#1177
    startEvent = 'touchstart';
  } else if ( window.PointerEvent ) {
    // Pointer Events
    startEvent = 'pointerdown';
  }
  elem[ bindMethod ]( startEvent, this );
};

// trigger handler methods for events
proto.handleEvent = function( event ) {
  var method = 'on' + event.type;
  if ( this[ method ] ) {
    this[ method ]( event );
  }
};

// returns the touch that we're keeping track of
proto.getTouch = function( touches ) {
  for ( var i=0; i < touches.length; i++ ) {
    var touch = touches[i];
    if ( touch.identifier == this.pointerIdentifier ) {
      return touch;
    }
  }
};

// ----- start event ----- //

proto.onmousedown = function( event ) {
  // dismiss clicks from right or middle buttons
  var button = event.button;
  if ( button && ( button !== 0 && button !== 1 ) ) {
    return;
  }
  this._pointerDown( event, event );
};

proto.ontouchstart = function( event ) {
  this._pointerDown( event, event.changedTouches[0] );
};

proto.onpointerdown = function( event ) {
  this._pointerDown( event, event );
};

/**
 * pointer start
 * @param {Event} event
 * @param {Event or Touch} pointer
 */
proto._pointerDown = function( event, pointer ) {
  // dismiss right click and other pointers
  // button = 0 is okay, 1-4 not
  if ( event.button || this.isPointerDown ) {
    return;
  }

  this.isPointerDown = true;
  // save pointer identifier to match up touch events
  this.pointerIdentifier = pointer.pointerId !== undefined ?
    // pointerId for pointer events, touch.indentifier for touch events
    pointer.pointerId : pointer.identifier;

  this.pointerDown( event, pointer );
};

proto.pointerDown = function( event, pointer ) {
  this._bindPostStartEvents( event );
  this.emitEvent( 'pointerDown', [ event, pointer ] );
};

// hash of events to be bound after start event
var postStartEvents = {
  mousedown: [ 'mousemove', 'mouseup' ],
  touchstart: [ 'touchmove', 'touchend', 'touchcancel' ],
  pointerdown: [ 'pointermove', 'pointerup', 'pointercancel' ],
};

proto._bindPostStartEvents = function( event ) {
  if ( !event ) {
    return;
  }
  // get proper events to match start event
  var events = postStartEvents[ event.type ];
  // bind events to node
  events.forEach( function( eventName ) {
    window.addEventListener( eventName, this );
  }, this );
  // save these arguments
  this._boundPointerEvents = events;
};

proto._unbindPostStartEvents = function() {
  // check for _boundEvents, in case dragEnd triggered twice (old IE8 bug)
  if ( !this._boundPointerEvents ) {
    return;
  }
  this._boundPointerEvents.forEach( function( eventName ) {
    window.removeEventListener( eventName, this );
  }, this );

  delete this._boundPointerEvents;
};

// ----- move event ----- //

proto.onmousemove = function( event ) {
  this._pointerMove( event, event );
};

proto.onpointermove = function( event ) {
  if ( event.pointerId == this.pointerIdentifier ) {
    this._pointerMove( event, event );
  }
};

proto.ontouchmove = function( event ) {
  var touch = this.getTouch( event.changedTouches );
  if ( touch ) {
    this._pointerMove( event, touch );
  }
};

/**
 * pointer move
 * @param {Event} event
 * @param {Event or Touch} pointer
 * @private
 */
proto._pointerMove = function( event, pointer ) {
  this.pointerMove( event, pointer );
};

// public
proto.pointerMove = function( event, pointer ) {
  this.emitEvent( 'pointerMove', [ event, pointer ] );
};

// ----- end event ----- //


proto.onmouseup = function( event ) {
  this._pointerUp( event, event );
};

proto.onpointerup = function( event ) {
  if ( event.pointerId == this.pointerIdentifier ) {
    this._pointerUp( event, event );
  }
};

proto.ontouchend = function( event ) {
  var touch = this.getTouch( event.changedTouches );
  if ( touch ) {
    this._pointerUp( event, touch );
  }
};

/**
 * pointer up
 * @param {Event} event
 * @param {Event or Touch} pointer
 * @private
 */
proto._pointerUp = function( event, pointer ) {
  this._pointerDone();
  this.pointerUp( event, pointer );
};

// public
proto.pointerUp = function( event, pointer ) {
  this.emitEvent( 'pointerUp', [ event, pointer ] );
};

// ----- pointer done ----- //

// triggered on pointer up & pointer cancel
proto._pointerDone = function() {
  this._pointerReset();
  this._unbindPostStartEvents();
  this.pointerDone();
};

proto._pointerReset = function() {
  // reset properties
  this.isPointerDown = false;
  delete this.pointerIdentifier;
};

proto.pointerDone = noop;

// ----- pointer cancel ----- //

proto.onpointercancel = function( event ) {
  if ( event.pointerId == this.pointerIdentifier ) {
    this._pointerCancel( event, event );
  }
};

proto.ontouchcancel = function( event ) {
  var touch = this.getTouch( event.changedTouches );
  if ( touch ) {
    this._pointerCancel( event, touch );
  }
};

/**
 * pointer cancel
 * @param {Event} event
 * @param {Event or Touch} pointer
 * @private
 */
proto._pointerCancel = function( event, pointer ) {
  this._pointerDone();
  this.pointerCancel( event, pointer );
};

// public
proto.pointerCancel = function( event, pointer ) {
  this.emitEvent( 'pointerCancel', [ event, pointer ] );
};

// -----  ----- //

// utility function for getting x/y coords from event
Unipointer.getPointerPoint = function( pointer ) {
  return {
    x: pointer.pageX,
    y: pointer.pageY
  };
};

// -----  ----- //

return Unipointer;

}));


/***/ }),

/***/ "../../../../../../node_modules/@roots/bud-client/lib/hot/index.mjs?name=chipmunk&indicator=true&overlay=true&reload=true":
/*!********************************************************************************************************************************!*\
  !*** ../../../../../../node_modules/@roots/bud-client/lib/hot/index.mjs?name=chipmunk&indicator=true&overlay=true&reload=true ***!
  \********************************************************************************************************************************/
/***/ ((__webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
var __resourceQuery = "?name=chipmunk&indicator=true&overlay=true&reload=true";
__webpack_require__.r(__webpack_exports__);
/* eslint-disable no-console */
/* global __resourceQuery */
/* global module */
var __awaiter = (undefined && undefined.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
;
(() => __awaiter(void 0, void 0, void 0, function* () {
    return yield __webpack_require__.e(/*! import() */ "node_modules_roots_bud-client_lib_hot_client_js").then(__webpack_require__.bind(__webpack_require__, /*! ./client.js */ "../../../../../../node_modules/@roots/bud-client/lib/hot/client.js")).then((module) => __awaiter(void 0, void 0, void 0, function* () { return yield module.client(__resourceQuery, __webpack_module__.hot); }));
}))();



/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			if (cachedModule.error !== undefined) throw cachedModule.error;
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			id: moduleId,
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		try {
/******/ 			var execOptions = { id: moduleId, module: module, factory: __webpack_modules__[moduleId], require: __webpack_require__ };
/******/ 			__webpack_require__.i.forEach(function(handler) { handler(execOptions); });
/******/ 			module = execOptions.module;
/******/ 			execOptions.factory.call(module.exports, module, module.exports, execOptions.require);
/******/ 		} catch(e) {
/******/ 			module.error = e;
/******/ 			throw e;
/******/ 		}
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = __webpack_module_cache__;
/******/ 	
/******/ 	// expose the module execution interceptor
/******/ 	__webpack_require__.i = [];
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/ensure chunk */
/******/ 	(() => {
/******/ 		__webpack_require__.f = {};
/******/ 		// This file contains only the entry chunk.
/******/ 		// The chunk loading function for additional chunks
/******/ 		__webpack_require__.e = (chunkId) => {
/******/ 			return Promise.all(Object.keys(__webpack_require__.f).reduce((promises, key) => {
/******/ 				__webpack_require__.f[key](chunkId, promises);
/******/ 				return promises;
/******/ 			}, []));
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/get javascript chunk filename */
/******/ 	(() => {
/******/ 		// This function allow to reference async chunks
/******/ 		__webpack_require__.u = (chunkId) => {
/******/ 			// return url for filenames based on template
/******/ 			return "js/dynamic/" + chunkId + ".chunk.js";
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/get javascript update chunk filename */
/******/ 	(() => {
/******/ 		// This function allow to reference all chunks
/******/ 		__webpack_require__.hu = (chunkId) => {
/******/ 			// return url for filenames based on template
/******/ 			return "" + chunkId + "." + __webpack_require__.h() + ".hot-update.js";
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/get update manifest filename */
/******/ 	(() => {
/******/ 		__webpack_require__.hmrF = () => ("theme." + __webpack_require__.h() + ".hot-update.json");
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/getFullHash */
/******/ 	(() => {
/******/ 		__webpack_require__.h = () => ("acc7c6a223831675435d")
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/global */
/******/ 	(() => {
/******/ 		__webpack_require__.g = (function() {
/******/ 			if (typeof globalThis === 'object') return globalThis;
/******/ 			try {
/******/ 				return this || new Function('return this')();
/******/ 			} catch (e) {
/******/ 				if (typeof window === 'object') return window;
/******/ 			}
/******/ 		})();
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/load script */
/******/ 	(() => {
/******/ 		var inProgress = {};
/******/ 		var dataWebpackPrefix = "@roots/bud:";
/******/ 		// loadScript function to load a script via script tag
/******/ 		__webpack_require__.l = (url, done, key, chunkId) => {
/******/ 			if(inProgress[url]) { inProgress[url].push(done); return; }
/******/ 			var script, needAttach;
/******/ 			if(key !== undefined) {
/******/ 				var scripts = document.getElementsByTagName("script");
/******/ 				for(var i = 0; i < scripts.length; i++) {
/******/ 					var s = scripts[i];
/******/ 					if(s.getAttribute("src") == url || s.getAttribute("data-webpack") == dataWebpackPrefix + key) { script = s; break; }
/******/ 				}
/******/ 			}
/******/ 			if(!script) {
/******/ 				needAttach = true;
/******/ 				script = document.createElement('script');
/******/ 		
/******/ 				script.charset = 'utf-8';
/******/ 				script.timeout = 120;
/******/ 				if (__webpack_require__.nc) {
/******/ 					script.setAttribute("nonce", __webpack_require__.nc);
/******/ 				}
/******/ 				script.setAttribute("data-webpack", dataWebpackPrefix + key);
/******/ 				script.src = url;
/******/ 			}
/******/ 			inProgress[url] = [done];
/******/ 			var onScriptComplete = (prev, event) => {
/******/ 				// avoid mem leaks in IE.
/******/ 				script.onerror = script.onload = null;
/******/ 				clearTimeout(timeout);
/******/ 				var doneFns = inProgress[url];
/******/ 				delete inProgress[url];
/******/ 				script.parentNode && script.parentNode.removeChild(script);
/******/ 				doneFns && doneFns.forEach((fn) => (fn(event)));
/******/ 				if(prev) return prev(event);
/******/ 			};
/******/ 			var timeout = setTimeout(onScriptComplete.bind(null, undefined, { type: 'timeout', target: script }), 120000);
/******/ 			script.onerror = onScriptComplete.bind(null, script.onerror);
/******/ 			script.onload = onScriptComplete.bind(null, script.onload);
/******/ 			needAttach && document.head.appendChild(script);
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hot module replacement */
/******/ 	(() => {
/******/ 		var currentModuleData = {};
/******/ 		var installedModules = __webpack_require__.c;
/******/ 		
/******/ 		// module and require creation
/******/ 		var currentChildModule;
/******/ 		var currentParents = [];
/******/ 		
/******/ 		// status
/******/ 		var registeredStatusHandlers = [];
/******/ 		var currentStatus = "idle";
/******/ 		
/******/ 		// while downloading
/******/ 		var blockingPromises = 0;
/******/ 		var blockingPromisesWaiting = [];
/******/ 		
/******/ 		// The update info
/******/ 		var currentUpdateApplyHandlers;
/******/ 		var queuedInvalidatedModules;
/******/ 		
/******/ 		// eslint-disable-next-line no-unused-vars
/******/ 		__webpack_require__.hmrD = currentModuleData;
/******/ 		
/******/ 		__webpack_require__.i.push(function (options) {
/******/ 			var module = options.module;
/******/ 			var require = createRequire(options.require, options.id);
/******/ 			module.hot = createModuleHotObject(options.id, module);
/******/ 			module.parents = currentParents;
/******/ 			module.children = [];
/******/ 			currentParents = [];
/******/ 			options.require = require;
/******/ 		});
/******/ 		
/******/ 		__webpack_require__.hmrC = {};
/******/ 		__webpack_require__.hmrI = {};
/******/ 		
/******/ 		function createRequire(require, moduleId) {
/******/ 			var me = installedModules[moduleId];
/******/ 			if (!me) return require;
/******/ 			var fn = function (request) {
/******/ 				if (me.hot.active) {
/******/ 					if (installedModules[request]) {
/******/ 						var parents = installedModules[request].parents;
/******/ 						if (parents.indexOf(moduleId) === -1) {
/******/ 							parents.push(moduleId);
/******/ 						}
/******/ 					} else {
/******/ 						currentParents = [moduleId];
/******/ 						currentChildModule = request;
/******/ 					}
/******/ 					if (me.children.indexOf(request) === -1) {
/******/ 						me.children.push(request);
/******/ 					}
/******/ 				} else {
/******/ 					console.warn(
/******/ 						"[HMR] unexpected require(" +
/******/ 							request +
/******/ 							") from disposed module " +
/******/ 							moduleId
/******/ 					);
/******/ 					currentParents = [];
/******/ 				}
/******/ 				return require(request);
/******/ 			};
/******/ 			var createPropertyDescriptor = function (name) {
/******/ 				return {
/******/ 					configurable: true,
/******/ 					enumerable: true,
/******/ 					get: function () {
/******/ 						return require[name];
/******/ 					},
/******/ 					set: function (value) {
/******/ 						require[name] = value;
/******/ 					}
/******/ 				};
/******/ 			};
/******/ 			for (var name in require) {
/******/ 				if (Object.prototype.hasOwnProperty.call(require, name) && name !== "e") {
/******/ 					Object.defineProperty(fn, name, createPropertyDescriptor(name));
/******/ 				}
/******/ 			}
/******/ 			fn.e = function (chunkId) {
/******/ 				return trackBlockingPromise(require.e(chunkId));
/******/ 			};
/******/ 			return fn;
/******/ 		}
/******/ 		
/******/ 		function createModuleHotObject(moduleId, me) {
/******/ 			var _main = currentChildModule !== moduleId;
/******/ 			var hot = {
/******/ 				// private stuff
/******/ 				_acceptedDependencies: {},
/******/ 				_acceptedErrorHandlers: {},
/******/ 				_declinedDependencies: {},
/******/ 				_selfAccepted: false,
/******/ 				_selfDeclined: false,
/******/ 				_selfInvalidated: false,
/******/ 				_disposeHandlers: [],
/******/ 				_main: _main,
/******/ 				_requireSelf: function () {
/******/ 					currentParents = me.parents.slice();
/******/ 					currentChildModule = _main ? undefined : moduleId;
/******/ 					__webpack_require__(moduleId);
/******/ 				},
/******/ 		
/******/ 				// Module API
/******/ 				active: true,
/******/ 				accept: function (dep, callback, errorHandler) {
/******/ 					if (dep === undefined) hot._selfAccepted = true;
/******/ 					else if (typeof dep === "function") hot._selfAccepted = dep;
/******/ 					else if (typeof dep === "object" && dep !== null) {
/******/ 						for (var i = 0; i < dep.length; i++) {
/******/ 							hot._acceptedDependencies[dep[i]] = callback || function () {};
/******/ 							hot._acceptedErrorHandlers[dep[i]] = errorHandler;
/******/ 						}
/******/ 					} else {
/******/ 						hot._acceptedDependencies[dep] = callback || function () {};
/******/ 						hot._acceptedErrorHandlers[dep] = errorHandler;
/******/ 					}
/******/ 				},
/******/ 				decline: function (dep) {
/******/ 					if (dep === undefined) hot._selfDeclined = true;
/******/ 					else if (typeof dep === "object" && dep !== null)
/******/ 						for (var i = 0; i < dep.length; i++)
/******/ 							hot._declinedDependencies[dep[i]] = true;
/******/ 					else hot._declinedDependencies[dep] = true;
/******/ 				},
/******/ 				dispose: function (callback) {
/******/ 					hot._disposeHandlers.push(callback);
/******/ 				},
/******/ 				addDisposeHandler: function (callback) {
/******/ 					hot._disposeHandlers.push(callback);
/******/ 				},
/******/ 				removeDisposeHandler: function (callback) {
/******/ 					var idx = hot._disposeHandlers.indexOf(callback);
/******/ 					if (idx >= 0) hot._disposeHandlers.splice(idx, 1);
/******/ 				},
/******/ 				invalidate: function () {
/******/ 					this._selfInvalidated = true;
/******/ 					switch (currentStatus) {
/******/ 						case "idle":
/******/ 							currentUpdateApplyHandlers = [];
/******/ 							Object.keys(__webpack_require__.hmrI).forEach(function (key) {
/******/ 								__webpack_require__.hmrI[key](
/******/ 									moduleId,
/******/ 									currentUpdateApplyHandlers
/******/ 								);
/******/ 							});
/******/ 							setStatus("ready");
/******/ 							break;
/******/ 						case "ready":
/******/ 							Object.keys(__webpack_require__.hmrI).forEach(function (key) {
/******/ 								__webpack_require__.hmrI[key](
/******/ 									moduleId,
/******/ 									currentUpdateApplyHandlers
/******/ 								);
/******/ 							});
/******/ 							break;
/******/ 						case "prepare":
/******/ 						case "check":
/******/ 						case "dispose":
/******/ 						case "apply":
/******/ 							(queuedInvalidatedModules = queuedInvalidatedModules || []).push(
/******/ 								moduleId
/******/ 							);
/******/ 							break;
/******/ 						default:
/******/ 							// ignore requests in error states
/******/ 							break;
/******/ 					}
/******/ 				},
/******/ 		
/******/ 				// Management API
/******/ 				check: hotCheck,
/******/ 				apply: hotApply,
/******/ 				status: function (l) {
/******/ 					if (!l) return currentStatus;
/******/ 					registeredStatusHandlers.push(l);
/******/ 				},
/******/ 				addStatusHandler: function (l) {
/******/ 					registeredStatusHandlers.push(l);
/******/ 				},
/******/ 				removeStatusHandler: function (l) {
/******/ 					var idx = registeredStatusHandlers.indexOf(l);
/******/ 					if (idx >= 0) registeredStatusHandlers.splice(idx, 1);
/******/ 				},
/******/ 		
/******/ 				//inherit from previous dispose call
/******/ 				data: currentModuleData[moduleId]
/******/ 			};
/******/ 			currentChildModule = undefined;
/******/ 			return hot;
/******/ 		}
/******/ 		
/******/ 		function setStatus(newStatus) {
/******/ 			currentStatus = newStatus;
/******/ 			var results = [];
/******/ 		
/******/ 			for (var i = 0; i < registeredStatusHandlers.length; i++)
/******/ 				results[i] = registeredStatusHandlers[i].call(null, newStatus);
/******/ 		
/******/ 			return Promise.all(results);
/******/ 		}
/******/ 		
/******/ 		function unblock() {
/******/ 			if (--blockingPromises === 0) {
/******/ 				setStatus("ready").then(function () {
/******/ 					if (blockingPromises === 0) {
/******/ 						var list = blockingPromisesWaiting;
/******/ 						blockingPromisesWaiting = [];
/******/ 						for (var i = 0; i < list.length; i++) {
/******/ 							list[i]();
/******/ 						}
/******/ 					}
/******/ 				});
/******/ 			}
/******/ 		}
/******/ 		
/******/ 		function trackBlockingPromise(promise) {
/******/ 			switch (currentStatus) {
/******/ 				case "ready":
/******/ 					setStatus("prepare");
/******/ 				/* fallthrough */
/******/ 				case "prepare":
/******/ 					blockingPromises++;
/******/ 					promise.then(unblock, unblock);
/******/ 					return promise;
/******/ 				default:
/******/ 					return promise;
/******/ 			}
/******/ 		}
/******/ 		
/******/ 		function waitForBlockingPromises(fn) {
/******/ 			if (blockingPromises === 0) return fn();
/******/ 			return new Promise(function (resolve) {
/******/ 				blockingPromisesWaiting.push(function () {
/******/ 					resolve(fn());
/******/ 				});
/******/ 			});
/******/ 		}
/******/ 		
/******/ 		function hotCheck(applyOnUpdate) {
/******/ 			if (currentStatus !== "idle") {
/******/ 				throw new Error("check() is only allowed in idle status");
/******/ 			}
/******/ 			return setStatus("check")
/******/ 				.then(__webpack_require__.hmrM)
/******/ 				.then(function (update) {
/******/ 					if (!update) {
/******/ 						return setStatus(applyInvalidatedModules() ? "ready" : "idle").then(
/******/ 							function () {
/******/ 								return null;
/******/ 							}
/******/ 						);
/******/ 					}
/******/ 		
/******/ 					return setStatus("prepare").then(function () {
/******/ 						var updatedModules = [];
/******/ 						currentUpdateApplyHandlers = [];
/******/ 		
/******/ 						return Promise.all(
/******/ 							Object.keys(__webpack_require__.hmrC).reduce(function (
/******/ 								promises,
/******/ 								key
/******/ 							) {
/******/ 								__webpack_require__.hmrC[key](
/******/ 									update.c,
/******/ 									update.r,
/******/ 									update.m,
/******/ 									promises,
/******/ 									currentUpdateApplyHandlers,
/******/ 									updatedModules
/******/ 								);
/******/ 								return promises;
/******/ 							},
/******/ 							[])
/******/ 						).then(function () {
/******/ 							return waitForBlockingPromises(function () {
/******/ 								if (applyOnUpdate) {
/******/ 									return internalApply(applyOnUpdate);
/******/ 								} else {
/******/ 									return setStatus("ready").then(function () {
/******/ 										return updatedModules;
/******/ 									});
/******/ 								}
/******/ 							});
/******/ 						});
/******/ 					});
/******/ 				});
/******/ 		}
/******/ 		
/******/ 		function hotApply(options) {
/******/ 			if (currentStatus !== "ready") {
/******/ 				return Promise.resolve().then(function () {
/******/ 					throw new Error(
/******/ 						"apply() is only allowed in ready status (state: " +
/******/ 							currentStatus +
/******/ 							")"
/******/ 					);
/******/ 				});
/******/ 			}
/******/ 			return internalApply(options);
/******/ 		}
/******/ 		
/******/ 		function internalApply(options) {
/******/ 			options = options || {};
/******/ 		
/******/ 			applyInvalidatedModules();
/******/ 		
/******/ 			var results = currentUpdateApplyHandlers.map(function (handler) {
/******/ 				return handler(options);
/******/ 			});
/******/ 			currentUpdateApplyHandlers = undefined;
/******/ 		
/******/ 			var errors = results
/******/ 				.map(function (r) {
/******/ 					return r.error;
/******/ 				})
/******/ 				.filter(Boolean);
/******/ 		
/******/ 			if (errors.length > 0) {
/******/ 				return setStatus("abort").then(function () {
/******/ 					throw errors[0];
/******/ 				});
/******/ 			}
/******/ 		
/******/ 			// Now in "dispose" phase
/******/ 			var disposePromise = setStatus("dispose");
/******/ 		
/******/ 			results.forEach(function (result) {
/******/ 				if (result.dispose) result.dispose();
/******/ 			});
/******/ 		
/******/ 			// Now in "apply" phase
/******/ 			var applyPromise = setStatus("apply");
/******/ 		
/******/ 			var error;
/******/ 			var reportError = function (err) {
/******/ 				if (!error) error = err;
/******/ 			};
/******/ 		
/******/ 			var outdatedModules = [];
/******/ 			results.forEach(function (result) {
/******/ 				if (result.apply) {
/******/ 					var modules = result.apply(reportError);
/******/ 					if (modules) {
/******/ 						for (var i = 0; i < modules.length; i++) {
/******/ 							outdatedModules.push(modules[i]);
/******/ 						}
/******/ 					}
/******/ 				}
/******/ 			});
/******/ 		
/******/ 			return Promise.all([disposePromise, applyPromise]).then(function () {
/******/ 				// handle errors in accept handlers and self accepted module load
/******/ 				if (error) {
/******/ 					return setStatus("fail").then(function () {
/******/ 						throw error;
/******/ 					});
/******/ 				}
/******/ 		
/******/ 				if (queuedInvalidatedModules) {
/******/ 					return internalApply(options).then(function (list) {
/******/ 						outdatedModules.forEach(function (moduleId) {
/******/ 							if (list.indexOf(moduleId) < 0) list.push(moduleId);
/******/ 						});
/******/ 						return list;
/******/ 					});
/******/ 				}
/******/ 		
/******/ 				return setStatus("idle").then(function () {
/******/ 					return outdatedModules;
/******/ 				});
/******/ 			});
/******/ 		}
/******/ 		
/******/ 		function applyInvalidatedModules() {
/******/ 			if (queuedInvalidatedModules) {
/******/ 				if (!currentUpdateApplyHandlers) currentUpdateApplyHandlers = [];
/******/ 				Object.keys(__webpack_require__.hmrI).forEach(function (key) {
/******/ 					queuedInvalidatedModules.forEach(function (moduleId) {
/******/ 						__webpack_require__.hmrI[key](
/******/ 							moduleId,
/******/ 							currentUpdateApplyHandlers
/******/ 						);
/******/ 					});
/******/ 				});
/******/ 				queuedInvalidatedModules = undefined;
/******/ 				return true;
/******/ 			}
/******/ 		}
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/publicPath */
/******/ 	(() => {
/******/ 		var scriptUrl;
/******/ 		if (__webpack_require__.g.importScripts) scriptUrl = __webpack_require__.g.location + "";
/******/ 		var document = __webpack_require__.g.document;
/******/ 		if (!scriptUrl && document) {
/******/ 			if (document.currentScript)
/******/ 				scriptUrl = document.currentScript.src
/******/ 			if (!scriptUrl) {
/******/ 				var scripts = document.getElementsByTagName("script");
/******/ 				if(scripts.length) scriptUrl = scripts[scripts.length - 1].src
/******/ 			}
/******/ 		}
/******/ 		// When supporting browsers where an automatic publicPath is not supported you must specify an output.publicPath manually via configuration
/******/ 		// or pass an empty string ("") and set the __webpack_public_path__ variable from your code to use your own logic.
/******/ 		if (!scriptUrl) throw new Error("Automatic publicPath is not supported in this browser");
/******/ 		scriptUrl = scriptUrl.replace(/#.*$/, "").replace(/\?.*$/, "").replace(/\/[^\/]+$/, "/");
/******/ 		__webpack_require__.p = scriptUrl + "../";
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = __webpack_require__.hmrS_jsonp = __webpack_require__.hmrS_jsonp || {
/******/ 			"theme": 0
/******/ 		};
/******/ 		
/******/ 		__webpack_require__.f.j = (chunkId, promises) => {
/******/ 				// JSONP chunk loading for javascript
/******/ 				var installedChunkData = __webpack_require__.o(installedChunks, chunkId) ? installedChunks[chunkId] : undefined;
/******/ 				if(installedChunkData !== 0) { // 0 means "already installed".
/******/ 		
/******/ 					// a Promise means "currently loading".
/******/ 					if(installedChunkData) {
/******/ 						promises.push(installedChunkData[2]);
/******/ 					} else {
/******/ 						if(true) { // all chunks have JS
/******/ 							// setup Promise in chunk cache
/******/ 							var promise = new Promise((resolve, reject) => (installedChunkData = installedChunks[chunkId] = [resolve, reject]));
/******/ 							promises.push(installedChunkData[2] = promise);
/******/ 		
/******/ 							// start chunk loading
/******/ 							var url = __webpack_require__.p + __webpack_require__.u(chunkId);
/******/ 							// create error before stack unwound to get useful stacktrace later
/******/ 							var error = new Error();
/******/ 							var loadingEnded = (event) => {
/******/ 								if(__webpack_require__.o(installedChunks, chunkId)) {
/******/ 									installedChunkData = installedChunks[chunkId];
/******/ 									if(installedChunkData !== 0) installedChunks[chunkId] = undefined;
/******/ 									if(installedChunkData) {
/******/ 										var errorType = event && (event.type === 'load' ? 'missing' : event.type);
/******/ 										var realSrc = event && event.target && event.target.src;
/******/ 										error.message = 'Loading chunk ' + chunkId + ' failed.\n(' + errorType + ': ' + realSrc + ')';
/******/ 										error.name = 'ChunkLoadError';
/******/ 										error.type = errorType;
/******/ 										error.request = realSrc;
/******/ 										installedChunkData[1](error);
/******/ 									}
/******/ 								}
/******/ 							};
/******/ 							__webpack_require__.l(url, loadingEnded, "chunk-" + chunkId, chunkId);
/******/ 						} else installedChunks[chunkId] = 0;
/******/ 					}
/******/ 				}
/******/ 		};
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		var currentUpdatedModulesList;
/******/ 		var waitingUpdateResolves = {};
/******/ 		function loadUpdateChunk(chunkId, updatedModulesList) {
/******/ 			currentUpdatedModulesList = updatedModulesList;
/******/ 			return new Promise((resolve, reject) => {
/******/ 				waitingUpdateResolves[chunkId] = resolve;
/******/ 				// start update chunk loading
/******/ 				var url = __webpack_require__.p + __webpack_require__.hu(chunkId);
/******/ 				// create error before stack unwound to get useful stacktrace later
/******/ 				var error = new Error();
/******/ 				var loadingEnded = (event) => {
/******/ 					if(waitingUpdateResolves[chunkId]) {
/******/ 						waitingUpdateResolves[chunkId] = undefined
/******/ 						var errorType = event && (event.type === 'load' ? 'missing' : event.type);
/******/ 						var realSrc = event && event.target && event.target.src;
/******/ 						error.message = 'Loading hot update chunk ' + chunkId + ' failed.\n(' + errorType + ': ' + realSrc + ')';
/******/ 						error.name = 'ChunkLoadError';
/******/ 						error.type = errorType;
/******/ 						error.request = realSrc;
/******/ 						reject(error);
/******/ 					}
/******/ 				};
/******/ 				__webpack_require__.l(url, loadingEnded);
/******/ 			});
/******/ 		}
/******/ 		
/******/ 		self["webpackHotUpdate_roots_bud"] = (chunkId, moreModules, runtime) => {
/******/ 			for(var moduleId in moreModules) {
/******/ 				if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 					currentUpdate[moduleId] = moreModules[moduleId];
/******/ 					if(currentUpdatedModulesList) currentUpdatedModulesList.push(moduleId);
/******/ 				}
/******/ 			}
/******/ 			if(runtime) currentUpdateRuntime.push(runtime);
/******/ 			if(waitingUpdateResolves[chunkId]) {
/******/ 				waitingUpdateResolves[chunkId]();
/******/ 				waitingUpdateResolves[chunkId] = undefined;
/******/ 			}
/******/ 		};
/******/ 		
/******/ 		var currentUpdateChunks;
/******/ 		var currentUpdate;
/******/ 		var currentUpdateRemovedChunks;
/******/ 		var currentUpdateRuntime;
/******/ 		function applyHandler(options) {
/******/ 			if (__webpack_require__.f) delete __webpack_require__.f.jsonpHmr;
/******/ 			currentUpdateChunks = undefined;
/******/ 			function getAffectedModuleEffects(updateModuleId) {
/******/ 				var outdatedModules = [updateModuleId];
/******/ 				var outdatedDependencies = {};
/******/ 		
/******/ 				var queue = outdatedModules.map(function (id) {
/******/ 					return {
/******/ 						chain: [id],
/******/ 						id: id
/******/ 					};
/******/ 				});
/******/ 				while (queue.length > 0) {
/******/ 					var queueItem = queue.pop();
/******/ 					var moduleId = queueItem.id;
/******/ 					var chain = queueItem.chain;
/******/ 					var module = __webpack_require__.c[moduleId];
/******/ 					if (
/******/ 						!module ||
/******/ 						(module.hot._selfAccepted && !module.hot._selfInvalidated)
/******/ 					)
/******/ 						continue;
/******/ 					if (module.hot._selfDeclined) {
/******/ 						return {
/******/ 							type: "self-declined",
/******/ 							chain: chain,
/******/ 							moduleId: moduleId
/******/ 						};
/******/ 					}
/******/ 					if (module.hot._main) {
/******/ 						return {
/******/ 							type: "unaccepted",
/******/ 							chain: chain,
/******/ 							moduleId: moduleId
/******/ 						};
/******/ 					}
/******/ 					for (var i = 0; i < module.parents.length; i++) {
/******/ 						var parentId = module.parents[i];
/******/ 						var parent = __webpack_require__.c[parentId];
/******/ 						if (!parent) continue;
/******/ 						if (parent.hot._declinedDependencies[moduleId]) {
/******/ 							return {
/******/ 								type: "declined",
/******/ 								chain: chain.concat([parentId]),
/******/ 								moduleId: moduleId,
/******/ 								parentId: parentId
/******/ 							};
/******/ 						}
/******/ 						if (outdatedModules.indexOf(parentId) !== -1) continue;
/******/ 						if (parent.hot._acceptedDependencies[moduleId]) {
/******/ 							if (!outdatedDependencies[parentId])
/******/ 								outdatedDependencies[parentId] = [];
/******/ 							addAllToSet(outdatedDependencies[parentId], [moduleId]);
/******/ 							continue;
/******/ 						}
/******/ 						delete outdatedDependencies[parentId];
/******/ 						outdatedModules.push(parentId);
/******/ 						queue.push({
/******/ 							chain: chain.concat([parentId]),
/******/ 							id: parentId
/******/ 						});
/******/ 					}
/******/ 				}
/******/ 		
/******/ 				return {
/******/ 					type: "accepted",
/******/ 					moduleId: updateModuleId,
/******/ 					outdatedModules: outdatedModules,
/******/ 					outdatedDependencies: outdatedDependencies
/******/ 				};
/******/ 			}
/******/ 		
/******/ 			function addAllToSet(a, b) {
/******/ 				for (var i = 0; i < b.length; i++) {
/******/ 					var item = b[i];
/******/ 					if (a.indexOf(item) === -1) a.push(item);
/******/ 				}
/******/ 			}
/******/ 		
/******/ 			// at begin all updates modules are outdated
/******/ 			// the "outdated" status can propagate to parents if they don't accept the children
/******/ 			var outdatedDependencies = {};
/******/ 			var outdatedModules = [];
/******/ 			var appliedUpdate = {};
/******/ 		
/******/ 			var warnUnexpectedRequire = function warnUnexpectedRequire(module) {
/******/ 				console.warn(
/******/ 					"[HMR] unexpected require(" + module.id + ") to disposed module"
/******/ 				);
/******/ 			};
/******/ 		
/******/ 			for (var moduleId in currentUpdate) {
/******/ 				if (__webpack_require__.o(currentUpdate, moduleId)) {
/******/ 					var newModuleFactory = currentUpdate[moduleId];
/******/ 					/** @type {TODO} */
/******/ 					var result;
/******/ 					if (newModuleFactory) {
/******/ 						result = getAffectedModuleEffects(moduleId);
/******/ 					} else {
/******/ 						result = {
/******/ 							type: "disposed",
/******/ 							moduleId: moduleId
/******/ 						};
/******/ 					}
/******/ 					/** @type {Error|false} */
/******/ 					var abortError = false;
/******/ 					var doApply = false;
/******/ 					var doDispose = false;
/******/ 					var chainInfo = "";
/******/ 					if (result.chain) {
/******/ 						chainInfo = "\nUpdate propagation: " + result.chain.join(" -> ");
/******/ 					}
/******/ 					switch (result.type) {
/******/ 						case "self-declined":
/******/ 							if (options.onDeclined) options.onDeclined(result);
/******/ 							if (!options.ignoreDeclined)
/******/ 								abortError = new Error(
/******/ 									"Aborted because of self decline: " +
/******/ 										result.moduleId +
/******/ 										chainInfo
/******/ 								);
/******/ 							break;
/******/ 						case "declined":
/******/ 							if (options.onDeclined) options.onDeclined(result);
/******/ 							if (!options.ignoreDeclined)
/******/ 								abortError = new Error(
/******/ 									"Aborted because of declined dependency: " +
/******/ 										result.moduleId +
/******/ 										" in " +
/******/ 										result.parentId +
/******/ 										chainInfo
/******/ 								);
/******/ 							break;
/******/ 						case "unaccepted":
/******/ 							if (options.onUnaccepted) options.onUnaccepted(result);
/******/ 							if (!options.ignoreUnaccepted)
/******/ 								abortError = new Error(
/******/ 									"Aborted because " + moduleId + " is not accepted" + chainInfo
/******/ 								);
/******/ 							break;
/******/ 						case "accepted":
/******/ 							if (options.onAccepted) options.onAccepted(result);
/******/ 							doApply = true;
/******/ 							break;
/******/ 						case "disposed":
/******/ 							if (options.onDisposed) options.onDisposed(result);
/******/ 							doDispose = true;
/******/ 							break;
/******/ 						default:
/******/ 							throw new Error("Unexception type " + result.type);
/******/ 					}
/******/ 					if (abortError) {
/******/ 						return {
/******/ 							error: abortError
/******/ 						};
/******/ 					}
/******/ 					if (doApply) {
/******/ 						appliedUpdate[moduleId] = newModuleFactory;
/******/ 						addAllToSet(outdatedModules, result.outdatedModules);
/******/ 						for (moduleId in result.outdatedDependencies) {
/******/ 							if (__webpack_require__.o(result.outdatedDependencies, moduleId)) {
/******/ 								if (!outdatedDependencies[moduleId])
/******/ 									outdatedDependencies[moduleId] = [];
/******/ 								addAllToSet(
/******/ 									outdatedDependencies[moduleId],
/******/ 									result.outdatedDependencies[moduleId]
/******/ 								);
/******/ 							}
/******/ 						}
/******/ 					}
/******/ 					if (doDispose) {
/******/ 						addAllToSet(outdatedModules, [result.moduleId]);
/******/ 						appliedUpdate[moduleId] = warnUnexpectedRequire;
/******/ 					}
/******/ 				}
/******/ 			}
/******/ 			currentUpdate = undefined;
/******/ 		
/******/ 			// Store self accepted outdated modules to require them later by the module system
/******/ 			var outdatedSelfAcceptedModules = [];
/******/ 			for (var j = 0; j < outdatedModules.length; j++) {
/******/ 				var outdatedModuleId = outdatedModules[j];
/******/ 				var module = __webpack_require__.c[outdatedModuleId];
/******/ 				if (
/******/ 					module &&
/******/ 					(module.hot._selfAccepted || module.hot._main) &&
/******/ 					// removed self-accepted modules should not be required
/******/ 					appliedUpdate[outdatedModuleId] !== warnUnexpectedRequire &&
/******/ 					// when called invalidate self-accepting is not possible
/******/ 					!module.hot._selfInvalidated
/******/ 				) {
/******/ 					outdatedSelfAcceptedModules.push({
/******/ 						module: outdatedModuleId,
/******/ 						require: module.hot._requireSelf,
/******/ 						errorHandler: module.hot._selfAccepted
/******/ 					});
/******/ 				}
/******/ 			}
/******/ 		
/******/ 			var moduleOutdatedDependencies;
/******/ 		
/******/ 			return {
/******/ 				dispose: function () {
/******/ 					currentUpdateRemovedChunks.forEach(function (chunkId) {
/******/ 						delete installedChunks[chunkId];
/******/ 					});
/******/ 					currentUpdateRemovedChunks = undefined;
/******/ 		
/******/ 					var idx;
/******/ 					var queue = outdatedModules.slice();
/******/ 					while (queue.length > 0) {
/******/ 						var moduleId = queue.pop();
/******/ 						var module = __webpack_require__.c[moduleId];
/******/ 						if (!module) continue;
/******/ 		
/******/ 						var data = {};
/******/ 		
/******/ 						// Call dispose handlers
/******/ 						var disposeHandlers = module.hot._disposeHandlers;
/******/ 						for (j = 0; j < disposeHandlers.length; j++) {
/******/ 							disposeHandlers[j].call(null, data);
/******/ 						}
/******/ 						__webpack_require__.hmrD[moduleId] = data;
/******/ 		
/******/ 						// disable module (this disables requires from this module)
/******/ 						module.hot.active = false;
/******/ 		
/******/ 						// remove module from cache
/******/ 						delete __webpack_require__.c[moduleId];
/******/ 		
/******/ 						// when disposing there is no need to call dispose handler
/******/ 						delete outdatedDependencies[moduleId];
/******/ 		
/******/ 						// remove "parents" references from all children
/******/ 						for (j = 0; j < module.children.length; j++) {
/******/ 							var child = __webpack_require__.c[module.children[j]];
/******/ 							if (!child) continue;
/******/ 							idx = child.parents.indexOf(moduleId);
/******/ 							if (idx >= 0) {
/******/ 								child.parents.splice(idx, 1);
/******/ 							}
/******/ 						}
/******/ 					}
/******/ 		
/******/ 					// remove outdated dependency from module children
/******/ 					var dependency;
/******/ 					for (var outdatedModuleId in outdatedDependencies) {
/******/ 						if (__webpack_require__.o(outdatedDependencies, outdatedModuleId)) {
/******/ 							module = __webpack_require__.c[outdatedModuleId];
/******/ 							if (module) {
/******/ 								moduleOutdatedDependencies =
/******/ 									outdatedDependencies[outdatedModuleId];
/******/ 								for (j = 0; j < moduleOutdatedDependencies.length; j++) {
/******/ 									dependency = moduleOutdatedDependencies[j];
/******/ 									idx = module.children.indexOf(dependency);
/******/ 									if (idx >= 0) module.children.splice(idx, 1);
/******/ 								}
/******/ 							}
/******/ 						}
/******/ 					}
/******/ 				},
/******/ 				apply: function (reportError) {
/******/ 					// insert new code
/******/ 					for (var updateModuleId in appliedUpdate) {
/******/ 						if (__webpack_require__.o(appliedUpdate, updateModuleId)) {
/******/ 							__webpack_require__.m[updateModuleId] = appliedUpdate[updateModuleId];
/******/ 						}
/******/ 					}
/******/ 		
/******/ 					// run new runtime modules
/******/ 					for (var i = 0; i < currentUpdateRuntime.length; i++) {
/******/ 						currentUpdateRuntime[i](__webpack_require__);
/******/ 					}
/******/ 		
/******/ 					// call accept handlers
/******/ 					for (var outdatedModuleId in outdatedDependencies) {
/******/ 						if (__webpack_require__.o(outdatedDependencies, outdatedModuleId)) {
/******/ 							var module = __webpack_require__.c[outdatedModuleId];
/******/ 							if (module) {
/******/ 								moduleOutdatedDependencies =
/******/ 									outdatedDependencies[outdatedModuleId];
/******/ 								var callbacks = [];
/******/ 								var errorHandlers = [];
/******/ 								var dependenciesForCallbacks = [];
/******/ 								for (var j = 0; j < moduleOutdatedDependencies.length; j++) {
/******/ 									var dependency = moduleOutdatedDependencies[j];
/******/ 									var acceptCallback =
/******/ 										module.hot._acceptedDependencies[dependency];
/******/ 									var errorHandler =
/******/ 										module.hot._acceptedErrorHandlers[dependency];
/******/ 									if (acceptCallback) {
/******/ 										if (callbacks.indexOf(acceptCallback) !== -1) continue;
/******/ 										callbacks.push(acceptCallback);
/******/ 										errorHandlers.push(errorHandler);
/******/ 										dependenciesForCallbacks.push(dependency);
/******/ 									}
/******/ 								}
/******/ 								for (var k = 0; k < callbacks.length; k++) {
/******/ 									try {
/******/ 										callbacks[k].call(null, moduleOutdatedDependencies);
/******/ 									} catch (err) {
/******/ 										if (typeof errorHandlers[k] === "function") {
/******/ 											try {
/******/ 												errorHandlers[k](err, {
/******/ 													moduleId: outdatedModuleId,
/******/ 													dependencyId: dependenciesForCallbacks[k]
/******/ 												});
/******/ 											} catch (err2) {
/******/ 												if (options.onErrored) {
/******/ 													options.onErrored({
/******/ 														type: "accept-error-handler-errored",
/******/ 														moduleId: outdatedModuleId,
/******/ 														dependencyId: dependenciesForCallbacks[k],
/******/ 														error: err2,
/******/ 														originalError: err
/******/ 													});
/******/ 												}
/******/ 												if (!options.ignoreErrored) {
/******/ 													reportError(err2);
/******/ 													reportError(err);
/******/ 												}
/******/ 											}
/******/ 										} else {
/******/ 											if (options.onErrored) {
/******/ 												options.onErrored({
/******/ 													type: "accept-errored",
/******/ 													moduleId: outdatedModuleId,
/******/ 													dependencyId: dependenciesForCallbacks[k],
/******/ 													error: err
/******/ 												});
/******/ 											}
/******/ 											if (!options.ignoreErrored) {
/******/ 												reportError(err);
/******/ 											}
/******/ 										}
/******/ 									}
/******/ 								}
/******/ 							}
/******/ 						}
/******/ 					}
/******/ 		
/******/ 					// Load self accepted modules
/******/ 					for (var o = 0; o < outdatedSelfAcceptedModules.length; o++) {
/******/ 						var item = outdatedSelfAcceptedModules[o];
/******/ 						var moduleId = item.module;
/******/ 						try {
/******/ 							item.require(moduleId);
/******/ 						} catch (err) {
/******/ 							if (typeof item.errorHandler === "function") {
/******/ 								try {
/******/ 									item.errorHandler(err, {
/******/ 										moduleId: moduleId,
/******/ 										module: __webpack_require__.c[moduleId]
/******/ 									});
/******/ 								} catch (err2) {
/******/ 									if (options.onErrored) {
/******/ 										options.onErrored({
/******/ 											type: "self-accept-error-handler-errored",
/******/ 											moduleId: moduleId,
/******/ 											error: err2,
/******/ 											originalError: err
/******/ 										});
/******/ 									}
/******/ 									if (!options.ignoreErrored) {
/******/ 										reportError(err2);
/******/ 										reportError(err);
/******/ 									}
/******/ 								}
/******/ 							} else {
/******/ 								if (options.onErrored) {
/******/ 									options.onErrored({
/******/ 										type: "self-accept-errored",
/******/ 										moduleId: moduleId,
/******/ 										error: err
/******/ 									});
/******/ 								}
/******/ 								if (!options.ignoreErrored) {
/******/ 									reportError(err);
/******/ 								}
/******/ 							}
/******/ 						}
/******/ 					}
/******/ 		
/******/ 					return outdatedModules;
/******/ 				}
/******/ 			};
/******/ 		}
/******/ 		__webpack_require__.hmrI.jsonp = function (moduleId, applyHandlers) {
/******/ 			if (!currentUpdate) {
/******/ 				currentUpdate = {};
/******/ 				currentUpdateRuntime = [];
/******/ 				currentUpdateRemovedChunks = [];
/******/ 				applyHandlers.push(applyHandler);
/******/ 			}
/******/ 			if (!__webpack_require__.o(currentUpdate, moduleId)) {
/******/ 				currentUpdate[moduleId] = __webpack_require__.m[moduleId];
/******/ 			}
/******/ 		};
/******/ 		__webpack_require__.hmrC.jsonp = function (
/******/ 			chunkIds,
/******/ 			removedChunks,
/******/ 			removedModules,
/******/ 			promises,
/******/ 			applyHandlers,
/******/ 			updatedModulesList
/******/ 		) {
/******/ 			applyHandlers.push(applyHandler);
/******/ 			currentUpdateChunks = {};
/******/ 			currentUpdateRemovedChunks = removedChunks;
/******/ 			currentUpdate = removedModules.reduce(function (obj, key) {
/******/ 				obj[key] = false;
/******/ 				return obj;
/******/ 			}, {});
/******/ 			currentUpdateRuntime = [];
/******/ 			chunkIds.forEach(function (chunkId) {
/******/ 				if (
/******/ 					__webpack_require__.o(installedChunks, chunkId) &&
/******/ 					installedChunks[chunkId] !== undefined
/******/ 				) {
/******/ 					promises.push(loadUpdateChunk(chunkId, updatedModulesList));
/******/ 					currentUpdateChunks[chunkId] = true;
/******/ 				} else {
/******/ 					currentUpdateChunks[chunkId] = false;
/******/ 				}
/******/ 			});
/******/ 			if (__webpack_require__.f) {
/******/ 				__webpack_require__.f.jsonpHmr = function (chunkId, promises) {
/******/ 					if (
/******/ 						currentUpdateChunks &&
/******/ 						__webpack_require__.o(currentUpdateChunks, chunkId) &&
/******/ 						!currentUpdateChunks[chunkId]
/******/ 					) {
/******/ 						promises.push(loadUpdateChunk(chunkId));
/******/ 						currentUpdateChunks[chunkId] = true;
/******/ 					}
/******/ 				};
/******/ 			}
/******/ 		};
/******/ 		
/******/ 		__webpack_require__.hmrM = () => {
/******/ 			if (typeof fetch === "undefined") throw new Error("No browser support: need fetch API");
/******/ 			return fetch(__webpack_require__.p + __webpack_require__.hmrF()).then((response) => {
/******/ 				if(response.status === 404) return; // no update available
/******/ 				if(!response.ok) throw new Error("Failed to fetch update manifest " + response.statusText);
/******/ 				return response.json();
/******/ 			});
/******/ 		};
/******/ 		
/******/ 		// no on chunks loaded
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var chunkIds = data[0];
/******/ 			var moreModules = data[1];
/******/ 			var runtime = data[2];
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 		
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk_roots_bud"] = self["webpackChunk_roots_bud"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/nonce */
/******/ 	(() => {
/******/ 		__webpack_require__.nc = undefined;
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// module cache are used so entry inlining is disabled
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	__webpack_require__("./scripts/theme.js");
/******/ 	__webpack_require__("./styles/theme.scss");
/******/ 	var __webpack_exports__ = __webpack_require__("../../../../../../node_modules/@roots/bud-client/lib/hot/index.mjs?name=chipmunk&indicator=true&overlay=true&reload=true");
/******/ 	
/******/ })()
;