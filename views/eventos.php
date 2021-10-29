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
if ($msg == 'error_duplicate_email')
	echo '<div class="alert alert-danger" role="alert">Erro! Há outro usuário com este endereço de e-mail</div>';
if ($msg == 'edit_ok')
	echo '<div class="alert alert-success" role="alert">User updated</div>';
if ($msg == 'add_ok')
	echo '<div class="alert alert-success" role="alert">User added</div>';
if ($msg == 'delete_ok')
	echo '<div class="alert alert-success" role="alert">User deleted</div>';
if ($msg == 'error_delete_protected')
	echo '<div class="alert alert-danger" role="alert">Error! This user can not be deleted</div>';
?>

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

				<?php
				$stmt_events = $conn->prepare("SELECT * FROM " . DB_PREFIX . "evento ORDER BY id_evento");
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

					//$whatsapp = getUsersExtraUnique($user_id, 'whatsapp');
					//$bio = getUsersExtraUnique($user_id, 'bio');

				?>
					<div class="row">
						<div class="col-2">
							<div class="card">
								<div class="card-header text-center">
									<h5 class="card-title"><?= $evento ?></h5>
									<small class="text-muted"><?= $tipo ?></small>
								</div>
								<div class="card-body">
									<div class="row">										
										<div class="col-2"><i class="fa fa-calendar-check-o"></i></i></div>
										<div class="col-10"><?= $data ?></div>

										<div class="col-2"><i class="fa fa-clock-o"></i></i></div>
										<div class="col-10"><?= $hora ?></div>

										<div class="col-2"><i class="fa fa-map-marker bigfonts"></i></div>
										<div class="col-10"><strong><?= $local ?></strong></div>

										<div class="col-2"><i class="fa fa-map"></i></i></div>
										<div class="col-10"><a href="https://www.google.com.br/maps?q=<?= $local . "+" . $mapa ?>" target="_blank"><?= $endereco ?></a></div>

										<div class="col-2"><i class="fa fa-map-marker"></i></i></div>
										<div class="col-10"><?= $tipo ?></div>
									</div>
									<div class="row mt-3 text-success">
										<div class="col-2"><i class="fa fa-thumbs-o-up"></i></div>
										<div class="col-10">Presente</div>
									</div>
									<div class="row mt-3 text-danger">
										<div class="col-2"><i class="fa fa-thumbs-o-down"></i></i></div>
										<div class="col-10">Ausente</div>
									</div>
								</div>
								<div class="card-footer">
									<div class="row">
										<div class="col-10"><small class="text-muted"></i>Participou do evento? </small></div>
										<div class="col-2 text-success"><i class="fa fa-thumbs-up"></i></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php
				} // end while
				?>
			</div>
		</div>
		<!-- end card-body -->
	</div>
	<!-- end card -->
</div>
<!-- end col -->
</div>