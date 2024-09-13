<?php
include_once('../../App/config.php');

session_start();
if (isset($_SESSION['mensaje']) && isset($_SESSION['icono'])) {
    $mensaje = $_SESSION['mensaje'];
    $icono = $_SESSION['icono'];
    unset($_SESSION['mensaje']);
    unset($_SESSION['icono']);
} else {
    $mensaje = 'Redirigiendo...';
    $icono = 'info';
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error en los permisos</title>
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?php echo $URL; ?>/Public/Css/sweetalert2.min.css">
    <script src="<?php echo $URL; ?>/Public/Js/sweetalert2.min.js"></script>
</head>

<body>
    <script>
        Swal.fire({
            title: "<?php echo $mensaje; ?>",
            icon: "<?php echo $icono; ?>",
            showConfirmButton: false,
            timer: 3000
        }).then(() => {
            window.location.href = '<?php echo $URL; ?>';
        });
    </script>
</body>

</html>