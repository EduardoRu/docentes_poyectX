<!-- Button trigger modal -->
<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal_<?= escapar($fila['id']) ?>">
    <i class="fas fa-edit"></i> Editar
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal_<?= escapar($fila['id']) ?>" tabindex="-1" aria-labelledby="exampleModalLabel_<?php echo escapar($fila['id']) ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel_<?php echo escapar($fila['id']) ?>">Editar datos de la carrera</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for=""> Nombre de la carrera </label>
                        <input type="text" class="form-control" id="nomCarrera_<?php echo escapar($fila['id']) ?>" name="nomCarrera_<?php echo escapar($fila['id']) ?>" placeholder="Escribir el nombre de la carrera" value="<?= escapar($fila['nombre_carrera']) ?>" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <input type="submit" class="btn btn-primary" value="Guardar cambios" id="editCarrera_<?php echo escapar($fila['id']) ?>" name="editCarrera_<?php echo escapar($fila['id']) ?>">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>