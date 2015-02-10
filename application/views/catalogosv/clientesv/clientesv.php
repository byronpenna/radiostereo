<!DOCTYPE HTML>
<html lang="Es">
<head>
	<?php 
	//cargamos el head
	$this->load->view("estructura/head.php");
	?>
	<script src="<?php echo base_url('resources/js/catalogos/funtion.js')?>" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo base_url('resources/js/catalogos/script.js')?>" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
			$(document).ready(function(){
				//obtener las categorias de los clientes
		getCat();
			});
	</script>
</head>
<body>
	<!--cargamos el menu-->
	<?php  $this->load->view("estructura/menu.php"); ?>
	<div class="container" id="contenedorClientes">
	<div class="popup well posAbsolute"><!--pop up para modificar-->
		
		<table class="table">
			<thead>
				<h3><b>Datos Cliente</b></h3>
			</thead>
			<tbody class='tbClientes2 modificar'>
				
			</tbody>
		</table>
		<table id="contaddprod" >
			<thead>
				<tr>
					<td colspan=2>Productos</td>
					<td></td>
				</tr>
			</thead>
			<tr class='contendorMultiple modalContenedorMultiple' >
				<td >
					<input type="text" name="prod" value="" placeholder="Escribir Producto" id="inprod"></td>
					<td>
						<input type="button" name="" class='btnActionMultiple btn btn-primary btn-sm' direccion='1' value=">" id="addP">
						<input type="button" name="" class='btnActionMultiple btn btn-primary btn-sm' direccion='0' value="<" id="delP">
					</td>
					<td width="1100px">
						<select name="selprod" multiple="multiple" size="10" id="addprod">
						</select>
					</td>
				</tr>
		</table>
	</div>
	<fieldset id="fieldClientes">
		<h3><strong>Clientes</strong></h3>
      	<hr id="hr">
		<button class="btn btn-sm btn-success btnDesplegar"><b>Agregar Nuevo Cliente</b></button>
		<form id="frmClientes" method="POST" class="well">
			<table>
				<tr>
					<td><label for="nombcliente">Nombre:</label></td>
					<td><input type="text" name="txtnombcliente" class="vaciarinput form-control" required /></td>
					<td class="espacio" ><label for="apellido">Razón Social:</label></td>
					<td><input type="text" name="txtapellido" id='txtapellido' class="vaciarinput form-control" required /></td>
				</tr>
				<tr>
					<td><label for="NRC">NRC:</label></td>
					<td><input type="text" name="txtNRC" id='txtNRC' pattern='\d{6}[\-]{1}\d{1}' class="vaciarinput form-control NumNrc SoloNumero" placeholder="000000-0" required /></td>
					<td class="espacio"><label for="NIT">NIT:</label></td>
					<td><input type="text" name="txtNIT" id='txtNIT' pattern="\d{4}[\-]{1}\d{6}[/-]{1}\d{3}[/-]{1}\d{1}" class="vaciarinput SoloNumero form-control NumNit"  placeholder="0000-000000-000-0" required /></td>
				</tr>
				<tr>
					<td><label for="Direccion">Dirección:</label></td>
					<td><input type="text" name="txtDireccion" id='txtDireccion' class="vaciarinput form-control" required /></td>
					<td class="espacio"><label for="Telefono">Telefono:</label></td>
					<td><input type="text" name="txtTelefono" id='txtTelefono' pattern="\d{4}[\-]{1}\d{4}" class="vaciarinput form-control NumTelefono SoloNumero" placeholder="0000-0000" required /></td>
				</tr>
				<tr>
					<td><label for="Contacto">Contacto:</label></td>
					<td><input type="text" name="txtContacto" id='txtContacto' class="vaciarinput form-control" required /></td>
					<td class="espacio"><label for="Correo">Correo:</label></td>
					<td><input type="email" name="txtCorreo" id='txtCorreo' class="vaciarinput form-control" placeholder="ejemplo@gmail.com" required /></td>
				</tr>
				<tr>
					<td><label for="Contacto">Titulo de Contacto:</label></td>
					<td><input type="text" name="txtTitulo" id='txtTitulo' class="vaciarinput form-control" placeholder="Ej:Ingeniero" required /></td>
					<td class="espacio"><label for="txtGiro">Giro:</label></td>
					<td><input type="text" name="txtGiro" id="txtGiro" class="vaciarinput form-control" placeholder="Ej: Actividades Financieras" required /></td>
				</tr>
				<tr>
					<td><label for="Categoria">Categoria : </label></td>
					<td><select name="cat" class=" cat form-control selectBlanco" required></select></td>
				</tr>
				<tr style='display:none'>
					<td><label for="iduser">Id Usuario:</label></td>
					<td><input type="text" name="txtIdUser" class="form-control" value="<?php echo $tabla->id; ?>" required /></td>
				</tr>
				<tr>
					<!-- <td colspan="2"><br><input type="submit" value="Guardar" class="btn btn-m btn-success btnAddCot"></td> -->
				</tr>
			</table>
			<table id="contaddprod" >
			<thead>
				<tr>
					<td colspan=2>Productos</td>
					<td></td>
				</tr>
			</thead>
			<tr class='contendorMultiple' >
				<td >
					<input type="text" name="prod" value="" placeholder="Escribir Producto" id="inprod"></td>
					<td>
						<input type="button" name="" class='btnActionMultiple btn btn-primary btn-sm' direccion='1' value=">" id="addP">
						<input type="button" name="" class='btnActionMultiple btn btn-primary btn-sm' direccion='0' value="<" id="delP">
					</td>
					<td width="1100px">
						<select name="selprod" multiple="multiple" size="10" id="addprod">

						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2"><br><input type="submit" value="Guardar" class="btn btn-m btn-success btnAddCot"></td>
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
							<div class="form-group" style="float:right;">
				              <div class="input-group">
				                <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i> </span>
				                <input id="searchTerm" type="search" onkeyup="doSearch()" class="form-control" placeholder="Buscar Cliente" />
				              </div>
				            </div>
						</form>
						<br />
						<table id="resultados" class="table"><!--Datos de la bd de catalogo clientes-->
							<thead class="thead">
								<tr>
									<th>Nombre</th>
									<th>Razon Social</th>
									<th>NIT</th>
									<th>Titulo</th>
									<th>Acción</th>
								</tr>
							</thead>
							<tbody class='tbClientes'>
								<?php echo $tabla->clientes ?>
								
							</tbody>
						</table>
						<div style="border: 2px;" id="NavPosicion" class="pag text-center"></div>
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
	</div>
</body>
</html>