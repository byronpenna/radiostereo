<?php 
	class Cotizacionesm extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		// hacemos la consulta para traer las cotizaciones y mostrarlas al dar click en la opcion del menu cotizaciones
		public function SelectCotizacion()
		{
			$this->db->trans_start();
			$consulta = "SELECT * FROM cot_encabezado_cotizacion join cli_cliente ON cli_id=cot_cli_id ORDER BY cot_est_id,cot_id DESC";
			$query = $this->db->query($consulta);
			$this->db->trans_complete();
			$datos = $query->result();
			if($query->num_rows()>0){
				$res=$datos;
			}else{
				$res="nada";
			}
			return $res;
		}


		//obtenemos el estado de la cotizacion para mostrarlo en la parte de cotizaciones
		public function queryEstado($id){
			$sql="SELECT * FROM est_estado WHERE est_id=".$id."";
			$this->db->trans_start();
			$query = $this->db->query($sql);
			$this->db->trans_complete();
			$query = $query->result();
			return $query[0];
		}

		// generamos la tabla que muestra las cotizaciones
		public function getCotizacion()
		{
			$datos = $this->SelectCotizacion();
			if($datos!="nada"){
					$retorno = "";
				foreach ($datos as $row) {
					$sql="
							select det.det_id  from 
							(cot_encabezado_cotizacion cot JOIN enc_encabezado_bloque enc
							ON cot.cot_id=enc.enc_cot_id) JOIN det_detalle_bloque det
							ON enc.enc_id=det.det_enc_id
							WHERE det.det_cantidad > 0 AND det.det_duracion > 0 AND det.det_subtotal > 0
							AND cot.cot_id=".$row->cot_id."";
					$this->db->trans_start();
					$count = $this->db->query($sql);
					$this->db->trans_complete();
					$count = $count->result();
					$retorno .= "<tr class='styleTR'>
									<td style='display:none'>".$row->cot_id."</td>
									<td style='display:none'>".$row->cli_id."</td>
									<td>".$row->cli_nombres."</td>
									<td>".$row->cli_razon_social."</td>
									<td>".$row->cli_nit."</td>
									<td>".$row->cot_fecha_elaboracion."</td>
									<td style='width:35%;'><center style='float:left;margin-left:100px;'><a href='".site_url('cotizacionesc/cotizacionesc/editarCotizacion/'.$row->cot_id.'') ."' style='text-decoration:none;color:#FFFFFF;' class='btn btn-sm btn-primary'>Editar</a>
										<a href='".site_url('cotizacionesc/cotizacionesc/eliminarCotizacion/'.$row->cot_id.'') ."' style='text-decoration:none;color:#FFFFFF;' class='btn btn-sm btn-danger'>Eliminar</a>";	
										if(count($count)>0){
											$retorno .= " <a href='".site_url('cotizacionesc/cotizacionesc/printCotizacion/'.$row->cot_id.'') ."' style='text-decoration:none;color:#FFFFFF;' target='_blank' class='btn btn-sm btn-info'>Reporte</a>";
										}		
										$estado=$this->queryEstado($row->cot_est_id);				
									$retorno .= "</center><article style='float:right;'>".$estado->est_estado."</article></td></tr>";
				}
			}else{
				$retorno="Aun No ha generado ninguna cotizacion";
			}
			
			return $retorno;
		}

		// hacemos la consulta para obtener todas las cotizaciones que tienen lleno un detalle y asi mostrarlas al dar clickk 
		// sobre la opcion del menu aprobar cotizaciones
		public function getCotApro(){
			$sql="select DISTINCT cot.cot_id,cli.cli_id,cli.cli_nombres,cli.cli_razon_social,cli.cli_nit,cot.cot_fecha_elaboracion from 
					((cot_encabezado_cotizacion cot JOIN enc_encabezado_bloque enc
					ON cot.cot_id=enc.enc_cot_id) JOIN det_detalle_bloque det
					ON enc.enc_id=det.det_enc_id) JOIN cli_cliente cli 
					ON cot.cot_cli_id=cli.cli_id
					WHERE det.det_cantidad > 0 AND det.det_duracion > 0 AND det.det_subtotal > 0 AND cot.cot_est_id=1
					ORDER BY cot_id DESC";
					$this->db->trans_start();
					$query = $this->db->query($sql);
					$this->db->trans_complete();
					$datos = $query->result();
					if($query->num_rows()>0){
						$res=$datos;
					}else{
						$res="nada";
					}
				return $res;
		}


		// generamos la estructura de la tabla donde se muestra el listado de cotizaciones que se pueden aprobar
		public function obtenerCotizacionesAprobar(){
			$datos = $this->getCotApro();
			if($datos!="nada"){
					$retorno = "";
				foreach ($datos as $row) {
					$retorno .= "<tr class='styleTR'>
									<td><center><input type='checkbox' name='cotApro' value='".$row->cot_id."' /></center></td>
									<td>".$row->cli_nombres."</td>
									<td>".$row->cli_razon_social."</td>
									<td>".$row->cli_nit."</td>
									<td>".$row->cot_fecha_elaboracion."</td>
									<td><center>
										<a href='".site_url('cotizacionesc/cotizacionesc/printCotizacion/'.$row->cot_id.'') ."' style='text-decoration:none;color:#FFFFFF;' target='_blank' class='btn btn-sm btn-info'>Reporte</a>
										</center></td></tr>";
				}
			}else{
				$retorno="Aun No se ha generado ninguna cotizacion";
			}
			
			return $retorno;
		}
		

		// obtenemos el encabezado de la cotizacion dependiendo del cot_id
		public function getEncCot($id){
			$sql="SELECT * FROM cot_encabezado_cotizacion WHERE cot_id=".$id."";
			$this->db->trans_start();
			$query=$this->db->query($sql);
			$query=$query->result();
			$this->db->trans_complete();
			return $query;
		}


		// obtenemos el tipo de cotizacion dependiendo del cot_id
		public function getTipoCotizacion($id){
			$datos = new stdClass();
			$datos->validacion=false;
			$sql="SELECT * FROM tip_tipo";
			$this->db->trans_start();
			$query=$this->db->query($sql);
			if($query->num_rows()>0){
				$datos->validacion=true;
			}
			$query=$query->result();
			$this->db->trans_complete();
			$r="";
			if($datos->validacion===true){
				foreach ($query as $key => $valor) {
					if($valor->tip_id==$id){
						$s="selected";
					}else{
						$s="";
					}
					$r.="<option value='".$valor->tip_id."' $s>".$valor->tip_tipo."</option>";
				}	
			}
			return $r;
		}

		// obtenemos el estado de la cotizacion dependiendo del cot_id
		public function estCot($id){
			$datos = new stdClass();
			$datos->validacion=false;
			$sql="SELECT * FROM est_estado WHERE est_id = ".$id."";
			$this->db->trans_start();
			$query=$this->db->query($sql);
			if($query->num_rows()>0){
				$datos->validacion=true;
			}
			$query=$query->result();
			$this->db->trans_complete();
			$r= "";
			if($datos->validacion===true){
				foreach ($query as $key => $valor) {
					$r.="<input value='".$valor->est_estado."' type='text' class='form-control input-sm pequenios ' readonly='true'/>
						<input type='hidden' name='estado_cot' value='".$valor->est_id."' />";
				}
			}
			return $r;
		}




		public function getProdCliEdit($idCli,$idProd){
			$sql="SELECT * FROM pro_producto
				WHERE pro_cli_id = ".$idCli."";
				$this->db->trans_start();
				$query = $this->db->query($sql);
				$query = $query->result();
				$res="";
				foreach ($query as $row) {
					if($row->pro_id==$idProd){
						$se="selected";
					}else{
						$se="";
					}
				$res .= "<option value='".$row->pro_id."' $se >".$row->pro_nomb_producto."</option>";
			}

			return $res;
		}


		// obtenemos el encabezado de la cotizacion para mostrarlo en la parte de editar cotizacion
		public function getHeaderCot($idEncCot){
			$header =$this->getEncCot($idEncCot);
			$this->load->model('cotizacionm/cotizacionm');
			$cotm 	= new cotizacionm;
			foreach ($header as $row) {
				$idCli = $row->cot_cli_id;
				$cli = $cotm->getDatosCliente($idCli);
				$res ='
					<article id="cotHeader" class="headerCot">
                <article>
                    <p>Id de Cliente <span> <input type="text" name="txtidCliente" value="'.$cli->cli_id.'" class="form-control input-sm pequenios" readonly="true"><input type="hidden" name="idUsuario" value="'.$row->cot_usu_id.'"><input type="hidden" name="idCot" value="'.$row->cot_id.'"> </span></p>
                    <p>Nombre <span> <input type="text" name="" value="'.$cli->cli_nombres.'" class="form-control input-sm pequenios" readonly="true"> </span></p>   
                </article>
                <article>
                    <p>Forma de Pago <span>
                        <select name="tipo_cot" class="form-control input-sm pequenios " >
                            '.$this->getTipoCotizacion($row->cot_tip_id).'
                        </select>   
                    </span></p>
                    <p>Estado de Cotizacion <span>
                            '.$this->estCot($row->cot_est_id).'
                    </span></p>
                </article>
                <article>
                    <p>Fecha de Creacion <span> <input type="text" name="txtFechaCreacionCot" value="'.$row->cot_fecha_elaboracion.'" class="form-control input-sm medios" readonly="true"></span></p>
                	<p>Producto <span>
                        <select name="prod" class="form-control input-sm medios" >
                            '.$this->getProdCliEdit($row->cot_cli_id,$row->cot_pro_id).'
                        </select>   
                    </span></p>
                </article>
            </article>
				';
			}
			return $res;
		}


		// recogemos el valor agregado para mostrarlo en la parte de editar cotizacion
		public function getValorAgregado($idEncCot){
			$header =$this->getEncCot($idEncCot);
			foreach ($header as $row) {
				$res ='
					<article id="conProgra" class="headerCot" >
                    <h4  class="text-center">Valores Agregados</h4>
                    <article id="textAddCot">
                        <textarea name="txtValorAgregado" cols="50" rows="6" class="form-control" >'.$row->cot_valor_agregado.'</textarea>    
                    </article>
                </article>
				';
			}
			return $res;
		}

		// hacemos una cosulta para obtener todos los datos del encabezado del bloque
		public function queryEncBloque($idCot){
			$sql="SELECT * FROM enc_encabezado_bloque WHERE enc_cot_id=".$idCot."";
			$this->db->trans_start();
			$query=$this->db->query($sql);
			$query=$query->result();
			$this->db->trans_complete();
			return $query;		
		}

		
		// obtenemos los precios que traiga la consulta para mostrarlos en la parte de editar la cotizacion
		public function getPrecios($idPre){
			$datos = new stdClass();
			$datos->validacion=false;
			$sql="SELECT * FROM pre_precio";
			$this->db->trans_start();
			$query=$this->db->query($sql);
			if($query->num_rows()>0){
				$datos->validacion=true;
			}
			$query=$query->result();
			$this->db->trans_complete();
			$res= "<select name='precio' class='form-control input-sm mpequenios precios  blur'>
					<option value='-1'></option>";
			foreach ($query as $valor) {
				if($valor->pre_id==$idPre){
					$s="selected";
				}else{
					$s="";
				}
				$res.="<option value='".$valor->pre_id."' ".$s.">$ ".$valor->pre_precio."</option>";
			}
			$res.="</select>";
			return $res;
		}

		// obtenemos el nombre de los programas que trae la cotizacion a editar
		public function prog($idProg){
			$this->load->model("cotizacionm/cotizacionm");
			$cotizacionm = new cotizacionm();
			$prog=$cotizacionm->getProgramas();
			$res="";
			foreach ($prog as $valor) {
				if($valor->prog_id==$idProg){
					$s="selected";
				}else{
					$s="";
				}
				$res.="<option value='".$valor->prog_id."' $s>".$valor->prog_nombre."</option>";
			}
			return $res;

		}

		// obtenemos los servicios que trae la cotizacion para mostrarlos en la pagina de editar cotizacion
		public function getServicios($id){
			$sql="SELECT serv_nombre FROM serv_servicio
			WHERE serv_id=$id";
			$this->db->trans_start();
			$query=$this->db->query($sql);
			$query=$query->result();
			$this->db->trans_complete();
			return $query;
		}

		
		// generamos la tabla a partir de la consulta que nos trae los serviicos de cada cotizacion
		public function getServiciosCot($idEncBloq){
			$sql="SELECT * FROM 
				det_detalle_bloque join serv_servicio
				on det_serv_id=serv_id
				WHERE det_enc_id=$idEncBloq 
			";
			$this->db->trans_start();
			$query=$this->db->query($sql);
			$q=$query->result();
			$this->db->trans_complete();
			$res="";
			if($query->num_rows>0){
				foreach ($q as $valor) {
					
				$res.="<tr class='vacEditCot'>
						<td><input type='hidden' value='".$valor->det_serv_id."' name='txtIdServ' /><input type='hidden' value='".$valor->det_id."' name='txtIdDet' />".$valor->serv_nombre."</td>
                                <td>".$this->getPrecios($valor->det_pre_id)."</td>
                                <td><input type='text' name='txtCantidad' value='".$valor->det_cantidad."'  class='blur form-control input-sm inAddCot SoloNumero txtCantidad'></td>
                                <td><input type='text' name='txtDuracion' value='".$valor->det_duracion."'  placeholder='Segundos' class='blur form-control input-sm inAddCot SoloNumero txtDuracion'></td>
                                <td><input type='text' name='txtSubTotal' value='".$valor->det_subtotal."'  placeholder='$' class='txtSubTotal form-control input-sm inAddCot subTotal' readonly='true'></td>
					</tr>";
				}	
			}
			return $res;	
		}


		// obtenemos las radios que trae la cotizacion que vamos a editar  y las mostramos en una tabla 
		public function getRadiosCot($idEncBloq,$idSec){
			$sql="SELECT * FROM 
				det_detalle_bloque join rad_radio
				on det_rad_id=rad_id
				WHERE det_enc_id=$idEncBloq
			";
			$this->db->trans_start();
			$query=$this->db->query($sql);
			$q=$query->result();
			$this->db->trans_complete();
			$res="";
			if($query->num_rows>0){
				foreach ($q as $valor) {
				$res.="<tr class='vacEditCot'>
						<td><input type='hidden' value='".$valor->det_rad_id."' name='txtIdServ' /><input type='hidden' value='".$valor->det_id."' name='txtIdDet' />".$valor->rad_nombre."</td>
                                <td>".$this->getPrecios($valor->det_pre_id)."</td>
                                <td><input type='text' name='txtCantidad' value='".$valor->det_cantidad."'  class='blur form-control input-sm inAddCot SoloNumero txtCantidad'></td>";
                                if($idSec==1){
                                	$res.="<td><input type='text' name='txtDiaria'   value='".$valor->det_cuna_diaria."'  class='form-control input-sm inAddCot SoloNumero txtDiaria blur'></td>";
                                }
                            $res.= "<td><input type='text' name='txtDuracion' value='".$valor->det_duracion."'  placeholder='Segundos' class='blur form-control input-sm inAddCot SoloNumero txtDuracion'></td>
                                <td><input type='text' name='txtSubTotal' value='".$valor->det_subtotal."' placeholder='$'  class='txtSubTotal form-control input-sm inAddCot subTotal' readonly='true'></td>
					</tr>";
				}	
			}
			return $res;	
		}






		// obtenemos el encabezado de la parte de programas para mostrarlo en la parte de cotizaciones 
		public function encProg($idCot){
			$query = $this->queryEncBloque($idCot);
			if($query[0]->enc_prog_id && $query[0]->enc_precio_venta && $query[0]->enc_fecha_inicio && $query[0]->enc_fecha_fin){
				$c="";
			}else{
				$c="selectBlanco";
				$query[0]->enc_precio_venta="";
				$query[0]->enc_fecha_inicio="";
				$query[0]->enc_fecha_fin="";
			}
				$r='
				<article id="conProgra"  class="conProgra">
				<input type="hidden" name="txtIdEncabezado" value="'.$query[0]->enc_id.'" />
                    <h4 class="text-center">Programas</h4>
                    <article class="contTitle">
                        <article class="titleProgra"><span>Programa </span><span>
                            <select name="programa" class="form-control input-sm '.$c.'" style="width:240px;height:28px;padding:0px;"" >
                                '.$this->prog($query[0]->enc_prog_id).'
                            </select></span></article>
                        
                    </article>
                    <article class="cuerpo">
                        <table width="100%" class="Tcalculo">
                            <thead>
                            <tr>
                                <td></td>
                                <td><p>Costo Por Segundo</p></td>
                                <td><p>Cantidad</p></td>
                                <td><p>Duracion</p></td>
                                <td><p>Sub Total</p></td>
                            </tr>
                        </thead>
                        <tbody>
                        	'.$this->getServiciosCot($query[0]->enc_id).'
                         </tbody>
                        <tfoot>
                            <tr class="txtDerecha">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Precio Sin Dcto</td>
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
                                <td><input type="text" class="NumPunto form-control inAddCot input-sm blur pventa" name="pventa" value="'.$query[0]->enc_precio_venta.'"  placeholder="$"></td>
                            </tr>
                        </tfoot>
                        </table>
                        <article class="fechasFooter ">
                            <article class="fechaInicio">
                                    <span>Inicio de Pauta </span>    
                                    <span>
                                        <input type="text" name="txtFechaInicio" value="'.$query[0]->enc_fecha_inicio.'" placeholder="aaaa-mm-dd" class="form-control input-sm medios  datepicker fi txtFechaInicio" required>
                                    </span>
                            </article> 
                            
                            <article class="fechaFin" >
                                <span >Fin de Pauta</span>    
                                <span>
                                    <input type="text" name="txtFechaFin" value="'.$query[0]->enc_fecha_fin.'" placeholder="aaaa-mm-dd" class="form-control input-sm medios fechaFin datepicker ffin txtFechaFin" required>
                                </span>
                            </article> 
                            <img src="'.base_url("resources/imagenes/calendario.png").'" class="imagen imagen1" />

                            <input style=\'width:400px;\' type=\'text\' name=\'txtEvents\' value=\'\' class=\'txtEvents\'>  
                            
                            <div id="contenedor1" class="conteCalendario">
								<div class="calendar"></div><br>
							</div> 

                    </article>
                    </article>
                </article>
                
			';	
			return $r;
		}

		public function getNombreSec($idSec){
			$sql="
				select * from sec_seccion
				where sec_id = ".$idSec.";
			";
			$this->db->trans_start();
			$query = $this->db->query($sql);
			$query = $query->result();
			$this->db->trans_complete();
			return $query;


		}



		public function encRadios($idCot){
			$query = $this->queryEncBloque($idCot);
			foreach ($query as $valor) {
				if(!$valor->enc_precio_venta || !$valor->enc_fecha_inicio || !$valor->enc_fecha_fin){
					$valor->enc_precio_venta="";
					$valor->enc_fecha_fin="";
					$valor->enc_fecha_inicio="";
				}
			}
			$r="";
			for ($i=1; $i <= 3; $i++) { 
				$sec = $this->getNombreSec($i); 
				$r .='
				<!-- Contenedor para las Cuñas -->
                <article id="conProgra"  class="conProgra">
                <input type="hidden" name="txtIdEncabezado" value="'.$query[$i]->enc_id.'" />
                    <h4 class="text-center">'.$sec[0]->sec_nombre.'</h4>
                    <input type="hidden" name="txtIdSec" value="'.$i.'" >
                    <article class="contTitle">
                    </article>
                    <article class="cuerpo">
                        <table border=0 width="100%" rules="all" class="Tcalculo">
                            <thead>
                            <tr>
                                <td></td>
                                <td><p>Costo Por Segundo</p></td>
                                <td><p>Cantidad</p></td>';
                                if($sec[0]->sec_id==1){
                                	$r.="<td>Cuñas Diarias</td>";
                                	}
                               $r .= '<td><p>Duracion</p></td>
                                <td><p>Sub Total</p></td>
                            </tr>
                            </thead>
                            <tbody>
                            '.$this->getRadiosCot($query[$i]->enc_id,$sec[0]->sec_id).'
                            </tbody>
                            <tfoot>
                            <tr class="txtDerecha">
                                <td></td>
                                <td></td>';
                                if($sec[0]->sec_id==1){
                                	$r.="<td></td>";
                                }
                               $r .= '

                                <td></td>
                                <td>Precio Sin Dcto</td>
                                <td><input type="text" name="total"  class="form-control input-sm inAddCot total" placeholder="$" readonly="true"></td>
                            </tr>
                            <tr class="txtDerecha">
                                <td></td>
                                <td></td>';
                                if($sec[0]->sec_id==1){
                                	$r.="<td></td>";
                                }
                               $r .= '

                                <td></td>
                                <td>Descuento</td>
                                <td><input type="text" name="descuento"  class="form-control input-sm inAddCot descuento"  placeholder="$"  readonly="true"></td>
                            </tr>
                            <tr class="txtDerecha">
                                <td></td>
                                <td></td>';
                                if($sec[0]->sec_id==1){
                                	$r.="<td></td>";
                                }
                               $r .= '

                                <td></td>
                                <td>Precio de Venta</td>
                                <td><input type="text" class="NumPunto form-control inAddCot input-sm blur pventa" value="'.$query[$i]->enc_precio_venta.'" name="pventa"  placeholder="$"></td>
                            </tr>
                        </tfoot>
                        </table>
                        <article class="fechasFooter" >
                            <article class="fechaInicio">
                                    <span>Inicio de Pauta </span>    
                                    <span>
                                        <input type="text" name="txtFechaInicio" value="'.$query[$i]->enc_fecha_inicio.'"  placeholder="aaaa-mm-dd" class="fi form-control input-sm medios datepicker" required>
                                    </span>
                            </article>        
                           
                            <article class="fechaFin" >
                                <span >Fin de Pauta</span>    
                                <span>
                                    <input type="text" name="txtFechaFin" value="'.$query[$i]->enc_fecha_fin.'"  placeholder="aaaa-mm-dd" class="form-control input-sm medios datepicker ffin" required>
                                </span>
                            </article> 
                            	<img src="'.base_url("resources/imagenes/calendario.png").'" modal=\'1\' class="imagen" /> 
                            	<input type=\'text\' name=\'txtEvents\' value=\'\' class=\'txtEvents\'>  
                    		</article>
                    		
                    		<div id="contenedor1" class="conteCalendario">
								<div class="calendar"></div><br>
							</div> 
                    </article>
                </article>
                <!-- Finaliza contenedor de las cuñas -->
			';	
			}
			return $r;
		}

		public  function editarCotizacion($frm){
			$header 		= 	$frm->headerCot;
			$seccion 		= 	$frm->secCot;
			$retorno 		= new stdClass();
			$this->db->trans_start();
			$flag = $this->editarHeaderCot($header);
			$retorno->header = $flag;
			if($flag){
				foreach ($seccion as $valor) {
					$replace = str_replace("$","",$valor->total);
					$total = str_replace(" ", "", $replace);
					$reemplazo = str_replace("$", "", $valor->descuento);
					$descuento = str_replace(" ", "", $reemplazo);
					if($total > 0){
						$calculo = $descuento/$total;
						if($calculo  < 0.30){							
							$this->updateEstadoCot($header->idCot);
						}
					}
					if(!isset($valor->programa)){
						$valor->programa 	= 	null;
					}
					if(!isset($valor->txtIdSec)){
						$valor->txtIdSec 	= 	null;
					}
					if(!isset($valor->txtIdServ)){
						$valor->txtIdServ	=	null;
					}
					if(!isset($valor->txtIdRadio)){
						$valor->txtIdRadio	=	null;
					}
					//if($valor->pventa!=null && $valor->txtFechaFin!=null){
						$retorno->encBloq=$this->editEncBloq($valor);
						for ($i=0; $i < count($valor->precio); $i++) {
						//if($valor->precio!=-1){
						if($valor->precio[$i]==-1){
							$valor->precio[$i]="";
						}
							if(!isset($valor->txtIdRadio[$i])){
								$valor->txtIdRadio[$i] 	= null;
							}else if(!isset($valor->txtIdServ[$i])){
								$valor->txtIdServ[$i] 	= null;
							}else if(!isset($valor->txtIdSec[$i])){
								$valor->txtIdSec[$i] 	= null;
							}
					//		if($valor->txtCantidad[$i]!=null && $valor->txtDuracion[$i] != null && $valor->txtSubTotal[$i]!= null){
								@$obj = $this->getObjDetalle($valor->txtIdDet[$i],$valor->precio[$i],$valor->txtCantidad[$i],$valor->txtDiaria[$i],$valor->txtDuracion[$i],$valor->txtSubTotal[$i]);
							$retorno->detBloq=$this->editDetBloque($obj);
							//}
					 //	}
					}
					//}
				}
			}

			return $retorno;
		}

		public function editarHeaderCot($obj){
			$tabla 			= array(
				'cot_valor_agregado'	=> $obj->txtValorAgregado,
				'cot_tip_id'			=> $obj->tipo_cot,
				'cot_est_id'			=> $obj->estado_cot,
				'cot_pro_id'			=> $obj->prod
				);
			$this->db->where('cot_id',$obj->idCot);
			$res=$this->db->update('cot_encabezado_cotizacion',$tabla);
			return $res;
		}

		public function editEncBloq($obj){
				$tabla		= array(
					'enc_prog_id'		=> $obj->programa,
					'enc_precio_venta' 	=> $obj->pventa,
					'enc_fecha_inicio' 	=> $obj->txtFechaInicio,
					'enc_fecha_fin' 	=> $obj->txtFechaFin,
				);

				$this->db->where('enc_id',$obj->txtIdEncabezado);
				$res = $this->db->update('enc_encabezado_bloque',$tabla);
				
				return $res;
		}

		public function getObjDetalle($IdDet,$precio,$cantidad,$diaria,$duracion,$subTotal){
			$obj = new stdClass();
			$obj->det_id 			= $IdDet;
			$obj->det_pre_id 		= $precio;
			$obj->det_cantidad 		= $cantidad;
			$obj->det_cuna_diaria 	= $diaria;
			$obj->det_duracion 		= $duracion;
			$obj->det_subtotal 		= $subTotal;
			return $obj;
		}



		public function editDetBloque($obj){
			$tabla = array(
				'det_pre_id'		=> $obj->det_pre_id,
				'det_cantidad' 		=> $obj->det_cantidad,
				'det_cuna_diaria' 	=> $obj->det_cuna_diaria,
				'det_duracion' 		=> $obj->det_duracion,
				'det_subtotal' 		=> str_replace("$", "", $obj->det_subtotal),
				);
			$this->db->where('det_id',$obj->det_id);
			$res = $this->db->update('det_detalle_bloque',$tabla);
			return $res;
		}

		public function getEncId($IdCot){
			$sql="SELECT  * FROM enc_encabezado_bloque WHERE enc_cot_id = ".$IdCot."";
			$this->db->trans_start();
			$query=$this->db->query($sql);
			$query=$query->result();
			$this->db->trans_complete();
			return $query;
		}

		

		public function getDetId($IdEnc){
			$sql="SELECT  * FROM det_detalle_bloque WHERE det_enc_id = ".$IdEnc."";
			$this->db->trans_start();
			$query=$this->db->query($sql);
			$query=$query->result();
			$this->db->trans_complete();
			return $query;
		}

		

		public function eliminarCot($idCot){
			$encId=$this->getEncId($idCot);
			foreach ($encId as $valor) {
				$detId=$this->getDetId($valor->enc_id);
				foreach ($detId as $row) {
					$this->db->where('det_id',$row->det_id);
					$this->db->delete('det_detalle_bloque');
				}
				$this->db->where('enc_id',$valor->enc_id);
				$this->db->delete('enc_encabezado_bloque');
			}
			$this->db->where('cot_id',$idCot);
			$this->db->delete('cot_encabezado_cotizacion');
		}

		


		

