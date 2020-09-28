/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
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
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/main.js":
/*!******************************!*\
  !*** ./resources/js/main.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

/*----------------------- save content axios----------------------------*/

function editText(editId) {
  console.log(editId);
  var txt = document.getElementById("textArea").value;

  if (txt != undefined || txt != null || txt.length >= 0 || txt != "" || txt != NaN) {
    var text = txt.split(/\s+/);
    axios.post('http://localhost:8080/wordpress/wp-content/plugins/BIT-first/api/?route=api-admin', {
      idea: text,
      editId: editId
    })["catch"](function (err) {
      console.log(err instanceof TypeError);
    });
    setTimeout(renderTreeColons, 300);
  }
}

function solutionText(sId) {
  var txt1 = document.getElementById("textArea1").value;

  if (txt1 != undefined || txt1 != null || txt1.length >= 0 || txt1 != "" || txt1 != NaN) {
    var text1 = txt1.split(/\s+/);
    axios.post('http://localhost:8080/wordpress/wp-content/plugins/BIT-first/api/?route=api-admin', {
      soliution: text1,
      solutionId: sId
    })["catch"](function (err) {
      console.log(err instanceof TypeError);
    });
    setTimeout(renderTreeColons, 300);
  }
}
/*----------------------- delete content axios----------------------------*/


function deleteIdea(deleteId) {
  axios.post('http://localhost:8080/wordpress/wp-content/plugins/BIT-first/api/?route=api-admin', {
    deletedId: deleteId
  })["catch"](function (err) {
    console.log(err instanceof TypeError);
  });
  setTimeout(renderTreeColons, 300);
} //  textArea.addEventListener("input", function(){
//    let maxlength = this.getAttribute("maxlength");
//    let currentLength = this.value.length;
//    if( currentLength >= maxlength ){
//      document.getElementById("count").innerHTML = "0  simboliu liko";
//    }else{
//      document.getElementById("count").innerHTML = maxlength - currentLength + " simboliu liko";
//      //console.log(maxlength - currentLength + " chars left");
//    }
//  });
//  /*------------------------------render data  axios-----------------------------------------*/


window.addEventListener('load', renderTreeColons);

function renderTreeColons() {
  axios.get('http://localhost:8080/wordpress/wp-content/plugins/BIT-first/api/?route=api-admin', {}).then(function (response) {
    if (response.status == 200 && response.statusText == 'OK') {
      var data = response.data.allData;
      var keys = [];

      for (var key in data) {
        keys.push(key);
      }

      var rende = document.getElementById('box');
      var HTMLString = '';

      for (var i = keys.length - 1; i >= 0; i--) {
        var value = data[keys[i]];
        HTMLString += "<div class=\"box\"> \n            <div class=\"text\"><div class=\"data\" >".concat(value.post_date, "</div>                 \n                </div>\n                <div class=\"ideaContent\">\n                    <div class=\"ideaTextEdit\">\n                        <textarea class=\"ideaText\" maxlength=\"200\" name=\"idea\" id=\"textArea\" data-attribute_name=\"\">\n                                ").concat(value.idea_content, "\n                        </textarea>  \n                        <button  class=\"ideaBtn delIdea\" id=\"").concat(value.ID, "\">\n                            Trinti\n                        </button> \n                        <button class=\"ideaBtn edit editButtonIdea\" id=\"").concat(value.ID, "\">\n                            Saugoti\n                        </button>\n                    </div>\n                    <div class=\"ideaSoliution\">\n                        <textarea class=\"ideaTextSoliution\" maxlength=\"200\" name=\"idea\" id=\"textArea1\" > \n                            ").concat(value.idea_solution, "                     \n                        </textarea>\n                        <button class=\"ideaBtn delIdea answer\" id=\"").concat(value.ID, "\">\n                            Trinti\n                        </button> \n                        <button  class=\"ideaBtn addButtonIdea\" id=\"").concat(value.ID, "\">\n                            Sprendimas\n                        </button> \n                    </div> \n                    <span class=\"textCount\" id=\"count\"></span>\n                    </div>  \n                        <div class=\"like\" data-custom-id=\"").concat(value.ID, "\">\n                            <span class=\"like__number\">Like: ").concat(value.idea_like, "</span>             \n                        </div>            \n                    </div>\n                </div>");
      }

      rende.innerHTML = HTMLString;
      var editBtn = document.querySelectorAll(".editButtonIdea");
      var postBtn = document.querySelectorAll(".addButtonIdea");
      var deletetBtn = document.querySelectorAll(".delIdea");

      var _loop = function _loop(_i) {
        var sId = postBtn[_i].id;

        postBtn[_i].addEventListener('click', function () {
          solutionText(sId);
        }, false);
      };

      for (var _i = 0; _i < postBtn.length; _i++) {
        _loop(_i);
      }

      var _loop2 = function _loop2(_i2) {
        var editId = editBtn[_i2].id;

        editBtn[_i2].addEventListener('click', function () {
          editText(editId);
        }, false);
      };

      for (var _i2 = 0; _i2 < editBtn.length; _i2++) {
        _loop2(_i2);
      }

      var _loop3 = function _loop3(_i3) {
        var deleteId = deletetBtn[_i3].id;

        deletetBtn[_i3].addEventListener('click', function () {
          deleteIdea(deleteId);
        }, false);
      };

      for (var _i3 = 0; _i3 < deletetBtn.length; _i3++) {
        _loop3(_i3);
      }
    } // console.log(response.status);
    // console.log(response.statusText);
    //  console.log(response.headers);
    // console.log(response.config);


    return response;
  })["catch"](function (error) {
    console.log(error instanceof TypeError);
  });
}

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!**************************************************************!*\
  !*** multi ./resources/js/main.js ./resources/sass/app.scss ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Applications/MAMP/htdocs/wordpress/wp-content/plugins/BIT-first/resources/js/main.js */"./resources/js/main.js");
module.exports = __webpack_require__(/*! /Applications/MAMP/htdocs/wordpress/wp-content/plugins/BIT-first/resources/sass/app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });