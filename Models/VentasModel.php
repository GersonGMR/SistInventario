<?php
class VentasModel extends Mysql
{
    public $id;
    public $id_venta;
    public $id_cliente;
    public $codigo;
    public $nombre;
    public $cantidad;
    public $precio;
    public $id_producto ;
    public $id_usuario;
    public $total;
    public $vendedor;
    public function __construct()
    {
        parent::__construct();
    }
    public function selectVentas()
    {
        $sql = "SELECT v.id, v.usuario_vendedor,v.numentrega,v.total,v.fecha,c.nombre,v.id_cliente FROM ventas as v 
        INNER JOIN clientes as c ON v.id_cliente = c.id WHERE v.estado = 1
        ORDER BY v.id DESC";
        $res = $this->select_all($sql);
        return $res;
    }
    public function selectDetalle()
    {
        $sql = "SELECT * FROM detalle_temp WHERE id_usuario = 1";
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
    public function editarEntrega(int $id)
    {
        $this->id = $id;
        $sql = "SELECT v.id,v.usuario_vendedor, v.numentrega,v.total,c.nombre,dv.producto, dv.cantidad FROM ventas as v
        INNER JOIN clientes as c
        ON v.id_cliente = c.id
        INNER JOIN detalle_venta as dv
        ON v.id = dv.id_venta
        WHERE v.id = '{$this->id}'";
        $res = $this->select_all($sql);
        if (empty($res)) {
            $res = 0;
        }
        return $res;
    }
    public function actualizarEntrega(String $numentrega, string $nombre, int $total, int $id)
    {
        $return = "";
        $this->numentrega = $numentrega;
        $this->nombre = $nombre;
        $this->total = $total;
        $this->id = $id;
        $query = "UPDATE ventas SET numentrega=?, nombre=?, total=? WHERE id=?";
        $data = array($this->numentrega, $this->nombre, $this->total, $this->id);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
    public function eliminarEntrega(int $id)
    {
        $return = "";
        $this->id = $id;
        $query = "UPDATE ventas SET estado = 0 WHERE id=?";
        $data = array($this->id);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
    public function buscarProducto(int $codigo)
    {
        $this->codigo = $codigo;
        $sql = "SELECT * FROM productos WHERE codigo = '{$this->codigo}' AND estado = 1";
        $res = $this->select($sql);
        if (empty($res)) {
            $res = 0;
        }
        return $res;
    }
    public function actualizarVentas(String $codigo, string $nombre, string $cantidad, string $precio, int $id)
    {
        $return = "";
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->cantidad = $cantidad;
        $this->precio = $precio;
        $this->id = $id;
        $query = "UPDATE ventas SET codigo=?, nombre=?, cantidad=?, precio=? WHERE id=?";
        $data = array($this->codigo, $this->nombre, $this->cantidad, $this->precio, $this->id);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
    public function eliminarVentas(int $id)
    {
        $this->id = $id;
        $sql = "DELETE FROM detalle_temp WHERE id = $id";
        $resul = $this->delete($sql);
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
    public function verificarTest($idVenta)
    {
        $query = "SELECT * FROM detalle_venta WHERE id_venta = '{$idVenta}'";
        $resul = $this->select_all($query);
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
        $sql = "SELECT MAX(id) from ventas";
        $res = $this->select($sql);
        return $res;
    }
    public function registrarCompra(int $cliente, String $usuario_vendedor, String $total, String $numentrega)
    {
        $return = "";
        $this->id_cliente = $cliente;
        $this->usuario_vendedor = $usuario_vendedor;
        $this->total = $total;
        $this->numentrega = $numentrega;
        $query = "INSERT INTO ventas(id_cliente, usuario_vendedor, total, numentrega) VALUES (?,?,?,?)";
        $data = array($this->id_cliente, $this->usuario_vendedor, $this->total, $this->numentrega);
        $resul = $this->insert($query, $data);
        $return = $resul;
        return $return;
    }

    public function registrarDetalle(String $id_venta, string $nombre, string $id_producto, string $cantidad, string $precio, $id_usuario)
    {
        $return = "";
        $this->id_venta = $id_venta;
        $this->id_producto = $id_producto;
        $this->cantidad = $cantidad;
        $this->precio = $precio;
        $this->id_usuario = $id_usuario;
        $this->nombre = $nombre;

        $query = "INSERT INTO detalle_venta(id_venta,producto,id_producto ,cantidad, precio,id_usuario) VALUES (?,?,?,?,?,?)";
        $data = array($this->id_venta,$this->nombre, $this->id_producto, $this->cantidad, $this->precio, $this->id_usuario);
        $resul = $this->insert($query, $data);
        $return = $resul;
        return $return;
    }
    public function ListaVentas(int $id_venta)
    {
        $sql = "SELECT * FROM detalle_venta WHERE id_venta = $id_venta";
        $res = $this->select_all($sql);
        return $res;
    }
    public function PdfCliente(int $id_cliente)
    {
        $sql = "SELECT * FROM clientes WHERE id = $id_cliente";
        $res = $this->select($sql);
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
    public function selectClientes()
    {
        $sql = "SELECT * FROM clientes WHERE estado = 1";
        $res = $this->select_all($sql);
        return $res;
    }
    public function VaciarCompra(string $id_usuario)
    {
        $this->id = $id_usuario;
        $sql = "DELETE FROM detalle_temp WHERE id_usuario = $id_usuario";
        $resul = $this->delete($sql);
    }
    public function entregadoS(int $id, int $estado)
    {
        $this->id = $id;
        $this->estado = $estado;
        $query = "UPDATE ventas SET estado = ? WHERE id=?";
        $data = array($this->id,$this->estado);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
}
