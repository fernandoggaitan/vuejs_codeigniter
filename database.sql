CREATE TABLE estados(
	id_estado tinyint(1) unsigned not null primary key,
	nombre varchar(50)
)ENGINE=innoDB;

CREATE TABLE tareas(
	id_tarea tinyint(1) unsigned not null auto_increment primary key,
	titulo varchar(100) not null,
	descripcion text not null,
	id_estado tinyint(1) unsigned not null,
	fecha_alta datetime not null,
	fecha_modificacion datetime not null,
	fecha_baja datetime,
	foreign key(id_estado)
	references estados(id_estado)
	on delete cascade
	on update cascade
)ENGINE=innoDB;

INSERT INTO estados(id_estado, nombre)
VALUES
(1, 'Pendiente'),
(2, 'En proceso'),
(3, 'Finalizada'),
(4, 'Cancelada');