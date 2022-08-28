<div class="form-group">
    <label class="col-md-3 control-label">Nama</label>
    <div class="col-md-3">
        <input name="name" id="name" type="text" class="form-control" value="<?= $user ? $user->name : "" ?>" />
        <span class="help-block form-error" id="name-error"></span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Email</label>
    <div class="col-md-3">
        <input name="email" id="email" type="email" class="form-control" value="<?= $user ? $user->email : "" ?>" />
        <span class="help-block form-error" id="email-error"></span>
    </div>
</div>

<?php if (!$user) { ?>

    <div class="form-group">
        <label class="col-md-3 control-label">Password</label>
        <div class="col-md-3">
            <input type="password" class="form-control" name="password" id="password" />
            <span class="help-block form-error" id="password-error"></span>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">Konfirmasi Password:</label>
        <div class="col-md-3">
            <input type="password" class="form-control" name="confirm" id="confirm" />
            <span class="help-block form-error" id="confirm-error"></span>
        </div>
    </div>

<?php } ?>

<?php if ($this->auth->role_id == 1) { ?>

    <div class="form-group">
        <label class="col-md-3 control-label">Hak Akses</label>
        <div class="col-md-3">
            <select class="form-control" name="role" id="role">
                <option value="">Pilih Hak Akses</option>
                <?php foreach ($roles as $role) {
                    $selected = null;
                    if ($user && $role->id === $user->role) {
                        $selected = 'selected';
                    }
                    echo "<option $selected value=" . $role->id . " >$role->display_name</option>";
                } ?>
            </select>
            <span class="help-block form-error" id="role-error"></span>
        </div>
    </div>
    
<?php } ?>