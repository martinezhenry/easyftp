<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 header('Content-type: application/json; charset=utf-8');
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
    
    
    public function updateUser($id) {
          //  echo $id;
        if ($_SERVER['REQUEST_METHOD'] != "PUT") {

            echo json_encode($this->Messages_model->getMessage(300));
            exit();
            
        }
        
         parse_str(file_get_contents("php://input"), $datos);  
         
         //print_r($datos);
         //echo json_encode($datos);
        // exit();
        // $datos = $this->limpiarEntrada($this->datosPeticion); 
        // $datos = $this->input->delete('dat');
         
         $datos['dat']['pass'] = md5($datos['dat']['pass']);
         
        if ($this->Usuario_model->updateUser($id, $datos['dat'])){
            
           echo json_encode($this->Messages_model->getMessage(200));
           exit();
        } else {
            
           echo json_encode($this->Messages_model->getMessage(150, "no se actualizo"));
           exit();
            
        }
        
        
    }
    
    
        public function getUser($id = null) {
          //  echo $id;
        if ($_SERVER['REQUEST_METHOD'] != "GET") {

            echo json_encode($this->Messages_model->getMessage(300));
            exit();
            
        }
        
          //$datos = $this->input->get('dat');
        $datos = $this->Usuario_model->getUser($id);
        if (count($datos)> 0){
           $resp = $this->Messages_model->getMessage(200);
           $resp['datos'] = $datos;
           echo json_encode($resp);
           exit();
        } else {
            
           echo json_encode($this->Messages_model->getMessage(150, "no se consulto"));
           exit();
            
        }
        
        
    }
    
    
    public function login() {
         if ($_SERVER['REQUEST_METHOD'] != "POST") {

            echo json_encode($this->Messages_model->getMessage(300));
            exit();
            
        }
        
        $user = $this->input->post('user');
        $pass = $this->input->post('pass');
        

        
        if (!isset($user) || $user == "" || !isset($pass) || $pass == ""){
            echo json_encode($this->Messages_model->getMessage(500));
            exit();
        }
        
 
        $datos = $this->Usuario_model->login($user, base64_decode($pass));
   
        if (!$datos){
          echo json_encode($this->Messages_model->getMessage(150, 'login invalido'));
          exit();
            
        } else {
      
           $resp = $this->Messages_model->getMessage(200);
           $resp['datos'] = $datos;
           echo json_encode($resp);
           exit();
        }
        
    }
    
    
    public function logout($iduser) {
        
          if ($_SERVER['REQUEST_METHOD'] != "PUT") {

            echo json_encode($this->Messages_model->getMessage(300));
            exit();
            
        }
       
        if ($this->Usuario_model->logout($iduser)){
    
            
            echo  $this->Messages_model->getMessage(200);

        } else {
 
            echo json_encode($this->Messages_model->getMessage(150, 'no se realizo logout'));
          exit();
            
            
        }
        
        
        
    }
    
    

}
