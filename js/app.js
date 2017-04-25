var controlador_tareas = new Vue({
	el: '#controlador_tareas',
	data: {
		cargando_tareas: true,
		tarea_nueva: {
			titulo: '',
			descripcion: ''
		},
		estados: [],
		tareas: []
	},
	methods: {
		recuperarEstados: function(){
			this.$http.get('recuperar_estados').then(function(respuesta){
				this.estados = respuesta.body;
			}, function(){
				alert('No se han podido recuperar los estados.');
			});
		},
		recuperarTareas: function(){
			this.cargando_tareas = true;
			this.$http.get('recuperar_tareas').then(function(respuesta){
				this.tareas = respuesta.body;
				this.cargando_tareas = false;
			}, function(){
				alert('No se han podido recuperar los estados.');
				this.cargando_tareas = false;
			});	
		},
		crearTarea: function(){
			this.$http.post('crear_tarea', this.tarea_nueva).then(function(){
				this.tarea_nueva.titulo = '';
				this.tarea_nueva.descripcion = '';
				this.recuperarTareas();
			}, function(){
				alert('No se ha podido crear la tarea.');
			});
		},
		modificarTarea: function(p_tarea){
			this.$http.post('modificar_tarea', p_tarea).then(function(){
				this.recuperarTareas();
			}, function(){
				alert('No se ha podido modificar la tarea.');
			});
		},
		eliminarTarea: function(p_tarea){
			this.$http.post('eliminar_tarea', p_tarea).then(function(){
				this.recuperarTareas();
			}, function(){
				alert('No se ha podido eliminar la tarea.');
			});
		},
		colorEstado: function(p_tarea){
			var estilo;
			switch(p_tarea.id_estado){
				case '1':
					estilo = 'text text-error';
					break;
				case '2':
					estilo = 'text text-warning';
					break;
				case '3':
					estilo = 'text text-success';
					break;
				default:
					estilo = 'text text-info';
			}
			return estilo;
		}
	},
	created: function(){
		this.recuperarEstados();
		this.recuperarTareas();
	}
});