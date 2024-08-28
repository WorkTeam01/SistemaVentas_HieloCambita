<?php
include_once 'App/config.php';
include_once 'Views/Layouts/sesion.php';
include_once 'Views/Layouts/header.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Bienvenido al sistema - <?= $rol_sesion; ?></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include_once 'Views/Layouts/footer.php';
?>