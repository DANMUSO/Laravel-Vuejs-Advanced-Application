/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js');
   
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({
    apiKey: "AIzaSyCe_70zn75rKJH2wdRQzH4Hps0pV-nEkvk",
    authDomain: "xoom-admindashboard.firebaseapp.com",
    projectId: "xoom-admindashboard",
    storageBucket: "xoom-admindashboard.appspot.com",
    messagingSenderId: "626586143063",
    appId: "1:626586143063:web:b3318b7871579de43f5612",
    measurementId: "G-B83GH7XBZZ"
    });
  
/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload,
    );
    /* Customize notification here */
    const notificationTitle = "Background Message Title";
    const notificationOptions = {
        body: "Background Message body.",
        icon: "/itwonders-web-logo.png",
    };
  
    return self.registration.showNotification(
        notificationTitle,
        notificationOptions,
    );
});