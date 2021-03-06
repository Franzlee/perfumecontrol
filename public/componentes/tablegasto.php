<?php
  require '../../config/conexion.php';
  $sql = $con->query("SELECT * FROM gasto ");
 ?>
<div class="table-responsive">
  <table class="table table-sm table-hover" id="tableGasto">
    <thead>
      <tr>
        <th>ID</th>
        <th>Fecha</th>
        <th>Tipo</th>
        <th>Precio</th>
        <th>Opciones</th>
      </tr>
    </thead>

    <tbody>
      <?php while($vergasto = $sql->fetch_row()){ ?>
        <tr>
          <td><?php echo $vergasto[0] ?></td>
          <td><?php echo $vergasto[2] ?></td>
          <td><?php echo $vergasto[3] ?></td>
          <td><?php echo $vergasto[1] ?></td>
          <td>
            <button type="button" class="btn btn-inverse-warning btn-sm" title="Editar" data-toggle="modal" data-target="#modalEditGasto" onclick="obtenDatosGasto('<?php echo $vergasto[0] ?>')"><i class="fas fa-edit"></i></button>
            <button type="button" class="btn btn-inverse-danger btn-sm" title="Eliminar" onclick="eliminarGastos('<?php echo $vergasto[0] ?>')"><i class="fas fa-trash-alt"></i></button>
          </td>
        </tr>
       <?php } ?>
    </tbody>
  </table>
</div>
<script>
  $(document).ready(function() {
    $('#tableGasto').DataTable({
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
