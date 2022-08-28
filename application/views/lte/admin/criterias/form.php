<div class="form-group">
    <label class="col-md-3 control-label">Kode</label>
    <div class="col-md-3">
        <input name="code" id="code" type="text" class="form-control" value="<?= $criteria ? $criteria->code : "" ?>" />
        <span class="help-block form-error" id="code-error"></span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Nama Kriteria</label>
    <div class="col-md-3">
        <input name="name" id="name" type="text" class="form-control" value="<?= $criteria ? $criteria->name : "" ?>" />
        <span class="help-block form-error" id="name-error"></span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Bobot</label>
    <div class="col-md-3">
        <input name="weight" id="weight" type="number" class="form-control" value="<?= $criteria ? $criteria->weight : "" ?>" />
        <span class="help-block form-error" id="weight-error"></span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Type</label>
    <div class="col-md-3">
        <select name="type" id="type" type="text" class="form-control">
            <option value="">- Pilih -</option>
            <option <?= $criteria && $criteria->type === 'Cost' ? 'selected' : null ?> value="Cost">Cost</option>
            <option <?= $criteria && $criteria->type === 'Benefit' ? 'selected' : null ?> value="Benefit">Benefit</option>
        </select>
        <span class="help-block form-error" id="type-error"></span>
    </div>
</div>  