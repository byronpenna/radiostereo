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
	<div><!--Mostramos el mensaje retornado-->
		<h2 class="mensaje"></h2>
	</div>
	<form id="frmPrograma" method="POST"><!--Formulario para ingresar programas-->
		<table>
			<tr>
				<td><label for="nombre">Nombre Programa:</label></td>
				<td><input type="text" name="nombpro" class="vaciarinput" /></td>
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
			<?php  echo $tabla->programas; ?>
		</tbody>
	</table><br>
	
	<form id="frmPrecio" method="POST"><!--Formulario para ingresar precio-->
		<table>
			<tr>
				<td><label for="precio">Precio $</label></td>
				<td><input type="text" name="precio" id='txtPrecio' class="soloNumeros vaciarinput" /></td>
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
			<?php echo $tabla->precio ?>
		</tbody>
	</table><br>
	<form id="frmServicio" method="POST"><!--Formulario para ingresar un servicio-->
		<table>
			<tr>
				<td><label for="nombservicio">Nombre Servicio:</label></td>
				<td><input type="text" name="servicio" class="vaciarinput" /></td>
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
		<tbody class="tbservicio"><!--esta clase sirve para agregar el nuevo elemento-->
			<?php echo $tabla->servicio ?>
		</tbody>
	</table><br>
	<form id="frmRadio" method="POST"><!--Formulario para ingresar radio-->
		<table>
			<tr>
				<td><label for="nombradio">Nombre Radio:</label></td>
				<td><input type="text" name="txtnombradio" class="vaciarinput" /></td>
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
		<tbody class="tbradio">
			<?php echo $tabla->radio ?>
		</tbody>
	</table><br>
	<form id="frmClientes" method="POST">
		<table>
			<tr>
				<td><label for="nombcliente">Nombre:</label></td>
				<td><input type="text" name="txtnombcliente" class="vaciarinput"  /></td>
			</tr>
			<tr>
				<td><label for="apellido">Apellido:</label></td>
				<td><input type="text" name="txtapellido" id='txtapellido' class="vaciarinput" /></td>
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
	</table><br>
</body>
</html>