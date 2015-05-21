<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Usuario extends CI_Controller {

    public function __construct() {
        parent::__construct();
       $this->load->model('Messages_model');
        $this->load->model('Usuario_model');
    }

    public function addUser() {
 
        if ($_SERVER['REQUEST_METHOD'] != "POST") {

            echo json_encode($this->Messages_model->getMessage(300));
            exit();
            
        }
        $datos = $this->input->post('dat');
        if ($this->Usuario_model->addUser($datos)){
            
           echo json_encode($this->Messages_model->getMessage(200));
           exit();
        } else {
            
           echo json_encode($this->Messages_model->getMessage(150, $this->Usuario_model->getErrorMessage()));
           exit();
            
        }
        
        
    }
    
        public function deleteUser($id) {
          //  echo $id;
        if ($_SERVER['REQUEST_METHOD'] != "DELETE") {

            echo json_encode($this->Messages_model->getMessage(300));
            exit();
            
        }
        //$datos = $this->input->delete('dat');
        if ($this->Usuario_model->deleteUser($id)){
            
           echo json_encode($this->Messages_model->getMessage(200));
           exit();
        } else {
            
           echo json_encode($this->Messages_model->getMessage(150, $this->Usuario_model->getErrorMessage()));
           exit();
            
        }
        
        
    }

}
