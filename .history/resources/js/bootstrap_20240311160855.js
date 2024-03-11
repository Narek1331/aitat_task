import axios from 'axios';

import { createApp } from 'vue';
import App from './vue/App.vue';
import router from './vue/router';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

createApp(App)
.use(store)
.mount("#app");