importScripts('https://storage.googleapis.com/workbox-cdn/releases/4.3.1/workbox-sw.js');

if (workbox) {
    console.log(`Yay! Workbox is loaded 🎉`);
} else {
    console.log(`Boo! Workbox didn't load 😬`);
}
workbox.setConfig({ debug: false });
workbox.googleAnalytics.initialize();

workbox.core.setCacheNameDetails({
    prefix: 'aidoc-app',
    suffix: 'v1.1'
});

workbox.routing.registerRoute(
    "/",
    new workbox.strategies.NetworkFirst()
);

workbox.routing.registerRoute(
    "/offline.html",
    new workbox.strategies.NetworkFirst()
);

const offlinePage = '/offline.html';
/**
 * Pages to cache
 */

workbox.routing.registerRoute(/\/enter-code/,
    async ({event}) => {
        try {
            return await workbox.strategies.staleWhileRevalidate({
                cacheName: 'cache-page'
            }).handle({event});
        } catch (error) {
            return caches.match(offlinePage);
        }
    }
);

// Cache the Google Fonts stylesheets with a stale-while-revalidate strategy.
workbox.routing.registerRoute(
    /^fonts/,
    new workbox.strategies.StaleWhileRevalidate({
        cacheName: 'google-fonts-stylesheet',
    })
);

workbox.routing.registerRoute(
    /\.(?:js|css)$/,
    new workbox.strategies.StaleWhileRevalidate({
        cacheName: 'static-resource',
    })
);

workbox.routing.registerRoute(
    // Cache image files.
    /\.(?:png|jpg|jpeg|svg|gif)$/,
    // Use the cache if it's available.
    new workbox.strategies.CacheFirst({
        // Use a custom cache name.
        cacheName: 'image-cache',
        plugins: [
            new workbox.expiration.Plugin({
                // Cache only 20 images.
                maxEntries: 20,
                // Cache for a maximum of a week.
                maxAgeSeconds: 7 * 24 * 60 * 60,
            })
        ],
    })
);