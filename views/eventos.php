<?php
$numb_events = $conn->query("SELECT count(1) FROM " . DB_PREFIX . "evento")->fetchColumn();
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
if ($msg == 'error_name')
	echo '<div class="alert alert-danger" role="alert">Erro! Insira o nome completo</div>';
if ($msg == 'error_email')
	echo '<div class="alert alert-danger" role="alert">Erro! Insira um e-mail válido</div>';
if ($msg == 'error_data')
	echo '<div class="alert alert-danger" role="alert">Erro! Data incorreta!</div>';
if ($msg == 'error_duplicate_email')
	echo '<div class="alert alert-danger" role="alert">Erro! Há outro usuário com este endereço de e-mail</div>';
if ($msg == 'edit_ok')
	echo '<div class="alert alert-success" role="alert">Evento alterado com sucesso!</div>';
if ($msg == 'add_ok')
	echo '<div class="alert alert-success" role="alert">Evento cadastrado com Sucesso!</div>';
if ($msg == 'delete_ok')
	echo '<div class="alert alert-success" role="alert">Evento excluído com sucesso!</div>';
if ($msg == 'error_delete_protected')
	echo '<div class="alert alert-danger" role="alert">Error! This user can not be deleted</div>';
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

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
</script>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div class="card mb-3">
			<div class="card-header">
				<span class="pull-right"><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_add_event"><i class="fa fa-user-plus" aria-hidden="true"></i> Novo</button></span>
				<?php include("modals/modal_add_event.php"); ?>
				<h3><i class="fa fa-user"></i> Lista de Eventos (<?= isset($numb_events) == 0 ?: $numb_events;; ?> eventos)</h3>
			</div>
			<!-- end card-header -->
			<div class="card-body">

				<div class="table-responsive">
					<div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
						<div class="row">
							<div class="col-sm-12">
								<table id="tabela_eventos" class="table table-bordered table-hover display dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example1_info" style="width: 100%;">
									<thead>
										<tr role="row">
											<th class="sorting" tabindex="0"><i class="fa fa-list-alt bigfonts"></i> EVENTO</th>
											<th class="sorting_asc text-center" tabindex="0"><i class="fa fa-calendar-check-o bigfonts"></i> DATA</th>
											<th class="sorting text-center" tabindex="0"><i class="fa fa-clock-o bigfonts"></i> HORÁRIO</th>
											<th class="sorting" tabindex="0"><i class="fa fa-map-marker bigfonts"></i> LOCAL</th>
											<th class="sorting" tabindex="0"><i class="fa fa-map bigfonts"></i> ENDEREÇO</th>
											<th class="sorting text-center" tabindex="0"><i class="fa fa-exclamation-triangle bigfonts"></i> SITUAÇÃO</th>
											<th class="sorting_asc text-center" tabindex="0"><i class="fa fa-exclamation-circle bigfonts"></i> AÇÃO</th>

										</tr>
									</thead>
									<tbody>
										<?php
										$stmt_events = $conn->prepare("SELECT * FROM " . DB_PREFIX . "evento ORDER BY data");
										$stmt_events->execute();

										while ($row = $stmt_events->fetch(PDO::FETCH_ASSOC)) {
											$id_evento = $row['id_evento'];
											$evento = stripslashes($row['evento']);
											$data = $row['data'];
											$hora = $row['hora'];
											$local = $row['local'];
											$endereco = $row['endereco'];
											$mapa = str_replace(" ", "+", $endereco);
											$tipo = $row['tipo'];
											$situacao = $row['situacao'];
											$badge = $situacao == "Ativo" ? "success" : "secondary";

										?>
											<tr role="row" class="odd">
												<td class="sorting_1"><?= $evento ?></td>
												<td class="text-center"><?= $data ?></td>
												<td class="text-center"><?= $hora ?></td>
												<td><?= $local ?></td>
												<td><?= $endereco ?></td>
												<td class="text-center"><span class="<?= "badge badge-" . $badge ?>"><?= $situacao ?></span></td>
												<td class="text-center">
													<div class="row">
														<div class="col-6">
															<a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_edit_event_<?= $id_evento; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
														</div>
														<?php include("modals/modal_edit_event.php"); ?>
														<div class="col-6">
															<a href="javascript:deleteRecord_<?= $id_evento; ?>('<?= $id_evento; ?>');" class="btn btn-danger btn-sm" data-placement="top" data-toggle="tooltip" data-title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
															<script language="javascript" type="text/javascript">
																function deleteRecord_<?php echo $id_evento; ?>(RecordId) {
																	if (confirm('Confirma exclusão?')) {
																		window.location.href = 'core/EventDelete.php?id=<?php echo $id_evento; ?>';
																	}
																}
															</script>
														</div>
													</div>
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
		</div>
		<!-- end card-body -->
	</div>
	<!-- end card -->
</div>
<!-- end col -->