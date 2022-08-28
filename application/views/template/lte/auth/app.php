<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PENILAIAN CABANG TERBAIK - PT. NINJA EXPRESS</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?= asset('template/lte/plugins/fontawesome-free/css/all.min.css') ?>">
  <link rel="stylesheet" href="<?= asset('template/lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?= asset('template/lte/dist/css/adminlte.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= asset('plugin/sweetalert/sweetalert.css') ?>"/>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-info">
    <div class="card-header text-center">
      <a class="h1"><b>SAW</b></a>
    </div>
    <div class="card-body">
        <?php $this->load->view($view) ?>
    </div>
  </div>
</div>

<script type="text/javascript" src="<?= asset('template/lte/plugins/jquery/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?= asset('template/lte/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script type="text/javascript" src="<?= asset('template/lte/dist/js/adminlte.min.js') ?>"></script>
<script type="text/javascript" src="<?= asset('plugin/sweetalert/sweetalert.min.js') ?>"></script>
<script type="text/javascript" src="<?= asset('js/loader/loading.js') ?>"></script>
<script type="text/javascript" src="<?= asset('js/actions/errorHandler.js') ?>"></script>
<script type="text/javascript" src="<?= asset('js/ajaxRequest.js') ?>"></script>
<script type="text/javascript" src="<?= asset('js/actions/formAuth.js') ?>"></script>

<style>
    .form-error {
        color: red;
        font-style: italic;
    }
</style>

</body>
</html>
