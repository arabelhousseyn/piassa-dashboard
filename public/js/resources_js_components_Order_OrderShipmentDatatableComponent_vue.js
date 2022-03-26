"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_components_Order_OrderShipmentDatatableComponent_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Order/OrderShipmentDatatableComponent.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Order/OrderShipmentDatatableComponent.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  props: ['data'],
  data: function data() {
    return {
      data2: undefined,
      search: null,
      user_order_id: window.location.pathname.split('/').pop(),
      headers: [{
        text: 'Statu',
        align: 'start',
        sortable: true,
        value: 'event'
      }, {
        text: 'Créé à',
        value: 'created_at'
      }]
    };
  },
  methods: {
    init: function init() {
      var _this = this;

      axios.get('/sanctum/csrf-cookie').then(function (res) {
        axios.get("/api/orders/events/".concat(_this.user_order_id)).then(function (e) {
          _this.data2 = e.data.data;
        })["catch"](function (err) {
          _this.$router.push('/home/orders');
        });
      });
    }
  },
  mounted: function mounted() {
    this.init();
  }
});

/***/ }),

/***/ "./resources/js/components/Order/OrderShipmentDatatableComponent.vue":
/*!***************************************************************************!*\
  !*** ./resources/js/components/Order/OrderShipmentDatatableComponent.vue ***!
  \***************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _OrderShipmentDatatableComponent_vue_vue_type_template_id_513ec5e5___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./OrderShipmentDatatableComponent.vue?vue&type=template&id=513ec5e5& */ "./resources/js/components/Order/OrderShipmentDatatableComponent.vue?vue&type=template&id=513ec5e5&");
/* harmony import */ var _OrderShipmentDatatableComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./OrderShipmentDatatableComponent.vue?vue&type=script&lang=js& */ "./resources/js/components/Order/OrderShipmentDatatableComponent.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _OrderShipmentDatatableComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _OrderShipmentDatatableComponent_vue_vue_type_template_id_513ec5e5___WEBPACK_IMPORTED_MODULE_0__.render,
  _OrderShipmentDatatableComponent_vue_vue_type_template_id_513ec5e5___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Order/OrderShipmentDatatableComponent.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/Order/OrderShipmentDatatableComponent.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************!*\
  !*** ./resources/js/components/Order/OrderShipmentDatatableComponent.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderShipmentDatatableComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./OrderShipmentDatatableComponent.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Order/OrderShipmentDatatableComponent.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderShipmentDatatableComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Order/OrderShipmentDatatableComponent.vue?vue&type=template&id=513ec5e5&":
/*!**********************************************************************************************************!*\
  !*** ./resources/js/components/Order/OrderShipmentDatatableComponent.vue?vue&type=template&id=513ec5e5& ***!
  \**********************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderShipmentDatatableComponent_vue_vue_type_template_id_513ec5e5___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderShipmentDatatableComponent_vue_vue_type_template_id_513ec5e5___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderShipmentDatatableComponent_vue_vue_type_template_id_513ec5e5___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./OrderShipmentDatatableComponent.vue?vue&type=template&id=513ec5e5& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Order/OrderShipmentDatatableComponent.vue?vue&type=template&id=513ec5e5&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Order/OrderShipmentDatatableComponent.vue?vue&type=template&id=513ec5e5&":
/*!*************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Order/OrderShipmentDatatableComponent.vue?vue&type=template&id=513ec5e5& ***!
  \*************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function () {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "order-shipment-data-table" },
    [
      _c(
        "v-container",
        { attrs: { fluid: "" } },
        [
          _c(
            "v-btn",
            { attrs: { color: "primary" } },
            [
              _c(
                "router-link",
                {
                  staticStyle: { "text-decoration": "none", color: "white" },
                  attrs: { to: "/home/orders" },
                },
                [
                  _c("v-icon", [_vm._v("mdi-subdirectory-arrow-left")]),
                  _vm._v(" Retour "),
                ],
                1
              ),
            ],
            1
          ),
          _vm._v(" "),
          _c("v-data-table", {
            staticClass: "elevation-1 mt-3",
            attrs: {
              headers: _vm.headers,
              items: _vm.data == undefined ? _vm.data2 : _vm.data,
              search: _vm.search,
              "sort-by": "created_at",
            },
            scopedSlots: _vm._u([
              {
                key: "top",
                fn: function () {
                  return [
                    _c(
                      "v-toolbar",
                      { attrs: { flat: "" } },
                      [_c("v-toolbar-title", [_vm._v("Livraison")])],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "v-toolbar",
                      { attrs: { flat: "" } },
                      [
                        _c("v-text-field", {
                          attrs: {
                            "append-icon": "mdi-magnify",
                            label: "Recherche",
                            "single-line": "",
                            "hide-details": "",
                          },
                          model: {
                            value: _vm.search,
                            callback: function ($$v) {
                              _vm.search = $$v
                            },
                            expression: "search",
                          },
                        }),
                      ],
                      1
                    ),
                  ]
                },
                proxy: true,
              },
              {
                key: "no-data",
                fn: function () {
                  return [
                    _c("v-btn", { attrs: { color: "primary" } }, [
                      _vm._v("\n                    Reset\n                "),
                    ]),
                  ]
                },
                proxy: true,
              },
            ]),
          }),
        ],
        1
      ),
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ })

}]);