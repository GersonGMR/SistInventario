<?php encabezado() ?>
<!-- Begin Page Content -->
<div class="page-content bg-light">
    <div class="page-header bg-light">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Salidas Generadas</h2>
        </div>
    </div>
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="Table">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="display:none;">Id</th>
                                    <th>No. Entrega</th>
                                    <th style="display:none;">Id cliente</th>
                                    <th>Beneficiado</th>
                                    <th>Cant. productos</th>
                                    <th>Fecha de salida</th>
                                    <th>Reporte</th>
                                    <th>Acciones</th>
                                  <!--  <th>Estado</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $lista) { ?>
                                    <tr>
                                        <td style="display:none;"><?php echo $lista['id']; ?></td>
                                        <td><?php echo $lista['numentrega']; ?></td>
                                        <td style="display:none;"><?php echo $lista['id_cliente']; ?></td>
                                        <td><?php echo $lista['nombre']; ?></td>
                                        <td><?php echo $lista['total']; ?></td>
                                        <td><?php echo $lista['fecha']; ?></td>
                                        <td>
                                            <a href="<?php echo base_url(); ?>Ventas/ver?id=<?php echo $lista['id']; ?>&cliente=<?php echo $lista['id_cliente']; ?>" target="_blank" rel="noopener noreferrer" class="btn btn-success"><i class="fas fa-file-pdf"></i></i> PDF</a>
                                        </td>
                                        <td>
                                        <?php if ($_SESSION['rol'] == "Administrador") { ?>
                                            <form action="<?php echo base_url() ?>Ventas/eliminarTest?id=<?php echo $lista['id']; ?>" method="post" class="d-inline elim">
                                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                            <?php } else {
                                                echo "No eres administrador";
                                            } ?>
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
