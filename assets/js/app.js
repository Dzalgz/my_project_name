/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.css';
import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './App.vue'
import createproducts from './createproducts'
import showproducts from './showproducts'
Vue.use(VueRouter);



const router = new VueRouter({
    routes: [
        {
            path: '/create_products',
            name:'create',
            component: createproducts,
        },
        {
            path: '/show_products',
            name:'show',
            component: showproducts,
        },
    ]
})


new Vue({
    el: '#app',
    render: h => h(App),
    router
})



// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';


