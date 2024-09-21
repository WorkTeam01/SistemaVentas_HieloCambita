<?php

// Obtener el rol del usuario actual
$usuario = $_SESSION['sesion_user']; // Asume que tienes el nombre de usuario en la sesión
$stmt = $pdo->prepare("SELECT r.RolUsuario FROM usuario u INNER JOIN rol_usuario r ON u.IdRolUsuario = r.IdRolUsuario WHERE u.Usuario = ?");
$stmt->execute([$usuario]);
$rol_usuario = $stmt->fetchColumn();

// Obtener todos los roles
$stmt = $pdo->query("SELECT IdRolUsuario, RolUsuario FROM rol_usuario");
$roles_datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener todos los permisos
$stmt = $pdo->query("SELECT IdPermiso, NombrePermiso FROM permiso");
$permisos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener permisos asignados al usuario o al rol
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rolId = isset($_POST['rolId']) ? $_POST['rolId'] : null;
    $usuarioId = isset($_POST['usuarioId']) ? $_POST['usuarioId'] : null;
    $permisosAsignados = [];

    if ($usuarioId) {
        // Obtener permisos asignados directamente al usuario
        $stmt = $pdo->prepare("
            SELECT p.IdPermiso 
            FROM permisos_usuario pu
            JOIN permiso p ON pu.IdPermiso = p.IdPermiso
            WHERE pu.IdUsuario = ?
        ");
        $stmt->execute([$usuarioId]);
        $permisosAsignados = $stmt->fetchAll(PDO::FETCH_COLUMN);
    } elseif ($rolId) {
        // Obtener los usuarios asociados al rol
        $stmt = $pdo->prepare("SELECT IdUsuario FROM usuario WHERE IdRolUsuario = ?");
        $stmt->execute([$rolId]);
        $usuariosDelRol = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // Obtener permisos asociados a cualquier usuario de ese rol
        if (!empty($usuariosDelRol)) {
            $placeholders = implode(',', array_fill(0, count($usuariosDelRol), '?'));
            $stmt = $pdo->prepare("
                SELECT DISTINCT p.IdPermiso 
                FROM permisos_usuario pu
                JOIN permiso p ON pu.IdPermiso = p.IdPermiso
                WHERE pu.IdUsuario IN ($placeholders)
            ");
            $stmt->execute($usuariosDelRol);
            $permisosAsignados = $stmt->fetchAll(PDO::FETCH_COLUMN);
        }
    } else {
        echo json_encode(['error' => 'Se requiere un ID de rol o de usuario']);
        exit;
    }

    echo json_encode([
        'permisos' => $permisos,                // Todos los permisos disponibles
        'permisosAsignados' => $permisosAsignados  // Permisos que tiene el usuario o el rol
    ]);
    exit;
}
