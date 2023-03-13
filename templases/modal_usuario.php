<!-- Button trigger modal -->
<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal_<?php echo escapar($fila['id']) ?>">
    <i class="fas fa-edit"></i> Editar
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal_<?php echo escapar($fila['id']) ?>" tabindex="-1" aria-labelledby="exampleModalLabel_<?php echo escapar($fila['id']) ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel_<?php echo escapar($fila['id']) ?>">Agregar usuario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for=""> Nombre de la carrera </label>
                        <input type="text" value="<?= escapar($fila['nombre']) ?>" class="form-control" id="nomUsuario_<?php echo escapar($fila['id']) ?>" name="nomUsuario_<?php echo escapar($fila['id']) ?>" placeholder="Escribir el nombre del usuario" required>
                    </div>
                    <div class="form-group">
                        <label for="">Apellido paterno</label>
                        <input type="text" value="<?= escapar($fila['apellido_paterno']) ?>" class="form-control" id="apellido_paterno_<?php echo escapar($fila['id']) ?>" name="apellido_paterno_<?php echo escapar($fila['id']) ?>" placeholder="Escribir el apellido paterno" required>
                    </div>
                    <div class="form-group">
                        <label for="">Apellido materno</label>
                        <input type="text" value="<?= escapar($fila['apellido_materno']) ?>" class="form-control" id="apellido_materno_<?php echo escapar($fila['id']) ?>" name="apellido_materno_<?php echo escapar($fila['id']) ?>" placeholder="Escribir el apellido paterno" required>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" value="<?= escapar($fila['email']) ?>" class="form-control" id="email_usuario_<?php echo escapar($fila['id']) ?>" name="email_usuario_<?php echo escapar($fila['id']) ?>" placeholder="Escribir el email del usuario" required>
                    </div>
                    <div class="form-group">
                        <label for="">Cambiar contraseña</label>
                        <input type="text" class="form-control" id="pass_usuario_<?php echo escapar($fila['id']) ?>" name="pass_usuario_<?php echo escapar($fila['id']) ?>" placeholder="Contraseña del usuario">
                    </div>
                    <div class="form-group">
                        <label for="">Rol del usuario</label>
                        <select name="rolUsuario_<?php echo escapar($fila['id']) ?>" id="rolUsuario_<?php echo escapar($fila['id']) ?>" class="form-select" required>
                            <option value="<?= escapar($fila['rol']) ?>"> <?php echo escapar($fila['rol']) ?></option>
                            <option value="admin">Admin/Adminstrador</option>
                            <option value="docente">Docente/Docente</option>
                            <option value="asistente">Asistente/Asistente</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <input type="submit" class="btn btn-primary" value="Agregar usuario" id="editar_usuario_<?php echo escapar($fila['id']) ?>" name="editar_usuario_<?php echo escapar($fila['id']) ?>">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>