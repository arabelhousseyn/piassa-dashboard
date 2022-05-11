"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_components_Seller_SellerJobsComponent_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Seller/SellerJobsComponent.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Seller/SellerJobsComponent.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************************************************************/
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
//
//
//
//
//
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  components: {},
  props: ['jobs'],
  data: function data() {
    return {
      data: undefined,
      seller_id: window.location.pathname.split('/').pop(),
      search: null,
      dialog: false,
      headers: [{
        text: 'Description',
        align: 'start',
        sortable: true,
        value: 'job'
      }, {
        text: 'actions',
        value: 'actions',
        sortable: false
      }],
      seller_job_id: null
    };
  },
  methods: {
    init: function init() {
      var _this = this;

      axios.get('/sanctum/csrf-cookie').then(function (res) {
        axios.get("/api/sellers/jobs/".concat(_this.seller_id)).then(function (e) {
          _this.data = e.data.data;
        })["catch"](function (err) {
          if (err.response.status == 404) {
            _this.$router.push('/home/sellers');
          }

          console.log(err);
        });
      });
    },
    destory: function destory(id) {
      this.seller_job_id = id;
      this.dialog = true;
    },
    close: function close() {
      this.seller_job_id = null;
      this.dialog = false;
    }
  },
  mounted: function mounted() {
    this.init();
  }
});

/***/ }),

/***/ "./resources/js/components/Seller/SellerJobsComponent.vue":
/*!****************************************************************!*\
  !*** ./resources/js/components/Seller/SellerJobsComponent.vue ***!
  \****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _SellerJobsComponent_vue_vue_type_template_id_6c2ea003___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./SellerJobsComponent.vue?vue&type=template&id=6c2ea003& */ "./resources/js/components/Seller/SellerJobsComponent.vue?vue&type=template&id=6c2ea003&");
/* harmony import */ var _SellerJobsComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./SellerJobsComponent.vue?vue&type=script&lang=js& */ "./resources/js/components/Seller/SellerJobsComponent.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _SellerJobsComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _SellerJobsComponent_vue_vue_type_template_id_6c2ea003___WEBPACK_IMPORTED_MODULE_0__.render,
  _SellerJobsComponent_vue_vue_type_template_id_6c2ea003___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Seller/SellerJobsComponent.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/Seller/SellerJobsComponent.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************!*\
  !*** ./resources/js/components/Seller/SellerJobsComponent.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SellerJobsComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./SellerJobsComponent.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Seller/SellerJobsComponent.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SellerJobsComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Seller/SellerJobsComponent.vue?vue&type=template&id=6c2ea003&":
/*!***********************************************************************************************!*\
  !*** ./resources/js/components/Seller/SellerJobsComponent.vue?vue&type=template&id=6c2ea003& ***!
  \***********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SellerJobsComponent_vue_vue_type_template_id_6c2ea003___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SellerJobsComponent_vue_vue_type_template_id_6c2ea003___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SellerJobsComponent_vue_vue_type_template_id_6c2ea003___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./SellerJobsComponent.vue?vue&type=template&id=6c2ea003& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Seller/SellerJobsComponent.vue?vue&type=template&id=6c2ea003&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Seller/SellerJobsComponent.vue?vue&type=template&id=6c2ea003&":
/*!**************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Seller/SellerJobsComponent.vue?vue&type=template&id=6c2ea003& ***!
  \**************************************************************************************************************************************************************************************************************************************/
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
  return _vm.jobs !== undefined || _vm.data !== undefined
    ? _c(
        "div",
        { staticClass: "seller-jobs" },
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
                      staticStyle: {
                        "text-decoration": "none",
                        color: "white",
                      },
                      attrs: { to: "/home/sellers" },
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
                  items: _vm.jobs == undefined ? _vm.data : _vm.jobs,
                  search: _vm.search,
                  "sort-by": "created_at",
                },
                scopedSlots: _vm._u(
                  [
                    {
                      key: "top",
                      fn: function () {
                        return [
                          _c(
                            "v-toolbar",
                            { attrs: { flat: "" } },
                            [
                              _c("v-toolbar-title", [_vm._v("Travaux")]),
                              _vm._v(" "),
                              _c("v-divider", {
                                staticClass: "mx-4",
                                attrs: { inset: "", vertical: "" },
                              }),
                            ],
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
                      key: "item.actions",
                      fn: function (ref) {
                        var item = ref.item
                        return [
                          _c(
                            "v-menu",
                            {
                              attrs: { bottom: "", "min-width": "200" },
                              scopedSlots: _vm._u(
                                [
                                  {
                                    key: "activator",
                                    fn: function (ref) {
                                      var on = ref.on
                                      var attrs = ref.attrs
                                      return [
                                        _c(
                                          "v-btn",
                                          _vm._g(
                                            _vm._b(
                                              {
                                                attrs: {
                                                  dark: "",
                                                  color: "primary",
                                                  fab: "",
                                                  small: "",
                                                  text: "",
                                                },
                                              },
                                              "v-btn",
                                              attrs,
                                              false
                                            ),
                                            on
                                          ),
                                          [
                                            _c("v-icon", [
                                              _vm._v("mdi-dots-horizontal"),
                                            ]),
                                          ],
                                          1
                                        ),
                                      ]
                                    },
                                  },
                                ],
                                null,
                                true
                              ),
                            },
                            [
                              _vm._v(" "),
                              _c(
                                "v-list",
                                [
                                  _c(
                                    "v-list-item-group",
                                    [
                                      item.deleted_at == null
                                        ? _c(
                                            "v-list-item",
                                            {
                                              attrs: { link: "" },
                                              on: {
                                                click: function ($event) {
                                                  return _vm.destory(item.id)
                                                },
                                              },
                                            },
                                            [
                                              _c(
                                                "v-list-item-icon",
                                                [
                                                  _c(
                                                    "v-icon",
                                                    { attrs: { color: "red" } },
                                                    [_vm._v("mdi-delete")]
                                                  ),
                                                ],
                                                1
                                              ),
                                              _vm._v(" "),
                                              _c(
                                                "v-list-item-content",
                                                [
                                                  _c("v-list-item-title", [
                                                    _vm._v("Supprimer"),
                                                  ]),
                                                ],
                                                1
                                              ),
                                            ],
                                            1
                                          )
                                        : _vm._e(),
                                    ],
                                    1
                                  ),
                                ],
                                1
                              ),
                            ],
                            1
                          ),
                        ]
                      },
                    },
                    {
                      key: "item.deleted_at",
                      fn: function (ref) {
                        var item = ref.item
                        return [
                          item.deleted_at == null
                            ? _c(
                                "v-chip",
                                { attrs: { dark: "", color: "green" } },
                                [
                                  _vm._v(
                                    "\n                    Active\n                "
                                  ),
                                ]
                              )
                            : _c(
                                "v-chip",
                                { attrs: { dark: "", color: "red" } },
                                [
                                  _vm._v(
                                    "\n                    Supprimé\n                "
                                  ),
                                ]
                              ),
                        ]
                      },
                    },
                    {
                      key: "no-data",
                      fn: function () {
                        return [
                          _c("v-btn", { attrs: { color: "primary" } }, [
                            _vm._v(
                              "\n                    Reset\n                "
                            ),
                          ]),
                        ]
                      },
                      proxy: true,
                    },
                  ],
                  null,
                  false,
                  9056302
                ),
              }),
            ],
            1
          ),
        ],
        1
      )
    : _vm._e()
}
var staticRenderFns = []
render._withStripped = true



/***/ })

}]);