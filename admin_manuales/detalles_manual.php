<?php
include("layout/header.php");

$id_manual = null;
if(!isset($_GET["id"])) {
  echo "<div class='content-wrapper'><h1 style='margin-left: 1rem;'>Error al ingresar al link.</h1></div>";
  exit();
} else {
  $id_manual = $_GET["id"];
}

$request = mysqli_query($arts, "SELECT * FROM manuales WHERE id='$id_manual' LIMIT 1");
$cantidad = mysqli_num_rows($request);
if ($cantidad == 1) {
  $row = mysqli_fetch_assoc($request);
  $id = $row["id"];
  $titulo = $row["titulo"];
  $descripcion = $row["descripcion"];
  $marca = $row["marca"];
  $modelo = $row["modelo"];
  $año = $row["year"];
  $cilindrada = $row["cilindrada"];
  $tipo = $row["tipo"];
  $idioma = $row["idioma"];
  $link = $row["link"];
  $habilitado = $row["habilitado"];
  $audit = $row["audit"];
} else {
  echo "<h4>No se encontró el manual en la base de datos.</h4>";
}

?>

<!-- seleccionar 'Lista Manuales' como opción activa en el menu lateral -->
<script>
  $(document).ready(function() {
    var page = "lista_manuales.php";
    $('.nav-item > .nav-link').each(function() {
      var href = $(this).attr('href');
      if (page === href) {
        $(this).addClass('active');
        if ($(this).parent().parent().hasClass('nav-treeview')) {
          $(this).parent().parent().parent().children('a.nav-link').addClass('active');
          $(this).parent().parent().parent().addClass('menu-open');
        }
      }
    });
  });
</script>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Detalles Manual</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Ver</a></li>
            <li class="breadcrumb-item active">Detalles</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">

        <div class="col-md-6">
          <!-- Form Title -->
          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Información del Manual</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td>Título</td>
                    <td><b><?php echo $titulo; ?></b></td>
                  </tr>
                  <tr>
                    <td>Descripción</td>
                    <td><b><?php echo $descripcion; ?></b></td>
                  </tr>
                  <tr>
                    <td>Marca</td>
                    <td><b><?php echo $marca; ?></b></td>
                  </tr>
                  <tr>
                    <td>Modelo</td>
                    <td><b><?php echo $modelo; ?></b></td>
                  </tr>
                  <tr>
                    <td>Año</td>
                    <td><b><?php echo $año; ?></b></td>
                  </tr>
                  <tr>
                    <td>Cilindrada (CC)</td>
                    <td><b><?php echo $cilindrada; ?></b></td>
                  </tr>
                  <tr>
                    <td>Tipo de manual</td>
                    <td><b><?php echo $tipo; ?></b></td>
                  </tr>
                  <tr>
                    <td>Idioma</td>
                    <td><b><?php echo $idioma; ?></b></td>
                  </tr>
                  <tr>
                    <td>Visible?</td>
                    <td><b><?php echo $habilitado; ?></b></td>
                  </tr>

                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-6">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Archivos</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <table class="table">
                <thead>
                  <tr>
                    <th>Nombre archivo</th>
                    <th>Tamaño</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>

                  <?php

                  // Función para convertir el tamaño de bytes a un formato legible para humanos
                  function formatBytes($bytes, $decimals = 2) {
                    $size = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
                    $factor = floor((strlen($bytes) - 1) / 3);
                    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . ' ' . @$size[$factor];
                  }

                  // Dividir el string $link en un array basado en el delimitador " | "
                  $enlaces = explode(" | ", $link);
                  // Recorrer cada enlace y verificar si el archivo existe
                  foreach ($enlaces as $enlace) {
                    if (file_exists($enlace)) {
                      
                      $tamaño = filesize($enlace);
                      // Convertir el tamaño a un formato legible para humanos
                      $tamañoLegible = formatBytes($tamaño);

                      echo '
                        <tr>
                          <td><a href="'. $enlace .'" target="_blank">'. $enlace .'</a></td>
                          <td>'. $tamañoLegible .'</td>
                          <td class="text-right py-0 align-middle">
                            <div class="btn-group btn-group-sm">
                              <a href="#" class="btn btn-info disabled"><i class="fas fa-eye"></i></a>
                              <a href="#" class="btn btn-danger disabled"><i class="fas fa-trash"></i></a>
                            </div>
                          </td>
                        </tr>
                      ';
                    } else {
                      echo '
                        <tr>
                          <td colspan="3"><b>NO SE ENCONTRO EL ARCHIVO: '. $enlace .'</b></td>
                        </tr>
                      ';
                    }
                  }

                  ?>

                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-12 mb-2">
          <a href="lista_manuales.php" class="btn-block text-center">
            <button type="button" class="btn btn-success"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;&nbsp;Volver</button>
          </a>
        </div>
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