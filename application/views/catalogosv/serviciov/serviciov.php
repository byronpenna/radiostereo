<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php 
		$this->load->view("estructura/head.php");
	?>
	<script src="<?php echo base_url('resources/js/catalogos/funtion.js')?>" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo base_url('resources/js/catalogos/script.js')?>" type="text/javascript" charset="utf-8"></script>
</head>
<body>
	<?php 
		$this->load->view("estructura/menu.php");
	?>
	<fieldset class="fieldServicio well" id="fieldServicio">
		<legend>Servicios</legend>
		<form id="frmServicio" method="POST" class="well"><!--Formulario para ingresar un servicio-->
			<table>
				<tr>
					<td><label for="nombservicio">Nombre Servicio:</label></td>
					<td><input type="text" name="servicio" class="vaciarinput form-control" required /></td>
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
                    <b> BUSCAR:</b> <input id="searchTerm" type="search" onkeyup="doSearch()" class="form-control" placeholder="Servicio" />
                </form>
                <br />
		<table class="table" id="resultados"><!--Datos de la bd de catalogo servicios-->
			<thead class="thead">
				<tr>
					<th>Nombre Servicio</th>
					<th><center>Acción</center></th>
				</tr>
			</thead>
			<tbody class="tbservicio"><!--esta clase sirve para agregar el nuevo elemento-->
				<?php echo $tabla->servicio ?>
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