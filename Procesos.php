<?php
    print_r($_POST);
    if(!isset($_POST['codigo'])){
        header('Location: index.php?mensaje=error');
    }

    include 'Model/ConexionBD.php';
    $codigo = $_POST['codigo'];
    $nombres = $_POST['txtNombres'];
    $celular = $_POST['txtcelular'];
    $apellidos = $_POST['txtApellidos'];
    $fecha_ingreso = $_POST['txtFechaIngreso'];
    $hora_llegada = $_POST['txthora_llegada'];
    $hora_salida = $_POST['txthora_salida'];

    $sentenciaBD = $bd->prepare("UPDATE pacientesN SET nombres = ?, apellidos = ?, celular = ?, fecha_ingreso = ?,hora_llegada = ?,hora_salida = ? where codigo = ?;");
    $resultado = $sentenciaBD->execute([$nombres,$apellidos,$celular, $fecha_ingreso, $hora_llegada, $hora_salida,$codigo]);

    if ($resultado === TRUE) {
        header('Location: index.php?mensaje=se edito correctamente');
    } else {
        header('Location: index.php?mensaje=hubo un error');
        exit();
    }
?>


