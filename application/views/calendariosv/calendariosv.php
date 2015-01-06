<!DOCTYPE HTML>
<html lang="Es">
<head>
	<?php 
		$this->load->view("estructura/head.php");
	?>
    <link rel="stylesheet" href="<?php echo base_url('resources/plugincalendar/lib/cupertino/jquery-ui.min.css')?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url('resources/plugincalendar/fullcalendar.css')?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url('resources/plugincalendar/fullcalendar.print.css')?>" type="text/css" />
    <script src="<?php echo base_url('resources/plugincalendar/lib/moment.min.js')?>" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo base_url('resources/plugincalendar/fullcalendar.min.js')?>" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo base_url('resources/plugincalendar/lang-all.js')?>" type="text/javascript" charset="utf-8"></script>
</head>
<body>
	<?php 
        $this->load->view("estructura/menu.php");
    ?><br>
       	<div id="calendar"></div>
    <img src="<?php echo base_url('resources/imagenes/calendario.png')?>" class="calendar" />
</body>
</html>