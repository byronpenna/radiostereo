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

	<div><!--Mostramos el mensaje retornado-->
		<h2 class="mensaje"></h2>
	</div>

  
	<fieldset id="fieldPrograma">
      <h3><strong>Programas</strong></h3>
      <hr id="hr">

        <!-- Agregar Programa -->
          <form id="frmPrograma" method="POST" class="form-inline"><!--Formulario para ingresar programas-->
            <div class="form-group">
              <label for="nombre">Nombre Programa:</label>
                <div class="input-group">
                  <input type="text" name="nombpro" class="vaciarinput form-control" required />
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
        <!-- fin de agregar contenido -->
        
        <div id="contenido">
          <div class="midBox1">   
              <div class="midBox1Top">
                  <h3></h3>                        
              </div>
              <div class="datagrid">
                <table id="resultados" class="table">
                            <thead class="thead">
                                <tr>
                                   <th>Nombre Programa</th>
                                    <th><center>Acción</center></th>
                                </tr>
                            </thead>
                            <tbody class="tbProgramas">
                               <?php  echo $tabla->programas; ?>
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
	<br>
  </div>
</body>
</html>