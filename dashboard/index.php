<?php
	require '../controller/controller.php';
	$pengaduan = view_pengaduan();

	if (isset($_GET['delete'])) {
		$id_pengaduan = $_GET['delete'];
		delete_pengaduan($id_pengaduan);
	}

	if (isset($_POST['hapuspilihan'])) {
		@$id_pengaduan = $_POST['id_pengaduan'];
		if ($id_pengaduan > 0) {
			delete_pilihan_pengaduan($id_pengaduan);
		}else {
			echo "<meta http-equiv='refresh', content='0, url=?invalid=data empty'>";
		}
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
			<?php include 'navbar.php'; ?>

			<div class="container pt-20">
				<form action="" method="POST">
				<?php
					if ($pengaduan == 0) {
						echo ""
				?>
					<button class="mb-20 btn btn-style" type="button" onclick="alert('data kosong!')" style="background: red;">Hapus yang ditandai</button>
				<?php
					""; }else { echo ""
				?>
					<button class="mb-20 btn btn-style" type="submit" name="hapuspilihan" onclick="return confirm('Yakin akan menghapus data yang dipilih?')" style="background: red;">Hapus yang ditandai</button>
				<?php ""; } ?>
				<?php
					if (@$_GET['invalid'] == "data empty") {
						echo "<br><span style='color: red;'>Tidak ada data yang dipilih, perintah dibatalkan</span>";
					}elseif (@$_GET['success'] == "mengirim tanggapan") {
						echo "<br><span style='color: limegreen;'>Tanggapan telah dikirim</span>";
					}
				?>
				<table cellspacing="0" style="width: 100%;">
					<thead>
						<tr>
							<th>Pilih</th>
							<th>No</th>
							<th>Nama Lengkap</th>
							<th>Kategori</th>
							<th>Level</th>
							<th>Gambar</th>
							<th>Keterangan</th>
							<th>Waktu</th>
							<th>Status</th>
							<th>Tindakan</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>Pilih</th>
							<th>No</th>
							<th>Nama Lengkap</th>
							<th>Kategori</th>
							<th>Level</th>
							<th>Gambar</th>
							<th>Keterangan</th>
							<th>Waktu</th>
							<th>Status</th>
							<th>Tindakan</th>
						</tr>
					</tfoot>
					<?php
						$no = 1;
						if ($pengaduan == 0) {
							echo "";
						} else {
							foreach ($pengaduan as $p) {
					?>
					<tbody>
						<form>
						<td><input type="checkbox" name="id_pengaduan[]" value="<?php echo $p['id_pengaduan']; ?>"></td>
						<td><?php echo $no++; ?></td>
						<td><?php echo ucwords($p['nama']); ?></td>
						<td style="text-overflow: ellipsis; max-width: 200px; overflow: hidden; white-space: nowrap;"><?php echo ucwords($p['kategori']); ?></td>
						<td><?php echo ucwords($p['level']); ?></td>
						<td><img src="../images/pengaduan/<?php echo $p['foto']; ?>" style="width: 50px;"></td>
						<td style="text-overflow: ellipsis; max-width: 150px; overflow: hidden; white-space: nowrap;"><?php echo ucfirst($p['isi_laporan']); ?></td>
						<td><?php echo $p['tgl_pengaduan']; ?></td>
						<td><?php echo ucwords($p['status']); ?></td>
						<td class="pt-20 pb-20">
							<span class="dropdown card" style="padding: 10px; cursor: pointer">
								Tindakan
								<div class="dropdown-content card">
									<ul>
										<a target="_blank" href="detail.php?id=<?php echo $p['id_pengaduan']; ?>"><li>Lihat Detail</li></a>
										<a target="_blank" href="detail.php?id=<?php echo $p['id_pengaduan']; ?>&tanggapan#tanggapan"><li>Tanggapi</li></a>
										<a href="?delete=<?php echo $p['id_pengaduan']; ?>" onclick="return confirm('Lanjutkan hapus?')"><li>Hapus</li></a>
									</ul>
								</div>
							</span>
						</td>
					</tbody>
					<?php } } ?>
				</table>
				</form>
			</div>

			<footer class="shadow mt-20 p-20 text-center" style="color: rgb(150, 150, 150);">
				&copy;Copyright Alma Prayuda Tahun Ini
			</footer>
		</div>
	</div>


	<script type="text/javascript" src="../js/scriptkit.js"></script>
</body>
</html>