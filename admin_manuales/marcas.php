<?php
include("layout/header.php");

$func = null;
if(isset($_GET["func"])) {
  $func = $_GET["func"];
}

?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Cargar / Modificar</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Administrar</a></li>
            <li class="breadcrumb-item active">Marcas</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <?php
        switch($func) {
          case 'response':
            if(!isset($_GET["r"])) {
              echo "<h1>ERROR: Faltan parámetros</h1>";
            } else {
              $r = $_GET["r"];
            }
            if($r == 1) {
              ?>
              <div class="col-md-12">
                <!-- Title -->
                <div class="card card-default">
                  <div class="card-header">
                    <h3 class="card-title">Cargar Nueva Marca</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5><i class="icon fas fa-check"></i> Carga Correcta!</h5>
                      La marca ha sido agregada correctamente.
                    </div>
                    <div class="row">
                      <a href="marcas.php?func=nueva" class="col-md-6 mb-2">
                        <button type="button" class="btn btn-block btn-info">Cargar Nueva Marca</button>
                      </a>
                      <a href="marcas.php" class="col-md-6 mb-2">
                        <button type="button" class="btn btn-block btn-primary">Ver Lista de Marcas</button>
                      </a>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <?php
            } else if($r == 2) {
              ?>
              <div class="col-md-12">   
                <!-- Title -->
                <div class="card card-default">
                  <div class="card-header">
                    <h3 class="card-title">Cargar Nueva Marca</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5><i class="icon fas fa-ban"></i> Error en la carga!</h5>
                      Alerta, error en la inserción de datos en la tabla 'marcas'.
                      Intente nuevamente.
                    </div>
                    <div class="row">
                      <a href="marcas.php?func=nueva" class="col-md-6 mb-2">
                        <button type="button" class="btn btn-block btn-warning">Volver / Reintentar</button>
                      </a>
                      <a href="marcas.php" class="col-md-6 mb-2">
                        <button type="button" class="btn btn-block btn-primary">Ver Lista de Marcas</button>
                      </a>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <?php
            }
            break;
          case 'nueva':
            ?>
            <div class="col-md-12">
              <!-- Form Title -->
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Información Marca</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="_resolver.php?type=nueva_marca" enctype="multipart/form-data">
                  <div class="card-body">
                    <div class="form-group row">
                      <label for="inputName7" class="col-sm-2 col-form-label">Nombre</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName7" name="inputName7" placeholder="Título" required>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-info float-right">Cargar</button>
                  </div>
                  <!-- /.card-footer -->
                </form>
              </div>
              <!-- /.card -->
            </div>
            <?php
            break;
          default:
            ?>
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Lista de Marcas</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $request = mysqli_query($arts, "SELECT * FROM manuales_marcas ORDER BY nombre");
                        $cantidad = mysqli_num_rows($request);
                        if ($cantidad > 0) {
                          while ($row = mysqli_fetch_assoc($request)) {
                            $id = $row["id"];
                            $nombre = $row["nombre"];
                            echo '<tr><td>'. $nombre .'</td>';
                            echo '
                              <td class="py-0 align-middle">
                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fas fa-edit"></i></a>
                              </td>';
                            echo '</tr>';
                          }
                        } else {
                          echo "<h4>No se encontraron marcas en la base de datos.</h4>";
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="marcas.php?func=nueva" class="btn-block text-center">
                    <button type="button" class="btn btn-success"><i class="fas fa-plus"></i> Agregar Marca</button>
                  </a>
                </div>
              </div>
              <!-- /.card -->
            </div>
            <!--/.col -->
            <?php
            break;
        }
        ?>
        
        
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>


<?php include("layout/footer.php"); ?>


<!-- ### PAGE SPECIFIC SCRIPT ### -->


</body>
</html>