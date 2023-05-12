<?php

if (empty($_POST["oculto"]) || empty($_POST["txtnombres"]) || empty($_POST["txtapellidos"]) || empty($_POST["txtfecha_ingreso"]) || empty($_POST["txthora_llegada" ]) || empty($_POST["txthora_salida" ])) {
    header('Location: index.php?mensaje=no completado');
    exit();
}


include_once 'Model/ConexionBD.php';
$nombres = $_POST["txtnombres"];
$apellidos = $_POST["txtapellidos"];
$celular= $_POST["txtcelular"];
$fecha_ingreso = $_POST["txtfecha_ingreso"];
$hora_llegada = $_POST["txthora_llegada"];
$hora_salida = $_POST["txthora_salida"];


$sentenciaBD = $bd->prepare("INSERT INTO pacientesN(nombres,apellidos,celular,fecha_ingreso,hora_llegada,hora_salida) VALUES (?,?,?,?,?,?);");
$resultado = $sentenciaBD->execute([$nombres,$apellidos,$celular,$fecha_ingreso,$hora_llegada,$hora_salida]);

if ($resultado === TRUE) {
    header('Location: index.php?mensaje=registrado');
} else {
    header('Location: index.php?mensaje=error');
    exit();
}
?>
