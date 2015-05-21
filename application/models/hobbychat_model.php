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
        $this->db->insert('chats', $datos);
       return ($this->db->affected_rows() > 0) ? true : false; 
    }
    
    
    public function receiveMessage() {
        
        $query = $this->db->query("select message from chats limit 1");
        $row = $query->row();
        return $row->message;
    }

}
