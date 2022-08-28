<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Kriteria</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item">Master Data</li>
						<li class="breadcrumb-item">Kriteria</li>
						<li class="breadcrumb-item active">Tambah Kriteria</li>
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
							<div class='card-title'><i class='fa fa-edit'></i> Tambah Kriteria
							</div>
						</div>
						<div class='card-body'>
                            <form 
                                class="form-horizontal action-create-formdata" 
                                data-action-url="<?= base_url("admin/criterias/add") ?>">

                                <?php 
                                    $data['criteria'] = null; 
                                    $this->load->view('lte/admin/criterias/form', $data) 
                                ?>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-md-6">
                                        <button class="btn btn-info btn-submit" type="submit">Simpan</button>
                                    </div>
                                </div>
                            </form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
