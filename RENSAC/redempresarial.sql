drop database if exists redempresarial;
create database redempresarial;
use redempresarial;

create table basedatos
(
	codigoActivo varchar(10),
	codigoInterno varchar(15),
	denominacion text,
	marca varchar(50),
	modelo varchar(50),
	serie varchar(50),
	fechaIngreso date,
	estado varchar(5),
	empleado varchar(100),
	ubicacion text,
	local text
);
create table inventariadores
(
	dni varchar(8) NOT NULL PRIMARY KEY,
	nombre varchar(70),
	celular varchar(20),
	direccion text
);

create table invAlmacenCabecera
(
	idInv varchar(10) NOT NULL PRIMARY KEY, 
	fecha date,
	local text,
	ubicacion text,
	usuario varchar(100),
	cargo varchar(50),
	dependencia text,
	ambiente text,
	area text,
	inventariador1 varchar(8),
	inventariador2 varchar(8),
	FOREIGN KEY (inventariador1) REFERENCES inventariadores(dni),
	FOREIGN KEY (inventariador2) REFERENCES inventariadores(dni)
);

create table invAlmacenDetalle
(
	idInv varchar(10) NOT NULL,
	codigoAntiguo varchar(30),
	codigoInventario varchar(30),
	codigoBarras varchar(10),
	denominacion text,
	marca varchar(50),
	modelo varchar(50),
	serie varchar(50),
	color varchar(25),
	largo varchar(10),
	ancho varchar(10),
	alto varchar(10),
	estado char(1),
	etiquetado char(2),
	situacion char(1),
	PRIMARY KEY(idInv, codigoInventario),
	FOREIGN KEY (idInv) REFERENCES invAlmacenCabecera(idInv)
);


INSERT INTO inventariadores (dni, nombre) VALUES ('54851516', 'Ulloa Caycho Junior');
INSERT INTO inventariadores (dni, nombre) VALUES ('68518475', 'Acevedo Arroyo Francesca');
INSERT INTO inventariadores (dni, nombre) VALUES ('65742154', 'Tongo Gomez Franklin');
