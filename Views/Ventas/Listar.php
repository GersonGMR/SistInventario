<?php encabezado() ;



    //Aqui ira la consulta para traer cantidad de los productos.

    //$cantidad = mysqli_query($conexion, "SELECT cantidad, codigo FROM productos");


    /*while($row = mysqli_fetch_assoc($cantidad)) {
        echo var_dump($row);
    }*/

    //echo var_dump($cantidad);

?>

<!-- Begin Page Content -->
<div class="page-content bg-light">
    <div class="page-header bg-light">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Nueva Salida</h2>
        </div>
    </div>
    <section>
        <div class="container-fluid">
            <form action="" method="post" id="frmCompras" name="frmCompras" class="row" autocomplete="off">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="buscar_codigo">Cógigo producto</label>
                        <input type="hidden" id="id" name="id">
                        <input id="buscar_codigo" onkeyup="BuscarCodigo(event);" class="form-control" type="text" name="codigo" placeholder="Código producto">
                        <span class="text-danger d-none" id="error">No hay producto</span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="nombre">Producto</label>
                        <input id="nombre" class="form-control" type="hidden" name="nombre">
                        <br />
                        <strong id="nombreP"></strong>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input id="stockD" type="hidden">
                        <!-- IngresarCantidad(event); -->
                        <input id="cantidad" onkeyup="ingresarCantidad(event);" class="form-control" type="number" name="cantidad"  min="1">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="precio" hidden>Precio</label>
                        <input id="precio" class="form-control" type="hidden" name="precio">
                        <br />
                        <strong hidden id="precioP"></strong>
                    </div>
                </div>
                <div class="col-lg-3">
                    <!--<input type="submit" class="btn btn-success" value="Procesar" id="subCompras" name="subCompras"-->
                    <!--<button class="btn btn-success" name="frmCompras" type="submit">Procesar</button>-->
                </div>
            </form>

            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-light mt-4" id="tablaCompras">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody id="ListaCompras">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 mt-1">
                    <div class="form-group" >
                        <strong class="text-primary">Datos del beneficiado</strong>
                        <input type="hidden" id="id_cliente" name="id_cliente">
                        <input type="text" id="ruc_cliente" onkeyup="buscarCliente(event);" name="ruc_cliente" class="form-control" placeholder="Codigo del beneficiado" required>
                        <strong id="nom_cli" class="form-control border-0 text-success"></strong>
                        <strong id="dir_cli" class="form-control border-0 text-success"></strong>
                        <strong id="tel_cli" class="form-control border-0 text-success"></strong>
                    </div>
                </div>
                <div class="col-lg-4 mt-1">
                    <div class="form-group">
                        <strong class="text-primary">Total unidades: </strong>
                        <input type="hidden" id="total" name="total" class="form-control  mb-2">
                        <strong id="tVenta" class="form-control border-0 text-success"></strong>
                        <button class="btn btn-danger" type="button" id="AnularCompra">Anular salida</button>

                        <button class="btn btn-success" type="button" id="procesarVenta"
                            <i class="fas fa-money-check-alt"></i>
                         Procesar salida</button>

                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
<script>
    //Aqui ira el codigo para hacer la validacion

    /*function ingresarCantidad(e){
        alert("1");
        const stockD = $("#stockD").val();
        const cantidad = document.getElementById("cantidad").value;
        alert("2");

        if (e.which == 13) {
            alert("3");
            if (stockD == "") {
                alert("4.1");
                $('#frmCompras').trigger("reset");
                $("#buscar_codigo").focus();
                document.getElementById("nombreP").innerHTML = "";
                Swal.fire({
                    icon: 'warning',
                    title: 'Ingrese la cantidad',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
            else if(stockD < cantidad){
                alert("4.2");
                //$('#frmCompras').trigger("reset");
                $("#buscar_codigo").focus();
                //document.getElementById("nombreP").innerHTML = "";
                Swal.fire({
                    icon: 'warning',
                    title: 'Ingrese la cantidad igual o manor al stock.',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
            else {
                alert("4.3");
                $.ajax({
                    url: urls,
                    type: 'POST',
                    async: true,
                    data: $("#frmCompras").serialize(),
                    success: function (response) {
                        alert("5");
                        $('#frmCompras').trigger("reset");
                        $("#buscar_codigo").focus();
                        $("#nombreP").html("");
                        if (response == 1) {
                            alert("6.1");
                            Swal.fire({
                                icon: 'success',
                                title: 'Se actualizo la cantidad del producto',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            ListarCompras();
                        } else {
                            alert("6.2");
                            ListarCompras();
                        }
                    }
                });
                alert("7");
            }
        }
    } */
</script>

<?php pie() ?>
