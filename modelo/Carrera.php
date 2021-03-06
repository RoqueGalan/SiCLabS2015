<?php

class Carrera extends Modelo {

    private $_Id;
    private $_Nombre;
    private $_Siglas;

    function __construct() {
        parent::__construct();
    }

    function getSiglas() {
        return $this->_Siglas;
    }

    function setSiglas($Siglas) {
        $this->_Siglas = $Siglas;
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
        $tempLista = $this->_db->select('SELECT * FROM Carrera ORDER BY `Nombre` ASC');

        //crear una lista de objetos, para su facil extracion en las vistas
        foreach ($tempLista as $temp) {
            $carrera = new Carrera();
            $carrera->setId($temp['Id']);
            $carrera->setNombre($temp['Nombre']);
            $carrera->setSiglas($temp['Siglas']);

            $lista[] = $carrera;
        }

        return $lista;
    }

    public function existe($nombre) {
        $temp = $this->_db->select("SELECT Id FROM Carrera WHERE `Nombre` = '{$nombre}' LIMIT 1");

        if (count($temp)) {
            //existe verdadero
            return $temp[0]['Id'];
        } else {
            return 0;
        }
    }

    public function buscar($id) {
        $temp = $this->_db->select("SELECT * FROM Carrera WHERE`Id` = {$id} LIMIT 1");

        if (count($temp)) {
            $this->setId($temp[0]['Id']);
            $this->setNombre($temp[0]['Nombre']);
            $this->setSiglas($temp[0]['Siglas']);
        } else {
            $this->setId(-1);
        }

        return $this;
    }

    public function insertar() {
        $parametros = array(
            'Nombre' => $this->getNombre(),
            'Siglas' => $this->getSiglas()
        );

        return $this->_db->insert('Carrera', $parametros);
    }

    public function actualizar() {
        $parametros = array(
            'Nombre' => $this->getNombre(),
            'Siglas' => $this->getSiglas()
        );
        $donde = "`Id` = '{$this->getId()}'";

        $this->_db->update('Carrera', $parametros, $donde);
    }

    public function eliminar($id) {
        $this->_db->delete('Carrera', "`Id` = {$id}");
    }

}
