<?php
require_once '../../config.php';
require_once '../middleware/AuthMiddleware.php';

$auth = new AuthMiddleware($pdo, $URL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = $_POST['usuario'] ?? null;
    $id_rol = $_POST['rol'] ?? null;
    $permisos = $_POST['permisos'] ?? [];

    if ($id_usuario) {
        // Actualizar permisos específicos del usuario
        $auth->actualizarPermisosUsuario($id_usuario, $permisos);
        echo json_encode(['success' => true, 'message' => 'Permisos de usuario actualizados correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Debe seleccionar un usuario o un rol']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
