<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>AABETTA.ID - Home</title>
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="<?= base_url(); ?>assets/img/favicon/favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?= base_url(); ?>assets/img/favicon/favicon.ico" type="image/x-icon">

	<!-- CSS -->
	<style>
		body{
			background-image: url('http://localhost/SKRIPSI_Lelang/assets/img/landingpage/background.png');
			background-size: cover;
			background-repeat: no-repeat;
		}
		img{
			width: 100%;
			margin-top: 54px;
		}
		
		#teks{
			margin-top: 100px;
		}
		

		/* DOWNLOAD */
		.download h3{
			font-family: 'Roboto mono semibold';
			letter-spacing: 3px;
			color: black;
			font-weight: bold;
			font-size: 40px;
		}
		.download{
			margin-top: 200px;
		}
		.download p{
			color: black;
		}
		section .row .unduh{
			border-radius: 50px;
			width: 195px;
			height: 50px;
			line-height: 30px;
			background-color: #e10f00;
			border: 2px solid transparent;
			color: #ffff;
			font-size: 18px;
			font-weight: bold;
			transition: 0.5s;
		}
		section .download .unduh:hover{
			background-color: transparent;
			color: #e10f00;
			border: 2px solid #e10f00;
		}

		/* AABETTA */
		h1{
			font-family: 'Roboto mono semibold';
			letter-spacing: 5px;
			color: #fff;
			font-weight: bold;
			font-size: 60px;
		}
		p{
			font-family: 'Corbel';
			letter-spacing: 1px;
			word-spacing: 2px;
			line-height: 31px;
			color: #fff;
			font-size: 18px;
		}

		section .row .admin{
			border-radius: 50px;
			width: 195px;
			height: 50px;
			line-height: 30px;
			background-color: transparent;
			border: 2px solid #ffff;
			color: #ffff;
			font-size: 18px;
			font-weight: bold;
			transition: 0.5s;
		}
		section .text .admin:hover{
			background-color: #ffff;
			color: #e10f00;
			border: 2px solid transparent;
		}
		section .row .hubAdmin{
			border-radius: 50px;
			width: 195px;
			height: 50px;
			line-height: 30px;
			background-color: #ffff;
			border: 2px solid transparent;
			color: #e10f00;
			font-size: 18px;
			font-weight: bold;
			transition: 0.5s;
		}
		section .text .hubAdmin:hover{
			background-color: transparent;
			color: #ffff;
			border: 2px solid #ffff;
		}
		

		/* --- PRELOADER ---*/
		.preloader {
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			z-index: 9999;
			background-color: #ffffff;
		}
		.preloader .loading {
			position: absolute;
			left: 50%;
			top: 50%;
			transform: translate(-50%, -50%);
			font: 14px arial;
		}
		.preloader .loading img{
			width: 150px;
		}

		@media (max-width: 768px){
			#andorid{
				width: 400px;
				padding: 5px;
			}
			#teks{
				margin: 0;
			}
			#teks .download{
				margin-top: 0;
				padding: 15px;
			}

			p,h1{
				color: black;
			}

			section .row .admin{
			border-radius: 50px;
			width: 195px;
			height: 50px;
			line-height: 30px;
			background-color: transparent;
			border: 2px solid #e10f00;
			color: #e10f00;
			font-size: 18px;
			font-weight: bold;
			transition: 0.5s;
		}
		section .text .admin:hover{
			background-color: #e10f00;
			color: #ffff;
			border: 2px solid transparent;
		}
		section .row .hubAdmin{
			border-radius: 50px;
			width: 195px;
			height: 50px;
			line-height: 30px;
			background-color: #e10f00;
			border: 2px solid transparent;
			color: #ffff;
			font-size: 18px;
			font-weight: bold;
			transition: 0.5s;
		}
		section .text .hubAdmin:hover{
			background-color: transparent;
			color: #e10f00;
			border: 2px solid #e10f00;
		}
			
		}

	</style>

	</head>
	<body>
		<!-- <div class="preloader">
			<div class="loading">
				<img src="<?= base_url(); ?>assets/img/landingpage/loader.gif">
			</div>
		</div> -->

	<section>
		<div class="row no-gutters">
			<div class="col-lg-4" id="andorid">
				<img src="<?= base_url('assets/img/landingpage/android.png'); ?>" alt="">
			</div>
			<div class="col-lg-8" id="teks">
				<div class="row no-gutters">
					<div class="col-md-4 download pr-3">
						<h3>Download</h3>
						<p>Peserta lelang dapat mendownload aplikasi aabetta berbasis android pada tombol di bawah ini:</p>
						<a href="#" class="btn unduh">Unduh</a>
					</div>
					<div class="col-md-8 pl-4 text-right pr-3 text">
						<h1>AABETTA.ID</h1>
						<p>Aabetta.id merupakan salah satu toko penjualan ikan hias dengan konsep pelelangan online di kota Makassar,untuk tokonya sendiri berlokasi di Jl. Borong Indah Ruko No.78, Kecamatan Rappocini, Kelurahan Kassi-Kassi. Aabetta.id berdiri pada tahun 2020, dimana toko tersebut telah menjual lebih dari 100 ikan hias. Salah satu penghargaan yang telah di peroleh dari toko Aabetta.id yaitu telah meraih penghargaan sebagai juara umum di salah satu kontes beta yang di adakan di kota Makassar.</p>
						<a href="<?= base_url('login'); ?>" class="btn admin mr-2">Admin Area</a>
						<a href="https://api.whatsapp.com/send?phone=6281244828616&text=Halo admin, saya perlu bantuan untuk mereset password saya" class="btn hubAdmin">Hubungi Admin</a>

					</div>

				</div>
			</div>
			
		</div>

	</section>

		<!-- PRELOADER -->
		

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
		<script>
			$(document).ready(function(){
			$(".preloader").delay(2500).fadeOut();
			})

		</script>
	</body>
</html>
