<?php

$id_tipo_pago_get = $_GET['id'];

$sql_tipo_pagos = "SELECT * FROM tipo_pago WHERE IdTipoPago = '$id_tipo_pago_get'";
$query_tipo_pagos = $pdo->query($sql_tipo_pagos);
$query_tipo_pagos->execute();
$total_tipo_pagos = $query_tipo_pagos->rowCount();
$tipo_pagos_datos = $query_tipo_pagos->fetchAll(PDO::FETCH_ASSOC);

foreach ($tipo_pagos_datos as $tipo_pagos_dato) {
    $id_tipo_pago = $tipo_pagos_dato['IdTipoPago'];
    $tipo_pago = $tipo_pagos_dato['TipoPago'];
}
