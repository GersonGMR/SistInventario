<?php include "./conexion.php"; encabezado() ?>
<!-- Begin Page Content -->
<div class="page-content bg-light">
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 mt-2">
                    <div class="row">
                        <div class="col-lg-6 mb-2">
                            <button class="btn btn-dark" type="button" data-toggle="modal" data-target="#nuevo_producto"><i class="fas fa-plus-circle"></i> Nuevo</button>
                            <a class="btn btn-danger" href="<?php echo base_url(); ?>Productos/eliminados"><i class="fas fa-user-slash"></i> Inactivos</a>
                        </div>
                        <div class="col-lg-6">
                            <?php if (isset($_GET['msg'])) {
    $alert = $_GET['msg'];
    if ($alert == "existe") { ?>
                                    <div class="alert alert-warning" role="alert">
                                        <strong>El producto ya existe</strong>
                                    </div>
                                <?php } elseif ($alert == "error") { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Error al registrar</strong>
                                    </div>
                                <?php } elseif ($alert == "registrado") { ?>
                                    <div class="alert alert-success" role="alert">
                                        <strong>Producto registrado</strong>
                                    </div>
                                <?php } elseif ($alert == "modificado") { ?>
                                    <div class="alert alert-success" role="alert">
                                        <strong>Producto Modificado</strong>
                                    </div>
                            <?php }
} ?>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tableproducts">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Código</th>
                                    <th>Registrado por</th>
                                    <th>Nombre</th>
                                    <th>Stock</th>
                                    <th>Medida</th>
                                    <th>Familia</th>
                                    <th>Contenedor</th>
                                    <th>Fecha ingreso</th>
                                    <th>Fecha vencimiento</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>  
                                <?php foreach ($data as $cl) { ?>
                                    <tr>
                                        <td><?php echo $cl['codigo']; ?></td>
                                        <td><?php echo $cl['registrador_prod']; ?></td>
                                        <td><?php echo $cl['nombre']; ?></td>
                                        <td><?php echo $cl['cantidad']; ?></td>
                                        <td><?php echo $cl['medida']; ?></td>
                                        <td><?php echo $cl['familia']; ?></td>
                                        <td><?php echo $cl['contenedor']; ?></td>
                                        <td><?php echo $cl['fecha_ingreso']; ?></td>
                                        
                                        <?php 
                                        //OBTIENE FECHA ACTUAL DEL SISTEMA Y LA COMPARA CON LA FECHA DE VENCIMIENTO PARA SABER CUANDO ESTÁ A 7 MESES DE VENCER.
                                        date_default_timezone_set("America/El_Salvador"); 
                                        $fechaActual = date("Ym", time());
                                        
                                        $fechaPreventiva = strtotime('-7 months', strtotime($cl['vencimiento']));
                                        $fechaPreventiva = date('Ym', $fechaPreventiva);

                                            if($fechaPreventiva<=$fechaActual) // red
                                            echo "<td style='background-color: #FF6666;'>".$cl['vencimiento']."</td>";
                                            else// white
                                            echo "<td style='background-color: #75FA90;'>".$cl['vencimiento']."</td>"; 
                                         ?> 
                                        <td>
                                            <a href="<?php echo base_url() ?>Productos/editar?id=<?php echo $cl['id']; ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                            <form action="<?php echo base_url() ?>Productos/eliminar?id=<?php echo $cl['id']; ?>" method="post" class="d-inline elim">
                                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                    } ?>
                                    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div id="nuevo_producto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="my-modal-title"><i class="fas fa-clipboard-list"></i> Nuevo Producto</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?php echo base_url(); ?>Productos/insertar" autocomplete="off">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="codigo">Código</label>
                        <input id="codigo" class="form-control" type="text" name="codigo" placeholder="Código" required>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Descripción" required>
                    </div>

                            <div class="form-group">
                                <label for="medida">Medida</label>
                                <input id="medida" class="form-control" type="text" name="medida" placeholder="Medida" required>
                            </div>
                            <div class="form-group">
                                <label for="id_familia">Familia</label><br>
                                <select class="seleccionador" id="familias" required>
                                  <option value="">Selecciona</option>
                                  <?php $sql = mysqli_query($conexion, "SELECT * FROM familia WHERE estado = 1");
                                   while ($fam = $sql->fetch_assoc()) {
                                       echo '<option value=" '.$fam['id_familia'].' "> '.$fam['nombre'].' </option>';
                                   }
                                   ?>
                                </select>
                                <input id="id_familia" class="form-control" type="text" name="id_familia" hidden required>
                            </div>
                            <div class="form-group">
                                <label for="id_contenedor">Contenedor</label><br>
                                <select class="seleccionador1" id="contenedores" required>
                                  <option value="">Selecciona</option>
                                  <?php $sql = mysqli_query($conexion, "SELECT * FROM contenedor WHERE estado = 1");
                                   while ($com = $sql->fetch_assoc()) {
                                       echo '<option value=" '.$com['id'].' "> '.$com['nombre'].' </option>';
                                   }
                                   ?>
                                </select>
                                <input id="id_contenedor" class="form-control" type="text" name="id_contenedor" hidden required>
                            </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="vencimiento">Fecha vencimiento</label>
                                <input id="vencimiento" class="form-control" type="date" name="vencimiento" placeholder="Fecha vencimiento" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Registrar</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php pie() ?>
