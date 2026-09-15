importScripts('https://www.gstatic.com/firebasejs/9.22.0/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/9.22.0/firebase-messaging-compat.js');

firebase.initializeApp({
  apiKey: "AIzaSyCVJclfpEp9Jo9879C3RfZKiEdBUibwrxI",
  authDomain: "ahmad-662ee.firebaseapp.com",
  projectId: "ahmad-662ee",
  storageBucket: "ahmad-662ee.firebasestorage.app",
  messagingSenderId: "740891153734",
  appId: "1:740891153734:web:d4927b652d05f499618147",
  measurementId: "G-S0ZD5K16NM"
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage((payload) => {
  const notificationTitle = payload.notification.title || 'المركز الطبي';
  const notificationOptions = {
    body: payload.notification.body || 'تم تحديث حالة حجزك!',
    icon: 'https://cdn-icons-png.flaticon.com/512/190/190411.png'
  };

  self.registration.showNotification(notificationTitle, notificationOptions);
});
