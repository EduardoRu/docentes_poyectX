<!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
    <i class="fas fa-plus"></i> Crear usuario
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar usuario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for=""> Nombre de la carrera </label>
                        <input type="text" class="form-control" id="nomUsuario" name="nomUsuario" placeholder="Escribir el nombre del usuario" required>
                    </div>
                    <div class="form-group">
                        <label for="">Apellido paterno</label>
                        <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" placeholder="Escribir el apellido paterno" required>
                    </div>
                    <div class="form-group">
                        <label for="">Apellido materno</label>
                        <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" placeholder="Escribir el apellido paterno" required>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" id="email_usuario" name="email_usuario" placeholder="Escribir el email del usuario" required>
                    </div>
                    <div class="form-group">
                        <label for="">Contraseña</label>
                        <input type="text" class="form-control" id="pass_usuario" name="pass_usuario" placeholder="Contraseña del usuario" required>
                    </div>
                    <div class="form-group">
                        <label for="">Rol del usuario</label>
                        <select name="rolUsuario" id="rolUsuario" class="form-select" required>
                            <option value=""></option>
                            <option value="admin">Admin/Adminstrador</option>
                            <option value="docente">Docente/Docente</option>
                            <option value="asistente">Asistente/Asistente</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <input type="submit" class="btn btn-primary" value="Agregar usuario" id="crear_usuario" name="crear_usuario">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>