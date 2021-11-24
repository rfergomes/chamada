<?php
$numb_events = $conn->query("SELECT count(1) FROM " . DB_PREFIX . "evento WHERE situacao = 'Ativo' ")->fetchColumn();
?>

<?php if (DEMO_MODE != 0) { ?>
	<div class="alert alert-danger" role="alert">
		<h4 class="alert-heading">Important!</h4>
		<p>This section is available in Pike Admin PRO version.</p>
		<p><b>Save over 50 hours of development with our Pro Framework: Registration / Login / Users Management, CMS, Front-End Template (who will load contend added in admin area and saved in MySQL database), Contact Messages Management, manage Website Settings and many more, at an incredible price!</b></p>
		<p>Read more about all PRO features here: <a target="_blank" href="https://www.pikeadmin.com/pike-admin-pro"><b>Pike Admin PRO features</b></a></p>
	</div>
<?php } ?>


<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div class="card mb-3">
			<div class="card-header">
				<span class="pull-right"><a href="index.php" class="btn btn-sm btn-primary"><i class="fa fa-undo" aria-hidden="true"></i> Voltar </a></span>
				<h3><i class="fa fa-user"></i> Chamada Online (<?= isset($numb_events) == 0 ?: $numb_events;; ?> eventos)</h3>
			</div>
			<!-- end card-header -->
			<div class="card-body">
				<?php if ($numb_events > 0) { ?>
					<div class="row">
						<?php
						$sql = "SELECT * FROM " . DB_PREFIX . "evento WHERE situacao = 'Ativo'";
						$stmt = $conn->prepare($sql);
						$stmt->execute();
						while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
							$id_evento = $row['id_evento'];
							$evento = $row['evento'];
							$data = $row['data'];
							$hora = $row['hora'];
							$local = $row['local'];
							$endereco = $row['endereco'];
							$tipo = $row['tipo'];
						?>
							<div class="card border-primary mb-3 mr-3" style="width: 18rem;">
								<div class="card-body">
									<h5 class="card-title text-center"><?= $evento ?><br /><small class=""><?= $tipo ?></small></h5>
									<div class="row card-text">
										<div class="col">
											<p class=""><i class="fa fa-map-marker bigfonts"></i> <?= $local ?></p>
										</div>
									</div>
									<div class="row card-text ">
										<div class="col">
											<p class=""><i class="fa fa-calendar-check-o bigfonts"></i> <?= $data ?></p>
										</div>
										<div class="col">
											<p class=""><i class="fa fa-clock-o bigfonts"></i> <?= $hora ?></p>
										</div>
									</div>
								</div>
								<div class="card-header text-center">
									<?php if ($_SESSION['nivel_acesso'] < 3) { ?>
										<a href="account.php?page=chamada_online&id=<?= $id_evento ?>" class="btn btn-sm btn-primary">Confirmar Presença</a>
									<?php }elseif(now() >= $data){ ?>
										<a href="account.php?page=chamada_online&id=<?= $id_evento ?>" class="btn btn-sm btn-primary">Confirmar Presença</a>
									<?php } ?>
								</div>
							</div>
						<?php } ?>
					</div>
				<?php
				} else {
					echo "<h5 class='card-text text-center text-danger'><i class='fa fa-exclamation-triangle bigfonts' aria-hidden='true'></i> No momento não existe nenhum evento ativo.</h5>";
				}
				?>

			</div>
		</div>
	</div>

</div>