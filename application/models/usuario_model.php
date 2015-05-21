<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Usuario_model extends CI_Model {

    
    private $errorMessage;
    private $errorCode;
    private $conn;


    public function __construct() {
        parent::__construct();
        $conn = $this->load->database();
    }

    public function addUser($datos) {

        
               if ($this->db->insert('usuario', $datos)) { 
            return true ;
            
        }else { 
           //$this->errorMessage = $this->_error_message();
           // $this->errorCode = $this->db->_error_number();
            return FALSE;
            }
    }

    public function deleteUser($id) {

       // $sql = "delete from usuario where idusuario = '".$id."'";
        //$query = $this->db->query($sql);
        
       
        
       if ($this->db->delete('usuario', array('idusuario' => $id))) {
            
            return TRUE;
        } else {
            
            return FALSE;
        }
        
       // return ($query->affected_rows() > 0) ? true : FALSE;
    }

    public function updateUser($id, $datos) {


        $str_campos = "";
        $i = 0;
        foreach ($datos as $key => $value) {
            ($i > 0) ? $final = ', ' : $final = '';
            $str_campos .= $final . $key . ' = ' . "'$value'";
            $i++;
        }

        $sql = "update usuario set $str_campos where idusuario = '$id'";

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) { 
            return true ;
            
        }else { 
            $this->errorMessage = $this->display_error();
            $this->errorCode = $this->db->_error_number();
            return FALSE;
            }
    }

    public function getUser($id = null) {

        if ($id == null) {
            $query = $this->db->get('usuario');
            return $query->result_array();
        } else {

            $query = $this->db->query("SELECT * FROM usuario where idusuario='$id'");
            return $query->result_array();
        }
    }
    
    function getErrorMessage() {
        return $this->errorMessage;
    }

    function getErrorCode() {
        return $this->errorCode;
    }

    function setErrorMessage($errorMessage) {
        $this->errorMessage = $errorMessage;
    }

    function setErrorCode($errorCode) {
        $this->errorCode = $errorCode;
    }

 

}
