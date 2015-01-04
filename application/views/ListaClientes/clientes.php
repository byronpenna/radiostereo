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
                </div>
            </div>
            <table id="resultados" class="table" >
                <thead>
                    <tr class="filters">
                        <th><input type="text" class="form-control" placeholder="Nombre" ></th>
                        <th><input type="text" class="form-control" placeholder="Razon Social" ></th>
                        <th><input type="text" class="form-control" placeholder="NIT" ></th>
                    </tr>
                </thead>
                <tbody>
                     <?php echo $tabla->clientes; ?>
                </tbody>
            </table>
        </div>
         <div style="border: 2px;" id="NavPosicion" class="pag"></div>
          <script type="text/javascript">
                    var pager = new Pager('resultados', 10);
                    pager.init();
                    pager.showPageNav('pager', 'NavPosicion');
                    pager.showPage(1);
                                    </script>
    </div>
</div>