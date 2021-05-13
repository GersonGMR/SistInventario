<?php
class Productos extends Controllers
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
        $data = $this->model->selectProductos();
        $this->views->getView($this, "Listar", $data, "");
    }
    public function eliminados()
    {
        $data = $this->model->selectProductosInactivos();
        $this->views->getView($this, "Eliminados", $data, "");
    }
    public function insertar()
    {
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $medida = $_POST['medida'];
        $id_familia = $_POST['id_familia'];
        $id_contenedor = $_POST['id_contenedor'];
        $vencimiento = $_POST['vencimiento'];
        $insert = $this->model->insertarProductos($codigo, $nombre, $medida, $id_familia, $id_contenedor, $vencimiento);
        if ($insert > 0) {
            $alert = 'registrado';
        } elseif ($insert == 'existe') {
            $alert = 'existe';
        } else {
            $alert = 'error';
        }
        $this->model->selectProductos();
        header("location: " . base_url() . "Productos/Listar?msg=$alert");
        die();
    }
    public function editar()
    {
        $id = $_GET['id'];
        $data = $this->model->editarProductos($id);
        if ($data == 0) {
            $this->Listar();
        } else {
            $this->views->getView($this, "Editar", $data);
        }
    }
    public function actualizar()
    {
        $id = $_POST['id'];
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $cantidad = $_POST['cantidad'];
        $medida = $_POST['medida'];
        $id_familia = $_POST['id_familia'];
        $id_contenedor = $_POST['id_contenedor'];
        $vencimiento = $_POST['vencimiento'];
        $actualizar = $this->model->actualizarProductos($codigo, $nombre, $cantidad, $medida, $id_familia, $id_contenedor, $vencimiento, $id);
        if ($actualizar == 1) {
            $alert =  'modificado';
        } else {
            $alert = 'error';
        }
        header("location: " . base_url() . "Productos/Listar?msg=$alert");
        die();
    }
    public function eliminar()
    {
        $id = $_GET['id'];
        $eliminar = $this->model->eliminarProductos($id);
        $data = $this->model->selectProductos();
        header('location: ' . base_url() . 'Productos/Listar');
        //$this->views->getView($this, "Listar", $data, $eliminar);
        die();
    }
    public function reingresar()
    {
        $id = $_GET['id'];
        $this->model->reingresarProductos($id);
        $data = $this->model->selectProductos();
        header('location: ' . base_url() . 'Productos/Listar');
        //$this->views->getView($this, "Listar", $data);
        die();
    }
}
