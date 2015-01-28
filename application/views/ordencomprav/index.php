<!DOCTYPE HTML>
<html lang="Es">
<head>
	<?php 
		$this->load->view("estructura/head.php");
	?>
	<script src="<?php echo base_url('resources/js/ordencompra/funtion.js')?>" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo base_url('resources/js/ordencompra/script.js')?>" type="text/javascript" charset="utf-8"></script>
</head>
<body>
	<?php 
		$this->load->view("estructura/menu.php");
	?>
	<section class="container" style="background:orange;">
		<article class="text-center">
			<?= $res->titulo ?><br>
			<?= $res->programa ?>
		</article>
		<br>
		<table class='table table-responsive 'border=1 width="100%"> 
			<?= $res->tabla ?>
		</table>
		<button class='btnGuardar'>Guardar</button>
	</section>
</body>
</html>