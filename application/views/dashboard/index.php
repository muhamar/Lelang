<h3>
    Dashboard
</h3>

<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Jumlah User</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800 mb-1"><?= $jumlah_user; ?></div>

                        <a href="<?= base_url('user'); ?>" class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="text-decoration: none;">Detail <i class="fas fa-angle-double-right ml-2"></i> </a>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Jumlah Lelang</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800 mb-1"><?= $jumlah_lelang; ?></div>

                        <a href="<?= base_url('lelang'); ?>" class="text-xs font-weight-bold text-success text-uppercase mb-1" style="text-decoration: none;">Detail <i class="fas fa-angle-double-right ml-2"></i> </a>
                    </div>
                    <div class="col-auto">
                        <i class="far fa-calendar-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Konfirmasi Pesanan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800 mb-1"><?= $jumlah_pesanan_pending; ?></div>

                        <a href="<?= base_url('pesanan'); ?>" class="text-xs font-weight-bold text-warning text-uppercase mb-1" style="text-decoration: none;">Detail <i class="fas fa-angle-double-right ml-2"></i> </a>
                    </div>
                    <div class="col-auto">
                        <i class="far fa-calendar-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Jumlah Pengiriman</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800 mb-1"><?= $jumlah_pengiriman; ?></div>

                        <a href="<?= base_url('pesanan/pengiriman'); ?>" class="text-xs font-weight-bold text-danger text-uppercase mb-1" style="text-decoration: none;">Detail <i class="fas fa-angle-double-right ml-2"></i> </a>
                    </div>
                    <div class="col-auto">
                        <i class="far fa-calendar-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<div class="row">

    <div class="col-md-12">
        <div class="card shadow h-100">
            <div class="card-body">
                <h3 class="text-center text-dark"><b> Selamat Datang Administrator</b></h3>
            </div>
        </div>
    </div>
</div>
