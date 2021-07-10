<?php encabezado() ?>
<!-- Begin Page Content -->
<div class="page-content bg-light">
    <div class="page-header bg-light">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Editar entregas</h2>
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
                                    <th>Id venta</th>
                                    <th>No. Entrega</th>
                                    <th>Beneficiado</th>
                                    <th>Nombre producto</th>
                                    <th>Cantidad producto</th>
                                    <th>Acciones</th>
                                  <!--  <th>Estado</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $lista) { ?>
                                    <tr>
                                        <td><?php echo $lista['id']; ?></td>
                                        <td><?php echo $lista['numentrega']; ?></td>
                                        <td style="display:none;"><?php echo $lista['id_cliente']; ?></td>
                                        <td><?php echo $lista['nombre']; ?></td>
                                        <td><?php echo $lista['producto']; ?></td>
                                        <td><?php echo $lista['cantidad']; ?></td>
                                        <td>
                                            <a href="<?php echo base_url() ?>Ventas/editarEntrega?id=<?php echo $lista['id']; ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                            <form action="<?php echo base_url() ?>Ventas/eliminarEntrega?id=<?php echo $lista['id']; ?>" method="post" class="d-inline elim">
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
<?php pie() ?>
