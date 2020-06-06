<?php
	include 'koneksi.php';
	Class MyUserClass {

	   public function getUser($id){
	        global $koneksi;
			$query = mysqli_query($koneksi, "
				SELECT
					p.id_pengaduan,
					p.tgl_pengaduan,
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
				WHERE `id_pengaduan` = '$id'
				");
	        return $query;
	   }

	}
?>