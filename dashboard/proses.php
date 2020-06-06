<?php
	require '../controller/controller.php';
	$pengaduan_proses = data_pengaduan_proses();

	if (isset($_GET['delete'])) {
		$id_pengaduan = $_GET['delete'];
		delete_pengaduan($id_pengaduan);
	}

	if (isset($_GET['selesai'])) {
		$id_pengaduan = $_GET['selesai'];
		tandai_selesai_pengaduan($id_pengaduan);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Index | Dashboard</title>
</head>
<link rel="stylesheet" type="text/css" href="../css/stylekit.css">
<body>
	<div class="wrapper">
		<?php include 'sidebar.php' ?>
		<div class="db-container">
		<?php include 'navbar.php' ?>

			<div class="container pt-20">
				<div class="row" style="justify-content: space-between;">
					<div class="col" style="cursor: pointer; margin-bottom: 5px;">
						<div class="card p-20">
							Data Proses
						</div>
					</div>
					<div class="col" onclick="btn_reload()" style="cursor: pointer; margin-bottom: 5px;">
						<div class="card p-20">
							Refresh
						</div>
					</div>
				</div>

				<div id="onload_table">
					<?php include 'tb_proses.php'; ?>
				</div>
			</div>

			<footer class="shadow mt-20 p-20 text-center" style="color: rgb(150, 150, 150);">
				&copy;Copyright Alma Prayuda Tahun Ini
			</footer>
		</div>
	</div>


	<script type="text/javascript" src="../js/scriptkit.js"></script>
</body>
</html>