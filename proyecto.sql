drop database if exists projectPHP;
create database if not exists projectPHP;
use projectPHP;

create table zona (
    id_zona int primary key not null auto_increment,
    nombre varchar(25),
    creado_el timestamp default current_timestamp,
    editado_el timestamp default current_timestamp,
    desactivado_el timestamp default current_timestamp,
    estado tinyint default 1
);

create table colonia (
    id_colonia int primary key auto_increment,
    nombre varchar(50) not null,
    id_zona int not null,
    foreign key (id_zona)
        references zona (id_zona),
    creado_el timestamp default current_timestamp,
    editado_el timestamp default current_timestamp,
    desactivado_el timestamp default current_timestamp,
    estado tinyint default 1
);

create table rol (
    id_rol int not null auto_increment,
    rol varchar(50) not null,
    estado tinyint default 1,
    primary key (id_rol)
);

-- personas que operan el sistema
create table usuario (
    id_usuario int primary key not null auto_increment,
    usuario varchar(50) not null unique,
    clave varchar(70) not null,
    nombre varchar(50) not null,
    apellido varchar(50) not null,
    correo varchar(80) not null unique,
    id_rol int not null,
    foreign key (id_rol)
        references rol (id_rol),
    creado_el timestamp default current_timestamp,
    editado_el timestamp default current_timestamp,
    desactivado_el timestamp default current_timestamp,
    ultimo_acceso timestamp default current_timestamp,
    estado tinyint default 1
);
-- personas que pagan recibos e impuestos variados
create table tipo_persona (
    id_tipoP int primary key auto_increment,
    nombre varchar(50) not null,
    estado tinyint default 1
);

-- personas que pagan recibos e impuestos variados
create table persona (
    id_persona int primary key auto_increment,
    nombre varchar(100) not null,
    correo varchar(50) not null unique,
    direccion varchar(50),
    dui varchar(12) unique,
    nit varchar(20) not null unique,
    telefono varchar(25) not null,
    id_tipoP int not null,
    foreign key (id_tipoP)
        references tipo_persona (id_tipoP),
    estado tinyint default 1
);

create table empresa (
    id_empresa int primary key not null auto_increment,
    id_persona int not null,
    foreign key (id_persona)
        references persona (id_persona),
    nombre_juridico varchar(150),
    nombre_comercial varchar(150) unique,
    correo varchar(100) unique,
    telefono varchar(17),
    direccion varchar(250) not null,
    direccion_contacto varchar(17),
    actividad_principal varchar(250),
    actividad_economica varchar(250),
    id_colonia int not null,
    foreign key (id_colonia)
        references colonia (id_colonia),
    creado_el timestamp default current_timestamp,
    editado_el timestamp default current_timestamp,
    desactivado_el timestamp default current_timestamp,
    estado tinyint default 1
);

create table rubro (
    idRubro int primary key auto_increment,
    nombre varchar(50) unique,
    estado tinyint default 1
);

create table actividad_economica (
    idActividad int primary key auto_increment,
    actividad varchar(100) unique,
    idRubro int not null,
    foreign key (idRubro)
        references rubro (idRubro),
    estado tinyint default 1
);

create table empresa_actividad (
	noCuenta int primary key auto_increment,
    idActividad int not null,
    foreign key (idActividad) references actividad_economica (idActividad) on update cascade on delete no action,
    id_empresa int not null, 
    foreign key (id_empresa) references empresa (id_empresa) on update cascade on delete no action,
    montoReportado float not null,
    montoPorcentaje float,
    montoFijo float,
    creado_el timestamp default current_timestamp,
    editado_el timestamp default current_timestamp,
    desactivado_el timestamp default current_timestamp,
    estado tinyint default 1
);

create table tributo (
    idTributo int primary key auto_increment,
    nombre varchar(100) not null unique,
    tasa double not null,
    tipo varchar(30) not null,
    razon varchar(50) not null,
    creado_el timestamp default current_timestamp,
    editado_el timestamp default current_timestamp,
    desactivado_el timestamp default current_timestamp,
    estado tinyint default 1
);

