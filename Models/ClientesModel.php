<?php
class ClientesModel extends Mysql
{
    public $id;
    public $ruc;
    public $nombre;
    public $telefono;
    public $dui;
    public $direccion;
    public $representante;
    public $cant_ninios;
    public $id_frecuencia;
    public $ingreso_beneficiario ;
    public function __construct()
    {
        parent::__construct();
    }
    public function selectClientes()
    {
        $sql = "SELECT clientes.id, clientes.ruc, clientes.nombre, clientes.direccion, clientes.telefono, clientes.dui, clientes.representante, clientes.cant_ninios, clientes.id_frecuencia,
        clientes.ingreso_beneficiario, clientes.estado, frecuencia.descripcion
        FROM clientes
        INNER JOIN frecuencia
        ON  clientes.id_frecuencia =  frecuencia.id
        WHERE clientes.estado = 1";
        $res = $this->select_all($sql);
        return $res;
    }
    public function selectClientesInactivos()
    {
        $sql = "SELECT * FROM clientes WHERE estado = 0";
        $res = $this->select_all($sql);
        return $res;
    }
    public function BuscarCliente(string $ruc)
    {
        $this->ruc = $ruc;
        $sql = "SELECT * FROM clientes WHERE ruc = '{$this->ruc}' AND estado = 1";
        $res = $this->select($sql);
        return $res;
    }
    public function insertarClientes(String $ruc, string $nombre, string $telefono, string $dui, string $direccion, string $representante, string $cant_ninios, string $id_frecuencia, string $ingreso_beneficiario)
    {
        $return = "";
        $this->ruc = $ruc;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->dui = $dui;
        $this->direccion = $direccion;
        $this->representante = $representante;
        $this->cant_ninios = $cant_ninios;
        $this->id_frecuencia = $id_frecuencia;
        $this->ingreso_beneficiario = $ingreso_beneficiario;
        $sql = "SELECT * FROM clientes WHERE ruc = '{$this->ruc}'";
        $result = $this->select_all($sql);
        if (empty($result)) {
            $query = "INSERT INTO clientes(ruc, nombre, telefono, dui, direccion, representante, cant_ninios, id_frecuencia, ingreso_beneficiario) VALUES (?,?,?,?,?,?,?,?,?)";
            $data = array($this->ruc, $this->nombre, $this->telefono, $this->dui, $this->direccion, $this->representante, $this->cant_ninios, $this->id_frecuencia, $this->ingreso_beneficiario);
            $resul = $this->insert($query, $data);
            $return = $resul;
        } else {
            $return = "existe";
        }
        return $return;
    }
    public function editarClientes(int $id)
    {
        $this->id = $id;
        $sql = "SELECT c.id, c.ruc, c.nombre, c.direccion, c.telefono, c.dui, c.representante, c.cant_ninios, c.id_frecuencia, c.ingreso_beneficiario, f.descripcion
        FROM clientes as c
        INNER JOIN frecuencia as f
        ON c.id_frecuencia = f.id
        WHERE c.id = '{$this->id}'";
        $res = $this->select($sql);
        if (empty($res)) {
            $res = 0;
        }
        return $res;
    }
    public function actualizarClientes(String $ruc, string $nombre, string $telefono, string $dui, string $direccion, string $representante, string $cant_ninios, string $id_frecuencia, string $ingreso_beneficiario, int $id)
    {
        $return = "";
        $this->ruc = $ruc;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->dui = $dui;
        $this->direccion = $direccion;
        $this->representante = $representante;
        $this->cant_ninios = $cant_ninios;
        $this->id_frecuencia = $id_frecuencia;
        $this->ingreso_beneficiario = $ingreso_beneficiario;
        $this->id = $id;
        $query = "UPDATE clientes SET ruc=?, nombre=?, telefono=?, dui=?, direccion=?, representante=?, cant_ninios=?, id_frecuencia=?, ingreso_beneficiario=? WHERE id=?";
        $data = array($this->ruc, $this->nombre, $this->telefono, $this->dui, $this->direccion, $this->representante, $this->cant_ninios, $this->id_frecuencia, $this->ingreso_beneficiario, $this->id);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
    public function eliminarClientes(int $id)
    {
        $return = "";
        $this->id = $id;
        $query = "UPDATE clientes SET estado = 0 WHERE id=?";
        $data = array($this->id);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
    public function reingresarClientes(int $id)
    {
        $return = "";
        $this->id = $id;
        $query = "UPDATE clientes SET estado = 1 WHERE id=?";
        $data = array($this->id);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
}
