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
eval("__webpack_require__.r(__webpack_exports__);\n/* WEBPACK VAR INJECTION */(function($) {/* harmony import */ var _base__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./base */ \"../popups/base.js\");\n\n\nconst PopupExit = _base__WEBPACK_IMPORTED_MODULE_0__[\"default\"].extend(\n    {\n        defaults: {\n\n        }\n    },\n    {\n        init() {\n            this._super();\n        },\n\n        \".js-exit click\"() {\n            $.ajax({\n                url: \"/popups/exit/proccess\",\n                type: \"POST\",\n                data: \"\",\n                success: (data) => {\n                    if (typeof data == \"string\") {\n                        data = JSON.parse(data);\n                    }\n\n\n                    if (data.success) {\n                        location.href = \"/1\";\n                        location.reload();\n                    }\n                }\n            });\n        }\n    }\n);\n\n\n/* harmony default export */ __webpack_exports__[\"default\"] = (PopupExit);\n\n/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ \"../../../../node_modules/jquery/dist/jquery.js\")))\n\n//# sourceURL=webpack:///../popups/exit.js?");

/***/ })

}]);