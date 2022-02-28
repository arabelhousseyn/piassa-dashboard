import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        user : [],
        isAuth : false,
        logo : 'data:image/png;base64,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'
    },
    mutations: {
        SET_AUTH(state,status)
        {
            state.isAuth = status
        },
        SET_USER(state,data)
        {
            state.user = data
        },
        SET_OUT(state,option)
        {
            state.user = []
            state.isAuth = false
        },
        CHECK_AUTH(state,option)
        {
            state.isAuth = (localStorage.getItem('isAuth') !== null) ? true : false
            state.user = (localStorage.getItem('data') !== null) ? JSON.parse(localStorage.getItem('data')) : []
        }
    },
    actions: {
    },
    modules: {
    }
})
