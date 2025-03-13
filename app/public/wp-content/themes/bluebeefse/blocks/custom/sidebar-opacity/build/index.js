/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/attributes/sidebarOpacity.js":
/*!******************************************!*\
  !*** ./src/attributes/sidebarOpacity.js ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__);

/**
 * sidebarOpacity.js - allow for a base Opacity style attribute on any block.
 */
const {
  __
} = wp.i18n;

/**
 * Conditionally, you can enable this control for certain blocks if you need. Use the array to set the machine name of every block you want to enable this for.
 * If you aren't sure what the machine name is, go into the wp-includes/blocks folder, find the block.json file corresponding to the block you want to include, and copy the 'name' value.
 * 
 * const blockWhitelist = [
 *  'core/image',
 *  'core/paragraph'
 * ];
 * 
 * Within the custom attribute setup below (setOpacityAttribute), right before the object is assigned, you can pull the name from each block and then prevent it from appearing in the sidebar.
 * 
 * if (!blockWhitelist.includes( name ) ) {
 *  return settings;
 * }
 * 
 * Then within the BlockListBlock function below, set a conditional around the <BlockListBlock> declaration and return the replacement props. This will ignore any custom props you set for that block.
 * Of course, this logic can be reversed completely and used to set up a blacklist.
 * 
 * if (!blockWhitelist.includes( props.name ) ) {
 *  return (
 *      <BlockListBlock { ...props } />
 *  );
 * }
 */

const {
  createHigherOrderComponent
} = wp.compose;
const {
  Fragment,
  useState
} = wp.element;
const {
  InspectorControls
} = wp.blockEditor;
const {
  PanelBody,
  SelectControl,
  RangeControl
} = wp.components;
const blockOpacityAttribute = (settings, name) => {
  if (!name.startsWith('core/')) {
    return settings;
  }
  return Object.assign({}, settings, {
    attributes: Object.assign({}, settings.attributes, {
      blockOpacity: {
        type: 'number',
        default: 100
      } // Default to 100 (full opacity)
    })
  });
};
wp.hooks.addFilter('blocks.registerBlockType', 'bluebeefse-custom/block-opacity-attribute', blockOpacityAttribute);
const blockOpacityControl = createHigherOrderComponent(BlockEdit => {
  return props => {
    // If current block is not allowed
    if (!props.name.startsWith('core/')) {
      return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__.jsx)(BlockEdit, {
        ...props
      });
    }
    const {
      attributes,
      setAttributes
    } = props;
    const {
      blockOpacity = 100
    } = attributes; // Default to 100

    return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__.jsxs)(Fragment, {
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__.jsx)(BlockEdit, {
        ...props
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__.jsx)(InspectorControls, {
        group: "styles",
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__.jsx)(PanelBody, {
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__.jsx)(RangeControl, {
            help: "Select the opacity level for this block.",
            label: "Opacity",
            max: 100,
            min: 0,
            value: blockOpacity,
            onChange: (newBlockOpacity = 100) => {
              // Default to 100 if no value
              setAttributes({
                blockOpacity: newBlockOpacity
              });
            }
          })
        })
      })]
    });
  };
}, 'blockOpacityControl');
wp.hooks.addFilter('editor.BlockEdit', 'bluebeefse-custom/block-opacity-control', blockOpacityControl);
const blockOpacityListBlock = createHigherOrderComponent(BlockListBlock => {
  return props => {
    const {
      attributes
    } = props;
    const {
      blockOpacity = 100
    } = attributes; // Default to 100 if not set

    // Apply the opacity to the block wrapper for editor display
    const updatedWrapperProps = {
      ...props.wrapperProps,
      style: {
        ...props.wrapperProps?.style,
        opacity: blockOpacity !== 100 ? blockOpacity / 100 : undefined // Only apply if not 100
      }
    };
    return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__.jsx)(BlockListBlock, {
      ...props,
      wrapperProps: updatedWrapperProps
    });
  };
}, 'blockOpacityListBlock');
wp.hooks.addFilter('editor.BlockListBlock', 'bluebeefse-custom/block-opacity-list-block', blockOpacityListBlock);
const blockOpacitySave = (extraProps, blockType, attributes) => {
  const {
    blockOpacity
  } = attributes;

  // Only apply opacity style if blockOpacity is explicitly set and different from default (100)
  if (blockOpacity !== undefined && blockOpacity !== 100) {
    extraProps.style = {
      ...extraProps.style,
      // Preserve other styles
      opacity: blockOpacity / 100 // Apply opacity if not default
    };
  }
  return extraProps;
};
wp.hooks.addFilter('blocks.getSaveContent.extraProps', 'bluebeefse-custom/block-opacity-save', blockOpacitySave);

/***/ }),

/***/ "react/jsx-runtime":
/*!**********************************!*\
  !*** external "ReactJSXRuntime" ***!
  \**********************************/
/***/ ((module) => {

module.exports = window["ReactJSXRuntime"];

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
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
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
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
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
/************************************************************************/
var __webpack_exports__ = {};
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _attributes_sidebarOpacity__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./attributes/sidebarOpacity */ "./src/attributes/sidebarOpacity.js");

/******/ })()
;
//# sourceMappingURL=index.js.map