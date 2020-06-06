<?php 
	require 'controller/controller.php';
	session_start();

	if (isset($_POST['pengaduan'])) {
		@$data = array(
			"nik" => $_POST['nik'],
			"password" => $_POST['password'],
		    "gambar" => $_FILES['foto']['name'],
		    "tmp" => $_FILES['foto']['tmp_name'],
			"kategori" => $_POST['kategori'],
			"keterangan" => $_POST['keterangan']
		);
		pengaduan($data);
	}

	if (isset($_POST['daftar'])) {
		$data = array(
			'nik' => $_POST['nik'],
			'nama' => $_POST['nama'],
			'username' => $_POST['username'],
			'password' => $_POST['password'],
			'password2' => $_POST['password2'],
			'nosel' => $_POST['nosel']
		);
		daftar($data);
	}
	$data_kategori = view_kategori();

	if (isset($_GET['logout'])) {
		session_destroy();
		session_unset();
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
	<div class="hero">
		<div class="hero-content">
			<div class="row" style="align-items: center; height: 100vh">
				<div class="col-2" style="width: 58%; color: white; text-shadow: 0 1px 1.5px black, 0 1px 1.5px black">
					<h1>Website Pengaduan Masyarakat</h1>
					<h4> Bersama Membangun Lingkungan Agar Lebih Baik <br> </h4>
					<h4> Bersama Berantas Kriminal <br> </h4>
					<h4> Bersama Lawan Hoax </h4><br>
					<a href="login.php" class="btn-style" style="background: #5a87cc; padding: 10px 30px;">Login</a>
					<a href="daftar.php" class="btn-style" style="background: #8009db; padding: 10px 30px;">Daftar</a>
					<a href="#berita" class="btn-style" style="background: #e6b52e; padding: 10px 30px;">Profile</a>
				</div>
				<div class="col-2" style="width: 40%;">
					<div class="card" style="border: none;">
						<div class="card-header" style="padding: 0; background: transparent;">
							<button type="button" onclick="pengaduan()" class="btn" id="btn" style="border-top-left-radius: 3px!important; background: #b51827; color: white">Pengaduan</button>
							<button type="button" onclick="daftar()" class="btn daftar" id="btn" style="border-top-right-radius: 3px!important; border-top-left-radius: 0!important; background: #3972a3;">Registrasi</button>
						</div>
						<div class="card-body" id="pengaduan" style="display: none;">
							<h2 class="text-center m-0"> Formulir Pengaduan </h2>
							<p class="text-center" style="color: red;">
								<?php
									if (isset($_GET['error'])) {
										echo "NIK atau Password anda salah!";
									} elseif (isset($_GET['maximum'])) {
										echo "Anda sudah melebihi batas harian dalam membuat laporan!";
									}elseif (isset($_GET['success'])) {
										echo " <p class='text-center' style='color: limegreen'> Laporan telah berhasil dikirim.. </p>";
									}
								?>
							</p>
							<form action="" method="POST" enctype="multipart/form-data">
								<div class="form-group">
									<?php
										if (@$_SESSION['nik'] == "") {
											echo ""
									?>
									<label for="nik">NIK/KTP <br>
										<input id="nik" class="form-control" type="number" min="0" name="nik" placeholder="NIK/KTP">
									</label>
									<label for="password">Password <br>
										<input id="password" class="form-control" type="password" name="password" placeholder="Password">
									</label>
									<?php ""; } ?>
									<label for="foto">Rincian Gambar <br>
										<input id="foto" class="form-control" type="file" name="foto" accept="image/*">
									</label>
									<label for="kategori">Kategori <br>
										<select id="kategori" class="form-control" name="kategori">
											<?php foreach ($data_kategori as $kategori) { ?>
											<option value="<?php echo $kategori['id_kategori']; ?>"><?php echo ucwords($kategori['kategori']); ?></option>
											<?php } ?>
										</select>
									</label>
									<label for="keterangan">Keterangan <br>
										<textarea id="keterangan" class="form-control" placeholder="Keterangan rinci tempat, kejadian, jam, dll." name="keterangan" style="height: 70px;"></textarea>
									</label>

									<button class="btn-style" style="background: #4d91ff; width: 100%;" type="submit" name="pengaduan">Laporkan</button>
								</div>
							</form>
						</div>
						<div class="card-body" id="daftar">
							<h2 class="text-center m-0"> Registrasi </h2>
							<p class="text-center m-0" style="color: red;">
								<?php
									if (isset($_GET['errregister'])) {
										echo "Akun sudah terdaftar, silahkan login!";
									}elseif (isset($_GET['password'])) {
										echo "Password tidak sama!";
									}elseif (isset($_GET['registration'])) {
										echo " <p class='text-center m-0' style='color: limegreen; margin-top: 5px;'> Registrasi telah berhasil! </p>";
									}
								?>
							</p>
							<form action="" method="POST" enctype="multipart/form-data">
								<div class="form-group">
									<label for="nik">NIK/KTP <br>
										<input id="nik" class="form-control" type="number" min="0" name="nik" placeholder="NIK/KTP">
									</label>
									<label for="nama">Nama Lengkap <br>
										<input id="nama" class="form-control" type="text" name="nama" placeholder="Nama Lengkap">
									</label>
									<label for="username">Username <br>
										<input id="username" class="form-control" type="text" name="username" placeholder="Username">
									</label>
									<label for="password">Password <br>
										<input id="password" class="form-control" type="password" name="password" placeholder="Password">
									</label>
									<label for="password2">Ketik Ulang Password <br>
										<input id="password2" class="form-control" type="password" name="password2" placeholder="Ketik Ulang Password">
									</label>
									<label for="nosel">No Seluler/Whatsapp <br>
										<input id="nosel" class="form-control" type="number" name="nosel" placeholder="No Seluler/Whatsapp">
									</label>
									<button class="btn-style" style="background: #4d91ff; width: 100%;" type="submit" name="daftar">Registrasi</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


<script type="text/javascript" src="js/scriptkit.js"></script>
</body>
</html>