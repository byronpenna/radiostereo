<!DOCTYPE HTML>
<html lang="Es">
<head>
	<meta charset="UTF-8">
	<title>..::Catalogos::..</title>
	<!--linea para cargar el archivo jquery-->
	<script type="text/javascript" src=<?php echo "'".base_url("resources/js/jquery-1.11.1.min.js")."'" ?> ></script>
	<!-- <script type="text/javascript" src=<?php echo "'".base_url("resources/page/catalogosv/js/funtion.php")."'";?> > </script>-->
	<!--<script type="text/javascript" src=<?php echo "'".base_url("resources/page/catalogosv/js/script.php")."'";?> > </script>-->
	<script type="text/javascript">
		<?php $this->load->view("catalogosv/js/funtion.php") ?> //cargamos el archivo q contiene las funciones
		<?php $this->load->view("catalogosv/js/script.php") ?>//cargamos el archivo q contiene los script
	</script>
	
</head>
<body>
	<form id="frmPrograma" method="POST">
		<table>
			<tr>
				<td><label for="nombre">Nombre Programa:</label></td>
				<td><input type="text" name="nombpro" /></td>
			</tr>
			<tr>
					<td colspan="2"><input type="submit" value="Guardar"></td>
			</tr>
		</table>
	</form>
		<table border="2px"><!--Datos de la bd de catalogo programa-->
		<thead>
			<tr>
				<th>Nombre Programa</th>
				<th>Acción</th>
			</tr>
		</thead>
		<tbody>
			<?php echo $tabla->programas; ?>
		</tbody>
	</table>
	
	<form id="frmPrecio" method="POST">
		<table>
			<tr>
				<td><label for="precio">Precio $</label></td>
				<td><input type="text" name="precio" /></td>
			</tr>
			<tr>
					<td colspan="2"><input type="submit" value="Guardar"></td>
			</tr>
		</table>
	</form>
	<table border="2px" rules="all">
		<thead>
			<tr>
				<th>Precio</th>
				<th>Acción</th>	
			</tr>
		</thead>
		<tbody>
			<?php echo $tabla->radios ?>
		</tbody>
	</table>
	<form id="frmServicio" method="POST">
		<table>
			<tr>
				<td><label for="nombservicio">Nombre Servicio:</label></td>
				<td><input type="text" name="servicio" /></td>
			</tr>
			<tr>
					<td colspan="2"><input type="submit" value="Guardar"></td>
			</tr>
		</table>
	</form>
	<table border="2px" rules="all">
		<thead>
			<tr>
				<th>Nombre Servicio</th>
				<th>Acción</th>
			</tr>
		</thead>
		<tbody>
			<?php echo $tabla->servicio ?>
		</tbody>
	</table>
	<form id="frmRadio" method="POST">
		<table>
			<tr>
				<td><label for="nombradio">Nombre Radio:</label></td>
				<td><input type="text" name="txtnombradio" /></td>
			</tr>
			<tr>
					<td colspan="2"><input type="submit" value="Guardar"></td>
			</tr>
		</table>
	</form>
	<table border="2px" rules="all">
		<thead>
			<tr>
				<th>Nombre Radio</th>
				<th>Acción</th>
			</tr>
		</thead>
		<tbody>
			<?php echo $tabla->radio ?>
		</tbody>
	</table>
	<div>
		<h2 class="mensaje"></h2>
	</div>
</body>
</html>