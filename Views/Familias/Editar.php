<?php encabezado() ?>
<!-- Begin Page Content -->
<div class="page-content bg-light">
    <section>
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-lg-6 m-auto">
                    <form method="post" action="<?php echo base_url(); ?>Familias/actualizar" autocomplete="off">
                        <div class="card-header bg-dark">
                            <h6 class="title text-white text-center">Modificar Familia</46>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                              <label for="id_familia">Codigo familia</label>
                              <input type="hidden" name="id" value="<?php echo $data['id_familia']; ?>">
                              <input readonly id="id_familia" class="form-control" type="text" name="id_familia" value="<?php echo $data['id_familia']; ?>" required>
                          </div>
                            <div class="form-group">
                                <label for="nombre">Nombre familia</label>
                                <input id="nombre" class="form-control" type="text" name="nombre" value="<?php echo $data['nombre']; ?>" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-dark" type="submit">Modificar</button>
                            <a href="<?php echo base_url(); ?>Familias/Listar" class="btn btn-danger">Regresar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?php pie() ?>
