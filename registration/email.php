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
      if( document.getElementById("pid").value == "" ){
   		 return checkEmail();
      }
      return true;
   	}
   </script>
   <body>
   	<?php
      session_start();

      if( isset($_SESSION["login"]) ){
        if( $_SESSION["login"] != true ){
          header("Location: index.php");
          exit();
        }
      }
      else{
        header("Location: index.php");
        exit();
      }

   		
      if( isset( $_SESSION["email"] ) )
        unset($_SESSION["email"]);
      
      if( isset( $_SESSION["pid"] ) )
        unset($_SESSION["pid"]);
      
      if( isset( $_SESSION["exist"] ) )
        unset($_SESSION["exist"]);
      
      if( isset( $_SESSION["company1"]) )
        unset($_SESSION["company1"]);
      
      if( isset( $_SESSION["company2"]) )
        unset($_SESSION["company2"]);
      
      if( isset( $_SESSION["company3"]) )
        unset($_SESSION["company3"]);
      
      if( isset( $_SESSION["company4"]) )
        unset($_SESSION["company4"]);
      
      if( isset( $_SESSION["company5"]) )
        unset($_SESSION["company5"]);

      $message = "";
      if( isset($_SESSION["success"] ) ){
        $message = $_SESSION["success"];
        unset($_SESSION["success"]);
      }

   ?>
   	<form action="detail_entry.php" method="post" onsubmit="return validateForm()">

   		<h1>Job Fair Registration</h1> 
      <a href="index.php">Logout</a><br><br>
      <span id="message" name="message"> <?php echo $message ?> </span><br>
   		<span id="instructions" name="instructions">Please enter your correct email address</span><br><br>
   		<label for="email">Email : </label>
   		<span id="emailErr" class="error">* </span>
   		<input type="text" id="email" name="email" value="" onchange="checkEmail()">

      <label for="pid">PID : (either Email or PID)</label>
      <span id="pidErr" class="error">* </span>
      <input type="number" id="pid" name="pid" value="">

   		<button type="submit">Proceed</button>
   	</form>
  </body>
</html>