create table actividad_tributo (
    idTributo int not null,
    foreign key (idTributo)
        references tributo (idTributo),
    idActividad int not null,
    foreign key (idActividad)
        references actividad_economica (idActividad),
    estado tinyint default 1
);

-- se pueden crear cualquier evento clasificado para hacer busquedas como: colonia_create, colonia_update
create table tipo_evento (
    id_tipo_evento int not null primary key auto_increment,
    nombre varchar(50) not null,
    estado tinyint default 1
);

create table bitacora (
    id_bitacora int primary key not null auto_increment,
    id_usuario int not null,
    foreign key (id_usuario)
        references usuario (id_usuario),
    info varchar(250) not null,
    fecha timestamp default current_timestamp,
    id_tipo_evento int not null,
    foreign key (id_tipo_evento)
        references tipo_evento (id_tipo_evento),
    estado tinyint default 1
);
DELIMITER $$

create procedure sp_llenarBitacora(in usuario int, in mov int, in tabla varchar(50))
begin
	declare id varchar(25);
    set id = (select ucase(nombre) from tipo_evento where id_tipo_evento=mov);
    if (mov = 1) then
    begin
		insert into bitacora (id_usuario, info, id_tipo_evento) values (usuario, concat('Agregacion de datos en: ',tabla), mov);
    end;
    end if;
    if (mov = 2) then
    begin
		insert into bitacora (id_usuario, info, id_tipo_evento) values (usuario, concat('Modificacion de datos en: ',tabla), mov);
    end;
    end if;
    if (mov = 3) then
    begin
		insert into bitacora (id_usuario, info, id_tipo_evento) values (usuario, concat('Eliminacion de datos en: ',tabla), mov);
    end;
    end if;
    if (mov = 4) then
    begin
		insert into bitacora (id_usuario, info, id_tipo_evento) values (usuario, concat('Seleccion de datos en: ',tabla), mov);
    end;
    end if;
    if (mov = 5) then
    begin
		insert into bitacora (id_usuario, info, id_tipo_evento) values (usuario, 'Datos utilizados para generar reporte', mov);
    end;
    end if;
    if (mov = 6) then
    begin
		insert into bitacora (id_usuario, info, id_tipo_evento) values (usuario, 'Inicio de Sesion', mov);
    end;
    end if;
    if (mov = 7) then
    begin
		insert into bitacora (id_usuario, info, id_tipo_evento) values (usuario, 'Cierre de Sesion', mov);
    end;
    end if;
end$$

DELIMITER ;


DELIMITER //
CREATE TRIGGER tr_CalcularMonto before INSERT ON empresa_actividad FOR EACH ROW
BEGIN
SET @tasa = (select SUM(tributo.tasa) from actividad_tributo
	inner join tributo on actividad_tributo.idTributo = tributo.idTributo
	inner join actividad_economica on actividad_tributo.idActividad = actividad_economica.idActividad
	where tributo.tipo = 'Municipal Porcentual' and actividad_economica.idActividad = new.idActividad or tributo.tipo = 'Anual Porcentual' and actividad_economica.idActividad = new.idActividad);
SET new.montoPorcentaje = (@tasa * new.montoReportado);

SET @tasa = (select SUM(tributo.tasa) from actividad_tributo
	inner join tributo on actividad_tributo.idTributo = tributo.idTributo
	inner join actividad_economica on actividad_tributo.idActividad = actividad_economica.idActividad
	where tributo.tipo = 'Municipal Fijo' and actividad_economica.idActividad = new.idActividad or tributo.tipo = 'Anual Fijo' and actividad_economica.idActividad = new.idActividad);
SET new.montoFijo = @tasa;
END//
DELIMITER ;

insert into rol (rol) values
('SuperAdmin'),
('Administador'),
('Usuario');

