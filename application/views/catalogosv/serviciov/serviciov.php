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
	<div class="container" id="contenedorClientes">

	<fieldset id="fieldServicio">
		<h3><strong>Servicios</strong></h3>
    <hr id="hr">

		<form id="frmServicio" method="POST" class="form-inline"><!--Formulario para ingresar un servicio-->
			<div class="form-group">
        <label for="nombservicio">Nombre de Servicio: </label>
         <div class="input-group">
          <input type="text" name="servicio" class="vaciarinput form-control" required />
          <span class="input-group-btn">
            <input type="submit" value="Guardar" class="btn btn-m btn-success btnAddCot">
          </span>
          </div>
      </div>
      <div class="form-group" style="float:right;">
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i> </span>
            <input id="searchTerm" type="search" onkeyup="doSearch()" class="form-control" placeholder="Buscar Programa" />
        </div>
      </div>
		</form>
		<div id="contenido">
      <div class="midBox1">	
        <div class="midBox1Top">
          <h3></h3>		 				 
        </div>
        <div class="datagrid">
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