<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {


    

	public function __construct()
    {
        parent::__construct();

        $this->table = 'users';

    }


    public function create($data)
    {
        return $this->db->insert($this->table,$data);
    }

    public function update($where,$data)
    {
        return $this->db->where($where)->update($this->table,$data);

    }



    public function get($where = array())
    {
        return $this->db->where($where)->get($this->table)->row();
    }


    public function getAll($where = array(),$order=false)
    {
        return $this->db->where($where)->order_by($order)->get($this->table)->result();
    }


    public function checkUserName($userName)
    {
        return $this->db
        ->where('user_name',$userName)
        ->get($this->table)
        ->row();
    }

    public function checkEmail($email)
    {
        return $this->db
        ->where('email',$email)
        ->get($this->table)
        ->row();
    }


    public function login($user_name = false, $password = false )
    {
        $where = [
            'user_name' =>  strip_tags(trim($user_name)),
            'password'  =>  strip_tags(trim(sha1(md5($password))))
        ];
       
        return $this->db->where($where)->get($this->table)->row();
    }


}

 