<!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
    <i class="fas fa-plus"></i> Crear carrera
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar datos de la carrera</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for=""> Nombre de la carrera </label>
                        <input type="text" class="form-control" id="nomCarrera" name="nomCarrera" placeholder="Escribir el nombre de la carrera" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <input type="submit" class="btn btn-primary" value="Agregar carrera" id="crearCarrera" name="crearCarrera">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>