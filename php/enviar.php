<?php

$nombre = stripslashes($_POST["nombre"]);
$email = stripslashes($_POST["email"]);
$texto = stripslashes($_POST["texto"]);

$recaptcha = $_POST["g-recaptcha-response"];

$url = "https://www.google.com/recaptcha/api/siteverify";
$data = array(
	"secret" => "6LcLSL0UAAAAABv-P_stDP2x4EV8FyEKPh_vIVib",
	"response" => $recaptcha
);
$options = array(
	"http" => array (
		"method" => "POST",
		"content" => http_build_query($data)
	)
);
$context  = stream_context_create($options);
$verify = file_get_contents($url, false, $context);
$captcha_success = json_decode($verify);
if ($captcha_success->success) {
		
		//datos de correo

	$cabeceras  = "MIME-Version: 1.0\r\n"; 
	$cabeceras .= "Content-type: text/html; charset=utf-8\r\n";
	$cabeceras .= "From: Mensaje desde la WEB ARGAL INGENIEROS <proyectos@argalingenieros.com>\r\n";

	$titulo = "Mensaje desde la Web de ARGAL INGENIEROS";
	$correo= "cesarenrique.galvez@argalingenieros.com, desarrollo@geodreamspro.com";
	/*$correo= "desarrollo@geodreamspro.com";*/

	$asunto="Envio desde formulario web de la pagina de GARDEN";

	$mensaje="Nombre:" . $nombre . "<br>";
	$mensaje.="Email: " . $email . "<br>";
	$mensaje.="Mensaje: " .$texto."<br>";

		mail($correo,$titulo, $mensaje, $cabeceras );
		header("Location: http://www.argalingenieros.com/gracias.html"); 
		

}else{
	echo "REGRESA!, debes marcar la casilla de verificación!, gracias.";
}
	
?>