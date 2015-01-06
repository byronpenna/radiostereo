<link rel="stylesheet" href="<?php echo base_url('resources/css/estilo.css') ?>" type="text/css" />
<page backtop="30mm"> 
      <page_header> 
           <img src="<?php echo base_url('resources/imagenes/Reporte/headerReporte.jpg')?>" class="img-reporte-header"/>
           <div class="hr-reporte">
           </div>
      </page_header> 
      <page_footer> 
			<img src="<?php echo base_url('resources/imagenes/Reporte/footerReporte.jpg')?>" class="img-reporte-footer"/>
      </page_footer> 
      <div class="cuerpo">
      	<div class="fechaActual"><?= $fechaActual?></div>
      	<div class="cont">
      		<br><br>
      		Licenciado (a)<br>
			<?= $Contacto ?> <br>
			<?= $Empresa ?><br>
			Presente <br><br>

			Estimada (o)  Lic. (Licda.):<br><br>

			Reciba un cordial saludo de parte de Grupo Radio Stereo y sus estaciones: Fiesta, Femenina, Ranchera, Láser Inglés y Láser Español.<br><br>

			Por este medio someto a su evaluación, presupuesto de inversión publicitaria en  $programa.  A continuación el detalle:<br><br>

			<table border=1 >
				<tr>
					<td>Servicio</td>
					<td>Precio</td>
					<td>Cantidad</td>
					<td>Duracion</td>
					<td>Sub Total</td>
				</tr>
				<tr>
					<td>Servicio</td>
					<td>Precio</td>
					<td>Cantidad</td>
					<td>Duracion</td>
					<td>Sub Total</td>
				</tr>
			</table>
			<br>
			<br>

			<table>
				<tr>
					<td>Total Por Servicios :</td>
					<td>$Total</td>
				</tr>
			</table>
			 	 <br>
			Descuento			:	$Descuento <br>
			Previo de Venta		:	$PVenta <br>
      	</div>
      </div>
</page>