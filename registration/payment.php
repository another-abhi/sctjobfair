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
        session_start();
        if(isset($_SESSION["login"]) ){
            if( $_SESSION["login"] != true ){
              header("Location: index.php");
              exit();
            }
        }
        else{
            header("Location: index.php");
            exit();
        }
        $servername = "localhost";
        $username = "ncscnlst_jobfair";
        $password = "Adersh!23";
        $dbname = "ncscnlst_jobfair18";
        $dbConn = mysqli_connect($servername, $username, $password, $dbname);
        if( !$dbConn ){
          echo "Connection failed : " . mysqli_connect_error();
        }
        
        $pid = isset($_SESSION["pid"]) ? $_SESSION["pid"] : "";
        if( $pid == "" ){
            echo "error : no pid";
        }

        $email = "";
        $cost = 0;    
        if( $_SERVER["REQUEST_METHOD"] == "POST" ){
            $exist = isset($_SESSION["exist"])? $_SESSION["exist"]: "";
            if( isset($_SESSION["cost"]) && isset($_POST["payment"]) ){
                $cost = $_SESSION["cost"];
                unset($_SESSION["cost"]);
                unset($_SESSION["exist"]);
                unset($_SESSION["pid"]);
                $companyCount = 0;
                if( $exist == true ){
                    $sqlQuery = "delete from participation where pid=".$pid.";";
                    if(!mysqli_query($dbConn, $sqlQuery)){
                        echo "ERROR  : ".mysqli_error($dbConn)."<br>";
                        exit();
                    }
                }
                if(isset($_SESSION["company1"])){
                    $sqlQuery = "insert into participation values(".$pid.", \"".$_SESSION["company1"]."\" );";
                    unset($_SESSION["company1"]);
                    $companyCount++;
                    if(!mysqli_query($dbConn, $sqlQuery)){
                        echo "ERROR : insert company 1 : ".mysqli_error($dbConn)."<br>";
                        exit();
                    }
                }
                if( isset($_SESSION["company2"]) ){
                    echo 'company2 : '.$_SESSION["company2"].'<br>';
                    $sqlQuery = "insert into participation values(".$pid.", \"".$_SESSION["company2"]."\" );";
                    unset($_SESSION["company2"]);
                    $companyCount++;
                    if(!mysqli_query($dbConn, $sqlQuery)){
                        echo "ERROR : insert company 2 : ".mysqli_error($dbConn)."<br>";
                        exit();
                    }
                }
                if(isset($_SESSION["company3"])){
                    $sqlQuery = "insert into participation values(".$pid.", \"".$_SESSION["company3"]."\" );";
                    unset($_SESSION["company3"]);
                    $companyCount++;
                    if(!mysqli_query($dbConn, $sqlQuery)){
                        echo "ERROR : insert company 3 : ".mysqli_error($dbConn)."<br>";
                        exit();
                    }
                }
                if(isset($_SESSION["company4"])){
                    $sqlQuery = "insert into participation values(".$pid.", \"".$_SESSION["company4"]."\" );";
                    unset($_SESSION["company4"]);
                    $companyCount++;
                    if(!mysqli_query($dbConn, $sqlQuery)){
                        echo "ERROR : insert company 4 : ".mysqli_error($dbConn)."<br>";
                        exit();
                    }
                }
                if(isset($_SESSION["company5"])){
                    $sqlQuery = "insert into participation values(".$pid.", \"".$_SESSION["company5"]."\" );";
                    unset($_SESSION["company5"]);
                    $companyCount++;
                    if(!mysqli_query($dbConn, $sqlQuery)){
                        echo "ERROR : insert company 5 : ".mysqli_error($dbConn)."<br>";
                        exit();
                    }
                }
                $paymentStatus = $_POST["payment"];
                $sqlQuery = "update participant set paymentstatus=\"".$paymentStatus."\", companycount=".$companyCount." where pid=".$pid." ;";
                if(!mysqli_query($dbConn, $sqlQuery)){
                    echo "ERROR : update payment status and company count : ".mysqli_error($dbConn)."<br>";
                    exit();
                }
                $_SESSION["success"] = "SUCCESS";
                header("Location: email.php");
                exit();
            }
            else if( isset($_POST["company1"]) ){
                $company1 = $_POST["company1"];
                $company2 = $_POST["company2"];
                $company3 = $_POST["company3"];
                $company4 = $_POST["company4"];
                $company5 = $_POST["company5"];
                
                $companyCount = 0;
                if($company1 != "none"){
                    $companyCount++;
                    $_SESSION["company1"] = $company1;
                }
                if($company2 != "none"){
                    $companyCount++;
                    $_SESSION["company2"] = $company2;
                }
                if($company3 != "none"){
                    $companyCount++;
                    $_SESSION["company3"] = $company3;
                }
                if($company4 != "none"){
                    $companyCount++;
                    $_SESSION["company4"] = $company4;
                }
                if($company5 != "none"){
                    $companyCount++;
                    $_SESSION["company5"] = $company5;
                }
                $prevCompnayCount = 0;
                if( $exist != "" ){
                    $sqlQuery = "select paymentstatus, companycount from participant where pid=".$pid.";";
                    $result = mysqli_query($dbConn, $sqlQuery);
                    $row = mysqli_fetch_assoc($result);
                    $paymentStatus = $row["paymentstatus"];
                    if($paymentStatus != "notpaid")
                        $prevCompnayCount = $row["companycount"];
                }
                $cost = getCost($companyCount) - getCost($prevCompnayCount);
                $_SESSION["cost"] = $cost;
            }
            else{
                echo "ERROR";
            }

        }
        else{
            header("Location: email.php");
            exit();
        }
        //echo $pid;

        function getCost($count){
            if($count == 1)
                return 200;
            if($count == 2)
                return 400;
            if($count == 3)
                return 500;
            if($count == 4)
                return 700;
            if($count == 5)
                return 800;
            return 0;
        }
      ?>

      <script>

      </script>

        <form action="payment.php" method="post"">

        <h1>Job Fair Registration</h1> 
        
        <span id="instructions" name="instructions">Payment : Rs <?php echo $cost ?> </span><br><br>
        <span id="pid" name="pid">PID : <?php echo $pid ?> </span><br><br>
        <fieldset>
            <input type="radio" id="payment" name="payment" value="paid" checked> Paid<br>
            <input type="radio" id="payment" name="payment" value="notpaid"> Not Paid<br>
        </fieldset>
        <button type="submit">Proceed</button>
    </body>
</html>