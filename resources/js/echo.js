import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST || window.location.hostname,
    wsPort: 443,  // Explicitly set to 443 (not 433 typo)
    wssPort: 443, // Explicitly set to 443 (not 433 typo)
    forceTLS: true, // Enforces wss://
    enabledTransports: ['ws', 'wss'], // Fallback to ws:// if wss:// fails
});
