<!DOCTYPE html>
<html>
<head>
	<?php
		$this->load->view("estructura/head.php");
        
	?>
<script src="<?php echo base_url('resources/js/login/script.js')?>" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url('resources/js/login/function.js')?>" type="text/javascript" charset="utf-8"></script>
</head>
<body>
            <div class="container" id="hide" style="display:none;">
                <div class="row vertical-offset-100">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">                                
                                <div class="row-fluid user-row">
                                    <img src="<?php echo base_url('resources/imagenes/logo.png')?> " class="img-responsive" alt="BISA"/>
                                </div>
                            </div>
                            <div class="panel-body">
                                <form accept-charset="UTF-8" role="form" class="form-signin" id="frmLogin">
                                    <fieldset>
                                        <label class="panel-login">
                                            <div class="login_result"></div>
                                        </label>
                                        <input class="form-control" placeholder="Usuario" id="username" name="txtUsuario" type="text">
                                        <input class="form-control" placeholder="Contraseña" id="password" name="txtContra" type="password">
                                        <p id="msj" style="display:none;"></p>
                                        <br>
                                        <input class="btn btn-lg btn-success btn-block" type="submit" id="login" value="Iniciar Sesion">
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</body>
</html>