<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan AABETTA.ID</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <style>
        .line-title {
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
        }
    </style>


</head>

<body>
    <img src="<?= base_url(); ?>assets/img/favicon/logo_png.png" style="position: absolute; width: 120px; height: auto;">
    <table style="width:100%;">
        <tr>
            <td align="center">
                <h4>TOKO IKAN HIAS AABETTA.ID</h4>
                <p>
                    Jl. Borong Indah Ruko no. 78, Kassi-Kassi, <br>
                    Rappocini Kota Makassar, <br>
                    Sulawesi Selatan
                </p>
            </td>
        </tr>
    </table>
    <hr class="line-title">
    <p align="center">LAPORAN PENJUALAN IKAN HIAS AABETTA.ID</p>
    <p align="center"><?php
                        $date = explode('T', $awal);
                        $date = $date[0];
                        $date = explode('-', $date);
                        echo $date[2] . '-' . $date[1] . '-' . $date[0];
                        ?> -
        <?php
        $date = explode('T', $akhir);
        $date = $date[0];
        $date = explode('-', $date);
        echo $date[2] . '-' . $date[1] . '-' . $date[0];


        ?></p>

    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Id pesanan</th>
                <th>Nama Peserta</th>
                <th>Ikan Lelang</th>
                <th>Tanggal Penjualan</th>
                <th>Jumlah Bayar</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($pesanan as $p) : ?>
                <?php if ($p['status_pembayaran'] == 'lunas' && $p['status_pengiriman'] == 'dikirim/selesai') : ?>
                    <tr>
                        <th scope="row"><?= $i++; ?></th>
                        <td><?= $p['id_pesanan']; ?></td>
                        <td><?= $p['nama']; ?></td>
                        <td><?= $p['nama_ikan_hias']; ?></td>
                        <td><?= $p['waktu_pembayaran']; ?></td>
                        <td> <?= "Rp " . number_format($p['jumlah_bayar'], 0, ",", "."); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach ?>
            <tr>
                <th colspan="5">Total Penjualan</th>
                <th><?= "Rp " . number_format($totalPenjualan['jumlah_bayar'], 0, ",", "."); ?>
                </th>
            </tr>
        </tbody>
    </table>

</body>

</html>
