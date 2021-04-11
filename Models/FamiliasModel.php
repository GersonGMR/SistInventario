<?php
class FamiliasModel extends Mysql{
    public $id_familia, $nombre;
    public function __construct()
    {
        parent::__construct();
    }
    public function selectFamilias()
    {
        $sql = "SELECT * FROM familia WHERE estado = 1";
        $res = $this->select_all($sql);
        return $res;
    }
    public function selectFamiliasInactivos()
    {
        $sql = "SELECT * FROM familia WHERE estado = 0";
        $res = $this->select_all($sql);
        return $res;
    }
    public function insertarFamilias(string $nombre)
    {
        $return = "";
        $this->nombre = $nombre;
        $sql = "SELECT * FROM productos WHERE nombre = '{$this->nombre}'";
        $result = $this->select_all($sql);
        if (empty($result)) {
            $query = "INSERT INTO familia(nombre) VALUES (?)";
            $data = array($this->nombre);
            $resul = $this->insert($query, $data);
            $return = $resul;
        }else {
            $return = "existe";
        }
        return $return;
    }
    public function editarFamilias(int $id_familia)
    {
        $this->id_familia = $id_familia;
        $sql = "SELECT * FROM familia WHERE id_familia = '{$this->id_familia}'";
        $res = $this->select($sql);
        if (empty($res)) {
            $res = 0;
        }
        return $res;
    }
    public function actualizarFamilias(string $nombre, int $id_familia)
    {
        $return = "";
        $this->nombre = $nombre;
        $this->id_familia = $id_familia;
        $query = "UPDATE familia SET nombre=? WHERE id_familia=?";
        $data = array($this->nombre, $this->id_familia);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
    public function eliminarFamilias(int $id_familia)
    {
        $return = "";
        $this->id_familia = $id_familia;
        $query = "UPDATE familia SET estado = 0 WHERE id_familia=?";
        $data = array($this->id_familia);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
    public function reingresarFamilias(int $id_familia)
    {
        $return = "";
        $this->id_familia = $id_familia;
        $query = "UPDATE familia SET estado = 1 WHERE id_familia=?";
        $data = array($this->id_familia);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
}
?>
