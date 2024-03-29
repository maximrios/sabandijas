<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Productos extends Ext_crud_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('sabandijas/productos_model', 'productos');
        $this->load->model('sabandijas/categorias_model', 'categorias');
        $this->load->library('gridview');
        $this->load->library('Messages');
        $this->load->helper('utils_helper');
        $this->_aReglas = array(
            array(
                'field'   => 'idProducto',
                'label'   => 'Codigo de Producto',
                'rules'   => 'trim|max_length[80]|xss_clean'
            )
            ,array(
                'field'   => 'nombreProducto',
                'label'   => 'Nombre del Producto',
                'rules'   => 'trim|xss_clean|required|strtoupper'
            )
            ,array(
                'field'   => 'descripcionProducto',
                'label'   => 'Descripcion del Producto',
                'rules'   => 'trim|xss_clean'
            )
        );
    }
    protected function _inicReg($boIsPostBack=false) {
        $this->_reg = array(
            'idProducto' => null
            ,'nombreProducto' => null
            , 'descripcionProducto' => null
        );
        $id = ($this->input->post('idProducto')!==false)? $this->input->post('idProducto'):0;
        if($id!=0 && !$boIsPostBack) {
            $this->_reg = $this->productos->obtenerUno($id);
        } 
        else {
            $this->_reg = array(
                'idProducto' => $id
                , 'nombreProducto' => set_value('nombreProducto')
                , 'descripcionProducto' => set_value('descripcionProducto')
            );          
        }
        return $this->_reg;
    }
    protected function _inicReglas() {
        $val = $this->form_validation->set_rules($this->_aReglas);
    }
    function index() {
        $this->_vcContentPlaceHolder = $this->load->view('administrator/rosobe/productos/principal', array(), true);
        parent::index();
    }
    public function listado() {
        $vcBuscar = ($this->input->post('vcBuscar') === FALSE) ? '' : $this->input->post('vcBuscar');
        $this->gridview->initialize(
                array(
                    'sResponseUrl' => 'administrator/productos/listado'
                    , 'iTotalRegs' => $this->productos->numRegs($vcBuscar)
                    , 'iPerPage' => ($this->input->post('per_page')==FALSE)? 10: $this->input->post('per_page')
                    , 'border' => FALSE
                    , 'sFootProperties' => 'class="paginador"'
                    , 'titulo' => 'Listado de Productos'
                    , 'identificador' => 'idProducto'
                )
        );
        $this->gridview->addColumn('idProducto', '#', 'int');
        $this->gridview->addColumn('nombreProducto', 'Nombre', 'text');
        $this->gridview->addColumn('descripcionProducto', 'Descripcion', 'text');
        $this->gridview->addParm('vcBuscar', $this->input->post('vcBuscar'));
        $controles = '&nbsp;<a href="administrator/productos/formulario/{idProducto}" title="Editar {nombreProducto}" 
        class="btn-accion" rel="{\'idProducto\': {idProducto}}">&nbsp;<span class="glyphicon glyphicon-search"></span>&nbsp;</a>';
        $controles .= '<a href="administrator/productos/formulario/{idProducto}" title="Mostrar detalle de {nombreProducto}" class="btn-accion" rel="{\'idProducto\': {idProducto}}">&nbsp;<span class="glyphicon glyphicon-pencil"></span>&nbsp;</a>';
        $controles .= '<a href="administrator/productos/formulario/{idProducto}" title="Mostrar detalle de {nombreProducto}" class="btn-accion" rel="{\'idProducto\': {idProducto}}">&nbsp;<span class="glyphicon glyphicon-trash"></span>&nbsp;</a>';
        $this->gridview->addControl('inIdFaqCtrl', array('face' => $controles, 'class' => 'acciones', 'style' => 'width:64px;'));
        $this->_rsRegs = $this->productos->obtener($vcBuscar, $this->gridview->getLimit1(), $this->gridview->getLimit2());
        $this->load->view('administrator/sabandijas/productos/listado'
            , array(
                'vcGridView' => $this->gridview->doXHtml($this->_rsRegs)
                , 'vcMsjSrv' => $this->_aEstadoOper['message']
                , 'txtvcBuscar' => $vcBuscar
            )
        );
    }
    function consulta() {
        echo "macondo";
    }
    function buscador() {
        $aData['Reg'] = $this->_inicReg($this->input->post('vcForm'));
        $aData['vcFrmAction'] = 'administrator/productos/guardar';
        $aData['vcMsjSrv'] = $this->_aEstadoOper['message'];
        $aData['vcAccion'] = ($this->_reg['idproducto'] > 0) ? 'Modificar' : 'Agregar';
        $this->load->view('administrator/sigep/productos/buscador', $aData);
    }
    function formulario() {
        $aData['Reg'] = $this->_inicReg($this->input->post('vcForm'));
        $aData['vcFrmAction'] = 'administrator/productos/guardar';
        $aData['vcMsjSrv'] = $this->_aEstadoOper['message'];
        $aData['vcAccion'] = ($this->_reg['idProducto'] > 0) ? 'Modificar' : 'Agregar';
        if($this->_reg['idProducto'] > 0) {
            $aData['imagenes'] = $this->productos->obtenerImagenes($this->_reg['idProducto']);
            $aData['colores'] = $this->productos->obtenerColores();
            $aData['categorias'] = $this->categorias->obtenerCategoriasProducto($this->_reg['idProducto']);
        }
        else {
            $aData['imagenes'] = FALSE;
            $aData['colores'] = $this->productos->obtenerColores();
            $aData['categorias'] = $this->categorias->obtenerCategoriasProducto();
        }
        $this->load->view('administrator/sabandijas/productos/formulario', $aData);
    }
    function guardar() {
        antibotCompararLlave($this->input->post('vcForm'));
        $this->_inicReglas();
        if ($this->_validarReglas()) {
            $this->_inicReg((bool) $this->input->post('vcForm'));
            $this->_aEstadoOper['status'] = $this->productos->guardar(
                array(
                    ($this->_reg['idProducto'] != '' && $this->_reg['idProducto'] != 0)? $this->_reg['idProducto'] : 0
                    , $this->_reg['nombreProducto']
                    , $this->_reg['descripcionProducto']
                    , url_title(strtolower($this->_reg['nombreProducto']))
                )
            );
            /*
             * Aca comienza el codigo del do_upload que posteriormente deberia de hacerlo mas generico.
             */
            $band = TRUE;
            $cant = count($_FILES['userfile']['name']);
            $config['upload_path'] = 'assets/images/productos/';
            $config['allowed_types'] = 'jpg';
            $config['max_size'] = '30000';
            $this->load->library('upload', $config);
            $this->load->library('image_lib');
            $upload_files = $_FILES;
            for($i = 0; $i < count($upload_files['userfile']['name']); $i++) {
                $_FILES['userfile'] = array(
                    'name' => $upload_files['userfile']['name'][$i],
                    'type' => $upload_files['userfile']['type'][$i],
                    'tmp_name' => $upload_files['userfile']['tmp_name'][$i],
                    'error' => $upload_files['userfile']['error'][$i],
                    'size' => $upload_files['userfile']['size'][$i]
                );
                if ( ! $this->upload->do_upload()) {
                    $error = array('error' => $this->upload->display_errors());
                    $this->_aEstadoOper['message'] = $error;
                } 
                else {
                    $data = $this->upload->data();
                    //$configa['image_library'] = 'gd2';
                    $configa['create_thumb'] = TRUE;
                    $configa['maintain_ratio'] = TRUE;
                    $configa['new_image']='assets/images/productos/';
                    $configa['source_image'] = 'assets/images/productos/'.$data['file_name'];
                    $configa['thumb_marker'] = '_thumb_detail';
                    $configa['width'] = 80;
                    $configa['height'] = 1;
                    $configa['master_dim'] = 'width';
                    $this->image_lib->initialize($configa);
                    $this->image_lib->resize();
                    $configa = array();
                    $configa['create_thumb'] = TRUE;
                    $configa['maintain_ratio'] = TRUE;
                    $configa['new_image']='assets/images/productos/';
                    $configa['source_image'] = 'assets/images/productos/'.$data['file_name'];
                    $configa['thumb_marker'] = '_thumb';
                    $configa['width'] = 170;
                    $this->image_lib->initialize($configa);
                    $this->image_lib->resize();
                    $configa = array();
                    $configa['create_thumb'] = TRUE;
                    $configa['maintain_ratio'] = TRUE;
                    $configa['new_image']='assets/images/productos/';
                    $configa['source_image'] = 'assets/images/productos/'.$data['file_name'];
                    $configa['thumb_marker'] = '_detail';
                    $configa['width'] = 300;
                    $this->image_lib->initialize($configa);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                    if($data['file_name']) {
                        $dato = explode('.', $data['file_name']);
                        $thumb = $dato[0].'_thumb.'.$dato[1];
                        $thumbdetail = $dato[0].'_thumb_detail.'.$dato[1];
                        $detail = $dato[0].'_detail.'.$dato[1];
                    }
                    $this->productos->guardarImagen(
                        array(
                            0
                            , ($this->_reg['idProducto'] != '' && $this->_reg['idProducto'] != 0)? $this->_reg['idProducto'] : $this->_aEstadoOper['status']
                            , $config['upload_path'].$data['file_name']
                            , $config['upload_path'].$thumb
                            , $config['upload_path'].$detail
                            , $config['upload_path'].$thumbdetail
                            , ($band==TRUE)? 1:0
                        )
                    );
                }
                $band = FALSE;
            }
            $this->_reg['idProducto'] = ($this->_reg['idProducto'] != '' && $this->_reg['idProducto'] != 0)? $this->_reg['idProducto'] : $this->_aEstadoOper['status'];
            $this->categorias->eliminarCategoriasProducto($this->_reg['idProducto']);
            foreach ($this->input->post('categorias') as $categoria) {                 
                $this->categorias->guardarCategoriasProducto(
                    array(
                        $categoria
                        , $this->_reg['idProducto']
                    )
                );
            }
        }
        else {
            $this->_aEstadoOper['status'] = 0;
            $this->_aEstadoOper['message'] = validation_errors();
        }
        if($this->_aEstadoOper['status'] > 0) {
            $this->_aEstadoOper['message'] = 'El registro fue guardado correctamente.';
        } 
        else {
            $this->_aEstadoOper['message'] = $this->_obtenerMensajeErrorDB($this->_aEstadoOper['status']);
             $this->_aEstadoOper['message'] = 'ello';
        }
        $this->_aEstadoOper['message'] = $this->messages->do_message(array('message'=>$this->_aEstadoOper['message'],'type'=> ($this->_aEstadoOper['status'] > 0)?'success':'alert'));
        if($this->_aEstadoOper['status'] > 0) {
            $this->listado();
        } else {
            $this->formulario();
        }
    }
    function obtener() {
        $data = $this->productos->obtenerUno($this->input->post('idProducto'));
        echo json_encode($data);
    }

    function do_upload() {
        $cant = count($_FILES['userfile']['name']);
        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = 'jpg';
        $config['max_size'] = '30000';
        $this->load->library('upload', $config);
        $upload_files = $_FILES;
        for($i = 0; $i < count($upload_files['userfile']['name']); $i++) {
            $_FILES['userfile'] = array(
                'name' => $upload_files['userfile']['name'][$i],
                'type' => $upload_files['userfile']['type'][$i],
                'tmp_name' => $upload_files['userfile']['tmp_name'][$i],
                'error' => $upload_files['userfile']['error'][$i],
                'size' => $upload_files['userfile']['size'][$i]
            );
            if ( ! $this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
            } 
            else {
                $data = $this->upload->data();
                print_r($data);
            }
        }  
    }
    function _create_thumbnail($filename, $width, $height){
        $config['image_library'] = 'gd2';
        //CARPETA EN LA QUE ESTÁ LA IMAGEN A REDIMENSIONAR
        $config['source_image'] = 'assets/images/productos/'.$filename;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        //CARPETA EN LA QUE GUARDAMOS LA MINIATURA
        $config['new_image']='assets/images/productos/';
        $config['width'] = $width;
        $config['height'] = $height;
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
    }
    function eliminarImagen($idProductoImagen) {
        //$this->productos->eliminarImagen($idProductoImagen);
    }
}

/* End of file personas.php */
/* Location: ./application/controllers/administrator/personas.php */