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
                                <input id="codigo" class="form-control" type="text" name="codigo" value="<?php echo $data['codigo']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input id="nombre" class="form-control" type="text" name="nombre" value="<?php echo $data['nombre']; ?>">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="cantidad">Stock</label>
                                        <input id="cantidad" class="form-control" type="text" name="cantidad" value="<?php echo $data['cantidad']; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="medida">Medida</label>
                                        <input id="medida" class="form-control" type="text" name="medida" value="<?php echo $data['medida']; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="id_familia">Familia</label>
                                        <input id="id_familia" class="form-control" type="text" name="id_familia" value="<?php echo $data['id_familia']; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="id_contenedor">Contenedor</label>
                                        <input id="id_contenedor" class="form-control" type="text" name="id_contenedor" value="<?php echo $data['id_contenedor']; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="vencimiento">Fecha vencimiento</label>
                                        <input id="vencimiento" class="form-control" type="date" name="vencimiento" value="<?php echo $data['vencimiento']; ?>">
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
<?php pie() ?>
