<?php
if(empty($_POST["txtPromocion"]) || empty($_POST["txtduracionpr"])) {
    header('Location: index.php');
    exit();
}

include_once 'Model/ConexionBD.php';
$promocion = $_POST["txtPromocion"];
$duracion = $_POST["txtduracionpr"];
$codigo = $_POST["codigo"];

$sentencia = $bd->prepare("Insert into promociones(promocion_paciente,duracion_promo,codigoP) values (?,?,?);");
$resultado = $sentencia->execute([$promocion,$duracion,$codigo]);

if ($resultado === TRUE){
    header("Location: Promocion.php?codigo=".$codigo);
}
?>


