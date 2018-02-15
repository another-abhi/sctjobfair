<html>
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Job Fair 2018 View</title>
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
        echo "connected";
        
        function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }
      ?>

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" onsubmit="return validateForm()">

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
          <input type="radio" id="c2Include" name="c2Include" value="i" checked>Include &nbsp;
          <input type="radio" id="c2Include" name="c2Include" vlaue="e">Exclude
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
          <input type="radio" id="c3Include" name="c3Include" value="i" checked>Include &nbsp;
          <input type="radio" id="c3Include" name="c3Include" vlaue="e">Exclude
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
          <input type="radio" id="c4Include" name="c4Include" value="i" checked>Include &nbsp;
          <input type="radio" id="c4Include" name="c4Include" vlaue="e">Exclude
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
          <input type="radio" id="c5Include" name="c5Include" value="i" checked>Include &nbsp;
          <input type="radio" id="c5Include" name="c5Include" vlaue="e">Exclude
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
          <input type="number" id="count" name="age" min="0" max="5" value="">
          
          <label for="gender">Gender: </label>
          <span class="error" id="genderErr">* </span> <br>
          <input type="radio" id="gender" name="gender" value="a" checked>Any &nbsp; &nbsp;
          <input type="radio" id="gender" name="gender" value="m">Male &nbsp; &nbsp;
          <input type="radio" id="gender" name="gender" value="f">Female<br><br>

        </fieldset>
        <button type="submit">Register</button>
      </form>

    </body>
</html>