<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="Es">
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
    <h3>Datos usuario actual</h3>
    <hr id="hr">
	<fieldset id="fieldPrograma">
		<table id="resultados" class="table">
      <thead class="thead">
        <tr>
          <th>Usuario</th>
          <th>Nombre</th>
          <th>Firma</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody class="tbProgramas">
        <?php echo $tabla->usuario;?>
      </tbody>
    </table>
    </fieldset>	
    
  </div>
</body>
</html>