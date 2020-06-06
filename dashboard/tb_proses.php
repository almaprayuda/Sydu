				<table id="pukul" cellspacing="0" style="width: 100%;">
					<thead>
						<tr>
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
						if ($pengaduan_proses == 0) {
							echo "";
						} else {
							foreach ($pengaduan_proses as $p) {
					?>
					<tbody>
						<td><?php echo $no++; ?></td>
						<td><?php echo ucwords($p['nama']); ?></td>
						<td style="text-overflow: ellipsis; max-width: 200px; overflow: hidden; white-space: nowrap;"><?php echo ucwords($p['kategori']); ?></td>
						<td><?php echo ucwords($p['level']); ?></td>
						<td><img src="../images/pengaduan/<?php echo $p['foto']; ?>" style="width: 50px;"></td>
						<td style="text-overflow: ellipsis; max-width: 150px; overflow: hidden; white-space: nowrap;"><?php echo ucfirst($p['isi_laporan']); ?></td>
						<td><?php echo $p['tgl_pengaduan']; ?></td>
						<td><?php echo ucwords($p['status']); ?></td>
						<td>
							<span class="dropdown card" style="padding: 10px; cursor: pointer">
								Tindakan
								<div class="dropdown-content card" style="left: -178px;">
									<ul>
										<a target="_blank" href="tanggapan.php?id=<?php echo $p['id_pengaduan']; ?>"><li>Lihat Tanggapan</li></a>
										<a href="?selesai=<?php echo $p['id_pengaduan']; ?>" onclick="return confirm('Tandai telah selesai?')"><li>Tandai telah selesai</li></a>
									</ul>
								</div>
							</span>
						</td>
					</tbody>
					<?php } } ?>
				</table>