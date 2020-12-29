// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyCixF05x85kh6pkORyLCA8S2cVHAp5xFhQ",
    authDomain: "notify-1f812.firebaseapp.com",
    databaseURL: "https://notify-1f812.firebaseio.com",
    projectId: "notify-1f812",
    storageBucket: "notify-1f812.appspot.com",
    messagingSenderId: "902720459484",
    appId: "1:902720459484:web:897b722d3b1e9143f9da19",
    measurementId: "G-RVQZG7D065"
};

firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();

messaging
    .requestPermission()
    .then(() => {

        console.log('notify đây');
        return messaging.getToken();
    })
    .then(token => {
        console.log(token);
    });

messaging.onMessage((payload) => {
    console.log(payload);
})
