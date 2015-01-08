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
	<div class="container" id="contenedorClientes">
    <h3>Listado de Cotizaciones</h3>
    <hr id="hr">
	<div class="row">
        <div class="panel panel-primary filterable" id="tableClientes">
            <div class="panel-heading">
                <h3 class="panel-title">Cotizaciones</h3>
                <div class="pull-right">
                </div>
            </div>
            <div class="datagrid buscar">
		            <form>
		                <b> BUSCAR:</b> <input id="searchTerm" type="search" onkeyup="doSearch()" class="form-control" placeholder="Search" />
		            </form>
            <table id="resultados" class="table" >
                <thead class="thead">
                    <tr>
                        <th>Nombre</th>
                        <th>Razon Social</th>
                        <th>NIT</th>
                        <th>Fecha Creación</th>
                        <th><center>Acción</center></th>
                    </tr>
                </thead>
                <tbody>
                     <?php echo $tabla->cotizacion; ?>
                </tbody>
            </table>
        </div>
         <div style="border: 2px;" id="NavPosicion" class="pag"></div>
          <script type="text/javascript">
                    var pager = new Pager('resultados', 10);
                    pager.init();
                    pager.showPageNav('pager', 'NavPosicion');
                    pager.showPage(1);
                                    </script>
    </div>
	</div>
</div>
</body>
</html>