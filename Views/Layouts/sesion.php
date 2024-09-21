<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$Año = date('Y');

if (isset($_SESSION['sesion_user'])) {
    $user_session = $_SESSION['sesion_user'];

    // Preparar la consulta con un marcador de posición
    $sql = "SELECT us.IdUsuario, us.Usuario, us.NombresUsuario, us.ApellidosUsuario, 
                   p.IdPuesto, p.NombrePuesto, tip.RolUsuario, us.EstadoUsuario
            FROM usuario us
            INNER JOIN rol_usuario tip ON us.IdRolUsuario = tip.IdRolUsuario
            INNER JOIN puesto p ON us.IdPuesto = p.IdPuesto
            WHERE Usuario = :user OR EmailUsuario = :user";

    $query = $pdo->prepare($sql);
    $query->execute(['user' => $user_session]);

    $usuario = $query->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        // Verificar si el usuario está activo
        if ($usuario['EstadoUsuario'] != 1) {
            // Usuario inactivo, destruir sesión y redirigir al login
            session_destroy();
            header('Location:' . $URL . '/Views/login.php?error=inactive');
            exit();
        }

        // Almacenar todos los datos relevantes en la sesión
        $_SESSION['id_usuario'] = $usuario['IdUsuario'];
        $_SESSION['usuario'] = $usuario['Usuario'];
        $_SESSION['nombres'] = $usuario['NombresUsuario'];
        $_SESSION['apellidos'] = $usuario['ApellidosUsuario'];
        $_SESSION['puesto'] = $usuario['NombrePuesto'];
        $_SESSION['id_puesto'] = $usuario['IdPuesto'];
        $_SESSION['rol'] = $usuario['RolUsuario'];

        // Obtener permisos del usuario
        $sql_permisos = "SELECT p.NombrePermiso 
                         FROM permiso p 
                         INNER JOIN permisos_usuario pu ON p.IdPermiso = pu.IdPermiso
                         WHERE pu.IdUsuario = :IdUsuario";
        $query_permisos = $pdo->prepare($sql_permisos);
        $query_permisos->execute(['IdUsuario' => $_SESSION['id_usuario']]);
        $_SESSION['permisos'] = $query_permisos->fetchAll(PDO::FETCH_COLUMN);

        $id_usuario_sesion = $_SESSION['id_usuario'];
        $usuario_sesion = $_SESSION['usuario'];
        $rol_sesion = $_SESSION['rol'];
        $nombres_sesion = $_SESSION['nombres'];
        $apellidos_sesion = $_SESSION['apellidos'];
        $id_puesto_sesion = $_SESSION['id_puesto'];
        $puesto_sesion = $_SESSION['puesto'];
    } else {
        // Usuario no encontrado, redirigir al login
        header('Location:' . $URL . '/Views/login.php?error=notfound');
        exit();
    }
} else {
    // Sesión no iniciada, redirigir al login
    header('Location:' . $URL . '/Views/login.php');
    exit();
}

// Función para verificar permisos
function tienePermiso($permiso)
{
    // Si el usuario es administrador, tiene todos los permisos
    if ($_SESSION['rol'] === 'Administrador') {
        return true;
    }
    // Si no es administrador, verificar si tiene el permiso específico
    return in_array($permiso, $_SESSION['permisos']);
}

// Función para verificar si el usuario es administrador
function esAdmin()
{
    return $_SESSION['rol'] === 'Administrador';
}
