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
	<fieldset class="fieldClientes well" id="fieldClientes">
		<article class="rolClientes">
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
		</article>
		<input type="submit" name="" value="Asignar" class="btn btn-m btn-success" id="asignRol">
		<div class="tableRolAsignado styleTR">
			<h4 class="thead">Roles Asignados</h4>
				<table class="tabla-roles-asignados">
					<tbody>
					<?php echo $tabla->rolesAsignados; ?>
					</tbody>
				</table>
		</div>
	</fieldset>
</body>
</html>