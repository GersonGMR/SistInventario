<?php
class ContenedorModel extends Mysql
{
    public $id;
    public $nombre;
    public function __construct()
    {
        parent::__construct();
    }
    public function selectContenedor()
    {
        $sql = "SELECT * FROM contenedor WHERE estado = 1";
        $res = $this->select_all($sql);
        return $res;
    }
    public function selectContenedorInactivos()
    {
        $sql = "SELECT * FROM contenedor WHERE estado = 0";
        $res = $this->select_all($sql);
        return $res;
    }
    public function insertarContenedor(string $nombre, string $registrador)
    {
        $return = "";
        $this->nombre = $nombre;
        $this->registrador = $registrador;
        $sql = "SELECT * FROM contenedor WHERE nombre = '{$this->nombre}'";
        $result = $this->select_all($sql);
        if (empty($result)) {
            $query = "INSERT INTO contenedor(nombre, registrador) VALUES (?,?)";
            $data = array($this->nombre, $this->registrador);
            $resul = $this->insert($query, $data);
            $return = $resul;
        } else {
            $return = "existe";
        }
        return $return;
    }
    public function editarContenedor(int $id)
    {
        $this->id = $id;
        $sql = "SELECT * FROM contenedor WHERE id = '{$this->id}'";
        $res = $this->select($sql);
        if (empty($res)) {
            $res = 0;
        }
        return $res;
    }
    public function actualizarContenedor(string $nombre, int $id)
    {
        $return = "";
        $this->nombre = $nombre;
        $this->id_familia = $id_familia;
        $this->id = $id;
        $query = "UPDATE contenedor SET nombre=? WHERE id=?";
        $data = array($this->nombre, $this->id);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
    public function eliminarContenedor(int $id)
    {
        $return = "";
        $this->id = $id;
        $query = "UPDATE contenedor SET estado = 0 WHERE id=?";
        $data = array($this->id);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
    public function reingresarContenedor(int $id)
    {
        $return = "";
        $this->id = $id;
        $query = "UPDATE contenedor SET estado = 1 WHERE id=?";
        $data = array($this->id);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
}
