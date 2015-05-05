<?php 
	include_once(APPPATH.'controllers/padre.php');
	class Catalogosc extends padre
	{
		
		function __construct()
		{
			parent::__construct();
		}
		//aqui comienzan las funciones que capturan los datos de los catalogos
		public function insert_programa(){//captura los datos del form y los pasa al mododelo
			// vars 
			$frm = json_decode($_POST["form"]);//decodificamos el objeto json que viene de la funcion agregarPrecio en el archivo fintion.php
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$data = array('prog_nombre' => $frm->nombpro);
			$mensaje = $Catalogosm->add_catalogos('prog_programa',$data);
			echo json_encode($mensaje);
			// print_r($frm);
		}
		public function insert_cliente()
		{
			// weeeeeeee
			//vars
			$form = json_decode($_POST["form"]);
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			// if($_SESSION['rol']==1 || $_SESSION['rol']==3){
			// 	$usuid="";
			// }else{
			// 	$usuid=$form->txtIdUser;
			// }
			$data = array(
				'cli_nombres' 		=> $form->txtnombcliente,
				'cli_razon_social' 	=> $form->txtapellido,
				'cli_nrc'			=> $form->txtNRC,
				'cli_nit'			=> $form->txtNIT,
				'cli_direccion'		=> $form->txtDireccion,
				'cli_telefono'		=> $form->txtTelefono,
				'cli_contacto'		=> $form->txtContacto,
				'cli_correo'		=> $form->txtCorreo,
				'cli_usu_id'		=> $form->txtIdUser,
				'cli_titulo'		=> $form->txtTitulo,
				'cli_giro'			=> $form->txtGiro,
				'cli_cat_id'		=> $form->cat,
				'cli_fecha_acceso'  => date("Y-m-d")
				);


			$validarCli = $Catalogosm->validarCli($form->txtNRC,$form->txtNIT);
			if(count($validarCli)==0){
				$mensaje = $Catalogosm->add_catalogos('cli_cliente',$data);
				// agregar programas
				$data = array();
				foreach ($form->programas as $key => $value) {
					$data[$key] = array(
						'pro_cli_id' 		=> $mensaje->last_id, 
						'pro_nomb_producto'	=> $value
					);
				}
				$Catalogosm->insertCliente($data);
			}else{
				$mensaje="no";
			}
			

			echo json_encode($mensaje);
		}
		public function insert_precio()
		{
			//vars
				$frm = json_decode($_POST["form"]);//decodificamos el objeto json que viene de la funcion agregarPrecio en el archivo fintion.php
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm 				= new Catalogosm();
			$data 						= array('pre_precio' 	=> $frm->precio);
			$mensaje 					= $Catalogosm->add_catalogos('pre_precio',$data);
			echo json_encode($mensaje);
		}
		public function insert_servicio()
		{
			//vars
				$form = json_decode($_POST["form"]);
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$data = array('serv_nombre' => $form->servicio);
			$mensaje = $Catalogosm->add_catalogos('serv_servicio',$data);

			echo json_encode($mensaje);
		}
		public function insert_radio()
		{
			//vars
			$form = json_decode($_POST["form"]);
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$data = array('rad_nombre' => $form->txtnombradio);
			$mensaje = $Catalogosm->add_catalogos('rad_radio',$data);
			echo json_encode($mensaje);
		}

		//aqui comienzan los metodos q me mandaran al modelo los datos a modificar
		public function update_programa()
		{
			//vars
				$updatfrm = json_decode($_POST["form"]);
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$tabla = 'prog_programa';
			$tablabd = array('prog_nombre', 'prog_id');
			$nameform = array('txtNombrePrograma', 'txtidprograma');
			$mensaje = $Catalogosm->update_programadb($updatfrm, $tablabd, $nameform, $tabla);
			echo json_encode($mensaje);
		}
		public function update_precio()
		{
			//vars
				$updatfrm = json_decode($_POST["form"]);
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$tabla = 'pre_precio';
			$tablabd = array('pre_precio', 'pre_id');
			$nameform = array('txtPrecio', 'txtidprecio');
			$mensaje = $Catalogosm->update_programadb($updatfrm, $tablabd, $nameform, $tabla);
			echo json_encode($mensaje);
		}
		public function update_servicio()
		{
			//vars
				$updatfrm = json_decode($_POST["form"]);
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$tabla = 'serv_servicio';
			$tablabd = array('serv_nombre', 'serv_id');
			$nameform = array('txtServicio', 'txtidservicio');
			$mensaje = $Catalogosm->update_programadb($updatfrm, $tablabd, $nameform, $tabla);
			echo json_encode($mensaje);
		}
		public function update_radio()
		{
			//vars
				$updatfrm = json_decode($_POST["form"]);
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$tabla = 'rad_radio';
			$tablabd = array('rad_nombre', 'rad_id');
			$nameform = array('txtRadio', 'txtidRadio');
			$mensaje = $Catalogosm->update_programadb($updatfrm, $tablabd, $nameform, $tabla);
			echo json_encode($mensaje);
		}

		public function deleteProductosForUpdate($idCliente,$productos){
			$sql = "DELETE FROM pro_producto WHERE pro_cli_id = ".$idCliente." and pro_id not in (".$productos.")  ";			
			$this->db->trans_start();
				$query = $this->db->query($sql);
			$this->db->trans_complete();
			return $query;
		}
		public function updateProductosClientes($productos,$clienteId){
			// print_r($productos);
			$txtProductos = "";
			foreach ($productos as $key => $value) {
				$valor = "'".$value."'";
				if($key == 0 || $txtProductos == ""){
					$txtProductos = $valor ;
				}else{
					$txtProductos .= ",".$valor;
				}
			}
			// echo "el txt producto es: ".$txtProductos;
			
			$this->deleteProductosForUpdate($clienteId,$txtProductos);
			$this->addProductosClientes($clienteId,$txtProductos,$productos);
			
		}
		public function addProductosClientes($clienteId,$productos,$arrProductos){
			$sql = "SELECT * FROM pro_producto WHERE pro_cli_id = ".$clienteId." and pro_id in (".$productos.")  "; // no repetir 
			$this->db->trans_start();
				$query = $this->db->query($sql);
			$this->db->trans_complete();
			$resultado = $query->result();
			$productosIngresar 	= array();
			$cn 				= 0;
			foreach ($arrProductos as $key => $value) {
				$ingresar = true;
				foreach ($resultado as $k => $val) {
					if($val->pro_id == $value){
						$ingresar = false;
					}
				}
				if($ingresar){
					$arr = array(
						'pro_cli_id' 		=> $clienteId,
						'pro_nomb_producto'	=> $value
					);
					$productosIngresar[$cn] = $arr;
					$cn++;
				}
			}
			if(count($productosIngresar) >0 ){
				$this->db->trans_start();
					$this->db->insert_batch("pro_producto",$productosIngresar);
				$this->db->trans_complete();	
			}
			
			// echo "los productos a ingresar son los siguientes";
			// print_r($productosIngresar);

		}
		public function update_cliente()
		{
			//vars
			$updatfrm = json_decode($_POST["form"]);
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$mensaje = $Catalogosm->update_clientedb($updatfrm);
			$this->updateProductosClientes($updatfrm->productos,$updatfrm->txtidcliente);

			// $Catalogosm->deleteProductosClientes($updatfrm->txtidcliente);
			// $data = array();
			// foreach ($updatfrm->productos as $key => $value) {
			// 	$data[$key] = array(
			// 		'pro_cli_id' 		=> $updatfrm->txtidcliente, 
			// 		'pro_nomb_producto'	=> $value
			// 	);
			// }

			// $Catalogosm->insertCliente($data);
			echo json_encode($mensaje);
		}
		public function get_Cliente()
		{
			$idCliente = json_decode($_POST["id"]);
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$datos 		= $Catalogosm->RetornarUpdate($idCliente);
			$productos 	= $Catalogosm->getProductosFromCliente($idCliente);
			$datos->productos = $productos;
			echo json_encode($datos);
		}
		public function index()//carga la vista
		{
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$tabla = new stdClass(); //instanciamos la clase stdClass() para crear una tabla
			$tabla->programas = $Catalogosm->datos_programa();//carga la tabla programas
			
			$datos['tabla'] = $tabla; 
			$datos['Titulo']="Catalogos | Grupo Radio Stereo";
			$this->load->view('catalogosv/catalogosv.php', $datos);

		}


		
public function delete_programa()
		{
			//vars
				$frm = json_decode($_POST["form"]);
			$this->load->model('catalogosm/catalogosm');
			$Catalogosm = new Catalogosm();
			$id_progbd = 'prog_id';
			$nameform = $frm->txtidprograma;
			$tabla='prog_programa';
			$mensaje = $Catalogosm->delete_catalogo($tabla, $id_progbd, $nameform);
			echo json_encode($mensaje);
		}
	}
 ?>