//Aca se generan los reportes para los programas 
		public function getEnReporte($IdCot,$campo){
			$sql="SELECT  * FROM enc_encabezado_bloque 
			WHERE (enc_cot_id = ".$IdCot.") AND (".$campo." is not null) AND  (enc_precio_venta >0) AND (enc_fecha_inicio>0) AND (enc_fecha_fin>0)";
			$this->db->trans_start();
			$query=$this->db->query($sql);
			$query=$query->result();
			$this->db->trans_complete();
			return $query;
		}


		public function getDetIdReporte($IdEnc,$campo){
			$sql="SELECT  * FROM det_detalle_bloque 
			WHERE (det_enc_id = ".$IdEnc.") AND (".$campo." is not null) AND (det_pre_id >0) AND (det_cantidad > 0) AND (det_subtotal > 0) ";
			$this->db->trans_start();
			$query=$this->db->query($sql);
			$query=$query->result();
			$this->db->trans_complete();
			return $query;
		}

		public function getDatosCliente($id){
			$this->db->trans_start();//inicia la transaccion
			$query = $this->db->query("SELECT * FROM cli_cliente WHERE cli_id =  ".$id) ;//
			$this->db->trans_complete();//finaliza la transaccion
			$query = $query->result();
			return $query[0];
		}


		public function meses(){
			$meses = array(
				"Enero",
				"Febrero",
				"Marzo",
				"Abril",
				"Mayo",
				"Junio",
				"Julio",
				"Agosto",
				"Septiembre",
				"Octubre",
				"Noviembre",
				"Diciembre");

			return $meses;
		}


		public function getHeader(){
			$header='
			           <img src="'.base_url("resources/imagenes/Reporte/headerReporte.jpg").'" class="img-reporte-header" style="width:98%;top:-40px;position:fixed;"/>
			           <hr style="position:fixed;top:90px;">
			';
			return $header;
		}

		public function getFooter(){
			$footer=' 
					<img src="'.base_url("resources/imagenes/Reporte/footerReporte.jpg").'" class="img-reporte-footer" style="width:100%;bottom:60px;position:fixed;"/>
			';
			return $footer;
		}

		public function getEncCotReport($idCot){
			$encCot = $this->getEncCot($idCot);
			$meses = $this->meses();
			$res = new stdClass();
			date_default_timezone_set('America/El_Salvador');
			$cli = $this->getDatosCliente($encCot[0]->cot_cli_id);
			$fechaActual	= 	"San Salvador,".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
			$res->encabezado='
				<div class="cuerpo" style="top:105px;position:fixed;height:990px;">
		      	<div class="fechaActual" style="text-align:center;">'.$fechaActual.'</div>
		      	<div class="cont">
		      		'.$cli->cli_titulo.'<br>
					'.$cli->cli_contacto.'  <br>
					'.$cli->cli_razon_social.' <br>
					Presente <br> ';
					if(substr($cli->cli_titulo, -1)=="o"){
						$sal="Estimado";
						}else{
							$sal="Estimada";
						}

					$res->encabezado .= $sal.' '.$cli->cli_titulo.'.<br><br>

					Reciba un cordial saludo de parte de Grupo Radio Stereo y sus estaciones: Fiesta, Femenina, Ranchera, Láser Inglés y Láser Español.<br><br>
			';
			$res->valorAgregado = $encCot[0]->cot_valor_agregado;
			return $res;
		}

		public function getProdCli($idProd){
			$sql="SELECT * FROM pro_producto
				WHERE pro_id = ".$idProd."";
				$this->db->trans_start();
				$query = $this->db->query($sql);
				$query = $query->result();

			return $query;
		}

		public function getDetBloqReporte($idCot){
			$encBloq =  $this->getEnReporte($idCot,"enc_prog_id");
			$res = new stdClass();
			if($encBloq){
				$sql="SELECT  * FROM prog_programa WHERE prog_id = ".$encBloq[0]->enc_prog_id."";
				$this->db->trans_start();
				$progId=$this->db->query($sql);
				$progId=$progId->result();
				$this->db->trans_complete();
				$detalle=$this->getDetalleReporte($encBloq[0]->enc_id,$encBloq[0]->enc_precio_venta);
				$fi=substr($encBloq[0]->enc_fecha_inicio,"5","2");
				$ffin=substr($encBloq[0]->enc_fecha_fin,"5","2");
				$periodo=$ffin-$fi;
				$periodo=$periodo+1;
				$encCot = $this->getEncCot($idCot);
				$prod = $this->getProdCli($encCot[0]->cot_pro_id);
				if($periodo>1){
					$periodo=$periodo." meses";
				}else{
					$periodo=$periodo." mes";
				}
				$res->exp = '
					Por este medio someto a su evaluación, presupuesto de inversión publicitaria en el Programa : 
					<b>'.$progId[0]->prog_nombre.'</b>
					para la campaña de <b>'.$prod[0]->pro_nomb_producto.'</b>.  A continuación el detalle:<br><br>
					';
				$res->servic ='
				<b>Programa :'.$progId[0]->prog_nombre.'</b>
				<br><br>
							<div style="text-align:center;width:100%;">Periodo de Contratacion : '.$periodo.'</div><br>
					<table border=1 class="cont-table-report" style="width:85%;text-align:center;margin:auto;"  cellspacing="0">
						<tr style="background:#9CC2E5;">
							<td>Servicio</td>
							<td>Costo Por Segundo</td>
							<td>Cantidad</td>
							<td>Duracion(Seg)</td>
							<td>Sub Total</td>
						</tr>
						<tbody style="background:#BFBFBF;">
						'.$detalle->servi.'
						</tbody>
						</table>
					<table border=0 cellspacing="0" style="margin-left:307px;width:550px;border-bottom:1.5px solid #000000;border-left:1.5px solid #000000;border-right:1.5px solid #000000;font-size:0.9em;">

						<tr>
							<td style="border-right:1.5px solid #000000;width:158px;">Total por Servicios</td>
							<td style="text-align:center;"> $ '.number_format($detalle->total,2,".",",").'</td>
						</tr>
						<tr>

						<tr>
							<td style="border-right:1.5px solid #000000;width:158px;">Total por Servicios</td>
							<td style="text-align:center;"> $ '.number_format($detalle->total,2,".",",").'</td>
						</tr>
						<tr>

							<td style="border-right:1.5px solid #000000;">
								Descuento
							</td>
							<td style="text-align:center;">
								 $ '.number_format($detalle->descuento,2,".",",").'
							</td>
						</tr>
						<tr>
							<td style="border-right:1.5px solid #000000;">
								Precio de Venta 
							</td>
							<td style="text-align:center;">
								 $ '.number_format($encBloq[0]->enc_precio_venta,2,".",",").'
							</td>
						</tr>
					</table>

			';
			$res->contador=$detalle->contador;
			}else{
				$res->servic="";
				$res->contador=0;
				$res->exp="";
			}
			return $res;
		}

		public function getPrecioReporte($id){
			$sql="SELECT * FROM pre_precio
				where pre_id=".$id."
			";
			$this->db->trans_start();
			$query=$this->db->query($sql);
			$this->db->trans_complete();
			$query=$query->result();
			return $query[0];
		}

		public function getDetalleReporte($id,$pventa){
			$rad = $this->getDetIdReporte($id,"det_serv_id");
			$res = new stdClass();
			$res->servi="";
			$res->total=0;
			if($rad){
					foreach ($rad as $valor) {
					$serv = $this->getServicios($valor->det_serv_id);
					foreach ($serv as $row) {
						$ser=$row->serv_nombre;
					}
					$precio = $this->getPrecioReporte($valor->det_pre_id);
					$res->contador = count($rad);
					$res->servi.='
					<tr>
						<td style="text-align:left;">'.$ser.'
						</td>
						<td> $ 	'.$precio->pre_precio.'</td>
						<td>	'.$valor->det_cantidad.'</td>
						<td>	'.$valor->det_duracion.'</td>
						<td> $ 	'.number_format($valor->det_subtotal,2,".",",").'</td>
					</tr>
				';
				$res->total+=$valor->det_subtotal;
				}

				$res->descuento = $res->total - $pventa;
				
			}else{
				$res->contador=0;
				$res->servi="";
				$res->total=0;
				$res->descuento=0;
			}
			
			return $res;
		}

		public function getProg($idCot){
			$enc = $this->getEncCotReport($idCot);
			$sql="SELECT  * FROM cot_encabezado_cotizacion cot JOIN tip_tipo tip ON cot.cot_tip_id=tip.tip_id WHERE cot.cot_id = ".$idCot."";
			$this->db->trans_start();
			$cot=$this->db->query($sql);
			$cot=$cot->result();
			$this->db->trans_complete();
			$gdb=$this->getDetBloqReporteSec($idCot);
			$p=$this->getDetBloqReporte($idCot);
			

			// consulta para traer la firma del usuario
			$que="select * from usu_usuario where usu_id =".$_SESSION['iduser']." ";
			$this->db->trans_start();
			$firma=$this->db->query($que);
			$firma=$firma->result();
			$this->db->trans_complete();
			if($enc){
				$res = '
							'.$this->getHeader().'
		      				'.$this->getFooter().'      				
		      				<article>
		      				'.$enc->encabezado.'';
		      				if($gdb->contador>1 && $p->contador > 1){
								$res.='<br><br>';
							}
							$res.= $p->exp;
							$res.= $gdb->exp;
							$res.= $p->servic;

							if(count($gdb->radios)==1){
								if($p!=null){
									if($gdb->radios[0]!=""){
										if($p->contador > 1 && $gdb->contador[0] > 1){
											$res .=	'<div style="page-break-before: always;"></div>';
										}elseif($p->contador == 1 && $gdb->contador[0] > 1 || $p->contador > 1 && $gdb->contador[0] == 1){
											$res .=	'<div style="page-break-before: always;"></div>';
										}
										$res .=	$gdb->radios[0];
									}
								}else{
									if($gdb->radios[0]!=""){
										$res .=	$gdb->radios[0];
									}
								}
							}else if(count($gdb->radios)==3){
								if($p!=null){
									if($p->contador >=1){
										if($gdb->radios[0]!="" && $gdb->radios[1]!="" && $gdb->radios[2]!=""){
											$res .=	$gdb->radios[0];
											$res .=	'<div style="page-break-before: always;"></div><div class="cont-secprint">
											'.$gdb->radios[1];
											$res .= '
											'.$gdb->radios[2].'</div>';
										}
									}else{
										if($gdb->radios[0]!="" && $gdb->radios[1]!="" && $gdb->radios[2]!=""){
											$res .=	$gdb->radios[0];
											$res .=	$gdb->radios[1];
											$res .= '<div style="page-break-before: always;"></div><div class="cont-secprint">
											'.$gdb->radios[2].'</div>';
										}
									}
									
								}else{
									if($gdb->radios[0]!="" && $gdb->radios[1]!="" && $gdb->radios[2]!=""){
									$res .=	$gdb->radios[0];
									$res .=	$gdb->radios[1];
									$res .= '<div style="page-break-before: always;"></div><div class="cont-secprint">
									'.$gdb->radios[2].'</div>';
								}
							}
							}else if(count($gdb->radios)==2){
								if($p!=null){
									if($p->contador >= 1){
										if(isset($gdb->radios[0]) && $gdb->radios[0]!=""){
											$res .=	$gdb->radios[0];
										}
										if(isset($gdb->radios[1]) && $gdb->radios[1]!=""){
											$res .= '<div style="page-break-before: always;"></div><div class="cont-secprint">
											'.$gdb->radios[1].'</div>';	
										
										}
										if(isset($gdb->radios[2]) && $gdb->radios[2]!=""){
											$res .= '<div style="page-break-before: always;"></div><div class="cont-secprint">
											'.$gdb->radios[2].'</div>';	
										}
									}else{
										if(isset($gdb->radios[0]) && $gdb->radios[0]!=""){
											$res .=	$gdb->radios[0];
										}
										if(isset($gdb->radios[0]) && isset($gdb->radios[1])){
											if($gdb->radios[0]!="" && $gdb->radios[1]!=""){
												if($gdb->contador[0] > 1 || $gdb->contador[1] > 1 ){
													$res .= '<div style="page-break-before: always;"></div>';
												}
											}
										}else if(isset($gdb->radios[0]) && isset($gdb->radios[2])){
											if($gdb->radios[0]!="" && $gdb->radios[2]!=""){
												if($gdb->contador[0] > 1 || $gdb->contador[2] > 1 ){
													$res .= '<div style="page-break-before: always;"></div>';
												}
											}
										}
										if(isset($gdb->radios[1]) && $gdb->radios[1]!=""){
											$res .= '<div class="cont-secprint">
											'.$gdb->radios[1].'</div>';	
										
										}
										if(isset($gdb->radios[2]) && $gdb->radios[2]!=""){
											$res .= '<div class="cont-secprint">
											'.$gdb->radios[2].'</div>';	
										}
									}
								}else{
									if(isset($gdb->radios[0]) && $gdb->radios[0]!=""){
										$res .=	$gdb->radios[0];
									}
									if(isset($gdb->radios[1]) && $gdb->radios[1]!=""){
										$res .=	$gdb->radios[1];
									
									}
									if(isset($gdb->radios[2]) && $gdb->radios[2]!=""){
										$res .=	$gdb->radios[2];
									}
							}
							}
							if(!$enc->valorAgregado){
								$valorAgregado="Sin Beneficios";
							}else{
								$valorAgregado=$enc->valorAgregado;
							}
							/*'.substr("Licenciado", -1).'*/
					 	 $res.='<br>
					 	<p style="word-wrap:break-word;margin-top:-10px;"><b>Beneficios por su compra:</b><br>'.nl2br($valorAgregado).'</p><br>
								 	 <article style="position:fixed;bottom:251px;">
								 	 Forma de Pago : '.$cot[0]->tip_tipo.'<br><br>
								 		Esperando poder servirles muy pronto, me despido.<br><br>

										Atentamente,<br><br> ';
								$res.=  nl2br($firma[0]->usu_firma);
							$res.= '	</article>
					      	</div>
					      </div>
					      </article>
						';
			}else{
				$res="";
			}
			
			return $res;
		}


