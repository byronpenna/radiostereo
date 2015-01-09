<?php 
	/**
	* 
	*/
	class Cotizacionesm extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}
		public function SelectCotizacion()
		{
			$this->db->trans_start();
			$consulta = "SELECT * FROM cot_encabezado_cotizacion join cli_cliente on cli_id=cot_cli_id";
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
		public function getCotizacion()
		{
			$datos = $this->SelectCotizacion();
			
			if($datos!="nada"){
					$retorno = "";
				foreach ($datos as $row) {
					$retorno .= "<tr class='styleTR'>
									<td style='display:none'>".$row->cot_id."</td>
									<td style='display:none'>".$row->cli_id."</td>
									<td>".$row->cli_nombres."</td>
									<td>".$row->cli_razon_social."</td>
									<td>".$row->cli_nit."</td>
									<td>".$row->cot_fecha_elaboracion."</td>
									<td><center><a href='".site_url('cotizacionesc/cotizacionesc/editarCotizacion/'.$row->cot_id.'') ."' style='text-decoration:none;color:#FFFFFF;'><button class='btn btn-sm btn-primary' >Editar</button></a>
										<a href='".site_url('cotizacionesc/cotizacionesc/eliminarCotizacion/'.$row->cot_id.'') ."' style='text-decoration:none;color:#FFFFFF;'><button class='btn btn-sm btn-danger' >Eliminar</button></a>
										<a href='".site_url('cotizacionesc/cotizacionesc/printCotizacion/'.$row->cot_id.'') ."' style='text-decoration:none;color:#FFFFFF;' target='_blank'><button class='btn btn-sm btn-info' >Reporte</button></a></center>
									</td>
								 </tr>";
				}
			}else{
				$retorno="Aun No ha generado ninguna cotizacion";
			}
			
			return $retorno;
		}

		public function getEncCot($id){
			$sql="SELECT * FROM cot_encabezado_cotizacion WHERE cot_id=".$id."";
			$this->db->trans_start();
			$query=$this->db->query($sql);
			$query=$query->result();
			$this->db->trans_complete();
			return $query;
		}

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


		public function estCot($id){
			$datos = new stdClass();
			$datos->validacion=false;
			$sql="SELECT * FROM est_estado";
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
					if($valor->est_id==$id){
						$s="selected";
					}else{
						$s="";
					}
					$r.="<option value='".$valor->est_id."' $s>".$valor->est_estado."</option>";
				}
			}
			return $r;
		}

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
                        <select name="estado_cot" class="form-control input-sm pequenios " >
                            '.$this->estCot($row->cot_est_id).'
                        </select>
                    </span></p>
                </article>
                <article>
                    <p><br>Fecha de Creacion <span> <input type="text" name="txtFechaCreacionCot" value="'.$row->cot_fecha_elaboracion.'" class="form-control input-sm medios" readonly="true"></span></p>
                </article>
            </article>
				';
			}
			return $res;
		}


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

		public function queryEncBloque($idCot){
			$sql="SELECT * FROM enc_encabezado_bloque WHERE enc_cot_id=".$idCot."";
			$this->db->trans_start();
			$query=$this->db->query($sql);
			$query=$query->result();
			$this->db->trans_complete();
			return $query;		
		}

		

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


		public function getServicios($id){
			$sql="SELECT serv_nombre FROM serv_servicio
			WHERE serv_id=$id";
			$this->db->trans_start();
			$query=$this->db->query($sql);
			$query=$query->result();
			$this->db->trans_complete();
			return $query;
		}

		

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
					if(!$valor->det_cantidad || !$valor->det_duracion || !$valor->det_subtotal || !$valor->det_pre_id){
						$valor->det_cantidad 	=	"";
						$valor->det_duracion 	=	"";
						$valor->det_subtotal 	=	"";
						$valor->det_pre_id 		=	"";
					}
				$res.="<tr>
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



		public function getRadiosCot($idEncBloq){
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
					if(!$valor->det_cantidad || !$valor->det_duracion || !$valor->det_subtotal){
						$valor->det_cantidad="";
						$valor->det_duracion="";
						$valor->det_subtotal="";
					}
				$res.="<tr>
						<td><input type='hidden' value='".$valor->det_rad_id."' name='txtIdServ' /><input type='hidden' value='".$valor->det_id."' name='txtIdDet' />".$valor->rad_nombre."</td>
                                <td>".$this->getPrecios($valor->det_pre_id)."</td>
                                <td><input type='text' name='txtCantidad' value='".$valor->det_cantidad."'  class='blur form-control input-sm inAddCot SoloNumero txtCantidad'></td>
                                <td><input type='text' name='txtDuracion' value='".$valor->det_duracion."'  placeholder='Segundos' class='blur form-control input-sm inAddCot SoloNumero txtDuracion'></td>
                                <td><input type='text' name='txtSubTotal' value='".$valor->det_subtotal."' placeholder='$'  class='txtSubTotal form-control input-sm inAddCot subTotal' readonly='true'></td>
					</tr>";
				}	
			}
			return $res;	
		}







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
                                <td><p>Precio</p></td>
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
                                <td><input type="text" name="total"  class="form-control input-sm inAddCot descuento"  placeholder="$"  readonly="true"></td>
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
                            <input type=\'text\' value=\'\' class=\'txtEvents\'>  
                            <div id="contenedor1" class="conteCalendario">
								<div class="calendar"></div><br>
							</div> 
                    </article>
                    </article>
                </article>
                
			';	
			return $r;
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
			$r='
				<!-- Contenedor para las Cuñas -->
                <article id="conProgra"  class="conProgra">
                <input type="hidden" name="txtIdEncabezado" value="'.$query[1]->enc_id.'" />
                    <h4 class="text-center">Cu&ntilde;a</h4>
                    <input type="hidden" name="txtIdSec" value="1" >
                    <article class="contTitle">
                    </article>
                    <article class="cuerpo">
                        <table border=0 width="100%" rules="all" class="Tcalculo">
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
                            '.$this->getRadiosCot($query[1]->enc_id).'
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
                                <td><input type="text" name="total"  class="form-control input-sm inAddCot descuento"  placeholder="$"  readonly="true"></td>
                            </tr>
                            <tr class="txtDerecha">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Precio de Venta</td>
                                <td><input type="text" class="NumPunto form-control inAddCot input-sm blur pventa" value="'.$query[1]->enc_precio_venta.'" name="pventa"  placeholder="$"></td>
                            </tr>
                        </tfoot>
                        </table>
                        <article class="fechasFooter" >
                            <article class="fechaInicio">
                                    <span>Inicio de Pauta </span>    
                                    <span>
                                        <input type="text" name="txtFechaInicio" value="'.$query[1]->enc_fecha_inicio.'"  placeholder="aaaa-mm-dd" class="fi form-control input-sm medios datepicker txtFechaInicio" required>
                                    </span>
                            </article>        
                           
                            <article class="fechaFin" >
                                <span >Fin de Pauta</span>    
                                <span>
                                    <input type="text" name="txtFechaFin" value="'.$query[1]->enc_fecha_fin.'"  placeholder="aaaa-mm-dd" class="form-control input-sm medios datepicker ffin" required>
                                </span>
                            </article> <img src="'.base_url("resources/imagenes/calendario.png").'" class="imagen" />   
                    </article>
                    </article>
                </article>
                <!-- Finaliza contenedor de las cuñas -->
                <!-- Contenedor para las Entrevistas -->
                <article id="conProgra" class="conProgra">
                <input type="hidden" name="txtIdEncabezado" value="'.$query[2]->enc_id.'" />
                    <h4 class="text-center">Entrevista</h4>
                    <input type="hidden" name="txtIdSec" value="2" >
                    <article class="contTitle">
                    </article>
                    <article class="cuerpo">
                        <table border=0 width="100%" rules="all" class="Tcalculo">
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
                            '.$this->getRadiosCot($query[2]->enc_id).'
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
                                <td><input type="text" name="total"  class="form-control input-sm inAddCot descuento"  placeholder="$"  readonly="true"></td>
                            </tr>
                            <tr class="txtDerecha">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Precio de Venta</td>
                                <td><input type="text" class="NumPunto form-control inAddCot input-sm blur pventa" value="'.$query[2]->enc_precio_venta.'" name="pventa"  placeholder="$"></td>
                            </tr>
                        </tfoot>
                        </table>
                        <article class="fechasFooter " >
                            <article class="fechaInicio">
                                    <span>Inicio de Pauta</span>    
                                    <span>
                                        <input type="text" name="txtFechaInicio" value="'.$query[2]->enc_fecha_inicio.'"  placeholder="aaaa-mm-dd" class="fi form-control input-sm medios  datepicker txtFechaInicio" required>
                                    </span>
                            </article>     
                            
                            <article class="fechaFin" >
                                <span >Fin de Pauta</span>    
                                <span>
                                    <input type="text" name="txtFechaFin"  placeholder="aaaa-mm-dd"  value="'.$query[2]->enc_fecha_fin.'" class="form-control input-sm medios datepicker ffin" required>
                                </span>
                            </article><img src="'.base_url("resources/imagenes/calendario.png").'" class="imagen" />    
                    </article>
                    </article>
                </article>
                <!-- Finaliza contenedor de las entrevistas -->
                <!-- Contenedor para las Producciones -->
                <article id="conProgra"  class="conProgra">
                <input type="hidden" name="txtIdEncabezado" value="'.$query[3]->enc_id.'" />
                    <h4 class="text-center">Producci&oacute;n</h4>
                    <input type="hidden" name="txtIdSec" value="3">
                    <article class="contTitle">
                    </article>
                    <article class="cuerpo">
                        <table border=0 width="100%" rules="all" class="Tcalculo">
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
                            '.$this->getRadiosCot($query[3]->enc_id).'
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
                                <td><input type="text" name="total"  class="form-control input-sm inAddCot descuento"  placeholder="$"  readonly="true"></td>
                            </tr>
                            <tr class="txtDerecha">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Precio de Venta</td>
                                <td><input type="text" class="NumPunto form-control inAddCot input-sm blur pventa" value="'.$query[3]->enc_precio_venta.'" name="pventa"  placeholder="$"></td>
                            </tr>
                        </tfoot>
                        </table>
                        <article class="fechasFooter">
                            <article class="fechaInicio">
                                    <span>Inicio de Pauta </span>    
                                    <span>
                                        <input type="text" name="txtFechaInicio"  placeholder="aaaa-mm-dd" value="'.$query[3]->enc_fecha_inicio.'" class="fi form-control input-sm medios  datepicker txtFechaInicio" required>
                                    </span>
                            </article>     
                           
                            <article class="fechaFin" >
                                <span >Fin de Pauta</span>    
                                <span>
                                    <input type="text" name="txtFechaFin"  placeholder="aaaa-mm-dd" value="'.$query[3]->enc_fecha_fin.'" class="form-control input-sm medios datepicker ffin" required>
                                </span>
                            </article>  <img src="'.base_url("resources/imagenes/calendario.png").'" class="imagen" />  
                    </article>
                    </article>
                </article>
                <!-- Finaliza contenedor de las Produccion -->
                
			';
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
								@$obj = $this->getObjDetalle($valor->txtIdDet[$i],$valor->precio[$i],$valor->txtCantidad[$i],$valor->txtDuracion[$i],$valor->txtSubTotal[$i]);
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
				'cot_est_id'			=> $obj->estado_cot
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

		public function getObjDetalle($IdDet,$precio,$cantidad,$duracion,$subTotal){
			$obj = new stdClass();
			$obj->det_id 		= $IdDet;
			$obj->det_pre_id 	= $precio;
			$obj->det_cantidad 	= $cantidad;
			$obj->det_duracion 	= $duracion;
			$obj->det_subtotal 	= $subTotal;
			return $obj;
		}



		public function editDetBloque($obj){
			$tabla = array(
				'det_pre_id'	=> $obj->det_pre_id,
				'det_cantidad' 	=> $obj->det_cantidad,
				'det_duracion' 	=> $obj->det_duracion,
				'det_subtotal' 	=> $obj->det_subtotal,
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
					<page_header> 
			           <img src="'.base_url("resources/imagenes/Reporte/headerReporte.jpg").'" class="img-reporte-header"/>
			           <div class="hr-reporte">
			           </div>
		      		</page_header> 
			';
			return $header;
		}

		public function getFooter(){
			$footer='
				<page_footer> 
					<img src="'.base_url("resources/imagenes/Reporte/footerReporte.jpg").'" class="img-reporte-footer"/>
		      </page_footer> 
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
				<div class="cuerpo">
		      	<div class="fechaActual">'.$fechaActual.'</div>
		      	<div class="cont">
		      		Licenciado (a)<br>
					'.$cli->cli_contacto.'  <br>
					'.$cli->cli_razon_social.' <br>
					Presente <br>
					Estimada (o)  Lic. (Licda.):<br><br>

					Reciba un cordial saludo de parte de Grupo Radio Stereo y sus estaciones: Fiesta, Femenina, Ranchera, Láser Inglés y Láser Español.<br><br>

					Por este medio someto a su evaluación, presupuesto de inversión publicitaria.  A continuación el detalle:<br><br>
			';
			$res->valorAgregado = $encCot[0]->cot_valor_agregado;
			return $res;
		}

		public function getDetBloqReporte($idCot){
			$encBloq =  $this->getEnReporte($idCot,"enc_prog_id");
			if($encBloq){
				$sql="SELECT  * FROM prog_programa WHERE prog_id = ".$encBloq[0]->enc_prog_id."";
				$this->db->trans_start();
				$progId=$this->db->query($sql);
				$progId=$progId->result();
				$this->db->trans_complete();
				$detalle=$this->getDetalleReporte($encBloq[0]->enc_id,$encBloq[0]->enc_precio_venta);
				$res ='
				<b>'.$progId[0]->prog_nombre.'</b>
					<table border=0 class="cont-table-report">
						<tr style="background:#3498db;">
							<td>Servicio</td>
							<td>Precio</td>
							<td>Cantidad</td>
							<td>Duracion(Seg)</td>
							<td>Sub Total</td>
						</tr>
						'.$detalle->servi.'
						</table>
					<br>
					
					<table>
						<tr>
							<td>Total por Servicios</td>
							<td>: $ '.number_format($detalle->total,2,".",",").'</td>
						</tr>
						<tr>
							<td>
								Descuento
							</td>
							<td>
								: $ '.number_format($detalle->descuento,2,".",",").'
							</td>
						</tr>

						<tr>
							<td>
								Precio de Venta 
							</td>
							<td>
								: $ '.number_format($encBloq[0]->enc_precio_venta,2,".",",").'
							</td>
						</tr>
					</table>
			';
			}else{
				$res="";
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
			foreach ($rad as $valor) {
				$serv = $this->getServicios($valor->det_serv_id);
				foreach ($serv as $row) {
					$ser=$row->serv_nombre;
				}
				$precio = $this->getPrecioReporte($valor->det_pre_id);
				$res->servi.='
				<tr>
					<td>'.$ser.'</td>
					<td> $ 	'.$precio->pre_precio.'</td>
					<td>	'.$valor->det_cantidad.'</td>
					<td>	'.$valor->det_duracion.'</td>
					<td> $ 	'.number_format($valor->det_subtotal,2,".",",").'</td>
				</tr>
			';
			$res->total+=$valor->det_subtotal;
			}

			$res->descuento = $res->total - $pventa;
			
			return $res;
		}

		public function getProg($idCot){
			$enc = $this->getEncCotReport($idCot);
			$encBloq =  $this->getEnReporte($idCot,"enc_prog_id");
			if($enc){
				$par =$this->getEnReporte($idCot,"enc_sec_id");

				$res = '
							<page backtop="23mm" backleft="13mm" backright="10mm"> 
		      				'.$this->getHeader().'
		      				'.$this->getFooter().'
		      				'.$enc->encabezado.'
							'.$this->getDetBloqReporte($idCot).'';
							$gdb=$this->getDetBloqReporteSec($idCot);
							$p=$this->getDetBloqReporte($idCot);
							if(count($gdb)==1){
								if($gdb[0]!=""){
									$res .=	$gdb[0];
								}
							}else if(count($gdb)==3){
								if($p!=null){
									if($gdb[0]!="" && $gdb[1]!="" && $gdb[2]!=""){
									$res .=	$gdb[0];
									$res .=	'<page pageset="old"><div class="cont-secprint">
									'.$gdb[1];
									$res .= '
									'.$gdb[2].'</div></page><br><br><br><br>';
								}
								}else{
									if($gdb[0]!="" && $gdb[1]!="" && $gdb[2]!=""){
									$res .=	$gdb[0];
									$res .=	$gdb[1];
									$res .= '<page pageset="old"><div class="cont-secprint">
									'.$gdb[2].'</div><br><br><br><br></page>';
								}
							}
							}else if(count($gdb)==2){
								if($p!=null){
									if(isset($gdb[0]) && $gdb[0]!=""){
										$res .=	$gdb[0];
									}
									if(isset($gdb[1]) && $gdb[1]!=""){
										$res .= '<page pageset="old"><div class="cont-secprint">
									'.$gdb[1].'</div><br><br><br><br></page>';	
									
									}
									if(isset($gdb[2]) && $gdb[2]!=""){
										$res .= '<page pageset="old"><div class="cont-secprint">
									'.$gdb[2].'</div><br><br><br><br></page>';	
									}
									
								}else{
									if(isset($gdb[0]) && $gdb[0]!=""){
										$res .=	$gdb[0];
									}
									if(isset($gdb[1]) && $gdb[1]!=""){
										$res .=	$gdb[1];
									
									}
									if(isset($gdb[2]) && $gdb[2]!=""){
										$res .=	$gdb[2];
									}
							}
							}
					 	 $res.='<br>
					 	<nobreak><p style="word-wrap:break-word;">'.$enc->valorAgregado.'</p></nobreak><br>
								 	 Jose Garcia Calderon<br>
								 	 Director de Ventas Grupo Radio Stereo<br>
								 	 7890-9876
					      	</div>
					      </div>
						</page>
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
			$res->total=0;
			foreach ($rad as $valor) {
				$serv = $this->getRadiosReporte($valor->det_rad_id);
				foreach ($serv as $row) {
					$ser=$row->rad_nombre;
				}
				$precio = $this->getPrecioReporte($valor->det_pre_id);
				$res->servi.='
				<tr>
					<td>'.$ser.'</td>
					<td> $ 	'.$precio->pre_precio.'</td>
					<td>	'.$valor->det_cantidad.'</td>
					<td>	'.$valor->det_duracion.'</td>
					<td> $ 	'.number_format($valor->det_subtotal,2,".",",").'</td>
				</tr>
			';
			$res->total+=$valor->det_subtotal;
			}

			$res->descuento = $res->total - $pventa;
			
			return $res;
		}
		

		public function getDetBloqReporteSec($idCot){
			$encBloq =  $this->getEnReporte($idCot,"enc_sec_id");
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
						$res[$i]='<br>
							<b>'.$progId[0]->sec_nombre.'</b>
								<table border=0 class="cont-table-report">
								<tr style="background:#3498db;">
									<td>Radio</td>
									<td>Precio</td>
									<td>Cantidad</td>
									<td>Duracion(Seg)</td>
									<td>Sub Total</td>
								</tr>
								'.$detalle->servi.'
								</table>
							<br>
							<table>
								<tr>
									<td>Total por Servicios</td>
									<td>: $ '.number_format($detalle->total,2,".",",").'</td>
								</tr>
								<tr>
									<td>
										Descuento
									</td>
									<td>
										: $ '. number_format($detalle->descuento,2,".",",").'
									</td>
								</tr>

								<tr>
									<td>
										Precio de Venta 
									</td>
									<td>
										: $ '.number_format($valor->enc_precio_venta,2,".",",").'
									</td>
								</tr>
							</table>
					';
				}
			}
			if(!isset($res)){
				for ($i=0; $i <3 ; $i++) { 
					$res[$i]="";	
				}
				
			}
			return $res;
			
		}



		public function getSec($idCot){
			$enc = $this->getEncCotReport($idCot);
			$encBloq =  $this->getEnReporte($idCot,"enc_sec_id");
			$det = 		$this->getDetBloqReporteSec($idCot);
			$res="";
				if($encBloq){
					foreach ($encBloq as $valor) {
							$res .= '
							<page backtop="30mm"> 
		      				'.$this->getHeader().'
		      				'.$this->getFooter().'
		      				'.$enc->encabezado.'

					 	 <br>
					 	 <br>
					 	 <br>
					 	 '.$enc->valorAgregado.'
		      	</div>
		      </div>
			</page>
			';
					}
			}else{
				$res="";
			}
			return $res;
		}
	}
 ?>