<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Agentes Model
 * 
 * @package sigep
 * @copyright 2013
 * @version MySql 1.0.0
 * 
 */
class Slider_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    public function obtener($vcBuscar = '', $limit = 0, $offset = 9999999) {
        $sql = 'SELECT *
            FROM rosobe_slider
            WHERE tituloSlider LIKE ? 
            ORDER BY vigenciaHasta ASC  
            limit ? offset ? ;';
        return $this->db->query($sql, array('%' . strtolower((string) $vcBuscar) . '%', (double) $offset, (double) $limit))->result_array();
    }

    public function numRegs($vcBuscar, $area=1, $cargo=0) {
        $sql = 'SELECT count(idSlider) AS inCant FROM rosobe_slider WHERE lower(tituloSlider) LIKE ? ';
        $result = $this->db->query($sql, array(strtolower('%' . strtolower($vcBuscar) . '%')))->result_array();
        return $result[0]['inCant'];
    }

    public function obtenerUno($id) {
        $sql = 'SELECT * FROM rosobe_slider WHERE idSlider = ?;';
        return array_shift($this->db->query($sql, array($id))->result_array());
    }

    public function obtenerUnoSlug($slug) {
        $sql = 'SELECT * FROM rosobe_view_productos WHERE uriProducto = ?;';
        return array_shift($this->db->query($sql, array($slug))->result_array());
    }
    

    public function guardar($aParms) {
        $sql = 'SELECT rosobe_sp_slider_guardar(?, ?, ?, ?, ?, ?, ?, ?) AS result;';
        $result = $this->db->query($sql, $aParms)->result_array();
        return $result[0]['result'];
    }

    public function obtenerImagenes($id) {
        $sql = 'SELECT * FROM rosobe_productos_imagenes WHERE idProducto = ?;';
        return $this->db->query($sql, (int) $id)->result_array();
    }

    public function guardarImagen($aParms) {
        $sql = 'SELECT rosobe_sp_productos_imagenes_guardar(?, ?, ?, ?) AS result;';
        $result = $this->db->query($sql, $aParms)->result_array();
        return $result[0]['result'];
    }

    public function eliminar($id) {
        $sql = 'SELECT ufn30tsisprovinciasborrar(?) AS result;';
        $result = $this->db->query($sql, array($id))->result_array();
        return $result[0]['result'];
    }
    public function dropdownProductos() {
        $sql = 'SELECT * FROM diario_view_productos';
        $query = $this->db->query($sql)->result();
        $subgrupos[0] = 'Seleccione un producto ...';
        foreach($query as $row) {
            $subgrupos[$row->idProducto] = $row->nombreProducto;
        }
        return $subgrupos;
    }
}

// EOF provincias_model.php