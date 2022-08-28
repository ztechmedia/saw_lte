<p class="login-box-msg">Reset Password</p>

<form class="form-horizontal auth-action" data-action-url="<?= base_url("auth/reset/$token_password") ?>"
	data-btn-name="Reset">

	<div class="form-group">
		<input name="password" id="password" type="password" class="form-control" placeholder="Password" />
		<span class="help-block form-error" id="password-error"><span>
	</div>

	<div class="form-group">
		<input name="confirm" id="confirm" type="password" class="form-control" placeholder="Confirm Password" />
		<span class="help-block form-error" id="confirm-error"><span>
	</div>

	<div class="row">
		<div class="col-md-6">
		</div>
		<div class="col-md-6">
			<button class="btn btn-info btn-block btn-submit" type="submit">Reset Password</button>
		</div>
	</div>
</form>
