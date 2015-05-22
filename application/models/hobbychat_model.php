<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Hobbychat_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function saveKey($key) {

        return true;
    }

    public function liberarKey() {

        return true;
    }

    public function probarConexion() {

       

        $query = $this->db->query("Select * from chats");
        foreach ($query->result() as $row) {
            echo $row->title;
            echo $row->name;
            echo $row->email;
        }

        echo 'Total Results: ' . $query->num_rows();
    }
    
    
    public function sendMessage($datos) {
        
      //  $sql = "insert into chats (key, message) values ('" .$datos['key']. "', '" .$datos['msg']. "')";
        $this->db->insert('messages', $datos);
       return ($this->db->affected_rows() > 0) ? true : false; 
    }
    
    
    public function receiveMessage($idchat, $idusuario) {
        
        $query = $this->db->query("select a.idmessages, a.contenido from messages a where "
                . " a.status = 'E' and a.chats_idchats = '$idchat' and a.idusuario_envio <> $idusuario ");
        
        if ($query->num_rows() > 0){
            
            foreach ($query->result() as $row) {
                $data = array(
                    'status' => 'R'
                );
              //  $this->db->where('idmessages', $row->idmessages);
               // $this->db->update('messages', $data);
                
            }
            $filas = $query->result_array();
        //$row = $query->row();
        return $filas;
        } else {
            return false;
        }
        
    }

}
