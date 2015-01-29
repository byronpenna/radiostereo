<!DOCTYPE HTML>
<html lang="Es">
<head>
	<?php 
	//cargamos el head
		$this->load->view("estructura/head.php");
	?>
	<script src="<?php echo base_url('resources/js/catalogos/funtion.js')?>" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo base_url('resources/js/catalogos/script.js')?>" type="text/javascript" charset="utf-8"></script>
</head>
<body>
	<!--cargamos el menu-->
	<?php 
		$this->load->view("estructura/menu.php");
	?>
	</select>

	<div class="container" id="contenedorClientes">
	<fieldset id="fieldClientes">
		<article class="rolClientes">
		<div class="tableUser styleTR">
			<h4 class="thead">Usuarios</h4>
			<table class="table">
				<?php echo $tabla->usuario; ?>	
			</table>
		</div>
		<div class="tableRol styleTR">
			<h4 class="thead">Rol</h4>
			<select name="txtRol" class="form-control selectBlanco">
				<?php echo $tabla->rol; ?>
			</select>
			<div class="text-right">
				<input type="submit" name="" value="Asignar" class="btn btn-m btn-success" id="asignRol">
			</div>
		</div>
		</article>
		
		<div class="tableRolAsignado styleTR">
			<h4 class="thead">Roles Asignados</h4>
				<table class="tabla-roles-asignados">
					<tbody>
					<?php echo $tabla->rolesAsignados; ?>
					</tbody>
				</table>
		</div>
	</fieldset>
</div>
</body>
</html>