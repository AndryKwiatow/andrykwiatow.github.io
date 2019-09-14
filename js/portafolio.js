  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyDIJBsSG68UOaO6MHH_pZNaEddzHELdarc",
    authDomain: "portfolio-8a483.firebaseapp.com",
    databaseURL: "https://portfolio-8a483.firebaseio.com",
    projectId: "portfolio-8a483",
    storageBucket: "portfolio-8a483.appspot.com",
    messagingSenderId: "1070035583629",
    appId: "1:1070035583629:web:2171a6f653789e2f2d58c4"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  
  //var database = firebase.database();
  var date = new Date();
  var dd = String(date.getDate()).padStart(2, '0');
  var mm = String(date.getMonth() + 1).padStart(2, '0'); 
  var yyyy = date.getFullYear();
  
  var today = mm + '/' + dd + '/' + yyyy;

  var counter  = date.getTime();

  $('.btnLike').on('click', function(){
    // console.log(divIcon);
    var divRow = $(this).parent();
    // console.log(divRow);
    var divCol = divRow.parent();
    // console.log(divCol);
    var divA = divCol.children()[0];

    var hElement = $(divA).children();
    var aElement = hElement.children();

    var project = aElement.text();
    
    counter += 1;
    var query = {
        like: true,
        dateModified: today,
        projectName: project
    }

    var db = firebase.database().ref("likes/" + counter);
    db.set(query);
    
    var dbStore = firebase.firestore();
    var likesRef = dbStore.collection('likes');
    var querySelect = likesRef.where('projectName', '==', project);

    $(this).innerHTML = querySelect.length();
  });
