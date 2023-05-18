<?php
session_start();
// incluir la conexion con la base de datos "pagina_1" que esta definida dentro de _mysql.php
include("../_mysql.php");	
// check si ya esta logeado como admin y lo reenvia a la pagina principal de admin
if(isset($_SESSION["logeado"])) {
	if(isset($_SESSION["user"])) {
		if($_SESSION["user"] == "admin") {
			header("Location: lista_manuales.php");
		}
	}
}
// comprueba los datos si se ingresaron datos & si son correctos
$error_auth = false;
if(isset($_POST["user"]) && isset($_POST["password"])) {
	$user = $_POST["user"];
	$password = $_POST["password"];
	if($user != "admin") { // check a traves de 'user' para dar permisos de admin
		echo "Area restringida para administradores. <a href='index.php'>IR A LOGIN</a>";
		exit();
	}
	$request = mysqli_query($arts, "SELECT * FROM users WHERE user = '$user' AND password = '$password' LIMIT 1");
	if(mysqli_num_rows($request) == 1) {
		$row = mysqli_fetch_assoc($request);
		$_SESSION["user"] = $user;
		$_SESSION["password"] = $password;
		$_SESSION["logeado"] = true;
		// generate: token + last_login
		$token = openssl_random_pseudo_bytes(16); //Generate a random string.
		$token = bin2hex($token); //Convert the binary data into hexadecimal representation.
		$actual_datetime = date('Y-m-d H:i:s');
		$id = $row["id"];
		// update sql con el token y el datetime actual
		$request = mysqli_query($arts, "UPDATE users SET token='$token', last_login='$actual_datetime' WHERE id='$id'");
		if(!$request) {
			echo "error al ingresar";
			die();
		}
		$_SESSION["id"] = $id;
		$_SESSION["token"] = $token;
		if(!headers_sent()){
			header("Location: lista_manuales.php");
		} else {
			?>
				<script type="text/javascript">
				document.location.href="lista_manuales.php";
				</script>
				Redirecting to <a href="lista_manuales.php">lista_manuales.php</a>
			<?php
		}
		die();
	} else {
		$error_auth = true;
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
	<title>SEVEMAS - Admin Panel</title>
	<link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="/admin/css/styles2.css">	<!-- styles -->
</head>
<style>
* {
	font-size: 15px;
}
</style>
<body>
	<br>
	<h2 id="titulo">Panel de administracion</h2>
	<?php if($error_auth) { echo "<p style='color: red; text-align: center;'>Error en la comprobación de datos. Intente nuevamente.</p>"; } ?>
	<br>
	<form id="login-form" class="contact_form" method="post" action="index.php">
		<ul id="iniciar-sesion-adm">
		<h4 id="usuario-button">Usuario</h4>
		<li>
			<input type="text" name="user" placeholder="User" required>
		</li>
			<h4 id="contraseña-button">Contraseña</h4>
		<li>
			<input type="password" name="password" placeholder="Password" required>
		</li>
		<li>
			<input id="entrar-button" type="submit" class="submit" value=" Entrar ">
		</li>
	</ul>
	</form>
</body>
</html>
