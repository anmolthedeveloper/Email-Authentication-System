<?php
	if(!(isset($_POST['submit']))){
      echo "Redirecting to index page!";
      	echo "<script>window.location.href='https://www.anmolthedeveloper.com/email-auth/index.php';</script>";
    }
	else {

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
      echo "Script running";

      // Define variables and set to empty values
      $email = "";
      $email = $_POST["email"];

      echo "<br>";
      echo "<br>";

      //Random String for authentication
      function generateRandomString($length = 10) {

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    	$charactersLength = strlen($characters);
    	$randomString = '';
    	for ($i = 0; $i < $length; $i++) {
        	$randomString .= $characters[rand(0, $charactersLength - 1)];
        }
    	return $randomString;
      }

      // Function to get the client IP address
      function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
      }

      /*echo "<br>";
      echo get_client_ip();
      echo "<br>";*/


      // sql to create table
      $sql = "CREATE TABLE IF NOT EXISTS MyUsers (
      id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      email VARCHAR(50),
      rand_string VARCHAR(50),
      ip VARCHAR(30),
      flag VARCHAR(30),
      reg_date TIMESTAMP
      )";


      if (mysqli_query($conn, $sql)) {
        echo "Table created successfully";
      }
      else {
        echo "Error creating table: " . mysqli_error($conn);
      }

      // Start

      function checkMail(){
        global $email;
        global $conn;
        echo $email;
      	$sqlll = "SELECT * FROM MyUsers WHERE email='$email'"or exit(mysql_error());
      	$result = mysqli_query($conn, $sqlll);
      	//$numOfRows=mysqli_num_rows($result);

      	$count  = mysqli_num_rows($result);
        echo $count;
		if($count>=1) {
          $message = "Email Exists!!!!!!!!!!!!!!";
		}
      	else {
          $message = "Every thing is good";
        }

      	echo $message;

        if($count>=1) {
          return false;
		}
      	else {
          return true;
        }
      }

      if(checkMail()){
        echo " <br> <br> <br> Check Mail is true <br> <br>";
      }


      if(filter_var($email, FILTER_VALIDATE_EMAIL) && checkMail()){


        $get_ip = get_client_ip();
        $Rand_String = generateRandomString();
        $Link_Auth = "https://anmolthedeveloper.com/email-auth/auth.php?SecretCode=";

        $msg = "Please click the link below to authenticate \n\n" . $Link_Auth . $Rand_String;

        //$msg = "Testing";
        $sql = "INSERT INTO MyUsers (email, rand_string, ip)
        VALUES ('$email', '$Rand_String', '$get_ip')";
        if (mysqli_query($conn, $sql)) {
          mail($email, "E-mail Authentication", $msg);
          echo "We have sent you an confirmation link in your e-mail address";
        }
        else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
        echo "<script>window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = 'https://www.anmolthedeveloper.com/email-auth'; }, 10000);</script>";
      }
      else{
        echo "<br/><br/>";
        echo "Try Again! with a Genuine E-mail Address OR This E-mail '$email' is already been saved in our database so try to check the authenticate";
        mysqli_close($conn);
        echo "<script>window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = 'https://www.anmolthedeveloper.com/email-auth'; }, 10000);</script>";
      }





      // End



    }// end
?>
