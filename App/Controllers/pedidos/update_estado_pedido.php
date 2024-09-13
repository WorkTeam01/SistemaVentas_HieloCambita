<?php
require_once '../../config.php';

header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idPedido = $_POST['idPedido'] ?? null;
        $nuevoEstado = $_POST['nuevoEstado'] ?? null;

        if ($idPedido !== null && $nuevoEstado !== null) {
            // Primero, verificar el estado actual del pedido
            $sqlVerificar = "SELECT EstadoPedido FROM pedido WHERE IdPedido = :IdPedido";
            $stmtVerificar = $pdo->prepare($sqlVerificar);
            $stmtVerificar->bindParam(":IdPedido", $idPedido, PDO::PARAM_INT);
            $stmtVerificar->execute();
            $estadoActual = $stmtVerificar->fetchColumn();

            if ($estadoActual === false) {
                throw new Exception('Pedido no encontrado');
            }

            if ($estadoActual == 1) {
                throw new Exception('Este pedido ya está cancelado y no se puede modificar');
            }

            if ($nuevoEstado != 1) {
                throw new Exception('Solo se permite cambiar el estado a cancelado');
            }

            // Si llegamos aquí, podemos proceder con la actualización
            $sql = "UPDATE pedido SET EstadoPedido = :EstadoPedido WHERE IdPedido = :IdPedido";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":EstadoPedido", $nuevoEstado, PDO::PARAM_INT);
            $stmt->bindParam(":IdPedido", $idPedido, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                throw new Exception('Error al ejecutar la consulta: ' . implode(', ', $stmt->errorInfo()));
            }
        } else {
            throw new Exception('Datos incompletos');
        }
    } else {
        throw new Exception('Método no permitido');
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
