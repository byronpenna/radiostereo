<!DOCTYPE html>
<html>
<head>
	<?php 
		$this->load->view("estructura/head.php");
	?>
    <style type="text/css" media="screen">
        body{
            padding-bottom: 2em;
        }
    </style>
</head>
<body>
    <?php 
        $this->load->view("estructura/menu.php");
    ?>
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
    				<p><br>Fecha de Creacion <span> <input type="date" name="" class="form-control input-sm medios" id="fechaCreacion" disabled></span></p>
    			</article>
    		</article>
			<section id="contCotSer">
                <!-- Contenedor para los programas -->
				<article id="conProgra">
                    <h4 class="text-center">Programas</h4>
                    <article class="titleAddCot"><span>Programa </span><span><?php echo $Prog;?></span></article>
                    <article class="contPVenta"><span>Precio de Venta </span><span><input type="text" class="soloNumeros" name="pventa" value="" placeholder="$" class="form-control input-sm" required></span></article>
                    <article class="cuerpo">
                        <table border=0 width="100%" rules="all">
                            <tr>
                                <td></td>
                                <td><p>Precio</p></td>
                                <td><p>Cantidad</p></td>
                                <td><p>Duracion</p></td>
                                <td><p>Sub Total</p></td>
                            </tr>
                            <?php echo $Servicios; ?>
                            <!-- <tr>
                                <td>Cuñas</td>
                                <td><?php echo $Precios; ?></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" placeholder="Segundos" class="form-control input-sm inAddCot " ></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                            </tr>
                            <tr>
                                <td>Menciones</td>
                                <td><?php echo $Precios; ?></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" placeholder="Segundos" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                            </tr>
                            <tr>
                                <td>Entrevistas</td>
                                <td><?php echo $Precios; ?></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" placeholder="Segundos" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                            </tr>
                            <tr>
                                <td>Redes Sociales</td>
                                <td><?php echo $Precios; ?></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" placeholder="Segundos" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                            </tr>
                            <tr> -->
                                <td>Total</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                            </tr>
                        </table>
                        <article class="fechasFooter">
                            <article class="fechaInicio">
                                    <span>Fecha Inicio </span>    
                                    <span>
                                        <input type="date" name="pventa" value="" placeholder="$" class="form-control input-sm medios" required>
                                    </span>
                            </article>        
                            <article class="fechaFin" >
                                <span >Fecha Fin </span>    
                                <span>
                                    <input type="date" name="pventa" value="" placeholder="$" class="form-control input-sm medios" required>
                                </span>
                            </article>    
                    </article>
                    </article>
                </article>
                <!-- Finaliza Contenedor para los programas -->
                <!-- Contenedor para las Cuñas -->
                <article id="conProgra">
                    <h4 class="text-center">Cu&ntilde;a</h4>
                    <article class="conttPVenta"><span>Precio de Venta </span><span><input type="text" class="soloNumeros" name="pventa" value="" placeholder="$" class="form-control input-sm" required></span></article>
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
                                <td>Femenina</td>
                                <td><?php echo $Precios; ?></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" placeholder="Segundos" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                            </tr>
                            <tr>
                                <td>Ranchera</td>
                                <td><?php echo $Precios; ?></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" placeholder="Segundos" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                            </tr>
                            <tr>
                                <td>Fiesta</td>
                                <td><?php echo $Precios; ?></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" placeholder="Segundos" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                            </tr>
                            <tr>
                                <td>Laser Ingles</td>
                                <td><?php echo $Precios; ?></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" placeholder="Segundos" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                            </tr>
                            <tr>
                                <td>Laser Espa&ntilde;ol</td>
                                <td><?php echo $Precios; ?></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" placeholder="Segundos" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                            </tr>
                        </table>
                        <article class="fechasFooter">
                            <article class="fechaInicio">
                                    <span>Fecha Inicio </span>    
                                    <span>
                                        <input type="date" name="pventa" value="" placeholder="$" class="form-control input-sm medios" required>
                                    </span>
                            </article>        
                            <article class="fechaFin" >
                                <span >Fecha Fin </span>    
                                <span>
                                    <input type="date" name="pventa" value="" placeholder="$" class="form-control input-sm medios" required>
                                </span>
                            </article>    
                    </article>
                    </article>
                </article>
                <!-- Finaliza contenedor de las cuñas -->
                <!-- Contenedor para las Entrevistas -->
                <article id="conProgra">
                    <h4 class="text-center">Entrevista</h4>
                    <article class="conttPVenta"><span>Precio de Venta </span><span><input type="text" class="soloNumeros"  name="pventa" value="" placeholder="$" class="form-control input-sm" required></span></article>
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
                                <td>Femenina</td>
                                <td><?php echo $Precios; ?></td>
                                <td><input type="text"  name="" value="" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" placeholder="Segundos" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                            </tr>
                            <tr>
                                <td>Ranchera</td>
                                <td><?php echo $Precios; ?></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" placeholder="Segundos" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                            </tr>
                            <tr>
                                <td>Fiesta</td>
                                <td><?php echo $Precios; ?></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" placeholder="Segundos" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                            </tr>
                            <tr>
                                <td>Laser Ingles</td>
                                <td><?php echo $Precios; ?></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" placeholder="Segundos" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                            </tr>
                            <tr>
                                <td>Laser Espa&ntilde;ol</td>
                                <td><?php echo $Precios; ?></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" placeholder="Segundos" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                            </tr>
                        </table>
                        <article class="fechasFooter">
                            <article class="fechaInicio">
                                    <span>Fecha Inicio </span>    
                                    <span>
                                        <input type="date" name="pventa" value="" placeholder="$" class="form-control input-sm medios" required>
                                    </span>
                            </article>        
                            <article class="fechaFin" >
                                <span >Fecha Fin </span>    
                                <span>
                                    <input type="date" name="pventa" value="" placeholder="$" class="form-control input-sm medios" required>
                                </span>
                            </article>    
                    </article>
                    </article>
                </article>
                <!-- Finaliza contenedor de las entrevistas -->
                <!-- Contenedor para las Producciones -->
                <article id="conProgra">
                    <h4 class="text-center">Producci&oacute;n</h4>
                    <article class="conttPVenta"><span>Precio de Venta </span><span><input type="text" class="soloNumeros" name="pventa" value="" placeholder="$" class="form-control input-sm" required></span></article>
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
                                <td>Femenina</td>
                                <td><?php echo $Precios; ?></td>
                                <td><input type="text" name="" value=""  class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" placeholder="Segundos" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot "></td>
                            </tr>
                            <tr>
                                <td>Ranchera</td>
                                <td><?php echo $Precios; ?></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" placeholder="Segundos" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                            </tr>
                            <tr>
                                <td>Fiesta</td>
                                <td><?php echo $Precios; ?></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" placeholder="Segundos" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                            </tr>
                            <tr>
                                <td>Laser Ingles</td>
                                <td><?php echo $Precios; ?></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" placeholder="Segundos" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                            </tr>
                            <tr>
                                <td>Laser Espa&ntilde;ol</td>
                                <td><?php echo $Precios; ?></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" placeholder="Segundos" class="form-control input-sm inAddCot"></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot"></td>
                            </tr>
                        </table>
                        <article class="fechasFooter">
                            <article class="fechaInicio">
                                    <span>Fecha Inicio </span>    
                                    <span>
                                        <input type="date" name="pventa" value="" placeholder="$" class="form-control input-sm medios" required>
                                    </span>
                            </article>        
                            <article class="fechaFin" >
                                <span >Fecha Fin </span>    
                                <span>
                                    <input type="date" name="pventa" value="" placeholder="$" class="form-control input-sm medios" required>
                                </span>
                            </article>    
                    </article>
                    </article>
                </article>
                
                <!-- Finaliza contenedor de las Produccion -->
                <!-- Contenedor para las Producciones -->
                <article id="conProgra">
                    <h4  class="text-center">Valores Agregados</h4>
                    <article id="textAddCot">
                        <textarea name="" cols="50" rows="6" ></textarea>    
                    </article>
                </article>
                <!-- Finaliza contenedor de las Produccion -->
			</section>
            <!-- Finaliza contenedor de los servicios -->
            <article id="contBtnAddCot">
                <input type="submit" name="" value="Guardar" class="btn btn-m btn-success btnAddCot">
                <input type="submit" name="" value="Limpiar" class="btn btn-m btn-warning btnAddCot">
                <input type="submit" name="" value="Cancelar" class="btn btn-m btn-danger btnAddCot">
            </article>
    	</section>
    </section>
</body>
</html>