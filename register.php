<?php

include 'includes/functions.php';
session_start();

if (isset($_SESSION['username'])) 
{
  header("Location: index.php");
}

if (isset($_POST['submit'])) 
{
  	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$confirm = md5($_POST['confirm']);

    if ($password == $confirm) 
    {
		$sql = "INSERT INTO users (username, email, password , permission) VALUES ('$username', '$email', '$password', 'Member')";
		$result = mysqli_query($db, $sql);
		if ($result) 
		{
			echo "<script>alert('Register Completed.')</script>";
			$username = "";
			$email = "";
			$_POST['password'] = "";
			$_POST['confirm'] = "";
		} 
		else 
		{
		echo "<script>alert('Woops! Something Wrong Went.')</script>";
		}
      	 
      	
    }
    else 
    {
      echo "Password Not Matched";
    } 
  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Register</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/my-login.css">
</head>
<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Register</h4>
							<form method="POST" action="register.php">
								<div class="form-group">
									<label for="username">Username</label>
									<input id="username" type="text" class="form-control" name="username" required autofocus>
								</div>

								<div class="form-group">
									<label for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control" name="email" required>
								</div>

								<div class="form-group">
									<label for="password">Password</label>
									<input id="password" type="password" class="form-control" name="password" required data-eye>
								</div>

								<div class="form-group">
									<label for="password">Confirm Password</label>
									<input id="password" type="password" class="form-control" name="confirm" required data-eye>
								</div>

								<div class="form-group m-0">
									<button type="submit" name="submit" class="btn btn-primary btn-block">
										Register
									</button>
								</div>
								<div class="mt-4 text-center">
									Already have an account? <a href="login.php">Login</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
</html>