<html>
<head>
	<title>..::Principal::..</title>
	<?php
		$this->load->view("estructura/head.php");
	?>
	<script src="<?php echo base_url('resources/js/login/script.js')?>" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url('resources/js/login/function.js')?>" type="text/javascript" charset="utf-8"></script>
</head>
<body>
	<?php
		$this->load->view("estructura/menu.php");
		$this->load->view("ListaClientes/clientes.php");
	?>
</body>
</html>