<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Messages_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getMessage($code = 200, $message = NULL) {

        if ($message !== NULL) {

            $resp = array(
                'status' => $code,
                'msg' => $message
            );

            return $resp;
        }

        $msgs = array(
            200 => 'success',
            500 => 'error server',
            404 => 'sin permiso',
            300 => 'metodo no permitido por este tipo de solicitud',
            350 => 'error db',
            200 => 'success',
            200 => 'success',
            200 => 'success',
        );

        $resp = array(
            'status' => $code,
            'msg' => $msgs[$code]
        );

        return $resp;
    }

}
