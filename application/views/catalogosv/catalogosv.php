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
	<fieldset class="fielPrograma well" id="fieldPrograma">
		<legend>Programas</legend>
		<form id="frmPrograma" method="POST" class="well"><!--Formulario para ingresar programas-->
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
                    <div class="midBox1Top">
                        <h3></h3>		 				 
                    </div>
                    <div class="datagrid">
                        <form>
                            <b> BUSCAR:</b> <input id="searchTerm" type="search" onkeyup="doSearch()" class="form-control" placeholder="Programa" />
                        </form>
                        <br />
                        <table id="resultados" class="table" border="2px">
                            <thead class="thead">
                                <tr>
                                   <th>Nombre Programa</th>
									<th colspan="2">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="tbProgramas">
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
</body>
</html>