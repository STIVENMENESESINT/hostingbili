<?php
	if(isset($_POST['idalumno']) && isset($_POST['codalumno']) && isset($_POST['obs']))
	{
		// include Database connection file 
		include("db_connection.php");

		// get values 
		$idalumno = $_POST['idalumno'];
		$codalumno = $_POST['codalumno'];
		$codmatri = $_POST['codmatri'];
		$obs = strtoupper($_POST['obs']);

		$query = "INSERT INTO matriculaobs(idalumno, codalumno, codmatri, fecha, obs) VALUES('$idalumno', '$codalumno', '$codmatri', now(), '$obs')";
		if (!$result = mysqli_query($con, $query)) {
	        exit(mysqli_error($con));
	    }
	    echo "1 Record Added!";
	}
?>