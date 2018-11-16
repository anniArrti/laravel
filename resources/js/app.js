
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
*/

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter);

import App from './components/App'
import Welcome from './components/Welcome'
import about from './components/about'
import contacts from './components/contacts'
import edit from './components/edit'
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
*/

//Vue.component('example-component', require('./components/ExampleComponent.vue'));
const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Welcome
        },
        {
            path: '/about',
            name: 'about',
            component: about
        },
        {
            path: '/contacts',
            name: 'contacts',
            component: contacts
        },
        {
            path: '/edit/:id',
            name: 'edit',
            component: edit
        },
    ],
});
// const files = require.context('./', true, /\.vue$/i)

// files.keys().map(key => {
//     return Vue.component(_.last(key.split('/')).split('.')[0], files(key))
// })

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
 
//const app = new Vue({ router }).$mount('#app')
const app = new Vue({
        el: '#app',
        components: { App },
        router,
        /*data: {
        users: []
    },

    ready: function() {
      this.fetchMessages();
    },

    methods: {
        fetchMessages: function() {
            this.$http.get('/vueitems', function(users) {
                alert(users);
                this.$set('users', users);
            });
        }
    }*/
    });
/*const app = new Vue({
    el: '#app'
});
*/