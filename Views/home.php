<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>Assets/css/login.css">


</head>
    <body class="main-bg">
    <div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
    <h2 class="active">Iniciar sesión</h2>

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="<?php echo base_url(); ?>/Assets/img/logo.jpg"  id="icon" alt="User Icon"/>
    </div>

    <!-- Login Form -->
    
    <form action="<?php echo base_url(); ?>Usuarios/login" method="post" autocomplete="off" onsubmit="return validar()">
      <input type="text" id="usuario" class="fadeIn second" name="usuario" placeholder="Usuario">
      <input type="password" id="clave" class="fadeIn third" name="clave" placeholder="Contraseña">
      <input type="submit" class="fadeIn fourth" value="Iniciar">
    </form>

    <?php if (isset($_GET['msg'])) { ?>
        <div role="alert">
            <strong>Usuario o contraseña incorrecta</strong>
        </div>
    <?php } ?>


  </div>
</div>
</body>
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
