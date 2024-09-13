<?php
require_once '../../App/config.php';
require_once '../../Views/Layouts/sesion.php';
require_once '../../App/Controllers/middleware/AuthMiddleware.php';

$auth = new AuthMiddleware($pdo, $URL);
$usuario = $auth->verificarPermiso('Administrador');

include_once '../../Views/Layouts/header.php';
include_once '../../App/Controllers/productos/listado_de_productos.php';
include_once '../../App/Controllers/categorias/listado_de_categorias.php';
include_once '../../App/Controllers/puesto/listado_de_puestos.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Crear producto</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Ingrese los datos del producto</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"> <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body" style="display: block;">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="<?php echo $URL; ?>/App/Controllers/productos/create.php" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Código</label>
                                                            <?php
                                                            function ceros($numero)
                                                            {
                                                                $len = 0;
                                                                $cantidad_ceros = 5;
                                                                $aux = $numero;
                                                                $pos = strlen($numero);
                                                                $len = $cantidad_ceros - $pos;
                                                                for ($i = 0; $i < $len; $i++) {
                                                                    $aux = "0" . $aux;
                                                                }
                                                                return $aux;
                                                            }
                                                            ?>
                                                            <input type="text" value="P-<?php echo ceros($contador_de_producto); ?>" class="form-control" disabled>
                                                            <input type="text" name="codigo" value="P-<?php echo ceros($contador_de_producto); ?>" class="form-control" hidden>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Categoría</label>
                                                        <div class="d-flex">
                                                            <select name="id_categoria" class="form-control mr-2" required>
                                                                <?php foreach ($categorias_datos as $categorias_dato) { ?>
                                                                    <option value="<?php echo $categorias_dato['IdCategoria']; ?>">
                                                                        <?php echo $categorias_dato['NombreCategoria']; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                            <a href="<?php echo $URL; ?>/Views/Categorias" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Nombre del producto</label>
                                                        <input type="text" name="nombre" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Descripción del producto</label>
                                                            <textarea type="text" rows="2" name="descripcion" class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Puesto</label>
                                                        <div class="d-flex">
                                                            <select name="id_puesto" class="form-control mr-2" required>
                                                                <?php foreach ($puestos_datos as $puestos_dato) : ?>
                                                                    <option value="<?php echo $puestos_dato['IdPuesto']; ?>">
                                                                        <?php echo $puestos_dato['NombrePuesto']; ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Fecha de ingreso</label>
                                                            <input type="date" name="fecha_ingreso" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Stock</label>
                                                            <input type="number" name="stock" class="form-control" required min="0">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Stock mínimo</label>
                                                            <input type="number" name="stock_minimo" class="form-control" min="0">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Stock máximo</label>
                                                            <input type="number" name="stock_maximo" class="form-control" min="0">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Precio de compra</label>
                                                            <input type="number" name="precio_compra" class="form-control" required min="0" step="0.01">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Precio de venta</label>
                                                            <input type="number" name="precio_venta" class="form-control" required min="0" step="0.01">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Imagen del producto</label>
                                                    <input type="file" name="image" class="form-control-file" id="file">
                                                    <output id="list"></output>
                                                    <script>
                                                        function archivo(evt) {
                                                            var files = evt.target.files; // FileList object
                                                            // Obtenemos la imagen del campo "file".
                                                            for (var i = 0, f; f = files[i]; i++) {
                                                                //Solo admitimos imágenes.
                                                                if (!f.type.match('image.*')) {
                                                                    continue;
                                                                }
                                                                var reader = new FileReader();
                                                                reader.onload = (function(theFile) {
                                                                    return function(e) {
                                                                        // Insertamos la imagen
                                                                        document.getElementById("list").innerHTML = ['<img class="img-thumbnail img-fluid mt-3 mx-auto d-block" src="', e.target.result, '" width="60%" height="60%" title="', escape(theFile.name), '"/>'].join('');
                                                                    };
                                                                })(f);
                                                                reader.readAsDataURL(f);
                                                            }
                                                        }
                                                        document.getElementById('file').addEventListener('change', archivo, false);
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <a href="<?php echo $URL; ?>/Views/Productos" class="btn btn-secondary mr-1">Cancelar</a>
                                            <button type="submit" class="btn btn-primary">Guardar producto</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
<!-- /.content-wrapper -->

<?php include_once '../../Views/Layouts/mensajes.php'; ?>
<?php include_once '../../Views/Layouts/footer.php'; ?>