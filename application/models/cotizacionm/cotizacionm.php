<?php 
	Class cotizacionm extends CI_Model{

		public function __construct(){
			parent:: __construct();
		}

		public function getDatosCliente($id){
			$datos = new stdClass();
			$datos->validacion=false;
			$sql="SELECT * FROM cli_cliente WHERE cli_id=".$id."";
			$this->db->trans_start();
				$query=$this->db->query($sql);
				if($query->num_rows()>0){
					$datos->validacion=true;
				}
				$query=$query->result();
			$this->db->trans_complete();
			return $query[0];
		}

		public function getTipoCotizacion(){
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
					$r.="<option value='".$valor->tip_id."'>".$valor->tip_tipo."</option>";
				}	
			}
			return $r;
		}


		public function getEstadoCotizacion(){
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
			$r="";
			if($datos->validacion===true){

				foreach ($query as $row) {
					if($_SESSION['rol']==2 && $row->est_id==3 || $_SESSION['rol']==2 && $row->est_id==4 || $_SESSION['rol']==2 && $row->est_id==5){
						$none = "style='display:none;'";	
					}else{
						$none ="";
					}
					$r .="<option value='".$row->est_id."' ".$none.">".$row->est_estado."</option>";
				}
			}
			return $r;
		}

		public function getProgramas(){
			$datos = new stdClass();
			$datos->validacion=false;
			$sql="SELECT * FROM prog_programa";
			$this->db->trans_start();
			$query=$this->db->query($sql);
			if($query->num_rows()>0){
				$datos->validacion=true;
			}
			$query=$query->result();
			$this->db->trans_complete();
			return $query;
		}

		public function getProdCliente($idCli){
			$sql="SELECT * FROM pro_producto
			WHERE 	pro_cli_id = ".$idCli."";
			$this->db->trans_start();
			$query = $this->db->query($sql);
			$query = $query->result();
			$res = "";
			foreach ($query as $row) {
				$res .= "
					<option value='".$row->pro_id."'>".$row->pro_nomb_producto."</option>
				";
			}
			return $res;
		}

		public function getProgAddCot(){
			$query=$this->getProgramas();
			$res= "";
			foreach ($query as $key => $valor) {
				$res.="<option value='".$valor->prog_id."'>".$valor->prog_nombre."</option>";
			}
			$res.="";
			return $res;
		}


		public function queryPrecios(){
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
			return $query;
		}


		public function getPrecios(){
			$query=$this->queryPrecios();
			$res= "<select name='precio' class='form-control input-sm mpequenios precios  blur'>
					<option value='-1'></option>";
			foreach ($query as $key => $valor) {
				$res.="<option value='".$valor->pre_id."'>$ ".$valor->pre_precio."</option>";
			}
			$res.="</select>";
			return $res;
		}



		public function getSeccionesAdd(){
			$sql="select * from sec_seccion";
			$this->db->trans_start();
			$query=$this->db->query($sql);
			$query = $query->result();
			$this->db->trans_complete();
			$res="";
			foreach ($query as $i => $valor) {
				$res .= '
						<article id="conProgra"  class="conProgra">
                    <h4 class="text-center">'.$valor->sec_nombre.'</h4>
                    <input type="hidden" name="txtIdSec" value="'.$valor->sec_id.'" >
                    <article class="contTitle">
                        <!-- <article class="contPVenta"><span>Precio de Venta </span><span><input type="text" class="NumPunto form-control input-sm" name="pventa" value="" placeholder="$" required></span></article>     -->
                    </article>
                    <article class="cuerpo">
                        <table border=0 width="100%" rules="all" class="Tcalculo">
                            <thead>
                            <tr>
                                <td></td>
                                <td><p>Costo Por Segundo</p></td>
                                <td><p>Cantidad</p></td> ';
                                if($valor->sec_id==1){
                                	$res.="<td>Cuñas Diarias</td>";
                                }
                               $res .= ' <td><p>Duración</p></td>
                                <td><p>Sub Total</p></td>
                            </tr>
                            </thead>
                            <tbody>
                            '.$this->getRadios($valor->sec_id).'
                            </tbody>
                            <tfoot>
                            <tr class="txtDerecha">
                                <td></td>
                                <td></td>
                                <td></td>';

                                if($valor->sec_id==1){
                                	$res.="<td></td>";
                                }
                                	
                                $res.='<td>Precio Sin Descuento</td>
                                <td><input type="text" name="total"  class="form-control input-sm inAddCot total" placeholder="$" readonly="true"></td>
                            </tr>
                            <tr class="txtDerecha">
                                <td></td>
                                <td></td>
                                <td></td>';
                                
                                if($valor->sec_id==1){
                                	$res.="<td></td>";
                                }
                                	
                                $res.='<td>Descuento</td>
                                <td><input type="text" name="descuento"  class="form-control input-sm inAddCot descuento"  placeholder="$"  readonly="true"></td>
                            </tr>
                            <tr class="txtDerecha">
                                <td></td>
                                <td></td>
                                <td></td>';
                                
                                if($valor->sec_id==1){
                                	$res.="<td></td>";
                                }
                                	
                                $res.='
                                
                                <td>Precio de Venta</td>
                                <td><input type="text" class="NumPunto form-control inAddCot input-sm blur pventa" name="pventa"  placeholder="$"></td>
                            </tr>
                        </tfoot>
                        </table>
                        <article class="fechasFooter" >
                            <article class="fechaInicio">
                                    <span>Inicio de Pauta </span>    
                                    <span>
                                        <input type="text" name="txtFechaInicio"  placeholder="dd-mm-aaaa" class="fi form-control input-sm medios datepicker fechaCreacion" required>
                                    </span>
                            </article>        
                            <article class="fechaFin" >
                                <span >Fin de Pauta</span>    
                                <span>
                                    <input type="text" name="txtFechaFin"  placeholder="dd-mm-aaaa" class="form-control input-sm medios datepicker ffin" required>
                                </span>
                            </article>    
                    	</article>
                    </article>
                </article>
				';
			}
			return $res;
		}

		public function getServiciosCot(){
			$this->load->model('catalogosm/catalogosm');
			$catalogosm = new Catalogosm();
			$query=$catalogosm->GetServicio();
			$res="";
			foreach ($query as $valor) {
				$res.="<tr>
						<td><input type='hidden' value='".$valor->serv_id."' name='txtIdServ' />".$valor->serv_nombre."</td>
                                <td>".$this->getPrecios()."</td>
                                <td><input type='text' name='txtCantidad' value='&nbsp;'  class='blur form-control input-sm inAddCot SoloNumero txtCantidad'></td>
                                <td><input type='text' name='txtDuracion' value='&nbsp;'  placeholder='Segundos' class='blur form-control input-sm inAddCot SoloNumero txtDuracion'></td>
                                <td><input type='text' name='txtSubTotal' value='&nbsp;' placeholder='$'  class='txtSubTotal form-control input-sm inAddCot subTotal' readonly='true'></td>
					</tr>";
			}	
			return $res;	
		}


		// <td><input type='text' name='txtDiaria'   value='&nbsp;'  class='form-control input-sm inAddCot SoloNumero txtDiaria blur'></td>

		public function getRadios($idSec){
			$this->load->model('catalogosm/catalogosm');
			$catalogosm = new Catalogosm();
			$query=$catalogosm->GetRadio();
			$res="";
			foreach ($query as $valor) {
				$res.="<tr>
						<td><input type='hidden' name='txtIdRadio' value='".$valor->rad_id."' />".$valor->rad_nombre."</td>
                                <td>".$this->getPrecios()."</td>
                                <td><input type='text' name='txtCantidad' value='&nbsp;'  class='form-control input-sm inAddCot SoloNumero txtCantidad blur'></td>";
                                if($idSec==1){
                                	$res.="<td><input type='text' name='txtDiaria'   value='&nbsp;'  class='form-control input-sm inAddCot SoloNumero txtDiaria blur'></td>";
                                }
                                $res.="<td><input type='text' name='txtDuracion' value='&nbsp;'  placeholder='Segundos' class='form-control input-sm inAddCot SoloNumero txtDuracion blur' ></td>
                                <td><input type='text' name='txtSubTotal' value='&nbsp;'  class='form-control input-sm inAddCot subTotal' placeholder='$' readonly='true'></td>
					</tr>";
			}	
			return $res;	
		}
		
		//Funcion para insertar datos en la cotizacion
		public function insertCotizacion($frm){
			$header 		= 	$frm->headerCot;
			$seccion 		= 	$frm->secCot;
			$retorno 		= new stdClass();
			$this->db->trans_start();
			$flag 	= $this->insertHeaderCot($header);
			$retorno->header = $flag;
			if($flag){
				$idEncCot = $this->db->insert_id();
				foreach ($seccion as $i  => $valor) {
					$replace = str_replace("$","",$valor->total);
					$total = str_replace(" ", "", $replace);
					$reemplazo = str_replace("$", "", $valor->descuento);
					$descuento = str_replace(" ", "", $reemplazo);
					if($total > 0){
						$calculo = $descuento/$total;
						if($calculo  < 0.30 && $header->estado_cot==5){
							$this->load->model("cotizacionesm/cotizacionesm");
							$cotizacionesm = new Cotizacionesm();
							$cotizacionesm->updateEstadoCot($idEncCot);
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
						$flag 		=	 $this->insertEncBloq($valor,$idEncCot);
						$retorno->encBloq = $flag;
						$idEncBloq	=	 $this->db->insert_id();
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
								@$obj = $this->getObjDetalle($idEncBloq,$valor->txtIdServ[$i],$valor->txtIdRadio[$i],$valor->precio[$i],$valor->txtCantidad[$i],$valor->txtDiaria[$i],$valor->txtDuracion[$i],$valor->txtSubTotal[$i],$valor->txtIdSec[$i]);
							$retorno->detBloq = $this->insertDetBloque($obj);
							//}
					 //	}
					}
					//}
				}

				$cli = $this->getDatosCliente($header->txtidCliente);
				if(!$cli->cli_usu_id){
					$this->asignarCliUsu($header->txtidCliente,$header->idUsuario);	
				}
			}

			$this->db->trans_complete();

			return $retorno;
		}

		public function getObjDetalle($idEncBloq,$idServ,$idRadio,$precio,$cantidad,$diaria,$duracion,$subTotal,$secId){
			$obj = new stdClass();
			$obj->det_enc_id 		= $idEncBloq;
			$obj->det_serv_id 		= $idServ;
			$obj->det_rad_id 		= $idRadio;
			$obj->det_pre_id 		= $precio;
			$obj->det_cantidad 		= $cantidad;
			$obj->det_cuna_diaria 	= $diaria;
			$obj->det_duracion 		= $duracion;
			$obj->det_subtotal 		= $subTotal;
			$obj->det_sec_id 		= $secId;

			return $obj;
		}

		public function asignarCliUsu($idCli,$idUsu){
			$tabla 			= array(
				'cli_usu_id'	=> $idUsu
				);
			$this->db->where('cli_id',$idCli);
			$res=$this->db->update('cli_cliente',$tabla);
			return $res;
		}

		public function updateFechaAcceso($id){
			$tabla = array(
				'cli_fecha_acceso'  => date("Y-m-d") 
				);
			$this->db->trans_start();
			$this->db->where('cli_id',$id);
			$res  = $this->db->update('cli_cliente',$tabla);
			return $res;

		}

		public function insertHeaderCot($obj){

				$tabla 			= array(
				'cot_fecha_elaboracion'	=> $obj->txtFechaCreacionCot,
				'cot_valor_agregado'	=> $obj->txtValorAgregado,
				'cot_cli_id'			=> $obj->txtidCliente,
				'cot_tip_id'			=> $obj->tipo_cot,
				'cot_est_id'			=> $obj->estado_cot,
				'cot_usu_id'			=> $obj->idUsuario,
				'cot_pro_id'			=> $obj->prod
				);	

				$this->updateFechaAcceso($obj->txtidCliente);

				$res = $this->db->insert('cot_encabezado_cotizacion',$tabla);
				
				return $res;
		}

		public function insertEncBloq($obj,$idEnCot){
				$tabla		= array(
					'enc_cot_id' 		=> $idEnCot,
					'enc_prog_id'		=> $obj->programa,
					'enc_precio_venta' 	=> $obj->pventa,
					'enc_fecha_inicio' 	=> $obj->txtFechaInicio,
					'enc_fecha_fin' 	=> $obj->txtFechaFin,
					'enc_sec_id' 		=> $obj->txtIdSec
				);

				$res = $this->db->insert('enc_encabezado_bloque',$tabla);
				
				return $res;
		}

		public function insertDetBloque($obj){
			$tabla = array(
				'det_enc_id' 		=> $obj->det_enc_id,
				'det_serv_id' 		=> $obj->det_serv_id,
				'det_rad_id' 		=> $obj->det_rad_id,
				'det_pre_id'		=> $obj->det_pre_id,
				'det_cantidad' 		=> $obj->det_cantidad,
				'det_cuna_diaria' 	=> $obj->det_cuna_diaria,
				'det_duracion' 		=> $obj->det_duracion,
				'det_subtotal' 		=> str_replace("$", "", $obj->det_subtotal),
				'det_sec_id'		=> $obj->det_sec_id
				);
			$res = $this->db->insert('det_detalle_bloque',$tabla);
			
			return $res;
		}
	}
?>