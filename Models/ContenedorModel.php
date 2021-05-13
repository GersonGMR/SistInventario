<?php
class ContenedorModel extends Mysql
{
    public $id_contenedor;
    public $nombre;
    public $id_familia;
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
    public function insertarContenedor(string $nombre, int $id_familia)
    {
        $return = "";
        $this->nombre = $nombre;
        $this->id_familia = $id_familia;
        $sql = "SELECT * FROM contenedor WHERE nombre = '{$this->nombre}'";
        $result = $this->select_all($sql);
        if (empty($result)) {
            $query = "INSERT INTO contenedor(nombre,id_familia) VALUES (?,?)";
            $data = array($this->nombre,$this->id_familia);
            $resul = $this->insert($query, $data);
            $return = $resul;
        } else {
            $return = "existe";
        }
        return $return;
    }
    public function editarContenedor(int $id_contenedor)
    {
        $this->id_contenedor = $id_contenedor;
        $sql = "SELECT * FROM contenedor WHERE id_contenedor = '{$this->id_contenedor}'";
        $res = $this->select($sql);
        if (empty($res)) {
            $res = 0;
        }
        return $res;
    }
    public function actualizarContenedor(string $nombre, int $id_familia, int $id_contenedor)
    {
        $return = "";
        $this->nombre = $nombre;
        $this->id_familia = $id_familia;
        $this->id_contenedor = $id_contenedor;
        $query = "UPDATE contenedor SET nombre=?,id_familia=? WHERE id_contenedor=?";
        $data = array($this->nombre,$this->id_familia, $this->id_contenedor);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
    public function eliminarContenedor(int $id_contenedor)
    {
        $return = "";
        $this->id_contenedor = $id_contenedor;
        $query = "UPDATE contenedor SET estado = 0 WHERE id_contenedor=?";
        $data = array($this->id_contenedor);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
    public function reingresarContenedor(int $id_contenedor)
    {
        $return = "";
        $this->id_contenedor = $id_contenedor;
        $query = "UPDATE contenedor SET estado = 1 WHERE id_contenedor=?";
        $data = array($this->id_contenedor);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
}
