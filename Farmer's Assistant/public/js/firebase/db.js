  // Initialize Firebase
var config = {
    apiKey: "AIzaSyB89HPRahzNxTRIga-He2j4uZ2bpVORdJ0",
    authDomain: "group-25-c7aec.firebaseapp.com",
    databaseURL: "https://group-25-c7aec.firebaseio.com",
    projectId: "group-25-c7aec",
    storageBucket: "group-25-c7aec.appspot.com",
    messagingSenderId: "920958093542"
  };
firebase.initializeApp(config);
const db=firebase.firestore();
console.log("hello");
db.settings({timestampsInSnapshots:true});

//include these in the html file
{/* <script src="https://www.gstatic.com/firebasejs/5.5.5/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.5/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.5/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.5/firebase-database.js"></script> */}
