<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();

        $this->table = 'surveys';
        $this->questionsTable = 'questions';
        $this->answersTable = 'answers';
    }


    public function create($data)
    {
        return $this->db->insert($this->table,$data);
    }

    public function update($where,$data)
    {
        return $this->db->where($where)->update($this->table,$data);
    }
 

    public function get($where)
    {
        return $this->db->where($where)->get($this->table)->row();
    }


    public function getAll($where,$order ='survey_id DESC')
    {
        return $this->db->where($where)->order_by($order)->get($this->table)->result();
    }

    public function getAllQuestions($where)
    {
        return $this->db->where($where)->get($this->questionsTable)->result();
    }

    public function answerCreate($data)
    {
        return $this->db->insert($this->table,$data);
    }


    public function getAllAnswers($where)
    {
        return $this->db->where($where)->get($this->answersTable)->result();
    }

    

}

 