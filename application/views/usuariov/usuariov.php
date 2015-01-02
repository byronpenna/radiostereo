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
	<fieldset class="fieldClientes well" id="fieldUser">
		<legend>Usuarios</legend>
		<form id="frmMantoUser" method="POST" class="well"><!--Formulario para ingresar programas-->
			<table>
				<tr>
					<td><label for="usua">Usuario:</label></td>
					<td><input type="text" name="txtuser" class="vaciarinput form-control" required /></td>
				</tr>
				<tr>
					<td><label for="contra">Password:</label></td>
					<td><input type="password" name="txtpassword" class="vaciarinput form-control" required /></td>
				</tr>
				<tr style='display:none'>
					<td><label for="idcomp">Id Compañía:</label></td>
					<td><input type="text" name="txtIdCompania" class="form-control" value="1" required /></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" value="Guardar" class="btn btn-m btn-success btnAddCot"></td>
				</tr>
			</table>
		</form>
		<div id="contenido">
                <div class="midBox1">
                    <div class="datagrid">
                        <form>
                            <b> BUSCAR:</b> <input id="searchTerm" type="search" onkeyup="doSearch()" class="form-control" placeholder="Usuario" />
                        </form>
                        <br />
                        <table id="resultados" class="table">
                            <thead class="thead">
                                <tr>
                                   <th>Usuario</th>
                                   <th>Password</th>
									<th>Acción</th>
                                </tr>
                            </thead>
                            <tbody class="tbUsuario">
                               <?php  echo $tabla->usuario; ?>
                            </tbody>
                        </table>
                        <div style="border: 2px;" id="NavPosicion"></div>
                    </div>
                    <script type="text/javascript">
                    var pager = new Pager('resultados', 10);
                    pager.init();
                    pager.showPageNav('pager', 'NavPosicion');
                    pager.showPage(1);
                                    </script>
                </div>
            </div>
	</fieldset>
</body>
</html>