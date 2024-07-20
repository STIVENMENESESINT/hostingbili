<?php
// include Database connection file
include("db_connection.php");

// check request
if(isset($_POST))
{
    // get values
    $id = $_POST['id'];
	$idalumno=$_POST['idalumno'];
	$codalumno=$_POST['codalumno'];
   
   
    $obs = strtoupper($_POST['obs']);


    // Updaste User details
    $query = "UPDATE matriculaobs SET idalumno='$idalumno', codalumno='$codalumno', obs = '$obs' WHERE idobs = '$id'";
    if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));
    }
}