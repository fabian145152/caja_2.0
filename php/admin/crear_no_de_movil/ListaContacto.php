<?php
session_start();
include_once('db.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<title>MOVILES</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<head>

	<body>

		<div class="container">

			<div class="row">
				<div class="col-md-12">
					<div class="panel-body">
						<!--Inicio elementos contenedor-->

						<?php
						//Verificar se esta sendo passado na URL a página atual, senão é atribuido a pagina
						$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;

						//Selecionar todos os itens da tabela 
						$result_msg_contato = "SELECT * FROM no_movil";
						$resultado_msg_contato = mysqli_query($conectar, $result_msg_contato);

						//Contar o total de itens
						$total_msg_contatos = mysqli_num_rows($resultado_msg_contato);

						//Seta a quantidade de itens por página
						$quantidade_pg = 20;

						//calcular o número de páginas 
						$num_pagina = ceil($total_msg_contatos / $quantidade_pg);

						//calcular o inicio da visualizao	
						$inicio = ($quantidade_pg * $pagina) - $quantidade_pg;

						//Selecionar  os itens da página
						$result_msg_contatos = "SELECT * FROM no_movil limit $inicio, $quantidade_pg";
						$resultado_msg_contatos = mysqli_query($conectar, $result_msg_contatos);
						$total_msg_contatos = mysqli_num_rows($resultado_msg_contatos);

						?>
						<div class="container theme-showcase" role="main">
							<div class="page-header">
								<h1>Lista de Moviles</h1>
							</div>
							<div class="dropdown">
								<span class="glyphicon glyphicon-cog btn-lg text-primary" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></span>
								</button>
								<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
									<li><a href="form_contacto.php">Registrar</a></li>
									<li><a href="GenerarExcel.php">Generar Fichero Excel</a></li>
								</ul>
							</div>
							<div class="row espaco">
								<div class="pull-right">

									<a href="GenerarExcel.php"><button type='button' class='btn btn-sm btn-primary'>Generar Excel</button></a>
									<a href="list_no_movil.php"></a> <button type='button' class='btn btn-sm btn-primary'>Salir</button></a>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<table class="table">
										<thead>
											<tr>
												<th class="text-center">Id</th>
												<th class="text-center">Movil</th>

											</tr>
										</thead>
										<tbody>
											<?php while ($row_msg_contatos = mysqli_fetch_assoc($resultado_msg_contatos)) { ?>
												<tr>
													<td class="text-center"><?php echo $row_msg_contatos["id"]; ?></td>
													<td class="text-center"><?php echo $row_msg_contatos["id_titu"]; ?></td>

												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>

							<?php
							//Verificar pagina anterior e posterior
							$pagina_anterior = $pagina - 1;
							$pagina_posterior = $pagina + 1;
							?>
							<nav class="text-center">
								<ul class="pagination">
									<li>
										<?php
										if ($pagina_anterior != 0) {
										?><a href="administrativo.php?link=50&pagina=<?php echo $pagina_anterior; ?>" aria-label="Previous">
												<span aria-hidden="true">&laquo;</span>
											</a><?php
											} else {
												?><span aria-hidden="true">&laquo;</span><?php
																						}
																							?>
									</li>
									<?php
									//presentar paginacion
									for ($i = 1; $i < $num_pagina + 1; $i++) {
									?>
										<li><a href="administrativo.php?link=50&pagina=<?php echo $i; ?>">
												<?php echo $i; ?>
											</a></li>
									<?php
									}
									?>
									<li>
										<?php
										if ($pagina_posterior <= $num_pagina) {
										?><a href="administrativo.php?link=50&pagina=<?php echo $pagina_posterior; ?>" aria-label="Next">
												<span aria-hidden="true">&raquo;</span>
											</a><?php
											} else {
												?><span aria-hidden="true">&raquo;</span><?php
																						}
																							?>
									</li>
								</ul>
							</nav>
						</div>
						<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
						<script src="js/bootstrap.min.js"></script>

						<!--Fin elementos contenedor-->
					</div>
				</div>
			</div>
		</div>
		<div class="panel-footer">
			<div class="container">
			</div>
		</div>

	</body>

</html>