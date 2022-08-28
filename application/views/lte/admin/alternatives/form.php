<div class="form-group">
    <label class="col-md-3 control-label">Kode Cabang</label>
    <div class="col-md-3">
        <input name="code" id="code" type="text" class="form-control" value="<?= $alt ? $alt->code : "" ?>" />
        <span class="help-block form-error" id="code-error"></span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Nama Cabang</label>
    <div class="col-md-3">
        <input name="name" id="name" type="text" class="form-control" value="<?= $alt ? $alt->name : "" ?>" />
        <span class="help-block form-error" id="name-error"></span>
    </div>
</div>

<?php foreach ($criterias as $key => $value) { ?>
    <div class="form-group">
        <label class="col-md-3 control-label"><?= $value['name'] ?></label>
        <div class="col-md-3">
            <select name="<?= $value['code'] ?>" id="<?= $value['code'] ?>" type="text" class="form-control">
                <?php foreach ($value['subcriterias'] as $key => $sValue) { ?>
                    <option value="<?= $sValue ?>"><?= $sValue ?></option>
                <?php } ?>
            </select>
            <span class="help-block form-error" id="<?= $value['code'] ?>-error"></span>
        </div>
    </div>  
<?php } ?>