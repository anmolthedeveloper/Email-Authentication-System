<?php
	if(isset($_GET['SecretCode'])){
      	echo "Script Running!";

      	$servername = "";
      	$username = "";
      	$password = "";
      	$dbname = "";

  		// Create connection
  		$conn = mysqli_connect($servername, $username, $password, $dbname);
  		// Check connection
  		if (!$conn) {
      	die("Connection failed: " . mysqli_connect_error());
    	}

      	$sql = "SELECT rand_string FROM MyUsers WHERE rand_string = '" . $_GET["SecretCode"] . "'";
      	$result = mysqli_query($conn, $sql);

      	$count  = mysqli_num_rows($result);
		if($count==0) {
			$message = "Authentication Failed!";
		}
      	else {
          	$flag = "TRUE";
          	$VARI = $_GET['SecretCode'];
          	$sql = "UPDATE MyUsers SET flag=('$flag') WHERE rand_string = '$VARI'";
        	if (mysqli_query($conn, $sql)) {
              	$message = "You are successfully authenticated!";
        	}
        	else {
          	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        	}
        }

      echo $message;

		mysqli_close($conn);
    }
?>
