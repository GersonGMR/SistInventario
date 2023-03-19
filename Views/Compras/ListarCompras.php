<?php encabezado() ?>
<!-- Begin Page Content -->
<div class="page-content bg-light">
    <div class="page-header bg-light">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Entradas Generadas</h2>
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
                                    <th>Id</th>
                                    <th>Registrador por</th>
                                    <th>Cantidad productos</th>
                                    <th>Fecha</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $lista) { ?>
                                    <tr>
                                        <td><?php echo $lista['id']; ?></td>
                                        <td><?php echo $lista['registrador_entr']; ?></td>
                                        <td><?php echo $lista['total']; ?></td> <!-- cambiar a total de cantidad de productos y no precio. -->
                                        <td><?php echo $lista['fecha']; ?></td>
                                        <td>
                                            <a href="<?php echo base_url(); ?>Compras/ver?id=<?php echo $lista['id']; ?>" target="_blank" rel="noopener noreferrer" class="btn btn-success"><i class="fas fa-file-pdf"></i> PDF</a>
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
