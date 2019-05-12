<?php
	include 'conn.php';
	$email = $_POST['email'];
	$password = $_POST['password'];
	$query="SELECT password FROM `users` WHERE `e-mail`='$email'";
	session_start();
	$result=mysqli_query($con,$query);
	$row=mysqli_fetch_row($result);
   	$DbPassword=$row[0];
   	if(password_verify($password, $DbPassword)){
   		$_SESSION[$email]=$email; 
   		header("location: index.php?email=$email");
   	}
   else{
   	$message="Not right password or email address";
   		header("location: login.php?message=$message");
   	
   }
   	
   	
?>