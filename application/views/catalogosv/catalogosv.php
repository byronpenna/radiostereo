<!DOCTYPE HTML>
<html lang="Es">
<head>
	<meta charset="UTF-8">
<<<<<<< HEAD
	<title></title>
=======
	<title>..::Catalogos::..</title>
	<!--linea para cargar el archivo jquery-->
	
	<script type="text/javascript" src=<?php echo "'".base_url("resources/js/jquery-1.11.1.min.js")."'" ?> ></script>
	<!-- <script type="text/javascript" src=<?php echo "'".base_url("resources/page/catalogosv/js/funtion.php")."'";?> > </script>-->
	<!--<script type="text/javascript" src=<?php echo "'".base_url("resources/page/catalogosv/js/script.php")."'";?> > </script>-->
	<script type="text/javascript">
		<?php $this->load->view("catalogosv/js/funtion.php") ?> 
		<?php $this->load->view("catalogosv/js/script.php") ?>
	</script>
	
>>>>>>> origin/InertarDatos
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
	<form id="frmServicio" method="POST">
		<table>
			<tr>
				<td><label for="nombservicio">Nombre Servicio:</label></td>
				<td><input type="text" name="nombservicio" /></td>
			</tr>
			<tr>
					<td colspan="2"><input type="submit" value="Guardar"></td>
			</tr>
		</table>
	</form>
	<form id="frmServicio" method="POST">
		<table>
			<tr>
				<td><label for="nombradio">Nombre Radio:</label></td>
				<td><input type="text" name="nombradio" /></td>
			</tr>
			<tr>
					<td colspan="2"><input type="submit" value="Guardar"></td>
			</tr>
		</table>
	</form>
</body>
</html>