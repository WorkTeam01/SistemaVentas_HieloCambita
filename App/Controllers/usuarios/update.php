<?php

include_once '../../config.php';

$usuario = $_POST['usuario'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$estado = isset($_POST['estado']) ? 1 : 0;
$rol = $_POST['rol'];
$puesto = $_POST['puesto'];
$password_user = $_POST['password_user'];
$password_repeat = $_POST['password_repeat'];
$id_usuario = $_POST['id_usuario'];

if ($password_user == "") {
    $sentencia = $pdo->prepare("UPDATE usuario
        SET Usuario = :Usuario, NombresUsuario = :NombresUsuario, ApellidosUsuario = :ApellidosUsuario,
        EmailUsuario = :EmailUsuario, EstadoUsuario = :EstadoUsuario, IdRolUsuario = :IdRolUsuario, IdPuesto = :IdPuesto
        WHERE IdUsuario = :IdUsuario");

    $sentencia->bindParam('Usuario', $usuario);
    $sentencia->bindParam('NombresUsuario', $nombres);
    $sentencia->bindParam('ApellidosUsuario', $apellidos);
    $sentencia->bindParam('EmailUsuario', $email);
    $sentencia->bindParam('EstadoUsuario', $estado);
    $sentencia->bindParam('IdRolUsuario', $rol);
    $sentencia->bindParam('IdPuesto', $puesto);
    $sentencia->bindParam('IdUsuario', $id_usuario);
    $sentencia->execute();

    session_start();
    $_SESSION['mensaje'] = 'EL usuario se actualizó exitosamente';
    $_SESSION['icono'] = 'success';
    header('Location: ' . $URL . '/Views/Usuarios');
} else {
    if ($password_user == $password_repeat) {
        $password_user = password_hash($password_user, PASSWORD_DEFAULT);
        $sentencia = $pdo->prepare("UPDATE usuario
        SET Usuario = :Usuario, NombresUsuario = :NombresUsuario, ApellidosUsuario = :ApellidosUsuario,
        EmailUsuario = :EmailUsuario, EstadoUsuario = :EstadoUsuario, IdRolUsuario = :IdRolUsuario, PasswordUsuario = :PasswordUsuario
        WHERE IdUsuario = :IdUsuario");

        $sentencia->bindParam('Usuario', $usuario);
        $sentencia->bindParam('NombresUsuario', $nombres);
        $sentencia->bindParam('ApellidosUsuario', $apellidos);
        $sentencia->bindParam('EmailUsuario', $email);
        $sentencia->bindParam('EstadoUsuario', $estado);
        $sentencia->bindParam('PasswordUsuario', $password_user);
        $sentencia->bindParam('IdRolUsuario', $rol);
        $sentencia->bindParam('IdUsuario', $id_usuario);
        $sentencia->execute();

        session_start();
        $_SESSION['mensaje'] = 'EL usuario se actualizó exitosamente';
        $_SESSION['icono'] = 'success';
        header('Location: ' . $URL . '/Views/Usuarios');
    } else {
        //echo "Las contraseñas no coinciden";
        session_start();
        $_SESSION['mensaje'] = 'Las contraseñas no coinciden';
        $_SESSION['icono'] = 'error';
        header('Location: ' . $URL . '/Views/Usuarios/update.php?id=' . $id_usuario);
    }
}
