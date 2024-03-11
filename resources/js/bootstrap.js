import axios from 'axios';

import { createApp } from 'vue';
import App from './vue/App.vue';
import router from './vue/router';
import store from './vue/store';

import '../css/tailwind.css';
import '../css/app.css';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

createApp(App)
.use(store)
.use(router)
.mount("#app");
