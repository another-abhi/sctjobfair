<html>
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Job Fair 2018 Registration</title>
        <link rel="stylesheet" href="css/normalize.css">
        <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/main.css">
   </head>

   <body>
   	<?php
   		session_start();
      $message = "";
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
      
      if( isset($_SESSION["login"]) )
        unset($_SESSION["login"]);
      
      $storedPassword = 'SctJobFair@18';

      $_SESSION["login"] = false;
      if( $_SERVER["REQUEST_METHOD"] == "POST"){
        if( isset($_POST["password"]) ){
          $password = $_POST["password"];
          if($password == $storedPassword){
            $_SESSION["login"] = true;
            header("Location: email.php");
            exit();
          }
          else{
            $message = "Wrong Password";
          }
        }
      }

   ?>
   	<form action="index.php" method="post">

   		<h1>Job Fair Registration</h1> 
      <span id="message" name="message"> <?php echo $message ?> </span><br>
   		<label for="email">Password : </label>
   		<span id="emailErr" class="error">* </span>
   		<input type="password" id="password" name="password" value="">

   		<button type="submit">Proceed</button>
   	</form>
  </body>
</html>