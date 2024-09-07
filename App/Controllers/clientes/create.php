<?php

include_once '../../config.php';

$celular_cliente = $_POST['celular'];
$descuento_cliente = $_POST['descuento'];
$tipo_cliente = $_POST['tipo_cliente'];  // Capturar el tipo de cliente del formulario

if ($tipo_cliente === 'natural') {
    $nombre_cliente = $_POST['nombre'];
    $genero_cliente = $_POST['genero'];
} elseif ($tipo_cliente === 'juridico') {
    $razon_social = $_POST['razon_social'];
    $representante_legal = $_POST['representante_legal'];
    $email_juridico = $_POST['email_juridico'];
}

try {
    // Iniciar transacción
    $pdo->beginTransaction();

    // Insertar datos básicos en la tabla "cliente"
    $sql_cliente = "INSERT INTO cliente (CelularCliente, DescuentoCliente) 
                    VALUES (:CelularCliente, :DescuentoCliente)";
    $sentencia_cliente = $pdo->prepare($sql_cliente);
    $sentencia_cliente->bindParam(':CelularCliente', $celular_cliente);
    $sentencia_cliente->bindParam(':DescuentoCliente', $descuento_cliente);
    $sentencia_cliente->execute();

    $id_cliente = $pdo->lastInsertId();

    // Insertar datos específicos según el tipo de cliente
    if ($tipo_cliente === 'natural') {
        $sql_natural = "INSERT INTO cnatural (IdCliente, NombreCliente, Genero) 
                        VALUES (:IdCliente, :NombreCliente, :Genero)";
        $sentencia_natural = $pdo->prepare($sql_natural);
        $sentencia_natural->bindParam(':IdCliente', $id_cliente);  // Agregar ":"
        $sentencia_natural->bindParam(':NombreCliente', $nombre_cliente);
        $sentencia_natural->bindParam(':Genero', $genero_cliente);
        $sentencia_natural->execute();
    } elseif ($tipo_cliente === 'juridico') {
        $sql_juridico = "INSERT INTO cjuridico (IdCliente, RazonSocial, RepresentanteLegal, EmailJuridico) 
                         VALUES (:IdCliente, :RazonSocial, :RepresentanteLegal, :EmailJuridico)";
        $sentencia_juridico = $pdo->prepare($sql_juridico);
        $sentencia_juridico->bindParam(':IdCliente', $id_cliente);  // Agregar ":"
        $sentencia_juridico->bindParam(':RazonSocial', $razon_social);
        $sentencia_juridico->bindParam(':RepresentanteLegal', $representante_legal);
        $sentencia_juridico->bindParam(':EmailJuridico', $email_juridico);
        $sentencia_juridico->execute();
    }

    // Confirmar la transacción
    $pdo->commit();

    session_start();
    $_SESSION['mensaje'] = 'El cliente se registró exitosamente';
    $_SESSION['icono'] = 'success';
    header('Location: ' . $URL . '/Views/Clientes');
} catch (PDOException $e) {
    // Revertir la transacción en caso de error
    $pdo->rollBack();
    error_log("Error en la creación del cliente: " . $e->getMessage());
    session_start();
    $_SESSION['mensaje'] = 'Error al crear el cliente. Por favor, inténtelo de nuevo más tarde.';
    $_SESSION['icono'] = 'error';
    header('Location: ' . $URL . '/Views/Clientes/create.php');
}
