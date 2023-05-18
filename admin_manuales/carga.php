<?php
include("layout/header.php");

$response = null;
if(isset($_GET["response"])) {
  $response = $_GET["response"];
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Cargar Nuevo</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Administrar</a></li>
            <li class="breadcrumb-item active">Nuevo Manual</li>
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
          switch($response) {
            case 0:
            default:
              ?>
              <div class="col-md-12">
                <!-- Form Title -->
                <div class="card card-success">
                  <div class="card-header">
                    <h3 class="card-title">Información del Manual</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form class="form-horizontal" method="post" action="_resolver.php?type=nuevo_manual" enctype="multipart/form-data">
                    <div class="card-body">
                      <div class="form-group row">
                        <label for="inputTitle3" class="col-sm-2 col-form-label">Título <small>(opcional)</small></label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputTitle3" name="inputTitle3" placeholder="Título">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputDesc3" class="col-sm-2 col-form-label">Descripción <small>(opcional)</small></label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputDesc3" name="inputDesc3" placeholder="Descripción">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputType3" class="col-sm-2 col-form-label">Marca</label>
                        <div class="col-sm-10">
                          <?php
                            $request = mysqli_query($arts, "SELECT * FROM manuales_marcas ORDER BY nombre");
                            $cantidad = mysqli_num_rows($request);
                            if ($cantidad > 0) {
                              echo '<select class="form-select" id="inputMarca3" name="inputMarca3" required>';
                              echo '<option value disabled selected>Seleccionar...</option>';
                              while ($row = mysqli_fetch_assoc($request)) {
                                $id = $row["id"];
                                $nombre = $row["nombre"];
                                echo '<option value="'. $id .'">'. $nombre .'</option>';
                              }
                              echo '</select>';
                            } else {
                              echo "<h4>No se encontraron marcas en la base de datos.</h4>";
                            }
                          ?>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputModel3" class="col-sm-2 col-form-label">Modelo</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputModel3" name="inputModel3" placeholder="Modelo" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputYear3" class="col-sm-2 col-form-label">Año</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" id="inputYear3" name="inputYear3" placeholder="Año" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputCC3" class="col-sm-2 col-form-label">Cilindrada (CC)</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" id="inputCC3" name="inputCC3" placeholder="Cilindrada / C.C." required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputManualType3" class="col-sm-2 col-form-label">Tipo de manual</label>
                        <div class="col-sm-10">
                          <select class="form-select" id="inputManualType3" name="inputManualType3" required>
                            <option value disabled selected>Seleccionar...</option>
                            <option value="despiece">Despiece / Partes</option>
                            <option value="servicio">Servicio / Taller</option>
                            <option value="usuario">Usuario</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputIdioma3" class="col-sm-2 col-form-label">Idioma <small>(opcional)</small></label>
                        <div class="col-sm-10">
                          <select class="form-select" id="inputIdioma3" name="inputIdioma3">
                            <option value="">Sin especificar</option>
                            <option value="es">Español</option>
                            <option value="en">Inglés</option>
                            <option value="zh">Chino</option>
                            <option value="ar">Árabe</option>
                            <option value="pt">Portugués</option>
                            <option value="ru">Ruso</option>
                            <option value="fr">Francés</option>
                            <option value="de">Alemán</option>
                            <option value="ja">Japonés</option>
                            <option value="it">Italiano</option>
                            <option value="ko">Coreano</option>
                            <option value="nl">Neerlandés</option>
                            <option value="pl">Polaco</option>
                            <option value="sv">Sueco</option>
                            <option value="he">Hebreo</option>
                            <option value="el">Griego</option>
                            <option value="hi">Hindi</option>
                            <option value="fi">Finlandés</option>
                            <option value="tr">Turco</option>
                            <option value="da">Danés</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Visible?</label>
                        <div class="col-sm-10 col-form-label">
                          <div class="icheck-success d-inline">
                            <input type="checkbox" checked id="checkboxVisible1" name="checkboxVisible1">
                            <label for="checkboxVisible1"></label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Archivo/s</label>
                        <div class="col-sm-10">
                          <input id="input-id" name="input-id[]" type="file" class="file" data-preview-file-type="text" multiple required>
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
            case 1:
              ?>
              <div class="col-md-12">
                <!-- Title -->
                <div class="card card-default">
                  <div class="card-header">
                    <h3 class="card-title">Cargar Nuevo</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5><i class="icon fas fa-check"></i> Carga Correcta!</h5>
                      La información y archivos se guardaron correctamente.
                    </div>
                    <div class="row">
                      <a href="carga.php" class="col-md-6 mb-2">
                        <button type="button" class="btn btn-block btn-info">Cargar Nuevo Manual</button>
                      </a>
                      <a href="lista_manuales.php" class="col-md-6 mb-2">
                        <button type="button" class="btn btn-block btn-primary">Ver Lista de Manuales</button>
                      </a>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <?php
              break;
            case 2:
              ?>
              <div class="col-md-12">   
                <!-- Title -->
                <div class="card card-default">
                  <div class="card-header">
                    <h3 class="card-title">Cargar Nuevo</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5><i class="icon fas fa-ban"></i> Error en la carga!</h5>
                      Alerta, error en la carga de archivos o inserción de datos en la tabla.
                      Intente nuevamente.
                    </div>
                    <div class="row">
                      <a href="carga.php" class="col-md-6 mb-2">
                        <button type="button" class="btn btn-block btn-warning">Volver / Reintentar</button>
                      </a>
                      <a href="lista_manuales.php" class="col-md-6 mb-2">
                        <button type="button" class="btn btn-block btn-primary">Ver Lista de Manuales</button>
                      </a>
                    </div>
                    
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>  
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

<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="resources/icheck-bootstrap/icheck-bootstrap.min.css">

<!-- bs-custom-file input plugins (estos recomiendan ponerlo en el header, lo puse aca para que lo cargue solo la pagina que lo necesite) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
<link href="resources/kartik-fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
<!-- bs-custom-file USA BOOTSTRAP 5 PARA EL CORRECTO FUNCIONAMIENTO DEL POPUP PREVISUALIZADOR -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="resources/kartik-fileinput/js/plugins/buffer.js" type="text/javascript"></script>
<script src="resources/kartik-fileinput/js/plugins/filetype.js" type="text/javascript"></script>
<script src="resources/kartik-fileinput/js/plugins/piexif.js" type="text/javascript"></script>
<script src="resources/kartik-fileinput/js/plugins/sortable.js" type="text/javascript"></script>
<!-- the main fileinput plugin script JS file -->
<script src="resources/kartik-fileinput/js/fileinput.js" type="text/javascript"></script>
<script src="resources/kartik-fileinput/js/locales/es.js" type="text/javascript"></script>
<!-- bs-custom-file-input (estos si ya van en el footer correctamente) -->
<script src="resources/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
<script>
  $("#input-id").fileinput({
      uploadAsync: false,
      language: 'es',
      theme: "fas",
      allowedFileExtensions: ["pdf"],
      overwriteInitial: false,
      maxFileSize: 100000,
      maxFilesNum: 10,
      showUpload: false, // ocultar botón "Upload" cuando se selecciona un archivo
      slugCallback: function (filename) {
          return filename.replace('(', '_').replace(']', '_');
      }
  });
</script>

</body>
</html>