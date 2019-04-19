<?php
  session_start();
  require '../../config/conexion.php';
  if (isset($_SESSION['loginPat'])) {
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php include('head.php'); ?>
  </head>
  <body style="background: #F2F4F4">
    <?php include('../modal/empNew.php'); ?>
    <?php include('../modal/empEdit.php'); ?>
    <?php include('../modal/empRead.php'); ?>
    <?php include('navbar.php'); ?>
    <!--<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-->
    <div class="container">
      <div class="row mt-5">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-6 text-center text-lg-left d-md-flex">
                  <h4 class="my-auto font-primary"><i class="far fa-address-card mr-3"></i>Empleados</h4>
                </div>
                <div class="col-sm-6 text-center text-lg-right">
                  <button type="button" class="btn btn-primary-melody" data-toggle="modal" data-target="#ModalNuevoEmp"><i class="far fa-file fa-sm mr-2"></i> Nuevo Empleado</button>
                </div>
              </div>
              <hr>
              <div class="row mt-4">
                <div class="col-sm-12">
                  <div id="tableEmp"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-->
    <?php include('scripts.php'); ?>
    <script type="text/javascript">
      $(document).ready(function() {
        $('#tableEmp').load('../componentes/tableemp.php');
      });
    </script>
    <script>
      function obtenDatosEmp(idemp){
        $.ajax({
          url: '../procesos/empleado/readEmp.php',
          type: 'POST',
          data: "idemp=" + idemp,
          success:function(r){
            var datos = $.parseJSON(r);
            $('#idemP').val(datos['idempphp']);
            $('#inputemP').val(datos['nomempphp']);
            $('#inputapeP').val(datos['apempphp']);
            $('#inputSexemP').val(datos['sexempphp']);
            $('#inputDatemP').val(datos['fnempphp']);
            $('#inputDemP').val(datos['ndempphp']);
            $('#inputdiremP').val(datos['dirempphp']);
            $('#inputfonemP').val(datos['fonempphp']);
            $('#inputEmailemP').val(datos['emempphp']);
            $('#inputAccemP').val(datos['accempphp']);
            $('#inputpassP').val(datos['pasempphp']);
            $('#inputcgemP').val(datos['idcgephp']);
            $('#estadoEmp').val(datos['estadoemp']);
          }
        })
        .done(function() {
          console.log("success");
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });

      }
      function deleteEmp(idemp){
        alertify.confirm("¿Seguro de BORRAR al empleado?.",
          function(){
             $.ajax({
              url: '../../public/procesos/empleado/deleteEmp.php',
              type: 'POST',
              data: "idemp=" + idemp,
              success:function(r){
               if (r==1) {
                $('#tableEmp').load('../componentes/tableemp.php');
                alertify.success("Eliminaste con EXITO");
               }else{
                alertify.error("No se pudo Eliminar");
               }
              }
            })
          },
          function(){
            alertify.warning('Estuviste a punto de Eliminar');
          });
      }
    </script>
  </body>
</html>
<?php
  }else{
    header('Location: ../../');
  }
?>
