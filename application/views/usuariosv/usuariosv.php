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
	<fieldset class="well">
		<legend>Usuarios</legend>
		<form id="frmUser" method="POST" class="well" >
			<table>
				<tr>
					<td><label for="usua">Usuario:</label></td>
					<td><input type="text" class="form-control" required /></td>
				</tr>
				<tr>
					<td><label for="pass">Password:</label></td>
					<td><input type="password" class="form-control" required /></td>
				</tr>
				<tr style='display:none'>
					<td><input type="text" value="1" class="form-control" /></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" class="btn btn-m btn-success btnAddCot" value="Guardar" /></td>
				</tr>
			</table>
		</form>
		<table class="table">
		<thead class="thead">
			<th>Usuario</th>
			<th>Password</th>
			<th>Acción</th>
		</thead>
		<tbody>
			<?php 
				echo $tabla->usuarios;
			 ?>
		</tbody>
	</table>
	</fieldset>
	
</body>
</html>