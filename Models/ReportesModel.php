<?php
class ReportesModel extends Mysql
{
    public $id;
    public $ruc;
    public $nombre;
    public $telefono;
    public $direccion;
    public $razon;
    public function __construct()
    {
        parent::__construct();
    }
    public function selectConfiguracion()
    {
        $sql = "SELECT * FROM configuracion";
        $res = $this->select($sql);
        return $res;
    }
    public function actualizarConfiguracion(String $ruc, string $nombre, string $telefono, string $direccion, string $razon, int $id)
    {
        $return = "";
        $this->ruc = $ruc;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->razon = $razon;
        $this->id = $id;
        $query = "UPDATE configuracion SET ruc=?, nombre=?, telefono=?, direccion=?, razon=? WHERE id=?";
        $data = array($this->ruc, $this->nombre, $this->telefono, $this->direccion, $this->razon ,$this->id);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
    public function ListaCompras()
    {
        $sql = "SELECT * FROM detalle_compra";
        $res = $this->select_all($sql);
        return $res;
    }
    public function ListaSalidas()
    {
        $sql = "SELECT * FROM detalle_venta";
        $res = $this->select_all($sql);
        return $res;
    }
    public function ListaProductos()
    {
        $sql = "SELECT * FROM productos";
        $res = $this->select_all($sql);
        return $res;
    }
}
