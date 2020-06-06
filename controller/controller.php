<?php
	include 'koneksi.php';

	function pengaduan($pengaduan) {
		global $koneksi;
		$nik = $pengaduan['nik'];
		$password = $pengaduan['password'];
		$gambar = $pengaduan['gambar'];
		$extension = ['png', 'jpg', 'jpeg', 'img'];
		$explode = explode('.', $gambar);
		$explode = strtolower(end($explode));
		$uniq = uniqid().".".$explode;
		$tmp = $pengaduan['tmp'];
		$kategori = $pengaduan['kategori'];
		$keterangan = $pengaduan['keterangan'];
		$tgl_pengaduan = date("Y-m-d");
		$session_nik = @$_SESSION['nik'];

		$validasi_account = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM `masyarakat` WHERE `nik` = '$nik' AND `password` = '$password' "));
		$validasi_report = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM `pengaduan` WHERE `nik` = '$nik' AND `tgl_pengaduan` = '$tgl_pengaduan'"));
		$validasi_report2 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM `pengaduan` WHERE `nik` = '$session_nik' AND `tgl_pengaduan` = '$tgl_pengaduan'"));

		if ($session_nik == "") {
			if ($validasi_account > 0) {
				if ($validasi_report >= 2) {
					echo "<script>alert('Anda sudah mencapai batas maksimal pembuatan laporan hari ini!')</script>";
					echo "<meta http-equiv='refresh', content='0, url=index.php?maximum=report aborted'>";
				}else {
					move_uploaded_file($tmp, 'images/pengaduan/'.$uniq);
					mysqli_query($koneksi, "INSERT INTO `pengaduan` (`tgl_pengaduan`, `nik`, `isi_laporan`, `foto`, `id_kategori`, `status`) VALUES ('$tgl_pengaduan', '$nik', '$keterangan', '$uniq', '$kategori', 'menunggu tindakan')");
					echo "<script>alert('Terima kasih atas laporannya, laporan kamu akan kami proses setelah lolos validasi!')</script>";
					echo "<meta http-equiv='refresh', content='0, url=index.php?success=report created'>";
				}
			}else {
				echo "<script>window.location.replace('index.php?error=unknown user')</script>";
			}
		}else {
			if ($validasi_report2 >= 2) {
				echo "<script>alert('Anda sudah mencapai batas maksimal pembuatan laporan hari ini!')</script>";
				echo "<meta http-equiv='refresh', content='0, url=index.php?maximum=report aborted'>";
			}else {
				move_uploaded_file($tmp, 'images/pengaduan/'.$uniq);
				mysqli_query($koneksi, "INSERT INTO `pengaduan` (`tgl_pengaduan`, `nik`, `isi_laporan`, `foto`, `id_kategori`, `status`) VALUES ('$tgl_pengaduan', '$session_nik', '$keterangan', '$uniq', '$kategori', 'menunggu tindakan')");
				echo "<script>alert('Terima kasih atas laporannya, laporan kamu akan kami proses setelah lolos validasi!')</script>";
				echo "<meta http-equiv='refresh', content='0, url=index.php?success=report created'>";
			}
		}
	}

	function daftar($daftar) {
		global $koneksi;
		$nik = $daftar['nik'];
		$nama = $daftar['nama'];
		$username = $daftar['username'];
		$password = $daftar['password'];
		$password2 = $daftar['password2'];
		$nosel = $daftar['nosel'];

		$validasi_nik = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM `masyarakat` WHERE `nik` = '$nik'"));
		$validasi_telp = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM `masyarakat` WHERE `telp` = '$nosel'"));
		$validasi_username = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM `masyarakat` WHERE `username` = '$username'"));

		if ($validasi_nik > 0) {
			echo "<script>window.location.replace('index.php?errregister=already exist')</script>";
		}elseif ($validasi_telp > 0) {
			echo "<script>window.location.replace('index.php?errregister=already exist')</script>";
		}elseif ($validasi_username > 0) {
			echo "<script>window.location.replace('index.php?errregister=already exist')</script>";
		}else {
			if ($password != $password2) {
				echo "<script>window.location.replace('index.php?password=not match')</script>";
			}else {
				mysqli_query($koneksi, "INSERT INTO `masyarakat` (`nik`, `nama`, `username`, `password`, `telp`, `status`) VALUES ('$nik', '$nama', '$username', '$password', '$nosel', 'aktif')");
				echo "<script>window.location.replace('index.php?registration=successfully')</script>";
			}
		}
	}

	function view_kategori() {
		global $koneksi;
		$query = mysqli_query($koneksi, "SELECT * FROM `kategori`");
			while ($fquery = mysqli_fetch_array($query)) {
				$result[] = $fquery;
		}
		return $result;
	}

	function view_pengaduan() {
		global $koneksi;
		$query = mysqli_query($koneksi, "
			SELECT
				p.id_pengaduan,
				p.tgl_pengaduan,
				p.status,
				m.nik,
				m.nama,
			    m.telp,
			    p.isi_laporan,
			    p.foto,
			    k.kategori,
			    k.level
			FROM pengaduan p
			INNER JOIN masyarakat AS m
			ON p.nik = m.nik
			INNER JOIN kategori AS k
			ON p.id_kategori = k.id_kategori
			WHERE
			`p`.`status` = 'menunggu tindakan'
			OR
			`p`.`status` = 'selesai'
			ORDER BY `p`.`status` DESC
			");
				while ($fquery = mysqli_fetch_array($query)) {
						$result[] = $fquery;
				}
			return @$result;
	}

	function data_pengaduan_proses() {
		global $koneksi;
		$query = mysqli_query($koneksi, "
			SELECT
				p.id_pengaduan,
				p.tgl_pengaduan,
				p.status,
				m.nik,
				m.nama,
			    m.telp,
			    p.isi_laporan,
			    p.foto,
			    k.kategori,
			    k.level
			FROM pengaduan p
			INNER JOIN masyarakat AS m
			ON p.nik = m.nik
			INNER JOIN kategori AS k
			ON p.id_kategori = k.id_kategori
			WHERE `p`.`status` = 'proses'
			ORDER BY `p`.`id_pengaduan` DESC
			");
		$cek = mysqli_num_rows($query);
			if ($cek > 0) {
				while ($fquery = mysqli_fetch_array($query)) {
						$result[] = $fquery;
				}
			}else {
				$result = "";
			}
			return $result;
	}

	function delete_pengaduan($id_pengaduan) {
		global $koneksi;
		mysqli_query($koneksi, "DELETE FROM `pengaduan` WHERE `id_pengaduan` = '$id_pengaduan' ");
			echo "<script>window.location.replace('?deleting=successfully')</script>";
	}

	function delete_pilihan_pengaduan($id_pengaduan) {
		global $koneksi;
		foreach ($id_pengaduan as $id) {
			mysqli_query($koneksi, "DELETE FROM `pengaduan` WHERE `id_pengaduan` = '$id' ");
			echo "<meta http-equiv='refresh', content='0, url=?deleting=successfully'>";
		}
	}

	function tandai_selesai_pengaduan($id_pengaduan) {
		global $koneksi;
		mysqli_query($koneksi, "UPDATE `pengaduan` SET `status` = 'selesai' WHERE `id_pengaduan` = '$id_pengaduan'");
			echo "<script>window.location.replace('?menandai=data berhasil diubah')</script>";
	}

	function tanggapan_pengaduan($data) {
		global $koneksi;
		$id_pengaduan = $data['id'];
		$tgl = date("Y-m-d");
		$status = $data['status'];
		$tanggapan = $data['tanggapan'];
		$id_petugas = $_SESSION['id_petugas'];
		mysqli_query($koneksi, "UPDATE `pengaduan` SET `status` = '$status' WHERE `id_pengaduan` = '$id_pengaduan' ");
		mysqli_query($koneksi, "INSERT INTO `tanggapan` (`id_pengaduan`, `tgl_tanggapan`, `tanggapan`, `id_petugas`) VALUES ('$id_pengaduan', '$tgl', '$tanggapan', '$id_petugas')");
		echo "<script>alert('Tanggapan telah dikirim..')</script>";
		echo "<meta http-equiv='refresh', content='0, url=index.php?success=mengirim tanggapan'>";
	}

	function login($data) {
		global $koneksi;
		$username = $data['username'];
		$password = $data['password'];
		$query = mysqli_query($koneksi, "SELECT * FROM `masyarakat` WHERE `username` = '$username' AND `password` = '$password' ");
		$rows = mysqli_num_rows($query);

		if ($rows > 0) {
			$array = mysqli_fetch_array($query);

			$_SESSION['nik'] = $array['nik'];
			header("Location: index.php");
		}else {
			header("Location: login.php?logerror=unknown user");
		}

	}

	function login_admin($data) {
		global $koneksi;
		$username = $data['username'];
		$password = $data['password'];
		$query = mysqli_query($koneksi, "SELECT * FROM `petugas` WHERE `username` = '$username' AND `password` = '$password' ");
		$rows = mysqli_num_rows($query);

		if ($rows > 0) {
			$array = mysqli_fetch_array($query);

			$_SESSION['id_petugas'] = $array['id_petugas'];
			header("Location: index.php");
		}else {
			header("Location: ?logerror=unknown user");
		}

	}

	function logout() {
		session_start();
		session_unset();
		session_destroy();
		header("Location: login.php?logout=logout");
	}
?>