insert into usuario (usuario, clave, nombre, apellido, correo, id_rol) values
('admin', '$2y$10$zboS04sYVZdXV7IeL5G/XuFAIHctYRMAZfWsNXUaULcS0.g6hPD7W', 'pedro', 'perez', 'pedro.perez@email.com' , 1),
('supervisor', '$2y$10$zboS04sYVZdXV7IeL5G/XuFAIHctYRMAZfWsNXUaULcS0.g6hPD7W', 'rodrigo', 'hidalgo', 'rodrigo.hidalgo@email.com' , 2),
('asistente', '$2y$10$zboS04sYVZdXV7IeL5G/XuFAIHctYRMAZfWsNXUaULcS0.g6hPD7W', 'james', 'bond', 'james.bond@email.com' , 3);

insert into tipo_evento (nombre) values
('Insert'),
('Update'),
('Delete'),
('Select'),
('Generate Report'),
('Log in'),
('Log out');

insert into tipo_persona (nombre) values
('Persona Natural'),
('Persona Juridica');

call sp_llenarBitacora (1,1,'tipo_persona');

insert into rubro (nombre) values
('Comercial'),
('Industrial'),
('Servicio'),
('Financiera'),
('Agropecuario');
call sp_llenarBitacora (1,1,'rubro');

insert into actividad_economica (actividad,idRubro) values
('Salas de billar', 1),
('Radiodifusoras', 3),
('Actividades inmoviliarias realazidas con bienes propios o arrendadeos', 1),
('Construccion', 2),
('Extraccion de piedra, arena y arcilla', 2),
('Servicios profesionales y tecnicos', 3),
('Actividades de contabilidad (despachos contables)', 4),
('Servicios de asesoría y consultoría en gestión financiera', 4);
call sp_llenarBitacora (1,1,'actividad_economica');

insert into tributo (nombre, tasa, tipo, razon) values
('Impuesto por funcionamiento sala de billar', 50, 'Municipal Fijo', 'Tarifa de arbitrios de la municipalidad'),
('Casas dedicadas al arrendamiento de muebles', 100, 'Municipal Fijo', 'Tarifa de arbitrios de la municipalidad'),
('Construccion sobre el nivel del suelo general', 77.15, 'Municipal Fijo', 'Tarifa de arbitrios de la municipalidad'),
('Construccion sobre el nivel del suelo cantones', 35, 'Municipal Fijo', 'Tarifa de arbitrios de la municipalidad'),
('Funcionamiento de radiodifusoras', 75, 'Municipal Fijo', 'Tarifa de arbitrios de la municipalidad'),
('Extracción de piedras en propiedades privadas', 25, 'Municipal Fijo', 'Tarifa de arbitrios de la municipalidad'),
('Rotulos adosados hasta 2.00m cuadrados', 8, 'Municipal Fijo', 'Tarifa de arbitrios de la municipalidad'),
('Impuesto A', 12, 'Municipal Fijo', 'Tarifa de arbitrios de la municipalidad'),
('Impuesto B', 85, 'Municipal Fijo', 'Tarifa de arbitrios de la municipalidad'),
('Impuesto C', 58, 'Municipal Fijo', 'Tarifa de arbitrios de la municipalidad'),
('Impuesto D', 35, 'Municipal Fijo', 'Tarifa de arbitrios de la municipalidad'),
('Impuesto E', 90, 'Municipal Fijo', 'Tarifa de arbitrios de la municipalidad'),
('Impuesto F', 0.10, 'Municipal Porcentual', 'Tarifa de arbitrios de la municipalidad'),
('Impuesto G', 4.50, 'Municipal Fijo', 'Tarifa de arbitrios de la municipalidad'),
('Impuesto H', 15, 'Municipal Fijo', 'Tarifa de arbitrios de la municipalidad');
call sp_llenarBitacora (1,1,'tributo');

-- select * from actividad_economica;
-- select * from tributo;

