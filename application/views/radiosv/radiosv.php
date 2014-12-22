<!DOCTYPE HTML>
<html lang="Es">
<head>
  <?php 
    $this->load->view("estructura/head.php");
  ?>
</head>
<body>
  <?php 
    $this->load->view("estructura/menu.php");
  ?>
  <fieldset class="fieldRadio well" id="fieldRadio">
    <legend>Radios</legend>
    <form id="frmRadio" method="POST" class="well"><!--Formulario para ingresar radio-->
      <table>
        <tr>
          <td><label for="nombradio">Nombre Radio:</label></td>
          <td><input type="text" name="txtnombradio" class="vaciarinput form-control" /></td>
          <td colspan="2"><input type="submit" value="Guardar" class="btn btn-m btn-success btnAddCot"></td>
        </tr>
      </table>
    </form>
    <div id="contenido">
      <div class="midBox1"> 
        <div class="midBox1Top">
          <h3></h3>            
        </div>
              <div class="datagrid">
                <form>
                    <b> BUSCAR:</b> <input id="searchTerm" type="search" onkeyup="doSearch()" class="form-control" placeholder="Radio" />
                </form>
              <br />
              <table id="resultados" class="table">
                <thead class="thead">
                  <tr>
                    <th>Nombre Radio</th>
                    <th>Acción</th>
                  </tr>
                </thead>
                <tbody class="tbradio">
                  <?php echo $tabla->radio ?>
                </tbody>
              </table>
              <div style="border: 2px;" id="NavPosicion"></div>
    </div>
    <script type="text/javascript">
          var pager = new Pager('resultados', 10);
          pager.init();
          pager.showPageNav('pager', 'NavPosicion');
          pager.showPage(1);
              </script>
  </fieldset>
      </div>
  </div>
</body>
</html>