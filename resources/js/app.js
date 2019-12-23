/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import VueAudio from 'vue-audio-better'

window.Vue = require('vue');
Vue.use(VueAudio);
import VueVideoPlayer from 'vue-video-player';

// require videojs style
import 'video.js/dist/video-js.css';
// import 'vue-video-player/src/custom-theme.css'

Vue.use(VueVideoPlayer, /* {
  options: global default options,
  events: global videojs events
} */);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('follow-button', require('./components/FollowButton.vue').default);
Vue.component('friend-button', require('./components/FriendButton.vue').default);
Vue.component('accept-button', require('./components/AcceptButton.vue').default);
Vue.component('like-button', require('./components/LikeButton.vue').default);
Vue.component('search-bar', require('./components/SearchBar.vue').default);
Vue.component('post', require('./components/Post.vue').default);
Vue.component('comment', require('./components/Comment.vue').default);
Vue.component('comment-section', require('./components/CommentSection.vue').default);
Vue.component('reply', require('./components/Reply.vue').default);
Vue.component('v-player', require('./components/Vplayer.vue').default);
Vue.component('info-button', require('./components/InfoButton.vue').default);
// Vue.component('add-new-post', require('./components/AddNewPost.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',


});
