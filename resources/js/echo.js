import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: window.location.hostname, // e.g., 'drawit.cfd'
    wsPort: 80,                      // HTTP port
    forceTLS: false,                  // Disable HTTPS
    enabledTransports: ['ws'],        // Only use WS (no WSS fallback)
});
