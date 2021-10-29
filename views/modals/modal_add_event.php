<?php
debug_backtrace() || die("Direct access not permitted");
?>
<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="modal_add_event" aria-hidden="true" id="modal_add_event">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="core/UserAdd.php" method="post" enctype="multipart/form-data">
				<div class="modal-header">
					<h5 class="modal-title" id="modal_add_event">Novo Evento</h5>
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				</div>
				<div class="modal-body">

					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Evento</label>
								<input class="form-control" name="evento" type="text" required />
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label>Tipo</label>
								<select name="tipo" class="form-control">
									<option value="0">Colegiado</option>
									<option value="1">Regional</option>
								</select>
							</div>
						</div>
						<div class="col-lg-5">
							<div class="form-group">
								<label>data</label>
								<input class="form-control" name="data" type="date" required />
							</div>
						</div>

						<div class="col-lg-3">
							<div class="form-group">
								<label>Hora</label>
								<input class="form-control" name="hora" type="time" required />
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Local</label>
								<input class="form-control" name="local" type="text" required />
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Endereço Completo</label>
								<input class="form-control" name="endereco" type="text" />
							</div>
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Cadastrar</button>
				</div>
			</form>
		</div>
	</div>
</div>