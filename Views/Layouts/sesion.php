<?php
session_start();
$Año = date('Y');
if (isset($_SESSION['sesion_user'])) {
    $user_session = $_SESSION['sesion_user'];
    $sql = "SELECT us.IdUsuario, us.Usuario, us.NombresUsuario, us.ApellidosUsuario, tip.RolUsuario FROM usuario us
                INNER JOIN rol_usuario tip on us.IdRolUsuario = tip.IdRolUsuario WHERE Usuario = '$user_session'";
    $query = $pdo->prepare($sql);
    $query->execute();

    $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($usuarios as $usuario) {
        $id_usuario_sesion = $usuario['IdUsuario'];
        $nombres_sesion = $usuario['NombresUsuario'];
        $rol_sesion = $usuario['RolUsuario'];
    }
} else {
    echo "No existe sesion";
    header('Location:' . $URL . '/Views/login.php');
}
