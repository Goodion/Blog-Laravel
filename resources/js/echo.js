Echo
    .private(`App.User.` + userId)
    .notification((notification) => {
        alert('URL: ' + notification.url + ' . Title: ' + notification.title + '. Changed fields: ' + notification.changes);
        console.log(notification);
    });
