<!DOCTYPE HTML>
<html lang="Es">
<head>
	<?php 
		$this->load->view("estructura/head.php");
	?>
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
		<table border=1 width="100%"> 
			<?= $res->tabla ?>
		</table>
		
	</section>
</body>
</html>