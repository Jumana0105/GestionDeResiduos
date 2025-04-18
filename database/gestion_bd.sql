CREATE DATABASE IF NOT EXISTS gestion_bd
USE gestion_bd;

create table talleres
(
    id          int auto_increment
        primary key,
    titulo      varchar(150) not null,
    descripcion text         null,
    fecha       date         null
);

create table usuarios
(
    id             int auto_increment
        primary key,
    nombre         varchar(100)                          not null,
    correo         varchar(100)                          not null,
    contrasena     varchar(255)                          not null,
    direccion      text                                  null,
    numero_casa    varchar(20)                           null,
    comunidad      varchar(100)                          not null,
    foto_perfil    varchar(255)                          null,
    puntos         int       default 0                   null,
    fecha_registro timestamp default current_timestamp() not null,
    telefono       varchar(50)                           null,
    constraint correo
        unique (correo)
);

create table inscripciones
(
    id                int auto_increment
        primary key,
    id_usuario        int                                   not null,
    id_taller         int                                   not null,
    fecha_inscripcion timestamp default current_timestamp() not null,
    constraint inscripciones_ibfk_1
        foreign key (id_usuario) references usuarios (id)
            on update cascade on delete cascade,
    constraint inscripciones_ibfk_2
        foreign key (id_taller) references talleres (id)
            on update cascade on delete cascade
);

create index id_taller
    on inscripciones (id_taller);

create index id_usuario
    on inscripciones (id_usuario);

create table recolecciones
(
    id               int auto_increment
        primary key,
    id_usuario       int                             not null,
    tipo_residuo     varchar(100)                    null,
    estado           varchar(50) default 'pendiente' null,
    fecha_solicitada date                            null,
    fecha_confirmada date                            null,
    constraint recolecciones_ibfk_1
        foreign key (id_usuario) references usuarios (id)
            on update cascade on delete cascade
);

create index id_usuario
    on recolecciones (id_usuario);

create table reportes
(
    id          int auto_increment
        primary key,
    id_usuario  int                                   not null,
    descripcion text                                  not null,
    foto        varchar(255)                          null,
    ubicacion   varchar(200)                          null,
    fecha       timestamp default current_timestamp() not null,
    constraint reportes_ibfk_1
        foreign key (id_usuario) references usuarios (id)
            on update cascade on delete cascade
);

create index id_usuario
    on reportes (id_usuario);


