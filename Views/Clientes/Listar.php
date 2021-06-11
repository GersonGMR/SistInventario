<?php include "./conexion.php"; encabezado() ?>
<!-- Begin Page Content -->
<div class="page-content bg-light">
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 mt-2">
                    <div class="row">
                        <div class="col-lg-6 mb-2">
                            <button class="btn btn-dark" type="button" data-toggle="modal" data-target="#nuevo_cliente"><i class="fas fa-plus-circle"></i> Nuevo</button>
                            <a class="btn btn-danger" href="<?php echo base_url(); ?>Clientes/eliminados"><i class="fas fa-user-slash"></i> Inactivos</a>
                        </div>
                        <div class="col-lg-6">
                            <?php if (isset($_GET['msg'])) {
    $alert = $_GET['msg'];
    if ($alert == "existe") { ?>
                                    <div class="alert alert-warning" role="alert">
                                        <strong>El cliente ya existe</strong>
                                    </div>
                                <?php } elseif ($alert == "error") { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Error al registrar</strong>
                                    </div>
                                <?php } elseif ($alert == "registrado") { ?>
                                    <div class="alert alert-success" role="alert">
                                        <strong>Cliente registrado</strong>
                                    </div>
                                <?php } elseif ($alert == "modificado") { ?>
                                    <div class="alert alert-success" role="alert">
                                        <strong>Cliente Modificado</strong>
                                    </div>
                            <?php }
} ?>
                        </div>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table table-hover table-bordered" id="Table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Dirección</th>
                                    <th>Teléfono</th>
                                    <th>DUI</th>
                                    <th>Representante</th>
                                    <th>Cantidad niños</th>
                                    <th>ingreso beneficiario</th>
                                    <th>frecuencia</th>
                                    <th>Acciones</t>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $cl) { ?>
                                    <tr>
                                        <td><?php echo $cl['ruc']; ?></td>
                                        <td><?php echo $cl['nombre']; ?></td>
                                        <td><?php echo $cl['direccion']; ?></td>
                                        <td><?php echo $cl['telefono']; ?></td>
                                        <td><?php echo $cl['dui']; ?></td>
                                        <td><?php echo $cl['representante']; ?></td>
                                        <td><?php echo $cl['cant_ninios']; ?></td>
                                        <td><?php echo $cl['ingreso_beneficiario']; ?></td>
                                        <td><?php echo $cl['descripcion']; ?></td>
                                        <!--Aqui va la frecuencia-->
                                        <td>
                                            <a href="<?php echo base_url() ?>Clientes/editar?id=<?php echo $cl['id']; ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                            <form action="<?php echo base_url() ?>Clientes/eliminar?id=<?php echo $cl['id']; ?>" method="post" class="d-inline elim">
                                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div id="nuevo_cliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="my-modal-title"><i class="fas fa-user-plus"></i> Nuevo Cliente</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?php echo base_url(); ?>Clientes/insertar" autocomplete="off">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="ruc">Codigo</label>
                        <input id="ruc" class="form-control" type="text" name="ruc" placeholder="Codigo" required>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre" required>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="dui">DUI</label>
                                <input id="dui" class="form-control" type="number" name="dui" placeholder="DUI" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input id="telefono" class="form-control" type="text" name="telefono" placeholder="Teléfono" required>
                            </div>
                        </div>
                    </div>
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input id="direccion" class="form-control" type="text" name="direccion" placeholder="Dirección" required>
                        </div>
                    <div class="form-group">
                        <label for="representante">Representante</label>
                        <input id="representante" class="form-control" type="text" name="representante" placeholder="Representante" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cant_ninios">Cantidad niños</label>
                                <input id="cant_ninios" class="form-control" type="number" name="cant_ninios" placeholder="Cantidad niños" required min="1" step="1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ingreso_beneficiario">Fecha ingreso</label>
                                <input id="ingreso_beneficiario" class="form-control" type="date" name="ingreso_beneficiario" placeholder="Fecha ingreso" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                    <!--Select-->
                        <label for="id_frecuencia">Frecuencia</label>
                        <select class="form-select" id="id_frecuencia" name="id_frecuencia"aria-label="multiple select example">
                        <option selected>Selecciona</option>
                            <option value="1">MENSUAL</option>
                            <option value="2">BIMENSUAL</option>
                            <option value="3">TRIMESTRAL</option>
                        </select>
                        <!--input id="id_frecuencia" class="form-control" type="text" name="id_frecuencia" placeholder="Frecuencia"  hidden required-->
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i>Registrar</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php pie() ?>
