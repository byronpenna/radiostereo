<!DOCTYPE HTML>
<html lang="Es">
<head>
	<?php 
		$this->load->view("estructura/head.php");
	?>
    <link rel="stylesheet" href="<?php echo base_url('resources/plugincalendar/lib/cupertino/jquery-ui.min.css')?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url('resources/plugincalendar/fullcalendar.css')?>" type="text/css" />
    <script src="<?php echo base_url('resources/plugincalendar/lib/moment.min.js')?>" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo base_url('resources/plugincalendar/fullcalendar.min.js')?>" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo base_url('resources/plugincalendar/lang-all.js')?>" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo base_url('resources/js/cotizacion/calendario/script.js')?>" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo base_url('resources/js/cotizacion/calendario/function.js')?>" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo base_url('resources/js/cotizacion/editar/script.js')?>" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo base_url('resources/js/cotizacion/editar/function.js')?>" type="text/javascript" charset="utf-8"></script>
</head>
<body>
    
	<?php 
        $this->load->view("estructura/menu.php");
    ?><br>
	<div class="container" id="contenedorClientes">
        <section class="container" id="contenedorClientes">
    <h3>Cotizaci&oacute;n N&uacute;mero : <?php echo $idCot ?> </h3>
    <hr id="hr">
        <section id="mainCot">
            <!-- inicio de el encabezado de la cotizacion -->
            <?= $data->encCot ?>
            <!-- fin del encabezado de la coticacion -->
            <section id="contCotSer">
                <!-- Inicia el contenedor de los programas -->
                    <?= $data->encProg ?>
                <!-- finaliza el contenedor de los programas -->
                <!-- inician los servicios -->
                <?= $data->encRadios ?>
                <!-- finalizan los servicios -->
                <!-- valores Agregados -->
                <?= $data->valAgregado ?>
                <!-- fin de los valores agregados -->
            </section>
            <!-- Finaliza contenedor de los servicios -->
            <?= $data->botones ?>
        </section>
    </section>
    </div>
</body>
</html>