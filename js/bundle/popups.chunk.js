(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["popups"],{

/***/ "../popups sync recursive ^\\.\\/.*$":
/*!*******************************!*\
  !*** ../popups sync ^\.\/.*$ ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("var map = {\n\t\"./base\": \"../popups/base.js\",\n\t\"./base.js\": \"../popups/base.js\",\n\t\"./exit\": \"../popups/exit.js\",\n\t\"./exit.js\": \"../popups/exit.js\"\n};\n\n\nfunction webpackContext(req) {\n\tvar id = webpackContextResolve(req);\n\treturn __webpack_require__(id);\n}\nfunction webpackContextResolve(req) {\n\tif(!__webpack_require__.o(map, req)) {\n\t\tvar e = new Error(\"Cannot find module '\" + req + \"'\");\n\t\te.code = 'MODULE_NOT_FOUND';\n\t\tthrow e;\n\t}\n\treturn map[req];\n}\nwebpackContext.keys = function webpackContextKeys() {\n\treturn Object.keys(map);\n};\nwebpackContext.resolve = webpackContextResolve;\nmodule.exports = webpackContext;\nwebpackContext.id = \"../popups sync recursive ^\\\\.\\\\/.*$\";\n\n//# sourceURL=webpack:///../popups_sync_^\\.\\/.*$?");

/***/ }),

/***/ "../popups/exit.js":
/*!*************************!*\
  !*** ../popups/exit.js ***!
  \*************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* WEBPACK VAR INJECTION */(function($) {/* harmony import */ var can_construct_super__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! can-construct-super */ \"../../../node_modules/can-construct-super/can-construct-super.js\");\n/* harmony import */ var can_construct_super__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(can_construct_super__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _base__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./base */ \"../popups/base.js\");\n\r\n\r\n\r\nconst PopupExit = _base__WEBPACK_IMPORTED_MODULE_1__[\"default\"].extend(\r\n    {\r\n        defaults: {\r\n\r\n        }\r\n    },\r\n    {\r\n        init() {\r\n            this._super();\r\n            console.log(\"init\");\r\n        },\r\n\r\n        \".js-exit click\"() {\r\n            $.ajax({\r\n                url: \"/ajax/exit/\",\r\n                type: \"POST\",\r\n                processData: false,\r\n                contentType: false,\r\n                dataType: this.options.type,\r\n                data: \"\",\r\n                success: (data) => {\r\n                    data = JSON.parse(data);\r\n\r\n                    if (data.exit) {\r\n                        location.reload();\r\n                    }\r\n                }\r\n            });\r\n        }\r\n    }\r\n);\r\n\r\n\r\n/* harmony default export */ __webpack_exports__[\"default\"] = (PopupExit);\r\n\n/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ \"../../../node_modules/jquery/dist/jquery.js\")))\n\n//# sourceURL=webpack:///../popups/exit.js?");

/***/ })

}]);