<?php

class Equipo extends Modelo {

    private $_Id;
    private $_Nombre;
    private $_Marca;
    private $_Modelo;
    private $_NoSerie;
    private $_Condicion;
    private $_Caracteristicas;
    private $_CantidadTotal;
    private $_CantidadDisponible;
    private $_CodigoNacion;
    private $_CodigoUaem;
    private $_Imagen;
    private $_Documento;
    private $_Oculto;
    private $_Espacio;
    public $_rutaImg = 'public/img/equipo/';
    public $_rutaDoc = 'public/docx/equipo/';

    function __construct() {
        parent:: __construct();
        $this->_Espacio = new Espacio();
    }

    function getEspacio() {
        return $this->_Espacio;
    }

    function setEspacio($Espacio) {
        $this->_Espacio = $Espacio;
    }

    function getId() {
        return $this->_Id;
    }

    function getNombre() {
        return $this->_Nombre;
    }

    function getMarca() {
        return $this->_Marca;
    }

    function getModelo() {
        return $this->_Modelo;
    }

    function getNoSerie() {
        return $this->_NoSerie;
    }

    function getCondicion() {
        return $this->_Condicion;
    }

    function getCaracteristicas() {
        return $this->_Caracteristicas;
    }

    function getCantidadTotal() {
        return $this->_CantidadTotal;
    }

    function getCantidadDisponible() {
        return $this->_CantidadDisponible;
    }

    function getCodigoNacion() {
        return $this->_CodigoNacion;
    }

    function getCodigoUaem() {
        return $this->_CodigoUaem;
    }

    function getImagen() {
        return $this->_Imagen;
    }

    function getDocumento() {
        return $this->_Documento;
    }

    function getOculto() {
        return $this->_Oculto;
    }

    function getRutaImg() {
        return $this->_rutaImg;
    }

    function getRutaDoc() {
        return $this->_rutaDoc;
    }

    function setId($Id) {
        $this->_Id = $Id;
    }

    function setNombre($Nombre) {
        $this->_Nombre = $Nombre;
    }

    function setMarca($Marca) {
        $this->_Marca = $Marca;
    }

    function setModelo($Modelo) {
        $this->_Modelo = $Modelo;
    }

    function setNoSerie($NoSerie) {
        $this->_NoSerie = $NoSerie;
    }

    function setCondicion($Condicion) {
        $this->_Condicion = $Condicion;
    }

    function setCaracteristicas($Caracteristicas) {
        $this->_Caracteristicas = $Caracteristicas;
    }

    function setCantidadTotal($CantidadTotal) {
        $this->_CantidadTotal = $CantidadTotal;
    }

    function setCantidadDisponible($CantidadDisponible) {
        $this->_CantidadDisponible = $CantidadDisponible;
    }

    function setCodigoNacion($CodigoNacion) {
        $this->_CodigoNacion = $CodigoNacion;
    }

    function setCodigoUaem($CodigoUaem) {
        $this->_CodigoUaem = $CodigoUaem;
    }

    function setImagen($Imagen) {
        $this->_Imagen = $Imagen;
    }

    function setDocumento($Documento) {
        $this->_Documento = $Documento;
    }

    function setOculto($Oculto) {
        $this->_Oculto = $Oculto;
    }

    // ------------------- metodos de la bd ----------------------
    public function lista($espacioId, $where = '') {
        $lista = array();
        $tempLista = $this->_db->select("SELECT * FROM Equipo WHERE `EspacioId` = {$espacioId} {$where} ORDER BY `Nombre` ASC");

        //crear una lista de objetos, para su facil extracion en las vistas
        foreach ($tempLista as $temp) {
            $equipo = new Equipo();
            $equipo->setId($temp['Id']);
            $equipo->setNombre($temp['Nombre']);
            $equipo->setMarca($temp['Marca']);
            $equipo->setModelo($temp['Modelo']);
            $equipo->setNoSerie($temp['NoSerie']);
            $equipo->setCondicion($temp['Condicion']);
            $equipo->setCaracteristicas($temp['Caracteristicas']);
            $equipo->setCantidadTotal($temp['CantidadTotal']);
            $equipo->setCantidadDisponible($temp['CantidadDisponible']);
            $equipo->setCodigoNacion($temp['CodigoNacion']);
            $equipo->setCodigoUaem($temp['CodigoUaem']);
            $equipo->setImagen($temp['Imagen']);
            $equipo->setDocumento($temp['Documento']);
            $equipo->setOculto($temp['Oculto']);
            $equipo->getEspacio()->buscar($temp['EspacioId']);

            $lista[] = $equipo;
        }

        return $lista;
    }

    public function buscar($id) {
        $temp = $this->_db->select("SELECT * FROM Equipo WHERE `Id` = '{$id}' LIMIT 1");

        if (count($temp)) {
            $this->setId($temp[0]['Id']);
            $this->setNombre($temp[0]['Nombre']);
            $this->setMarca($temp[0]['Marca']);
            $this->setModelo($temp[0]['Modelo']);
            $this->setNoSerie($temp[0]['NoSerie']);
            $this->setCondicion($temp[0]['Condicion']);
            $this->setCaracteristicas($temp[0]['Caracteristicas']);
            $this->setCantidadTotal($temp[0]['CantidadTotal']);
            $this->setCantidadDisponible($temp[0]['CantidadDisponible']);
            $this->setCodigoNacion($temp[0]['CodigoNacion']);
            $this->setCodigoUaem($temp[0]['CodigoUaem']);
            $this->setImagen($temp[0]['Imagen']);
            $this->setDocumento($temp[0]['Documento']);
            $this->setOculto($temp[0]['Oculto']);
            $this->getEspacio()->buscar($temp[0]['EspacioId']);
        } else {
            $this->setId('-1');
        }

        return $this;
    }

    public function insertar() {
        $parametros = array(
            'Nombre' => $this->getNombre(),
            'Marca' => $this->getMarca(),
            'Modelo' => $this->getModelo(),
            'NoSerie' => $this->getNoSerie(),
            'Condicion' => $this->getCondicion(),
            'Caracteristicas' => $this->getCaracteristicas(),
            'CantidadTotal' => $this->getCantidadTotal(),
            'CantidadDisponible' => $this->getCantidadDisponible(),
            'CodigoNacion' => $this->getCodigoNacion(),
            'CodigoUaem' => $this->getCodigoUaem(),
            'Imagen' => $this->getImagen(),
            'Documento' => $this->getDocumento(),
            'Oculto' => $this->getOculto(),
            'EspacioId' => $this->getEspacio()->getId()
        );

        return $this->_db->insert('Equipo', $parametros);
    }

    public function actualizar() {
        $parametros = array(
            'Nombre' => $this->getNombre(),
            'Marca' => $this->getMarca(),
            'Modelo' => $this->getModelo(),
            'NoSerie' => $this->getNoSerie(),
            'Condicion' => $this->getCondicion(),
            'Caracteristicas' => $this->getCaracteristicas(),
            'CantidadTotal' => $this->getCantidadTotal(),
            'CantidadDisponible' => $this->getCantidadDisponible(),
            'CodigoNacion' => $this->getCodigoNacion(),
            'CodigoUaem' => $this->getCodigoUaem(),
            'Imagen' => $this->getImagen(),
            'Documento' => $this->getDocumento(),
            'Oculto' => $this->getOculto(),
            'EspacioId' => $this->getEspacio()->getId()
        );
        $donde = "`Id` = '{$this->getId()}'";

        $this->_db->update('Equipo', $parametros, $donde);
    }

    public function eliminar($id) {
        $this->_db->delete('Equipo', "`Id` = {$id}");
    }

}
