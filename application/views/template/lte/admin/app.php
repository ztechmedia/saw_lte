<!DOCTYPE html>
<html lang="en">
<?php include('head.php') ?>

<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">

		<!-- Preloader -->
		<div class="preloader flex-column justify-content-center align-items-center">
			<img class="animation__shake" src="<?= asset('images/toga.png') ?>" alt="AdminLTELogo" height="60"
				width="60">
		</div>

		<?php 
			include('navbar.php');
			include('sidebar.php');
			include('content.php');
		?>

		<div class="modal fade" id="modal_basic">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title"></h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body"></div>
				</div>
			</div>
		</div>

		<!-- jQuery -->
		<script src="<?= asset('template/lte/plugins/jquery/jquery.min.js') ?>"></script>
		<!-- jQuery UI 1.11.4 -->
		<script src="<?= asset('template/lte/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
		<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
		<!-- Bootstrap 4 -->
		<script src="<?= asset('template/lte/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
		<!-- overlayScrollbars -->
		<script src="<?= asset('template/lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>">
		</script>
		<!-- AdminLTE App -->
		<script src="<?= asset('template/lte/dist/js/adminlte.js') ?>"></script>

		<script type="text/javascript" src="<?= asset('plugin/sweetalert/sweetalert.min.js') ?>"></script>
		<script type="text/javascript" src="<?= asset('plugin/datatables/datatables.min.js') ?>"></script>
		<script type="text/javascript" src="<?= asset('js/loader/loading.js') ?>"></script>
		<script type="text/javascript" src="<?= asset('js/loader/viewLoader.js') ?>"></script>
		<script type="text/javascript" src="<?= asset('js/ajaxRequest.js') ?>"></script>
		<script type="text/javascript" src="<?= asset('js/actions/errorHandler.js') ?>"></script>
		<script type="text/javascript" src="<?= asset('js/actions/formActions.js') ?>"></script>
		<script type="text/javascript" src="<?= asset('js/actions/global.js') ?>"></script>

		<script>
			const BASE_URL = '<?= base_url() ?>';
			setCurrentNav("<?= base_url("dashboard") ?>");

			function resetData() {
				$("#modal_basic").modal('show');
				$(".modal-title").html('Reset Aplikasi');
				loadView('<?= base_url() ?>admin/reset_form', '.modal-body')
			}

		</script>

		<style>
			.pointer {
				cursor: pointer;
			}

			.btnContainer {
				margin-bottom: 10px;
			}

			.btn-table {
				cursor: pointer;
				color: green;
				display: inline-block;
				margin-right: 20px;
			}

			.form-error {
				color: red;
				font-style: italic;
			}

		</style>
</body>

</html>
