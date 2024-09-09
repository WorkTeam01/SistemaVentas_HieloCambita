<?php
require_once '../../App/config.php';
require_once '../../Views/Layouts/sesion.php';

include_once '../../Views/Layouts/header.php';

include_once '../../App/Controllers/abasto/cargar_abasto.php';

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Eliminar el abasto</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">¿Estas seguro de eliminar este abasto?</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"> <i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body" style="display: block;">
                                    <h5>Datos del producto</h5>
                                    <hr>
                                    <div class="row" style="font-size: 14px;">
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input type="text" id="id_producto" value="<?php echo $id_producto_tabla; ?>" class="form-control" hidden>
                                                        <label>Código</label>
                                                        <input type="text" value="<?php echo $codigo; ?>" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Categoría</label>
                                                        <input type="text" value="<?php echo $nombre_categoria; ?>" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Nombre del producto</label>
                                                        <input type="text" value="<?php echo $nombre_producto; ?>" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Puesto</label>
                                                        <input type="text" class="form-control" value="<?php echo $puesto; ?>" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <label>Descripción del producto</label>
                                                        <textarea type="text" rows="3" class="form-control" disabled><?php echo $descripcion_producto; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Fecha de ingreso</label>
                                                        <input type="text" class="form-control text-center" value="<?php echo $fecha_ingreso; ?>" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Stock</label>
                                                        <input type="text" class="form-control bg-warning text-center" value="<?php echo $stock; ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Stock mínimo</label>
                                                        <input type="text" class="form-control text-center" value="<?php echo $stock_minimo; ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Stock máximo</label>
                                                        <input type="text" class="form-control text-center" value="<?php echo $stock_maximo; ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Precio de compra</label>
                                                        <input type="text" class="form-control text-center" value="<?php echo $precio_compra ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Precio de venta</label>
                                                        <input type="text" class="form-control text-center" value="<?php echo $precio_venta; ?>" disabled>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Imagen del producto</label>
                                                <img class="rounded mx-auto d-block" src="<?php echo $URL . "/Views/Productos/img_productos/" . $imagen; ?>" width="60%" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <h5>Datos del proveedor</h5>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="id_proveedor" hidden>
                                                <label for="nombre_proveedor">Nombre del proveedor</label>
                                                <input type="text" value="<?php echo $nombre_proveedor_tabla; ?>" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="celular">Celular</label>
                                                <input type="number" class="form-control" value="<?php echo $celular_proveedor; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="telefono">Telefono</label>
                                                <input type="number" class="form-control" value="<?php echo $telefono_proveedor; ?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" value="<?php echo $email_proveedor; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="direccion">Dirección</label>
                                                <textarea id="direccion" rows="3" class="form-control" disabled><?php echo $direccion_proveedor; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-outline card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">Detalle del abasto</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" value="<?php echo $id_abasto; ?>" hidden>
                                                <label>Número del abasto</label>
                                                <input type="text" class="form-control" value="<?php echo $nro_abasto ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Fecha del abasto</label>
                                                <input type="date" class="form-control text-center" value="<?php echo $fecha_abasto ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Comprobante del abasto</label>
                                                <input type="text" class="form-control" value="<?php echo $comprobante; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Precio del abasto</label>
                                                <input type="text" class="form-control text-center" value="<?php echo $precio_abasto; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Cantidad del abasto</label>
                                                <input type="number" id="cantidad" class="form-control text-center" value="<?php echo $cantidad; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Puesto</label>
                                                <input type="text" class="form-control" value="<?php echo $puesto; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Usuario</label>
                                                <input type="text" id="usuario" class="form-control" value="<?php echo $nombre_usuario; ?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <button type="button" id="btn_eliminar_compra" class="btn btn-danger btn-block"><i class="fas fa-trash"></i> Eliminar compra</button>
                                        <a href="<?php echo $URL; ?>/Views/Abasto" class="btn btn-secondary btn-block">Cancelar</a>
                                    </div>
                                    <div id="respuesta_delete"></div>
                                    <script>
                                        $('#btn_eliminar_compra').click(function() {

                                            var id_abasto = '<?php echo $id_abasto; ?>';
                                            var id_producto = $('#id_producto').val();
                                            var cantidad_abasto = '<?php echo $cantidad; ?>';
                                            var stock_actual = '<?php echo $stock; ?>';

                                            Swal.fire({
                                                title: '¿Está seguro de eliminar esta compra?',
                                                text: 'No podrá recuperar la información una vez eliminada.',
                                                icon: 'question',
                                                showCancelButton: true,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: 'Eliminar compra'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    Swal.fire(
                                                        eliminar(),
                                                        'La compra ha sido eliminada con éxito.',
                                                        'success'
                                                    )
                                                }
                                            });

                                            function eliminar() {
                                                var url = "../../App/Controllers/abasto/delete.php";
                                                $.get(url, {
                                                    id_abasto: id_abasto,
                                                    id_producto: id_producto,
                                                    cantidad_abasto: cantidad_abasto,
                                                    stock_actual: stock_actual
                                                }, function(datos) {
                                                    $('#respuesta_delete').html(datos);
                                                });
                                            }
                                        });
                                    </script>
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