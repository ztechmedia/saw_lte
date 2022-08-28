<div class="modal-body">
    <div class="form-horizontal">
        <div class="form-group">
            <label class="col-md-3 control-label">Range</label>
            <div class="col-md-12">
                <input name="sub_range_value_edit" id="sub_range_value_edit" type="text" class="form-control" value="<?= $subcriteria->range_value ?>" />
                <span class="help-block form-error" id="sub_range_value_edit-error"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Nama</label>
            <div class="col-md-12">
                <input name="sub_name_edit" id="sub_name_edit" type="text" class="form-control" value="<?= $subcriteria->name ?>" />
                <span class="help-block form-error" id="sub_name_edit-error"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Nilai</label>
            <div class="col-md-12">
                <input name="sub_value_edit" id="sub_value_edit" type="text" class="form-control" value="<?= $subcriteria->value ?>" />
                <span class="help-block form-error" id="sub_value_edit-error"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Bobot</label>
            <div class="col-md-12">
                <input name="sub_weight_edit" id="sub_weight_edit" type="text" class="form-control" value="<?= $subcriteria->weight ?>" />
                <span class="help-block form-error" id="sub_weight-error"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-12">
                <button class="btn btn-info" onclick="updateSubAction('<?= $subcriteria->id ?>')">Simpan</button>
            </div>
        </div>
    </div>
</div>
