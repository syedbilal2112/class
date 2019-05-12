<?php
	include 'conn.php';
	$name = $_POST['name'];
	$email = $_POST['email'];
	$id = $_POST['id'];
	$query = "UPDATE `users` SET `name` = '$name' , `email` = '$email' WHERE `id` = $id";
	$result = mysqli_query($con,$query);
	if ($result)
	 {
		// header("location: register.html");
		echo "success";
	}

	else{
		echo "error";
	}
?>