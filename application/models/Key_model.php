<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Key_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('encrypt');
    }

    public function saveKey($data) {
       $data['key_utilizada'] = $this->encrypt->encode($data['key_utilizada']);
        if ($this->db->insert('keys', $data))
            return TRUE;
        else
            return FALSE;
    }

    public function freeKey($id) {

        $data = array('status' => 'L');
        $this->db->where('idkeys', $id);
        if ($this->db->update('keys', $data))
            return TRUE;
        else
            return FALSE;
        
    }
    

    
        public function ultimoId() {

         $id = $this->db->insert_id();
         return $id;
        
    }

}
