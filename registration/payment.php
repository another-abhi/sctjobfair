<html>
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Job Fair 2018 Registration</title>
        <link rel="stylesheet" href="css/normalize.css">
        <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/main.css">
        <script src="js/main.js"></script>
    </head>
    <body>

      <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $servername = "localhost";
        $username = "root";
        $password = "Kannan@119504";
        $dbname = "jobfair18reg";
        $dbConn = mysqli_connect($servername, $username, $password, $dbname);
        if( !$dbConn ){
          echo "Connection failed : " . mysqli_connect_error();
        }
        session_start();
        $email = "";
        $pid = isset($_SESSION["pid"]) ? $_SESSION["pid"] : "";

        unset($_SESSION["pid"]);
        if( $_SERVER["REQUEST_METHOD"] == "POST" ){
        }
        else{
            header("Location: http://localhost/~akshos/sctjobfair/registration/index.php");
            exit();
        }

        echo $pid;
      ?>


    </body>
</html>