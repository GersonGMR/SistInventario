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
        $insert = $this->model->insertarContenedor($nombre);
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
        $id_contenedor = $_GET['id_contenedor'];
        $data = $this->model->editarContenedor($id_contenedor);
        if ($data == 0) {
            $this->Listar();
        } else {
            $this->views->getView($this, "Editar", $data);
        }
    }
    public function actualizar()
    {
        $id_contenedor = $_POST['id_contenedor'];
        $nombre = $_POST['nombre'];
        $id_familia = $_POST['id_familia'];
        $actualizar = $this->model->actualizarContenedor($nombre, $id_contenedor);
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
        $id_contenedor = $_GET['id_contenedor'];
        $eliminar = $this->model->eliminarContenedor($id_contenedor);
        $data = $this->model->selectContenedor();
        header('location: ' . base_url() . 'Contenedor/Listar');
        //$this->views->getView($this, "Listar", $data, $eliminar);
        die();
    }
    public function reingresar()
    {
        $id_contenedor = $_GET['id_contenedor'];
        $this->model->reingresarContenedor($id_contenedor);
        $data = $this->model->selectContenedor();
        header('location: ' . base_url() . 'Contenedor/Listar');
        //$this->views->getView($this, "Listar", $data);
        die();
    }
}
