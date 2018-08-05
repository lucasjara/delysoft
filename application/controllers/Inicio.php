<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 09-06-2018
 * Time: 23:04
 */

class Inicio extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    function index()
    {
        $this->layout->setLayout("plantilla");
        $this->layout->view('vista');
    }
}