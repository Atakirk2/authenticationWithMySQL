<?php 

session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];
		
		//This part is for the sql injection prevention 
		$user_name = stripcslashes($user_name);
		$password = stripcslashes($password);
		$user_name = mysqli_real_escape_string($con, $user_name);
		$password = mysqli_real_escape_string($con, $password);

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			$query = "select * from users where user_name = '$user_name' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{
						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: index.php");
						die;
					}
				}
			}
			
			echo "WRONG USER INFORMATION!";
		}else
		{
			echo "WRONG USER INFORMATION!";
		}
	}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
</head>

<body>



    <style type="text/css">
        .text {

            height: 25px;
            border-radius: 5px;
            padding: 4px;
            border: solid thin #aaa;
            width: 100%;
        }

        #button {

            padding: 10px;
            width: 100px;
            color: white;
            background-color: lightblue;
            border: none;
        }

        #box {

            background-color: #95aff5;
            margin: auto;
            width: 300px;
            padding: 20px;
        }
    </style>
    <div id="box">

        <form method="POST">
            <div style="font-size: 20px;margin: 10px;color: white;">Log in</div>
            <input class="text" type="text" name="user_name" placeholder="Username">
            <br>
            <br>
            <input class="text" type="password" name="password" placeholder="Password">
            <br>
            <br>
            <input id="button" type="submit" value="Log in">
            <br>
            <br>
            Dont you have an account? <a href="signup.php">Click to Sign up</a>
            <br>
            <br>
        </form>
    </div>
</body>

</html>