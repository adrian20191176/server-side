<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

abstract class BaseController extends \Restserver\Libraries\REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

    }

    public function success($data){
        $this->response($data, \Restserver\Libraries\REST_Controller::HTTP_OK);
    }

    public function notFound($data){
        $this->response($data, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
    }

    public function bad($data){
        $this->response($data, \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST);
    }

    public function unauthorized($data){
        $this->response($data, \Restserver\Libraries\REST_Controller::HTTP_UNAUTHORIZED);
    }
    
    public function token($data){
        $jwt = new JWT();

        $secret = "ResQua";
        $daata = array(
            'userId'=>145,
            'email'=>'ancheloadrian@gmail.com'
        );
        $token = $jwt->encode($data,$secret,'HS256');

        return $token;
    }
    
    public function verifyToken(){
        try{
            $token = explode(" ",$this->input->get_request_header('Authorization'));

            $token =  count($token)>1 ? $token[1] : "Bye"; 
            
            $jwt = new JWT();

            $secret = "ResQua";

            $decoded = $jwt->decode($token,$secret,'HS256');

            return TRUE;
        }catch(Exception $e){
            return FALSE;
        }

    }
}
