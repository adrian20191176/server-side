<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Answer extends CI_Model {

    public function __construct() {
        parent::__construct();
        
        $this->answerTbl = 'answer';
        $this->userVoteTbl = 'userVote';
    }

    public function createAnswer($data){
        
        //add created if not exists
        if(!array_key_exists("created", $data)){
            $data['created'] = date("Y-m-d H:i:s");
        }

        $insert = $this->db->insert($this->answerTbl, $data);
            
        return $insert?$this->db->insert_id():false;
    }
    
    public function getAllanswers(){ 
        $this->db->select('answerId,answer');

        $query = $this->db->get('answer');

        return $query->result_array();
    }  

    public function getAnswer($questionId){ 
        $this->db->select('answerId,answer,questionId');
        $this->db->where('questionId',$questionId);
        $query = $this->db->get('answer');

        return $query->result_array();
    }

    public function vote($data){
        $insert = $this->db->insert($this->userVoteTbl, $data);
            
        return $insert?$this->db->insert_id():false;
    }
    // function get($id = null) 
    //     {
    //         $this->db->select('id, Username, First_Name, Last_Name, Role, Email');
    //         $this->db->from('user');
    //         if (!is_null($id)) $this->db->where('id', $id);
    //         $this->db->order_by('id', 'desc');
    //         return $this->db->get()->result();
    //     }
}