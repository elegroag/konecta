<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">						
				<div class="panel-heading">Registro</div>
					<div class="panel-body">
						<form class="form-horizontal" method="POST" action="<?=site_url()?>register">

							<div class="form-group">
								<label for="nombres" class="col-md-4 control-label">Nombres</label>
								<div class="col-md-6">
									<input id="nombres" type="text" class="form-control" name="nombres" value="" required autofocus>
									<span class="help-block">
										<strong></strong>
									</span>
								</div>
							</div>

							<div class="form-group">
								<label for="apellidos" class="col-md-4 control-label">Apellidos</label>
								<div class="col-md-6">
									<input id="apellidos" type="text" class="form-control" name="apellidos" value="" required autofocus>
									<span></span>
								</div>
							</div>

							<div class="form-group">
								<label for="email" class="col-md-4 control-label">@Email</label>
								<div class="col-md-6">
									<input id="email" type="email" class="form-control" name="email" value="" required>
									<span class="help-block">
										<strong></strong>
									</span>
								</div>
							</div>

							<div class="form-group">
								<label for="password" class="col-md-4 control-label">Password</label>
								<div class="col-md-6">
									<input id="password" type="password" class="form-control" name="password" required>
									<span class="help-block">
										<strong></strong>
									</span>
								</div>
							</div>

							<div class="form-group">
								<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
								<div class="col-md-6">
									<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">Register</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>