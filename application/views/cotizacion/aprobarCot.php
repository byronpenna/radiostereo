<!DOCTYPE HTML>
<html lang="Es">
<head>
	<?php 
		$this->load->view("estructura/head.php");
	?>
    <script src="<?php echo base_url('resources/js/cotizacion/aprobar/script.js')?>" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo base_url('resources/js/cotizacion/aprobar/function.js')?>" type="text/javascript" charset="utf-8"></script>
</head>
<body>
	<?php 
		$this->load->view("estructura/menu.php");
	?>
	<div class="container" id="contenedorClientes">
    <h3>Listado de Cotizaciones Creadas</h3>
    <hr id="hr">
	<div class="row">
        <div class="panel panel-primary filterable" id="tableClientes">
            <div class="panel-heading">
                <h3 class="panel-title">Cotizaciones</h3>
                <div class="pull-right">
                </div>
            </div>
            <div class="datagrid buscar">
                <form class="form-inline">
		            <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i> </span>
                          <input id="searchTerm" type="search" onkeyup="doSearch()" class="form-control" placeholder="Buscar" />
                        </div>
                    </div>
                    <div class="form-group" style="float:right;">
                        <div class="input-group">
                            <a class='btn btn-success apCot'>Aprobar Seleccionados</a>
                        </div>
                    </div>
                </form>
            <table id="resultados" class="table dataApo" >
                <thead class="thead">
                    <tr>
                        <th>Seleccione</th>
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
         <div style="border: 2px;" id="NavPosicion" class="pag text-center"></div>
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