<?php
include_once(APPPATH.'controllers/BaseController.php');

class AnswerController extends BaseController {

    public function __construct(){
        parent::__construct();
        $this->load->model('Answer');
    }

    
    // if(!$this->verifyToken()){
    //     return $this->unauthorized("You are not Authorized");
    // }

    public function answer_post(){
        if(!$this->verifyToken()){
            return $this->unauthorized("You are not Authorized");
        }

        $answer = array();
        $answer['answer'] = $this->post('answer');
        $answer['userId'] = $this->post('userId');
        $answer['questionId'] = $this->post('questionId');

        $result = $this->Answer->createAnswer($answer);

        $this->success($result);
    }

    public function answer_get(){
        if(!$this->verifyToken()){
            return $this->unauthorized("You are not Authorized");
        }

        $id = $this->get('id');
        // If the id parameter doesn't exist return all the users

        if ($id === NULL)
        {
            return $this->bad("Not Good"); 
        }else{
            $answers = $this->Answer->getAnswer($id);
            return $this->success($answers);
        }
    }

    public function vote_post(){
        if(!$this->verifyToken()){
            return $this->unauthorized("You are not Authorized");
        }

        $vote = array();
        $vote['userId'] = $this->post('userId');
        $vote['answerId'] = $this->post('answerId');
        $vote['vote'] = $this->post('vote');

        $result = $this->Answer->vote($vote);

        $this->success($result);
    }
}
