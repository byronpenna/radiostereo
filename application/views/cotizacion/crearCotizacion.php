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
<body >
    <?php 
        $this->load->view("estructura/menu.php");
    ?>
	<section class="container" id="contenedorClientes">
    <h3>Crear Cotizacion</h3>
    <hr id="hr">
    	<section id="mainCot">
    		<article id="cotHeader" class="headerCot">
    			<article>
    				<p>Id de Cliente <span><?= $cliente->cli_id ?> <input type="hidden" name="idCliente" value="<?= $cliente->cli_id ?>"><input type="hidden" name="idUsuario" value="<?= $_SESSION['iduser'] ?>"> </span></p>
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
    				<p><br>Fecha de Creacion <span> <input type="text" name="txtFechaCreacionCot" class="form-control input-sm medios" id="fechaCreacion" readonly="true"></span></p>
    			</article>
    		</article>
			<section id="contCotSer">
                <!-- Contenedor para los programas -->
				<article id="conProgra" class="programasCot">
                    <h4 class="text-center">Programas</h4>
                    <article class="titleAddCot "><span>Programa </span><span><?php echo $Prog;?></span></article>
                    <article class="contPVenta "><span>Precio de Venta </span><span><input type="text" class="NumPunto" name="pventa" value="" placeholder="$" class="form-control input-sm"></span></article>
                    <article class="cuerpo">
                        <table width="100%" >
                            <thead>
                            <tr>
                                <td></td>
                                <td><p>Precio</p></td>
                                <td><p>Cantidad</p></td>
                                <td><p>Duracion</p></td>
                                <td><p>Sub Total</p></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $Servicios; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Total</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><input type="text" name="total"  class="form-control input-sm inAddCot total" readonly="true"></td>
                            </tr>
                        </tfoot>
                        </table>
                        <article class="fechasFooter ">
                            <article class="fechaInicio">
                                    <span>Fecha Inicio </span>    
                                    <span>
                                        <input type="text" name="txtFechaInicio"  placeholder="dd-mm-aaaa" class="form-control input-sm medios  datepicker fi" required>
                                    </span>
                            </article>        
                            <article class="fechaFin" >
                                <span >Fecha Fin </span>    
                                <span>
                                    <input type="text" name="txtFechaFin" placeholder="dd-mm-aaaa" class="form-control input-sm medios fechaFin datepicker ffin" required>
                                </span>
                            </article>    
                    </article>
                    </article>
                </article>
                <!-- Finaliza Contenedor para los programas -->
                <!-- Contenedor para las Cuñas -->
                <article id="conProgra" class="cuniasCot">
                    <h4 class="text-center">Cu&ntilde;a</h4>
                    <input type="hidden" name="txtIdCuna" value="1" >
                    <article class="conttPVenta"><span>Precio de Venta </span><span><input type="text" class="NumPunto" name="pventa" value="" placeholder="$" class="form-control input-sm" required></span></article>
                    <article class="cuerpo">
                        <table border=0 width="100%" rules="all">
                            <thead>
                            <tr>
                                <td></td>
                                <td><p>Precio</p></td>
                                <td><p>Cantidad</p></td>
                                <td><p>Duracion</p></td>
                                <td><p>Sub Total</p></td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php echo $Radios; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td>Total</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><input type="text"  class="form-control input-sm inAddCot total" readonly="true"></td>
                            </tr>
                            </tfoot>
                        </table>
                        <article class="fechasFooter" >
                            <article class="fechaInicio">
                                    <span>Fecha Inicio </span>    
                                    <span>
                                        <input type="text" name="txtFechaInicio"  placeholder="dd-mm-aaaa" class="fi form-control input-sm medios datepicker" required>
                                    </span>
                            </article>        
                            <article class="fechaFin" >
                                <span >Fecha Fin </span>    
                                <span>
                                    <input type="text" name="txtFechaFin"  placeholder="dd-mm-aaaa" class="form-control input-sm medios datepicker ffin" required>
                                </span>
                            </article>    
                    </article>
                    </article>
                </article>
                <!-- Finaliza contenedor de las cuñas -->
                <!-- Contenedor para las Entrevistas -->
                <article id="conProgra" class="entrevistasCot">
                    <h4 class="text-center">Entrevista</h4>
                    <input type="hidden" name="txtIdEntrevista" value="2" >
                    <article class="conttPVenta"><span>Precio de Venta </span><span><input type="text" class="NumPunto"  name="pventa"  placeholder="$" class="form-control input-sm" required></span></article>
                    <article class="cuerpo">
                        <table border=0 width="100%" rules="all">
                            <thead>
                            <tr>
                                <td></td>
                                <td><p>Precio</p></td>
                                <td><p>Cantidad</p></td>
                                <td><p>Duracion</p></td>
                                <td><p>Sub Total</p></td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php echo $Radios; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td>Total</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot total" readonly="true"></td>
                            </tr>
                            </tfoot>
                        </table>
                        <article class="fechasFooter " >
                            <article class="fechaInicio">
                                    <span>Fecha Inicio </span>    
                                    <span>
                                        <input type="text" name="txtFechaInicio"  placeholder="dd-mm-aaaa" class="fi form-control input-sm medios  datepicker" required>
                                    </span>
                            </article>        
                            <article class="fechaFin" >
                                <span >Fecha Fin </span>    
                                <span>
                                    <input type="text" name="txtFechaFin"  placeholder="dd-mm-aaaa" class="form-control input-sm medios datepicker ffin" required>
                                </span>
                            </article>    
                    </article>
                    </article>
                </article>
                <!-- Finaliza contenedor de las entrevistas -->
                <!-- Contenedor para las Producciones -->
                <article id="conProgra" class="produccionesCot">
                    <h4 class="text-center">Producci&oacute;n</h4>
                    <input type="hidden" name="txtIdProduccion" value="3">
                    <article class="conttPVenta"><span>Precio de Venta </span><span><input type="text" class="NumPunto" name="pventa"  placeholder="$" class="form-control input-sm" required></span></article>
                    <article class="cuerpo">
                        <table border=0 width="100%" rules="all">
                            <thead>
                            <tr>
                                <td></td>
                                <td><p>Precio</p></td>
                                <td><p>Cantidad</p></td>
                                <td><p>Duracion</p></td>
                                <td><p>Sub Total</p></td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php echo $Radios; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td>Total</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><input type="text" name="" value="" class="form-control input-sm inAddCot total" readonly="true"></td>
                            </tr>
                            </tfoot>
                        </table>
                        <article class="fechasFooter">
                            <article class="fechaInicio">
                                    <span>Fecha Inicio </span>    
                                    <span>
                                        <input type="text" name="txtFechaInicio"  placeholder="dd-mm-aaaa" class="fi form-control input-sm medios  datepicker" required>
                                    </span>
                            </article>        
                            <article class="fechaFin" >
                                <span >Fecha Fin </span>    
                                <span>
                                    <input type="text" name="txtFechaFin"  placeholder="dd-mm-aaaa" class="form-control input-sm medios datepicker ffin" required>
                                </span>
                            </article>    
                    </article>
                    </article>
                </article>
                <!-- Finaliza contenedor de las Produccion -->
                <!-- Contenedor para los Valores Agregados -->
                <article id="conProgra" class="headerCot" >
                    <h4  class="text-center">Valores Agregados</h4>
                    <article id="textAddCot">
                        <textarea name="txtValorAgregado" cols="50" rows="6" class="form-control"></textarea>    
                    </article>
                </article>
                <!-- Finaliza contenedor de los Valores Agregados -->
			</section>
            <!-- Finaliza contenedor de los servicios -->
            <article id="contBtnAddCot">
                <input type="submit" name="" value="Guardar" class="btn btn-m btn-success btnAddCot" id="guardarCot">
                <input type="submit" name="" value="Limpiar" class="btn btn-m btn-warning btnAddCot" id="limpiar">
                <input type="button" name="" value="Cancelar" class="btn btn-m btn-danger btnAddCot cancel">
            </article>
    	</section>
    </section>
</body>
</html>