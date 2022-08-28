<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">User</h1>
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
							<div class='card-title'><i class='fa fa-users'></i> Users</div>
						</div>
						<div class='card-body'>
							<?php if ($this->auth->role_id == 1) { ?>
							<div class="btnContainer">
								<button class="btn btn-info link-to"
									data-to="<?= base_url("admin/users/create/$role->id") ?>">
									Tambah <?= $role->display_name ?>
								</button>
							</div>
							<?php } ?>
							<table class="table table-condensed" id="admin">
								<thead>
									<th width="8%">No</th>
									<th>Nama</th>
									<th>Email</th>
									<th width="12%">Tindakan</th>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<script>
    $(document).ready(() => {
        $('#admin').DataTable({
            "processing": false,
            "serverSide": true,
            "order": [
                [1, 'desc']
            ],
            "ajax": {
                "url": "<?= base_url("admin/users-table/$role->id") ?>",
                "type": "POST"
            },
            columns: [{
                    data: "no",
                },
                {
                    data: "name",
                },
                {
                    data: "email",
                },
                {
                    data: 'actions'
                }
            ]
        });
    });
</script>