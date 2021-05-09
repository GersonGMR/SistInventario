<?php
    class Reportes extends Controllers
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
            $data = $this->model->selectConfiguracion();
            $this->views->getView($this, "Listar", $data, "");
        }
        public function verReporte()
        {
            $alert = $this->model->selectConfiguracion();
            $data = $this->model->ListaCompras();
            $this->views->getView($this, "VerEntrada", $data, $alert);
        }
        public function verSalida()
        {
            $alert = $this->model->selectConfiguracion();
            $data = $this->model->ListaSalidas();
            $this->views->getView($this, "VerSalida", $data, $alert);
        }
    }
