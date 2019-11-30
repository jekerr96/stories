/******/ (function(modules) { // webpackBootstrap
/******/ 	// install a JSONP callback for chunk loading
/******/ 	function webpackJsonpCallback(data) {
/******/ 		var chunkIds = data[0];
/******/ 		var moreModules = data[1];
/******/ 		var executeModules = data[2];
/******/
/******/ 		// add "moreModules" to the modules object,
/******/ 		// then flag all "chunkIds" as loaded and fire callback
/******/ 		var moduleId, chunkId, i = 0, resolves = [];
/******/ 		for(;i < chunkIds.length; i++) {
/******/ 			chunkId = chunkIds[i];
/******/ 			if(Object.prototype.hasOwnProperty.call(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 				resolves.push(installedChunks[chunkId][0]);
/******/ 			}
/******/ 			installedChunks[chunkId] = 0;
/******/ 		}
/******/ 		for(moduleId in moreModules) {
/******/ 			if(Object.prototype.hasOwnProperty.call(moreModules, moduleId)) {
/******/ 				modules[moduleId] = moreModules[moduleId];
/******/ 			}
/******/ 		}
/******/ 		if(parentJsonpFunction) parentJsonpFunction(data);
/******/
/******/ 		while(resolves.length) {
/******/ 			resolves.shift()();
/******/ 		}
/******/
/******/ 		// add entry modules from loaded chunk to deferred list
/******/ 		deferredModules.push.apply(deferredModules, executeModules || []);
/******/
/******/ 		// run deferred modules when all chunks ready
/******/ 		return checkDeferredModules();
/******/ 	};
/******/ 	function checkDeferredModules() {
/******/ 		var result;
/******/ 		for(var i = 0; i < deferredModules.length; i++) {
/******/ 			var deferredModule = deferredModules[i];
/******/ 			var fulfilled = true;
/******/ 			for(var j = 1; j < deferredModule.length; j++) {
/******/ 				var depId = deferredModule[j];
/******/ 				if(installedChunks[depId] !== 0) fulfilled = false;
/******/ 			}
/******/ 			if(fulfilled) {
/******/ 				deferredModules.splice(i--, 1);
/******/ 				result = __webpack_require__(__webpack_require__.s = deferredModule[0]);
/******/ 			}
/******/ 		}
/******/
/******/ 		return result;
/******/ 	}
/******/
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// object to store loaded and loading chunks
/******/ 	// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 	// Promise = chunk loading, 0 = chunk loaded
/******/ 	var installedChunks = {
/******/ 		"main": 0
/******/ 	};
/******/
/******/ 	var deferredModules = [];
/******/
/******/ 	// script path function
/******/ 	function jsonpScriptSrc(chunkId) {
/******/ 		return __webpack_require__.p + "" + ({"popups":"popups"}[chunkId]||chunkId) + ".chunk.js?" + {"popups":"8c593e99a8a1bcd9ff7c"}[chunkId] + ""
/******/ 	}
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/ 	// This file contains only the entry chunk.
/******/ 	// The chunk loading function for additional chunks
/******/ 	__webpack_require__.e = function requireEnsure(chunkId) {
/******/ 		var promises = [];
/******/
/******/
/******/ 		// JSONP chunk loading for javascript
/******/
/******/ 		var installedChunkData = installedChunks[chunkId];
/******/ 		if(installedChunkData !== 0) { // 0 means "already installed".
/******/
/******/ 			// a Promise means "currently loading".
/******/ 			if(installedChunkData) {
/******/ 				promises.push(installedChunkData[2]);
/******/ 			} else {
/******/ 				// setup Promise in chunk cache
/******/ 				var promise = new Promise(function(resolve, reject) {
/******/ 					installedChunkData = installedChunks[chunkId] = [resolve, reject];
/******/ 				});
/******/ 				promises.push(installedChunkData[2] = promise);
/******/
/******/ 				// start chunk loading
/******/ 				var script = document.createElement('script');
/******/ 				var onScriptComplete;
/******/
/******/ 				script.charset = 'utf-8';
/******/ 				script.timeout = 120;
/******/ 				if (__webpack_require__.nc) {
/******/ 					script.setAttribute("nonce", __webpack_require__.nc);
/******/ 				}
/******/ 				script.src = jsonpScriptSrc(chunkId);
/******/
/******/ 				// create error before stack unwound to get useful stacktrace later
/******/ 				var error = new Error();
/******/ 				onScriptComplete = function (event) {
/******/ 					// avoid mem leaks in IE.
/******/ 					script.onerror = script.onload = null;
/******/ 					clearTimeout(timeout);
/******/ 					var chunk = installedChunks[chunkId];
/******/ 					if(chunk !== 0) {
/******/ 						if(chunk) {
/******/ 							var errorType = event && (event.type === 'load' ? 'missing' : event.type);
/******/ 							var realSrc = event && event.target && event.target.src;
/******/ 							error.message = 'Loading chunk ' + chunkId + ' failed.\n(' + errorType + ': ' + realSrc + ')';
/******/ 							error.name = 'ChunkLoadError';
/******/ 							error.type = errorType;
/******/ 							error.request = realSrc;
/******/ 							chunk[1](error);
/******/ 						}
/******/ 						installedChunks[chunkId] = undefined;
/******/ 					}
/******/ 				};
/******/ 				var timeout = setTimeout(function(){
/******/ 					onScriptComplete({ type: 'timeout', target: script });
/******/ 				}, 120000);
/******/ 				script.onerror = script.onload = onScriptComplete;
/******/ 				document.head.appendChild(script);
/******/ 			}
/******/ 		}
/******/ 		return Promise.all(promises);
/******/ 	};
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/js/bundle/";
/******/
/******/ 	// on error function for async loading
/******/ 	__webpack_require__.oe = function(err) { console.error(err); throw err; };
/******/
/******/ 	var jsonpArray = window["webpackJsonp"] = window["webpackJsonp"] || [];
/******/ 	var oldJsonpFunction = jsonpArray.push.bind(jsonpArray);
/******/ 	jsonpArray.push = webpackJsonpCallback;
/******/ 	jsonpArray = jsonpArray.slice();
/******/ 	for(var i = 0; i < jsonpArray.length; i++) webpackJsonpCallback(jsonpArray[i]);
/******/ 	var parentJsonpFunction = oldJsonpFunction;
/******/
/******/
/******/ 	// add entry module to deferred list
/******/ 	deferredModules.push(["./main.js","commons"]);
/******/ 	// run deferred modules when ready
/******/ 	return checkDeferredModules();
/******/ })
/************************************************************************/
/******/ ({

/***/ "../../../../node_modules/push-data-to-url/src/pushToUrl.js":
/*!************************************************************************!*\
  !*** C:/projects/story/node_modules/push-data-to-url/src/pushToUrl.js ***!
  \************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("/*\n * JavaScript PushToUrl\n * Author: Manish Baral\n * Version: 2.0.0\n * Copyright © 2019\n*/\n\n(function( factory){\n\n  if( true && typeof module.exports == 'object' )\n      module.exports = factory();\n  else if( typeof window == 'object')\n      window.pushToUrl = factory();\n  else\n      console.error('To use this library you need to either use browser or node.js [require()]');\n\n})(function(){\n  \"use strict\"\n\n  let urlParams;\n  const BASE_URL = location.protocol + '//' + location.host + location.pathname;\n\n\n  // Plugin Constructor\n  let pushToUrl = function() {\n    init();\n  }\n\n  // Add\n  pushToUrl.prototype.add = function(options) {\n    const key = options.key;\n    const value = options.value;\n    if (key && value) {\n      if (detectQueryString()) {\n        urlParams = detectQueryString(key, value);\n      } else {\n        urlParams = key + '=' + value;\n      }\n      const newUrl = BASE_URL + '?' + urlParams;\n      window.history.pushState({path: newUrl}, '', newUrl);\n      return options;\n    }\n  }\n\n  pushToUrl.prototype.get = function(key = null) {\n    if (key) {\n      let result = null;\n      let tmp = [];\n      location.search\n          .substr(1)\n          .split(\"&\")\n          .forEach(function (item) {\n              tmp = item.split(\"=\");\n              if (tmp[0] === key) result = decodeURIComponent(tmp[1]);\n          });\n      return result;\n    }\n  }\n\n  // remove selected key\n  pushToUrl.prototype.remove = function(key = null) {\n    if (key) {\n      const count = countUrlParams();\n      let newUrl = BASE_URL;\n      if (count) {\n        if (count > 1) {\n          newUrl = location.href.split('?')\n                                .map((url, i) => !i ? url : url\n                                .replace(new RegExp(`&${key}=[^&]*|${key}=[^&]*&`), ''))\n                                .join('?');\n\n        }\n        window.history.pushState({path: newUrl}, '', newUrl);\n        return key;\n      }\n    }\n  }\n\n  // remove all\n  pushToUrl.prototype.removeAll = function() {\n    window.history.pushState({path: BASE_URL}, '', BASE_URL);\n    return BASE_URL;\n  }\n\n  // Private function to initialize\n  function init(){\n    let codeDoc = [\n      [\"initialize\", \"var pushToUrl = new pushToUrl()\"],\n      [\"add key and value to url params\", \"pushToUrl.add({key: 'name', value: 'John'});\"],\n      [\"get selected key from url params\", \"pushToUrl.get('name');\"],\n      [\"delete selected key from url params\", \"pushToUrl.remove('name');\"],\n      [\"remove all url params\", \"pushToUrl.removeAll();\"]\n    ]\n    console.table(codeDoc);\n  }\n\n  // Private function to detect url query string\n  function detectQueryString(key = null, value = null) {\n    const currentUrl = window.location.href;\n    if (key || value) {\n      let urlParams = new URLSearchParams(location.search);\n      urlParams.set(key, value);\n      return urlParams.toString();\n    } else {\n      // regex pattern for detecting ? character\n      const pattern = new RegExp(/\\?+/g);\n      return pattern.test(currentUrl);\n    }\n  }\n\n  // Private function to count the url query parameters\n  function countUrlParams() {\n    let cUrl = window.location.href;\n    let matches = cUrl.match(/[a-z\\d]+=[a-z\\d]+/gi);\n    return matches? matches.length : 0;\n  }\n\n  return pushToUrl;\n});\n\n\n//# sourceURL=webpack:///C:/projects/story/node_modules/push-data-to-url/src/pushToUrl.js?");

/***/ }),

/***/ "./main.js":
/*!*****************!*\
  !*** ./main.js ***!
  \*****************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* WEBPACK VAR INJECTION */(function($) {/* harmony import */ var _base__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./base */ \"./base.js\");\n/* harmony import */ var push_data_to_url__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! push-data-to-url */ \"../../../../node_modules/push-data-to-url/src/pushToUrl.js\");\n/* harmony import */ var push_data_to_url__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(push_data_to_url__WEBPACK_IMPORTED_MODULE_1__);\n\n\n\nconst MainPage = _base__WEBPACK_IMPORTED_MODULE_0__[\"BasePage\"].extend({\n        defaults: {}\n    },\n    {\n        init() {\n            this._super();\n            this.$element = $(this.element);\n            this.$genres = this.$element.find(\".js-toggle-genres\");\n            this.pushUrl = new push_data_to_url__WEBPACK_IMPORTED_MODULE_1___default.a();\n            this.$storiesContainer = this.$element.find(\".js-list-stories\");\n        },\n\n        \".js-plus click\"(el) {\n            el.classList.toggle(\"active\");\n            el.closest(\".js-genre\").querySelector(\".js-minus\").classList.remove(\"active\");\n\n            let include = this.pushUrl.get(\"include\");\n            let exclude = this.pushUrl.get(\"exclude\");\n            let search = this.pushUrl.get(\"q\");\n\n            this.pushUrl.removeAll();\n\n            if (!include) include = \"\";\n            if (include) {\n                include = include.split(\",\");\n            } else {\n                include = [];\n            }\n\n            let index = include.indexOf(el.dataset.id);\n            if (index !== -1) {\n                include.splice(index, 1);\n            } else {\n                include.push(el.dataset.id);\n            }\n\n            if (!exclude) {\n                exclude = [];\n            } else {\n                exclude = exclude.split(\",\");\n            }\n\n            let indexExc = exclude.indexOf(el.dataset.id);\n\n            if (indexExc !== -1) {\n                exclude.splice(indexExc, 1);\n            }\n\n            if (exclude.length) {\n                this.pushUrl.add({key: \"exclude\", value: exclude});\n            }\n\n            if (include.length) {\n                this.pushUrl.add({key: \"include\", value: include});\n            }\n\n            if (search) {\n                this.pushUrl.add({key: \"q\", value: search});\n            }\n\n            this.getStories();\n        },\n\n        \".js-minus click\"(el) {\n            el.classList.toggle(\"active\");\n            el.closest(\".js-genre\").querySelector(\".js-plus\").classList.remove(\"active\");\n\n            let exclude = this.pushUrl.get(\"exclude\");\n            let include = this.pushUrl.get(\"include\");\n            let search = this.pushUrl.get(\"q\");\n\n            this.pushUrl.removeAll();\n\n            if (!exclude) exclude = \"\";\n            if (exclude) {\n                exclude = exclude.split(\",\");\n            } else {\n                exclude = [];\n            }\n\n            let index = exclude.indexOf(el.dataset.id);\n            if (index !== -1) {\n                exclude.splice(index, 1);\n            } else {\n                exclude.push(el.dataset.id);\n            }\n\n            if (!include) {\n                include = [];\n            } else {\n                include = include.split(\",\");\n            }\n\n            let indexExc = include.indexOf(el.dataset.id);\n\n            if (indexExc !== -1) {\n                include.splice(indexExc, 1);\n            }\n\n            if (include.length) {\n                this.pushUrl.add({key: \"include\", value: include});\n            }\n\n            if (exclude.length) {\n                this.pushUrl.add({key: \"exclude\", value: exclude});\n            }\n\n            if (search) {\n                this.pushUrl.add({key: \"q\", value: search});\n            }\n\n            this.getStories();\n        },\n\n        \".js-search-form submit\"(el, ev) {\n            ev.preventDefault();\n            let exclude = this.pushUrl.get(\"exclude\");\n            let include = this.pushUrl.get(\"include\");\n            let search = el.querySelector(\"input\").value;\n            console.log(search);\n            this.pushUrl.removeAll();\n\n            if (search) {\n                this.pushUrl.add({key: \"q\", value: search});\n            }\n\n            if (include) {\n                this.pushUrl.add({key: \"include\", value: include});\n            }\n\n            if (exclude) {\n                this.pushUrl.add({key: \"exclude\", value: exclude});\n            }\n\n            this.getStories();\n        },\n\n        \".js-genres-toggle-btn click\"(el) {\n            el.classList.toggle(\"active\");\n            this.$genres.slideToggle();\n        },\n\n        getStories() {\n            this.$storiesContainer.fadeOut();\n\n            $.ajax({\n                url: \"/\" + location.search,\n                method: \"post\",\n                processData: false,\n                success: (data) => {\n                    this.$storiesContainer.html(data).stop(true, true).fadeIn();\n                },\n                error: (data) => {\n                    this.$storiesContainer.stop(true, true).fadeIn();\n                }\n            });\n        }\n    });\n\nnew MainPage(document.querySelector(\"body\"));\n\n/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ \"../../../../node_modules/jquery/dist/jquery.js\")))\n\n//# sourceURL=webpack:///./main.js?");

/***/ })

/******/ });