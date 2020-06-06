<?php
	require '../controller/controller.php';
	session_start();
	if ($_SESSION['id_petugas'] == "") {
		header("Location: login.php?reject=unknown session");
	}

	$id = $_GET['id'];
	$detail_pengaduan = mysqli_fetch_array(mysqli_query($koneksi, "SELECT p.id_pengaduan, p.status, p.tgl_pengaduan, m.nik, m.nama, m.telp, p.isi_laporan, p.foto, k.kategori, k.level FROM pengaduan p INNER JOIN masyarakat AS m ON p.nik = m.nik INNER JOIN kategori AS k ON p.id_kategori = k.id_kategori WHERE `id_pengaduan` = '$id' AND `status` = 'menunggu tindakan' "));

	if (isset($_POST['tanggapi'])) {
		$id = $_GET['id'];
		if (!isset($_POST['status'])) {
			header("Location: detail.php?id=$id&tanggapan=tanggapan&error=data empty#tanggapan");
		} else {
			$data = array(
				"id" => $id,
				"status" => $_POST['status'],
				"tanggapan" => $_POST['tanggapan']
			);
			tanggapan_pengaduan($data);
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Detail | Dashboard</title>
</head>
<link rel="stylesheet" type="text/css" href="../css/stylekit.css">
<body>
	<div class="container" style="width: 50%;">
		<div class="card m-20">
			<div class="card-header text-center" style="background: transparent;">
				<h1 style="margin-top: 5px;">Laporan</h1>
				<img src="../images/pengaduan/<?php echo $detail_pengaduan['foto']; ?>" style="border-radius: 3px; max-height: 20em; width: 15em; object-fit: contain; object-position: center">
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col" style="width: 25%; margin-bottom: 0;">
						<p class="m-0" style="width: 90%;">NIK Pengadu <span style="text-align: right; float: right;">:</span> </p>
					</div>
					<div class="col-2" style="width: 75%;">
						<?php echo $detail_pengaduan['nik']; ?>
					</div>
				</div>

				<div class="row mt-20">
					<div class="col" style="width: 25%; margin-bottom: 0;">
						<p class="m-0" style="width: 90%;">Nama Pengadu <span style="text-align: right; float: right;">:</span> </p>
					</div>
					<div class="col-2" style="width: 75%;">
						<?php echo ucwords($detail_pengaduan['nama']); ?>
					</div>
				</div>

				<div class="row mt-20">
					<div class="col" style="width: 25%; margin-bottom: 0;">
						<p class="m-0" style="width: 90%;">No Seluler <span style="text-align: right; float: right;">:</span> </p>
					</div>
					<div class="col-2" style="width: 75%;">
						+<?php echo $detail_pengaduan['telp']; ?>
					</div>
				</div>

				<div class="row mt-20">
					<div class="col" style="width: 25%; margin-bottom: 0;">
						<p class="m-0" style="width: 90%;">Kategori <span style="text-align: right; float: right;">:</span> </p>
					</div>
					<div class="col-2" style="width: 75%;">
						<?php echo ucwords($detail_pengaduan['kategori']); ?>
					</div>
				</div>

				<div class="row mt-20">
					<div class="col" style="width: 25%; margin-bottom: 0;">
						<p class="m-0" style="width: 90%;">Level <span style="text-align: right; float: right;">:</span> </p>
					</div>
					<div class="col-2" style="width: 75%;">
						<?php echo ucwords($detail_pengaduan['level']); ?>
					</div>
				</div>

				<div class="row mt-20">
					<div class="col" style="width: 25%; margin-bottom: 0;">
						<p class="m-0" style="width: 90%;">Keterangan <span style="text-align: right; float: right;">:</span> </p>
					</div>
					<div class="col-2" style="width: 75%; line-height: 20px;">
						<?php echo ucfirst($detail_pengaduan['isi_laporan']); ?>
					</div>
				</div>

				<div class="row mt-20">
					<div class="col" style="width: 25%; margin-bottom: 0;">
						<p class="m-0" style="width: 90%;">Tanggal <span style="text-align: right; float: right;">:</span> </p>
					</div>
					<div class="col-2" style="width: 75%;">
						<?php echo ucwords($detail_pengaduan['tgl_pengaduan']); ?>
					</div>
				</div>

				<div class="row mt-20">
					<div class="col" style="width: 25%; margin-bottom: 0;">
						<p class="m-0" style="width: 90%;">Status <span style="text-align: right; float: right;">:</span> </p>
					</div>
					<div class="col-2" style="width: 75%;">
						<?php echo ucwords($detail_pengaduan['status']); ?>
					</div>
				</div>
			</div>
			<?php
				if (isset($_GET['tanggapan'])) {
					echo ""
			?>
				<div class="card-footer" id="tanggapan" style="background: transparent; border-top: .5px solid #ccc; padding-top: 0!important; color: black;">
					<h2 class="text-center">Tanggapan</h2>
					<?php
						if (isset($_GET['error'])) {
							echo "<p class='text-center' style='color: red;'> Tanggapan gagal dikirimkan, mohon isi data dengan benar </p>";
						}
					?>
					<div class="form-group">
						<form action="" method="POST">
							<label for="status">Status <br>
								<select id="status" required="required" class="form-control" name="status">
									<option selected="selected" disabled="disabled"><?php echo ucwords($detail_pengaduan['status']); ?></option>
									<option value="proses">Proses</option>
									<option value="ditolak">Tolak</option>
								</select>
							</label>
							<label for="tanggapan">Tanggapan <br>
								<textarea id="tanggapan" class="form-control" name="tanggapan" placeholder="Beri tanggapan.." style="height: 70px;" required="required"></textarea>
							</label>
							<button class="btn btn-style" type="submit" name="tanggapi" style="width: 100%;">Tanggapi</button>
						</form>
					</div>
				</div>
			<?php ""; } else { echo "" ?>
				<div class="card-footer" style="background: transparent;">
					<a href="?id=<?php echo $_GET['id']; ?>&tanggapan=tanggapan#tanggapan" class="btn btn-style" style="display: block;">Tanggapi</a>
				</div>
			<?php ""; } ?>
		</div>
	</div>





	<script type="text/javascript" src="../js/scriptkit.js"></script>
</body>
</html>