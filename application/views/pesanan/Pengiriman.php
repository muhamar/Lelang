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
                    <h5 class="m-0 font-weight-bold text-primary">Daftar Pengiriman</h5>
                </div>
                <div class="col-md-4">
                    <div class="text-right">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahPengiriman">
                            <i class="fas fa-plus"></i>
                            Tambah Pengiriman
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
                            <th>Id pesanan</th>
                            <th>Status Pengiriman</th>
                            <th>Nomor Resi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($pengiriman as $p) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $p['id_pesanan']; ?></td>
                                <td><?= $p['status_pengiriman']; ?></td>
                                <td><?= $p['nomor_resi']; ?></td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#editPengiriman<?= $p['id_pengiriman']; ?>" class="btn btn-outline-primary btn-sm"><i class="far fa-edit fa-lg" data-toggle="tooltip" data-placement="top" title="Update Pengiriman"></i></a>

                                    <a href="<?= base_url('pesanan/hapusPengiriman/' . $p['id_pengiriman']); ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('yakin?');"><i class="far fa-trash-alt fa-lg" data-toggle="tooltip" data-placement="top" title="Hapus Pengiriman"></i></a>

                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>








<!-- Modal Tambah Pengiriman -->

<div class="modal fade" id="tambahPengiriman" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pengiriman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('pesanan/tambahPengiriman'); ?>" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="status_pesanan">Id pesanan</label>
                                <select class="form-control" id="status_pesanan" name="id_pesanan" required>
                                    <?php foreach ($pesanan_lunas as $pl) : ?>
                                        <option value="<?= $pl['id_pesanan']; ?>"><?= $pl['id_pesanan']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nama">Nomor Resi</label>
                                <input type="text" class="form-control" id="nama" name="nomor_resi" placeholder="Masukkan Nomor Resi" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="status">Status Pengiriman</label><br>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="status" value="dikirim/selesai" name="status_pengiriman" required>
                                    <label class="form-check-label" for="status">
                                        Dikirim
                                    </label>
                                </div>
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




<!-- Modal Edit Pengiriman -->
<?php foreach ($pengiriman as $p) : ?>
    <div class="modal fade" id="editPengiriman<?= $p['id_pengiriman']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Pengiriman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('pesanan/editPengiriman/' . $p['id_pengiriman']); ?>" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama">Nomor Resi</label>
                                    <input type="text" class="form-control" id="nama" name="nomor_resi" placeholder="Masukkan Nomor Resi" value="<?= $p['nomor_resi']; ?>" required>
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