insert into actividad_tributo (idTributo, idActividad) values
(1,1),
(7,1),
(9,1),
(5,2),
(13,2),
(10,3),
(8,3),
(3,4),
(4,4),
(9,5),
(5,5),
(8,6),
(11,6),
(12,6),
(15,7),
(7,8),
(14,8);
call sp_llenarBitacora (1,1,'actividad_tributo');

insert into persona (nombre,correo, direccion, dui, nit, telefono, id_tipoP) values
('Pedro Perez', 'pedrinsky@gmail.com', 'direccion X', '1234567890', '12345678901234', '77777777', 1),
('Jorge Garcia', 'jGarcia@gmail.com', 'direccion X', '1234567891', '12345678901235', '77777777', 1),
('Rodrigo Hidalgo', 'rodhid@gmail.com', 'direccion X', '1234567892', '12345678901236', '77777777', 1),
('Grupo Nose S.A.', 'gruponose@gmail.com', 'direccion X', null, '12345678901237', '77777777', 2),
('Nordlicth', 'nordlitch@gmail.com', 'direccion X', null, '12345678901238', '77777777', 2);
cALl sp_llenarBitacora (1,1,'persona');

insert into zona (nombre) values
('Disctricto 1'),
('Disctricto 2'),
('Disctricto 3'),
('Disctricto 4'),
('Disctricto 5');
cALl sp_llenarBitacora (1,1,'zona');

insert into colonia(nombre, id_zona) values
('Residencial Acovit',1),
('Residencial Girasoles',1),
('Reparto El Quequeisque',1),
('Colonia Quezaltepec',1),
('Residencial Alpes Suizos 1',1),
('Residencial Alpes Suizos 2',1),
('Residencial Europa',1),
('Lotificación Monteverde',1),
('colonia Nuevo Amanecer',1),
('colonia Don Bosco',1),
('colonia Las Delicias',1),
('residencial Pinares de Suiza',1),
('comunidad Guadalupe 1',1),
('comunidad Guadalupe 2',1),
('cantón Victoria',1),
('colonia Buena Vista',2),
('colonia Cumbres de Santa Tecla',2),
('residencial San Antonio',2),
('residencial Casa Bella',2),
('residencial Casa Verde 1',2),
('urbanización Hacienda San José',2),
('urbanización Brisas de Santa Tecla',2),
('Parque Residencial Villas de Francia 1',2),
('Residencial Altos de Santa Mónica',2),
('Residencial Montesión',2),
('Residencial Pinares de Santa Mónica',2),
('Parque residencial Villas de Francia 2',2),
('Colonia Jardines del Rey',2),
('Comunidad Las Margaritas',2),
('Colonia Santa Mónica',2),
('Colonia santa Teresa',2),
('Comunidad nueva Esperanza',2),
('Residencial Los Cipreses 1',2),
('Residencial Los Cipreses 2',2),
('Residencial Los Cipreses 3',2),
('Residencial La Colina',2),
('Comunidad el Progreso',2),
('Comunidad el Tanque',2),
('Urbanización San Antonio Las Palmeras',2),
('Colonia las Palmeras',2),
('Residencial San Rafael',2),
('Residencial Peña Blanca',2),
('Bosques de Santa Teresa',3),
('Finca de asturias Norte',3),
('Finca de asturias Sur',3),
('Joyas de la montaña',3),
('La Montaña 1',3),
('La Montaña 2',3),
('Paso Fresco',3),
('Jardines de la sabana 1',3),
('Jardines de la sabana 2',3),
('Jardines de la sabana 3',3),
('Jardines de merliot',3),
('Jardines del volcán 1',3),
('Jardines del volcán 2',3),
('Jardines del volcán 3',3),
('Jardines del volcán 4',3),
('Comunidad El Rosal',3),
('Residencial Maya',3),
('Jardines de la libertad',3),
('Jardines de Merliot',3),
('Comunidad El Trébol',3),
('Residencial Miraflores',3),
('Residencial Británica',3),
('Cantón Álvarez',3),
('Cantón El Progreso',3),
('Comunidad María Victoria',4),
('Residencial El Paraíso',4),
('Residencial Las Colinas 1',4),
('Residencial Cima del paraíso',4),
('Comunidad El Paraíso',4),
('Comunidad San Martin',4),
('urbanización Alemania',4),
('Colonia Residencial El Paraíso',4),
('Residencial Las Gardenias',4),
('Comunidad El Carmencito',4),
('Comunidad Nueva Esperanza',4),
('Residencial Altos de Utila 1',4),
('Residencial Altos de Utila 2',4),
('Residencial Altos de Utila 3',4),
('Cantón Ayagualo',5),
('Cantón las Granadillas',5),
('Cantón El Triunfo',5),
('Cantón el Limón',5),
('Cantón el matazano',5),
('Cantón sacazil',5),
('Cantón Los pajales',5),
('Comunidad Santa Marta',5),
('Comunidad Altos del Matazano',5);
calL sp_llenarBitacora (1,1,'colonia');

