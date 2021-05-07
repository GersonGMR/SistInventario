<?php
    class Configuracion extends Controllers
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
            $this->views->getView($this, "VerConfiguracion", $data, $alert);
        }
    }
