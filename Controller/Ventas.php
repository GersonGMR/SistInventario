<?php
    class Ventas extends Controllers
    {
        protected $totalPagar;
        protected $tot = 0;
        public function __construct()
        {
            session_start();
            if (empty($_SESSION['activo'])) {
                header("location: " . base_url());
            }
            parent::__construct();
        }
        public function Listar()
        {
            $this->views->getView($this, "Listar");
        }
        public function lista()
        {
            $data = $this->model->selectVentas();
            $this->views->getView($this, "ListarVentas", $data, "");
        }
        public function ingresar()
        {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $cantidad = $_POST['cantidad'];
            $precio = $_POST['precio'];
            $total = $cantidad * $precio;
            $id_usuario = $_SESSION['id'];
            $existe = $this->model->buscarProductoexiste($id, $id_usuario);
            if ($existe) {
                $idP = $existe['id'];
                $cant = $existe['cantidad'];
                $cantidad = $_POST['cantidad'] + $cant;
                $total = $existe['precio'] * $cantidad;
                $this->model->actualizarCantidad($cantidad, $total, $idP);
                echo "1";
            } else {
                $insert = $this->model->insertarDetalle($nombre, $cantidad, $precio, $total, $id, $id_usuario);
                if ($insert > 0) {
                    $this->Listar();
                } else {
                    echo "error";
                }
            }
        }
        public function ventas()
        {
            $data = $this->model->selectDetalle();
            foreach ($data as $ventas) {
                $this->totalPagar = $this->totalPagar + $ventas['total'];
                echo "<tr>
                <td>".$ventas['nombre']."</td>
                <td class='verificarCantidad'>" . $ventas['cantidad'] . "</td>
                <td>" . $ventas['precio'] . "</td>
                <td>" . $ventas['total'] . "</td>
                <td>
                <button typu='button' class='btn btn-danger' onclick='EliminarDetalle(" . $ventas['id'] . ");'>Eliminar</button>
                </td>
            </tr>";
            }
            $tot = number_format($this->totalPagar, 2, ".", ",");

            echo "<input type='hidden' id='totalPagar' value='" . $tot. "'/>";
        }

        public function eliminar()
        {
            $id = $_POST['id'];
            $this->model->eliminarVentas($id);
        }
        public function editarEntrega()
        {
            $id = $_GET['id'];
            $data = $this->model->editarEntrega($id);
            if ($data == 0) {
                $this->Lista();
            } else {
                $this->views->getView($this, "Editar", $data);
            }
        }
        public function actualizarEntrega()
        {
            $id = $_POST['id'];
            $numentrega = $_POST['numentrega'];
            $nombre = $_POST['nombre'];
            $total = $_POST['total'];
            $actualizar = $this->model->actualizarEntrega($numentrega, $nombre, $total, $id);
            if ($actualizar == 1) {
                $alert =  'modificado';
            } else {
                $alert = 'error';
            }
            header("location: " . base_url() . "Ventas/Lista?msg=$alert");
            die();
        }
        public function eliminarEntrega()
        {
            $id = $_GET['id'];
            $eliminar = $this->model->eliminarEntrega($id);
            $data = $this->model->selectVentas();
            header('location: ' . base_url() . 'Ventas/Lista');
            //$this->views->getView($this, "Listar", $data, $eliminar);
            die();
        }
        public function eliminarTest()
        {
            $idVenta = $_GET['id'];
            $data = $this->model->buscaridC();
            $result = $data['MAX(id)'];
            $productos = $this->model->verificarTest($idVenta);
            foreach ($productos as $data) {
                $stock = $this->model->stockActual($data['id_producto']);
                $stockActual = $stock['cantidad'];
                $this->model->registrarStock($stockActual + $data['cantidad'], $data['id_producto']);
            }
            $this->model->eliminarEntrega($idVenta);
            header('location: ' . base_url() . 'Ventas/Lista');
            die();
        }
        public function buscar()
        {
            $codigo = $_POST['codigo'];
            $data = $this->model->buscarProducto($codigo);
            echo json_encode($data);
        }
        public function registarVenta()
        {
            $data = $this->model->buscaridC();
            $result = $data['MAX(id)'];
            if ($result == null) {
                $id_venta = 1;
            } else {
                $id_venta = $result;
            }
        }
        public function registrar()
        {
            $cliente = $_POST['cliente'];
            $usuario_vendedor = $_SESSION['usuario'];
            $totalP = $_POST['totalP'];
            $numentrega = $_POST['numentrega'];
            if ($cliente == 0 || $cliente == "") {
                # code...
                $this->model->registrarCompra(1, $totalP);
            } else {
                $this->model->registrarCompra($cliente, $usuario_vendedor, $totalP, $numentrega);
            }
            $data = $this->model->buscaridC();
            $result = $data['MAX(id)'];
            $productos = $this->model->verificarProductos($_SESSION['id']);
            foreach ($productos as $data) {
                $stock = $this->model->stockActual($data['id_producto']);
                $stockActual = $stock['cantidad'];
                $insertar = $this->model->registrarDetalle($result, $data['nombre'], $data['id_producto'], $data['cantidad'], $data['precio'], $data['id_usuario']);
                $this->model->registrarStock($stockActual - $data['cantidad'], $data['id_producto']);
            }
            $this->model->VaciarCompra($_SESSION['id']);
            die();
        }
        public function ver()
        {
            $config = $this->model->selectConfiguracion();
            $id = $_GET['id'];
            $id_cliente = $_GET['id'];
            $data = $this->model->ListaVentas($id);
            $cliente = $this->model->PdfCliente($id_cliente);
            $this->views->getView($this, "VerVentas", $data, "", $config, $cliente);
        }
        public function buscarCliente()
        {
            $return = array();
            $data = $this->model->selectClientes();
            if (!empty($data)) {
                foreach ($data as $clientes) {
                    $res['id'] = $clientes['id'];
                    $res['value'] = $clientes['nombre'];
                    array_push($return, $res);
                }
            }
            echo json_encode($return);
        }
        public function entregado()
        {
            $id = $_GET['id'];
            $estado = $_GET['estado'];
            $this->model->entregadoS($id, $estado);
            header('location: ' . base_url() . 'Ventas/lista');
            die();
        }
    }
