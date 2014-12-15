<!DOCTYPE HTML>
<html lang="Es">
<head>
	
	<script type="text/javascript" src=<?php echo "'".base_url("resources/js/jquery-1.11.1.min.js")."'" ?> ></script>
	<!-- <script type="text/javascript" src=<?php echo "'".base_url("resources/page/catalogosv/js/funtion.php")."'"; ?> > </script>-->
	<!--<script type="text/javascript" src=<?php echo "'".base_url("resources/page/catalogosv/js/script.php")."'"; ?> > </script>-->
	<script type="text/javascript">
		<?php $this->load->view("catalogosv/js/funtion.php"); ?> //cargamos el archivo q contiene las funciones
		<?php $this->load->view("catalogosv/js/script.php"); ?>//cargamos el archivo q contiene los script
	</script>
	
</head>
<body>
	<div><!--Mostramos el mensaje retornado-->
		<h2 class="mensaje"></h2>
	</div>
	<form id="frmPrograma" method="POST"><!--Formulario para ingresar programas-->
		<table>
			<tr>
				<td><label for="nombre">Nombre Programa:</label></td>
				<td><input type="text" name="nombpro" /></td>
				<td colspan="2"><input type="submit" value="Guardar"></td>
			</tr>
		</table>
	</form>
		<table border="2px" rules="all"><!--Datos de la bd de catalogo programa-->
		<thead>
			<tr>
				<th>Nombre Programa</th>
				<th>Acción</th>
			</tr>
		</thead>
		<tbody class='tbProgramas'>
			<?php echo $tabla->programas; ?>
		</tbody>
	</table>
	
	<form id="frmPrecio" method="POST"><!--Formulario para ingresar precio-->
		<table>
			<tr>
				<td><label for="precio">Precio $</label></td>
				<td><input type="text" name="precio" id='txtPrecio' /></td>
				<td colspan="2"><input type="submit" value="Guardar"></td>
			</tr>
		</table>
	</form>
	<table border="2px" rules="all"><!--Datos de la bd de catalogo precios-->
		<thead>
			<tr>
				<th>Precio</th>
				<th>Acción</th>	
			</tr>
		</thead>
		<tbody class="tbprecios">
			<?php echo $tabla->radios ?>
		</tbody>
	</table>
	<form id="frmServicio" method="POST"><!--Formulario para ingresar un servicio-->
		<table>
			<tr>
				<td><label for="nombservicio">Nombre Servicio:</label></td>
				<td><input type="text" name="servicio" /></td>
				<td colspan="2"><input type="submit" value="Guardar"></td>
			</tr>
		</table>
	</form>
	<table border="2px" rules="all"><!--Datos de la bd de catalogo servicios-->
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
	<form id="frmRadio" method="POST"><!--Formulario para ingresar radio-->
		<table>
			<tr>
				<td><label for="nombradio">Nombre Radio:</label></td>
				<td><input type="text" name="txtnombradio" /></td>
				<td colspan="2"><input type="submit" value="Guardar"></td>
			</tr>
		</table>
	</form>
	<table border="2px" rules="all"><!--Datos de la bd de catalogo radios-->
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
	<form id="frmClientes" method="POST">
		<table>
			<tr>
				<td><label for="nombcliente">Nombre:</label></td>
				<td><input type="text" name="txtnombcliente" /></td>
			</tr>
			<tr>
				<td><label for="apellido">Apellido:</label></td>
				<td><input type="text" name="txtapellido" id='txtapellido'/></td>
			</tr>
			<tr>
					<td colspan="2"><input type="submit" value="Guardar"></td>
			</tr>
		</table>
	</form>
	<table border="2px" rules="all"><!--Datos de la bd de catalogo clientes-->
		<thead>
			<tr>
				<th>Nombre cliente</th>
				<th>Apellido cliente</th>
				<th>Acción</th>
			</tr>
		</thead>
		<tbody class='tbClientes'>
			<?php echo $tabla->clientes ?>
		</tbody>
	</table>
</body>
</html>