<!DOCTYPE HTML>
<html lang="Es">
<head>
	<?php 
		$this->load->view("estructura/head.php");
	?>
    <script src="<?php echo base_url('resources/js/cotizacion/editar/script.js')?>" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo base_url('resources/js/cotizacion/editar/function.js')?>" type="text/javascript" charset="utf-8"></script>
</head>
<body>
	<?php 
        $this->load->view("estructura/menu.php");
    ?><br>
	<div class="container" id="contenedorClientes">
        <section class="container" id="contenedorClientes">
    <h3>Editar Cotizacion</h3>
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
            <article id="contBtnAddCot">
                <input type="submit" name="" value="Guardar" class="btn btn-m btn-success btnAddCot" id="editCot">
                <input type="submit" name="" value="Limpiar" class="btn btn-m btn-warning btnAddCot" id="limpiar">
                <input type="button" name="" value="Cancelar" class="btn btn-m btn-danger btnAddCot cancel">
            </article>
        </section>
    </section>
    </div>
</body>
</html>