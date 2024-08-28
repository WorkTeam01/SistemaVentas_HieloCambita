<?php

include_once '../../config.php';

$user = $_POST['user'];
$password_user = $_POST['password_user'];

$contador = 0;
$sql = "SELECT * FROM usuario WHERE Usuario = '$user'";
$query = $pdo->prepare($sql);
$query->execute();

$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($usuarios as $usuario) {
    $contador += 1;
    $user_tabla = $usuario['Usuario'];
    $nombres = $usuario['NombresUsuario'];
    $password_user_tabla = $usuario['PasswordUsuario'];
}

if (($contador > 0 && password_verify($password_user, $password_user_tabla))) {
    echo "Datos correctos";
    session_start();
    $_SESSION['sesion_user'] = $user;
    header('Location:' . $URL . '/index.php');
} else {
    echo "Datos incorrectos";
    session_start();
    $_SESSION['mensaje'] = "Datos incorrectos";
    header('Location:' . $URL . '/Views/login.php');
}
