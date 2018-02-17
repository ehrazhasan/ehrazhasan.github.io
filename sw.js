importScripts('/cache-polyfill.js');

self.addEventListener('install', function(e) {
 e.waitUntil(
   caches.open('Dev').then(function(cache) {
     return cache.addAll([
       '/',
       'form.php',
       'form.php?homescreen=1',
       '?homescreen=1',
       'CSS/Form.css',
     ]);
   })
 );
});
self.addEventListener('fetch', function(event) {

console.log(event.request.url);

});