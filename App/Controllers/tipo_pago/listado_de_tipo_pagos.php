<?php

$sql_tipo_pagos = "SELECT * FROM tipo_pago";
$query_tipo_pagos = $pdo->query($sql_tipo_pagos);
$query_tipo_pagos->execute();
$total_tipo_pagos = $query_tipo_pagos->rowCount();
$tipo_pagos_datos = $query_tipo_pagos->fetchAll(PDO::FETCH_ASSOC);
