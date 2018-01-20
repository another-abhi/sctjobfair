  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up Form</title>
        <link rel="stylesheet" href="css/normalize.css">
        <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/main.css">
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
    	?>

      <form action="index.html" method="post">
      
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
          <input type="radio" id="gender" name="gender" checked> Male<br>
          <input type="radio" id="gender" name="gender" > Female<br>

        </fieldset>
        
        <fieldset>
          <legend><span class="number">2</span>Educational Details</legend>
          
          <label for="percentage10">10th Percentage: </label>
          <span class="error">* </span> <br>
          <input type="text" id="percentage10" name="percentage10">

          <label for="percentage12">12th Percentage: </label>
          <span class="error">* </span> <br>
          <input type="text" id="percentage12" name="percentage12">

          <label for="percentage10">Undergraduate Course: </label>
          <span class="error">* </span> <br>
          <select name="ugCourse">
          <?php
          	$sql="SELECT * FROM ugcourse";
          	$result = mysqli_query($dbConn, $sql);
          	if(mysqli_num_rows($result) > 0 ){
          		while($row = mysqli_fetch_assoc($result)){
          			echo '<option value="' . $row["ugCourseId"] . '">' . $row["ugCourseName"] . '</option>';
          		}
          	}
          ?>
      	  </select>

      	  <label for="ugcollege">: </label>
          <span class="error">* </span> <br>
          <input type="text" id="percentage12" name="percentage12">

        </fieldset>
        <button type="submit">Sign Up</button>
      </form>
      
    </body>
</html>