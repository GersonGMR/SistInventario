<?php encabezado() ?>
<!-- Begin Page Content -->
<div class="page-content bg-light">
    <section>
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-lg-6 m-auto">
                    <form method="post" action="<?php echo base_url(); ?>Productos/actualizar" autocomplete="off">
                        <div class="card-header bg-dark">
                            <h6 class="title text-white text-center">Modificar Producto</46>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="codigo">Código de barras</label>
                                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                                <input id="codigo" class="form-control" type="text" name="codigo" value="<?php echo $data['codigo']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input id="nombre" class="form-control" type="text" name="nombre" value="<?php echo $data['nombre']; ?>" required>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="cantidad">Stock</label>
                                        <input id="cantidad" class="form-control" type="text" name="cantidad" value="<?php echo $data['cantidad']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="medida">Medida</label>
                                        <input id="medida" class="form-control" type="text" name="medida" value="<?php echo $data['medida']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="id_familia">Familia</label>
                                        <input id="id_familia" class="form-control" type="text" name="id_familia" value="<?php echo $data['id_familia']; ?>"  required readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="id_contenedor">Contenedor</label>
                                        <input id="id_contenedor" class="form-control" type="text" name="id_contenedor" value="<?php echo $data['id_contenedor']; ?>"  required readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="vencimiento">Fecha vencimiento</label>
                                        <input id="vencimiento" class="form-control" type="date" name="vencimiento" value="<?php echo $data['vencimiento']; ?>" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-dark" type="submit">Modificar</button>
                            <a href="<?php echo base_url(); ?>Productos/Listar" class="btn btn-danger">Regresar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
$(document).ready(function () {
 // inizializando y obteniendo value del select2
   $('.seleccionador').select2({
     placeholder: "Select a state"
   }).on('change', function(e) {
     var userid = $('.seleccionador').val();
     $("#id_familia").val(userid);
   });
   //solucionando problema con modales de bootstrap
   $('#familias').select2({
        dropdownParent: $('#nuevo_producto')
    });
    // inizializando y obteniendo value del select2
      $('.seleccionador1').select2({
        placeholder: "Select a state"
      }).on('change', function(e) {
        var contid = $('.seleccionador1').val();
        $("#id_contenedor").val(contid);
      });
      //solucionando problema con modales de bootstrap
      $('#contenedores').select2({
           dropdownParent: $('#nuevo_producto')
       });
});
   </script>
<?php pie() ?>
