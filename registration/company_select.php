<html>
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Job Fair 2018 Registration</title>
        <link rel="stylesheet" href="css/normalize.css">
        <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/main.css">
        
    </head>

      <?php
        session_start();
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
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
        
        $err = 0;
        $exist = false;
        $companies = array();
        $fullName = $email = $age = $dob = $address = $contact = $gender = "";
        $percentage10 = $percentage12 = $ugCourse = $ugCollege = $ugCgpa = $ugYop = $backlogs = $fresher = "";
        $experience = $expCompany = $pgCourse = $pgCollege = $pgCgpa = $pgYop = "";
        $ugBranch = "";
        $message = "";
        $companyCount = 0;
        $paymentStatus = "not_paid";
        $paymentmethod = "spot";
        $regmethod = "spot";
        $regTime = "";
        $college = "";

        $pid = isset($_SESSION["pid"]) ? $_SESSION["pid"] : "";
        $email = isset($_SESSION["email"]) ? $_SESSION["email"] : "";
        unset($_SESSION["email"]);
        //echo "email : " . $email. "<br>"; 
        //echo "pid : ". $pid;
        if($email == ""){
            header("Location: email.php");
            exit();
        }
        if( $pid != "" ){
            $exist = true;
            $message = "Existing Record";
            //echo "existing record <br>";
        }
        $_SESSION["exist"] = $exist;
        $insert = true;
        if( $_SERVER["REQUEST_METHOD"] == "POST"){
          $change = isset($_POST["change"])? $_POST["change"] : "";
          //echo $change.'<br>';
          //echo $exist.'<br>';
          if($exist == true && $change=="no" )
            $insert = false;
          if($exist == true && $change == "yes" ){
            //echo 'deleting <br>';
            $sqlQuery = "select * from participant where pid=".$pid." ;";
            $result = mysqli_query($dbConn, $sqlQuery);
            $row = mysqli_fetch_assoc($result);
            $regTime = $row["regtime"];
            $paymentstatus = $row["paymentstatus"];
            $companyCount = $row["companycount"];
            $paymentmethod = $row["paymentmethod"];
            $regmethod = $row["regmethod"];
            $sqlQuery = "delete from participant where pid=".$pid."; ";
            if(!mysqli_query($dbConn, $sqlQuery))
             echo 'error deleting exting record<br>';
          }
          if( $insert ){
            //echo 'INSERTING <br>';
              $fullName = isset($_POST["full_name"]) ? test_input($_POST["full_name"]) : "";
              //$lastName = isset($_POST["last_name"]) ? test_input($_POST["last_name"]) : "";
              $age = isset($_POST["age"]) ? test_input($_POST["age"]) : "";
              $dob = isset($_POST["dob"]) ? test_input($_POST["dob"]) : "";
              $address = isset($_POST["address"]) ? test_input($_POST["address"]) : "";
              $contact = isset($_POST["contact"]) ? test_input($_POST["contact"]) : "";
              $gender = isset($_POST["gender"]) ? test_input($_POST["gender"]) : "";
              $percentage10 = isset($_POST["percentage10"]) ? test_input($_POST["percentage10"]) : "";
              $percentage12 = isset($_POST["percentage12"]) ? test_input($_POST["percentage12"]) : "";
              $ugCourse = isset($_POST["ugCourse"]) ? test_input($_POST["ugCourse"]) : "";
              $ugBranch = isset($_POST["ugBranch"]) ? strtoupper(test_input($_POST["ugBranch"])) : "";
              $ugCollege = isset($_POST["ugCollege"]) ? strtoupper(test_input($_POST["ugCollege"])) : "";
              $ugCgpa = test_input($_POST["ugCgpa"]);
              $ugYop = test_input($_POST["ugYop"]);
              $backlogs = test_input($_POST["backlogs"]);
              $fresher = test_input($_POST["fresher"]);
              if($fresher == "n"){
                $experience = test_input($_POST["experience"]);
                $expCompany = test_input($_POST["expCompany"]);
              }
              $pgCourse = test_input($_POST["pgCourse"]);
              if($pgCourse != "none"){
                $pgCollege = test_input($_POST["pgCollege"]);
                $pgCgpa = test_input($_POST["pgCgpa"]);
                $pgYop = test_input($_POST["pgYop"]);
              }
              if($fresher == "y" && $experience == "" && $expCompany == ""){
                $experience = 0;
                $expCompany = "nil";
              }
              else if($fresher != "n" && ($experience == "0" || $expCompany == "") ){
                $err = $err|1;
              }
              if($pgCourse == "none" && $pgCollege == "" && $pgCgpa == "" && $pgYop == ""){
                $pgCollege = "nil";
                $pgCgpa = 0;
                $pgYop = "nil";
              }
              else if($pgCourse != "none" && ($pgCollege == "" || $pgCgpa == "" || $pgYop == "") ){
                $err = $err|2;
              }


              if($exist == true ){
                $sqlQuery = "insert into participant(pid,regtime,paymentstatus,paymentmethod,regmethod,companycount,fullname,address,email,age,dob,contact,gender,percentage10,percentage12,ugcourse,ugcollege,ugbranch,ugcgpa,backlogs,ugyop,fresher,experience,expcompany,pgcourse,pgcollege,pgcgpa,pgyop) values (";
                $sqlQuery .= $pid.", \"".$regTime."\", ";
              }
              else  
                $sqlQuery = "insert into participant(paymentstatus,paymentmethod,regmethod,companycount,fullname,address,email,age,dob,contact,gender,percentage10,percentage12,ugcourse,ugcollege,ugbranch,ugcgpa,backlogs,ugyop,fresher,experience,expcompany,pgcourse,pgcollege,pgcgpa,pgyop) values (";
              
              $sqlQuery .= "\"".$paymentstatus."\", \"".$paymentmethod."\", \"".$regmethod."\", ".$companyCount.", ";
              $sqlQuery .= "\"".$fullName."\", \"".$address."\", \"".$email."\", ";
              $sqlQuery .= $age.", \"".$dob."\", \"".$contact."\", \"".$gender."\", ".$percentage10.", ".$percentage12.", ";
              $sqlQuery .= "\"".$ugCourse."\", \"".$ugCollege."\", \"".$ugBranch."\", ".$ugCgpa.", ".$backlogs.", \"".$ugYop."\", \"".$fresher."\", ".$experience.", ";
              $sqlQuery .= "\"".$expCompany."\", \"".$pgCourse."\", \"".$pgCollege."\", ".$pgCgpa.", \"".$pgYop."\" );";
              if( $err == 0 ){
                if(mysqli_query($dbConn, $sqlQuery)){
                    //echo "New record created";
                    if($exist)
                      $message = "Record Modified";
                    else
                      $message = "New record created"; 
                }
                else{
                    echo "ERROR " . mysqli_error($dbConn); 
                }
              }
              else{
                echo "ERROR ". $err;
              }
            }
        } 
        $sqlQuery = "select * from participant where pid=".$pid." ;";
        if( !($result = mysqli_query($dbConn, $sqlQuery) ) ){
          echo 'select query fail..<br>';
        }
        if(mysqli_num_rows($result) > 0){
          $row = mysqli_fetch_assoc($result);
          $pid = $row["pid"];
          $paymentStatus = $row["paymentstatus"];
          $college = $row["ugcollege"];
          $sqlQuery = "select cid from participation where pid=".$pid.";";
            $result = mysqli_query($dbConn, $sqlQuery);
            $companyCount = mysqli_num_rows($result);
            
            //echo 'company count : '.$companyCount.'<br>';
          $_SESSION["pid"] = $pid;
        }
        $_SESSION["compnayCount"] = $companyCount;
        if($companyCount != 0){
            $sqlQuery = "select participation.cid, company.cname from participation, company where participation.pid=\"".$pid."\" and participation.cid=company.cid;";
            $result = mysqli_query($dbConn, $sqlQuery);
            $i = 0;
            while($row = mysqli_fetch_assoc($result) ) {
                $companies[$i] = array($row["cid"], $row["cname"]);
                $i++;
            }
        }  


        function test_input($data){
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }

      ?>

        <script>
            function checkCompanies(){
              var companyIp = document.getElementById('company1');
              var company1 = companyIp.options[companyIp.selectedIndex].value;
              companyIp = document.getElementById('company2');
              var company2 = companyIp.options[companyIp.selectedIndex].value;
              companyIp = document.getElementById('company3');
              var company3 = companyIp.options[companyIp.selectedIndex].value;
              companyIp = document.getElementById('company4');
              var company4 = companyIp.options[companyIp.selectedIndex].value;
              companyIp = document.getElementById('company5');
              var company5 = companyIp.options[companyIp.selectedIndex].value;
              var err = 0;
              var count = 0;
              var companyList = ["", "", "", "", ""];
              if(company1 != "none"){
                companyList[count] = company1;
                count++;
              }
              if(company2 != "none"){
                companyList[count] = company2;
                count++;
              }
              if(company3 != "none"){
                companyList[count] = company3;
                count++;
              }
              if(company4 != "none"){
                companyList[count] = company4;
                count++;
              }
              if(company5 != "none"){
                companyList[count] = company5;
                count++;
              }
              if( companyList.indexOf("carestack") != -1 ){
                if( companyList.indexOf("incaetek") != -1 || companyList.indexOf("seqato") != -1 ){
                  document.getElementById("msgErr").innerHTML = "Carestack and (Incaetek or Seqato) is not possible";
                  err += 1;
                }
              }
              if( company1 != "none" && (company1 == company2 || company1 == company3 || company1 == company4 || company1 == company5) ){
                document.getElementById('company1Err').innerHTML = "* Duplicate selection detected";
                err += 1;
              }
              else{
                document.getElementById('company1Err').innerHTML = "* ";
              }
              if( company2 != "none" && (company2 == company3 || company2 == company4 || company2 == company5) ){
                document.getElementById('company2Err').innerHTML = "* Duplicate selection detected";
                err += 1;
              }
              else{
                document.getElementById('company2Err').innerHTML = "";
              }
              if( company3 != "none" && (company3 == company4 || company3 == company5) ){
                document.getElementById('company3Err').innerHTML = "* Duplicate selection detected";
                err += 1;
              }
              else{
                document.getElementById('company3Err').innerHTML = "";
              }
              if( company4 != "none" && (company4 == company5) ){
                document.getElementById('company4Err').innerHTML = "* Duplicate selection detected";
                err += 1;
              }
              else{
                document.getElementById('company4Err').innerHTML = "";
              }
              if(err == 0){
                var company1Ip = document.getElementById('company1');
                var company1 = company1Ip.options[company1Ip.selectedIndex].value;
                if( company1 == 'none' ){
                    document.getElementById('company1Err').innerHTML = "* Atleast one company is required";
                    err += 1;
                }
              }
              if(err == 0 ){
                return true;
              }
              else{
                return false;
              }
            }

        </script>

    <body>
      <form action="payment.php" method="post" onsubmit="return checkCompanies()">
       <h1>Job Fair Registration</h1>
       <span id="msg"> <?php echo $message ?> </span><br>
       <span id="emailMsg"> Email : <?php echo $email ?> </span><br>
       <span id="pid" name="pid">PID : <?php echo $pid ?> </span><br>
       <span id="paymentStatus" name="paymentStatus">Payment Status : <?php echo $paymentStatus ?> </span><br>
       <span id="college" name="college">College : <?php echo $college ?><br><br>
       <h2>Company Selection</h2>

       <span class="error" id="msgErr"> </span> <br>
       <fieldset>

          <label for="company1">Company 1: </label>
          <span class="error" id="company1Err">* </span> <br>
          <select name="company1" id="company1" >
          <?php
            if($companyCount>0)
               echo '<option value="' . $companies[0][0] . '" selected>' . $companies[0][1] . '</option>'; 
            echo '<option value="none"> None </option>';
            $sql="SELECT * FROM company";
            $result = mysqli_query($dbConn, $sql);
            if(mysqli_num_rows($result) > 0 ){
              while($row = mysqli_fetch_assoc($result)){
                echo '<option value="' . $row["cid"] . '">' . $row["cname"] . '</option>';
              }
            }
          ?>
          </select>

          <div id="company2Input">
              <label for="company2">Company 2: </label>
              <span class="error" id="company2Err"></span> <br>
              <select name="company2" id="company2">
              <?php
                if($companyCount>1)
                    echo '<option value="' . $companies[1][0] . '" selected>' . $companies[1][1] . '</option>'; 
                echo '<option value="none"> None </option>';
                $sql="SELECT * FROM company";
                $result = mysqli_query($dbConn, $sql);
                if(mysqli_num_rows($result) > 0 ){
                  while($row = mysqli_fetch_assoc($result)){
                    echo '<option value="' . $row["cid"] . '">' . $row["cname"] . '</option>';
                  }
                }
              ?>
              </select>
          </div>

          <div id="company3Input">
              <label for="company3">Company 3: </label>
              <span class="error" id="company3Err"></span> <br>
              <select name="company3" id="company3">
              <?php
                if($companyCount>2)
                    echo '<option value="' . $companies[2][0] . '" selected>' . $companies[2][1] . '</option>'; 
                echo '<option value="none"> None </option>';
                $sql="SELECT * FROM company";
                $result = mysqli_query($dbConn, $sql);
                if(mysqli_num_rows($result) > 0 ){
                  while($row = mysqli_fetch_assoc($result)){
                    echo '<option value="' . $row["cid"] . '">' . $row["cname"] . '</option>';
                  }
                }
              ?>
              </select>
           </div>

          <div id="company4Input">
              <label for="company4">Company 4: </label>
              <span class="error" id="company4Err"></span> <br>
              <select name="company4" id="company4">
              <?php
                if($companyCount>3)
                    echo '<option value="' . $companies[3][0] . '" selected>' . $companies[3][1] . '</option>'; 
                echo '<option value="none"> None </option>';
                $sql="SELECT * FROM company";
                $result = mysqli_query($dbConn, $sql);
                if(mysqli_num_rows($result) > 0 ){
                  while($row = mysqli_fetch_assoc($result)){
                    echo '<option value="' . $row["cid"] . '">' . $row["cname"] . '</option>';
                  }
                }
              ?>
              </select>
          </div>
          
          <div id="company5Input">
              <input type="text" id="email" name="email" value="<?php echo $email ?>" readonly style="display:none;">
              <input type="pid" id="pid" name="pid" value="<?php echo $pid ?>" readonly style="display:none;">
              <label for="company5">Company 5: </label>
              <span class="error" id="company5Err"></span> <br>
              <select name="company5" id="company5" >
              <?php
                if($companyCount>4)
                    echo '<option value="' . $companies[4][0] . '" selected>' . $companies[4][1] . '</option>'; 
                echo '<option value="none"> None </option>';
                $sql="SELECT * FROM company";
                $result = mysqli_query($dbConn, $sql);
                if(mysqli_num_rows($result) > 0 ){
                  while($row = mysqli_fetch_assoc($result)){
                    echo '<option value="' . $row["cid"] . '">' . $row["cname"] . '</option>';
                  }
                }
              ?>
              </select>
          </div>
          
        </fieldset>

        <button type="submit">Proceed</button>
    </body>
</html>