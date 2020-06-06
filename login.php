<?php 
	require 'controller/controller.php';
	session_start();
	if (isset($_POST['login'])) {
		$data = array("username" => $_POST['username'], "password" => $_POST['password']);
		login($data);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Index | Pengaduan</title>
	<link rel="stylesheet" type="text/css" href="css/stylekit.css">
</head>
<body>
	<div class="container">
		<div class="card shadow" style="width: 30em; margin: auto; padding: 20px; margin-top: 60px;">
			<h2 class="text-center m-0">Selamat Datang</h2>
			<?php
				if (isset($_GET['logerror'])) {
					echo "<p class='text-center' style='color: red; font-size: 15px;'>Akun tidak ditemukan!</p>";
				}
			?>
			<div class="form-group">
				<form action="" method="POST">
					<label for="username">Username <br>
						<input id="username" class="form-control" type="text" name="username" required="required" placeholder="Username">
					</label>
					<label for="password">Password <br>
						<input id="password" class="form-control" type="password" name="password" required="required" placeholder="Password">
					</label>
					<button class="btn btn-style" type="submit" name="login" style="width: 100%; background: #6395e6">Login!</button>
				</form>
			</div>
		</div>
	</div>




<script type="text/javascript" src="js/scriptkit.js"></script>
</body>
</html>