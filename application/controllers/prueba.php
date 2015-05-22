<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Prueba extends CI_Controller {
    
    
    public function index() {
        $datos = array(
            '_title' => 'Home'
        );
        $this->load->view('home', $datos);
    //    echo "hola mundo codeigniter";
        
    }
    
    
}