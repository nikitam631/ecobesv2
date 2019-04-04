
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('post-component', require('./components/postComponent.vue'));

Vue.component('myprofile-component', require('./components/myprofileComponent.vue'));

const app = new Vue({
    el: '#app',

    // data:{
    //   blog:{},
    //   user:[],
    // },

    // mounted(){
    //   axios.post('/getPosts')
    //     .then(response => {
    //       this.blog = response.data;
    //       console.log(response);
    //     })
    //     .catch(function(error){
    //       console.log(error);
    //     });
    // }, //mounted closing

    // methods:{
    //
    // } //methods closing
});
