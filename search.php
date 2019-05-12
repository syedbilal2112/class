<?php 
	include "conn.php";
	$name = $_GET['name'];
	$id = $_GET['id'];
	$email = $_GET['email'];
	if($id == ''){
		$id=0;
	}
	$query="SELECT * FROM `users` WHERE `name` = '$name' OR `e-mail` = '$email' OR `id` = $id";
	$result=mysqli_query($con,$query);
	$json_data=array();
	while($row=mysqli_fetch_assoc($result)){
		$json_data[]=$row;
	}
	echo json_encode($json_data);
 ?>