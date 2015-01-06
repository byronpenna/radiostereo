<?php 
 /*La parte más importante es incluir la librería
   En este archivo PHP*/
 	require_once(base_url('resources/pdf/html2pdf.class.php'));
 	
 
 /*Ahora escribiremos en HTML lo que queramos que se imprima
   Dentro del PDF como véis lo metemos todo dentro de la
   variable $html en este caso será una tabla*/
   ob_start(); 
   
   include(base_url('application/views/cotizacion/ReporteCotizacion/datosReporte.php'));

    $html=ob_get_clean();
 /* Una vez escrito el HTML crearemos el objeto que
    está dentro de la librería que hemos importado
 */
 $pdf = new HTML2PDF('P','A4','fr', array(0, 0, 0, 0));  
 //Añadimos una página al pdf
 

 $pdf -> WriteHTML($html);

 //$pdf->pdf->IncludeJS("print(true);");
 /*Si necesitáramos más pagina abria que repetir la
 funcion de AddPage() y la de WriteHTML aquí*/
 
 /*Finalmente escribimos el nombre de fichero y la 
 ruta donde lo queremos guardar en este caso la raiz */
 $pdf -> Output('tabla_tiempo.pdf');
 //Escribimos una respuesta por pantalla
 echo "PDF creado con éxito";
?>