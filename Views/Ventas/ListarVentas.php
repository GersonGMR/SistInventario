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
                                    <th>Id</th>
                                    <th>No. Entrega</th>
                                    <th>Beneficiado</th>
                                    <th>Cant. productos</th>
                                    <th>Fecha de salida</th>
                                    <th>Reporte</th>
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
                                        <td><?php echo $lista['total']; ?></td>
                                        <td><?php echo $lista['fecha']; ?></td>
                                        <td>
                                            <a href="<?php echo base_url(); ?>Ventas/ver?id=<?php echo $lista['id']; ?>&cliente=<?php echo $lista['id_cliente']; ?>" target="_blank" rel="noopener noreferrer" class="btn btn-primary"><i class="fas fa-file-pdf"></i></i> PDF</a>
                                        </td>
                                        <!--<td>
                                          <form action="<?php echo base_url(); ?>Ventas/entregado?id=<?php echo $lista['id']; ?>&estado=<?php echo 1; ?>" method="post" >
                                            <select name="entrega" id="entrega" onchange="this.form.submit()">
                                              <option value="0">Pendiente</option>
                                              <option value="1">Entregado</option>
                                            </select>
                                          </form>
                                        </td>-->
                                    </tr>
                                <?php } ?><?php
                                if (isset($_POST['submit'])) {
                                    $selected_val = $_POST['entrega'];  // Storing Selected Value In Variable
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php pie() ?>
