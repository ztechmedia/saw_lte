<p class="login-box-msg">Aplikasi Pendukung Keputusan <br> <b>PT. NINJA EXPRESS</b></p>
<form class="form-horizontal auth-action" data-action-url="<?= base_url("auth/login") ?>" data-btn-name="Login">

	<div class="form-group">
		<input name="email" id="email" type="email" class="form-control" placeholder="E-mail" />
		<span class="help-block form-error" id="email-error"><span>
	</div>

	<div class="form-group">
		<input name="password" id="password" type="password" class="form-control" placeholder="Password" />
		<span class="help-block form-error" id="password-error"><span>
	</div>

	<div class="row">
		<div class="col-md-8">
			<a class="mt-3" href="<?= base_url("forgot-password") ?>">Lupa Password?</a>
		</div>

		<div class="col-md-4">
			<button class="btn btn-info btn-block btn-submit" type="submit">Login</button>
		</div>
	</div>

</form>
