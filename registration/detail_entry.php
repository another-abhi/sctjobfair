<html>
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Job Fair 2018 Registration</title>
        <link rel="stylesheet" href="css/normalize.css">
        <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/main.css">
        <script src="main.js"></script>
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
        
        $email = "";
        $pid = "";
        $message = "";
        if( $_SERVER["REQUEST_METHOD"] == "POST" ){
          $email = test_input($_POST["email"]);
        }
        if($email == ""){
          header("Location: email.php");
          exit();
        }

        $_SESSION["email"] = $email;
        
        $fullName = $age = $dob = $address = $contact = $gender = "";
        $percentage10 = $percentage12 = $ugCourse = $ugCollege = $ugCgpa = $ugYop = $backlogs = $fresher = "";
        $experience = $expCompany = $pgCourse = $pgCollege = $pgCgpa = $pgYop = "";
        $ugBranch = "";
        $ugYop = 2018;
        $backlogs = '0';
        $fresher = 'y';
        $pgCourse = 'none';
        $sqlQuery = "select * from participant where email=\"".$email."\" ;";
        $result = mysqli_query($dbConn, $sqlQuery);
        if(mysqli_num_rows($result) > 0){
          $row = mysqli_fetch_assoc($result);
          $pid = $row["pid"];
          //header("Location: company_select.php");
          $fullName = $row["fullname"];
          $address = $row["address"];
          $age = $row["age"];
          $dob = $row["dob"];
          $dob = substr($dob, 0, 10);
          $contact = $row["contact"];
          $gender = $row["gender"];
          $percentage10 = $row["percentage10"];
          $percentage12 = $row["percentage12"];
          $ugCourse = $row["ugcourse"];
          $ugCollege = $row["ugcollege"];
          $ugBranch = $row["ugbranch"];
          $ugCgpa = $row["ugcgpa"];
          $backlogs = $row["backlogs"];
          $ugYop = $row["ugyop"];
          $freshed = $row["fresher"];
          $experience = $row["experience"];
          $expCompany = $row["expcompany"];
          $pgCourse = $row["pgcourse"];
          $pgCollege = $row["pgcollege"];
          $pgCgpa = $row["pgcgpa"];
          $pgYop = $row["pgyop"];

          $message = "Existing record PID : ".$pid;
        }
        $_SESSION["pid"] = $pid;
        //echo "email : " . $_SESSION["email"] . "<br>"; 
        function test_input($data){
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }
      ?>

      <form id="detailEntry" action="company_select.php" method="post" onsubmit="return validateForm()">

        <h1>Job Fair Registration</h1>
        <span id="message"> <?php echo $message ?> </span><br>
        <span id="emailMsg"> Email : <?php echo $email ?> </span><br><br>

        <fieldset>
          

          <legend><span class="number">1</span>Personal info</legend>

          <label for="first_name">Full Name:</label>
          <span class="error" id="fullNameErr">* </span>
          <input type="text" id="full_name" name="full_name" value="<?php echo $fullName; ?>" onchnage="checkName()">


