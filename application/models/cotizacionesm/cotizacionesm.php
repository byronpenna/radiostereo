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
									<td><a href='".site_url('cotizacionesc/cotizacionesc/editarCotizacion/'.$row->cot_id.'') ."' style='text-decoration:none;color:#FFFFFF;'><button class='btn btn-sm btn-primary' >Editar</button></a></td>
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
			$this->load->model("cotizacionm/cotizacionm");
			$cotizacionm=new cotizacionm();
			$precios  = $cotizacionm->getPrecios();
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
					if(!$valor->det_cantidad || !$valor->det_duracion || !$valor->det_subtotal){
						$valor->det_cantidad="";
						$valor->det_duracion="";
						$valor->det_subtotal="";
					}
				$res.="<tr>
						<td><input type='hidden' value='".$valor->det_serv_id."' name='txtIdServ' />".$valor->serv_nombre."</td>
                                <td>".$precios."</td>
                                <td><input type='text' name='txtCantidad' value='".$valor->det_cantidad."'  class='blur form-control input-sm inAddCot SoloNumero txtCantidad'></td>
                                <td><input type='text' name='txtDuracion' value='".$valor->det_duracion."'  placeholder='Segundos' class='blur form-control input-sm inAddCot SoloNumero txtDuracion'></td>
                                <td><input type='text' name='txtSubTotal' value='".$valor->det_subtotal."'  class='txtSubTotal form-control input-sm inAddCot subTotal' readonly='true'></td>
					</tr>";
				}	
			}
			return $res;	
		}



		public function getRadiosCot($idEncBloq){
			$this->load->model("cotizacionm/cotizacionm");
			$cotizacionm=new cotizacionm();
			$precios  = $cotizacionm->getPrecios();
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
						<td><input type='hidden' value='".$valor->det_rad_id."' name='txtIdServ' />".$valor->rad_nombre."</td>
                                <td>".$precios."</td>
                                <td><input type='text' name='txtCantidad' value='".$valor->det_cantidad."'  class='blur form-control input-sm inAddCot SoloNumero txtCantidad'></td>
                                <td><input type='text' name='txtDuracion' value='".$valor->det_duracion."'  placeholder='Segundos' class='blur form-control input-sm inAddCot SoloNumero txtDuracion'></td>
                                <td><input type='text' name='txtSubTotal' value='".$valor->det_subtotal."'  class='txtSubTotal form-control input-sm inAddCot subTotal' readonly='true'></td>
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
                    <h4 class="text-center">Programas</h4>
                    <article class="contTitle">
                        <article class="titleProgra"><span>Programa </span><span>
                            <select name="programa" class="form-control input-sm '.$c.'" style="width:240px;height:28px;padding:0px;"" >
                                '.$this->prog($query[0]->enc_prog_id).'
                            </select></span></article>
                        <article class="contPVenta"><span>Precio de Venta </span><span><input type="text" class="NumPunto form-control input-sm" name="pventa" value="'.$query[0]->enc_precio_venta.'" placeholder="$"></span></article>    
                    </article>
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
                        	'.$this->getServiciosCot($query[0]->enc_id).'
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
                                    <span>Inicio de Pauta </span>    
                                    <span>
                                        <input type="text" name="txtFechaInicio" value="'.$query[0]->enc_fecha_inicio.'" placeholder="aaaa-mm-dd" class="form-control input-sm medios  datepicker " required>
                                    </span>
                            </article>        
                            <article class="fechaFin" >
                                <span >Fin de Pauta</span>    
                                <span>
                                    <input type="text" name="txtFechaFin" value="'.$query[0]->enc_fecha_fin.'" placeholder="aaaa-mm-dd" class="form-control input-sm medios fechaFin datepicker ffin" required>
                                </span>
                            </article>    
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
                    <h4 class="text-center">Cu&ntilde;a</h4>
                    <input type="hidden" name="txtIdSec" value="1" >
                    <article class="contTitle">
                        <article class="contPVenta"><span>Precio de Venta </span><span><input type="text" class="NumPunto form-control input-sm" name="pventa" value="'.$query[1]->enc_precio_venta.'" placeholder="$" required></span></article>    
                    </article>
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
                            '.$this->getRadiosCot($query[1]->enc_id).'
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
                                    <span>Inicio de Pauta </span>    
                                    <span>
                                        <input type="text" name="txtFechaInicio" value="'.$query[1]->enc_fecha_inicio.'"  placeholder="aaaa-mm-dd" class="fi form-control input-sm medios datepicker" required>
                                    </span>
                            </article>        
                            <article class="fechaFin" >
                                <span >Fin de Pauta</span>    
                                <span>
                                    <input type="text" name="txtFechaFin" value="'.$query[1]->enc_fecha_fin.'"  placeholder="aaaa-mm-dd" class="form-control input-sm medios datepicker ffin" required>
                                </span>
                            </article>    
                    </article>
                    </article>
                </article>
                <!-- Finaliza contenedor de las cuñas -->
                <!-- Contenedor para las Entrevistas -->
                <article id="conProgra" class="conProgra">
                    <h4 class="text-center">Entrevista</h4>
                    <input type="hidden" name="txtIdSec" value="2" >
                    <article class="contTitle">
                        <article class="contPVenta"><span>Precio de Venta </span><span><input type="text" class="NumPunto form-control input-sm" name="pventa" value="'.$query[2]->enc_precio_venta.'" placeholder="$"  required></span></article>    
                    </article>
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
                            '.$this->getRadiosCot($query[2]->enc_id).'
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
                                    <span>Inicio de Pauta</span>    
                                    <span>
                                        <input type="text" name="txtFechaInicio" value="'.$query[2]->enc_fecha_inicio.'"  placeholder="aaaa-mm-dd" class="fi form-control input-sm medios  datepicker" required>
                                    </span>
                            </article>        
                            <article class="fechaFin" >
                                <span >Fin de Pauta</span>    
                                <span>
                                    <input type="text" name="txtFechaFin"  placeholder="aaaa-mm-dd"  value="'.$query[2]->enc_fecha_fin.'" class="form-control input-sm medios datepicker ffin" required>
                                </span>
                            </article>    
                    </article>
                    </article>
                </article>
                <!-- Finaliza contenedor de las entrevistas -->
                <!-- Contenedor para las Producciones -->
                <article id="conProgra"  class="conProgra">
                    <h4 class="text-center">Producci&oacute;n</h4>
                    <input type="hidden" name="txtIdSec" value="3">
                    <article class="contTitle">
                        <article class="contPVenta"><span>Precio de Venta </span><span><input type="text" class="NumPunto form-control input-sm" value="'.$query[3]->enc_precio_venta.'" name="pventa" value="" placeholder="$"  required></span></article>    
                    </article>
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
                            '.$this->getRadiosCot($query[3]->enc_id).'
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
                                    <span>Inicio de Pauta </span>    
                                    <span>
                                        <input type="text" name="txtFechaInicio"  placeholder="aaaa-mm-dd" value="'.$query[3]->enc_fecha_inicio.'" class="fi form-control input-sm medios  datepicker" required>
                                    </span>
                            </article>        
                            <article class="fechaFin" >
                                <span >Fin de Pauta</span>    
                                <span>
                                    <input type="text" name="txtFechaFin"  placeholder="aaaa-mm-dd" value="'.$query[3]->enc_fecha_fin.'" class="form-control input-sm medios datepicker ffin" required>
                                </span>
                            </article>    
                    </article>
                    </article>
                </article>
                <!-- Finaliza contenedor de las Produccion -->
			';
			return $r;
		}
	}
 ?>