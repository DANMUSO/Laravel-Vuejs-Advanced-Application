<!DOCTYPE html>
<html lang="en">
<head>
<title>FCM</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-analytics.js"></script>
<script  src="https://code.jquery.com/jquery-2.2.4.min.js" ></script>

<!-- Add additional services that you want to use -->
<script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-messaging.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-functions.js"></script>

<!-- firebase integration end -->

<!-- Comment out (or don't include) services that you don't want to use -->
<!-- <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-storage.js"></script> -->

<script src="https://www.gstatic.com/firebasejs/5.5.9/firebase.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.8.0/firebase-analytics.js"></script>
</head>
<body>


</body>
<script type="text/javascript">
        // Your web app's Firebase configuration
        var firebaseConfig = {
            apiKey: "AIzaSyCe_70zn75rKJH2wdRQzH4Hps0pV-nEkvk",
            authDomain: "xoom-admindashboard.firebaseapp.com",
            projectId: "xoom-admindashboard",
            storageBucket: "xoom-admindashboard.appspot.com",
            messagingSenderId: "626586143063",
            appId: "1:626586143063:web:b3318b7871579de43f5612",
            measurementId: "G-B83GH7XBZZ"
        };
      // Initialize Firebase
      firebase.initializeApp(firebaseConfig);
      //firebase.analytics();
      const messaging = firebase.messaging();
        messaging
      .requestPermission()
      .then(function () {
      //MsgElem.innerHTML = "Notification permission granted." 
        console.log("Notification permission granted.");

          // get the token in the form of promise
        return messaging.getToken()
      })
      .then(function(token) {
      // print the token on the HTML page 
      //alert(token);    
        console.log(token);
        $.ajax({
          url: '{{ route("token") }}',
          type: "POST",
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          
          data:{ token: token},
          dataType: "text",
          //success: function(resultData) { alert("Save Complete");}
        });
        
      })
      .catch(function (err) {
        console.log("Unable to get permission to notify.", err);
      });

      messaging.onMessage(function(payload) {
          console.log(payload);
          var notify;
          notify = new Notification(payload.notification.title,{
              body: payload.notification.body,
              icon: payload.notification.icon,
              tag: "Xoom_Gas"
          });
          console.log(payload.notification);
      });

          //firebase.initializeApp(config);
      var database = firebase.database().ref().child("/users/");
        
      database.on('value', function(snapshot) {
          renderUI(snapshot.val());
      });

      // On child added to db
      database.on('child_added', function(data) {
        console.log("Comming");
          if(Notification.permission!=='default'){
              var notify;
              
              notify= new Notification('Xoomgas - '+data.val().username,{
                  'body': data.val().message,
                  'icon': 'bell.png',
                  'tag': data.getKey()
              });
              notify.onclick = function(){
                  alert(this.tag);
              }
          }else{
              alert('Please allow the notification first');
          }
      });

      self.addEventListener('notificationclick', function(event) {       
          event.notification.close();
      });

      
  </script>
</html>
