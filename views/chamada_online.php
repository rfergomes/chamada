<?php
debug_backtrace() || die("Direct access not permitted");
$id_evento = isset($_GET['id']) ? $_GET['id'] : null;
?>

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
	echo '<div class="alert alert-danger" role="alert">Erro! Participante não encontrado.</div>';
if ($msg == 'chamada_ok')
	echo '<div class="alert alert-success" role="alert">Sucesso! Chamada registrada.</div>';
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
	// START CODE FOR BASIC DATA TABLE 
	$(document).ready(function() {
		$('#tabela_eventos').DataTable({
			"language": {
				"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"

			},
			"order": [
				[5, "asc"],
				[1, "desc"]
			]
		});
	});
	// END CODE FOR BASIC DATA TABLE 
	$(function() {
		$('[data-toggle="tooltip"],[data-tt=tooltip]').tooltip();
		$('[data-toggle="popover"]').popover();
	})
</script>

<div class="container">
	<div class="col-10">
		<?php
		$numb_partic = $conn->query("SELECT count(1) FROM " . DB_PREFIX . "evento_detalhe e WHERE e.id_evento = " . $id_evento)->fetchColumn();
		$numb_presente = $conn->query("SELECT count(1) FROM " . DB_PREFIX . "evento_detalhe e WHERE e.id_evento = " . $id_evento . " AND status = 'PRESENTE'")->fetchColumn();
		$numb_ausente = $conn->query("SELECT count(1) FROM " . DB_PREFIX . "evento_detalhe e WHERE e.id_evento = " . $id_evento . " AND status = 'AUSENTE'")->fetchColumn();
		$presente_percent = number_format($numb_presente/$numb_partic*100,2);
		$ausente_percent = number_format($numb_ausente/$numb_partic*100,2);
		?>
		<div class="card border-success mb-3">
			<div class="card-header">
				<span class="pull-right"><a href="account.php?page=chamada" class="btn btn-sm btn-primary"><i class="fa fa-undo" aria-hidden="true"></i> Voltar </a></span>
				<h3><i class="fa fa-users"></i> Lista de Participante (<?= isset($numb_partic) == 0 ?: $numb_partic;; ?> Participantes)</h3>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
						<div class="row">

							<div class="col">
								<div class="progress">
									<div class="progress-bar progress-bar-striped progress-xs bg-success progress-bar-animated text-center" role="progressbar" style="width: <?= $presente_percent ?>%" aria-valuenow="<?= $presente_percent ?>" aria-valuemin="0" aria-valuemax="100"><?= $presente_percent ?>% Presentes</div>
									<div class="progress-bar progress-bar-striped progress-xs bg-danger progress-bar-animated text-center" role="progressbar" style="width: <?= $ausente_percent ?>%" aria-valuenow="<?= $ausente_percent ?>" aria-valuemin="0" aria-valuemax="100"><?= $ausente_percent ?>% Ausentes</div>
								</div>
								<table id="tabela_participantes" class="table table-bordered table-hover display dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example1_info" style="width: 100%;">
									<thead>
										<tr role="row">
											<th class="sorting_asc" tabindex="0" style="max-width: 100px;" aria-sort="ascending">Nome</th>
											<th class="sorting" tabindex="0" style="max-width: 30px;">Cargo</th>
											<th class="sorting text-center" tabindex="0" style="width: 10px;">Presente/Ausente</th>
											<th class="sorting text-center" tabindex="0" style="width: 10px;">Status</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql = "SELECT e.id_evento AS id_evento,e.id_usuario AS id_usuario,u.name AS name,u.role_id AS role_id,ur.role AS cargo,e.status AS presenca FROM ((chamada.users u JOIN chamada.users_roles ur ON (u.role_id = ur.role_id)) JOIN chamada.evento_detalhe e ON (e.id_usuario = u.user_id)) WHERE e.id_evento = '".$id_evento."'";
										$stmt_events = $conn->prepare($sql);
										$stmt_events->execute();
										while ($row = $stmt_events->fetch(PDO::FETCH_ASSOC)) {
											$id_usuario = $row['id_usuario'];
											$nome = $row['name'];
											$cargo = $row['cargo'];
											$status = $row['presenca'];
											$presente = strtoupper($status) == "PRESENTE" ? "disabled" : null;
											$ausente = strtoupper($status) == "AUSENTE" ? "disabled" : null;
										?>
											<tr role="row" class="odd">
												<td class="sorting_1"><?= $nome ?></td>
												<td class="text-center"><?= $cargo ?></td>
												<td class="text-center">
													<div class="row">
														<div class="col">
															<form action="Core/EventChamada.php" method="POST">
																<input type="hidden" name="e" value="<?= $id_evento ?>">
																<input type="hidden" name="u" value="<?= $id_usuario ?>">
																<input type="hidden" name="t" value="presente">
																<button type="submit" class="btn btn-sm btn-<?= isset($presente) ? "success" : "secondary" ?>" data-toggle="tooltip" data-title="Registrar Presença" <?= $presente ?>><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button>
															</form>
														</div>
														<div class="col">
															<form action="Core/EventChamada.php" method="POST">
																<input type="hidden" name="e" value="<?= $id_evento ?>">
																<input type="hidden" name="u" value="<?= $id_usuario ?>">
																<input type="hidden" name="t" value="ausente">
																<button type="submit" class="btn btn-sm btn-<?= isset($ausente) ? "danger" : "secondary" ?>" data-toggle="tooltip" data-title="Registrar Ausência" <?= $ausente ?>><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></button>
															</form>
														</div>
													</div>
												</td>
												<td class="text-center"><span class="badge badge-<?= isset($ausente) ? "danger" : "success" ?>"><?= strtoupper($status); ?></span></td>
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
			<div class="card-footer">
				<b>Legenda:</b>
				<small class="btn btn-sm btn-secondary disabled">&nbsp;</small> Disponível
				<small class="btn btn-sm btn-success disabled">&nbsp;</small> Presença Registrada
				<small class="btn btn-sm btn-danger disabled">&nbsp;</small> Ausência Registrada
			</div>
		</div><!-- end card-->
	</div>
	<!-- end card -->
</div>
<!-- end col -->