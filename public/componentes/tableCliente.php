<?php
  require '../../config/conexion.php';
  $sql = $con->query("SELECT * FROM cliente");
 ?>
<div class="table-responsive">
  <table class="table table-hover table-sm" id="tablecli">
    <thead class="font-primary">
      <tr>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>N° DOC</th>
        <th>DIRECCIÓN</th>
        <th>TELÉFONO</th>
        <th>E-MAIL</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      <?php
        while($mostrarcli = $sql->fetch_row()){
      ?>
      <tr>
        <td><?php echo $mostrarcli[0] ?></td>
        <td><?php echo $mostrarcli[1]." ".$mostrarcli[2] ?></td>
        <td><?php echo $mostrarcli[4] ?></td>
        <td><?php echo $mostrarcli[5] ?></td>
        <td><?php echo $mostrarcli[6] ?></td>
        <td><?php echo $mostrarcli[7] ?></td>
        <td>
          <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-inverse-success btn-sm" title="Editar" data-toggle="modal" data-target="#modalClienteEdit" onclick="readCliente('<?php echo $mostrarcli[0] ?>')"><i class="fas fa-edit"></i></button>
            <button type="button" class="btn-sm btn btn-inverse-danger" title="Eliminar" onclick="deleteCliente('<?php echo $mostrarcli[0] ?>')"><i class="fas fa-trash-alt"></i></button>
          </div>
        </td>
      </tr>
      <?php
         }
      ?>
    </tbody>
  </table>
</div>
 <script>
      $(document).ready(function() {
        $('#tablecli').DataTable({
          "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "Nada encontrado, lo siento!",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "search": "Buscar",
            "paginate": {
              "first":      "Primero",
              "previous":   "Anterior",
              "next":       "Siguiente",
              "last":       "Último"
            }
          }
        });
      });
</script>
