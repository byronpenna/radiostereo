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
	<fieldset class="fieldPrecio well" id="fieldPrecio">
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
	<div id="contenido">
        <div class="midBox1">
        		<div class="datagrid">
        <form>
           <b> BUSCAR:</b> <input id="searchTerm" type="search" onkeyup="doSearch()" class="form-control" placeholder="Programa" />
        </form>
        <br />
		        <table id="resultados" class="table"><!--Datos de la bd de catalogo precios-->
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