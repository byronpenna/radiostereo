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
	</select>
	<fieldset class="fieldClientes well" id="fieldClientes">
		
		<div class="tableUser styleTR">
			<h4 class="thead">Usuarios</h4>
			<?php echo $tabla->usuario; ?>	
		</div>
		<div class="tableRol styleTR">
			<h4 class="thead">Rol</h4>
			<select name="txtRol" class="form-control selectBlanco">
				<?php echo $tabla->rol; ?>
			</select>
		</div>
		<div class="tableRolAsignado styleTR">
			<h4 class="thead">Roles Asignados</h4>
				 <?php //echo $tabla->rol; ?>
		</div>
	</fieldset>
</body>
</html>