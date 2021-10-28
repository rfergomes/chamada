<?php
debug_backtrace() || die("Direct access not permitted");
?>
<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="modal_add_user" aria-hidden="true" id="modal_add_user">
	<div class="modal-dialog">
		<div class="modal-content">

			<form action="core/UserAdd.php" method="post" enctype="multipart/form-data">


				<div class="modal-header">
					<h5 class="modal-title" id="modal_add_user">Novo Usuário</h5>
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				</div>

				<div class="modal-body">

					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Nome Completo (Obrigatório)</label>
								<input class="form-control" name="name" type="text" required />
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>E-mail Válido (Obrigatório)</label>
								<input class="form-control" name="email" type="email" required />
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label>Senha (Obrigatório)</label>
								<input class="form-control" name="password" type="text" required />
							</div>
						</div>
					</div>

					<div class="row">

						<div class="col-lg-6">
							<div class="form-group">
								<label>Permissão</label>
								<select name="role_id" class="form-control" required>
									<option value="">- select -</option>
									<optgroup label="Staff member">
										<?php
										$stmt_user_role = $conn->prepare("SELECT role_id, title FROM " . DB_PREFIX . "users_roles WHERE active = 1 AND is_staff = 1 ORDER BY role_id ASC");
										$stmt_user_role->execute();
										while ($row = $stmt_user_role->fetch(PDO::FETCH_ASSOC)) {
											$role_id_selected = $row['role_id'];
											$role_title_selected = stripslashes($row['title']);
										?>
											<option value="<?php echo $role_id_selected; ?>"><?php echo $role_title_selected; ?></option>
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
											<option value="<?php echo $role_id_selected; ?>"><?php echo $role_title_selected; ?></option>
										<?php
										}
										?>
									</optgroup>
								</select>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label>WhatsApp (Opcional)</label>
								<input class="form-control" name="whatsapp" type="text" />
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>E-mail Verificado?</label>
								<select name="email_verified" class="form-control">
									<option value="1">SIM</option>
									<option value="0">NÃO</option>
								</select>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label>Ativo?</label>
								<select name="active" class="form-control">
									<option value="1">SIM</option>
									<option value="0">NÃO</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Biografia</label>
								<input class="form-control" name="bio" type="text" />
							</div>
						</div>
					</div>

					<div class="form-group">
						<label>Avatar (Opcional):</label> <br />
						<input type="file" name="image">
					</div>

				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Incluir</button>
				</div>

			</form>

		</div>
	</div>
</div>