import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

const echo = new Echo({
    broadcaster: import.meta.env.VITE_MY_ENV_BROADCAST,
    key: import.meta.env.VITE_MY_ENV_KEY,
    cluster: import.meta.env.VITE_MY_ENV_CLUSTER,
    forceTLS: false,
});


export default echo;
