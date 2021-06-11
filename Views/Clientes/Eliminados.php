<?php encabezado() ?>
<!-- Begin Page Content -->
<div class="page-content bg-light">
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 mt-2">
                    <div class="row">
                        <div class="col-lg-6 mb-2">
                            <a class="btn btn-primary" href="<?php echo base_url(); ?>Clientes/Listar"><i class="fas fa-arrow-alt-circle-left"></i> Regresar</a>
                        </div>
                    </div>
                    <div class="table-responsive">
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
                                    <th>ingreso del beneficiario</th>
                                    <th>frecuencia</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $cl) { ?>
                                    <tr>
                                        <td><?php echo $cl['ruc']; ?></td>
                                        <td><?php echo $cl['nombre']; ?></td>
                                        <td><?php echo $cl['direccion']; ?></td>
                                        <td><?php echo $cl['telefono']; ?></td>
                                        <td><?php echo $cl['DUI']; ?></td>
                                        <td><?php echo $cl['representante']; ?></td>
                                        <td><?php echo $cl['cant_ninios']; ?></td>
                                        <td><?php echo $cl['ingreso_beneficiario']; ?></td>
                                        <td><?php echo $cl['id_frecuencia']; ?></td>
                                        <td>
                                            <form action="<?php echo base_url() ?>Clientes/reingresar?id=<?php echo $cl['id']; ?>" method="post" class="d-inline confirmar">
                                                <button type="submit" class="btn btn-success"><i class="fas fa-ad"></i></button>
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
<?php pie() ?>
