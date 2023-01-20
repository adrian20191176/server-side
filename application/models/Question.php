<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Question extends CI_Model {

    public function __construct() {
        parent::__construct();
        
        $this->questionTbl = 'question';
        $this->questionFollow = 'userFollow';
        $this->tagTbl = 'tag';
    }

    public function createQuestion($data){
        
        //add created if not exists
        if(!array_key_exists("created", $data)){
            $data['created'] = date("Y-m-d H:i:s");
        }

        $insert = $this->db->insert($this->questionTbl, $data);
            
        return $insert?$this->db->insert_id():false;
    }
    
    public function getAllQuestions(){ 
        $this->db->select('questionId,question');

        $query = $this->db->get('question');

        return $query->result_array();
    }

    public function getQuestions($search){

        $query = $this->db->query("SELECT questionId,question FROM question WHERE question  LIKE '%$search%'");

        return $query->result_array();
    }

    public function follow($data){
        $insert = $this->db->insert($this->questionFollow, $data);
            
        return $insert?$this->db->insert_id():false;
    }
    
    public function createTag($data){
        $insert = $this->db->insert($this->tagTbl, $data);
            
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