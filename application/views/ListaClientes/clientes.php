<div class="container" id="contenedorClientes" />
    <h3>Listado de Clientes</h3>
    <hr id="hr">
    <nav class="tu">   
        <ul>
            <li><div id="coloroc"></div><p>&nbsp;&nbsp;Mis Clientes</p></li>
            <li><div id="colordis"></div><p>&nbsp;&nbsp;Disponibles</p></li>
        </ul>
    </nav>
    <div class="row">
        <div class="panel panel-primary filterable" id="tableClientes">
            <div class="panel-heading">
                <h3 class="panel-title">Clientes</h3>
                <div class="pull-right">
                </div>
            </div>
            <table class="table" >
                <thead>
                    <tr class="filters">
                        <th><input type="text" class="form-control" placeholder="ID"></th>
                        <th><input type="text" class="form-control" placeholder="Nombre" ></th>
                        <th><input type="text" class="form-control" placeholder="Apellido" ></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                     <?php echo $tabla->clientes; ?>
                </tbody>
            </table>
        </div>
       <ul id="pagination-clean" class="pag">
            <li class="previous-off">«Previous</li>
            <li class="active">1</li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">6</a></li>
            <li><a href="#">7</a></li>
            <li class="next"><a href="#">Next »</a></li>
        </ul>
    </div>