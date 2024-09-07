<?php
session_start();
$Año = date('Y');
if (isset($_SESSION['sesion_user'])) {
    $user_session = $_SESSION['sesion_user'];
    $sql = "SELECT us.IdUsuario, us.Usuario, us.NombresUsuario, us.ApellidosUsuario, p.NombrePuesto, tip.RolUsuario FROM usuario us
                INNER JOIN rol_usuario tip on us.IdRolUsuario = tip.IdRolUsuario
                INNER JOIN puesto p on us.IdPuesto = p.IdPuesto
                WHERE Usuario = '$user_session' OR EmailUsuario = '$user_session'";
    $query = $pdo->prepare($sql);
    $query->execute();

    $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($usuarios as $usuario) {
        $id_usuario_sesion = $usuario['IdUsuario'];
        $usuario_sesion = $usuario['Usuario'];
        $nombres_sesion = $usuario['NombresUsuario'];
        $apellidos_sesion = $usuario['ApellidosUsuario'];
        $puesto_usuario_sesion = $usuario['NombrePuesto'];
        $rol_sesion = $usuario['RolUsuario'];
    }
} else {
    header('Location:' . $URL . '/Views/login.php');
}
