/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import VueRouter from 'vue-router'

window.Vue = require('vue');
Vue.use(VueRouter)

import { store } from './store'

window.eventBus = new Vue()

const routes = [
    { 
    	path: '/', 
    	name: 'articles',
    	component: require('./components/Articles.vue').default
    },
    { 
        path: '/article/:id', 
        name: 'article',
        props: true,
        component: require('./components/singleArticle.vue').default
    },
    { 
    	path: '/login', 
    	name: 'login',
    	component: require('./components/auth/Login.vue').default,
        props: true,
        meta: {
          requiresVisitor: true,
        }
    },
    { 
    	path: '/register',
    	name: 'register', 
    	component: require('./components/auth/Register.vue').default,
        meta: {
          requiresVisitor: true,
        }
    },
    { 
    	path: '/logout',
    	name: 'logout', 
    	component: require('./components/auth/Logout.vue').default 
    }
]

const router = new VueRouter({
    routes
})


Vue.component(
	'navbar', 
	require('./components/Navbar.vue').default
);


router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!store.getters.loggedIn) {
      next({
        name: 'login',
      })
    } else {
      next()
    }
  } else if (to.matched.some(record => record.meta.requiresVisitor)) {
    if (store.getters.loggedIn) {
      next({
        name: 'articles',
      })
    } else {
      next()
    }
  } else {
    next()
  }
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    router,
    store: store,
}).$mount('#app')
