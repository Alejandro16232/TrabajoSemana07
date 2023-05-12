<?php
if (!isset($_GET['codigo'])) {
    header('Location: index.php?mensaje=error');
    exit();
}

include 'Model/ConexionBD.php';
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("SELECT pro.promocion_paciente, pro.duracion_promo ,pro.codigoP, per.nombres, per.apellidos , per.celular,
per.fecha_ingreso, per.hora_llegada, per.hora_salida FROM promociones pro
INNER JOIN pacientesN per ON per.codigo = pro.codigoP
WHERE pro.codigoP = ?;");
$sentencia->execute([$codigo]);
$persona = $sentencia->fetch(PDO::FETCH_OBJ);

    $url = 'https://api.green-api.com/waInstance1101818633/SendMessage/ea4d0df926574242b6be7c14df7ca278b8e0d58452c54e27b9';
    $data = [
        "chatId" => "51".$persona->celular."@c.us",
        "message" =>  'Estimado(a) *'.strtoupper($persona->nombres).' '.strtoupper($persona->apellidos).'* se le envio este mensaje para avisarle que su promocion *'.strtoupper($persona->promocion_paciente).'* esta activa, y tendra una duracion de *'.strtoupper($persona->duracion_promo).'*.'
    ];
    $options = array(
        'http' => array(
            'method'  => 'POST',
            'content' => json_encode($data),
            'header' =>  "Content-Type: application/json\r\n" .
                "Accept: application/json\r\n"
        )
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
   // header('Location: agregarPromocion.php?codigo='.$persona->id_persona);
?>

