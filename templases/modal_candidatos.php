<?php 
try{
  $consultaSQLCarreras = "SELECT * FROM carrera";
  $sentenciaCarreras = $conexion->prepare($consultaSQLCarreras);
  $sentenciaCarreras->execute();

  $carreras = $sentenciaCarreras->fetchAll();

}catch(PDOException $error){
  $error = $error->getMessage();
}

?>

<!-- Button trigger modal -->
<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal_<?= escapar($fila['id']) ?>">
  <i class="fas fa-edit"></i> Editar
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal_<?= escapar($fila['id']) ?>" tabindex="-1" aria-labelledby="exampleModalLabel_<?php echo escapar($fila['id']) ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel_<?php echo escapar($fila['id']) ?>">Editar datos</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <div class="form-group">
            <label for="">Nombre del candidato</label>
            <input type="text" class="form-control" id="nomCandidato_<?php echo escapar($fila['id']) ?>" name="nomCandidato_<?php echo escapar($fila['id']) ?>" placeholder="Escricibir el nombre del candidato" value="<?= escapar($fila['nombre']) ?>" required>
          </div>
          <label for="">Apellido paterno y materno</label>
          <div class="input-group">
            <input type="text" class="form-control" id="apP_<?php echo escapar($fila['id']) ?>" name="apP_<?php echo escapar($fila['id']) ?>" placeholder="Apellido paterno" value="<?= escapar($fila['apellido_paterno']) ?>" required>
            <input type="text" class="form-control" id="apM_<?php echo escapar($fila['id']) ?>" name="apM_<?php echo escapar($fila['id']) ?>" placeholder="Apellido materno" value="<?= escapar($fila['apellido_materno']) ?>" required>
          </div>
          <div class="form-group">
            <label for="">Correo electronico</label>
            <input type="email" class="form-control" id="emailCandidato_<?php echo escapar($fila['id']) ?>" name="emailCandidato_<?php echo escapar($fila['id']) ?>" placeholder="Email del candidato" value="<?= escapar($fila['correo_electronico']) ?>" required>
          </div>
          <div class="form-group">
            <label for="">Domicilio</label>
            <input type="text" class="form-control" id="domCandidato_<?php echo escapar($fila['id']) ?>" name="domCandidato_<?php echo escapar($fila['id']) ?>" placeholder="Domicilio del candidato" value="<?= escapar($fila['domicilio']) ?>" required>
          </div>
          <div class="form-group">
            <label for="">Telefono</label>
            <input type="number" class="form-control" id="telCandidato_<?php echo escapar($fila['id']) ?>" name="telCandidato_<?php echo escapar($fila['id']) ?>" placeholder="Telefono del candidato" value="<?= escapar($fila['telefono']) ?>" required>
          </div>
          <div class="form-group">
            <label for="">Municipio</label>
            <input type="text" class="form-control" id="munCandidato_<?php echo escapar($fila['id']) ?>" name="munCandidato_<?php echo escapar($fila['id']) ?>" placeholder="Municipio del candidato" value="<?= escapar($fila['municipio']) ?>" required>
          </div>
          <div class="form-group">
            <label for="">Escolaridad</label>
            <input type="text" class="form-control" id="escCandidato_<?php echo escapar($fila['id']) ?>" name="escCandidato_<?php echo escapar($fila['id']) ?>" placeholder="Escolaridad del candidato" value="<?= escapar($fila['escolaridad']) ?>">
          </div>
          <div class="form-group">
            <label for=""> Carrera de interes </label>
            <select name="carreraCandidato_<?php echo escapar($fila['id']) ?>" id="carreraCandidato_<?php echo escapar($fila['id']) ?>" class="form-select">
              <option value="<?= escapar($fila['id_CCarrera']) ?>"> <?php echo escapar($fila['nombre_carrera']) ?></option>
              <?php 
              foreach($carreras as $car){
                ?>
                <option value="<?= escapar($car['id']) ?>"><?php echo escapar($car['nombre_carrera']) ?></option>
                <?php
              }
              ?>
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <input type="submit" class="btn btn-primary" value="Guardar cambios" id="editCandidato_<?php echo escapar($fila['id']) ?>" name="editCandidato_<?php echo escapar($fila['id']) ?>">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>