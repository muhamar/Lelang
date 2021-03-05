<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Form - Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">

	
	<!-- Favicon -->
	<link rel="shortcut icon" href="<?= base_url(); ?>assets/img/favicon/favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?= base_url(); ?>assets/img/favicon/favicon.ico" type="image/x-icon">

</head>

<body class="bg-light">

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-lg-5">
                <div class="text-center mt-4">
                    <img src="<?= base_url('assets/img/logo.png'); ?>" width="150px">
					<?php
						echo $this->session->flashdata('pesan');
						unset($_SESSION['pesan']);
					?>
                </div>

                <div class="card o-hidden border-0 shadow-lg bg-light ">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Form Login Admin Aabetta.id</h1>
                                    </div>
                                    <form class="user" method="post" action="">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" placeholder="Masukkan Username" name="username">
                                            <small class="form-text text-danger"><?= form_error('username'); ?></small>

                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" placeholder="Password" name="password">
                                            <small class="form-text text-danger"><?= form_error('password'); ?></small>

                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

</body>

</html>
