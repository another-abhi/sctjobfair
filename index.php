  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up Form</title>
        <link rel="stylesheet" href="css/normalize.css">
        <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/main.css">

        <script>
        	function checkPercentage10(){
        		var percentage10 = document.getElementById('percentage10').value;
        		if( percentage10 > 100 || isNaN(percentage10) ) {

        			document.getElementById("percentage10Err").innerHTML = "* Invalid Input";
        		}
        		else{
        			document.getElementById("percentage10Err").innerHTML = "* ";
        		}
        	}
        </script>
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
	    	$firstNameErr = $lastNameErr = $emailErr = $ageErr = $dobErr = $addressErr = $contactErr = $percentage10Err = $percentage12Err =  $ugCollegeErr = $ucCgpaErr = $pgCpgaErr = $pgYopErr = "";
	    	$firstName = $lastName = $email = $age = $dob = $address = $contact = $gender = $percentage10 = $percentage12 = $ugCourse = $ugCollege = $ugCgpa = $ugYop = $backlogs = $fresher = $pgCourse = $pgCollege = $pgYop = $company1 = $company2 = $company3 = $company4 = $company5 = "";
	    	$error = "none";
	    	if( $_SERVER["REQUEST_METHOD"] == "POST"){
	    		
	    		$firstName = test_input($_POST["first_name"]);
	    		$lastName = test_input($_POST["last_name"]);
	    		$email = test_input($_POST["email"]);
	    		$age = test_input($_POST["age"]);
	    		$dob = test_input($_POST["dob"]);
	    		$address = test_input($_POST["address"]);
	    		$contact = test_input($_POST["contact"]);
	    		$gender = test_input($_POST["gender"]);
	    		$percentage10 = test_input($_POST["percentage10"]);
	    		$percentage12 = test_input($_POST["percentage12"]);
	    		$ugCourse = test_input($_POST["ugCourse"]);
	    		$ugCollege = test_input($_POST["ugCollege"]);
	    		$ugCgpa = test_input($_POST["ugCgpa"]);
	    		$ugYop = test_input($_POST["ugYop"]);
	    		$backlogs = test_input($_POST["backlogs"]);
	    		$fresher = test_input($_POST["fresher"]);
	    		$pgCourse = test_input($_POST["pgCourse"]);
	    		$pgCollege = test_input($_POST["pgCollege"]);
	    		$pgCgpa = test_input($_POST["pgCgpa"]);
	    		$pgYop = test_input($_POST["pgYop"]);
	    		$company1 = test_input($_POST["company1"]);
	    		$company2 = test_input($_POST["company2"]);
	    		$company3 = test_input($_POST["company3"]);
	    		$company4 = test_input($_POST["company4"]);
	    		$company5 = test_input($_POST["company5"]);
	    		
	    		if($error == "none"){
	    			$query = "insert into participant values(\"a\", \"".$lastName."\",\"".$firstName."\",\"".$address."\",\"".$email."\",".$age.",\"".$dob."\",\"".$contact."\",\"".$gender."\",".$percentage10.",".$percentage12.",\"".$ugCourse."\",\"".$ugCollege."\",".$ugCgpa.",\"".$fresher."\",".$backlogs.",\"".$ugYop."\",\"".$pgCourse."\",\"".$pgCollege."\",".$pgCgpa.",\"".$pgYop."\")";
	    			if(mysqli_query($dbConn, $query)){
	    				echo " New record created " ;
	    			}
	    			else{
	    				echo " ERROR" .mysqli_error($dbConn);
	    			}
	    		}
	    	}

	    	function test_input($data) {
  				$data = trim($data);
  				$data = stripslashes($data);
  				$data = htmlspecialchars($data);
  				return $data;
			}
    	?>

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      
        <h1>Sign Up</h1>
        
        <fieldset>
          <legend><span class="number">1</span>Personal info</legend>
          <label for="first_name">First Name:</label> 
          <span class="error">* </span>
          <input type="text" id="first_name" name="first_name" value="">
          

          <label for="last_name">Last Name: </label> 
          <span class="error">* </span>
          <input type="text" id="last_name" name="last_name" value="">
          
          
          <label for="email">Email: </label>
          <span class="error">* </span>
          <input type="email" id="email" name="email" value="">
          

          <label for="age">Age: </label>
          <span class="error">* </span>
          <input type="number" id="age" name="age" min="18" max="40" value="">

          <label for="dob">Date of Birth: </label>
          <span class="error">* </span>
          <input type="date" id="dob" name="dob" value="">

          <label for="address">Address: </label>
          <span class="error">* </span>
          <textarea id="address" name="address"></textarea>

          <label for="contact">Contact: </label>
          <span class="error">* </span>
          <input type="text" id="contact" name="contact" size="10" maxlenght="10" minlength="10" value="">

          <label for="gender">Gender: </label>
          <span class="error">* </span> <br>
          <input type="radio" id="gender" name="gender" value="m" checked> Male<br>
          <input type="radio" id="gender" name="gender" value="f"> Female<br>

        </fieldset>
        
        <fieldset>
          <legend><span class="number">2</span>Educational Details</legend>
          
          <label for="percentage10">10th Percentage: </label>
          <span class="error" id="percentage10Err">* </span> <br>
          <input type="text" id="percentage10" name="percentage10" onkeyup="checkPercentage10()">

          <label for="percentage12">12th Percentage: </label>
          <span class="error">* </span> <br>
          <input type="text" id="percentage12" name="percentage12">

          <label for="ugcourse">Undergraduate Course: </label>
          <span class="error">* </span> <br>
          <select name="ugCourse">
          <?php
          	$sql="SELECT * FROM ugcourse";
          	$result = mysqli_query($dbConn, $sql);
          	if(mysqli_num_rows($result) > 0 ){
          		while($row = mysqli_fetch_assoc($result)){
          			echo '<option value="' . $row["ugcourseid"] . '">' . $row["ugcoursename"] . '</option>';
          		}
          	}
          ?>
      	  </select>

      	  <label for="ugCollege">Undergraduate College: </label>
          <span class="error">* </span> <br>
          <input type="text" id="ugCollege" name="ugCollege" value="">

      	  <label for="ugCgpa"> Undergraduate GPA/CGPA </label>
      	  <span class="error">* </span> <br>
      	  <input type="text" id="ugCgpa" name="ugCgpa">

      	  <label for="ugYop">Year of Passing: </label>
          <span class="error">* </span>
          <input type="number" id="ugYop" name="ugYop" value="2018" min="2015" max="2018">

      	  <label for="backlogs"> Number of backlogs </label>
      	  <span class="error">* </span> <br>
      	  <input type="number" id="backlogs" name="backlogs" value="0">

      	  <label for="fresher">Fresher: </label>
          <span class="error">* </span> <br>
          <input type="radio" id="fresher" name="fresher" value="y" checked> Yes 
          <input type="radio" id="fresher" name="fresher" value="n"> No<br><br>
      	  

          <label for="pgCourse">Postgraduate Course: </label>
          <span class="error">* </span> <br>
          <select name="pgCourse">
          <option value="none"> None </option>
          <?php
          	$sql="SELECT * FROM pgcourse";
          	$result = mysqli_query($dbConn, $sql);
          	if(mysqli_num_rows($result) > 0 ){
          		while($row = mysqli_fetch_assoc($result)){
          			echo '<option value="' . $row["pgcourseId"] . '">' . $row["pgcoursename"] . '</option>';
          		}
          	}
          ?>
      	  </select>

      	  <label for="pgCollege">Postgraduate College: </label>
          <span class="error">* </span> <br>
          <input type="text" id="pgCollege" name="pgCollege" value="">


      	  <label for="pgCgpa"> Postgraduate GPA/CGPA </label>
      	  <span class="error">* </span> <br>
      	  <input type="text" id="pgCgpa" name="pgCgpa">

      	  <label for="pgYop">Year of Passing: </label>
          <span class="error">* </span>
          <input type="number" id="pgYop" name="pgYop" value="" min="2015" max="2018">

        </fieldset>

        <fieldset>
          <legend><span class="number">3</span>Companies</legend>

          <label for="company1">Company 1 </label>
          <span class="error">* </span> <br>
          <select name="company1">
          <option value="none"> None </option>
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

      	  <label for="company2">Company 2 </label>
      	  <span class="error"> </span> <br>
          <select name="company2">
          <option value="none"> None </option>
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

      	  <label for="company3">Company 3 </label>
          <span class="error"> </span> <br>
          <select name="company3">
          <option value="none"> None </option>
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

      	  <label for="company4">Company 4 </label>
          <span class="error"> </span> <br>
          <select name="company4">
          <option value="none"> None </option>
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

      	  <label for="company5">Company 5 </label>
      	  <span class="error"> </span> <br>
          <select name="company5">
          <option value="none"> None </option>
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

        <button type="submit">Sign Up</button>
      </form>
      
    </body>
</html>