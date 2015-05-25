<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
header('Content-type: application/json; charset=utf-8');

class Key extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Messages_model');
        $this->load->model('Key_model');
        
    }

    public function saveKey() {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {

            echo json_encode($this->Messages_model->getMessage(300));
            exit();
        }
        $datos = $this->input->post('dat');
        if ($this->Key_model->saveKey($datos)) {
            $resp = $this->Messages_model->getMessage(200);

            $resp['id'] = $this->Key_model->ultimoId();
            echo json_encode($resp);
            exit();
        } else {

            echo json_encode($this->Messages_model->getMessage(150, $this->Usuario_model->getErrorMessage()));
            exit();
        }
    }

    public function freeKey($id) {
        if ($_SERVER['REQUEST_METHOD'] != "PUT") {

            echo json_encode($this->Messages_model->getMessage(300));
            exit();
        }
       // $datos = $this->input->post('dat');
        if ($this->Key_model->freeKey($id)) {

            echo json_encode($this->Messages_model->getMessage(200));
            exit();
        } else {

            echo json_encode($this->Messages_model->getMessage(150, $this->Usuario_model->getErrorMessage()));
            exit();
        }
    }

}
