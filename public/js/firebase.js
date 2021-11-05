// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyC_uSpCoQDfgAqkb_qlA5wYDeie-qdvmu8",
    authDomain: "xoomnotifications.firebaseapp.com",
    databaseURL: "https://xoomnotifications.firebaseio.com",
    projectId: "xoomnotifications",
    storageBucket: "xoomnotifications.appspot.com",
    messagingSenderId: "605878760943",
    appId: "1:605878760943:web:c1a5d98e843da50ecbf21a",
    measurementId: "G-LKPHZMFCNT"
  };

  firebase.initializeApp(firebaseConfig);
  
  const messaging = firebase.messaging();
        messaging
            .requestPermission()
            .then(function() {
                  console.log("Notification permission granted.");
                  return message.getToken()
            }).then(function(token){
                console.log(token)
            }).
            
            catch(function (err) {

                console.log("Unable to get permission to notify.", err);
    });

messaging.onMessage((payload) => {

    console.log(payload);
})