//a partir de aca estara todas las funciones para generar el reporte de las secciones 

		public function getRadiosReporte($id){
			$sql="SELECT * FROM rad_radio
			WHERE rad_id=$id";
			$this->db->trans_start();
			$query=$this->db->query($sql);
			$query=$query->result();
			$this->db->trans_complete();
			return $query;
		}


		public function getDetalleReporteRad($id,$pventa){
			$rad = $this->getDetIdReporte($id,"det_rad_id");
			$res = new stdClass();
			$res->servi="";
			$res->detRadios="";
			$res->total=0;
			if($rad){
			foreach ($rad as $key => $valor) {
				$serv = $this->getRadiosReporte($valor->det_rad_id);
				foreach ($serv as $i => $row) {
					$ser=$row->rad_nombre;
				}
					$precio = $this->getPrecioReporte($valor->det_pre_id);
					$res->contador = count($rad);
						$nomRadio = $this->getRadiosReporte($valor->det_rad_id);
						if($res->contador <= 1){
							$res->detRadios = $nomRadio[0]->rad_nombre;
						}else{
							if($key == 0){
								$res->detRadios .= $nomRadio[0]->rad_nombre;	
							}else{
								$res->detRadios .= ", ".$nomRadio[0]->rad_nombre;	
							}
						}
					$res->servi.='
					<tr>
						<td style="text-align:left;">'.$ser.'</td>
						<td> $ 	'.$precio->pre_precio.'</td>
						<td>	'.$valor->det_cantidad.'</td>';
						if($valor->det_cuna_diaria){
							$res->servi.='<td>	'.$valor->det_cuna_diaria.'</td>';
						}
						$res->servi.='<td>	'.$valor->det_duracion.'</td>
						<td> $ 	'.number_format($valor->det_subtotal,2,".",",").'</td>
					</tr>
				';
				$res->total+=$valor->det_subtotal;
			}
			$res->descuento = $res->total - $pventa;
			}else{
				$res->contador=0;
				$res->servi="";
				$res->total=0;
				$res->descuento=0;
				$res->detRadios="";
			}
			return $res;
		}
		

		public function getDetBloqReporteSec($idCot){
			$encBloq =  $this->getEnReporte($idCot,"enc_sec_id");
			$res = new stdClass();
			foreach ($encBloq as $i => $valor) {
			if($valor){
						$sql="SELECT  * FROM 
						(sec_seccion s JOIN enc_encabezado_bloque e
						ON s.sec_id=e.enc_sec_id)
						WHERE sec_id = ".$valor->enc_sec_id."";
						$this->db->trans_start();
						$progId=$this->db->query($sql);
						$progId=$progId->result();
						$this->db->trans_complete();
						$detalle=$this->getDetalleReporteRad($valor->enc_id,$valor->enc_precio_venta);
						$fi=substr($valor->enc_fecha_inicio,"5","2");
						$ffin=substr($valor->enc_fecha_fin,"5","2");
						$periodo=$ffin-$fi;
						$periodo=$periodo+1;
						if($periodo>1){
							$periodo=$periodo." meses";
						}else{
							$periodo=$periodo." mes";
						}
						$res->contador[$i]=$detalle->contador;
						if($progId[0]->sec_nombre=="Cuña"){
							$SecNom = "Cuña Rotativa";
						}else{
							$SecNom = $progId[0]->sec_nombre;
						}
						// $detalle->detRadios
						$encCot = $this->getEncCot($idCot);
						$prod = $this->getProdCli($encCot[0]->cot_pro_id);
						if($detalle->contador <= 1){
							$las = "radio";
						}else{
							$las = "radios";
						}
						$res->exp = "
							Por este medio someto a su evaluación, presupuesto de inversión publicitaria en ".$las.":
							<b>".$detalle->detRadios."</b>
							para la campaña de <b>".$prod[0]->pro_nomb_producto."</b>.  A continuación el detalle:<br><br>
						";
						$res->radios[$i]="";
						$res->radios[$i].='
							<b>Servicio Ofertado : '.$SecNom.'</b>
							<br><br>
							<div style="text-align:center;width:100%;">Periodo de Contratacion : '.$periodo.'</div><br>
								<table border=1 class="cont-table-report" style="width:90%;text-align:center;margin:auto;"  cellspacing="0">
								<tr style="background:#9CC2E5;">
									<td>Radio</td>
									<td style="width:130px;">Costo Por Segundo</td>
									<td style="width:80px;">Cantidad</td>';
									if($progId[0]->sec_id==1){
										$res->radios[$i].="<td style='width:100px;'>Cuñas Diarias</td>	";
										$estilo1='
											style="margin-left:352px;width:553px;border-bottom:1.5px solid #000000;border-left:1.5px solid #000000;border-right:1.5px solid #000000;font-size:0.9em;"
										';
										$estilo2='
											style="width:92px;text-align:center;"
										';
									}else{
										$estilo1='
											style="margin-left:316px;width:565px;border-bottom:1.5px solid #000000;border-left:1.5px solid #000000;border-right:1.5px solid #000000;font-size:0.9em;"
										';
										$estilo2='
											style="width:140px;text-align:center;"
										';
									}
									$res->radios[$i].='<td style="width:100px;">Duracion(Seg)</td>
									<td>Sub Total</td>
								</tr>
								<tbody style="background:#BFBFBF;">
								'.$detalle->servi.'
								</tbody>
								</table>
							<table border=0 cellspacing="0" '.$estilo1.' >
								<tr >
									<td style="border-right:1.5px solid #000000;">Total por Servicios</td>
									<td '.$estilo2.'> $ '.number_format($detalle->total,2,".",",").'</td>
								</tr>
								<tr >
									<td style="border-right:1.5px solid #000000;">
										Descuento
									</td>
									<td style="text-align:center;">
										 $ '. number_format($detalle->descuento,2,".",",").'
									</td>
								</tr>
								<tr>
									<td style="border-right:1.5px solid #000000;">
										Precio de Venta 
									</td>
									<td style="text-align:center;">
										 $ '.number_format($valor->enc_precio_venta,2,".",",").'
									</td>
								</tr>
							</table>
					';
				}
			}
			if(!isset($res->radios)){
				for ($i=0; $i < 3 ; $i++) { 
					$res->radios[$i]="";	
					$res->contador="";
					$res->exp="";
				}
				
			}
			return $res;
		}



		//Aprobar Cotizaciones

		public function aprobarCotizaciones($frm){
			$seleccionado 	= 	$frm;
			$r  			= 	new stdClass();
			$r->contador 	= 	count($seleccionado);
			foreach ($seleccionado as $valor) {
				$flag  	= 	$this->updateEstadoCot($valor->cotApro);
				if($flag){
					$r->res 	=  	true;
				}else{
					$r->res 	= 	false;
					break;
				}
			}

			return $r;

		}



		public function updateEstadoCot($idCot){
			$tabla 			= array(
				'cot_est_id'			=> 2
				);
			$this->db->where('cot_id',$idCot);
			$res=$this->db->update('cot_encabezado_cotizacion',$tabla);
			return $res;
		}
	}
 ?>