import axios from 'axios';

import { createApp } from 'vue';
import App from './App.vue';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
