<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php $email=$_GET['email'];
	session_start();
		if(!isset($_SESSION[$email])) { // if already login4
			$message = "session not set";
		   header("location: login.php?message=$message"); // send to home page
		   exit; 
		}
	?>
	<a href="logout.php">Logout</a>
	<form>
		<input type="text" name="name" placeholder="Enter your name" class="form-control" id="name">
		<input type="email" name="email" placeholder="Enter your email" class="form-control" id="email">
		<input type="password" name="password" placeholder="Enter your password" class="form-control" id="password">
		<input type="button" name="submit" value="Register" class="btn btn-primary" id="button">
	</form>
<div class="col-md-4">
	<div class="input-group">
		<input type="text" class="form-control" placeholder="Search for name" id="searchByName">
		<input type="text" class="form-control" placeholder="Search for ID" id="searchById">
		<input type="text" class="form-control" placeholder="Search for Email" id="searchByEmail">
	<span class="input-group-btn">
		<button class="btn btn-default" id="searchBtn" type="button">Go!</button>
	</span>
	</div><!-- /input-group -->
</div>
	<table class="table table-hover" id="tableId">
		<tr>
			<th>
				Id
			</th>
			<th>
				Name
			</th>
			<th>
				Email
			</th>
			<th>
				Action
			</th>
		</tr>
	</table>
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Details</h4>
        </div>
        <div class="modal-body">
          <label> Name</label>
          <input  class="form-control" disabled type="text" id="name1" name="name"><br>
	<label> Email</label>
	<input  class="form-control" disabled type="email" id="email1" name="email"><br>
	<label> Password</label><input  class="form-control" disabled type="password" id="password1" name="password"><br>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>



<script type="text/javascript">
	function dele(id){
		$.ajax({
			url:'delete.php',
			type:'get',
			data:{
				id:id
			},
			success:function(res){
				alert("Deleted")
				call()
           },
			error:function(){
				alert("error")
			}
		})
	}
	function view(id){
		$.ajax({
			url:'viewById.php',
			type:'get',
			data:{
				id:id
			},
			success:function(res){
				var obj=JSON.parse(res);

               $.each(obj,function(index,value){
			 $('#name1').val(value.name);
			 $('#email1').val(value.email);
			 $('#password1').val(value.password);
			$('#myModal').modal('show');
			})
           },
			error:function(){
				alert("error")
			}
		})
		}
	
	function call(){
		$.ajax({
				url:'view.php',
				type:'get',
				data:{

				},
				success: function(response){
					
					var obj=JSON.parse (response);

                        var table_content=""
                        $('#tableId').find( 'tr:not(:first)' ).remove();
                        $.each(obj,function(index,value){
                            table_content+="<tr>";
                            table_content=table_content+"<td>"+value.id+"</td>";
                            table_content+="<td>"+value.name+"</td>";
                            table_content+="<td>"+value.email+"</td>";
                            table_content+="<td>"+value.password+"</td>";
		  table_content+="<td><a class='btn btn-primary' href='edit.php?id="+value.id+"'>Edit</a><button class='btn btn-danger' onclick='dele("+value.id+")'>Delete</button><button class='btn btn-warning' onclick='view("+value.id+")'>View</button></td>";
		                            table_content+="</tr>";
		                        });
		                        $("#tableId").append(table_content);
						},
						error: function(){
							alert('Something went wrong');
						}
					})
	}
	
$(function(){
		$('#searchBtn').click(function(){
			var name = $('#searchByName').val();
			var id = $('#searchById').val();
			var email = $('#searchByEmail').val();
			alert(name+id+email)
			$.ajax({
				url:'search.php',
				type:'get',
				data:{
					name:name,
					id:id,
					email:email
				},
				success: function(response){
					console.log(response)
					var obj=JSON.parse (response);

                        var table_content=""
                        $('#tableId').find( 'tr:not(:first)' ).remove();
                        $.each(obj,function(index,value){
                            table_content+="<tr>";
                            table_content=table_content+"<td>"+value.id+"</td>";
                            table_content+="<td>"+value.name+"</td>";
                            table_content+="<td>"+value.email+"</td>";
                            table_content+="<td>"+value.password+"</td>";
		  table_content+="<td><a class='btn btn-primary' href='edit.php?id="+value.id+"'>Edit</a><button class='btn btn-danger' onclick='dele("+value.id+")'>Delete</button><button class='btn btn-warning' onclick='view("+value.id+")'>View</button></td>";
		                            table_content+="</tr>";
		                        });
		                        $("#tableId").append(table_content);
						},
				error:function(){
					alert("error while searching")
				}
			})
		})


		$('#button').click(function(){
			var name = $('#name').val();
			var email = $('#email').val();
			var password = $('#password').val();
			$.ajax({
				url:'insert.php',
				type:'post',
				data:{
					name:name,
					email:email,
					password:password
				},
				success:function(){
					alert("Inserted into DB")
					call()
				},
				error:function(){
					alert("error while inserting")
				}
			})
		})
	})
	call()
</script>
</body>
</html>