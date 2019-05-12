<?php

	include 'conn.php';
	$id=$_POST['id'];
	$profile_pic=$_POST['profile'];
	$update="UPDATE `users` SET `profile_pic`='$profile_pic' WHERE `id`='$id' ";
	$update_query=mysqli_query($con,$update);
	if ($update_query) {
		echo "success";
	}else{
		echo "error";
	}
?>