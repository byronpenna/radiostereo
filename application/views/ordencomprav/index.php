<!DOCTYPE HTML>
<html lang="Es">
<head>
	<?php 
		$this->load->view("estructura/head.php");
	?>
	<script src="<?php echo base_url('resources/js/ordencompra/functions.js')?>" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo base_url('resources/js/ordencompra/script.js')?>" type="text/javascript" charset="utf-8"></script>
</head>
<body>
	<?php 
		$this->load->view("estructura/menu.php");
	?>
	<section class="container">
		<div class="panel panel-primary">
		  <div class="panel-heading text-center"><h2> <?= $res->titulo ?><br><small><?= $res->programa ?></small></h2></div>
			<table class='table table-responsive table-bordered'border=1 width="100%"> 
				<?= $res->tabla ?>
			</table>
			<div class="text-right"><button class='btnGuardar btn btn-success'>Guardar</button></div>
		</div>
	</section>
</body>
</html>