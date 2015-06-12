<?php 
	class Cotizacionesm extends CI_Model
	{
		
		function __construct(){
			parent::__construct();
		}

		// hacemos la consulta para traer las cotizaciones y mostrarlas al dar click en la opcion del menu cotizaciones
		public function SelectCotizacion(){
			$this->db->trans_start();
				$rolUsu = $this->db->select('rol_nombre')
	    	->from('usu_usuario')
	    	->join('rol_usuario', 'usu_rol_id = rol_id')
	    	->where( array('usu_id' => $_SESSION['iduser'] ))
	    	->get()->row()->rol_nombre;
				if($rolUsu == "SuperAdministrador" || $rolUsu == "Administrador"){
					$consulta = "SELECT * FROM cot_encabezado_cotizacion join cli_cliente ON cli_id=cot_cli_id  ORDER BY cot_est_id,cot_id DESC";					
				}else{		
					$consulta = "SELECT * FROM cot_encabezado_cotizacion join cli_cliente ON cli_id=cot_cli_id WHERE cot_usu_id = ".$_SESSION['iduser']." ORDER BY cot_est_id,cot_id DESC";
				}
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

		public function getFrecuencia($idCot){
			$sql = "SELECT COUNT(*) AS frecuencia
					FROM fec_fechas
					INNER JOIN enc_encabezado_bloque
					on enc_id = fec_enc_id
					INNER JOIN cot_encabezado_cotizacion 
					on enc_cot_id = cot_id 
					where enc_cot_id = ".$idCot.";
				";
			$this->db->trans_start();
				$query = $this->db->query($sql);
			$this->db->trans_complete();
			$retorno = $query->result();
			return $retorno[0]->frecuencia;
		}

		// generamos la tabla que muestra las cotizaciones
		public function getCotizacion()
		{
			$datos = $this->SelectCotizacion();
			if($datos!="nada"){
					$retorno = "";
				foreach ($datos as $row) {
					$sql="SELECT det.det_id  from 
							(cot_encabezado_cotizacion cot JOIN enc_encabezado_bloque enc
							ON cot.cot_id=enc.enc_cot_id) JOIN det_detalle_bloque det
							ON enc.enc_id=det.det_enc_id
							WHERE det.det_cantidad > 0 AND det.det_duracion > 0 AND det.det_subtotal > 0
							AND cot.cot_id=".$row->cot_id."";

					$sqlFrec = "SELECT COUNT(*) AS frecuencia
								FROM fec_fechas
								INNER JOIN enc_encabezado_bloque
								on enc_id = fec_enc_id
								INNER JOIN cot_encabezado_cotizacion 
								on enc_cot_id = cot_id 
								where enc_cot_id = ".$row->cot_id.";";
					$this->db->trans_start();
						$count 	= $this->db->query($sql);
					$this->db->trans_complete();
					$count 	= $count->result();
					$frec 	= $this->getFrecuencia($row->cot_id);
					$estado=$this->queryEstado($row->cot_est_id);
					$retorno .= "<tr class='styleTR'>
									<td style='display:none'><input type='hidden' name='idCot' class='idCot' value='".$row->cot_id."' />" .$row->cot_id. "</td>
									<td style='display:none'>" .$row->cli_id. "</td>
									<td>" .$row->cli_nombres. "</td>
									<td>" .$row->cli_razon_social. "</td>
									<td class='text-center'>" .$row->cli_nit. "</td>
									<td class='text-center'>" .$row->cot_fecha_elaboracion."</td>
									<td class='text-center'>". $estado->est_estado . "</td>
									<td class='text-center'>";
										if($estado->est_estado == "Orden de Compra"){
											$retorno .=" <a title='Imprimir Orden de Compra a Color' target='_blank' href='". site_url('ordencompra/printOrdenCompra/'.$row->cot_id.'') . "' class='btn btn-success btn-sm pOrden'><i class='glyphicon glyphicon-print'></i><section class='conte-ar'><article class='ar ar1'></article><article class='ar ar2'></article><article class='ar ar3'></article></section></a>";
											$retorno .=" <a title='Imprimir Orden de Compra en Blanco y Negro' target='_blank' href='". site_url('ordencompra/printOrdenCompraBN/'.$row->cot_id.'') . "' class='btn btn-success btn-sm pOrden'><i class='glyphicon glyphicon-print'></i><section class='conte-arbn'><article class='arbn ar1bn'></article><article class='arbn ar2bn'></article></section></a>";
										}else{
											$retorno .=" <a class='btn btn-default btn-sm' disabled><i class='glyphicon glyphicon-print'></i></a>";
											$retorno .=" <a class='btn btn-default btn-sm' disabled><i class='glyphicon glyphicon-print'></i></a>";
										}	
										if(count($count)>0){
											$retorno .= " <a title='Imprimir Cotización a Color' href='".site_url('cotizacionesc/cotizacionesc/printCotizacion/'.$row->cot_id.'') ."' style='text-decoration:none;color:#FFFFFF;' target='_blank' class='btn btn-sm btn-warning'><i class='glyphicon glyphicon-print'></i><section class='conte-ar' style='margin-left:45%;'><article class='ar ar1'></article><article class='ar ar2'></article><article class='ar ar3'></article></section></a>";
											$retorno .= " <a title='Imprimir Cotización en Blanco  y Negro' href='".site_url('cotizacionesc/cotizacionesc/printCotizacionBN/'.$row->cot_id.'') ."' style='text-decoration:none;color:#FFFFFF;' target='_blank' class='btn btn-sm btn-warning'><i class='glyphicon glyphicon-print'></i><section class='conte-arbn' style='margin-left:45%;'><article class='arbn ar1bn'></article><article class='arbn ar2bn'></article></section></a>";
										}else{
											$retorno .= " <a class='btn btn-sm btn-default' disabled><i class='glyphicon glyphicon-print'></i></a>";
											$retorno .= " <a class='btn btn-sm btn-default' disabled><i class='glyphicon glyphicon-print'></i></a>";
										}	
										if($frec > 0){
											$retorno .= " <a title='Registrar Frecuencias' href='".site_url('ordencompra/index/'.$row->cot_id.'') ."' class='btn btn-primary btn-sm'><i class='glyphicon glyphicon-log-in'></i></a>";
										}else{
											$retorno .= " <a class='btn btn-default btn-sm' disabled><i class='glyphicon glyphicon-log-in'></i></a>";
										}
										$retorno .= " <a title='Editar' href='".site_url('cotizacionesc/cotizacionesc/editarCotizacion/'.$row->cot_id.'') ."' class='btn btn-sm btn-info'><i class='glyphicon glyphicon-edit'></i></a>
																	<a title='Eliminar' href='#' class='btn btn-sm btn-danger btnDelCot'><i class='glyphicon glyphicon-remove'></i></a>
																	</td></tr>";
				}
			}else{
				$retorno="";
			}
			
			return $retorno;
		}

		// hacemos la consulta para obtener todas las cotizaciones que tienen lleno un detalle y asi mostrarlas al dar clickk 
		// sobre la opcion del menu aprobar cotizaciones
		public function getCotApro(){
			$sql="	select DISTINCT cot.cot_id,cli.cli_id,cli.cli_nombres,cli.cli_razon_social,cli.cli_nit,cot.cot_fecha_elaboracion from 
					((cot_encabezado_cotizacion cot JOIN enc_encabezado_bloque enc
					ON cot.cot_id=enc.enc_cot_id) JOIN det_detalle_bloque det
					ON enc.enc_id=det.det_enc_id) JOIN cli_cliente cli 
					ON cot.cot_cli_id=cli.cli_id
					WHERE det.det_cantidad > 0 AND det.det_duracion > 0 AND det.det_subtotal > 0 AND cot.cot_est_id = 5
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
				// estado_cot
				foreach ($query as $key => $valor) {
					if($valor->est_id==$id){
						$s="selected";
					}else{
						$s="";
					}
					if($_SESSION['rol']==2 && $valor->est_id == 3 || $_SESSION['rol']==2 && $valor->est_id == 4){
						$none = "style='display:none;'";	
					}else{
						$none ="";
					}
					$r.="<option value='".$valor->est_id."' ".$none." ".$s." >".$valor->est_estado."</option>";
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
                    <p>Estado de Cotización <span>
	                    <select name="estado_cot" class="form-control input-sm pequenios " >
	                            '.$this->estCot($row->cot_est_id).'
	                    </select>   
                    </span></p>
                </article>
                <article>
                    <p>Fecha de Creación <span> <input type="text" name="txtFechaCreacionCot" value="'.$row->cot_fecha_elaboracion.'" class="form-control input-sm medios datepicker"></span></p>
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
				ORDER BY rad_nombre
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
			$fechas = $this->getFechas($query[0]->enc_id);
				$f='[';
				foreach ($fechas as $llave => $row) {
					if($llave==0){
						$f.='"'.$row->fec_fecha.'"';
					}else{
						$f.=',"'.$row->fec_fecha.'"';		
					}
				}
				$f.=']';
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
                                <td><p>Duración</p></td>
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
                            <img src="'.base_url("resources/imagenes/calendario.png").'" class="imagen imagen1" /> ';

                            $r.="<input type='hidden' name='txtEvents' value='".$f."' class='txtEvents'>";
                            
                            $r.='<div id="contenedor1" class="conteCalendario">
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

		public function getFechas($idEnc){
			$sql="
				select * from fec_fechas
				where fec_enc_id = ".$idEnc."
				order by fec_fecha";
			$this->db->trans_start();
			$query = $this->db->query($sql);
			$query = $query->result();
			$this->db->trans_complete();
			return $query;
		}


		public function getBotones($idCot){
			$sql = " SELECT * FROM cot_encabezado_cotizacion
					WHERE cot_id=".$idCot."";
			$this->db->trans_start();
			$query = $this->db->query($sql);
			$this->db->trans_complete();
			$query = $query->result();
			if($query[0]->cot_est_id == 3 || $query[0]->cot_est_id == 4){
				$disabled="disabled";
			}else{
				$disabled='';
			}
	        $res='
	        <article id="contBtnAddCot">
				<input type="submit" name="" value="Guardar" class="btn btn-m btn-success btnAddCot" id="editCot" '.$disabled.'>
	            <input type="submit" name="" value="Limpiar" class="btn btn-m btn-warning btnAddCot" id="limpiar" '.$disabled.'> 
	        	<input type="button" name="" value="Cancelar" class="btn btn-m btn-danger btnAddCot cancel">
            </article>';

				return $res;

		}


		public function verificarEstadoCot($frm){
			$header 	=	$frm->headerCot;
			$estado = $this->queryEstado($header->estado_cot);
			return $estado;
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
				$fechas = $this->getFechas($query[$i]->enc_id);
				$f='[';
				foreach ($fechas as $llave => $row) {
					if($llave==0){
						$f.='"'.$row->fec_fecha.'"';
					}else{
						$f.=',"'.$row->fec_fecha.'"';		
					}
				}
				$f.=']';
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
                               $r .= '<td><p>Duración</p></td>
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
                            	<img src="'.base_url("resources/imagenes/calendario.png").'" modal=\'1\' class="imagen" /> ';
                            	$r.="<input type='hidden' name='txtEvents' value='".$f."' class='txtEvents'>";
                    		$r.='</article>
                    		
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
				
				foreach ($seccion as $key => $valor) {

					$events = json_decode($valor->txtEvents);
					$arreF = array();
							$arre2 = array();
								$conta2 = 0;
								$contadorF = 0; 
							if(count($events)>0){
								$queryFechas = $this->getFechas($valor->txtIdEncabezado);
								for ($i=0; $i < count($events) ; $i++) {
									$resp = false;
									foreach ($queryFechas as $conta => $row){
											if($events[$i]==$row->fec_fecha){
												$resp=true;
												$arreF[$contadorF]=$row->fec_fecha;
												$contadorF++;
											}
										}
										if($resp==false){
											$arre2[$conta2]=$events[$i];
											$conta2++;
											// $retorno->fecha = $this->agregarFechaBloq($valor->txtIdEncabezado,$events[$i]);
										}
										// echo $aborrar."[]";
										// if($aborrar!=""){
										// 	$this->delFechaBloq($valor->txtIdEncabezado,$aborrar);
										// }
								}
								
							}else{
								$retorno->fecha 	= true;
							}
							if(count($arreF)>0){
									$resF="";
									if(is_array($arreF)){
										foreach ($arreF as $key => $value) {
											if($key==0){
												$resF.="'".$value."'";
											}else{
												$resF.=",'".$value."'";
											}
										}
										$this->delFechaBloq($valor->txtIdEncabezado,$resF);
									}else{
										$resF.="'".$arreF."'";
										$this->delFechaBloq($valor->txtIdEncabezado,$resF);
									}
								}else{
									$this->delFechaBloq2($valor->txtIdEncabezado);
								}

								if($arre2){
									if(is_array($arre2)){
										foreach ($arre2 as $l => $val) {
											$retorno->fecha = $this->agregarFechaBloq($valor->txtIdEncabezado,$val);
										}
									}else{
											$retorno->fecha = $this->agregarFechaBloq($valor->txtIdEncabezado,$arre2);
									}
									
								}	

					$replace = str_replace("$","",$valor->total);
					$total = str_replace(" ", "", $replace);
					$reemplazo = str_replace("$", "", $valor->descuento);
					$descuento = str_replace(" ", "", $reemplazo);

					// Porcentaje Variable
					if($total > 0){

						// echo "Soy el total ".$total;
						$porcentaje = $this->db->query("SELECT tar_descuento FROM tar_tarifa WHERE tar_tip_id = " . $header->tipo_cot . " AND ". $total ." BETWEEN tar_rango_inicial AND tar_rango_final ");
						$porcentaje = $porcentaje->result_array();

						$calculo = $descuento/$total;

						$retorno->cliInfo= 0;

						$sql ="select * from cli_cliente where cli_id=".$header->txtidCliente."";
						$this->db->trans_start();
						$cliq = $this->db->query($sql);
						$this->db->trans_complete();
						$cliq = $cliq->result();

						if($porcentaje){
							if($calculo  <= $porcentaje[0]['tar_descuento'] && $header->estado_cot==5 && $header->tipo_cot != 3){
								//if($calculo  < 0.30 && $header->estado_cot==5){	
								$retorno->cliInfo = 1;
								$fl = $this->getFechas($valor->txtIdEncabezado);
								if($fl){
									if($cliq[0]->cli_nit != "" && $cliq[0]->cli_nrc != "" &&  $cliq[0]->cli_direccion != "" && $cliq[0]->cli_telefono != "" && $cliq[0]->cli_correo != "" && $cliq[0]->cli_giro != ""){
										$retorno->cliInfo = 2;
										$this->updateEstadoCot($header->idCot);
									}
								}
							}
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
						// if($valor->txtEvents){
							
							// $eventos = explode(",",$events);
						// }
						for ($i=0; $i < count($valor->precio); $i++) {
						//if($valor->precio!=-1){
						// if($valor->precio[$i]==-1){
						// 	$valor->precio[$i]="";
						// }
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


		public function agregarFechaBloq($idBloq,$fecha){
			$tabla		= array(
				'fec_enc_id'	=> $idBloq,
				'fec_fecha'		=> $fecha
				);

			$res = $this->db->insert('fec_fechas',$tabla);

			return $res;
		}

		public function delFechaBloq($idBloq,$fecha){
			$sql = "
			delete from fec_fechas
			where fec_enc_id = ".$idBloq." and fec_fecha not in(".$fecha.")
			";
			$this->db->trans_start();
			$query = $this->db->query($sql);
			$this->db->trans_complete();
		}

		public function delFechaBloq2($idBloq){
			$sql = "
			delete from fec_fechas
			where fec_enc_id = ".$idBloq."";
			$this->db->trans_start();
			$query = $this->db->query($sql);
			$this->db->trans_complete();
		}

		public function editarHeaderCot($obj){
			$tabla 			= array(
				'cot_valor_agregado'	=> $obj->txtValorAgregado,
				'cot_tip_id'			=> $obj->tipo_cot,
				'cot_est_id'			=> $obj->estado_cot,
				'cot_pro_id'			=> $obj->prod
				);
			$this->load->model("cotizacionm/cotizacionm");
			$cotizacionm  = new cotizacionm();
			$cotizacionm->updateFechaAcceso($obj->txtidCliente);
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
				'det_subtotal' 		=> str_replace("$", "", $obj->det_subtotal)
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
			$flag = false;
			foreach ($encId as $valor) {
				$detId=$this->getDetId($valor->enc_id);
				foreach ($detId as $row) {
					$this->db->where('det_id',$row->det_id);
					$flag  = $this->db->delete('det_detalle_bloque');
				}
				if($flag==true){
					$this->db->where('enc_id',$valor->enc_id);
					$this->db->delete('enc_encabezado_bloque');
				}
				
			}
			if($flag==true){
				$this->db->where('cot_id',$idCot);
				$this->db->delete('cot_encabezado_cotizacion');	
			}
			return $flag;
		}

		


		

//Aca se generan los reportes para los programas 
		public function getEnReporte($IdCot,$campo){
			$sql="SELECT  
				enc_id,
				enc_cot_id,
				enc_prog_id,
				enc_precio_venta,
				enc_fecha_fin,
				enc_fecha_inicio,
				enc_sec_id,
				ROUND(
					DATEDIFF(
						enc_fecha_fin,
						enc_fecha_inicio
					)
				) AS Periodo 
			FROM enc_encabezado_bloque
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


		public function getProdCli($idProd){
			$sql="SELECT * FROM pro_producto
				WHERE pro_id = ".$idProd."";
				$this->db->trans_start();
				$query = $this->db->query($sql);
				$query = $query->result();

			return $query;
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
					if($valor->det_cantidad>1){
						if($ser!="Menciones"){
							$ser = $ser."s";
						}
					}else{
						if($ser=="Menciones"){
							$ser="Mención";
						}else{
							$ser=$ser;
						}
					}
					$res->servi->ser[] = $ser;
					$res->servi->precio[] = $precio->pre_precio;
					$res->servi->cantidad[] =  $valor->det_cantidad;
					$res->servi->duracion[] = $valor->det_duracion;
					$res->servi->subtotal[] = $valor->det_subtotal;
					$res->total+=$valor->det_subtotal;
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
					$res->servi->ser[$key] = $ser;
					$res->servi->precio[$key] = $precio->pre_precio;
					$res->servi->cantidad[$key] =  $valor->det_cantidad;
					if($valor->det_cuna_diaria){
						$res->servi->cuna[$key] = $valor->det_cuna_diaria;
					}
					$res->servi->duracion[$key] = $valor->det_duracion;
					$res->servi->subtotal[$key] = $valor->det_subtotal;
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
				'cot_est_id'			=> 3
				);
			$this->db->where('cot_id',$idCot);
			$res=$this->db->update('cot_encabezado_cotizacion',$tabla);
			return $res;
		}


	function datos_reporte_cotizacion ($idCot){
		$sql="SELECT  * FROM cot_encabezado_cotizacion cot 
							INNER JOIN tip_tipo tip ON cot.cot_tip_id=tip.tip_id
							INNER JOIN enc_encabezado_bloque ON enc_cot_id = cot_id 
					 WHERE enc_precio_venta > 0 AND cot.cot_id = ".$idCot."";
		$this->db->trans_start();
		$cot=$this->db->query($sql);
		$cot=$cot->result();
		$this->db->trans_complete();
		$encCot = $this->getEncCot($idCot); //Saco en encabezado de la cotizacion
		$cli = $this->getDatosCliente($encCot[0]->cot_cli_id); //traigo los datos del encabezado
		
		//Para definir el saludo
		if(substr($cli->cli_titulo, -1)=="o" || substr($cli->cli_titulo, -2)=="or"){
			$sal="Estimado";
		}else{
			$sal="Estimada";
		}

		//Para definir el apellido del contacto
		$partido = explode(" ", $cli->cli_contacto);
		$contaPartido = count($partido);
		$contacto="";
		switch ($contaPartido) {
			case 1:
				$contacto = $partido[0];
			break;
			case 2:
				$contacto = $partido[1];
			break;
			case 3 || 4:
				$contacto = $partido[2];
			break;
			default:
				$contacto = "";
			break;
		}

		$this->db->trans_start();
			$datosUsuario=$this->db->query("SELECT * FROM usu_usuario where usu_id =".$encCot[0]->cot_usu_id." ")->result_array();
			$datoProducto=$this->db->query("SELECT * FROM pro_producto WHERE pro_id =". $encCot[0]->cot_pro_id." ")->result_array();
		$this->db->trans_complete();

		if($encCot[0]->cot_valor_agregado == "" || $encCot[0]->cot_valor_agregado == " " || $encCot[0]->cot_valor_agregado == null){
			$valorAgregado="Sin Beneficios";
		}else{
			$valorAgregado=$encCot[0]->cot_valor_agregado;
		}

		$res = new stdClass();
		$encCot = $this->getEncCot($idCot);
		$prod = $this->getProdCli($encCot[0]->cot_pro_id);

		if($cot[0]->enc_sec_id != 0 || $cot[0]->enc_sec_id) {
			$encBloq =  $this->getEnReporte($idCot,"enc_sec_id");
			$tipo = "seccionada";
			$progNomb = $this->db->query("SELECT  * FROM  (sec_seccion s JOIN enc_encabezado_bloque e ON s.sec_id=e.enc_sec_id) WHERE sec_id = ".$encBloq[0]->enc_sec_id."")->result();
			if($progNomb[0]->sec_nombre=="Cuña"){
				$progNomb = "Cuña Rotativa";
			}else{
				$progNomb = $progNomb[0]->sec_nombre;
			}
			$detalle= $this->getDetalleReporteRad($encBloq[0]->enc_id,$encBloq[0]->enc_precio_venta);
		}else{
			$encBloq =  $this->getEnReporte($idCot,"enc_prog_id");
			$tipo = "programa";
			$progNomb=$this->db->query("SELECT  * FROM prog_programa WHERE prog_id = ".$encBloq[0]->enc_prog_id."")->result();
			$progNomb = $progNomb[0]->prog_nombre;
			$detalle=$this->getDetalleReporte($encBloq[0]->enc_id,$encBloq[0]->enc_precio_venta);
		}

		//Periodo
		$periodo=$encBloq[0]->Periodo;
		// $periodo=$periodo+1;
		if($periodo==0){
			$periodo=1;
		}
		if($periodo>1){
			$periodo=$periodo." días";
		}else{
			$periodo=$periodo." día";
		}
						

		//Datos de encabezado
		$reporte['cli_titulo'] = $cli->cli_titulo;
		$reporte['cli_contacto'] = $cli->cli_contacto;
		$reporte['cli_contacto2'] = $contacto;
		$reporte['cli_razon_social'] = $cli->cli_razon_social;
		$reporte['cli_cat_id'] = $cli->cli_cat_id;
		$reporte['saludo'] = $sal;

		//Datos del detalle cotizion
		$reporte['producto'] = $datoProducto[0]['pro_nomb_producto'];
		$reporte['tipoCot'] = $tipo;
		$reporte['valorAgregado'] = $valorAgregado;
		$reporte['formaPago'] = $cot[0]->tip_tipo;
		$reporte['periodo'] = $periodo;
		$reporte['detalle'] = $detalle;

		//Programa si es de programa y  no de seccion
		$reporte['nombrePrograma'] = $progNomb;

		//Datos del usuario
		$reporte['usu_firma'] = $datosUsuario[0]['usu_firma'];


		return $reporte;
	}
}
 ?>