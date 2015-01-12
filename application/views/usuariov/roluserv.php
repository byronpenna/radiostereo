<!DOCTYPE HTML>
<html lang="Es">
<head>
	<?php 
	//cargamos el head
		$this->load->view("estructura/head.php");
	?>
</head>
<body>
	<!--cargamos el menu-->
	<?php 
		$this->load->view("estructura/menu.php");
	?>
	
	<fieldset class="fieldClientes well" id="fieldClientes">
                    	<table id="resultados" class="table"><!--Datos de la bd de catalogo clientes-->
							<thead class="thead">
								
							</thead>
							<tbody class='tbClientes'>
								<?php //echo $tabla->clientes ?>
								<h1>Rol Usuario</h1>
							</tbody>
						</table>
	</fieldset>
</body>
</html>