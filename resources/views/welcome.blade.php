<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body>
<h1>Firebase Notifications</h1>
<button id="request-permission">Enable Notifications</button>


<script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-messaging-compat.js"></script>

<script>
    // Step 2: Firebase Configuration
    const firebaseConfig = {
        apiKey: "AIzaSyCIoj6-ApCxvtj00ymI-ZSxQhtVoZURp2I",
        authDomain: "chat-app-df6fc.firebaseapp.com",
        projectId: "chat-app-df6fc",
        storageBucket: "chat-app-df6fc.firebasestorage.app",
        messagingSenderId: "383250378447",
        appId: "1:383250378447:web:8f6e1cc1c14c30d322d1ba"
    };

    // Initialize Firebase
    const app = firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();

    // Step 3: Request Permission
    document.getElementById('request-permission').addEventListener('click', () => {
        Notification.requestPermission().then(permission => {
            if (permission === 'granted') {
                console.log('Notification permission granted.');

                // Get FCM token
                messaging.getToken({vapidKey: 'BJWjFxp9sZ10imMmwf8t3pwZnvtlI_YhupdzTOCsL1IdZGPaFBAQShoK2Y5GjybBz9j4F4vd0X56XLIQnnwANe4'})
                    .then(currentToken => {
                        if (currentToken) {
                            console.log('FCM Token:', currentToken);
                            // Send this token to your server to enable notifications
                        } else {
                            console.error('No registration token available.');
                        }
                    }).catch(err => {
                    console.error('Error while retrieving token:', err);
                });
            } else {
                console.error('Unable to get permission for notifications.');
            }
        });
    });

    // Step 4: Handle Background Messages
    messaging.onMessage(payload => {
        console.log('Message received. ', payload);
        // Customize notification here
        const notificationTitle = payload.notification.title;
        const notificationOptions = {
            body: payload.notification.body,
            icon: payload.notification.image
        };

        new Notification(notificationTitle, notificationOptions);
    });
</script>
</body>
</html>
