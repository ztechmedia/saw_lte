<p class="login-box-msg">Lupa Password</p>

<form class="form-horizontal auth-action" data-action-url="<?= base_url("auth/send-link-forgot") ?>"
	data-btn-name="Kirim Link">

	<div class="form-group">
		<input name="email" id="email" type="email" class="form-control" placeholder="E-mail" />
		<span class="help-block form-error" id="email-error"><span>
	</div>

	<div class="row">
		<div class="col-md-8">
			<a href="<?= base_url("login") ?>">Login</a>
		</div>

		<div class="col-md-4">
			<button class="btn btn-info btn-block btn-submit" type="submit">Kirim Link</button>
		</div>
	</div>
</form>
