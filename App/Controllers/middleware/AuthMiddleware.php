<?php

class AuthMiddleware
{
    private $pdo;
    private $URL;

    public function __construct($pdo, $URL)
    {
        $this->pdo = $pdo;
        $this->URL = $URL;
        ob_start();
    }

    public function verificarSesion()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['sesion_user'])) {
            $this->redirigirConMensaje('login.php', 'Debes iniciar sesión para acceder a esta página.', 'warning');
        }
    }

    public function obtenerDatosUsuario($user)
    {
        $sql = "SELECT us.IdUsuario, us.Usuario, us.NombresUsuario, us.ApellidosUsuario, 
                       p.NombrePuesto, r.RolUsuario, us.EstadoUsuario 
                FROM usuario us
                INNER JOIN rol_usuario r ON us.IdRolUsuario = r.IdRolUsuario
                INNER JOIN puesto p ON us.IdPuesto = p.IdPuesto
                WHERE us.Usuario = :user OR us.EmailUsuario = :user";
        $query = $this->pdo->prepare($sql);
        $query->execute(['user' => $user]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function isAdmin($usuario = null)
    {
        if (!$usuario) {
            $this->verificarSesion();
            $usuario = $this->obtenerDatosUsuario($_SESSION['sesion_user']);
        }
        return $usuario['RolUsuario'] === 'Administrador';
    }

    private function obtenerPermisosUsuario($id_usuario)
    {
        $sql = "SELECT p.NombrePermiso 
                FROM permisos_usuario pu
                INNER JOIN permiso p ON pu.IdPermiso = p.IdPermiso
                WHERE pu.IdUsuario = :IdUsuario";
        $query = $this->pdo->prepare($sql);
        $query->execute([':IdUsuario' => $id_usuario]);
        return $query->fetchAll(PDO::FETCH_COLUMN);
    }

    public function verificarPermiso($nombre_permiso)
    {
        $usuario = $this->verificarUsuarioActivo();
        $permisos_usuario = $this->obtenerPermisosUsuario($usuario['IdUsuario']);

        if (in_array($nombre_permiso, $permisos_usuario) || $this->isAdmin($usuario)) {
            return $usuario;
        }

        $this->redirigirConMensaje('Error/error.php', 'No tienes los permisos necesarios para acceder a esta página.', 'error');
    }

    public function verificarPermisos($nombres_permisos)
    {
        $usuario = $this->verificarUsuarioActivo();

        if ($this->isAdmin($usuario)) {
            return $usuario;
        }

        $permisos_usuario = $this->obtenerPermisosUsuario($usuario['IdUsuario']);

        foreach ($nombres_permisos as $permiso) {
            if (!in_array($permiso, $permisos_usuario)) {
                $this->redirigirConMensaje('Error/error.php', 'No tienes permisos para acceder a esta página.', 'error');
            }
        }

        return $usuario;
    }

    private function verificarUsuarioActivo()
    {
        $this->verificarSesion();
        $usuario = $this->obtenerDatosUsuario($_SESSION['sesion_user']);

        if ($usuario['EstadoUsuario'] != 1) {
            $this->redirigirConMensaje('login.php', 'Tu cuenta está desactivada. Contacta al administrador.', 'error');
        }

        return $usuario;
    }

    public function verificarPermisoYAdmin($nombre_permiso)
    {
        $usuario = $this->verificarUsuarioActivo();

        if (!$this->isAdmin($usuario)) {
            $this->redirigirConMensaje('Error/error.php', 'Se requieren permisos de administrador.', 'error');
        }

        $permisos_usuario = $this->obtenerPermisosUsuario($usuario['IdUsuario']);
        if (!in_array($nombre_permiso, $permisos_usuario)) {
            $this->redirigirConMensaje('Error/error.php', 'No tienes los permisos necesarios para acceder a esta página.', 'error');
        }

        return $usuario;
    }

    public function tienePermiso($nombre_permiso)
    {
        $this->verificarSesion();
        $usuario = $this->obtenerDatosUsuario($_SESSION['sesion_user']);
        $permisos_usuario = $this->obtenerPermisosUsuario($usuario['IdUsuario']);

        return in_array($nombre_permiso, $permisos_usuario) || $this->isAdmin($usuario);
    }

    public function actualizarPermisosUsuario($id_usuario, $permisos)
    {
        $this->pdo->beginTransaction();

        try {
            // Eliminar permisos existentes del usuario
            $sql = "DELETE FROM permisos_usuario WHERE IdUsuario = :IdUsuario";
            $query = $this->pdo->prepare($sql);
            $query->execute([':IdUsuario' => $id_usuario]);

            // Insertar nuevos permisos
            $sql = "INSERT INTO permisos_usuario (IdUsuario, IdPermiso) VALUES (:IdUsuario, :IdPermiso)";
            $query = $this->pdo->prepare($sql);
            foreach ($permisos as $id_permiso) {
                $query->execute([':IdUsuario' => $id_usuario, ':IdPermiso' => $id_permiso]);
            }

            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    private function redirigirConMensaje($pagina, $mensaje, $icono)
    {
        $_SESSION['mensaje'] = $mensaje;
        $_SESSION['icono'] = $icono;
        header('Location:' . $this->URL . '/Views/' . $pagina);
        exit();
    }

    public function __destruct()
    {
        ob_end_flush();
    }
}
