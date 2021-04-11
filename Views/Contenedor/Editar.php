<?php encabezado() ?>
<!-- Begin Page Content -->
<div class="page-content bg-light">
    <section>
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-lg-6 m-auto">
                    <form method="post" action="<?php echo base_url(); ?>Contenedor/actualizar" autocomplete="off">
                        <div class="card-header bg-dark">
                            <h6 class="title text-white text-center">Modificar Contenedor</46>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                              <label for="id_familia">id</label>
                              <input type="hidden" name="id" value="<?php echo $data['id_familia']; ?>">
                              <input readonly id="id_contenedor" class="form-control" type="text" name="id_contenedor" value="<?php echo $data['id_contenedor']; ?>">
                          </div>
                            <div class="form-group">
                                <label for="nombre">Codigo Contenedor</label>
                                <input id="nombre" class="form-control" type="text" name="nombre" value="<?php echo $data['nombre']; ?>">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-dark" type="submit">Modificar</button>
                            <a href="<?php echo base_url(); ?>Contenedor/Listar" class="btn btn-danger">Regresar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?php pie() ?>
