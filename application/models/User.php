<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {

    public function __construct() {
        parent::__construct();
        
        $this->userTbl = 'user';
    }

    public function register($data){
        
        //add created if not exists
        if(!array_key_exists("created", $data)){
            $data['created'] = date("Y-m-d H:i:s");
        }

        
        $this->db->select('*');
        $this->db->from($this->userTbl);
        $this->db->where('userEmail',$data['userEmail']);

        $query = $this->db->get();
        
        if($query->num_rows()==0){
            //insert user data to users table
            $data['userPassword'] = password_hash($data['userPassword'] , PASSWORD_ARGON2I);
            $insert = $this->db->insert($this->userTbl, $data);
    
            //return the status
            return $insert?$this->db->insert_id():false;
        }else{
            return "User already Exists!";
        }
    }
    
    public function login($email,$password){
        $this->db->select('*');
        $this->db->from($this->userTbl);
        $this->db->where('userEmail',$email);

        $query = $this->db->get();

        $user = $query->first_row('array');

        if($query->num_rows()>0){

            $passwordCheck = password_verify($password, $user['userPassword']);

            if($passwordCheck){
                return $query->result_array();
            }
            return "Wrong Username or Password";
        }
        return "Wrong Username or Password";
    }
}