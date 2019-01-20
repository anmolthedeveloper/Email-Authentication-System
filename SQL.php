<?php

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

    /*$sql = "CREATE TABLE test (
    		PersonID INT AUTO_INCREMENT,
    		FirstName VARCHAR(255),
            LastName VARCHAR(255),
            Address VARCHAR(255),
            PRIMARY KEY (PersonID)
            );";*/


	$sql = "INSERT INTO test(FirstName, LastName, Address)
    		VALUES ('" . $_GET['Fname'] . "','" . $_GET['Lname'] . "','" . $_GET['add'] . "');";
    //$result = mysqli_query($conn, $sql);
	//$count  = mysqli_num_rows($result);

	if(mysqli_query($conn, $sql)){
      echo "Successfull!";
    }
	else{
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
?>
