<?php

include("../_mysql.php");

$type = null;
if(isset($_GET["type"])) {
  $type = $_GET["type"];
}

switch($type) {
  case 'nuevo_manual':
    // Verificar si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $carga_archivos_ok = true;
      // Obtener los valores de los campos del formulario
      $titulo = $_POST["inputTitle3"];
      $descripcion = $_POST["inputDesc3"];
      $marca = $_POST["inputMarca3"];
      $modelo = $_POST["inputModel3"];
      $year = $_POST["inputYear3"];
      $cilindrada = $_POST["inputCC3"];
      $tipo_manual = $_POST["inputManualType3"];
      $idioma = $_POST["inputIdioma3"];
      $visible = isset($_POST["checkboxVisible1"]) ? 1 : 0;

      // Validar y procesar los archivos subidos
      $archivos = $_FILES["input-id"];
      $numArchivos = count($archivos["name"]);
      // Definir la carpeta de destino para guardar los archivos
      $carpetaDestino = "uploads/";
      // Crear un array para almacenar los nombres de los archivos subidos exitosamente
      $archivosSubidos = array();
      // Recorrer cada archivo subido
      for ($i = 0; $i < $numArchivos; $i++) {
        $nombreArchivo = $archivos["name"][$i];
        $archivoTemporal = $archivos["tmp_name"][$i];
        // Obtener la extensión del archivo original
        $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);

        if($i == 0) {
          $numero_archivo = null;
        } else {
          $numero_archivo = "_" . $i;
        }

        if($idioma != null) {
          $filtered_idioma = "_" . $idioma;
        }

        // Generar un nombre específico
        $nombreEspecifico = $marca . "_" . $modelo . "_" . $year . "_" . $cilindrada . "_" . $tipo_manual . $filtered_idioma . $numero_archivo . "." . $extension;
        
        $rutaArchivo = $carpetaDestino . $nombreEspecifico;
        // Mover el archivo temporal a la carpeta de destino
        if (move_uploaded_file($archivoTemporal, $rutaArchivo)) {
          // Archivo subido exitosamente
          $archivosSubidos[] = $rutaArchivo;
        } else {
          // Error al subir el archivo
          $carga_archivos_ok = false;
        }
      }
      if($carga_archivos_ok) {
        // Convertir el array $archivosSubidos en un solo string
        $archivosString = implode(" | ", $archivosSubidos);
        // Realizar la inserción en la base de datos
        $sql = mysqli_query($arts, "INSERT INTO manuales (titulo, descripcion, marca, modelo, year, cilindrada, tipo, idioma, link, habilitado)
			  VALUES ('$titulo', '$descripcion', '$marca', '$modelo', '$year', '$cilindrada', '$tipo_manual', '$idioma', '$archivosString', '$visible')") or die(mysqli_error($arts));

        $response = 1;
      } else {
        // Eliminar los archivos que se pudieron subir
        foreach ($archivosSubidos as $archivo) {
          if (file_exists($archivo)) {
            unlink($archivo);
          }
        }
        $response = 2;
      }
      header("Location: carga.php?response=".$response);
    } else {
      $response = 0;
      header("Location: carga.php?response=".$response);
    }
    break;
  case 'nueva_marca':
    // Verificar si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Obtener los valores de los campos del formulario
      $name = $_POST["inputName7"];
      
      if(mysqli_query($arts, "INSERT INTO manuales_marcas (nombre) VALUES ('$name')")) {
        $response = 1;
      } else {
        $response = 2;
      }

      header("Location: marcas.php?func=response&r=".$response);
    } else {
      $response = 0;
      header("Location: marcas.php?func=response&r=".$response);
    }
    break;
  default:
    echo "<small>error al acceder al sitio.</small>";
    break;
}



?>