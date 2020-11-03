require('./bootstrap');
import Vue from 'vue'

//Main pages
import App from './views/app.vue'

import InfiniteLoading from 'vue-infinite-loading';

Vue.use(require('vue-resource'));
Vue.use(InfiniteLoading, { /* options */ });

const app = new Vue({
    el: '#app',
    components: { App }
});