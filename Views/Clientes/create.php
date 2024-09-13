<?php
require_once '../../App/config.php';
require_once '../../Views/Layouts/sesion.php';
require_once '../../App/Controllers/middleware/AuthMiddleware.php';

$auth = new AuthMiddleware($pdo, $URL);
$usuario = $auth->verificarRoles(['Administrador', 'Vendedor']);

include_once '../../Views/Layouts/header.php';

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Registro de cliente</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Formulario de registro de cliente</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body" style="display: block;">
                            <form action="<?php echo $URL; ?>/App/Controllers/clientes/create.php" method="POST">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tipo_cliente">Tipo de Cliente</label>
                                            <select name="tipo_cliente" id="tipo_cliente" class="form-control" required>
                                                <option value="natural">Natural</option>
                                                <option value="juridico">Jurídico</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="celular">Celular</label>
                                            <input type="tel" id="celular" name="celular" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="descuento">Descuento</label>
                                            <input type="number" id="descuento" name="descuento" class="form-control" min="0" step="0.01">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="campos_natural">
                                            <div class="form-group">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" id="nombre" name="nombre" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="genero">Género:</label>
                                                <select name="genero" id="genero" class="form-control">
                                                    <option value="Masculino">Masculino</option>
                                                    <option value="Femenino">Femenino</option>
                                                    <option value="Otro">Otro</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div id="campos_juridico" style="display:none;">
                                            <div class="form-group">
                                                <label for="razon_social">Razón Social</label>
                                                <input type="text" id="razon_social" name="razon_social" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="representante_legal">Representante Legal</label>
                                                <input type="text" id="representante_legal" name="representante_legal" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="email_juridico">Email Jurídico</label>
                                                <input type="email" id="email_juridico" name="email_juridico" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <a href="<?php echo $URL; ?>/Views/Clientes" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Registrar Cliente</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include_once '../../Views/Layouts/mensajes.php'; ?>
<?php include_once '../../Views/Layouts/footer.php'; ?>

<script>
    document.getElementById('tipo_cliente').addEventListener('change', function() {
        var camposNatural = document.getElementById('campos_natural');
        var camposJuridico = document.getElementById('campos_juridico');
        if (this.value === 'natural') {
            camposNatural.style.display = 'block';
            camposJuridico.style.display = 'none';
        } else {
            camposNatural.style.display = 'none';
            camposJuridico.style.display = 'block';
        }
    });
    document.getElementById('tipo_cliente').dispatchEvent(new Event('change'));
</script>