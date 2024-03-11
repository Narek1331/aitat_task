import axios from 'axios';

import { createApp } from 'vue';
import App from '.vue//App.vue';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

createApp(App).mount("#app");
