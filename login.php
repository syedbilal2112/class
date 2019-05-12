<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div style="width: 300px;margin:auto;border:1px solid black;padding: 15px">
<div class="alert alert-danger"><?php if(isset($_GET['message'])) {
	echo $_GET['message'];
}?>
</div>
<form action="verify.php" method="post">
	<input type="email" name="email" id="email" class="form-control" placeholder="Enter Email"><br>
	<input type="password" name="password" id="password" class="form-control" placeholder="Enter Password"><br>
	<input type="submit" name="submit" value="Login" class="btn btn-success">
</form>
</div>
</body>
</html>