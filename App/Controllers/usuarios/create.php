<?php

include_once '../../config.php';

$usuario = $_POST['usuario'];
$nombres_usuario = $_POST['nombres_usuario'];
$apellidos_usuario = $_POST['apellidos_usuario'];
$email = $_POST['email'];
$rol = $_POST['rol'];
$puesto = $_POST['puesto'];
$password_user = $_POST['password_user'];
$password_repeat = $_POST['password_repeat'];

if ($password_user == $password_repeat) {
    $password_user = password_hash($password_user, PASSWORD_DEFAULT);
    $sentencia = $pdo->prepare("INSERT INTO usuario
    (Usuario, NombresUsuario, ApellidosUsuario, EmailUsuario, IdRolUsuario, IdPuesto, PasswordUsuario)
    VALUES (:Usuario, :NombresUsuario, :ApellidosUsuario, :EmailUsuario, :IdRolUsuario, :IdPuesto, :PasswordUsuario)");

    $sentencia->bindParam('Usuario', $usuario);
    $sentencia->bindParam('NombresUsuario', $nombres_usuario);
    $sentencia->bindParam('ApellidosUsuario', $apellidos_usuario);
    $sentencia->bindParam('EmailUsuario', $email);
    $sentencia->bindParam('IdRolUsuario', $rol);
    $sentencia->bindParam('IdPuesto', $puesto);
    $sentencia->bindParam('PasswordUsuario', $password_user);
    $sentencia->execute();

    session_start();
    $_SESSION['mensaje'] = 'EL usuario se registró exitosamente';
    $_SESSION['icono'] = 'success';
    header('Location: ' . $URL . '/Views/Usuarios');
} else {
    //echo "Las contraseñas no coinciden";
    session_start();
    $_SESSION['mensaje'] = 'Las contraseñas no coinciden';
    $_SESSION['icono'] = 'error';
    header('Location: ' . $URL . '/Views/Usuarios/create.php');
}
