<div class="container">
	<?php
		echo $this->session->flashdata('pesan');
		unset($_SESSION['pesan']);
	?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pesanan</h6>
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
                            <th>Status Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($pesanan as $pm) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $pm['id_pesanan']; ?></td>
                                <td><?= $pm['nama']; ?></td>
                                <td><?= $pm['nama_ikan_hias']; ?></td>
                                <td><?= $pm['status_pembayaran']; ?></td>
                                <td>

                                    <a href="#" data-toggle="modal" data-target="#updatepesanan<?= $pm['id_pesanan']; ?>" class="btn btn-outline-primary btn-sm"><i class="far fa-edit fa-lg" data-toggle="tooltip" data-placement="top" title="Update Pesanan"></i></a>

                                    <a href="#" data-toggle="modal" data-target="#lihatBuktiBayar<?= $pm['id_pesanan']; ?>" class="btn btn-outline-success btn-sm"><i class="far fa-file-image fa-lg" data-toggle="tooltip" data-placement="top" title="Bukti Pembayaran"></i></a>

                                    <a href="#" data-toggle="modal" data-target="#detailPesananModal<?= $pm['id_pesanan']; ?>" class="btn btn-outline-warning btn-sm"><i class="far fa-question-circle fa-lg" data-toggle="tooltip" data-placement="top" title="Detail Pesanan"></i></a>

                                    <a href="<?= base_url('pesanan/hapusPesanan/' . $pm['id_pesanan']); ?>" onclick="return confirm('yakin?');" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt fa-lg" data-toggle="tooltip" data-placement="top" title="Hapus Pesanan"></i></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>






<!-- Modal Bukit pesanan -->
<?php foreach ($pesanan as $pm) : ?>
    <div class="modal fade" id="lihatBuktiBayar<?= $pm['id_pesanan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lihat Bukti Bayar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="container text-center">
                                <?php if ($pm['bukti_gambar']) : ?>
                                    <img src="<?= base_url('assets/upload/' . $pm['bukti_gambar']); ?>" alt="" width="350px">
                                <?php else : ?>
                                    Tidak ada gambar !
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>

                </div>

            </div>
        </div>
    </div>

<?php endforeach; ?>




<!-- Modal Update pesanan -->
<?php foreach ($pesanan as $pm) : ?>
    <div class="modal fade" id="updatepesanan<?= $pm['id_pesanan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Status Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('pesanan/updatepesanan/' . $pm['id_pesanan']); ?>" method="post">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="status_pembayaran">Status Pembayaran</label>
                                    <select class="form-control" id="status_pembayaran" name="status_pembayaran">
                                        <?php foreach ($status as $sts) : ?>
                                            <?php if ($sts == $pm['status_pembayaran']) : ?>
                                                <option value="<?= $sts; ?>" selected><?= $sts; ?></option>
                                            <?php else : ?>
                                                <option value="<?= $sts; ?>"><?= $sts; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
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





<!-- Modal Detail -->
<?php foreach ($pesanan as $pm) :  ?>
    <div class="modal fade" id="detailPesananModal<?= $pm['id_pesanan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    Id Pesanan
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8">
                                    <?= $pm['id_pesanan']; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    Nama Peserta
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8">
                                    Rp. <?= $pm['nama']; ?>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    Ikan Lelang
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8">
                                    <?= $pm['nama_ikan_hias']; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    Jumlah Bayar
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8">
                                    <?= "Rp " . number_format($pm['jumlah_bayar'], 0, ",", "."); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    Status Pembayaran
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8">
                                    <?= $pm['status_pembayaran']; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    Status Pengiriman
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8">
                                    <?= $pm['status_pengiriman']; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    Waktu Pembayaran
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8">
                                    <?= $pm['waktu_pembayaran']; ?>
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
