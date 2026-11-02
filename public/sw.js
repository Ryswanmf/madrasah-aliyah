const CACHE_NAME = 'madarunnajah-v1';
const STATIC_ASSETS = [
  '/',
  '/manifest.webmanifest',
  '/assets/images/logo.webp',
  '/assets/images/favicon.webp'
];

self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => cache.addAll(STATIC_ASSETS)).catch(() => {})
  );
  self.skipWaiting();
});

self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((keys) => Promise.all(
      keys.filter((key) => key !== CACHE_NAME).map((key) => caches.delete(key))
    ))
  );
  self.clients.claim();
});

self.addEventListener('fetch', (event) => {
  if (event.request.method !== 'GET') return;

  const url = new URL(event.request.url);
  // Only cache same origin assets and images/css/js
  if (url.origin === self.location.origin) {
    if (event.request.destination === 'image' || event.request.destination === 'style' || event.request.destination === 'script') {
      event.respondWith(
        caches.match(event.request).then((cached) => {
          const networked = fetch(event.request).then((response) => {
            if (response && response.status === 200) {
              const cacheCopy = response.clone();
              caches.open(CACHE_NAME).then((cache) => cache.put(event.request, cacheCopy));
            }
            return response;
          }).catch(() => cached);
          return cached || networked;
        })
      );
    }
  }
});
