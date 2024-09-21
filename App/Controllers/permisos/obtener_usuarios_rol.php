<?php
require_once '../../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rolId = isset($_POST['rolId']) ? $_POST['rolId'] : null;

    if ($rolId) {
        $stmt = $pdo->prepare("SELECT IdUsuario, Usuario as NombreUsuario FROM usuario WHERE IdRolUsuario = ?");
        $stmt->execute([$rolId]);
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode(['usuarios' => $usuarios]);
    } else {
        echo json_encode(['error' => 'Se requiere un ID de rol']);
    }
    exit;
}
