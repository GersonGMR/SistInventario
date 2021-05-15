const base = document.getElementById("url").value;
const urls = base + "Compras/ingresar";
window.addEventListener("load", function () {
    //reportes();
    //reportesTorta();
    ListarCompras();
})
$(document).ready(function () {
    $("#procesarCompra").click(function () {
        var fila = $("#tablaCompras tr").length;
        if (fila < 2) {
            Swal.fire({
                icon: 'warning',
                title: 'No hay productos en la entrada',
                showConfirmButton: false,
                timer: 2500
            })
        } else {
            const total = {
                totalP: $("#total").val()
            }

            $.ajax({
                url: base + "Compras/registrar",
                type: 'POST',
                data: total,
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Entrada Generada',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    ListarCompras();
                }
            })
        }
    });
    $("#procesarVenta").click(function () {

        var fila = $("#tablaCompras tr").length;
        var cliente = $("#nombre_cliente").val();
        var id_cliente = document.getElementById("id_cliente").value;

        if (fila < 2) {
            Swal.fire({
                icon: 'warning',
                title: 'No hay productos en la salida',
                showConfirmButton: false,
                timer: 2500
            })
        }
        else if(id_cliente == null || id_cliente == "" || id_cliente == 0 ){
            Swal.fire({
                icon: 'warning',
                title: 'Por favor ingresa un beneficiado.',
                showConfirmButton: false,
                timer: 2500
            })
        }
        else {
            const total = {
                cliente: $("#id_cliente").val(),
                totalP: $("#total").val()
            }
            $.ajax({
                url: base + "Ventas/registrar",
                type: 'POST',
                data: total,
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Salida Generada',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    ListarCompras();
                }
            })
        }
    });
    $("#AnularCompra").click(function () {
        Swal.fire({
            title: 'Esta seguro que desea anular?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'si!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: base + "Compras/anular",
                    type: 'POST',
                    success: function (response) {
                        ListarCompras();
                        if (response != "error") {
                            Swal.fire({
                                icon: 'success',
                                title: 'Anulado',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    }
                });
            }
        });
    });
    $(document).on("click", ".eliminar", function () {
        var id = $(this).data("id");
        $.ajax({
            url: base + "Ventas/eliminar",
            type: 'POST',
            data: {
                id
            },
            success: function (response) {
                ListarCompras();
                if (response != "error") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Eliminado',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
        })
    });
    $(".elim").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Esta seguro de eliminar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si!',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
    $(".confirmar").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Esta seguro de Reingresar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si!',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
    $("#cambiar").click(function () {
        let claves = {
            actual: $("#actual").val(),
            nueva: $("#nueva").val()
        }
        $.ajax({
            url: base + "Usuarios/cambiar",
            type: "POST",
            data: {
                claves
            },
            success: function (response) {
                console.log(response);
                if (response == 1) {
                        $("#errorPass").html(`<div class="alert alert-primary" role="alert">
                                <strong>Contraseña Modificada con exito</strong>
                            </div>`);
                } else {
                    $("#errorPass").html(`<div class="alert alert-danger" role="alert">
                                <strong>Contraseña incorecta</strong>
                            </div>`);
                }
            }
        });
    });
});

function BuscarCodigo(e) {
    if (e.which == 13) {
        const codigo = document.getElementById("buscar_codigo").value;
        const url = document.getElementById("url").value;
        const urls = url + "Compras/buscar";
        $.ajax({
            url: urls,
            type: 'POST',
            data: {
                codigo
            },
            success: function (response) {
                if (response != 0) {
                    $("#error").addClass('d-none');
                    var info = JSON.parse(response);
                    document.getElementById("id").value = info.id;
                    document.getElementById("nombre").value = info.nombre;
                    $("#stockD").val(info.cantidad);
                    document.getElementById("cantidad").value = 1;
                    document.getElementById("nombreP").innerHTML = info.nombre;
                    document.getElementById("cantidad").focus();
                } else {
                    $("#error").removeClass('d-none');
                }
            }
        });
    }
}

