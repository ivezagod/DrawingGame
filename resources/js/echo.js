import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST || window.location.hostname,
    wsPort: import.meta.env.VITE_REVERB_PORT || 433, // Default to 443 for production
    wssPort: import.meta.env.VITE_REVERB_PORT || 433,
    forceTLS: true, // Always true in production
    enabledTransports: ['ws', 'wss'],
});
