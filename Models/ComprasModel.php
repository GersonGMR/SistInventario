<?php
class ComprasModel extends Mysql
{
    public $id;
    public $id_compra ;
    public $codigo;
    public $nombre;
    public $cantidad;
    public $precio;
    public $id_producto ;
    public $id_usuario;
    public $total;
    public function __construct()
    {
        parent::__construct();
    }
    public function selectCompras()
    {
        $sql = "SELECT * FROM compras WHERE estado = 1";
        $res = $this->select_all($sql);
        return $res;
    }
    public function selectDetalle()
    {
        $sql = "SELECT * FROM detalle_temp WHERE id_usuario = $_SESSION[id]";
        $res = $this->select_all($sql);
        return $res;
    }
    public function insertarDetalle(String $nombre, string $cantidad, string $precio, string $total, string $id_producto, string $id_usuario)
    {
        $return = "";
        $this->nombre = $nombre;
        $this->cantidad = $cantidad;
        $this->precio = $precio;
        $this->total = $total;
        $this->id_producto = $id_producto;
        $this->id_usuario = $id_usuario;

        $query = "INSERT INTO detalle_temp(nombre, cantidad, precio, total, id_producto ,id_usuario) VALUES (?,?,?,?,?,?)";
        $data = array($this->nombre,$this->cantidad, $this->precio, $this->total,$this->id_producto,$this->id_usuario);
        $resul = $this->insert($query, $data);
        $return = $resul;
        return $return;
    }
    public function buscarProducto(string $codigo)
    {
        $this->codigo = $codigo;
        $sql = "SELECT * FROM productos WHERE codigo = '{$this->codigo}' AND estado = 1";
        $res = $this->select($sql);
        if (empty($res)) {
            $res = 0;
        }
        return $res;
    }
    public function actualizarCompras(String $codigo, string $nombre, string $cantidad, string $precio, int $id)
    {
        $return = "";
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->cantidad = $cantidad;
        $this->precio = $precio;
        $this->id = $id;
        $query = "UPDATE compras SET codigo=?, nombre=?, cantidad=?, precio=? WHERE id=?";
        $data = array($this->codigo, $this->nombre, $this->cantidad, $this->precio, $this->id);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
    public function buscarProductoexiste($id_producto, $id_usuario)
    {
        $query = "SELECT * FROM detalle_temp WHERE id_usuario = '{$id_usuario}' AND id_producto = '{$id_producto}'";
        $resul = $this->select($query);
        return $resul;
    }
    public function actualizarCantidad(int $cantidad, String $total, int $id)
    {
        $this->cantidad = $cantidad;
        $this->total = $total;
        $this->id = $id;
        $query = "UPDATE detalle_temp SET cantidad =?, total =? WHERE id =?";
        $data = array($this->cantidad, $this->total ,$this->id);
        $resul = $this->update($query, $data);
        return $resul;
    }
    public function verificarProductos($id_usuario)
    {
        $query = "SELECT * FROM detalle_temp WHERE id_usuario = '{$id_usuario}'";
        $resul = $this->select_all($query);
        return $resul;
    }
    public function stockActual($id_producto)
    {
        $query = "SELECT cantidad FROM productos WHERE id = '{$id_producto}'";
        $resul = $this->select($query);
        return $resul;
    }
    public function buscaridC()
    {
        $sql = "SELECT MAX(id) from compras";
        $res = $this->select($sql);
        return $res;
    }
    public function registrarCompra(String $regitrador_entr, String $total)
    {
        $return = "";
        $this->registrador_entr = $regitrador_entr;
        $this->total = $total;
        $query = "INSERT INTO compras(registrador_entr,total) VALUES (?,?)";
        $data = array($this->registrador_entr, $this->total);
        $resul = $this->insert($query, $data);
        $return = $resul;
        return $return;
    }


    public function registrarDetalle(String $id_compra, string $nombre, string $id_producto, string $cantidad, string $precio, $id_usuario)
    {
        $return = "";
        $this->id_compra = $id_compra;
        $this->id_producto = $id_producto;
        $this->cantidad = $cantidad;
        $this->precio = $precio;
        $this->id_usuario = $id_usuario;
        $this->nombre = $nombre;

        $query = "INSERT INTO detalle_compra(id_compra,producto,id_producto ,cantidad, precio,id_usuario) VALUES (?,?,?,?,?,?)";
        $data = array($this->id_compra,$this->nombre, $this->id_producto, $this->cantidad, $this->precio, $this->id_usuario);
        $resul = $this->insert($query, $data);
        $return = $resul;
        return $return;
    }
    public function ListaCompras(int $id_compra)
    {
        $sql = "SELECT * FROM detalle_compra WHERE id_compra = '{$id_compra}'";
        $res = $this->select_all($sql);
        return $res;
    }
    public function registrarStock(int $cantidad, int $id)
    {
        $this->cantidad = $cantidad;
        $this->id = $id;
        $query = "UPDATE productos SET cantidad =? WHERE id =?";
        $data = array($this->cantidad, $this->id);
        $resul = $this->update($query, $data);
        return $resul;
    }
    public function selectConfiguracion()
    {
        $sql = "SELECT * FROM configuracion";
        $res = $this->select($sql);
        return $res;
    }
    public function VaciarCompra(string $id_usuario)
    {
        $this->id = $id_usuario;
        $sql = "DELETE FROM detalle_temp WHERE id_usuario = $id_usuario";
        $resul = $this->delete($sql);
    }
}
