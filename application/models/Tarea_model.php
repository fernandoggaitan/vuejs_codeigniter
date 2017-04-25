<?php

class Tarea_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function insertar($data){
		$this->db->insert('tareas', array(
			'titulo' => $data['titulo'],
			'descripcion' => $data['descripcion'],
			'id_estado' => 1,
			'fecha_alta' => date('Y-m-d H:i:s'),
			'fecha_modificacion' => date('Y-m-d H:i:s'),
			'fecha_baja' => null
		));
	}

	public function modificar($data){
		$this->db
			->where('id_tarea', $data['id_tarea'])
			->update('tareas', array(
				'titulo' => $data['titulo'],
				'descripcion' => $data['descripcion'],
				'id_estado' => $data['id_estado'],
				'fecha_modificacion' => date('Y-m-d H:i:s'),
			));
	}

	public function listar(){
		return $this->db
			->select('t.id_tarea, t.titulo, t.descripcion, e.id_estado, e.nombre nombre_estado')
			->from('tareas t')
			->join('estados e', 'e.id_estado = t.id_estado')
			->where('fecha_baja', null)
			->order_by('e.id_estado')
			->get()
			->result();
	}

	public function eliminar($data){
		$this->db
			->where('id_tarea', $data['id_tarea'])
			->update('tareas', array(
				'fecha_baja' => date('Y-m-d H:i:s')
			));
	}

}