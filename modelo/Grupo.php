<?php

class Grupo extends Modelo {

    private $_Id;
    private $_Nombre;

    function __construct() {
        parent::__construct();
    }

    function getId() {
        return $this->_Id;
    }

    function getNombre() {
        return $this->_Nombre;
    }

    function setId($Id) {
        $this->_Id = $Id;
    }

    function setNombre($Nombre) {
        $this->_Nombre = $Nombre;
    }

    public function lista() {
        $lista = array();
        $tempLista = $this->_db->select('SELECT * FROM Grupo ORDER BY `Nombre` ASC');

        //crear una lista de objetos, para su facil extracion en las vistas
        foreach ($tempLista as $temp) {
            $grupo = new Grupo();
            $grupo->setId($temp['Id']);
            $grupo->setNombre($temp['Nombre']);

            $lista[] = $grupo;
        }

        return $lista;
    }

    public function existe($nombre) {
        $temp = $this->_db->select("SELECT Id FROM Grupo WHERE `Nombre` = '{$nombre}' LIMIT 1");

        if (count($temp)) {
            //existe verdadero
            return $temp[0]['Id'];
        } else {
            return 0;
        }
    }

    public function buscar($id) {
        $temp = $this->_db->select("SELECT * FROM Grupo WHERE`Id` = {$id} LIMIT 1");

        if (count($temp)) {
            $this->setId($temp[0]['Id']);
            $this->setNombre($temp[0]['Nombre']);
        } else {
            $this->setId(-1);
        }

        return $this;
    }

    public function insertar() {
        $parametros = array(
            'Nombre' => $this->getNombre()
        );

        return $this->_db->insert('Grupo', $parametros);
    }

    public function actualizar() {
        $parametros = array(
            'Nombre' => $this->getNombre()
        );
        $donde = "`Id` = '{$this->getId()}'";

        $this->_db->update('Grupo', $parametros, $donde);
    }

    public function eliminar($id) {
        $this->_db->delete('Grupo', "`Id` = {$id}");
    }

}
