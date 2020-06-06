<?php
	$koneksi = mysqli_connect("localhost", "root", "", "ujikom");

	if ($koneksi) {
		echo "";
	}else {
		echo "gagal";
	}
?>