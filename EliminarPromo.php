<?php 
    if(!isset($_GET['codigo'])){
        header('Location: index.php?mensaje=error');
        exit();
    }

    include 'Model/ConexionBD.php';
    $codigo = $_GET['codigo'];
    
    $sentenciaBD = $bd->prepare("DELETE FROM promociones where codigoP = ?;");
    $resultado = $sentenciaBD->execute([$codigo]);

    if ($resultado === TRUE){
        header('Location: index.php?mensaje=Datos de paciente eliminado correctamente');
    } else {
        header('Location: index.php?mensaje=Surgio un error');
    }
?>