<!--           <label for="last_name">Last Name: </label>
          <span class="error" id="lastNameErr">* </span>
          <input type="text" id="last_name" name="last_name" value="" onchange="checkLastName()"> -->


          <label for="email">Email: </label>
          <span class="error" id="emailErr">* </span>
          <input type="email" id="email" name="email" value="<?php echo $email; ?>" style="color:#777777;" readonly>


          <label for="age">Age: </label>
          <span class="error" id="ageErr">* </span>
          <input type="number" id="age" name="age" min="18" max="40" value="<?php echo $age; ?>" onkeyup="checkAge()">

          <label for="dob">Date of Birth: </label>
          <span class="error" id="dobErr">* </span>
          <input type="date" id="dob" name="dob" value="<?php echo $dob; ?>" onchange="checkDob()">

          <label for="address">Address: </label>
          <span class="error" id="addressErr">* </span>
          <textarea id="address" name="address" ><?php echo $address; ?></textarea>

          <label for="contact">Contact: </label>
          <span class="error" id="contactErr">* </span>
          <input type="text" id="contact" name="contact" size="10" maxlenght="10" minlength="10" value="<?php echo $contact ?>" onchange="checkContact()">

          <label for="gender">Gender: </label>
          <span class="error" id="genderErr">* </span> <br>
          <input type="radio" id="gender" name="gender" value="m" <?php if($gender=='m' || $gender == '') echo 'checked'; ?> > Male<br>
          <input type="radio" id="gender" name="gender" value="f" <?php if($gender=='f') echo 'checked'; ?> > Female<br>

        </fieldset>

        <fieldset>
          <legend><span class="number">2</span>Educational Details</legend>

          <label for="percentage10">10th Percentage: </label>
          <span class="error" id="percentage10Err">* </span> <br>
          <input type="text" id="percentage10" name="percentage10" value="<?php echo $percentage10; ?>" onchange="checkPercentage10()">

          <label for="percentage12">12th Percentage: </label>
          <span class="error" id="percentage12Err">* </span> <br>
          <input type="text" id="percentage12" name="percentage12" value="<?php echo $percentage12; ?>" onchange="checkPercentage12()">

          <label for="ugcourse">Undergraduate Course: </label>
          <span class="error" id="ugCourseErr">* </span> <br>
          <select name="ugCourse">
          <?php
            $sql="SELECT * FROM ugcourse";
            $result = mysqli_query($dbConn, $sql);
            if(mysqli_num_rows($result) > 0 ){
              while($row = mysqli_fetch_assoc($result)){
                echo '<option value="' . $row["ugcourseid"] . '">' . $row["ugcoursename"] . '</option>';
              }
            }
            if($ugCourse != ""){
              echo '<option value="'. $ugCourse .'" selected>'. $ugCourse .'</option>';
            }
          ?>
          </select>

          <label for="ugCollege">Undergraduate College: </label>
          <span class="error" id="ugCollegeErr">* </span> <br>
          <input type="text" id="ugCollege" name="ugCollege" value="<?php echo $ugCollege; ?>" onchange="checkUgCollege()">

          <label for="ugBranch">Undergraduate Branch </label>
          <span class="error" id="ugBranchErr">* </span> <br>
          <input type="text" id="ugBranch" name="ugBranch" value="<?php echo $ugBranch; ?>" onkeyup="checkUgBranch()">

          <label for="ugCgpa">Undergraduate GPA/CGPA: </label>
          <span class="error" id="ugCgpaErr">* </span> <br>
          <input type="text" id="ugCgpa" name="ugCgpa" value="<?php echo $ugCgpa; ?>"onkeyup="checkUgCgpa()">

          <label for="ugYop">Year of Passing: </label>
          <span class="error" id="ugYopErr">* </span>
          <input type="number" id="ugYop" name="ugYop" value="<?php echo $ugYop; ?>" min="2015" max="2018">

          <label for="backlogs">Number of backlogs: </label>
          <span class="error" id="backlogsErr">* </span> <br>
          <input type="number" id="backlogs" name="backlogs" value="<?php echo $backlogs; ?>" min="0">

          <label for="fresher">Fresher: </label>
          <span class="error" id="fresherErr">* </span> <br>
          <input type="radio" id="fresher" name="fresher" value="y" <?php if($fresher=='y')echo 'checked'; ?> onclick="fresherChange()">Yes &nbsp;
          <input type="radio" id="fresher" name="fresher" value="n" <?php if($fresher=='n')echo 'checked'; ?> onclick="fresherChange()">No<br><br>

          <div id="experienceInput" name="expecienceInput" <?php if($fresher=='y')echo 'style="display:none;"'; ?>>
          	
          	<label for="experience">Experience (Years): </label>
          	<span class="error" id="experienceErr">* </span> <br>
          	<input type="number" id="experience" name="experience" value="<?php echo $experience; ?>" <?php if($fresher=='y')echo 'disabled'; ?> >
          	
          	<label for="expCompany">Experience Company: </label>
          	<span class="error" id="expCompanyErr">* </span> <br>
          	<input type="text" id="expCompany" name="expCompany" value="<?php echo $expCompany; ?>" <?php if($fresher=='y')echo 'disabled'; ?> >

          </div>

          <label for="pgCourse">Postgraduate Course: </label>
          <span class="error" id="pgCourseErr"> </span> <br>
          <select name="pgCourse" id="pgCourse" onchange="pgCourseChange()">
          <option value="none"> None </option>
          <?php
            $sql="SELECT * FROM pgcourse";
            $result = mysqli_query($dbConn, $sql);
            if(mysqli_num_rows($result) > 0 ){
              while($row = mysqli_fetch_assoc($result)){
                echo '<option value="' . $row["pgcourseid"] . '">' . $row["pgcoursename"] . '</option>';
              }
            }
            if($pgCourse != ""){
              echo '<option value="'. $pgCourse .'" selected>'. $pgCourse .'</option>';
            }
          ?>
          </select>

          <div id="pgInput" namme="pgInput" <?php if($pgCourse=="none")echo 'style="display:none"'; ?> >
	          
	          <label for="pgCollege">Postgraduate College: </label>
	          <span class="error" id="pgCollegeErr"> </span> <br>
	          <input type="text" id="pgCollege" name="pgCollege" value="" <?php if($pgCourse=="none")echo 'disabled'; ?> >


	          <label for="pgCgpa">Postgraduate GPA/CGPA: </label>
	          <span class="error" id="pgCgpaErr"> </span> <br>
	          <input type="text" id="pgCgpa" name="pgCgpa" <?php if($pgCourse=="none")echo 'disabled'; ?> onkeyup="checkPgCgpa()">

	          <label for="pgYop">Year of Passing: </label>
	          <span class="error" id="pgYopErr"> </span>
	          <input type="number" id="pgYop" name="pgYop" value="2018" min="2015" max="2018" onchange="checkPgYop()" <?php if($pgCourse=="none")echo 'disabled'; ?> >
	      </div>

        <div <?php if($pid=="")echo 'style="display:none"'; ?> >
          <label for="change">Any Change: </label>
          <span class="error" id="changeErr">* </span> <br>
          <input type="radio" id="change" name="change" value="yes" checked> Yes, Change<br>
          <input type="radio" id="change" name="change" value="no"> No Change<br>
        </div>
        </fieldset>

        <button type="submit">Proceed</button>
      </form>

    </body>
</html>
