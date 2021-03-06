<?php $rol=$_SESSION['rol']; ?>
<nav class="navbar navbar-inverse" role="navigation">
  <div class="container-fluid" id="menuc">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo site_url('main'); ?>"></a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
        <ul class="nav navbar-nav">
            <li><a href="<?php echo site_url('main/main'); ?>">Inicio</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Catálogos<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <?php if($rol==3 || $rol==1){ ?>
                <li><a href="<?php echo site_url('catalogosc/catalogosc'); ?>">Programas</a></li>
                <li><a href="<?php echo site_url('radiosc/radiosc'); ?>">Radios</a></li>
                <li><a href="<?php echo site_url('preciosc/preciosc'); ?>">Precios</a></li>
                <li><a href="<?php echo site_url('servicioc/servicioc'); ?>">Servicios</a></li>
                <?php } ?>
                <li><a href="<?php echo site_url('clientesc/clientesc'); ?>">Clientes</a></li>
                <?php if($rol==3 || $rol==1){ ?>
                <li><a href="<?php echo site_url('usuario/roluserc'); ?>">Roles</a></li>
                <?php } ?>
              </ul>
            </li>
            <li><a href="<?php echo site_url('cotizacionesc/cotizacionesc'); ?>">Cotizaciones</a></li>
            <li><a href="<?php echo site_url('usuario/perfilc'); ?>">Firma Usuario</a></li>
            <?php if($rol==3 || $rol==1){ ?>
            <li><a href="<?php echo site_url('usuario/usuarioc'); ?>">Administrar usuarios</a></li>
            <li><a href="<?php echo site_url('cotizacionesc/cotizacionesc/aprobarCot'); ?>">Aprobar Cotizaciones</a></li>
            <?php } ?>
        </ul>
        
        <ul class="nav navbar-nav navbar-right">
            <li>
              <form id="frmLogout">
                <input type="submit" class="btn-link" value="Cerrar Sesión" id="btnlout">
              </form>
            </li>
        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<article class="cont-loading">
      <span class="glyphicon glyphicon-refresh glyphicon-refresh-animate loading"></span>
</article>