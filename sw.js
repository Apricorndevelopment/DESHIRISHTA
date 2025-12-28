self.addEventListener('push', function(e) {
    const data = e.data.json();

    self.registration.showNotification(data.title, {
        body: data.message,
        icon: 'images/logo.png',
        data: {
            url: data.link
        }
    });
});

self.addEventListener('notificationclick', function(e) {
    e.notification.close();
    e.waitUntil(
        clients.openWindow(e.notification.data.url)
    );
});
