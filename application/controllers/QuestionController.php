<?php
include_once(APPPATH.'controllers/BaseController.php');

class QuestionController extends BaseController {

    public function __construct(){
        parent::__construct();
        $this->load->model('Question');
    }

    
    // if(!$this->verifyToken()){
    //     return $this->unauthorized("You are not Authorized");
    // }

    public function question_post(){
        if(!$this->verifyToken()){
            return $this->unauthorized("You are not Authorized");
        }

        $question = array();
        $question['question'] = $this->post('question');
        $question['questionDescription'] = $this->post('description');
        $question['userId'] = $this->post('userId');

        $result = $this->Question->createQuestion($question);

        $this->success($result);
    }

    public function question_get(){
        if(!$this->verifyToken()){
            return $this->unauthorized("You are not Authorized");
        }

        $search = $this->get('string');
        // If the id parameter doesn't exist return all the users

        if ($search === NULL)
        {
            $questions = $this->Question->getAllQuestions();
            return $this->success($questions); 
        }else{
            $questions = $this->Question->getQuestions($search);
            return $this->success($questions);
        }
    }

    public function follow_post(){
        if(!$this->verifyToken()){
            return $this->unauthorized("You are not Authorized");
        }

        $follow = array();
        $follow['questionId'] = $this->post('questionId');
        $follow['userId'] = $this->post('userId');

        $result = $this->Question->follow($follow);

        $this->success($result);
    }
    
    public function tag_post(){
        if(!$this->verifyToken()){
            return $this->unauthorized("You are not Authorized");
        }
        
        $tag = array();
        $tag['tagName'] = $this->post('tag');

        $result = $this->Question->createTag($tag);
        $this->success($result);
    }
}
