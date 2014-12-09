<div class="container" id="contenedorClientes">
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
                    <!--<button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filtro</button>!-->
                </div>
            </div>
            <table class="table" >
                <thead>
                    <tr class="filters">
                        <th><input type="text" class="form-control" placeholder="#"></th>
                        <th><input type="text" class="form-control" placeholder="First Name" ></th>
                        <th><input type="text" class="form-control" placeholder="Last Name" ></th>
                        <th><input type="text" class="form-control" placeholder="Username" ></th>
                        <th><input type="hidden" class="form-control" placeholder="Username"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="background:rgba(144, 240, 139, 0.8);">
                        <td>1</td>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td><button class="btn btn-sm btn-primary" href="#myModal" data-toggle="modal">Generar Cotizacion</button></td>
                    </tr>
                    <tr style="background:rgba(144, 240, 139, 0.8);">
                        <td>2</td>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td><button class="btn btn-sm btn-primary" href="#myModal" data-toggle="modal">Generar Cotizacion</button></td>
                    </tr>
                    <tr style="background:rgba(144, 240, 139, 0.8);">
                        <td>3</td>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                        <td><button class="btn btn-sm btn-primary" href="#myModal" data-toggle="modal">Generar Cotizacion</button></td>
                    </tr>
                    <tr style="background:rgba(144, 240, 139, 0.8);">
                        <td>4</td>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td><button class="btn btn-sm btn-primary" href="#myModal" data-toggle="modal">Generar Cotizacion</button></td>
                    </tr>
                    <tr style="background:rgba(144, 240, 139, 0.8);">
                        <td>5</td>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td><button class="btn btn-sm btn-primary" href="#myModal" data-toggle="modal">Generar Cotizacion</button></td>
                    </tr>
                    <tr style="background:rgba(235,123,89,0.7);">
                        <td>6</td>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                        <td><button class="btn btn-sm btn-primary" href="#myModal" data-toggle="modal">Generar Cotizacion</button></td>
                    </tr>
                    <tr style="background:rgba(235,123,89,0.7);">
                        <td>7</td>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                        <td><button class="btn btn-sm btn-primary" href="#myModal" data-toggle="modal">Generar Cotizacion</button></td>
                    </tr>
                    <tr style="background:rgba(235,123,89,0.7);">
                        <td>8</td>
                        <td>Jose</td>
                        <td>Nuevo</td>
                        <td>@new</td>
                        <td><button class="btn btn-sm btn-primary" href="#myModal" data-toggle="modal">Generar Cotizacion</button></td>
                    </tr>
                    <tr style="background:rgba(235,123,89,0.7);">
                        <td>9</td>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                        <td><button class="btn btn-sm btn-primary" href="#myModal" data-toggle="modal">Generar Cotizacion</button></td>
                    </tr>
                    <tr style="background:rgba(235,123,89,0.7);">
                        <td>10</td>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                        <td><button class="btn btn-sm btn-primary" href="#myModal" data-toggle="modal">Generar Cotizacion</button></td>
                    </tr>
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


    <div class="row">
        <div id="myModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></a>
                    <h4 class="modal-title" id="myModalLabel">Creando Solicitud</h4><hr>
                </div>
                <div class="modal-body">
                    <h4>Solicitud</h4>
                    <p>Solicitudes</p>
                </div>
                <div class="modal-footer">
                    <div class="btn-group">
                    <button class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary">Guardar</button>
                </div>
                </div>
 
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dalog -->
</div><!-- /.modal -->


    </div>