<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="cache-control" content="max-age=0" />
  <meta http-equiv="cache-control" content="no-cache" />
  <meta http-equiv="expires" content="0" />
  <meta http-equiv="pragma" content="no-cache" />
  <meta name="description" content="Created by AnmolTheDeveloper">
  <meta name="twitter:card" content="summary">

  <meta itemprop="name" content="E-mail Authentication System">
  <meta itemprop="url" content="https://www.anmolthedeveloper.com/email-auth">
  <meta itemprop="description" content="Created by AnmolTheDeveloper">
  <meta itemprop="image" content="https://www.anmolthedeveloper.com/email-auth/image/email.jpg">
  <meta name="description" content="Created by AnmolTheDeveloper">

  <meta property="og:title" content="E-mail Authentication System">
  <meta property="og:url" content="https://www.anmolthedeveloper.com/email-auth">
  <meta property="og:description" content="Created by AnmolTheDeveloper">
  <meta property="og:image" content="https://www.anmolthedeveloper.com/email-auth/image/email.jpg">
  <meta property="og:type" content="Website">
  <meta property="og:site_name" content="E-mail Authentication System">
  <meta property="og:locale" content="en_US">


  <meta name="twitter:title" content="E-mail Authentication System">
  <meta name="twitter:url" content="https://www.anmolthedeveloper.com/email-auth">
  <meta name="twitter:description" content="Created by AnmolTheDeveloper">
  <meta name="twitter:image" content="https://www.anmolthedeveloper.com/email-auth/image/email.jpg">
  <meta name="twitter:site" content="@anmolDdeveloper">


  <link rel="icon" href="https://www.anmolthedeveloper.com/email-auth/image/programmingicon.png" type="image/x-icon">
  <title>E-mail Authentication System</title>
  <link rel="stylesheet" type="text/css" href="style.css">

  <?php
  	if(isset($_POST['Check'])){
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

      	$VARII = $_POST["email_auth"];
      	$Flag = "TRUE";
      	$sql = "SELECT * FROM MyUsers WHERE email='$VARII' AND flag='TRUE'"or exit(mysql_error());
      	$result = mysqli_query($conn, $sql);
      	$numOfRows=mysqli_num_rows($result);

      	//$count  = mysqli_num_rows($result);
		if($numOfRows==1) {
			$message = "You are successfully authenticated!";
		}
      	else {
          $message = "Not! yet authenticated";
        }

      echo "$message";

		mysqli_close($conn);
    }
  ?>
</head>
<body>
  <header>
    <h1>E-mail Authentication System</h1>
  </header>
  <center>
  	<div class="login">
      	<p>Authenticate E-mail Address</p>
    	<form method="POST" action="login.php">
  			<input type="text" name="email" placeholder="E-mail">
  			<br><br><br>
  			<input type="submit" value="submit" name="submit">
		</form>
   	</div>
    <p id="result_p"></p>
    <div class="check">
      	<p>Check Authenticate Process</p>
    	<form method="POST" action="?">
  			<input type="text" name="email_auth" placeholder="E-mail">
  			<br><br><br>
  			<input type="submit" value="Check" name="Check">
		</form>
   	</div>
  </center>
  <footer>Created by AnmolTheDeveloper</footer>
</body>
</html>
