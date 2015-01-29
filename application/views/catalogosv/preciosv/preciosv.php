<!DOCTYPE HTML>
<html lang="Es">
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

	<fieldset  id="fieldPrecio fieldPrecio">
		<h3><strong>Precios</strong></h3>
    <hr id="hr">

		<form id="frmPrecio" method="POST" class="form-inline"><!--Formulario para ingresar precio-->

			<div class="form-group">
        <label for="precio">Precio: </label>
        <div class="input-group">
        	<span class="input-group-addon"> $ </span>
					<input type="text" name="precio" id='txtPrecio' class="NumPunto vaciarinput form-control" required />
          <span class="input-group-btn">
            <input type="submit" value="Guardar" class="btn btn-m btn-success btnAddCot">
          </span>
        </div>
      </div>
      <div class="form-group" style="float:right;">
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i> </span>
          <input id="searchTerm" type="search" onkeyup="doSearch()" class="form-control" placeholder="Buscar Precio" />
        </div>
      </div>
		</form>
	<div id="contenido">
        <div class="midBox1">
        		<div class="datagrid">
        <br />
		    <table id="resultados" class="table tablaPrecios"><!--Datos de la bd de catalogo precios-->
				<thead class="thead">
					<tr>
						<th>Tarifas</th>
						<th><center>Acción</center></th>	
					</tr>
				</thead>
				<tbody class="tbprecios">
					<?php echo $tabla->precio ?>
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