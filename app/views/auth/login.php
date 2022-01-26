<div class="container">
<div class="row">
<div class="col-lg-3 col-md-3 col-sm-3 hidden-xs">&nbsp;</div>
<div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
<div class="panel panel-default">
<div class="panel-heading" style='background: #428bca; color:#fff'><h1><b>Login</b></h1></div>
<div class="panel-body">
<form class="form-horizontal" method="POST" action="<?=site_url()?>login">
<div class="form-group">
<label for="email" class="col-md-4 control-label">Dirección Email</label>
<div class="col-md-6">
<input id="email" type="email" class="form-control" name="email" value="" required autofocus>
<span class="help-block">
<strong></strong>
</span>
</div>
</div>
<div class="form-group">
<label for="password" class="col-md-4 control-label">Contraseña</label>
<div class="col-md-6">
<input id="password" type="password" class="form-control" name="password" required>
<span class="help-block">
<strong></strong>
</span>
</div>
</div>
<div class="form-group">
<div class="col-md-6 col-md-offset-4">
<div class="checkbox">
<label>
<input type="checkbox" name="remember"> Recordar
</label>
</div>
</div>
</div>
<div class="form-group">
<div class="col-md-8 col-md-offset-4">
<button type="submit" class="btn btn-primary">Iniciar sesión</button>
<a class="btn btn-link" href="">
¿Click aquí si has olvidado la contraseña?
</a>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>