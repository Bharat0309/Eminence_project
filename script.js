$(function() {

 $("login_btn).click(function() {
  $("#login_btn").hide();
   $("#login_btn").html("<img src='loader.gif'>");
    var email = $("#email").val(); 
    var password $("#password").val(); 
    $.post(".php", { email: email, password: password})
     .done (function( data ){ 
     	 if(data == "success") {
    	 window.location = "main.php";
     } 

   	else {
   		 $("#login_btn").text("Invalid Username or Password! Try again. "); 
      	 $("login_btn").show();
   	 I }
   	  });
   	   });