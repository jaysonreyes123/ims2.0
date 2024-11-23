import axios from 'axios';
this.window.axios = axios;

this.window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
