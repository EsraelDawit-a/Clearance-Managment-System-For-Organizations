<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
<title>Clearance Managment System Login</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<!-- <script src="https://kit.fontawesome.com/a81368914c.js"></script> -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>


	<img class="wave" src="img/wave.png">
	<div class="container">
		<div class="img">
			<img src="img/bg.svg">
		</div>
		<div class="login-content">

		
			<form action="./controller/userLoginController.php" method="POST">
				<img src="img/avatar.svg">

				<?php if (isset($_GET['error'])) { ?>
					<div class="message">
						<h5>
							<p class="error"><?php echo $_GET['error']; ?></p>
				</h5>
					</div>
				<?php } ?>


				<h2 class="title">Welcome</h2>

				<div class="input-div one">
					<div class="i">
						<i class="fas fa-user"></i>
					</div>
					<div class="div">
						<h5>Username</h5>
						<input type="text" name="username" class="input">
					</div>
				</div>
				<div class="input-div pass">
					<div class="i">
						<i class="fas fa-lock"></i>
					</div>
					<div class="div">
						<h5>Password</h5>
						<input type="password" name="password" class="input">
					</div>
				</div>
				<a href="#">Forgot Password?</a>
				<button type="submit" class="btn">Login</button>
			</form>

		</div>
	</div>
	<script type="text/javascript" src="js/main.js"></script>
</body>

</html>