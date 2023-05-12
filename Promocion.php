<?php include 'Template/header3.php' ?>


<?php
    include_once 'Model/ConexionBD.php';
    $codigo = $_GET['codigo'];

    $sentenciaBD = $bd->prepare("select * from pacientesN where codigo = ?;");
    $sentenciaBD->execute([$codigo]);
    $pacientes = $sentenciaBD->fetch(PDO::FETCH_OBJ);

    $senten_promo = $bd->prepare("select * from promociones where codigoP = ?;");
    $senten_promo->execute([$codigo]);
    $promocion = $senten_promo->fetchAll(PDO::FETCH_OBJ);
?>

<div class="container mt-5">
<style> body{
  background-image: url('Imagenes/pasillo-hospital-1895367.webp');
  background-repeat: no-repeat;
  background-size: cover;
 } 
 </style>
    <div class="row">
     <div class="col-3">
        <div class="card">
            <div class="card-body">
                <br><?php echo 'Nombre de paciente: '.$pacientes->nombres.' '.$pacientes->apellidos; ?>
                <br>
                <br>Ingresar datos para promocion:
            </div>
            <form class="p-4" method="POST" action="RegistrarPromo.php">
                <div class="mb-3">
                    <label class="form-label">Promocion: </label>
                    <input type="text" class="form-control" name="txtPromocion" autofocus required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Duracion que tendra esta promocion: </label>
                    <input type="text" class="form-control" name="txtduracionpr" autofocus required>
                </div>
                <div class="d-grid">
                <input type="hidden" name="codigo" value="<?php echo $pacientes->codigo; ?>"><P></P>
                     <input type="submit" class="btn btn-primary" value="Registrar promocion">
                </div>
            </form>
        </div>
    </div>
        <div class="col-sm-8">
          <div class="card">
            <div class="card-header">
                Lista de Promociones
            </div>
            <div class="col-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">
                            <th scope="col">Promociones</th>
                            <th scope="col">Duracion</th>
                            <th scope="col">Eliminar</th>
                            <th scope="col" colspan="4">Enviar Mensaje</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($promocion as $dato) {
                        ?>
                          <tr>
                            <td scope="row"><?php echo $dato->id; ?></td>
                            <td><?php echo $dato->promocion_paciente; ?></td>
                            <td><?php echo $dato->duracion_promo; ?></td>     
                            <td><a onclick="return confirm('Estas seguro de eliminar esta promo?');" class="text-danger" href="EliminarPromo.php?codigo=<?php 
                             echo $dato->codigoP; ?>"><i class="bi bi-trash"></i></a></td>
                            <td><a onclick="return confirm('Desea enviar el mensaje?');" class="text-success" href="enviarMensajewhats.php?codigo=<?php 
                             echo $dato->codigoP; ?>"><i class="bi bi-whatsapp"></i></i></a></td>
                            <td><a onclick="return confirm('Desea enviar el mensaje?');" class="text-primary" href="enviarVideowhats.php?codigo=<?php 
                             echo $dato->codigoP; ?>"><i class="bi bi-whatsapp"></i></i></a></td>
                        </tr>
                          
                        <?php 
                            }
                        ?>
                    </tbody>
               </div>
         </div>
    </div>
</div>
    