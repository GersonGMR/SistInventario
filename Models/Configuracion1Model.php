<?php
class Configuracion1Model extends Mysql
{
    public $id;
    public $ruc;
    public $nombre;
    public $telefono;
    public $direccion;
    public $autoriza;
    public $entrega;
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
    public function actualizarConfiguracion(String $ruc, string $nombre, string $telefono, string $direccion, string $razon, string $autoriza, string $entrega, int $id)
    {
        $return = "";
        $this->ruc = $ruc;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->razon = $razon;
        $this->autoriza = $autoriza;
        $this->entrega = $entrega;
        $this->id = $id;
        $query = "UPDATE configuracion SET ruc=?, nombre=?, telefono=?, direccion=?, razon=?, autoriza=?, entrega=? WHERE id=?";
        $data = array($this->ruc, $this->nombre, $this->telefono, $this->direccion, $this->razon ,$this->autoriza ,$this->entrega ,$this->id);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
}
