<!DOCTYPE HTML>
<html lang="Es">
<head>
	<?php 
		$this->load->view("estructura/head.php");
	?>
    <script src="<?php echo base_url('resources/js/catalogos/funtion.js')?>" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo base_url('resources/js/catalogos/script.js')?>" type="text/javascript" charset="utf-8"></script>
</head>
<body>
	<?php 
		$this->load->view("estructura/menu.php");
	?>
	<section class="container" style="background:orange;">
		<article class="text-center">
			<?= $res->titulo ?>
		</article>
		<br>
		<table border=1 width="100%"> 
			<?= $res->tabla ?>	
		</table>
		
	</section>
</body>
</html>