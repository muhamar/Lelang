<div class="container">
	<?php
		echo $this->session->flashdata('pesan');
		unset($_SESSION['pesan']);
	?>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<h5 class="m-0 font-weight-bold text-primary">Daftar Penjualan</h5>
				</div>
			</div> <br>
			<div class="row">
				<div class="col-md-12 col-sm-12 text-left">
					<form action="" id="formLaporan" method="POST">
						<div class="row">
							<div class="col-md-5 col-sm-12 ">
								<p>Tanggal Awal :</p>
								<input type="datetime-local" class="form-control" name="awalTanggal" required>
							</div>
							<div class="col-md-5 col-sm-12">
								<p>Tanggal Akhir :</p>
								<input type="datetime-local" class="form-control" name="akhirTanggal" required>
							</div>
							<div class="col-md-2 col-sm-12">
								<p></p><br>
								<button type="submit" class="btn btn-primary">Unduh Laporan</button>
							</div>
							<!-- <div class="col-md-5 col-sm-12">
                                <a href="<?= base_url('laporan/unduhLaporanFilter'); ?>" class="btn btn-info">
                                    <i class="fas fa-file-download"></i>
                                    Unduh Semua Laporan</a>
                            </div> -->
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No</th>
							<th>Id pesanan</th>
							<th>Nama Peserta</th>
							<th>Ikan Lelang</th>
							<th>Jumlah Bayar</th>
							<th>Status Pembayaran</th>
							<th>Tanggal Penjualan</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach ($pesanan as $pm) : ?>
						<?php if ($pm['status_pembayaran'] == 'lunas' && $pm['status_pengiriman'] == 'dikirim/selesai') : ?>
						<tr>
							<th scope="row"><?= $i++; ?></th>
							<td><?= $pm['id_pesanan']; ?></td>
							<td><?= $pm['nama']; ?></td>
							<td><?= $pm['nama_ikan_hias']; ?></td>
							<td><?= $pm['jumlah_bayar']; ?></td>
							<td><?= $pm['status_pembayaran']; ?></td>
							<td><?= $pm['waktu_pembayaran']; ?></td>
						</tr>
						<?php endif; ?>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
