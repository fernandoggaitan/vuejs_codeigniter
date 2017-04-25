<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tareas_ajax extends CI_Controller {

	private $request;

	public function __construct(){
		parent::__construct();
		$this->load->model('estado_model');
		$this->load->model('tarea_model');
		$this->request = json_decode(file_get_contents('php://input'));
	}

	public function recuperar_estados(){
		$estados = $this->estado_model->listar();
		echo json_encode($estados);
	}

	public function recuperar_tareas(){
		$tareas = $this->tarea_model->listar();
		echo json_encode($tareas);
	}

	public function crear_tarea(){
		$this->tarea_model->insertar(array(
			'titulo' => $this->request->titulo,
			'descripcion' => $this->request->descripcion
		));
	}

	public function modificar_tarea(){
		$this->tarea_model->modificar(array(
			'id_tarea' => $this->request->id_tarea,
			'titulo' => $this->request->titulo,
			'descripcion' => $this->request->descripcion,
			'id_estado' => $this->request->id_estado
		));
	}

	public function eliminar_tarea(){
		$this->tarea_model->eliminar(array(
			'id_tarea' => $this->request->id_tarea
		));
	}

}