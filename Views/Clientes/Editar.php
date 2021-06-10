<?php encabezado() ?>
<!-- Begin Page Content -->
<div class="page-content bg-light">
    <section>
        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-lg-6 m-auto">
                    <form method="post" action="<?php echo base_url(); ?>Clientes/actualizar" autocomplete="off">
                        <div class="card-header bg-dark">
                            <h6 class="title text-white text-center"><i class="fas fa-user-edit"></i> Modificar Cliente</46>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="ruc">Codigo</label>
                                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                                <input id="ruc" class="form-control" type="text" name="ruc" value="<?php echo $data['ruc']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input id="nombre" class="form-control" type="text" name="nombre" value="<?php echo $data['nombre']; ?>" required>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="direccion">Dirección</label>
                                        <input id="direccion" class="form-control" type="text" name="direccion" value="<?php echo $data['direccion']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="telefono">Teléfono</label>
                                        <input id="telefono" class="form-control" type="text" name="telefono" value="<?php echo $data['telefono']; ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                        <label for="representante">Representante</label>
                        <input id="representante" class="form-control" type="text" name="representante" value="<?php echo $data['representante']; ?>"required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cant_ninios">Cantidad niños</label>
                                <input id="cant_ninios" class="form-control" type="number" name="cant_ninios" value="<?php echo $data['cant_ninios']; ?>" required min="1" step="1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ingreso_beneficiario">Fecha ingreso</label>
                                <input id="ingreso_beneficiario" class="form-control" type="date" name="ingreso_beneficiario" value="<?php echo $data['ingreso_beneficiario']; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                    <!--Select-->
                        <label for="id_frecuencia">Frecuencia</label>
                        <select class="form-select" id="id_frecuencia" name="id_frecuencia"aria-label="multiple select example">
                        <option selected ><?php echo $data['descripcion']; ?></option>
                            <option value="1">MENSUAL</option>
                            <option value="2">BIMENSUAL</option>
                            <option value="3">TRIMESTRAL</option>
                            
                        </select>
                        <!--input id="id_frecuencia" class="form-control" type="text" name="id_frecuencia" value="<//?php echo $data['id_frecuencia']; ?>" required-->
                    </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-dark" type="submit"><i class="fas fa-save"></i> Modificar</button>
                            <a href="<?php echo base_url(); ?>Clientes/Listar" class="btn btn-danger"><i class="fas fa-arrow-alt-circle-left"></i> Regresar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?php pie() ?>
