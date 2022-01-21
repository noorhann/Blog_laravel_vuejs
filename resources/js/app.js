

require('./bootstrap');

window.Vue = require('vue').default;


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('global-home', require('./components/GlobalHome.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('register', require('./components/Register.vue').default);
Vue.component('login', require('./components/Login.vue').default);


import router from './routes/routes';
import Vuex from 'vuex';
import Axios from 'axios';

Vue.use(Vuex)
const store = new Vuex.Store({
    state: {
        userToken: null,
        user: null,
        EditedPost: {}
    },
    getters: { 
        isLogged(state) {
            return !!state.userToken;
        },
        isAdmin(state) {
            if (state.user) {
                return state.user.is_admin
            }
            return null

        },
        PostToEdit(state) {
            return state.EditedPost
        }
    },
    mutations: {
        setUserToken(state, userToken) {
            state.userToken = userToken;
            localStorage.setItem('userToken', JSON.stringify(userToken));
            axios.defaults.headers.common.Authorization = `Bearer ${userToken}`
        },
        removeUserToken(state) {

            state.userToken = null;
            localStorage.removeItem('userToken')
        },
        setUser(state, user) {
            state.user = user
        },
        logout(state) {
            state.userToken = null;
            localStorage.removeItem('userToken');
            window.location.pathname = "/"
        },
        EditPost(state, post) {
            state.EditedPost = post;
        }
    },
    actions: {
        RegisterUser({ commit }, payload) {
            axios.post('/api/register', payload)
                .then(res => {
                    console.log(res)
                    commit('setUserToken', res.data.token)
                })
                .catch(err => {
                    console.log(err)
                })
        },
        LoginUser({ commit }, payload) {
            axios.post('/api/login', payload)
                .then(res => {
                    console.log(res)
                    commit('setUserToken', res.data.token)
                    axios.get('/api/user')
                        .then(res => {
                            //console.log(res.data)
                            commit('setUser', res.data.user)
                        })
                })
                .catch(err => {
                    console.log(err)
                })

        }

    }
})

const app = new Vue({
    
    el: '#app',
    router,
    store: store

});
