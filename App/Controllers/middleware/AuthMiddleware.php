<?php

class AuthMiddleware
{
    private $pdo;
    private $URL;

    public function __construct($pdo, $URL)
    {
        $this->pdo = $pdo;
        $this->URL = $URL;
    }

    public function verificarSesion()
    {
        if (session_status() == PHP_SESSION_NONE)
            session_start();

        if (!isset($_SESSION['sesion_user'])) {
            $_SESSION['mensaje'] = 'Debes iniciar sesión para acceder a esta página.';
            $_SESSION['icono'] = 'warning';
            header('Location: ' . $this->URL . '/Views/login.php');
            exit();
        }
    }

    public function obtenerDatosUsuario($user)
    {
        $sql = "SELECT us.IdUsuario, us.Usuario, us.NombresUsuario, us.ApellidosUsuario, p.NombrePuesto, tip.RolUsuario FROM usuario us
                INNER JOIN rol_usuario tip on us.IdRolUsuario = tip.IdRolUsuario
                INNER JOIN puesto p on us.IdPuesto = p.IdPuesto
                WHERE Usuario = :user OR EmailUsuario = :user";
        $query = $this->pdo->prepare($sql);
        $query->execute(['user' => $user]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function verificarPermiso($rol_requerido)
    {
        $this->verificarSesion();
        $usuario = $this->obtenerDatosUsuario($_SESSION['sesion_user']);
        if ($usuario['RolUsuario'] != $rol_requerido) {
            $_SESSION['mensaje'] = 'No tienes permisos para acceder a esta página.';
            $_SESSION['icono'] = 'error';
            header('Location: ' . $this->URL . '/Views/Error/error.php');
            exit();
        }
        return $usuario;
    }

    public function verificarRoles($roles_permitidos)
    {
        $this->verificarSesion();
        $usuario = $this->obtenerDatosUsuario($_SESSION['sesion_user']);
        if (!in_array($usuario['RolUsuario'], $roles_permitidos)) {
            $_SESSION['mensaje'] = 'No tienes permisos para acceder a esta página.';
            $_SESSION['icono'] = 'error';
            header('Location: ' . $this->URL . '/Views/Error/error.php');
            exit();
        }
        return $usuario;
    }
}
/*
// Ejemplo de uso en una página protegida (ventas.php)
require_once 'config.php';
require_once 'middleware/AuthMiddleware.php';

$auth = new AuthMiddleware($pdo, $URL);
$usuario = $auth->verificarPermiso('Vendedor');

// Aquí va el código de la página de ventas
echo "Bienvenido a la página de ventas, " . $usuario['nombres'];

// Ejemplo de uso con múltiples roles permitidos
// $usuario = $auth->verificarRoles(['Administrador', 'Gerente']);
*/