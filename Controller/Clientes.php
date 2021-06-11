<?php
    class Clientes extends Controllers
    {
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
            $data = $this->model->selectClientes();
            $this->views->getView($this, "Listar", $data, "");
        }
        public function eliminados()
        {
            $data = $this->model->selectClientesInactivos();
            $this->views->getView($this, "Eliminados", $data, "");
        }
        public function insertar()
        {
            $ruc = $_POST['ruc'];
            $nombre = $_POST['nombre'];
            $telefono = $_POST['telefono'];
            $dui = $_POST['dui'];
            $direccion = $_POST['direccion'];
            $representante = $_POST['representante'];
            $cant_ninios = $_POST['cant_ninios'];
            $id_frecuencia = $_POST['id_frecuencia'];
            $ingreso_beneficiario = $_POST['ingreso_beneficiario'];
            $insert = $this->model->insertarClientes($ruc, $nombre, $telefono, $dui, $direccion, $representante, $cant_ninios, $id_frecuencia, $ingreso_beneficiario);
            if ($insert > 0) {
                $alert = 'registrado';
            } elseif ($insert == 'existe') {
                $alert = 'existe';
            } else {
                $alert =  'error';
            }
            $this->model->selectClientes();
            header("location: " . base_url() . "Clientes/Listar?msg=$alert");
            die();
        }
        public function editar()
        {
            $id = $_GET['id'];
            $data = $this->model->editarClientes($id);
            if ($data == 0) {
                $this->Listar();
            } else {
                $this->views->getView($this, "Editar", $data);
            }
        }
        public function actualizar()
        {
            $id = $_POST['id'];
            $ruc = $_POST['ruc'];
            $nombre = $_POST['nombre'];
            $telefono = $_POST['telefono'];
            $dui = $_POST['dui'];
            $direccion = $_POST['direccion'];
            $representante = $_POST['representante'];
            $cant_ninios = $_POST['cant_ninios'];
            $id_frecuencia = $_POST['id_frecuencia'];
            $ingreso_beneficiario = $_POST['ingreso_beneficiario'];
            $actualizar = $this->model->actualizarClientes($ruc, $nombre, $telefono, $dui, $direccion, $representante, $cant_ninios, $id_frecuencia, $ingreso_beneficiario, $id);
            if ($actualizar == 1) {
                $alert = 'modificado';
            } else {
                $alert = 'error';
            }
            header("location: " . base_url() . "Clientes/Listar?msg=$alert");
            die();
        }
        public function eliminar()
        {
            $id = $_GET['id'];
            $this->model->eliminarClientes($id);
            header("location: " . base_url() . "Clientes/Listar");
            die();
        }
        public function reingresar()
        {
            $id = $_GET['id'];
            $this->model->reingresarClientes($id);
            $data = $this->model->selectClientes();
            header("location: " . base_url() . "Clientes/Listar");
            die();
        }
        public function buscar()
        {
            $ruc = $_POST['ruc'];
            $data = $this->model->BuscarCliente($ruc);
            echo json_encode($data);
        }
    }
