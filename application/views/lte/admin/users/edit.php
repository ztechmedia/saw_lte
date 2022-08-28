<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">User</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item">Akun</li>
						<li class="breadcrumb-item">Admin</li>
						<li class="breadcrumb-item active">Edit Admin</li>
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
							<div class='card-title'><i class='fa fa-edit'></i> Edit User  <?=$role->display_name?></div>
						</div>
						<div class='card-body'>
                        <form 
                            class="form-horizontal action-update-formdata"
                            data-action-url="<?=base_url("admin/users/$user->id/update")?>" 
                            data-redirect="<?=base_url("admin/users/$role->id")?>"
                            data-class-target=".content-admin">

                            <?php 
                                $data['user'] = $user; 
                                $this->load->view('lte/admin/users/form', $data)
                            ?>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-6">
                                    <button class="btn btn-info btn-submit" type="submit">Update</button>
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