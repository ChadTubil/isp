<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ISP - Login</title>
    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>public/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>public/assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="<?= base_url(); ?>public/assets/Logo2.png">

</head>
<body style="background-color: #263A56">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row" style="text-align: center">
                            <div class="col-lg-6 d-none d-lg-block">
                                <img src="<?= base_url(); ?>public/assets/Logo.png" alt=""
                                style="width: 100%">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 mb-4" style="color: black; ">Welcome Back!</h1>
                                        <h5 style="color: black;"><strong>INTERNET SERVICE PROVIDER</strong></h5>
                                    </div>
                                    <?= form_open('/', ['class' => 'user']); ?>
                                        <?php if(isset($validation)): ?>
                                            <div class="card bg-danger text-white shadow">
                                                <div class="card-body" style="text-align: left;">
                                                    <?= validation_list_errors() ?>
                                                </div>
                                            </div>
                                            <br>
                                        <?php endif; ?>
                                        <?php if(session()->getTempdata('error')): ?>
                                            <div class="card bg-danger text-white shadow">
                                                <div class="card-body" style="text-align: left;">
                                                    <?= session()->getTempdata('error') ?>
                                                </div>
                                            </div>
                                            <br>
                                        <?php endif; ?>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                name="user" placeholder="Employee ID" value="<?= set_value('user') ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                name="pass" placeholder="Password" value="<?= set_value('pass') ?>">
                                        </div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                    <?= form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url(); ?>public/assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?= base_url(); ?>public/assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?= base_url(); ?>public/assets/js/sb-admin-2.min.js"></script>
</body>
</html>