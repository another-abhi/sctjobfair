<!DOCTYPE html>
<html lang="en">
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Job Fair 2018 View</title>
         <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

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
        $username = "ncscnlst_jobfair";
        $password = "Adersh!23";
        $dbname = "ncscnlst_jobfair18";
        $dbConn = mysqli_connect($servername, $username, $password, $dbname);
        if( !$dbConn ){
          echo "Connection failed : " . mysqli_connect_error();
        }
        echo "connected<br>";

        $tableData = array();
        $tableIndex = 0;
        $conditionString = "";

        if( $_SERVER["REQUEST_METHOD"] == "POST" ){
          $company1Filter = $_POST["company1"];
          $company2Filter = $_POST["company2"];
          $company3Filter = $_POST["company3"];
          $company4Filter = $_POST["company4"];
          $company5Filter = $_POST["company5"];

          $c2Include = $_POST["c2Include"];
          $c3Include = $_POST["c3Include"];
          $c4Include = $_POST["c4Include"];
          $c5Include = $_POST["c5Include"];

          $companyCountFilterType = $_POST["countType"];
          $companyCountFilter = test_input($_POST["companyCount"]);
          $collegeFilter = strtoupper(test_input($_POST["college"]));
          $branchFilter = strtoupper( test_input($_POST["branch"]) );
          $pidFilter = test_input($_POST["pid"]);
          $genderFilter = $_POST["gender"];
          $paymentFilter = $_POST["payment"];

          $conditionString = $company1Filter.' '.$c2Include.' '.$company2Filter.' '.$c3Include.' '.$company3Filter.' '.$c4Include.' '.$company4Filter.' '.$c5Include.' '.$company5Filter;
          $conditionString .= " | Count : ".$companyCountFilterType.' '.$companyCountFilter;
          $conditionString .= " | College : ".$collegeFilter;
          $conditionString .= " | Payment : ".$paymentFilter;
          $conditionString .= " | Branch : ".$branchFilter;
          $conditionString .= " | Gender : ".$genderFilter;

          $pidList = array();

          $sqlQuery = "select * from participant;";
          $result = mysqli_query($dbConn, $sqlQuery);
          for($i = 0; $row = mysqli_fetch_assoc($result); $i++){
            $pidList[$i] = $row["pid"];
            $companyList = array();
            // echo $row["fullname"].'<br>';
            // echo $i.'<br>';
            // echo $pidList[$i].'<br>';
            $sqlQuery = "select cid from participation where pid=".$pidList[$i].";";
            $result2 = mysqli_query($dbConn, $sqlQuery);
            for($j = 0; $row2 = mysqli_fetch_assoc($result2); $j++){
              $companyList[$j] = $row2["cid"];
            }

            $flag = true;
            $present = false;
            
            if($company1Filter != "any")
              if( !in_array($company1Filter, $companyList) ) //check if company 1 is present
                $flag = false;

            if($company2Filter != "any"){ //company 2 filter is present
              $present = in_array($company2Filter, $companyList);
              // echo 'c2Include : '.$c2Include.'<br>';
              if($c2Include == "a" && !$present){
                $flag = false;
                // echo 'no company 2<br>';
              }
              else if($c2Include == "o" && $present){
                $flag = true;
              }
              else if($c2Include == "n" && $present){
                $flag = false;
              }
            }

            if($company3Filter != "any"){ //company 3 filter is present
              $present = in_array($company3Filter, $companyList);
              if($c3Include == "a" && $present && $flag)
                $flag = true;
              else if($c3Include == "o" && $present)
                $flag = true;
              else if($c3Include == "n" && $present)
                $flag = false;
            }

            if($company4Filter != "any"){ //company 4 filter is present
              $present = in_array($company4Filter, $companyList);
              if($c4Include == "a" && $present && $flag)
                $flag = true;
              else if($c4Include == "o" && $present)
                $flag = true;
              else if($c4Include == "n" && $present)
                $flag = false;
            }

            if($company5Filter != "any"){ //company 5 filter is present
              $present = in_array($company5Filter, $companyList);
              if($c5Include == "a" && $present && $flag)
                $flag = true;
              else if($c5Include == "o" && $present)
                $flag = true;
              else if($c5Include == "n" && $present)
                $flag = false;
            }

            if($companyCountFilterType != "any"){
              // echo 'count filtering <br>';
              // echo 'compant count : '.count($companyList).'<br>';
              // echo 'company filter : '.$companyCountFilter.'<br>';
              if($companyCountFilterType == "lesser" && count($companyList) >= $companyCountFilter)
                $flag = false;
              if($companyCountFilterType == "greater" && count($companyList) <= $companyCountFilter)
                $flag = false;
              if($companyCountFilterType == "equal" && count($companyList) != $companyCountFilter)
                $flag = false;
            }

            if($paymentFilter == "paid" && $row["paymentstatus"] == "notpaid")
              $flag = false;
            if($paymentFilter == "notpaid" && $row["paymentstatus"] == "paid")
              $flag = false;

            if($collegeFilter != "" && $row["ugcollege"] != $collegeFilter)
              $flag = false;

            if($branchFilter != "" && $row["ugbranch"] != $branchFilter)
              $flag = false;

            if($genderFilter == 'm' && $row["gender"] == 'f')
              $flag = false;
            if($genderFilter == 'f' && $row["gender"] == 'm')
              $flag = false;

            // echo $flag.'<br>';
            if($flag){//include the pid
              $companies = implode(" | ", $companyList);
              $row["company"] = $companies;
              $tableData[$tableIndex] = $row;
              $tableIndex++;
            } 
            //print_r($tableData[0]);

          }
        }

        
        function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }
      ?>

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >

        <h1>Job Fair View</h1>

        <fieldset>
          <legend><span class="number">1</span>Company Filter</legend>
          
          <label>Company 1:</label>
          <select name="company1" id="company1" >
          <option value="any">Any </option>
          <?php
            $sql="SELECT * FROM company";
            $result = mysqli_query($dbConn, $sql);
            if(mysqli_num_rows($result) > 0 ){
              while($row = mysqli_fetch_assoc($result)){
                echo '<option value="' . $row["cid"] . '">' . $row["cname"] . '</option>';
              }
            }
          ?>
          </select>

          <label>Company 2: </label> &nbsp;
          <input type="radio" id="c2Include" name="c2Include" value="o" checked>OR &nbsp;
          <input type="radio" id="c2Include" name="c2Include" value="a">AND &nbsp;
          <input type="radio" id="c2Include" name="c2Include" value="n">NOT
          <select name="company2" id="company2" >
          <option value="any">Any </option>
          <option value="none">None </option>
          <?php
            $sql="SELECT * FROM company";
            $result = mysqli_query($dbConn, $sql);
            if(mysqli_num_rows($result) > 0 ){
              while($row = mysqli_fetch_assoc($result)){
                echo '<option value="' . $row["cid"] . '">' . $row["cname"] . '</option>';
              }
            }
          ?>
          </select>

          <label>Company 3:</label> &nbsp;
          <input type="radio" id="c3Include" name="c3Include" value="o" checked>OR &nbsp;
          <input type="radio" id="c3Include" name="c3Include" value="a">AND &nbsp;
          <input type="radio" id="c3Include" name="c3Include" value="n">NOT
          <select name="company3" id="company3" >
          <option value="any">Any </option>
          <option value="none">None </option>
          <?php
            $sql="SELECT * FROM company";
            $result = mysqli_query($dbConn, $sql);
            if(mysqli_num_rows($result) > 0 ){
              while($row = mysqli_fetch_assoc($result)){
                echo '<option value="' . $row["cid"] . '">' . $row["cname"] . '</option>';
              }
            }
          ?>
          </select>

          <label>Company 4:</label> &nbsp;
          <input type="radio" id="c4Include" name="c4Include" value="or" checked>OR &nbsp;
          <input type="radio" id="c4Include" name="c4Include" value="a">AND &nbsp;
          <input type="radio" id="c4Include" name="c4Include" value="n">NOT
          <select name="company4" id="company4" >
          <option value="any">Any </option>
          <option value="none">None </option>
          <?php
            $sql="SELECT * FROM company";
            $result = mysqli_query($dbConn, $sql);
            if(mysqli_num_rows($result) > 0 ){
              while($row = mysqli_fetch_assoc($result)){
                echo '<option value="' . $row["cid"] . '">' . $row["cname"] . '</option>';
              }
            }
          ?>
          </select>

          <label>Company 5:</label> &nbsp;
          <input type="radio" id="c5Include" name="c5Include" value="o" checked>OR &nbsp;
          <input type="radio" id="c5Include" name="c5Include" value="a">AND &nbsp;
          <input type="radio" id="c5Include" name="c5Include" value="n">NOT
          <select name="company5" id="company5" >
          <option value="any">Any </option>
          <option value="none">None </option>
          <?php
            $sql="SELECT * FROM company";
            $result = mysqli_query($dbConn, $sql);
            if(mysqli_num_rows($result) > 0 ){
              while($row = mysqli_fetch_assoc($result)){
                echo '<option value="' . $row["cid"] . '">' . $row["cname"] . '</option>';
              }
            }
          ?>
          </select>

        </fieldset>

        <fieldset>
          <legend><span class="number">2</span>Other Filters</legend>

          <label>Company Count: </label><br>
          <input type="radio" id="countType" name="countType" value="any" checked> Any &nbsp;
          <input type="radio" id="countType" name="countType" value="lesser"> Less &nbsp;
          <input type="radio" id="countType" name="countType" value="greater"> Greater &nbsp;
          <input type="radio" id="countType" name="countType" value="equal"> Equal
          <input type="number" id="companyCount" name="companyCount" min="0" max="5" value="">
          
          <label>Payment : </label><br>
          <input type="radio" id="payment" name="payment" value="any" checked> Any &nbsp;
          <input type="radio" id="payment" name="payment" value="paid"> Paid &nbsp;
          <input type="radio" id="payment" name="payment" value="notpaid"> Not Paid <br><br>

          <label>COLLEGE : </label><br>
          <input type="text" id="college" name="college" value="">

          <label>BRANCH : </label><br>
          <input type="text" id="branch" name="branch" value="">

          <label>PID : </label><br>
          <input type="text" id="pid" name="pid" value="">

          <label for="gender">Gender: </label>
          <input type="radio" id="gender" name="gender" value="a" checked>Any &nbsp; &nbsp;
          <input type="radio" id="gender" name="gender" value="m">Male &nbsp; &nbsp;
          <input type="radio" id="gender" name="gender" value="f">Female<br><br>

        </fieldset>
        <button type="submit">Filter</button>
      </form>

      <div id="result" name="result">
        <h4><label>Filters : </label></h4>
        <span><label>&nbsp;<?php echo $conditionString; ?></label></span><br>
        <span><h3>COUNT : <?php echo count($tableData); ?></h3></span><br>

        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover">
            <tr>
            <?php
              if($tableIndex > 0){
                $headers = array_keys($tableData[0]);
                for( $i = 0; $i < count($headers); $i++ ){
                  echo '<th>'.$headers[$i].'</th>';
                }
              }
            ?>
          </tr>
          <?php
            for($i = 0; $i < $tableIndex; $i++){
              echo '<tr>';
              $row = $tableData[$i];
              foreach($row as $x => $value){
                echo '<td>'.$value.'</td>';
              }
              echo '</tr>';
            }
          ?>
          </table>
        </div>
      </div>

    </body>
</html>