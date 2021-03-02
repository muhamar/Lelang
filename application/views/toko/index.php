<div class="col-lg-12">
	<?php
		echo $this->session->flashdata('pesan');
		unset($_SESSION['pesan']);
	?>
    <!-- Dropdown Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-8">
                    <h5 class="m-0 font-weight-bold text-primary">Tentang Toko</h5>
                </div>
                <div class="col-md-4">
                    <div class="text-right">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal_toko">
                            <i class="fas fa-pen"></i>
                            Update Tentang Toko
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Card Body -->
        <div class="card-body">
            <div class="row mb-4">
                <div class="m-auto">
                    <img src="<?= base_url('assets/img/' . $tentang['gambar']); ?>" width="150px" alt="">
                </div>
            </div>
            <div class="row">
                <?= $tentang['tentang_aabetta']; ?>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal_toko" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Tentang Toko</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url('toko/edit'); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="tentang">Tentang Aabetta.id</label>
                        <textarea class="form-control" id="tentang" rows="6" name="tentang" style="resize:none;"><?= $tentang['tentang_aabetta']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar">
                        <img src="<?= base_url('assets/img/') . $tentang['gambar']; ?>" width="100">
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
