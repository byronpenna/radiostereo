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
	<div class="popup well"><!--pop up para modificar-->
		<table class="table">
			<thead>
				<h3><b>Datos Cliente</b></h3>
			</thead>
			<tbody class='tbClientes2 modificar'>
				
			</tbody>
		</table>
	</div>
	<fieldset class="fieldClientes well" id="fieldClientes">
		<legend>Clientes</legend>
		<form id="frmClientes" method="POST" class="well">
			<table>
				<tr>
					<td><label for="nombcliente">Nombre:</label></td>
					<td><input type="text" name="txtnombcliente" class="vaciarinput form-control" required /></td>
				</tr>
				<tr>
					<td><label for="apellido">Apellido:</label></td>
					<td><input type="text" name="txtapellido" id='txtapellido' class="vaciarinput form-control" required /></td>
				</tr>
				<tr style='display:none'>
					<td><label for="iduser">Id Usuario:</label></td>
					<td><input type="text" name="txtIdUser" class="form-control" value="<?php echo $tabla->id; ?>" required /></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" value="Guardar" class="btn btn-m btn-success btnAddCot"></td>
				</tr>
			</table>
		</form>
		<div id="contenido">
            <div class="midBox1">	
                <div class="midBox1Top">
                    <h3></h3>		 				 
                 </div>
                 	<div class="datagrid">
                        <form>
                            <b> BUSCAR:</b> <input id="searchTerm" type="search" onkeyup="doSearch()" class="form-control" placeholder="Cliente" />
                        </form>
                        <br />
                    	<table id="resultados" class="table"><!--Datos de la bd de catalogo clientes-->
							<thead class="thead">
								<tr>
									<th>Nombre</th>
									<th>Razon Social</th>
									<th>NIT</th>
									<th>Acción</th>
								</tr>
							</thead>
							<tbody class='tbClientes'>
								<?php echo $tabla->clientes ?>
								
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