<?php
class Contenedor extends Controllers
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
        $data = $this->model->selectContenedor();
        $this->views->getView($this, "Listar", $data, "");
    }
    public function eliminados()
    {
        $data = $this->model->selectContenedorInactivos();
        $this->views->getView($this, "Eliminados", $data, "");
    }
    public function insertar()
    {
        $nombre = $_POST['nombre'];
        $registrador = $_SESSION['usuario'];
        $insert = $this->model->insertarContenedor($nombre, $registrador);
        if ($insert > 0) {
            $alert = 'registrado';
        } elseif ($insert == 'existe') {
            $alert = 'existe';
        } else {
            $alert = 'error';
        }
        $this->model->selectContenedor();
        header("location: " . base_url() . "Contenedor/Listar?msg=$alert");
        die();
    }
    public function editar()
    {
        $id = $_GET['id'];
        $data = $this->model->editarContenedor($id);
        if ($data == 0) {
            $this->Listar();
        } else {
            $this->views->getView($this, "Editar", $data);
        }
    }
    public function actualizar()
    {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $id_familia = $_POST['id_familia'];
        $actualizar = $this->model->actualizarContenedor($nombre, $id);
        if ($actualizar == 1) {
            $alert =  'modificado';
        } else {
            $alert = 'error';
        }
        header("location: " . base_url() . "Contenedor/Listar?msg=$alert");
        die();
    }
    public function eliminar()
    {
        $id = $_GET['id'];
        $eliminar = $this->model->eliminarContenedor($id);
        $data = $this->model->selectContenedor();
        header('location: ' . base_url() . 'Contenedor/Listar');
        //$this->views->getView($this, "Listar", $data, $eliminar);
        die();
    }
    public function reingresar()
    {
        $id = $_GET['id'];
        $this->model->reingresarContenedor($id);
        $data = $this->model->selectContenedor();
        header('location: ' . base_url() . 'Contenedor/Listar');
        //$this->views->getView($this, "Listar", $data);
        die();
    }
}
