$(function(){
  $(".login").hide();
  
    $("button.log").on("click", function(){
       $(".login").show();
       $(".signUp").hide();
    });
  
    $("button.reg").on("click", function(){
       $(".login").hide();
       $(".signUp").show();
    });
});


// function validateForm() {
//     var w = document.forms["regform"]["fname"].value;
//     var x = document.forms["regform"]["lname"].value;
//     var y = document.forms["regform"]["password"].value;
//     var z = document.forms["regform"]["cpassword"].value;

//     if (w.includes('@','#'$',','_','-','=','+')) {
//       alert('Name cannot include special characters');
//       return false;
//     }

//     if (w === x) {
//       alert('First and Last name must not be the same');
//       return false;
//     }

//     if (y === w || y === x) {
//       alert('Password must not include your name');
//       return false;
//     }

//     if (z != y) {
//       alert('Passwords do not match');
//       return false;
//     }

// }