<?php 
session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$phone_number = $_POST['phone_number'];
		$address = $_POST['address'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name) && is_numeric($phone_number))
		{
			$user_id = random_num(20);
			$query = "insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')";

			mysqli_query($con, $query);

			$query = "insert into user_detail (email,phone_number,address,user_id) values ('$email','$phone_number','$address','$user_id')";
			mysqli_query($con, $query);
			header("Location: login.php");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
</head>
<body>
    


<style type="text/css">
	
	.text{

		height: 25px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 100%;
	}

	#button{

		padding: 10px;
		width: 100px;
		color: white;
		background-color: lightblue;
		border: none;
	}

	#box{

		background-color: #a76af7;
		margin: auto;
		width: 300px;
		padding: 20px;
	}

	</style>
    <div id="box">
		
		<form method="post">
			<div style="font-size: 20px;margin: 10px;color: white;">Sign up</div>
			<input class="text" type="text" name="user_name" placeholder= "Username">
            <br>
            <br>
			<input class="text" type="email" name="email" placeholder= "E-mail">
            <br>
            <br>
			<input class="text" type="password" name="password" placeholder= "Password">
            <br>
            <br>
            <input class="text" type="password" name="password2" placeholder= "Confirm Password">
            <br>
            <br>
			<input class="text" type="text" name="phone_number" placeholder= "Phone Number">
            <br>
            <br>
			<input class="text" type="textfield" name="address" placeholder= "Address">
            <br>
            <br>
			<input id="button" type="submit" value="Sign Up">
            <br>
            <br>
			Already have an account? <a href="login.php">Click to log in</a>
            <br>
            <br>
		</form>
	</div>
</body>
</html>