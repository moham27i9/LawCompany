// public/firebase-messaging-sw.js
importScripts('https://www.gstatic.com/firebasejs/9.6.1/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/9.6.1/firebase-messaging-compat.js');

const firebaseConfig = {
  apiKey: "AIzaSyDA8w2eKNM_7NHTxKEPonqXhdjRDl5YYUY",
  authDomain: "lawcompanyapp.firebaseapp.com",
  projectId: "lawcompanyapp",
  storageBucket: "lawcompanyapp.firebasestorage.app",
  messagingSenderId: "34322017082",
  appId: "1:34322017082:web:fb63ba4cb3be44b8397e03",
  measurementId: "G-17RTTL1LJJ"
};

firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();

messaging.onBackgroundMessage((payload) => {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  const title = payload.notification.title || 'New Notification';
  const options = {
    body: payload.notification.body || '',
    icon: '/icon.png'
  };
  self.registration.showNotification(title, options);
});