function ingresarCantidad(e) {
    //const stockD = $("#stockD").val();
    const stockD = parseInt(document.getElementById("stockD").value);
    const cantidad = parseInt(document.getElementById("cantidad").value);
    if (e.which == 13) {
        if (stockD == "" || stockD == 0 || stockD == null) {
            $('#frmCompras').trigger("reset");
            $("#buscar_codigo").focus();
            document.getElementById("nombreP").innerHTML = "";
            Swal.fire({
                icon: 'warning',
                title: 'No hay stock o la cantidad ingresa es igual a cero.',
                showConfirmButton: false,
                timer: 3000
            })
        }
        else if(cantidad > stockD){

            //$("#buscar_codigo").focus();
            document.getElementById("nombreP").innerHTML = "";
            Swal.fire({
                icon: 'warning',
                title: 'La cantidad ingresada excede el stock disponible.',
                showConfirmButton: false,
                timer: 3000
            })
        }
        else {
            $.ajax({
                url: urls,
                type: 'POST',
                async: true,
                data: $("#frmCompras").serialize(),
                success: function (response) {
                    $('#frmCompras').trigger("reset");
                    $("#buscar_codigo").focus();
                    $("#nombreP").html("");
                    if (response == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Se actualizo la cantidad del producto',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        ListarCompras();
                    } else {
                        ListarCompras();
                    }
                }
            });
        }
    }
}

function buscarCliente(e) {
    const ruc = $("#ruc_cliente").val();
    if (e.which == 13) {
        $.ajax({
            url: base + "Clientes/buscar",
            type: "POST",
            data: {
                ruc
            },
            success: function (response) {
                var info = JSON.parse(response);
                $("#id_cliente").val(info.id);
                $("#nom_cli").html(info.nombre);
                $("#dir_cli").html(info.direccion);
                $("#tel_cli").html(info.telefono);
            }
        });
    }
}

function ListarCompras() {
    $.ajax({
        url: base + "Compras/compras",
        type: 'POST',
        success: function (response) {
            $("#ListaCompras").html(response);
            const tl = $("#totalPagar").val();
            $("#total").val(tl);
            $("#tVenta").html(tl);
            $("#totalV").html(tl);
        }
    });
}
// chart Barra

function reportes() {
    $.ajax({
        url: base + "Admin/reportes",
        type: 'POST',
        success: function (response) {
            var data = JSON.parse(response);
            var nombre = [];
            var cantidad = [];
            for (var i = 0; i < data.length; i++) {
                nombre.push(data[i]['nombre']);
                cantidad.push(data[i]['cantidad']);
            }
            // Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#292b2c';

            // Bar Chart Example
            var ctx = document.getElementById("myBarChart");
            var myLineChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: nombre,
                    datasets: [{
                        label: "Stock",
                        data: cantidad,
                        backgroundColor: [
                            'Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange', 'crimson', 'teal', 'fuchsia', 'lime'
                        ],
                    }],
                },
                options: {
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'month'
                            },
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                maxTicksLimit: 6
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                min: 0,
                                max: 20,
                                maxTicksLimit: 5
                            },
                            gridLines: {
                                display: true
                            }
                        }],
                    },
                    legend: {
                        display: false
                    }
                }
            });
        }
    })
}
// chart torta
function reportesTorta() {
    $.ajax({
        url: base + "Admin/reportesTorta",
        type: 'POST',
        success: function (response) {
            var data = JSON.parse(response);
            var producto = [];
            var total = [];
            for (var i = 0; i < data.length; i++) {
                producto.push(data[i]['producto']);
                total.push(data[i]['total']);
            }
            // Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#292b2c';

            // Pie Chart Example
            var ctx = document.getElementById("myPieChart");
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: producto,
                    datasets: [{
                        data: total,
                        backgroundColor: [
                            'Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange', 'crimson', 'teal', 'fuchsia', 'lime'
                        ]
                    }],
                },
            });
        }
    })
}
