import Echo from 'laravel-echo';

window.Pusher = undefined;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: 'local', // أي قيمة، لا تؤثر في الوضع المحلي
    wsHost: window.location.hostname,
    wsPort: 8080,
    wssPort: 8080,
    forceTLS: false,
    disableStats: true,
    withCredentials: true,
});
