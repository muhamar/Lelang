<div class="container">

    <?= $this->session->flashdata('pesan'); ?>
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
                            <th>Alamat</th>
                            <th>Password</th>
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
                                <td><?= $psrt['alamat']; ?></td>
                                <td><?= $psrt['password']; ?></td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#editUserModal<?= $psrt['id_peserta']; ?>" class="btn btn-outline-primary btn-sm"><i class="far fa-edit fa-lg" data-toggle="tooltip" data-placement="top" title="Update Peserta"></i></a>

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








<!-- Modal -->
<?php $no = 0; ?>
<?php foreach ($peserta as $psrt) :  $no++ ?>
    <div class="modal fade" id="editUserModal<?= $psrt['id_peserta']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Peserta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('user/edit/' . $psrt['id_peserta']); ?>" method="post">
                        <!-- <input type="hidden" name="id" value="<?= $psrt['id_peserta']; ?>"> -->
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $psrt['nama']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="username">username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= $psrt['username']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nohp">NoHp</label>
                            <input type="text" class="form-control" id="nohp" name="nohp" value="<?= $psrt['nohp']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $psrt['alamat']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" id="password" name="password" value="<?= $psrt['password']; ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
<?php endforeach; ?>