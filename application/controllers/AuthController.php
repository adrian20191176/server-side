<?php
include_once(APPPATH.'controllers/BaseController.php');

class AuthController extends BaseController {

    public function __construct(){
        parent::__construct();
        $this->load->model('User');
    }

    
    // if(!$this->verifyToken()){
    //     return $this->unauthorized("You are not Authorized");
    // }

    public function login_post(){
        $email = $this->post('email');
        $password = $this->post('password');

        $result = $this->User->login($email,$password);

        if(is_array($result)){

            $token = $this->token(array(
                'id' => $result[0]['userId'],
                'email'=>$result[0]['userEmail']));
            return $this->success($token);
        }

        return $this->unauthorized($result);
    }

    public function signup_post(){
        $newUser = array();
        $newUser['userEmail'] = $this->post('email');
        $newUser['userPassword'] = $this->post('password');
        $newUser['userFirstName'] = $this->post('firstName');
        $newUser['userSurname'] = $this->post('surname');

        $result = $this->User->register($newUser);

        $this->success($result);
    }

}
