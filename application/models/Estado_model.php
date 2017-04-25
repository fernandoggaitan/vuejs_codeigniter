<?php

class Estado_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function listar(){
		return $this->db
			->select('id_estado, nombre')
			->from('estados')
			->get()
			->result();
	}

}