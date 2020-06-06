<?php
	session_start();
	if ($_SESSION['id_petugas'] == "") {
		header("Location: login.php?reject=unknown session");
	}

	if (isset($_GET['logout'])) {
		logout();
	}
?>
<nav class="nav-dashboard">
	<ul>
		<a href=""><li>Notification</li></a>
		<a href="?logout=logout" onclick="return confirm('Yakin Logout?')"><li>Logout</li></a>
	</ul>
</nav>