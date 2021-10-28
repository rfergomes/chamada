<!-- Text editor-->
<script src="<?php echo ADMIN_URL; ?>/assets/plugins/trumbowyg/trumbowyg.min.js"></script>
<script src="<?php echo ADMIN_URL; ?>/assets/plugins/trumbowyg/plugins/upload/trumbowyg.upload.js"></script>
<link rel="stylesheet" href="<?php echo ADMIN_URL; ?>/assets/plugins/trumbowyg/ui/trumbowyg.min.css">
<script>
	$(document).ready(function() {
		'use strict';
		$('.editor').trumbowyg();
	});
</script>

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
if ($msg == 'edit_ok') echo '<div class="alert alert-success" role="alert">Settings updated</div>';
if ($msg == 'test_email_ok') echo '<div class="alert alert-success" role="alert">Test email sent. Please check your email address</div>';
?>

<div class="row">

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

		<form action="core/SettingsEdit.php" method="post" enctype="multipart/form-data">

			<div class="card mb-3">

				<div class="card-header">
					<h3><i class="fa fa-file-text-o"></i> Configurações de registro</h3>
				</div>
				<!-- end card-header -->

				<div class="card-body">

					<div class="form-row">
						<div class="form-group col-md-3">
							<label>Registro público</label>
							<select name="cfg_registration_enabled" class="form-control">
								<option <?php if ($cfg_registration_enabled == 0) echo 'selected="selected"'; ?> value="0">Registro desativado</option>
								<option <?php if ($cfg_registration_enabled == 1) echo 'selected="selected"'; ?> value="1">Registro habilitado</option>
							</select>
						</div>

						<div class="form-group col-md-3">
							<label>Função do usuário para usuários registrados</label>
							<select name="cfg_registration_user_role" class="form-control">
								<option value="">- selecionar -</option>
								<optgroup label="Staff member">
									<?php
									$stmt_user_role = $conn->prepare("SELECT role_id, title FROM " . DB_PREFIX . "users_roles WHERE active = 1 AND is_staff = 1 ORDER BY role_id ASC");
									$stmt_user_role->execute();
									while ($row = $stmt_user_role->fetch(PDO::FETCH_ASSOC)) {
										$role_id_selected = $row['role_id'];
										$role_title_selected = stripslashes($row['title']);
									?>
										<option <?php if ($role_id_selected == $cfg_registration_user_role) echo 'selected="selected"'; ?> value="<?php echo $role_id_selected; ?>"><?php echo $role_title_selected; ?></option>
									<?php
									}
									?>
								</optgroup>

								<optgroup label="Registered member">
									<?php
									$stmt_user_role = $conn->prepare("SELECT role_id, title FROM " . DB_PREFIX . "users_roles WHERE active = 1 AND is_staff = 0 ORDER BY role_id ASC");
									$stmt_user_role->execute();
									while ($row = $stmt_user_role->fetch(PDO::FETCH_ASSOC)) {
										$role_id_selected = $row['role_id'];
										$role_title_selected = stripslashes($row['title']);
									?>
										<option <?php if ($role_id_selected == $cfg_registration_user_role) echo 'selected="selected"'; ?> value="<?php echo $role_id_selected; ?>"><?php echo $role_title_selected; ?></option>
									<?php
									}
									?>
								</optgroup>
							</select>
						</div>

						<div class="form-group col-md-3">
							<label>Os usuários devem confirmar o endereço de e-mail</label>
							<select name="cfg_registration_email_verification_enabled" class="form-control">
								<option <?php if ($cfg_registration_email_verification_enabled == 0) echo 'selected="selected"'; ?> value="0">Não</option>
								<option <?php if ($cfg_registration_email_verification_enabled == 1) echo 'selected="selected"'; ?> value="1">Sim</option>
							</select>
						</div>

					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-primary">Salvar</button>
					</div>

				</div>
				<!-- end card-body -->

			</div>
			<!-- end card -->


			<div class="card mb-3">

				<div class="card-header">
					<h3><i class="fa fa-file-text-o"></i> Configurações de antispam</h3>
					Você pode obter uma chave do site reCAPTCHA do Google e uma chave secreta aqui: <a target="_blank" href="https://www.google.com/recaptcha/">https://www.google.com/recaptcha/</a>
				</div>
				<!-- end card-header -->

				<div class="card-body">

					<div class="form-row">
						<div class="form-group col-md-3">
							<label>reCAPTCHA na página de registro</label>
							<select name="cfg_google_recaptcha_registration_enabled" class="form-control">
								<option <?php if ($cfg_google_recaptcha_registration_enabled == 0) echo 'selected="selected"'; ?> value="0">Desabilitado</option>
								<option <?php if ($cfg_google_recaptcha_registration_enabled == 1) echo 'selected="selected"'; ?> value="1">Habilitado</option>
							</select>
						</div>

						<div class="form-group col-md-3">
							<label>reCAPTCHA no formulário da página de contato</label>
							<select name="cfg_google_recaptcha_contact_enabled" class="form-control">
								<option <?php if ($cfg_google_recaptcha_contact_enabled == 0) echo 'selected="selected"'; ?> value="0">Desabilitado</option>
								<option <?php if ($cfg_google_recaptcha_contact_enabled == 1) echo 'selected="selected"'; ?> value="1">Habilitado</option>
							</select>
						</div>

						<div class="form-group col-md-3">
							<label>Chave do site Google reCAPTCHA</label>
							<input type="password" class="form-control" name="cfg_google_recaptcha_site_key" value="<?php echo $cfg_google_recaptcha_site_key; ?>">
						</div>

						<div class="form-group col-md-3">
							<label>Chave secreta do Google reCAPTCHA</label>
							<input type="password" class="form-control" name="cfg_google_recaptcha_secret_key" value="<?php echo $cfg_google_recaptcha_secret_key; ?>">
						</div>

					</div>


					<div class="form-group">
						<button type="submit" class="btn btn-primary">Salvar</button>
					</div>

				</div>
				<!-- end card-body -->

			</div>
			<!-- end card -->


			<div class="card mb-3">

				<div class="card-header">
					<h3><i class="fa fa-file-text-o"></i> Configurações de e-mail</h3>
				</div>
				<!-- end card-header -->

				<div class="card-body">

					<div class="form-row">
						<div class="form-group col-md-3">
							<label>Endereço de e-mail do site (De: e-mail)</label>
							<input class="form-control" name="cfg_site_email" type="text" value="<?php echo $cfg_site_email; ?>">
						</div>

						<div class="form-group col-md-3">
							<label>Nome de e-mail (De: nome)</label>
							<input type="text" class="form-control" name="cfg_site_email_name" value="<?php echo $cfg_site_email_name; ?>">
						</div>
					</div>


					<div class="form-row">
						<div class="form-group col-md-2">
							<label>Opção de envio de correio</label>
							<select name="cfg_mail_sending_option" class="form-control">
								<option <?php if ($cfg_mail_sending_option == 'php') echo 'selected="selected"'; ?> value="php">PHP mailer (NÃO recomendado)</option>
								<option <?php if ($cfg_mail_sending_option == 'smtp') echo 'selected="selected"'; ?> value="smtp">SMTP mailer (recomendado)</option>
							</select>
						</div>

						<div class="form-group col-md-2">
							<label>Servidor SMTP</label>
							<input type="text" class="form-control" name="cfg_mail_smtp_server" value="<?php echo $cfg_mail_smtp_server; ?>">
						</div>

						<div class="form-group col-md-2">
							<label>Usuário SMTP</label>
							<input type="text" class="form-control" name="cfg_mail_smtp_user" value="<?php echo $cfg_mail_smtp_user; ?>">
						</div>

						<div class="form-group col-md-2">
							<label>Senha SMTP</label>
							<input type="password" class="form-control" name="cfg_mail_smtp_password" value="<?php echo $cfg_mail_smtp_password; ?>">
						</div>

						<div class="form-group col-md-2">
							<label>Porta SMTP</label>
							<input type="text" class="form-control" name="cfg_mail_smtp_port" value="<?php echo $cfg_mail_smtp_port; ?>">
						</div>

						<div class="form-group col-md-2">
							<label>Criptografia SMTP</label>
							<select name="cfg_mail_smtp_encryption" class="form-control">
								<option <?php if ($cfg_mail_smtp_encryption == 'tls') echo 'selected="selected"'; ?> value="tls">TLS</option>
								<option <?php if ($cfg_mail_smtp_encryption == 'ssl') echo 'selected="selected"'; ?> value="ssl">SSL</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-primary">Salvar</button>
					</div>

				</div>
				<!-- end card-body -->

			</div>
			<!-- end card -->

		</form>

		<div class="card mb-3">
			<div class="card-header">
				<h3><i class="fa fa-envelope-o"></i> Testar configurações de e-mail</h3>
				Envie um e-mail de teste usando suas configurações
			</div>
			<!-- end card-header -->

			<div class="card-body">
				<form action="core/SendTestEmail.php" method="post">
					<div class="form-group form-inline">
						<input type="text" class="form-control" name="test_email" placeholder="Informe o e-mail">
						<button type="submit" class="btn btn-primary">Enviar e-mail de teste</button>
					</div>
				</form>
			</div>
			<!-- end card-body -->
		</div>
		<!-- end card -->


	</div>
	<!-- end col -->

</div>
<!-- end row -->


<script>
	$(document).ready(function() {
		'use strict';

		// ------------------------------------------------------- //
		// Text editor (WYSIWYG)
		// ------------------------------------------------------ //
		$('.editor').trumbowyg({
			removeformatPasted: true,
			autogrow: true,
			btnsDef: {
				// Create a new dropdown
				image: {
					dropdown: ['insertImage', 'upload'],
					ico: 'insertImage'
				}
			},

			btns: [
				['viewHTML'],
				['undo', 'redo'],
				['formatting'],
				'btnGrp-semantic',
				['superscript', 'subscript'],
				['link'],
				['image'],
				'btnGrp-justify',
				'btnGrp-lists',
				['horizontalRule'],
				['removeformat'],
				['fullscreen']
			],

			plugins: {
				upload: {
					serverPath: '<?php echo ADMIN_URL; ?>/assets/plugins/trumbowyg/texteditor-upload.php',
					fileFieldName: 'image'
				}
			}

		});

	});
</script>