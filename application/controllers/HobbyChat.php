<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class HobbyChat extends CI_Controller {
    
    public function __construct() {
        
        parent::__construct();
        $this->load->model('Hobbychat_model');
        $this->load->library('encrypt');
    }
    
    public function onkey(){
        
        
          
        
        if ($_SERVER['REQUEST_METHOD'] != "POST"){
            $resp = array(
                
                'resp' => 500,
                'msg' => 'no permitido metodo'
                
            );
            echo json_encode($resp);
            exit();
        }
        
        $key = $this->input->post('yek');
     //   echo count(base64_decode($key));
        if (empty($key) OR  strlen(base64_decode($key)) < 4){
            
            $resp = array(
                
                'resp' => 400,
                'msg' => 'llave invalida'
                
            );
            echo json_encode($resp);
            exit();
        }
        
        
     
       
        if ($this->Hobbychat_model->saveKey(md5($key))) {
            
                 
            $resp = array(
                
                'resp' => 200,
                'msg' => 'llave establecida'
                
            );
             echo json_encode($resp);
            exit();
            
        } else {
            
                 
            $resp = array(
                
                'resp' => 300,
                'msg' => 'llave no establecida'
                
            );
             echo json_encode($resp);
            exit();
        }
        
        
        
        
    }
    
    public function freeKey() {
        
        if ($this->Hobbychat_model->liberarKey()){
            
             $resp = array(
                
                'resp' => 200,
                'msg' => 'llave liberada'
                
            );
             echo json_encode($resp);
            exit();
            
        } else {
            
                 
            $resp = array(
                
                'resp' => 300,
                'msg' => 'llave no liberada'
                
            );
             echo json_encode($resp);
            exit();
        }
        
        
    }
    
    
    public function send() {
         if ($_SERVER['REQUEST_METHOD'] != "POST"){
            $resp = array(
                
                'resp' => 500,
                'msg' => 'no permitido metodo'
                
            );
            echo json_encode($resp);
            exit();
        }
        
       // echo json_encode($this->input->post('dat'));
       // var_dump($_POST);
       // 
       // 
        header('Content-type: application/json; charset=utf-8');
        $datos = $this->input->post('dat');
        
        
        
        $datos['key'] = $this->encrypt->encode($datos['key']);
        $datos['message'] = $this->encrypt->encode($datos['message']);
        
        if ($this->Hobbychat_model->sendMessage($datos)){
            
            $resp = array(
                'resp' => 200,
                'msg' => 'message sent!'
            );
            echo json_encode($resp);
            exit();
        } else {
            
                $resp = array(
                'resp' => 400,
                'msg' => 'message NO sent!'
            );
            echo json_encode($resp);
            exit();
            
        }
       
    }
    
    
    
    public function receive() {
               if ($_SERVER['REQUEST_METHOD'] != "GET"){
            $resp = array(
                
                'resp' => 500,
                'msg' => 'no permitido metodo'
                
            );
            echo json_encode($resp);
            exit();
        }
        $message = $this->Hobbychat_model->receiveMessage();
        
        $message = $this->encrypt->decode($message);
        
        $resp = array(
            'resp' => 200,
            'msg' => ['message' => $message]
        );
        
        echo json_encode($resp);
        
    }
    
    

    
    
}