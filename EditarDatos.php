<?php include 'Template/header2.php' ?>

<?php
    if(!isset($_GET['codigo'])){
        header('Location: index.php?mensaje=error');
        exit();
    }

    include_once 'Model/ConexionBD.php';
    $codigo = $_GET['codigo'];

    $sentenciaBD = $bd->prepare("select * from pacientesN where codigo = ?;");
    $sentenciaBD->execute([$codigo]);
    $pacientes = $sentenciaBD->fetch(PDO::FETCH_OBJ);
?>

<div class="container mt-5">
<style> body{
  background-image: url('Imagenes/pasillo-hospital-1895367.webp');
  background-repeat: no-repeat;
  background-size: cover;
 } 
 </style>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Editar datos de paciente:
                </div>
                <form class="p-4" method="POST" action="Procesos.php">
                    <div class="mb-3">
                        <label class="form-label">Nombres: </label>
                        <input type="text" class="form-control" name="txtNombres" required 
                         value="<?php echo $pacientes->nombres; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Apellidos: </label>
                        <input type="text" class="form-control" name="txtApellidos" autofocus required
                         value="<?php echo $pacientes->apellidos; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Celular: </label>
                        <input type="text" class="form-control" name="txtcelular" autofocus required
                         value="<?php echo $pacientes->celular; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha de Ingreso: </label>
                        <input type="date" class="form-control" name="txtFechaIngreso" autofocus required
                         value="<?php echo $pacientes->fecha_ingreso; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Hora de llegada: </label>
                        <input type="time" class="form-control" name="txthora_llegada" autofocus required
                         value="<?php echo $pacientes->hora_llegada; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Hora de Salida: </label>
                        <input type="time" class="form-control" name="txthora_salida" autofocus required
                         value="<?php echo $pacientes->hora_salida; ?>">
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="codigo" value="<?php echo $pacientes->codigo; ?>">
                        <input type="submit" class="btn btn-primary" value="Editar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>