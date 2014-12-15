<!DOCTYPE html>
<html>
<head>
	<?php 
		$this->load->view("estructura/head.php");
		$this->load->view("estructura/menu.php");
	?>
    <style type="text/css" media="screen">
        body{
            margin-bottom:20px;
        }
    </style>
</head>
<body>
	<section class="container" id="contenedorClientes">
    <h3>Crear Cotizacion</h3>
    <hr id="hr">
    	<section id="mainCot">
    		<article id="cotHeader">
    			<article>
    				<p>Id de Cliente <span><?= $cliente->cli_id ?></span></p>
    				<p>Nombre <span><?php echo $cliente->cli_nombres." ".$cliente->cli_apellidos ?></span></p>	
    			</article>
    			<article>
    				<p>Tipo Cotizacion <span>
                        <?php echo $TipoCot; ?>
    				</span></p>
    				<p>Estado de Ctoizacion <span>
    					<?php echo $EstadoCot; ?>
    				</span></p>
    			</article>
    			<article>
    				<p><br>Fecha de Creacion <span> <input type="date" name="" class="form-control input-sm"></span></p>
    			</article>
    		</article>
			<section id="contCotSer">
                <h4 class="text-center">Programas</h4>
				<article id="conProgra">
                    <article class="titleAddCot"><span>Programa </span><span><?php echo $Prog;?></span></article>
                    <article class="contPVenta"><span>Precio de Venta </span><span><input type="text" name="pventa" value="" placeholder="$" class="form-control input-sm" required></span></article>
                    <article class="cuerpo">
                        <table border=0 width="100%" rules="all">
                            <tr>
                                <td></td>
                                <td><p>Precio</p></td>
                                <td><p>Cantidad</p></td>
                                <td><p>Duracion</p></td>
                                <td><p>Sub Total</p></td>
                            </tr>
                            <tr>
                                <td>Cuñas</td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot" placeholder="$"></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                            </tr>
                            <tr>
                                <td>Menciones</td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot" placeholder="$"></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                            </tr>
                            <tr>
                                <td>Entrevistas</td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot" placeholder="$"></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                            </tr>
                            <tr>
                                <td>Redes Sociales</td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot" placeholder="$"></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                            </tr>
                        </table>
                        <article class="col-lg-5 fechasFooter">
                            <article class="fechaInicio">
                                <article class="col-lg-4">
                                    <span>Fecha Inicio </span>    
                                </article>
                                <article class="col-lg-8">
                                    <span>
                                    <input type="date" name="pventa" value="" placeholder="$" class="form-control input-sm" required>
                                </span>
                                </article>
                            </article>        
                        </article>
                    <article class="col-lg-offset-2 col-lg-5 fechasFooter">
                        <article class="fechaFin" >
                            <article class="col-lg-4">
                                <span >Fecha Fin </span>    
                            </article>
                            <article class="col-lg-8">
                                <span>
                                <input type="date" name="pventa" value="" placeholder="$" class="form-control input-sm" required>
                            </span>
                            </article>
                        </article>    
                    </article>
                    </article>
                </article>
                <hr>
			</section>    		
    	</section>
    </section>
</body>
</html>