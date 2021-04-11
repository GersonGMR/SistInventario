<?php
class Familias extends Controllers
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
        $data = $this->model->selectFamilias();
        $this->views->getView($this, "Listar", $data, "");
    }
    public function eliminados()
    {
        $data = $this->model->selectFamiliasInactivos();
        $this->views->getView($this, "Eliminados", $data, "");
    }
    public function insertar()
    {
        $nombre = $_POST['nombre'];
        $insert = $this->model->insertarFamilias($nombre);
        if ($insert > 0) {
            $alert = 'registrado';
        } else if ($insert == 'existe') {
            $alert = 'existe';
        } else {
            $alert = 'error';
        }
        $this->model->selectFamilias();
        header("location: " . base_url() . "Familias/Listar?msg=$alert");
        die();
    }
    public function editar()
    {
        $id_familia = $_GET['id_familia'];
        $data = $this->model->editarFamilias($id_familia);
        if ($data == 0) {
            $this->Listar();
        } else {
            $this->views->getView($this, "Editar", $data);
        }
    }
    public function actualizar()
    {
        $id_familia = $_POST['id_familia'];
        $nombre = $_POST['nombre'];
        $actualizar = $this->model->actualizarFamilias($nombre, $id_familia);
        if ($actualizar == 1) {
            $alert =  'modificado';
        } else {
            $alert = 'error';
        }
        header("location: " . base_url() . "Familias/Listar?msg=$alert");
        die();
    }
    public function eliminar()
    {
        $id_familia = $_GET['id_familia'];
        $eliminar = $this->model->eliminarFamilias($id_familia);
        $data = $this->model->selectFamilias();
        header('location: ' . base_url() . 'Familias/Listar');
        //$this->views->getView($this, "Listar", $data, $eliminar);
        die();
    }
    public function reingresar()
    {
        $id_familia = $_GET['id_familia'];
        $this->model->reingresarFamilias($id_familia);
        $data = $this->model->selectFamilias();
        header('location: ' . base_url() . 'Familias/Listar');
        //$this->views->getView($this, "Listar", $data);
        die();
    }
}
?>
