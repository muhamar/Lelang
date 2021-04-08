<div class="container">
	<?php
		echo $this->session->flashdata('pesan');
		unset($_SESSION['pesan']);
	?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar User</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>username</th>
                            <th>Nohp</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($peserta as $psrt) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $psrt['nama']; ?></td>
                                <td><?= $psrt['username']; ?></td>
                                <td><?= $psrt['nohp']; ?></td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#editUserModal<?= $psrt['id_peserta']; ?>" class="btn btn-outline-primary btn-sm"><i class="far fa-edit fa-lg" data-toggle="tooltip" data-placement="top" title="Edit Password Peserta"></i></a>

									<a href="#" data-toggle="modal" data-target="#detailUserModal<?= $psrt['id_peserta']; ?>" class="btn btn-outline-warning btn-sm">
                                        <i class="fas fa-question fa-lg" data-toggle="tooltip" data-placement="top" title="Detail Peserta"></i>
                                    </a>

                                    <a href="<?= base_url('user/hapus/' . $psrt['id_peserta']); ?>" onclick="return confirm('yakin?');" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt fa-lg" data-toggle="tooltip" data-placement="top" title="Hapus Peserta"></i></a>

									
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




<!-- Modal Edit -->
<?php $no = 0; ?>
<?php foreach ($peserta as $psrt) :  $no++ ?>
    <div class="modal fade" id="editUserModal<?= $psrt['id_peserta']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Password <b><?= $psrt['username'] ; ?> </b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('user/edit/' . $psrt['id_peserta']); ?>" method="post">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" id="password" name="password" value="<?= $psrt['password']; ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
<?php endforeach; ?>



<!-- Detail user -->


<?php foreach ($peserta as $psrt) :  ?>
    <div class="modal fade" id="detailUserModal<?= $psrt['id_peserta']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    Nama
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8">
                                    <?= $psrt['nama']; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    Username
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8">
                                    <?= $psrt['username']; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    No Hp
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8">
                                    <?= $psrt['nohp']; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    Alamat
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8">
                                    <?= $psrt['alamat']; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    Password
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-8">
                                    <?= $psrt['password']; ?>
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
