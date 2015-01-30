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
	<div><!--Mostramos el mensaje retornado-->
		<h2 class="mensaje"></h2>
	</div>

	<div class="container" id="contenedorClientes">

	<fieldset id="fieldUser">
		<h3><strong>Usuarios</strong></h3>
      	<hr id="hr">
		<form id="frmMantoUser" method="POST" class="form-inline"><!--Formulario para ingresar programas-->
			<div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i> Nombre de Usuario </span>
          <input type="text" name="txtuser" class="vaciarinput form-control" required />
        </div>
      </div>
      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i> Password </span>
          <input type="password" name="txtpassword" class="vaciarinput form-control" required />
        </div>
      </div>
			<input type="hidden" name="txtIdCompania" class="form-control" value="1" required />	
			<input type="submit" value="Guardar" class="btn btn-m btn-success btnAddCot">
			<div class="form-group" style="float:right;">
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i> </span>
          <input id="searchTerm" type="search" onkeyup="doSearch()" class="form-control" placeholder="Buscar Usuarios" />
        </div>
      </div>
		</form>
		<div id="contenido">
                <div class="midBox1">
                    <div class="datagrid">

                        <br />
                        <table id="resultados" class="table table-hover">
                            <thead class="thead">
                                <tr>
                                   <th colspan="2" class="text-center col-md-10" >Usuario</th>
                                   <!-- <th>Password</th> -->
                                   <!--<th>Firma</th>-->
									                 <th class="col-md-2">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="tbUsuario">
                               <?php  echo $tabla->usuario; ?>
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