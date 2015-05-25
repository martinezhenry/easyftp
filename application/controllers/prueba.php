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
    }
    
    
    public function encrypt() {
        $this->load->library('encrypt');
        
        $str = $this->input->post('msg');
        
    //    echo "valor recibido: " .$str . "<br>";
        //$key = "millaveSecreta12345";
      $salida = $this->encrypt->encode(base64_decode($str));
        
        echo trim(base64_encode($this->encrypt->decode($salida)));
        
        
      //  echo '<br> basee : ' . base64_decode("$str");
        
    }
    
}