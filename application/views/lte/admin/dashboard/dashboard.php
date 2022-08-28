<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Dashboard</h1>
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
							<div class='card-title'><i class='fa fa-sync'></i> Logs</div>
						</div>
						<div class='card-body'>
                            <div class="logs"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<script>
	loadTable();

	function loadTable() {
		const url = encodeURI(
			`${BASE_URL}admin/logs/?limit=25&page=1`
		);
		setLoading('.logs');
		loadView(url, '.logs');
	}

	function changePage(page) {
		const url = encodeURI(
			`${BASE_URL}admin/logs?limit=25&page=${page}`
		);
		setLoading(".logs");
		loadView(url, ".logs");
	}

</script>
