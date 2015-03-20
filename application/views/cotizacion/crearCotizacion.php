<!DOCTYPE html>
<html>
<head>
	<?php 
		$this->load->view("estructura/head.php");
	?>
    <script src="<?php echo base_url('resources/js/cotizacion/script.js')?>" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo base_url('resources/js/cotizacion/function.js')?>" type="text/javascript" charset="utf-8"></script>
</head>
<body >
    <?php 
        $this->load->view("estructura/menu.php");
    ?>
	<section class="container" id="contenedorClientes">
    <h3>Crear Cotización </h3>
    <hr id="hr">
    	<section id="mainCot">
    		<article id="cotHeader" class="headerCot">
    			<article>
    				<p>Id de Cliente <span> <input type="text" name="txtidCliente" value="<?= $cliente->cli_id ?> " class="form-control input-sm pequenios" readonly="true"><input type="hidden" name="idUsuario" value="<?= $_SESSION['iduser'] ?>"> </span></p>
    				<p>Nombre <span> <input type="text" name="" value="<?php echo $cliente->cli_nombres ;?>" class="form-control input-sm pequenios" readonly="true"> </span></p>	
    			</article>
    			<article>
    				<p>Forma de Pago <span>
                        <select name='tipo_cot' class='form-control input-sm pequenios selectBlanco' >
                            <?php echo $TipoCot; ?>
                        </select>   
    				</span></p>
    				<p>Estado de Cotización <span>
                        <select name='estado_cot' class='form-control input-sm pequenios selectBlanco' >
        					<?php echo $EstadoCot; ?>
                        </select>
    				</span></p>
    			</article>
    			<article>
    				<p>Fecha de Creación <span><input type="text" name="txtFechaCreacionCot" class="form-control input-sm medios fechaCreacion"  readonly="true"></span></p>
                    <p>Producto <span>
                        <select name='prod' class='form-control input-sm medios selectBlanco' >
                            <?php echo $Producto; ?>
                        </select>   
                    </span></p>
    			</article>
    		</article>
			<section id="contCotSer">
                <!-- Contenedor para los programas -->
				<article id="conProgra"  class="conProgra">
                    <h4 class="text-center">Programas</h4>
                    <article class="contTitle">
                        <article class="titleProgra"><span>Programa </span><span>
                            <select name='programa' class='form-control input-sm selectBlanco selPrograma' style='width:240px;height:28px;padding:0px;' >
                                <?php echo $Prog;?>
                            </select></span></article>
                        <!-- <article class="contPVenta"><span>Precio de Venta </span><span><input type="text" class="NumPunto form-control input-sm" name="pventa" value="" placeholder="$"></span></article> -->
                    </article>
                    <article class="cuerpo">
                        <table width="100%"  class="Tcalculo"> 
                            <thead>
                            <tr>
                                <td></td>
                                <td><p>Costo Por Segundo</p></td>
                                <td><p>Cantidad</p></td>
                                <td><p>Duración</p></td>
                                <td><p>Sub Total</p></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $Servicios; ?>
                        </tbody>
                        <tfoot>
                            <tr class="txtDerecha">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Precio Sin Descuento</td>
                                <td><input type="text" name="total"  class="form-control input-sm inAddCot total" placeholder="$" readonly="true"></td>
                            </tr>
                            <tr class="txtDerecha">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Descuento</td>
                                <td><input type="text" name="descuento"  class="form-control input-sm inAddCot descuento"  placeholder="$"  readonly="true"></td>
                            </tr>
                            <tr class="txtDerecha">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Precio de Venta</td>
                                <td><input type="text" class="NumPunto form-control inAddCot input-sm blur pventa" name="pventa"  placeholder="$"></td>
                            </tr>
                        </tfoot>
                        </table>
                        <article class="fechasFooter ">
                            <article class="fechaInicio">
                                    <span>Inicio de Pauta </span>    
                                    <span>
                                        <input type="text" name="txtFechaInicio"  placeholder="dd-mm-aaaa" class="form-control input-sm medios  datepicker fi fechaCreacion" required>
                                    </span>
                            </article>        
                            <article class="fechaFin" >
                                <span >Fin de Pauta</span>    
                                <span>
                                    <input type="text" name="txtFechaFin" placeholder="dd-mm-aaaa" class="form-control input-sm medios fechaFin datepicker ffin" required>
                                </span>
                            </article>    
                    </article>
                    </article>
                </article>
                <!-- Finaliza Contenedor para los programas -->
                <!-- inicia la parte de secciones --> 
                    <?php echo $Secciones; ?>
                <!-- termina la parte de secciones -->
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