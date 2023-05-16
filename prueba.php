<?php
// Config - CHARSET
header('Content-Type: text/html; charset=UTF-8'); 
// Conexion base de datos
include("cnx.php");
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <!-- Google Tag Manager -->
  <script>
    (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-W7JR4WZ');
  </script>
  <title>Quilmes Municipio - Agenda Deportes</title>
  <meta name="description" content="">
  <meta property="og:type"    content="Agenda Deportes" />
  <meta property="og:title"   content="Quilmes Municipio - Agenda Deportes" />
  <meta property="og:description" content="Mirá las actividades que podes realizar en Quilmes" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400|Open+Sans:300,400,500,600,700' rel='stylesheet' type='text/css'>
  <script src="../js/vendor/modernizr-2.8.3.min.js"></script>
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="../css/main.css">
  <link rel="stylesheet" href="css/styles5.css">
   
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css" />
  <style>
    #map
    {
      width: auto;
      height: 400px;
      padding: 0px;
    }
  </style>

  <!-- SSS Slider -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
  <link rel="stylesheet" href="sss/sss.css" type="text/css" media="all">
  <script src="sss/sss.min.js"></script>
  <script>jQuery(function($) {$('.slider').sss();});</script>

</head>
<body class="ciudad">
  <!--[if lt IE 8]>
    <p class="browserupgrade">Estas usando un navegador <strong>desactualizado</strong>. Por favor actualice su navegador para mejorar su experiencia.</p>
  <![endif]-->
  <?php include_once '../layout/nav-principal.php'; ?>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W7JR4WZ"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <nav id="breadcrumb">
    <div class="contenedor-sitio">
      <a class="seccion" href="../gestion/">Gestión</a><span> / </span>
      <a class="sub-seccion" href="index.php">Agenda Deportiva</a>
    </div>
  </nav>

  <section id="contenido-seccion" class="plantilla-texto" style="position: relative;">
    <div class="contenedor-sitio">
      <p class="titulo-agenda">Agenda Deportiva</p>
      <div class="contenedor">

        <!-- Slider #1 -->
        <div class="slider">
          <img src="../agenda/admin/agendadeportes/uploads/slider_1.jpg" />
          <img src="../agenda/admin/agendadeportes/uploads/slider_2.jpg" />
          <img src="../agenda/admin/agendadeportes/uploads/slider_3.jpg" />
          <img src="../agenda/admin/agendadeportes/uploads/slider_4.jpg" />
          <img src="../agenda/admin/agendadeportes/uploads/slider_5.jpg" />
        </div>
        <br>
        <br>
        <!-- Menu -->
        <div class="gallery-wrap" style="margin-bottom: 50px;">
            <a href="escuelas_deportivas.php" class="item item-1">
              <img src="iconos/tit-1.svg" alt="">
              <p>Escuelas deportivas</p>
            </a>
            <a href="recreacion_municipal.php" class="item item-5">
              <img src="iconos/tit-9.svg" alt="">
              <p>Programa de Recreación</p>
            </a>
            <a href="quilmes_movimiento.php" class="item item-2">
              <img src="iconos/tit-2.svg" alt="">
              <p>Programa Quilmes en Movimiento</p>
            </a>
            <a href="personas_mayores.php" class="item item-3">
              <img src="iconos/tit-3.svg" alt="">
              <p>Personas Mayores</p>
            </a>
            <a href="personas_discapacidad.php" class="item item-4">
              <img src="iconos/tit-8.svg" alt="">
              <p>Deporte, Salud y Discapacidad</p>
            </a>
            <!--
            <a href="natacion.php" class="item item-5">
              <img src="iconos/tit-5.svg" alt="">
              <p>Programa de Natación</p>
            </a>
            -->
            <a href="actividades_cic.php" class="item item-6">
              <img src="iconos/tit-6.svg" alt="">
              <p>Actividades deportivas y recreativas en CIC's y Áreas Q</p>
            </a>
            <a href="juegos_bonaerenses.php" class="item item-7">
              <img src="iconos/juegos_bonaerenses.png" alt="">
              <p>Juegos Bonaerenses</p>
            </a>
        </div>

        <!-- boton carrera #somosquilmes 1-8-2022 -->
        <!-- <div>
        <a href="https://www.eventbrite.com.ar/e/carrera-somos-quilmes-tickets-390774104867" target="_blank" class="btn btn-secondary" style="color: white; background-color: #663B8B;     display: block;
    width: 50%;
    margin: auto;
    margin-bottom: 20px;
    margin-top: -28px;">Carrera #SomosQuilmes</a>
        </div> -->

        <!-- Slider #2 -->
        <div class="slider">
          <img src="../agenda/admin/agendadeportes/uploads/slider_6.jpg" />
          <img src="../agenda/admin/agendadeportes/uploads/slider_7.jpg" />
          <img src="../agenda/admin/agendadeportes/uploads/slider_8.jpg" />
          <img src="../agenda/admin/agendadeportes/uploads/slider_9.jpg" />
          <img src="../agenda/admin/agendadeportes/uploads/slider_10.jpg" />
        </div>
        <br>
        
        <?php 
        $result = mysqli_query($arts, "SELECT * FROM agenda_deportes_extra");

        while($row = mysqli_fetch_row($result)) {
          echo $row[1];
        }
        ?>

        <!-- ####### ULTIMO CARGADO EN CADA CATEGORÍA ####### -->
        
        <?php
        /*
        $result = mysqli_query($arts, "SELECT * FROM agenda_deportes GROUP BY zona ORDER BY zona LIMIT 7"); // el GROUP BY lo que hace es agrupar y sacar 1 de cada categoria para que exista mas variedad
        $contador = 1;
        while($row = mysqli_fetch_row($result)) {   
          // cargar horarios
          $event_id = $row[0];
          $result2 = mysqli_query($arts, "SELECT * FROM agenda_deportes_horarios WHERE event_id = '$event_id'");

          $lunes = null;
          $martes = null;
          $miercoles = null;
          $jueves = null;
          $viernes = null;
          $sabado = null;
          $domingo = null;

          while($row2 = mysqli_fetch_row($result2)) {

            $time1 = date("G:i", strtotime($row2[3]));
            $time2 = date("G:i", strtotime($row2[4]));

            switch($row2[2]) {
              case 0; //lunes
                if($lunes != null) {
                  $lunes .= " | " . $time1 . " a " . $time2;
                } else {
                  $lunes .= "<br><act-horarios-strong>Lunes:</act-horarios-strong> " . $time1 . " a " . $time2;
                }
                break;
              case 1: // martes
                if($martes != null) {
                  $martes .= " | " . $time1 . " a " . $time2;
                } else {
                  $martes .= "<br><act-horarios-strong>Martes:</act-horarios-strong> " . $time1 . " a " . $time2;
                }
                break;
              case 2: // miercoles
                if($miercoles != null) {
                  $miercoles .= " | " . $time1 . " a " . $time2;
                } else {
                  $miercoles .= "<br><act-horarios-strong>Miércoles:</act-horarios-strong> " . $time1 . " a " . $time2;
                }
                break;
              case 3: // jueves
                if($jueves != null) {
                  $jueves .= " | " . $time1 . " a " . $time2;
                } else {
                  $jueves .= "<br><act-horarios-strong>Jueves:</act-horarios-strong> " . $time1 . " a " . $time2;
                }
                break;
              case 4: // viernes
                if($viernes != null) {
                  $viernes .= " | " . $time1 . " a " . $time2;
                } else {
                  $viernes .= "<br><act-horarios-strong>Viernes:</act-horarios-strong> " . $time1 . " a " . $time2;
                }
                break;
              case 5: // sabado
                if($sabado != null) {
                  $sabado .= " | " . $time1 . " a " . $time2;
                } else {
                  $sabado .= "<br><act-horarios-strong>Sábado:</act-horarios-strong> " . $time1 . " a " . $time2;
                }
                break;
              case 6: // domingo
                if($domingo != null) {
                  $domingo .= " | " . $time1 . " a " . $time2;
                } else {
                  $domingo .= "<br><act-horarios-strong>Domingo:<act-horarios-strong> " . $time1 . " a " . $time2;
                }
                break;
            }

          }

          $horarios = $lunes . $martes . $miercoles . $jueves . $viernes . $sabado . $domingo;

          // armar tarjeta
          if($contador == 1) {
            echo '<div class="row">';
          }
          echo '
          <div class="col-sm-4">
            <clicktarjeta>
              <div class="activity '. $row[1] .'">
                <p class="act-category">'. $row[1] .'</p>
                <p class="act-title">'. $row[2] .'</p>
                <p class="act-place">'. $row[8] .'</p>
                <p class="act-subtitle">'. $row[3] .'</p>
                <p class="act-place">'. $row[4] .'</p>
                <a class="ver-mapa" data-toggle="modal" data-target="#'. $event_id .'">VER MÁS INFO</a>
              </div>
            </clicktarjeta>
          </div>
          
 


          ';

          if($contador == 3) {
            echo '</div>';
            $contador = 0;
          }
          $contador++;
        
        ?>

       

        <?php } */ ?>


        <script>
            $(document).ready(function(){
                //$("#modal3").modal('show');
            });
        </script>
         <!-- Modal -->
         <div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: none;" >
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header" style="background-color:#663B8B; align-content: center;">
                <div style="color:white; font-weight: bold">
                  Carrera #Somos Quilmes / Aniversario 356
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="float: right;">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              </div>
              <div class="modal-body" style="padding: 0; margin-top: -2px;">
                <img src="popup/carrera-quilmes.jpg" alt="carrea quilmes flyer" width="100%">
              </div>
              <div class="modal-footer">
                <a href="https://www.eventbrite.com.ar/e/carrera-somos-quilmes-tickets-390774104867" target="_blank" class="btn btn-secondary" style="color: white; background-color: #663B8B; display: block; width: 60%; margin: auto;">Inscribite acá</a>
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color:#663B8B; color: white; ">Cerrar</button> -->
              </div>
            </div>
          </div>
        </div>
        <!---- fin----->
       

      </div>
    </div>
  </section>
  <!-- Footer -->
  <?php include_once '../layout/footer.php'; ?>
  <!-- Scripts -->
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js"></script>
  <script src="../js/vendor/bootstrap.min.js"></script>
  <script src="../js/plugins.js"></script>
  <script src="../js/main.js"></script>



  <!-- Modal Box / Popup -->
  

  <!-- JS LEAFLET MAP -->
  <script data-require="leaflet@0.7.3" data-semver="0.7.3" src="../___leaflet-ejemplo/leaflet.js"></script>
  <script>
    var tileLayer = new L.TileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, &copy; <a href="http://cartodb.com/attributions">CartoDB</a>'
    });
    var map = new L.Map('map', {
        'attributionControl': false,
        'center': [-34.72013341911108,-58.254361152648926],
        'zoom': 14,
        'layers': [tileLayer]
    });
    var marker = L.marker([-34.72013341911108, -58.254361152648926],{
        draggable: false
    }).addTo(map);
    marker.on('dragend', function (e) {
        document.getElementById('latitude').value = marker.getLatLng().lat;
        document.getElementById('longitude').value = marker.getLatLng().lng;
    });
  </script>

</body>
</html>