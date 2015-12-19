DROP DATABASE IF EXISTS lindley;
CREATE DATABASE lindley;
USE lindley;

CREATE TABLE usuario (
  idusuario int(11) NOT NULL AUTO_INCREMENT,
  usuario varchar(45) not null,
  nombres varchar(50) not null,
  apellidos varchar(50) not null,
  clave varchar(45) DEFAULT NULL,
  primary key(idusuario)
);

insert into usuario values(NULL,'admin','semental','gzuck','123');

CREATE TABLE Area(
	areaID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
	area varchar(50) not null,
	estado varchar(15) NOT NULL
);

create table equipoProteccion(
	equipoProteccionID int AUTO_INCREMENT not null,
	descripcion varchar(50) not null,
	stock int null,	
	marca varchar(50) not null,
	modelo varchar(50) not null,
	color varchar(30) not null,
	estado bit not null,
	primary key(equipoProteccionID)
);

CREATE TABLE TrabajoRequerido
(
	trabajoRequeridoID int NOT NULL,	
	areaID int NOT NULL,
	descripcion varchar(50) NOT NULL,
	estado varchar(15) NOT NULL,
	fechaIngresado date NOT NULL,
	fechaLimite date NOT NULL,
	eliminado int NOT NULL,	
	PRIMARY key(trabajoRequeridoID),
	foreign key(areaID) references area(areaID)
);

CREATE TABLE EmpresaContratista 
(
	ruc char(11) NOT NULL PRIMARY KEY,
	razonSocial varchar(50) NOT NULL,
	direccion varchar(80) NOT NULL,
	telefono varchar(30) NOT NULL,
	email varchar(30) NOT NULL,
	referencias varchar(200) NOT NULL,
	estado varchar(15) NOT NULL
);

CREATE TABLE TrabajadorContratista
(
	empresaContratistaRUC char(11) NOT NULL,
	trabajadorContratistaDNI char(8) NOT NULL, 
	contratistaNombres varchar(50) NOT NULL,
	contratistaApellidos varchar(50) NOT NULL,
	contratistaDireccion varchar(70) NOT NULL,
	telefono varchar(9) NOT NULL,
	tipoTrabajador varchar(11) NOT NULL,
	estado varchar(15) NOT NULL,
	PRIMARY KEY (empresaContratistaRUC, trabajadorContratistaDNI),
	foreign key (empresaContratistaRUC) references EmpresaContratista(ruc)	
);

ALTER TABLE TrabajadorContratista
	add constraint CHK_tipoTrabajadorContratista
	check (tipoTrabajador in ('Contratista', 'Operario'));

CREATE TABLE Trabajador
(
	codigoTrabajador int AUTO_INCREMENT PRIMARY KEY,
	dni varchar(8) NOT NULL,
	nombres varchar(50) NOT NULL,
	apellidos varchar(50) NOT NULL,
	direccion varchar(50) NOT NULL,
	telefono varchar(50) NOT NULL,
	estado varchar(15) NOT NULL
);


create table PlanTrabajo(
	planTrabajoID int not null,
	areaID int not null,
	areaESp varchar(100) null,
	trabajadorID int not null,
	empresaContratistaRUC char(11) not null,	
	trabajadorContratistaDNI char(8) not null,
	fechaInicio date null,
	fechaFin date null,
	horario varchar(50)NULL,
	estado boolean not NULL,
	primary key(planTrabajoID),
	foreign key(areaID) references Area(areaID),
	foreign key(empresaContratistaRUC) references empresaContratista(ruc),
	foreign key(trabajadorID) references trabajador(codigoTrabajador),
	foreign key(empresaContratistaRUC,trabajadorContratistaDNI) references trabajadorContratista(empresaContratistaRUC,trabajadorContratistaDNI)
);


create table PlanTrabajoDetalle(
	detalleID int(11) NOT NULL AUTO_INCREMENT,
	planTrabajoID int not null,
	trabajoRequeridoID int not null,
	primary key(detalleID),
	foreign key(trabajoRequeridoID) references TrabajoRequerido(trabajoRequeridoID),
	foreign key(planTrabajoID) references PlanTrabajo(planTrabajoID)
);

create table ControlEntregaEPP(
	numSolicitudEPP 	int(11) NOT NULL AUTO_INCREMENT,
	areaID 				int NOT NULL,
	trabajadorID 		int NOT NULL,
	fechaIngreso 		date NOT NULL,
	observaciones 		text NOT NULL,

	primary key(numSolicitudEPP),
	foreign key(areaID) references Area(areaID),
	foreign key(trabajadorID) references trabajador(codigoTrabajador)
);

create table ControlEntregaEPPDetalle(
	detalleID 			int(11) NOT NULL AUTO_INCREMENT,
	numSolicitudEPP 	int(11) NOT NULL,
	equipoProteccionID 	int NOT NULL,
	motivo 				varchar(50) NOT NULL,
	fechaEntrega 		date NOT NULL,
	estado				boolean NOT NULL,

	primary key(detalleID),
	foreign key(numSolicitudEPP) references ControlEntregaEPP(numSolicitudEPP),
	foreign key(equipoProteccionID) references equipoProteccion(equipoProteccionID)
);

insert into EmpresaContratista values('12345678901','Empresa1','Direccion1','123456789','qwerty@qwerty.com','Referencia1','Activo');
insert into empresaContratista values('85937593279','Empresa2','Direccion2','984936562','nmfpwj@qwerty.com','Referencia2','Inactivo');
insert into empresaContratista values('49305866302','Empresa3','Direccion3','044394754','xkmdfo@qwerty.com','Referencia3','Activo');

