<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

?>
<!DOCTYPE html>
<html lang="es-es">

<head>
	<meta charset="utf-8">
	<title>MOVILES</title>


	<head>

	<body>
		<?php
		// Definimos el archivo exportado
		$arquivo = 'listado_de_numeros.xls';

		// Crear la tabla HTML
		$html = '';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td colspan="5">Listado de Numeros de movil</tr>';
		$html .= '</tr>';


		$html .= '<tr>';
		$html .= '<tr>';
		$html .= '<td><b>ID</b></td>';
		$html .= '<td><b>Movil</b></td>';
		$html .= '<td><b>Apellido</b></td>';

		$html .= '</tr>';

		//Seleccionar todos los elementos de la tabla
		$result_msg_contatos = "SELECT * FROM completa";
		$resultado_msg_contatos = mysqli_query($con, $result_msg_contatos);

		while ($row_msg_contatos = mysqli_fetch_assoc($resultado_msg_contatos)) {
			$html .= '<tr>';
			$html . '<td>' . '</td>';
			$html .= '<td>' . $row_msg_contatos["id"] . '</td>';
			$html .= '<td>' . $row_msg_contatos["movil"] . '</td>';
			$html .= '<td>' . $row_msg_contatos["apellido_titu"] . '</td>';



			$html .= '</tr>';;
		}
		// Configuración en la cabecera
		header("Expires: Mon, 26 Jul 2227 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
		header("Cache-Control: no-cache, must-revalidate");
		header("Pragma: no-cache");
		header("Content-type: application/x-msexcel");
		header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
		header("Content-Description: PHP Generado Data");
		// Envia contenido al archivo
		echo $html;
		//exit; 
		?>
	</body>

</html>