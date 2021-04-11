<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Control inventario</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>Assets/css/style.default.css" id="theme-stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>Assets/css/bootstrap.min.css">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>Assets/css/custom.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>Assets/css/dataTables.bootstrap4.min.css">
    <!-- Favicon-->
    <link rel="shorcut icon" href="img/favicon.ico" type="image/x-icon">
    <!-- Tweaks for older IEs-->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>
    <header class="header">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid d-flex align-items-center justify-content-between">
                <div class="navbar-header">
                    <input type="hidden" id="url" value="<?php echo base_url(); ?>">
                    <!-- Navbar Header--><a href="<?php echo base_url(); ?>Admin/Listar" class="navbar-brand">
                        <div class="brand-text brand-big visible"><strong class="text-white">Convoy of Hope</strong></div>
                        <div class="brand-text brand-sm"><strong>CoH</strong></div>
                    </a>
                    <!-- Sidebar Toggle Btn-->
                    <button class="sidebar-toggle"><i class="fas fa-bars"></i></button>
                </div>
                <div class="right-menu list-inline no-margin-bottom">
                    <h4>Sistema de inventario <strong class="text-primary">El Salvador, <?php date_default_timezone_set("America/El_Salvador"); echo date("d/m/Y  g:i ", time());?></strong></h4>
                </div>
                <!-- Log out               -->
                <div class="list-inline-item logout">
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#logout">Salir</button>
                </div>
            </div>
            </div>
        </nav>
    </header>
    <div class="d-flex align-items-self">
        <!-- Sidebar Navigation-->
        <nav id="sidebar">
            <!-- Sidebar Header-->
            <div class="sidebar-header d-flex align-items-center p-1">
                <div class="avatar" data-toggle="modal" data-target="#cambiarPass"><img src="<?php echo base_url(); ?>/Assets/img/logo.png" alt="..." class="img-fluid rounded-circle"></div>
                <div class="title">
                    <h5 class="h5"><?php echo $_SESSION['rol']; ?></h5>
                </div>
            </div>
            <ul class="list-unstyled">
                <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="fas fa-shopping-cart"></i> <strong class="text-white"> Salidas </strong></a>
                    <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                        <li><a href="<?php echo base_url(); ?>Ventas/Listar"><i class="fas fa-cart-plus"></i> Nueva salida</a></li>
                        <li><a href="<?php echo base_url(); ?>Ventas/lista"><i class="fas fa-list-ul"></i> Salidas</a></li>
                    </ul>
                </li>
                <li><a href="#dropdownCompras" aria-expanded="false" data-toggle="collapse"> <i class="fas fa-truck"></i> <strong class="text-white"> Entradas</strong></a>
                            <ul id="dropdownCompras" class="collapse list-unstyled ">
                                <li><a href="<?php echo base_url(); ?>Compras/Listar"><i class="fas fa-cart-plus"></i> Nueva entrada</a></li>
                                <li><a href="<?php echo base_url(); ?>Compras/lista"><i class="fas fa-list-ol"></i> Entradas</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo base_url(); ?>Familias/Listar"> <i class="fas fa-box-open"></i> <strong class="text-white"> Familias </strong></a></li>
                        <li><a href="<?php echo base_url(); ?>Contenedor/Listar"> <i class="fas fa-truck-loading"></i> <strong class="text-white"> Contenedores </strong></a></li>
                <li><a href="<?php echo base_url(); ?>Productos/Listar"> <i class="fab fa-product-hunt"></i> <strong class="text-white"> Productos </strong></a></li>
                <li><a href="<?php echo base_url(); ?>Clientes/Listar"> <i class="fas fa-users"></i> <strong class="text-white"> Beneficiados </strong></a></li>
                <?php if($_SESSION['rol'] == "Administrador"){ ?>
				<li><a href="<?php echo base_url(); ?>Usuarios/Listar"> <i class="fas fa-user"></i> <strong class="text-white"> Usuarios </strong></a></li>

				<li><a href="<?php echo base_url(); ?>Configuracion/Listar"> <i class="fas fa-cogs"></i> <strong class="text-white"> En desarrollo </strong></a></li>
                <?php } ?>
        </nav>
