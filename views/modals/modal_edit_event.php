<?php
debug_backtrace() || die("Direct access not permitted");
?>
<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true" id="modal_edit_event_<?= $id_evento; ?>">
	<div class="modal-dialog">
		<div class="modal-content">

			<form action="core/EventEdit.php" method="post" enctype="multipart/form-data">

				<div class="modal-header">
					<h5 class="modal-title">Alterar Evento</h5>
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Evento</label>
								<input class="form-control" name="evento" type="text" required value="<?php echo $evento; ?>" />
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label>Tipo</label>
								<select name="tipo" class="form-control">
									<?= isset($tipo) ? "<option value='".$tipo."' disabled selected>". $tipo."</option>" : "<option value='' disabled selected>-- Selecione -- </option>"; ?>
									<option value="Colegiado">Colegiado</option>
									<option value="Regional">Regional</option>
								</select>
							</div>
						</div>
						<div class="col-lg-5">
							<div class="form-group">
								<label>data</label>
								<input class="form-control" name="data" type="date" required value="<?php echo $data; ?>" />
							</div>
						</div>

						<div class="col-lg-3">
							<div class="form-group">
								<label>Hora</label>
								<input class="form-control" name="hora" type="time" required value="<?php echo $hora; ?>" />
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Local</label>
								<input class="form-control" name="local" type="text" required value="<?php echo $local; ?>" />
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Endereço Completo</label>
								<input class="form-control" name="endereco" type="text" value="<?php echo $endereco; ?>" />
							</div>
						</div>
					</div>

				</div>


				<div class="modal-footer">
					<input type="hidden" name="user_id" value="<?php echo $id_evento; ?>" />
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>

			</form>

		</div>
	</div>
</div>