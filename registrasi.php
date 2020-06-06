<?php 
	require 'controller/controller.php';

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Registrasi | Pengaduan</title>
	<link rel="stylesheet" type="text/css" href="css/stylekit.css">
</head>
<body>
	<div class="container">
		<div class="card">
			<h1 class="text-center">Registrasi</h1>
			<form action="" method="POST">
				<div class="row p-20">
					<div class="col-2">
						<div class="form-group">
							<label for="nama">Nama Lengkap <br>
								<input id="nama" class="form-control" type="text" name="nama" placeholder="Nama Lengkap">
							</label>
							<label for="jk">Jenis Kelamin <br>
								<select id="jk" class="form-control" name="jk">
									<option>Laki-laki</option>
									<option>Perempuan</option>
								</select>
							</label>
							<label for="nosel">No Seluler/Whatsapp <br>
								<input id="nosel" class="form-control" type="number" name="nosel" placeholder="No Seluler/Whatsapp">
							</label>
							<label for="alamat">Alamat Lengkap <br>
								<textarea id="alamat" class="form-control" placeholder="Alamat Lengkap" style="height: 70px;"></textarea>
							</label>
						</div>
					</div>

					<div class="col-2">
						<div class="form-group">
							<label for="email">E-mail <br>
								<input id="email" class="form-control" type="email" name="email" placeholder="@E-mail">
							</label>
							<label for="nik">NIK/KTP <br>
								<input id="nik" class="form-control" type="number" name="nik" placeholder="NIK/KTP">
							</label>
							<label for="nosel">Username <br>
								<input id="nosel" class="form-control" type="number" name="nosel" placeholder="No Seluler/Whatsapp">
							</label>
							<label for="alamat">Alamat Lengkap <br>
								<textarea id="alamat" class="form-control" placeholder="Alamat Lengkap" style="height: 70px;"></textarea>
							</label>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>