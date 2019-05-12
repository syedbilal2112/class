<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<?php 
		$id  = $_GET['id'];
		include "conn.php";
		$query="SELECT * FROM `users` WHERE `id` = $id";
		$result=mysqli_query($con,$query);
		while($row=mysqli_fetch_assoc($result)){
			$name=$row['name'];
			$email=$row['e-mail'];
			$profile_pic=$row['profile_pic'];
		}
	?>
	<form>
		<input type="hidden" name="id" id="id" value="<?php echo $id?>">
		<input type="text" name="name" placeholder="Enter your name" value="<?php echo $name?>" class="form-control" id="name">
		<input type="email" name="email" placeholder="Enter your email" value="<?php echo $email?>" class="form-control" id="email">
		<input type="button" name="submit" value="Register" class="btn btn-primary" id="button">
	</form>

	<img src="<?php echo $profile_pic?>" id="profile_pic" width="150px" height="150px" style="border-radius: 50%">
    <input type="file" name="files[]" id="file" accept=".jpg" required/>
    <br>
     <button type="button" id="upload_profile_pic" class="btn btn-primary ">Update Pic</button>



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

<script type="text/javascript">
	function call(){
		// alert("success")
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
				$('#file').on('change', function () {
                    var file_data = $('#file').prop('files')[0];
                    var form_data = new FormData();
                    form_data.append('file', file_data);
                    $.ajax({
                        url: 'upload.php', // point to server-side PHP script 
                        dataType: 'text', // what to expect back from the PHP script
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        success: function (response) {
                        
                            alert(response)
                            document.getElementById("profile_pic").src=response;
                            x=response;

                           
                        },
                        error: function (response) {
                          
                           alert(response);
                        }
                    });
               });
    $('#upload_profile_pic').on('click', function () {

                  var id=$("#id").val();
                  var profile=x;
                   
                        $.ajax({
                            url:"update_profile_pic.php",
                            type:"post",
                            data:{
                                "id":id,
                                "profile":profile
                            },
                            success:function(data){
                              alert(data);
                             // window.reload();   
                              },
                              error:function(){
                                alert(';hi');
                              }
                });
                    })
		$('#button').click(function(){
			var id = $('#id').val();
			var name = $('#name').val();
			var email = $('#email').val();
			$.ajax({
				url:'update.php',
				type:'post',
				data:{
					id:id,
					name:name,
					email:email
				},
				success:function(){
					alert("Updated into DB")
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