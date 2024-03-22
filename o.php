<?php
    session_start(); 
?>

<div class="row">
    <div class="col-md-3 p-3 m-1 bg-info">
        <h4>Registro de Comentarios</h4>
        <form method="POST" action="controllers/comentario.controller.php">
            <div class="mb-3">
                <input type="text" name="accion" value="registrarComentario" hidden>
                <!-- Agregar campos ocultos para idvisita e idnegocio -->
                <input type="text" name="idvisita" value="<?php echo $_SESSION['idvisitax']; ?>" hidden>
                <input type="text" name="idnegocio" value="<?php echo $_SESSION['musica']; ?>" hidden>
                <div class="mb-3">
                    <label for="tarea-comentario">Comentario</label>
                    <textarea class="form-control" placeholder="Escribe tu comentario aquí..." id="tarea-comentario" name="comentario" required></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Comentario</button>
        </form>
    </div>


</div>
