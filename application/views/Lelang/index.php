
<div class="container">

	<?php
		echo $this->session->flashdata('pesan');
		unset($_SESSION['pesan']);
	?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-8">
                    <h5 class="m-0 font-weight-bold text-primary">Daftar Lelang</h5>
                </div>
                <div class="col-md-4">
                    <div class="text-right">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahLelangModal">
                            <i class="fas fa-plus"></i>
                            Tambah Lelang
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Ikan Hias</th>
                            <th>Harga Buka</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($lelang as $l) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $l['nama_ikan_hias']; ?></td>
                                <td> <?= "Rp " . number_format($l['harga_buka'], 0, ",", "."); ?></td>
                                <td>
									<?php 
										date_default_timezone_set('Asia/Makassar');
										$waktuSekarang = date('Y-m-d H:i:s');
										$waktuSelesaiLelang = $l['waktu_selesai'];
										$waktuMulaiLelang = $l['waktu_mulai'];
										if($waktuSekarang > $waktuSelesaiLelang){
											echo "Ditutup";
										}else if($waktuSekarang > $waktuMulaiLelang){
											echo "Berlangsung";
										}else{
											echo "Akan Datang";
										}
									?>
                                </td>
                                <td>

                                    <a href="#" data-toggle="modal" data-target="#editLelangModal<?= $l['id_lelang']; ?>" class="btn btn-outline-primary btn-sm">
                                        <i class="far fa-edit fa-lg" data-toggle="tooltip" data-placement="top" title="Update Lelang"></i>
                                    </a>


                                    <a href="#" data-toggle="modal" data-target="#tawarModal<?= $l['id_lelang']; ?>" class="btn btn-outline-success btn-sm">
                                        <i class="fas fa-list-ul fa-lg" data-toggle="tooltip" data-placement="top" title="Daftar Tawaran"></i>
                                    </a>


                                    <a href="#" data-toggle="modal" data-target="#detailLelangModal<?= $l['id_lelang']; ?>" class="btn btn-outline-warning btn-sm">
                                        <i class="fas fa-question fa-lg" data-toggle="tooltip" data-placement="top" title="Detail Lelang"></i>
                                    </a>
<!-- 
                                    <a href="<?= base_url('lelang/hapus/' . $l['id_lelang']); ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('yakin?');">
                                        <i class="far fa-trash-alt fa-lg" data-toggle="tooltip" data-placement="top" title="Hapus Pengiriman"></i>
                                    </a> -->
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>





<!-- Modal Tambah Lelang -->

<div class="modal fade" id="tambahLelangModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Lelang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('lelang/tambah/'); ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama Ikan Hias</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Ikan Hias" required>
                            </div>
                        </div>
                        <div class="col-md-6">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="harga">Harga Buka/Awal</label>
										<input type="number" class="form-control" id="harga" name="harga_buka" placeholder="Rp." required>
                            		</div>	
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="kelipatan">Kelipatan</label>
										<input type="number" class="form-control" id="kelipatan" name="kelipatan" placeholder="Rp." required>
                            		</div>	
								</div>
							</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="gambar">Gambar</label>
                                <input type="file" class="form-control" id="gambar" name="gambar" required> <br>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="deskripsi">Deskrips</label>
                                <textarea class="form-control" id="deskripsi" rows="4" name="deskripsi" style="resize:none;" placeholder="Deskripsi Ikan Hias" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mulai">Waktu Mulai</label>
                                <input type="datetime-local" class="form-control" id="mulai" name="waktu_mulai" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="selesai">Waktu Selesai</label>
                                <input type="datetime-local" class="form-control" id="selesai" name="waktu_selesai" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>




<!-- Modal Detail -->
<?php foreach ($lelang as $l) :  ?>
    <div class="modal fade" id="detailLelangModal<?= $l['id_lelang']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Lelang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    Nama Ikan Hias
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8">
                                    <?= $l['nama_ikan_hias']; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    Harga Buka/Awal
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8">
                                    <?= "Rp " . number_format($l['harga_buka'], 0, ",", "."); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
					<div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                   Kelipatan Tawaran
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8">
                                    <?= "Rp " . number_format($l['kelipatan'], 0, ",", "."); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    Gambar
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8">
                                    <img src="<?= base_url('assets/img/' . $l['gambar']); ?>" alt="" width="130px">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    Deskripsi
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8">
                                    <?= $l['deskripsi']; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    Status
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8">
								<?php 
										$waktuSekarang = date('Y-m-d h-m-s');
										$waktuSelesaiLelang = $l['waktu_selesai'];

										if($waktuSekarang > $waktuSelesaiLelang){
											echo "Ditutup";
										}else{
											echo "Dibuka";
										}
									?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    Waktu Mulai
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8">
                                    <?= $l['waktu_mulai']; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    Waktu Selesai
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8">
                                    <?= $l['waktu_selesai']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>



<!-- Modal Edit -->
<?php $no = 0; ?>
<?php foreach ($lelang as $l) :  $no++ ?>
    <div class="modal fade" id="editLelangModal<?= $l['id_lelang']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Lelang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('lelang/edit/' . $l['id_lelang']); ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $l['nama_ikan_hias']; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="harga">Harga Buka/Awal</label>
										<input type="number" class="form-control" id="harga" name="harga_buka" value="<?= $l['harga_buka'];?>">
                            		</div>	
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="kelipatan">Kelipatan</label>
										<input type="number" class="form-control" id="kelipatan" name="kelipatan" value="<?= $l['kelipatan'];?>">
                            		</div>	
								</div>
							</div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gambar">Gambar</label>
                                    <input type="file" class="form-control" id="gambar" name="gambar" value="<?= $l['gambar']; ?>"> <br>
                                    <img src="<?= base_url('assets/img/' . $l['gambar']); ?>" width="100px" alt="">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="deskripsi">Deskrips</label>
                                    <textarea class="form-control" id="deskripsi" rows="6" name="deskripsi" style="resize:none;"><?= $l['deskripsi']; ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mulai">Waktu Mulai</label>
                                    <input type="datetime-local" class="form-control" id="mulai" name="waktu_mulai" value="<?= date('Y-m-d\TH:i:s', strtotime($l['waktu_mulai'])); ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="selesai">Waktu Selesai</label>
                                    <input type="datetime-local" class="form-control" id="selesai" name="waktu_selesai" value="<?= date('Y-m-d\TH:i:s', strtotime($l['waktu_selesai'])); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
<?php endforeach; ?>






<!-- Modal Tawar -->
<?php foreach ($lelang as $l) :  ?>
    <div class="modal fade" id="tawarModal<?= $l['id_lelang']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Daftar Tawar Lelang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Peserta</th>
                                <th scope="col">Tawaran</th>
                                <th scope="col">Waktu Penawaran</th>
                            </tr>
                        </thead>
                        <?php
                        $query = "SELECT * FROM tawaran INNER JOIN peserta ON tawaran.id_peserta = peserta.id_peserta INNER JOIN lelang ON tawaran.id_lelang = lelang.id_lelang  WHERE tawaran.id_lelang = '$l[id_lelang]' ORDER BY harga_tawar DESC,  waktu_penawaran ASC ";
                        $tawar = $this->db->query($query)->result_array();
                        ?>

                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($tawar as $twr) : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $twr['nama']; ?></td>
                                    <td><?= $twr['harga_tawar']; ?></td>
                                    <td><?= $twr['waktu_penawaran']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
