

CREATE TABLE usuario (
  idusuario int(11) NOT NULL AUTO_INCREMENT,
  usuario varchar(45) not null,
  nombres varchar(50) not null,
  apellidos varchar(50) not null,
  clave varchar(45) DEFAULT NULL,
  primary key(idusuario)
);

insert into usuario values(NULL,'admin','erick','alfaro','redemp#2015');
insert into usuario values(NULL,'admin2','alicia','','redemp#2015');
insert into usuario values(NULL,'digit1','johan','julisa','redemp#2015');
insert into usuario values(NULL,'digit2','katherin','atoche','redemp#2015');



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
	observacion text,
	PRIMARY KEY(idInv, codigoInventario),
	FOREIGN KEY (idInv) REFERENCES invAlmacenCabecera(idInv)
);

create table invTercerosCabecera
(
	idInv varchar(10) NOT NULL PRIMARY KEY,
	fecha date,
	hora varchar(20),
	dependencia text,
	unidadOrganica	text,
	ubicacion text,
	usuario varchar(100),
	inventariador varchar(8),
	FOREIGN KEY (inventariador) REFERENCES inventariadores(dni)
);

create table invTercerosDetalle
(
	idInv varchar(10) NOT NULL,
	codigoInventario varchar(30),
	denominacion text,
	marca varchar(50),
	modelo varchar(50),
	serie varchar(50),
	color varchar(25),
	largo varchar(10),
	ancho varchar(10),
	alto varchar(10),
	estado char(1),
	propietario text,
	observacion text,
	PRIMARY KEY(idInv, codigoInventario),
	FOREIGN KEY (idInv) REFERENCES invTercerosCabecera(idInv)
);

create table basedatos2008
(	
	codigoActivo varchar(10),
	codigoInventario  varchar(15),
	denominacion text	
);

create table basedatos2009
(	
	codigoActivo varchar(10),
	codigoInventario  varchar(15),
	denominacion text	
);

create table basedatos2010
(	
	codigoActivo varchar(10),
	codigoInventario  varchar(15),
	denominacion text	
);

create table basedatos2011
(	
	codigoActivo varchar(10),
	codigoInventario  varchar(15),
	denominacion text	
);

create table basedatos2012
(	
	codigoActivo varchar(10),
	codigoInventario  varchar(15),
	denominacion text	
);

create table basedatos2013
(	
	codigoActivo varchar(10),
	codigoInventario  varchar(15),
	denominacion text	
);

INSERT INTO inventariadores (dni, nombre) VALUES ('54851516', 'Ulloa Caycho Junior');
INSERT INTO inventariadores (dni, nombre) VALUES ('68518475', 'Acevedo Arroyo Francesca');
INSERT INTO inventariadores (dni, nombre) VALUES ('65742154', 'Tongo Gómez Franklin');
INSERT INTO inventariadores (dni, nombre) VALUES ('65205405', 'Velásquez Nolasco Kevin');
INSERT INTO inventariadores (dni, nombre) VALUES ('65415088', 'Gonzales Rios Julio');
INSERT INTO inventariadores (dni, nombre) VALUES ('41547885', 'Salazar Plasencia Javier');
