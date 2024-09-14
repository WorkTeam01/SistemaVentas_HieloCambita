<?php

include_once '../../config.php';

session_start(); // Iniciar sesión

$usuario = $_POST['usuario'];
$nombres_usuario = $_POST['nombres_usuario'];
$apellidos_usuario = $_POST['apellidos_usuario'];
$email = $_POST['email'];
$rol = $_POST['rol'];
$puesto = $_POST['puesto'];
$password_user = $_POST['password_user'];
$password_repeat = $_POST['password_repeat'];

// Almacenar los datos en la sesión para preservarlos
$_SESSION['form_data'] = $_POST;

// Verificar si las contraseñas coinciden
if ($password_user != $password_repeat) {
    $_SESSION['mensaje'] = 'Las contraseñas no coinciden';
    $_SESSION['icono'] = 'error';
    header('Location: ' . $URL . '/Views/Usuarios/create.php');
    exit();
}

try {
    // Verificar si el nombre de usuario ya existe
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuario WHERE Usuario = :Usuario");
    $stmt->bindParam(':Usuario', $usuario);
    $stmt->execute();
    $usuario_existente = $stmt->fetchColumn();

    if ($usuario_existente > 0) {
        $_SESSION['mensaje'] = 'El nombre de usuario ya existe. Intenta con otro.';
        $_SESSION['icono'] = 'error';
        header('Location: ' . $URL . '/Views/Usuarios/create.php');
        exit();
    }

    // Verificar si el email ya existe
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuario WHERE EmailUsuario = :EmailUsuario");
    $stmt->bindParam(':EmailUsuario', $email);
    $stmt->execute();
    $email_existente = $stmt->fetchColumn();

    if ($email_existente > 0) {
        $_SESSION['mensaje'] = 'El email ya está registrado. Intenta con otro.';
        $_SESSION['icono'] = 'error';
        header('Location: ' . $URL . '/Views/Usuarios/create.php');
        exit();
    }

    // Si no hay duplicados, proceder con la inserción
    $pdo->beginTransaction(); // Iniciar una transacción

    $password_hash = password_hash($password_user, PASSWORD_DEFAULT);
    $sentencia = $pdo->prepare("INSERT INTO usuario 
        (Usuario, NombresUsuario, ApellidosUsuario, EmailUsuario, IdRolUsuario, IdPuesto, PasswordUsuario) 
        VALUES (:Usuario, :NombresUsuario, :ApellidosUsuario, :EmailUsuario, :IdRolUsuario, :IdPuesto, :PasswordUsuario)");

    $sentencia->bindParam(':Usuario', $usuario);
    $sentencia->bindParam(':NombresUsuario', $nombres_usuario);
    $sentencia->bindParam(':ApellidosUsuario', $apellidos_usuario);
    $sentencia->bindParam(':EmailUsuario', $email);
    $sentencia->bindParam(':IdRolUsuario', $rol);
    $sentencia->bindParam(':IdPuesto', $puesto);
    $sentencia->bindParam(':PasswordUsuario', $password_hash);

    $sentencia->execute();

    $pdo->commit(); // Confirmar la transacción

    // Limpiar los datos de formulario de la sesión
    unset($_SESSION['form_data']);

    $_SESSION['mensaje'] = 'El usuario se registró exitosamente';
    $_SESSION['icono'] = 'success';
    header('Location: ' . $URL . '/Views/Usuarios');
    exit();
} catch (Exception $e) {
    $pdo->rollBack(); // Revertir la transacción en caso de error
    $_SESSION['mensaje'] = 'Hubo un error al registrar el usuario: ' . $e->getMessage();
    $_SESSION['icono'] = 'error';
    header('Location: ' . $URL . '/Views/Usuarios/create.php');
    exit();
}
