<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>Assets/css/bootstrap.min.css">

    <!--
        <style>
        input:invalid {
            box-shadow: 0 0 5px 1px red;;
        }
        input:valid {
        border: 2px solid black;
        }
    </style>
        -->

</head>

<body class="bg-secondary">
    <div class="container">
        <div class="row mt-3">
            <div class="col-lg-4 m-auto">
                <div class="card mt-5">
                    <div class="card-header bg-primary text-center">
                        <strong class="text-white">Iniciar Sesión</strong><br>
                        <img class="img-thumbnail" src="<?php echo base_url(); ?>/Assets/img/logo.jpg" width="300">
                    </div>
                    <div class="card-body">
                        <?php if (isset($_GET['msg'])) { ?>
                            <div class="alert alert-danger" role="alert">
                                <strong>Usuario o contraseña Incorrecta</strong>
                            </div>
                        <?php } ?>

                        <div id ='error' class="text-danger"></div>
                        <form action="<?php echo base_url(); ?>Usuarios/login" method="post" autocomplete="off" onsubmit="return validar()">

                            <div class="form-group">
                                <strong class="text-primary">Usuario</strong>
                                <input id="usuario" class="form-control" type="text" name="usuario" placeholder="Usuario">
                            </div>
                            <div class="form-group">
                                <strong class="text-primary">Contraseña</strong>
                                <input id="clave" class="form-control" type="password" name="clave" placeholder="Contraseña">
                            </div>
                            <input class="btn btn-primary btn-block" type="submit" value="Iniciar" >
                            <!--
                            <button class="btn btn-primary btn-block" type="submit">Iniciar</button>
                            -->
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
                        <script>
                            function limpiarFormulario(){
                                var error = document.getElementById('error');
                                error.innerHTML = "";
                            }

                            function validar(){
                                //limpiarFormulario();
                                var usuario = document.getElementById('usuario');
                                var clave = document.getElementById('clave');
                                var error = document.getElementById('error');
                                //error.style.color = 'red';
                                var return_value = true;

                                console.log('enviando formulario');
                                var mensajesError = [];

                                if (usuario.value === null || usuario.value=== ''){
                                    mensajesError.push('Ingresa tu usuario');
                                    return_value = false;
                                }

                                if (clave.value === null || clave.value=== ''){
                                    mensajesError.push('Ingresa tu Contraseña');
                                    return_value = false;
                                }

                                error.innerHTML = mensajesError.join(', ');


                                return return_value;
                            }

                        </script>
</body>

</html>
