<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 14-01-2018
 * Time: 15:05
 */
?>
<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');
/**
 * Vistas y Layout
 *
 * Realiza tareas basicas para vistas y layouts
 */
class Layout
{
    /**
     * @var object Instancia CodeIgniter
     */
    private $CI;
    /**
     * @var string Nombre del layout actual
     */
    public $layout		= 'default';
    /**
     * Archivos JS para insertar en el layout
     * @var string
     */
    public $js			= '';
    /**
     * Archivos CSS para insertar en el layout
     * @var string
     */
    public $css			= '';
    /**
     * Variables para mejorar el SEO del sitio
     * @var sting
     */
    public $title       = '..:: Registro Liceo ::..';
    public $name       = ' Liceo Application';
    public $keywords    = 'php,java,codeigniter';
    public $descripcion = 'Aplicación de registro para liceo';
    /**
     * Constructor
     *
     * Inicializa la instancia de CodeIgniter y setea el layout por defecto
     */
    public function __construct($layout = 'default')
    {
        $this->CI		=& get_instance();
        $this->layout	= $layout;
    }
    /**
     * Setea el layout a utilizar
     *
     * @param	string		$layout			Nombre del layout
     */
    function setLayout($layout)
    {
        $this->layout	= $layout;
    }
    /**
     * Retorna o renderea una vista
     *
     * @param	string		$view			Nombre de la vista a procesar
     * @param	array		$data			Datos que se enviaran a la vista
     * @param	boolean		$return			Determina si una vista debe ser devuelta o rendereada directamente
     * @return	string						Si se pasa $return en true, devuelve el contenido de la vista
     */
    function view($view = null, $data = null, $return = false)
    {
        $layout			= "layouts/{$this->layout}";
        $vista			= (substr($view, 0, 1) == '/' ? $view : "{$this->CI->router->directory}{$this->CI->router->class}/{$view}");
        $load_view		= array('content_for_layout' => $this->CI->load->view($vista, $data, true));
        if ( $return )
            return $this->CI->load->view($layout, $load_view, true);
        else
            $this->CI->load->view($layout, $load_view, false);
    }
    /**
     * Retorna o renderea un elemento
     *
     * @param	string		$view			Nombre de la vista a procesar
     * @param	array		$data			Datos que se enviaran a la vista
     * @param	boolean		$return			Determina si una vista debe ser devuelta o rendereada directamente
     * @return	string						Si se pasa $return en true, devuelve el contenido de la vista
     */
    public function element($view = null, $data = null, $return = false)
    {
        $element			= "elements/{$view}";
        $content_for_layout	= $data;
        if ( $return )
            return $this->CI->load->view($element, compact('content_for_layout'), true);
        else
            $this->CI->load->view($element, compact('content_for_layout'), false);
    }
    public function setTitle($title)
    {
        $this->title = $title;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    }
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getKeywords()
    {
        return $this->keywords;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    /**
     * Captura y formatea los archivos JS para insertar a la vista
     *
     * @param	array		$archivos		Arreglo de archivos
     */
    public function js($archivos = array())
    {
        foreach ( $archivos as $archivo )
            $this->js .= "<script type=\"text/javascript\" src=\"{$archivo}\"></script>\n";
    }
    /**
     * Captura y formatea los archivos JS para insertar a la vista
     *
     * @param	array		$archivos		Arreglo de archivos
     */
    public function css($archivos = array())
    {
        foreach ( $archivos as $archivo )
            $this->css .= "<link type=\"text/css\" rel=\"stylesheet\" href=\"{$archivo}\" />\n";
    }
}
