<?php
session_start();
include_once('db.php');
if (empty($_POST['nombres'])) {
	$_SESSION['configuroweb_nombres'] = "Campo nombre obligatorio";
	header('Location: form_contacto.php');
} elseif (empty($_POST['email'])) {
	$_SESSION['configuroweb_email'] = "Campo e-mail obligatorio";
	header('Location: form_contacto.php');
} elseif (empty($_POST['asunto'])) {
	$_SESSION['configuroweb_asunto'] = "Campo asunto obligatorio";
	header('Location: form_contacto.php');
} elseif (empty($_POST['mensaje'])) {

	$_SESSION['configuroweb_mensaje'] = "Campo mensaje obligatorio";
	header('Location: form_contacto.php');
} else {


	$nombres = mysqli_real_escape_string($conectar, $_POST['nombres']);
	$email = mysqli_real_escape_string($conectar, $_POST['email']);
	$asunto = mysqli_real_escape_string($conectar, $_POST['asunto']);
	$mensaje = mysqli_real_escape_string($conectar, $_POST['mensaje']);


	$result_msg_contato = "INSERT INTO contactos(nombres, email, asunto, mensajes, fcreacion) VALUES ('$nombres', '$email', '$asunto', '$mensaje', NOW())";
	$resultado_msg_contato = mysqli_query($conectar, $result_msg_contato);
	header('Location: ListaContacto.php');
}
