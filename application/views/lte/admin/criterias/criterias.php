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
						<li class="breadcrumb-item active">Kriteria</li>
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
							<div class='card-title'><i class='fa fa-hdd'></i> Kriteria</div>
						</div>
						<div class='card-body'>
							<div class="btnContainer">
								<button class="btn btn-info link-to"
									data-to="<?= base_url("admin/criterias/create") ?>">
									Tambah Kriteria
								</button>
							</div>
							<table class="table table-condensed" id="dtable">
								<thead>
									<th width="8%">No</th>
									<th>Kode</th>
									<th>Nama</th>
									<th>Bobot</th>
									<th>Tipe</th>
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
        $('#dtable').DataTable({
            "processing": false,
            "serverSide": true,
            "order": [
                [1, 'desc']
            ],
            "ajax": {
                "url": "<?= base_url("admin/criterias-table") ?>",
                "type": "POST"
            },
            columns: [{
                    data: "no",
                },
                {
                    data: "code",
                },
                {
                    data: "name",
                },
                {
                    data: "weight",
                },
                {
                    data: "type",
                },
                {
                    data: 'actions'
                }
            ]
        });
    });
</script>