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
        $servername = "localhost";
        $username = "root";
        $password = "Kannan@119504";
        $dbname = "jobfair18reg";
        $dbConn = mysqli_connect($servername, $username, $password, $dbname);
        if( !$dbConn ){
          echo "Connection failed : " . mysqli_connect_error();
        }
        
        $err = 0;
        $exist = false;
        $companycount = 0;
        $companies = array();
        $companyChange = array("company1Change()", "company2Change()", "company3Change()", "company4Change()", "company5Change()" );
        $companyStatus = array("", "" , "", "", "");
        $compnayReadOnly = array("", "disabled", "disabled", "disabled", "disabled");
        $firstName = $lastName = $email = $age = $dob = $address = $contact = $gender = "";
        $percentage10 = $percentage12 = $ugCourse = $ugCollege = $ugCgpa = $ugYop = $backlogs = $fresher = "";
        $experience = $expCompany = $pgCourse = $pgCollege = $pgCgpa = $pgYop = "";
        $status = "";
        $companyCount = 0;

        $pid = isset($_SESSION["pid"]) ? $_SESSION["pid"] : "";
        $email = isset($_SESSION["email"]) ? $_SESSION["email"] : "";
        unset($_SESSION["email"]);
        echo "email : " . $email. "<br>"; 
        echo "pid : ". $pid;
        if($email == ""){
            header("Location: http://localhost/~akshos/sctjobfair/registration/index.php");
            exit();
        }
        if( $pid != "" ){
            $exist = true;
        }
        if( $_SERVER["REQUEST_METHOD"] == "POST"){
          if( !$exist ){
              $firstName = isset($_POST["first_name"]) ? test_input($_POST["first_name"]) : "";
              $lastName = isset($_POST["last_name"]) ? test_input($_POST["last_name"]) : "";
              $age = isset($_POST["age"]) ? test_input($_POST["age"]) : "";
              $dob = isset($_POST["dob"]) ? test_input($_POST["dob"]) : "";
              $address = isset($_POST["address"]) ? test_input($_POST["address"]) : "";
              $contact = isset($_POST["contact"]) ? test_input($_POST["contact"]) : "";
              $gender = isset($_POST["gender"]) ? test_input($_POST["gender"]) : "";
              $percentage10 = isset($_POST["percentage10"]) ? test_input($_POST["percentage10"]) : "";
              $percentage12 = isset($_POST["percentage12"]) ? test_input($_POST["percentage12"]) : "";
              $ugCourse = isset($_POST["ugCourse"]) ? test_input($_POST["ugCourse"]) : "";
              $ugCollege = isset($_POST["ugCollege"]) ? test_input($_POST["ugCollege"]) : "";
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
              elseif($fresher == "n" && $experience != "0" && $expCompany != ""){
              }
              else{
                $err = $err|1;
              }
              if($pgCourse == "none" && $pgCollege == "" && $pgCgpa == "" && $pgYop == ""){
                $pgCollege = "nil";
                $pgCgpa = 0;
                $pgYop = "nil";
              }
              elseif($pgCourse == "none" && $pgCollege != "" && $pgCgpa != "" && $pgYop != ""){
              }
              else{
                $err = $err|2;
              }

              $status = "pay_pending";

              $sqlQuery = "insert into participant(status,companycount,firstname,lastname,address,email,age,dob,contact,gender,percentage10,percentage12,ugcourseid,ugcollege,ugcgpa,backlogs,ugyop,fresher,experience,expcompany,pgcourseid,pgcollege,pgcgpa,pgyop) values (";
              $sqlQuery .= "\"".$status."\", ".$companyCount.", ";
              $sqlQuery .= "\"".$firstName."\", \"".$lastName."\", \"".$address."\", \"".$email."\", ";
              $sqlQuery .= $age.", \"".$dob."\", \"".$contact."\", \"".$gender."\", ".$percentage10.", ".$percentage12.", ";
              $sqlQuery .= "\"".$ugCourse."\", \"".$ugCollege."\", ".$ugCgpa.", ".$backlogs.", \"".$ugYop."\", \"".$fresher."\", ".$experience.", ";
              $sqlQuery .= "\"".$expCompany."\", \"".$pgCourse."\", \"".$pgCollege."\", ".$pgCgpa.", \"".$pgYop."\" );";
              if( $err == 0 ){
                if(mysqli_query($dbConn, $sqlQuery)){
                    echo "New record created";
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
        $sqlQuery = "select pid, companycount from participant where email=\"".$email."\" ;";
        $result = mysqli_query($dbConn, $sqlQuery);
        if(mysqli_num_rows($result) > 0){
          $row = mysqli_fetch_assoc($result);
          $pid = $row["pid"];
          $companyCount = $row["companycount"];
          $_SESSION["pid"] = $pid;
        }
        $_SESSION["compnayCount"] = $companyCount;
        if($companyCount != 0){
            $sqlQuery = "select participation.cid, company.cname from participation, company where participation.pid=\"".$pid."\" and participation.cid=company.cid;";
            $result = mysqli_query($dbConn, $sqlQuery);
            $i = 0;
            while($row = mysqli_fetch_assoc($result) ) {
                $companies[$i] = array($row["cid"], $row["cname"]);
                $companyStatus[$i] = "Registered";
                $compnayReadOnly[$i] = "readonly";
                $companyChange[$i] = "doNothing()";
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
            var companyCount = 0;
            var currCount = 0;
            var basePrice = 250;

            function getCost(count){
                price = 0;
                if( count == 0 ){
                    price = 0;
                }
                else if( count <= 2){
                    price = basePrice * count;
                }
                if( count >= 3 ){
                    price = (basePrice-50) * 3;
                }
                if( count == 4 ){
                    price += basePrice;
                }
                else if( count == 5 ){
                    price += (basePrice-50) * 2;
                }
                return price;
            }

            function checkCost(){
                prevCost = getCost(companyCount);
                currCost = getCost(currCount);
                document.getElementById('cost').value = (currCost - prevCost);
            }

            function company1Change(){
              var company1Ip = document.getElementById('company1');
              var company1 = company1Ip.options[company1Ip.selectedIndex].value;
              if( company1 != 'none' ){
                document.getElementById('company2').removeAttribute('disabled');
                document.getElementById('company1Err').innerHTML = "* ";
                document.getElementById('company2Input').style.display = "block";
                currCount += 1;
                checkCost();
                return 0;
              }
              else{
                document.getElementById('company2').setAttribute('disabled',"");
                document.getElementById('company2').selectedIndex = 0;
                document.getElementById('company1Err').innerHTML = "* Atleast 1 company is required";
                document.getElementById('company2Input').style.display = "none";
                currCount -= 1;
                company2Change();
                company3Change();
                company4Change();
              }
              return 1;
            }

            function company2Change(){
              var company2Ip = document.getElementById('company2');
              var company2 = company2Ip.options[company2Ip.selectedIndex].value;
              if( company2 != 'none' ){
                document.getElementById('company3').removeAttribute('disabled');
                document.getElementById('company3Input').style.display = "block";
                currCount += 1;
                checkCost();
              }
              else{
                document.getElementById('company3').setAttribute('disabled',"");
                document.getElementById('company3Input').style.display = "none";
                document.getElementById('company3').selectedIndex = 0;
                currCount -= 1;
                company3Change();
                company4Change();
              }
            }

            function company3Change(){
              var company3Ip = document.getElementById('company3');
              var company3 = company3Ip.options[company3Ip.selectedIndex].value;
              if( company3 != 'none' ){
                document.getElementById('company4').removeAttribute('disabled');
                document.getElementById('company4Input').style.display = "block";
                currCount += 1;
                checkCost();
              }
              else{
                document.getElementById('company4').setAttribute('disabled',"");
                document.getElementById('company4').selectedIndex = 0;
                document.getElementById('company4Input').style.display = "none";
                currCount -= 1;
                company4Change();
              }
            }

            function company4Change(){
              var company4Ip = document.getElementById('company4');
              var company4 = company4Ip.options[company4Ip.selectedIndex].value;
              if( company4 != 'none' ){
                document.getElementById('company5').removeAttribute('disabled');
                document.getElementById('company5Input').style.display = "block";
                currCount += 1;
              }
              else{
                document.getElementById('company5').setAttribute('disabled',"");
                document.getElementById('company5').selectedIndex = 0;
                document.getElementById('company5Input').style.display = "none";
                currCount -= 1;
              }
              checkCost();
            }

            function company5Change(){
              var company5Ip = document.getElementById('company5');
              var company5 = company5Ip.options[company5Ip.selectedIndex].value;
              if( company5 != 'none' ){
                currCount += 1;
              }
              else{
                currCount -= 1;
              }
              checkCost();
            }

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
              if(err == 0){
                var cost = document.getElementById('cost').value;
                if(cost == 0){
                    window.alert("No new companies have been selected");
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

            function loadCompanies(count){
              companyCount = count;
              currCount = count;
              if(companyCount==4){
                company4Change();
              }else if(companyCount==3){
                company3Change();
              }else if(companyCount==2){
                company2Change();
              }else if(companyCount==1){
                document.getElementById('company2').removeAttribute('disabled');
                document.getElementById('company2Input').style.display = "block";
              }
            }

            function doNothing(){
                return true;
            }

        </script>

    <body onload="loadCompanies(<?php echo $companyCount ?>)">
      <form action="payment.php" method="post" onsubmit="return checkCompanies()">
       <h1>Job Fair Registration</h1>
       <span id="instructions" name="instructions">Please select your desired companies (Max : 5)</span><br><br>

       <fieldset>
          <label for="cost">Cost : </label>
          <input type="text" id="cost" name="cost" value="0" readonly> 
          <legend><span class="number">3</span>Companies</legend>

          <label for="company1">Company 1: </label>
          <span class="error" id="company1Err">* <?php echo $companyStatus[0] ?> </span> <br>
          <select name="company1" id="company1" onchange="<?php echo $companyChange[0] ?>" <?php echo $compnayReadOnly[0] ?> >
          <?php
            if($companyCount>0){
               echo '<option value="' . $companies[0][0] . '" selected>' . $companies[0][1] . '</option>'; 
            }
            else{
                echo '<option value="none"> None </option>';
                $sql="SELECT * FROM company";
                $result = mysqli_query($dbConn, $sql);
                if(mysqli_num_rows($result) > 0 ){
                  while($row = mysqli_fetch_assoc($result)){
                    echo '<option value="' . $row["cid"] . '">' . $row["cname"] . '</option>';
                  }
                }
            }
          ?>
          </select>

          <div id="company2Input" style="display:none">
              <label for="company2">Company 2: </label>
              <span class="error" id="company2Err"> <?php echo $companyStatus[1] ?> </span> <br>
              <select name="company2" id="company2" onchange="<?php echo $companyChange[1] ?>" <?php echo $compnayReadOnly[1] ?> >
              <?php
                if($companyCount>1){
                    echo '<option value="' . $companies[1][0] . '" selected>' . $companies[1][1] . '</option>'; 
                }
                else{
                    echo '<option value="none"> None </option>';
                    $sql="SELECT * FROM company";
                    $result = mysqli_query($dbConn, $sql);
                    if(mysqli_num_rows($result) > 0 ){
                      while($row = mysqli_fetch_assoc($result)){
                        echo '<option value="' . $row["cid"] . '">' . $row["cname"] . '</option>';
                      }
                    }
                }
              ?>
              </select>
          </div>

          <div id="company3Input" style="display:none">
              <label for="company3">Company 3: </label>
              <span class="error" id="company3Err"> <?php echo $companyStatus[2] ?> </span> <br>
              <select name="company3" id="company3" onchange="<?php echo $companyChange[2] ?>" <?php echo $compnayReadOnly[2] ?> >
              <?php
                if($companyCount>2){
                    echo '<option value="' . $companies[2][0] . '" selected>' . $companies[2][1] . '</option>'; 
                }
                else{
                    echo '<option value="none"> None </option>';
                    $sql="SELECT * FROM company";
                    $result = mysqli_query($dbConn, $sql);
                    if(mysqli_num_rows($result) > 0 ){
                      while($row = mysqli_fetch_assoc($result)){
                        echo '<option value="' . $row["cid"] . '">' . $row["cname"] . '</option>';
                      }
                    }
                }
              ?>
              </select>
           </div>

          <div id="company4Input" style="display:none">
              <label for="company4">Company 4: </label>
              <span class="error" id="company4Err"> <?php echo $companyStatus[3] ?> </span> <br>
              <select name="company4" id="company4" onchange="<?php echo $companyChange[3] ?>" <?php echo $compnayReadOnly[3] ?> >
              <?php
                if($companyCount>3){
                    echo '<option value="' . $companies[1][0] . '" selected>' . $companies[1][1] . '</option>'; 
                }
                else{
                    echo '<option value="none"> None </option>';
                    $sql="SELECT * FROM company";
                    $result = mysqli_query($dbConn, $sql);
                    if(mysqli_num_rows($result) > 0 ){
                      while($row = mysqli_fetch_assoc($result)){
                        echo '<option value="' . $row["cid"] . '">' . $row["cname"] . '</option>';
                      }
                    }
                }
              ?>
              </select>
          </div>
          
          <div id="company5Input" style="display:none">
              <input type="text" id="email" name="email" value="<?php echo $email ?>" readonly style="display:none;">
              <input type="pid" id="pid" name="pid" value="<?php echo $pid ?>" readonly style="display:none;">
              <label for="company5">Company 5: </label>
              <span class="error" id="company5Err"> <?php echo $companyStatus[4] ?></span> <br>
              <select name="company5" id="company5" onchange="<?php echo $companyChange[4] ?>" <?php echo $compnayReadOnly[4] ?> >
              <?php
                if($companyCount>4){
                    echo '<option value="' . $companies[1][0] . '" selected>' . $companies[1][1] . '</option>'; 
                }
                else{
                    echo '<option value="none"> None </option>';
                    $sql="SELECT * FROM company";
                    $result = mysqli_query($dbConn, $sql);
                    if(mysqli_num_rows($result) > 0 ){
                      while($row = mysqli_fetch_assoc($result)){
                        echo '<option value="' . $row["cid"] . '">' . $row["cname"] . '</option>';
                      }
                    }
                }
              ?>
              </select>
          </div>
          
        </fieldset>

        <button type="submit">Proceed</button>
    </body>
</html>