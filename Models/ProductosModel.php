<?php
class ProductosModel extends Mysql{
    public $id, $codigo, $nombre, $cantidad, $medida;
    public function __construct()
    {
        parent::__construct();
    }
    public function selectProductos()
    {
        $sql = "SELECT * FROM productos WHERE estado = 1";
        $res = $this->select_all($sql);
        return $res;
    }
    public function selectProductosInactivos()
    {
        $sql = "SELECT * FROM productos WHERE estado = 0";
        $res = $this->select_all($sql);
        return $res;
    }
    public function insertarProductos(String $codigo, string $nombre, string $medida)
    {
        $return = "";
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->medida = $medida;
        $sql = "SELECT * FROM productos WHERE codigo = '{$this->codigo}'";
        $result = $this->select_all($sql);
        if (empty($result)) {
            $query = "INSERT INTO productos(codigo, nombre, medida) VALUES (?,?,?)";
            $data = array($this->codigo, $this->nombre, $this->medida);
            $resul = $this->insert($query, $data);
            $return = $resul;
        }else {
            $return = "existe";
        }
        return $return;
    }
    public function editarProductos(int $id)
    {
        $this->id = $id;
        $sql = "SELECT * FROM productos WHERE id = '{$this->id}'";
        $res = $this->select($sql);
        if (empty($res)) {
            $res = 0;
        }
        return $res;
    }
    public function actualizarProductos(String $codigo, string $nombre, string $cantidad, string $medida, int $id)
    {
        $return = "";
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->cantidad = $cantidad;
        $this->medida = $medida;
        $this->id = $id;
        $query = "UPDATE productos SET codigo=?, nombre=?, cantidad=?, medida=? WHERE id=?";
        $data = array($this->codigo, $this->nombre, $this->cantidad, $this->medida, $this->id);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
    public function eliminarProductos(int $id)
    {
        $return = "";
        $this->id = $id;
        $query = "UPDATE productos SET estado = 0 WHERE id=?";
        $data = array($this->id);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
    public function reingresarProductos(int $id)
    {
        $return = "";
        $this->id = $id;
        $query = "UPDATE productos SET estado = 1 WHERE id=?";
        $data = array($this->id);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
}
?>
