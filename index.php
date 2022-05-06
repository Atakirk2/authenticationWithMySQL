<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

?>

<?php 

if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$user_name = $_POST['new_username'];
		$password = $_POST['new_password'];
		$email = $_POST['new_email'];
		$phone_number = $_POST['new_phone_number'];
		$adress = $_POST['new_address'];
		if(!empty($user_name) && !empty($password) && !empty($email) && !empty($phone_number) && !empty($adress) && !is_numeric($user_name) && is_numeric($phone_number)){
			$query = "update users set user_name = '$user_name', password = '$password' where user_id = '$user_data[user_id]'";
			mysqli_query($con, $query);
			$query = "update user_detail set email = '$email', phone_number = '$phone_number', address = '$adress' where user_id = '$user_data[user_id]'";
			mysqli_query($con, $query);
			header("Location: index.php");
			die;
		}
		else{
			echo "Please enter some valid information!";
		}


	}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Database</title>
</head>
<body>

	<a href="logout.php">Logout</a>
	<h1>Hello, <?php echo $user_data['user_name']; ?></h1>

	<br>
	<h2>This is the home page</h4>
	<?php 
	
	include("connection.php");
	$query = "select * from users inner join user_detail on users.user_id = user_detail.user_id";
	$result = mysqli_query($con, $query);
	echo "List of all user's usernames and id's";
	echo "<br>";
	while($row = $result->fetch_array()){
    echo "<b>Username:  </b>".$row['user_name']."  ||  ";
    echo "<b>User ID:  </b>".$row['user_id']."  ||  ";
    echo "<b>Phone number:  </b>".$row['phone_number']."  ||  ";
    echo "<b>Email:  </b>".$row['email']."  ||  ";
    echo "<b>address:  </b>".$row['address']."  ||  ";
	echo "<br>";
}
	?>


	<section>
		<h1>Edit user details</h1>
		<form method="POST">
			<input type="text" name="new_username" placeholder="New username">
			<input type="text" name="new_password" placeholder="New password">
			<input type="text" name="new_phone_number" placeholder="New phone number">
			<input type="text" name="new_email" placeholder="New email">
			<input type="text" name="new_address" placeholder="New address">
			<input type="submit" value="Change">
		</form>
	</section>
</body>
</html>