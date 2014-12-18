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
	<fieldset class="fielPrograma well">
		<legend>Programas</legend>
		<form id="frmPrograma" method="POST" class=""><!--Formulario para ingresar programas-->
			<table>
				<tr>
					<td><label for="nombre">Nombre Programa:</label></td>
					<td><input type="text" name="nombpro" class="vaciarinput form-control" required /></td>
					<td colspan="2"><input type="submit" value="Guardar" class="btn btn-m btn-success btnAddCot"></td>
				</tr>
			</table>
		</form>
		<div id="contenido">
            <div class="midBox1">
                <br class="clear" />
                    <div class="datagrid">
                    	<div class="form-group has-success">
                    		<form>
                    			<label class="control-label" for="inputSuccess">BUSCAR:</label>
                            	<input id="searchTerm" type="search" onkeyup="doSearch()" class="form-control" placeholder="Programa" />
                       		</form>
						</div>
                        
                        <br />
                        <table id="resultados" class="table">
                            <thead class="thead">
                                <tr>
                                    <th>Nombre Programa</th>
									<th>Acción</th>
                                </tr>
                            </thead>
                            <tbody class='tbProgramas'>
                            	<?php  echo $tabla->programas; ?>
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
	<br>
	<fieldset class="fieldRadio well">
		<legend>Radios</legend>
		<form id="frmRadio" method="POST" class="well"><!--Formulario para ingresar radio-->
			<table>
				<tr>
					<td><label for="nombradio">Nombre Radio:</label></td>
					<td><input type="text" name="txtnombradio" class="vaciarinput form-control" /></td>
					<td colspan="2"><input type="submit" value="Guardar" class="btn btn-m btn-success btnAddCot"></td>
				</tr>
			</table>
		</form>
		<table class="table"><!--Datos de la bd de catalogo radios-->
			<thead class="thead">
				<tr>
					<th>Nombre Radio</th>
					<th>Acción</th>
				</tr>
			</thead>
			<tbody class="tbradio">
				<?php echo $tabla->radio ?>
			</tbody>
		</table>
	</fieldset>
	<fieldset class="fieldPrecio well">
		<legend>Precios</legend>
		<form id="frmPrecio" method="POST" class="well"><!--Formulario para ingresar precio-->
			<table>
				<tr>
					<td><label for="precio">Precio $</label></td>
					<td><input type="text" name="precio" id='txtPrecio' class="soloNumeros vaciarinput form-control" /></td>
					<td colspan="2"><input type="submit" value="Guardar" class="btn btn-m btn-success btnAddCot"></td>
				</tr>
			</table>
		</form>
	<table class="table"><!--Datos de la bd de catalogo precios-->
		<thead class="thead">
			<tr>
				<th>Tarifas</th>
				<th>Acción</th>	
			</tr>
		</thead>
		<tbody class="tbprecios">
			<?php echo $tabla->precio ?>
		</tbody>
	</table>
	</fieldset>
	<fieldset class="fieldServicio well">
		<legend>Servicios</legend>
		<form id="frmServicio" method="POST" class="well"><!--Formulario para ingresar un servicio-->
			<table>
				<tr>
					<td><label for="nombservicio">Nombre Servicio:</label></td>
					<td><input type="text" name="servicio" class="vaciarinput form-control" /></td>
					<td colspan="2"><input type="submit" value="Guardar" class="btn btn-m btn-success btnAddCot"></td>
				</tr>
			</table>
		</form>
		<table class="table"><!--Datos de la bd de catalogo servicios-->
			<thead class="thead">
				<tr>
					<th>Nombre Servicio</th>
					<th>Acción</th>
				</tr>
			</thead>
			<tbody class="tbservicio"><!--esta clase sirve para agregar el nuevo elemento-->
				<?php echo $tabla->servicio ?>
			</tbody>
		</table>
	</fieldset>
	<fieldset class="fieldClientes well">
		<legend>Clientes</legend>
		<form id="frmClientes" method="POST" class="well">
			<table>
				<tr>
					<td><label for="nombcliente">Nombre:</label></td>
					<td><input type="text" name="txtnombcliente" class="vaciarinput form-control"  /></td>
				</tr>
				<tr>
					<td><label for="apellido">Apellido:</label></td>
					<td><input type="text" name="txtapellido" id='txtapellido' class="vaciarinput form-control" /></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" value="Guardar" class="btn btn-m btn-success btnAddCot"></td>
				</tr>
			</table>
		</form>
		<table class="table"><!--Datos de la bd de catalogo clientes-->
			<thead class="thead">
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
	</fieldset>
	<br>
</body>
</html>