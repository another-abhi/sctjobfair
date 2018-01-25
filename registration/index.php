<html>
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Job Fair 2018 Registration</title>
        <link rel="stylesheet" href="css/normalize.css">
        <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/main.css">
   </head>
   <script>
   	function checkEmail(){
   		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   		var email = document.getElementById('email').value;
   		if(reg.test(email) == false){
   			document.getElementById('emailErr').innerHTML = "* Invalid email address"
   			return false;
   		}
    	var atpos = email.indexOf("@");
    	var dotpos = email.lastIndexOf(".");
    	if( atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length ){
        	document.getElementById('emailErr').innerHTML = "* Invalid email address";
        	return false;
    	}
    	return true;
   	}

   	function validateForm(){
   		return checkEmail();
   	}
   </script>
   <body>
   	<?php
   		session_unset();
   		session_destroy();
   		session_start();
   	?>
   	<form action="detail_entry.php" method="post" onsubmit="return validateForm()">

   		<h1>Job Fair Registration</h1> 
   		<span id="instructions" name="instructions">Please enter your correct email address</span><br><br>
   		<label for="email">Email : </label>
   		<span id="emailErr" class="error">* </span>
   		<input type="text" id="email" name="email" value="" onchange="checkEmail()">

   		<button type="submit">Proceed</button>
   	</form>
  </body>
</html>