insert into empresa (id_persona, nombre_juridico, nombre_comercial, correo, telefono, direccion, direccion_contacto, id_colonia) values
(1, 'Rolfmaguera', 'Columbia Technology inc.', 'rolfMang@gmail.com', '2243-6200', '6846 Blackbird Alley', '2243-6201', 1),
(2, 'Kemmer-Hermiston', 'Truett-Hurst inc.', 'kemHer@gmail.com', '2203-8672', '2 Springview Road', '2203-8673', 2),
(3, 'Larnder', 'Fondo de Oportunidades S.a.', 'larnder@gmail.com', '2239-9372', '79 rieder Center', '2239-9373', 3),
(4, 'Carter & Windler', 'Jensyn Acquistion Corp.', 'ctow@gmail.com', '2289-0202', '4 Westport Hill', '2289-0203', 4),
(5, 'Wunschalter', 'Corcept Incorporated', 'wunsCorcept@gmail.com', '2263-6134', '92 Monica Drive', '2263-6135', 5);
CAlL sp_llenarBitacora (1,1,'empresa');
-- select * from empresa;
-- select * from actividad_economica;
insert into empresa_actividad (id_empresa, idActividad, montoReportado) values
(1,2,10000),
(4,4,1000);
CAlL sp_llenarBitacora (1,1,'empresa_actividad');

/*select actividad_economica.actividad, tributo.nombre, tributo.tasa from actividad_tributo
inner join tributo on actividad_tributo.idTributo = tributo.idTributo
inner join actividad_economica on actividad_tributo.idActividad = actividad_economica.idActividad;
select * from empresa;
select * from actividad_economica;
select * from actividad_tributo;
select * from tributo;
select * from empresa_actividad;*//*
select actividad_economica.actividad, tributo.nombre from actividad_tributo
inner join tributo on actividad_tributo.idTributo = tributo.idTributo
inner join actividad_economica on actividad_tributo.idActividad = actividad_economica.idActividad;*/
/*
select empresa.nombre_comercial, empresa.nombre_juridico,  tributo.tasa from actividad_tributo
inner join tributo on actividad_tributo.idTributo = tributo.idTributo
inner join actividad_economica on actividad_tributo.idActividad = actividad_economica.idActividad
inner join empresa_actividad on actividad_economica.idActividad = empresa_actividad.idActividad
inner join empresa on empresa_actividad.id_empresa = empresa.id_empresa
where tributo.tipo = 'Municipal Porcentual' and empresa.id_empresa = new.idActividad or tributo.tipo = 'Anual Porcentual' and actividad_economica.idActividad = new.idActividad
group by empresa.nombre_comercial;

select tributo.tasa from actividad_tributo
inner join tributo on actividad_tributo.idTributo = tributo.idTributo
inner join actividad_economica on actividad_tributo.idActividad = actividad_economica.idActividad
where tributo.tipo = 'Municipal Fijo' and actividad_economica.idActividad = new.idActividad or tributo.tipo = 'Anual Fijo' and actividad_economica.idActividad = new.idActividad;*/

