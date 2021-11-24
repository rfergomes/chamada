<?php
	$id_evento = isset($_GET['id']) ? $_GET['id'] : null;
	$numb_events = $conn->query("SELECT count(1) FROM " . DB_PREFIX . "evento_detalhe WHERE id_evento = " . $id_evento)->fetchColumn();
?>
<!-- end row -->

<?php if (DEMO_MODE != 0) { ?>
	<div class="alert alert-danger" role="alert">
		<h4 class="alert-heading">Important!</h4>
		<p>This section is available in Pike Admin PRO version.</p>
		<p><b>Save over 50 hours of development with our Pro Framework: Registration / Login / Users Management, CMS, Front-End Template (who will load contend added in admin area and saved in MySQL database), Contact Messages Management, manage Website Settings and many more, at an incredible price!</b></p>
		<p>Read more about all PRO features here: <a target="_blank" href="https://www.pikeadmin.com/pike-admin-pro"><b>Pike Admin PRO features</b></a></p>
	</div>
<?php } ?>

<?php
if ($msg == 'erro')
	echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			Erro! Dados não encontrados
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
  			</button>
  		</div>';
if ($msg == 'edit_ok')
	echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
			Participante incluído com sucesso!
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>';
if ($msg == 'add_ok')
	echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
			Participante cadastrado com sucesso!
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>';
if ($msg == 'delete_ok')
	echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
			Participante removido com sucesso!
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>';
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

<script>
	// START CODE FOR BASIC DATA TABLE 
	$(document).ready(function() {
		$('#tabela_inclusao').DataTable({
			"language": {
				"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
			}
		});
		$('#tabela_participantes').DataTable({
			"language": {
				"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
			}
		});

	});
	// END CODE FOR BASIC DATA TABLE 
</script>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div class="card mb-3">
			<div class="card-header">
				<span class="pull-right"><a href="account.php?page=eventos" class="btn btn-sm btn-primary"> <i class="fa fa-reply"></i> Voltar</a></span>

				<h3><i class="fa fa-user"></i> Detalhes do Evento</h3>
			</div>
			<!-- end card-header -->
			<div class="card-body">

				<div class="row">

					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
						<?php
						$numb_add = $conn->query("SELECT count(1) FROM " . DB_PREFIX . "users u WHERE u.user_id\n"
							. "NOT IN(SELECT e.id_usuario FROM " . DB_PREFIX . "evento_detalhe e	WHERE e.id_evento = " . $id_evento . ")")->fetchColumn();
						?>
						<div class="card border-primary mb-3">

							<div class="card-header">
								<h3><i class="fa fa-user-plus"></i> Incluir Participante (<?= isset($numb_add) == 0 ?: $numb_add;; ?> Restantes)</h3>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
										<div class="row">
											<div class="col-sm-12">
												<table id="tabela_inclusao" class="table table-bordered table-hover display dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example1_info" style="width: 100%;">
													<thead>
														<tr role="row">
															<th class="sorting_asc" tabindex="0" style="width: 80px;" aria-sort="ascending">Nome</th>
															<th class="sorting text-center" tabindex="0" style="width: 30px;">Cargo</th>
															<th class="sorting text-center" tabindex="0" style="width: 30px;">Ação</th>
														</tr>
													</thead>
													<tbody>
														<?php
														$sql = "SELECT u.user_id, u.name, u.role_id FROM " . DB_PREFIX . "users u WHERE u.user_id\n"
															. "NOT IN(SELECT e.id_usuario FROM " . DB_PREFIX . "evento_detalhe e	WHERE e.id_evento = " . $id_evento . ");";
														$stmt_events = $conn->prepare($sql);
														$stmt_events->execute();
														while ($row = $stmt_events->fetch(PDO::FETCH_ASSOC)) {
															$id_usuario = $row['user_id'];
															$nome = $row['name'];
															$cargo = $row['role_id'];

														?>
															<tr role="row" class="odd">
																<td class="sorting_1"><?= $nome ?></td>
																<td class="text-center"><?= $cargo ?></td>
																<td class="text-center">
																	<form action="Core/ParticipanteAdd.php" method="POST">
																		<input type="hidden" name="e" value="<?= $id_evento ?>">
																		<input type="hidden" name="u" value="<?= $id_usuario ?>">
																		<input class="btn btn-sm btn-primary" type="submit" value="Incluir">
																	</form>
																</td>
															</tr>
														<?php
														} // end while
														?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div><!-- end card-->
					</div>

					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
						<?php
						$numb_partic = $conn->query("SELECT count(1) FROM " . DB_PREFIX . "evento_detalhe e WHERE e.id_evento = " . $id_evento)->fetchColumn();
						?>
						<div class="card border-success mb-3">
							<div class="card-header">
								<h3><i class="fa fa-users"></i> Lista de Participante (<?= isset($numb_partic) == 0 ?: $numb_partic;; ?> Participantes)</h3>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
										<div class="row">
											<div class="col-sm-12">
												<table id="tabela_participantes" class="table table-bordered table-hover display dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example1_info" style="width: 100%;">
													<thead>
														<tr role="row">
															<th class="sorting_asc" tabindex="0" style="width: 80px;" aria-sort="ascending">Nome</th>
															<th class="sorting" tabindex="0" style="width: 30px;">Cargo</th>
															<th class="sorting" tabindex="0" style="width: 30px;">Ação</th>
														</tr>
													</thead>
													<tbody>
														<?php
														$sql = "SELECT * FROM " . DB_PREFIX . "evento_detalhes WHERE id_evento = " . $id_evento;
														$stmt_events = $conn->prepare($sql);
														$stmt_events->execute();
														while ($row = $stmt_events->fetch(PDO::FETCH_ASSOC)) {
															$id_usuario = $row['id_usuario'];
															$nome = $row['name'];
															$cargo = $row['cargo'];
														?>
															<tr role="row" class="odd">
																<td class="sorting_1"><?= $nome ?></td>
																<td class="text-center"><?= $cargo ?></td>
																<td class="text-center">
																	<form action="Core/ParticipanteDelete.php" method="POST">
																		<input type="hidden" name="e" value="<?= $id_evento ?>">
																		<input type="hidden" name="u" value="<?= $id_usuario ?>">
																		<input class="btn btn-sm btn-danger" type="submit" value="Remover">
																	</form>
																</td>
															</tr>
														<?php
														} // end while
														?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>

							</div>
						</div><!-- end card-->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end card-body -->
</div>