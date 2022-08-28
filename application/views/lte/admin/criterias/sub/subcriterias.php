<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Master</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item">Master</li>
						<li class="breadcrumb-item">Kriteria</li>
						<li class="breadcrumb-item active">Sub Kriteria</li>
					</ol>
				</div>
			</div>
		</div>
	</div>

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class='col-12'>
					<div class='card'>
						<div class='card-header'>
							<div class='card-title'><i class='fa fa-list'></i> Data Sub Kriteria
							</div>
						</div>
						<div class='card-body'>
							<div class="row">
								<div class="col-md-12">
									<div class="form-horizontal mt-2">
										<div class="form-group">
											<label class="col-md-3 control-label">Kode Kriteria</label>
											<div class="col-md-3">
												<input type="text" class="form-control" value="<?= $criteria->code ?>"
													readonly style="color:black" />
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Nama Kriteria</label>
											<div class="col-md-3">
												<input type="text" class="form-control" value="<?= $criteria->name ?>"
													readonly style="color:black" />
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Tipe</label>
											<div class="col-md-3">
												<input type="text" class="form-control" value="<?= $criteria->type ?>"
													readonly style="color:black" />
											</div>
										</div>

										<div class="form-group">
											<div class="col-md-3">
												<button class="btn btn-info btn-submit" onclick="addSub()">Tambah Sub Kriteria</button>
											</div>
										</div>
									</div>
								</div>
							</div>
                            <hr />
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="sub_table"></div>
                                </div>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>


<script>
    function loadSub() {
        loadView("admin/subcriterias/loadsub/<?= $criteria->id ?>", "#sub_table");
    }

    loadSub();

    function addSub() {
        $("#modal_basic").modal("show");
        $(".modal-title").html("Tambah Subkriteria");
        loadView("<?= base_url() ?>admin/subcriterias/create", ".modal-body");
    }

    function addSubAction() {
		if($("#sub_range_value").val() == '' || $("#sub_name").val() == '' || $("#sub_value").val() == '' || $("#sub_weight").val() == '') {
			swal("Error", 'Form tidak lengkap!', "warning");
		} else {
			const data = {
				critId: '<?= $criteria->id ?>',
				range_value: $("#sub_range_value").val(),
				name: $("#sub_name").val(),
				value: $("#sub_value").val(),
				weight: $("#sub_weight").val()
			}

			reqJson('admin/subcriterias/add', 'POST', data, (err, res) => {
				if(!err) {
					if(res.status === 'success') {
						loadSub();
						swal("Sukses", res.message, "success");
						$("#modal_basic").modal("hide");
						$("#sub_name").val("");
						$("#sub_weight").val("");
					} else {
						swal("Error", res.message, "warning");
					}
				} else {
					console.log(err);
				}
			});
		}
    }

    function updateSubAction(id) {
		if($("#sub_range_value_edit").val() == '' || $("#sub_name_edit").val() == '' || $("#sub_value_edit").val() == '' || $("#sub_weight_edit").val() == '') {
			swal("Error", 'Form tidak lengkap!', "warning");
		} else {
			const data = {
				range_value: $("#sub_range_value_edit").val(),
				name: $("#sub_name_edit").val(),
				value: $("#sub_value_edit").val(),
				weight: $("#sub_weight_edit").val()
			}

			reqJson(`admin/subcriterias/${id}/update`, 'POST', data, (err, res) => {
				if(!err) {
					if(res.status === 'success') {
						loadSub();
						swal("Sukses", res.message, "success");
						$("#modal_basic").modal("hide");
						$("#sub_name").val("");
						$("#sub_weight").val("");
					} else {
						swal("Error", res.message, "warning");
					}
				} else {
					console.log(err);
				}
			});
		}
    }
</script>
