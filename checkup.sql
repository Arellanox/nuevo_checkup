/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     20/08/2022 10:57:49 a. m.                    */
/*==============================================================*/


drop table if exists AREAS;

drop table if exists CARGOS;

drop table if exists CLIENTES;

drop table if exists CONTACTOS;

drop table if exists DEPENDENCIAS_SEGMENTOS;

drop table if exists DIRECCIONES;

drop table if exists PACIENTES;

drop table if exists PACIENTE_DETALLE;

drop table if exists PERMISOS;

drop table if exists PRECIOS;

drop table if exists PRECIOS_HISTORIAL;

drop table if exists SEGMENTOS;

drop table if exists SERVICIOS;

drop table if exists TIPOS_USUARIOS;

drop table if exists TURNOS;

drop table if exists USUARIOS;

drop table if exists USUARIOS_AREAS;

drop table if exists USUARIOS_PERMISOS;

/*==============================================================*/
/* Table: AREAS                                                 */
/*==============================================================*/
create table AREAS
(
   ID_AREA              int not null auto_increment,
   ENCARGADO_ID         int,
   DESCRIPCION          varchar(100),
   ESTA_LIBRE           boolean default 1,
   PRIORIDAD            int,
   ACTIVO               boolean default 1,
   primary key (ID_AREA)
);

/*==============================================================*/
/* Table: CARGOS                                                */
/*==============================================================*/
create table CARGOS
(
   ID_CARGO             int not null auto_increment,
   DESCRIPCION          varchar(100),
   ACTIVO               boolean default 1,
   primary key (ID_CARGO)
);

/*==============================================================*/
/* Table: CLIENTES                                              */
/*==============================================================*/
create table CLIENTES
(
   ID_CLIENTE           int not null auto_increment,
   NOMBRE_COMERCIAL     varchar(200),
   RAZON_SOCIAL         varchar(200),
   NOMBRE_SISTEMA       varchar(200),
   RFC                  varchar(100) unique,
   CURP                 varchar(100),
   ABREVIATURA          varchar(50),
   LIMITE_CREDITO       float,
   TEMPORALIDAD_DE_CREDITO int,
   CUENTA_CONTABLE      bigint,
   PAGINA_WEB           varchar(100),
   FACEBOOK             varchar(100),
   TWITTER              varchar(100),
   INSTAGRAM            varchar(100),
   ACTIVO               boolean default 1,
   primary key (ID_CLIENTE)
);

/*==============================================================*/
/* Table: CONTACTOS                                             */
/*==============================================================*/
create table CONTACTOS
(
   ID_CONTACTO          int not null auto_increment,
   ID_CLIENTE           int,
   NOMBRE               varchar(100),
   APELLIDOS            varchar(200),
   TELEFONO1            bigint,
   TELEFONO2            bigint,
   EMAIL                varchar(100),
   ACTIVO               bool default 1,
   primary key (ID_CONTACTO)
);

/*==============================================================*/
/* Table: DEPENDENCIAS_SEGMENTOS                                */
/*==============================================================*/
create table DEPENDENCIAS_SEGMENTOS
(
   ID_DEPENDENCIA       int not null auto_increment,
   CLIENTE_ID           int,
   SEGMENTO_ID          int,
   ACTIVO               boolean default 1,
   primary key (ID_DEPENDENCIA)
);

/*==============================================================*/
/* Table: DIRECCIONES                                           */
/*==============================================================*/
create table DIRECCIONES
(
   ID_DIRECCION         int not null auto_increment,
   CLIENTE_ID           int,
   CALLE                varchar(200),
   NUM_EXTERIOR         int,
   NUM_INTERIOR         int,
   CP                   int,
   COLONIA              varchar(200),
   CIUDAD               varchar(200),
   MUNICIPIO            varchar(200),
   ESTADO               varchar(200),
   PAIS                 varchar(200),
   ACTIVO               boolean default 1,
   primary key (ID_DIRECCION)
);

/*==============================================================*/
/* Table: PACIENTES                                             */
/*==============================================================*/
create table PACIENTES
(
   ID_PACIENTE          int not null auto_increment,
   SEGMENTO_ID          int,
   NOMBRE               varchar(100),
   PATERNO              varchar(100),
   MATERNO              varchar(100),
   EDAD                 int,
   NACIMIENTO           date,
   CURP                 varchar(50) unique,
   CELULAR              bigint,
   CORREO               varchar(100),
   CALLE                varchar(200),
   EXTERIOR             int,
   INTERIOR             int,
   COLONIA              varchar(200),
   POSTAL               int,
   RFC                  varchar(50),
   NACIONALIDAD         varchar(50),
   PASAPORTE            varchar(100),
   GENERO               varchar(50),
   VACUNA               varchar(100),
   OTRAVACUNA           varchar(100),
   DOSIS                varchar(50),
   FOTO                 blob,
   ACTIVO               boolean default 1,
   primary key (ID_PACIENTE)
);

/*==============================================================*/
/* Table: PACIENTE_DETALLE                                      */
/*==============================================================*/
create table PACIENTE_DETALLE
(
   ID_PACIENTE_DETALLE  int not null auto_increment,
   ID_PACIENTE          int,
   ID_SERVICIO          int,
   ID_TURNO             int,
   FECHA_INGRESO        date,
   CHECKED              bool default 0,
   SUBTOTAL             float(8,2),
   ACTIVO               bool default 1,
   primary key (ID_PACIENTE_DETALLE)
);

/*==============================================================*/
/* Table: PERMISOS                                              */
/*==============================================================*/
create table PERMISOS
(
   ID_PERMISO           int not null auto_increment,
   DESCRIPCION          varchar(100),
   ACTIVO               boolean default 1,
   primary key (ID_PERMISO)
);

/*==============================================================*/
/* Table: PRECIOS                                               */
/*==============================================================*/
create table PRECIOS
(
   ID_PRECIO            int not null auto_increment,
   CLIENTE_ID           int,
   SERVICIO_ID          int,
   COSTO                float(8,2),
   UTILIDAD             float(8,2),
   PRECIO               float(8,2),
   ACTIVO               bool default 1,
   primary key (ID_PRECIO)
);

/*==============================================================*/
/* Table: PRECIOS_HISTORIAL                                     */
/*==============================================================*/
create table PRECIOS_HISTORIAL
(
   ID_PRECIO_HISTORIAL  int not null auto_increment,
   PRECIO_ID            int,
   CLIENTE_ID           int,
   SERVICIO_ID          int,
   COSTO                float(8,2),
   UTILIDAD             float(8,2),
   PRECIO               float(8,2),
   FECHA_HORA           timestamp,
   primary key (ID_PRECIO_HISTORIAL)
);

/*==============================================================*/
/* Table: SEGMENTOS                                             */
/*==============================================================*/
create table SEGMENTOS
(
   ID_SEGMENTO          int not null auto_increment,
   PADRE                int,
   DESCCRIPCION         varchar(100),
   ACTIVO               boolean default 1,
   primary key (ID_SEGMENTO)
);

/*==============================================================*/
/* Table: SERVICIOS                                             */
/*==============================================================*/
create table SERVICIOS
(
   ID_SERVICIO          int not null auto_increment,
   PADRE                int,
   AREA_ID              int,
   DESCRIPCION          varchar(100),
   ES_PERFIL            boolean,
   ES_PRODUCTO          boolean,
   SELECCIONABLE        varchar(100),
   ES_PARA              varchar(100),
   ACTIVO               boolean default 1,
   primary key (ID_SERVICIO)
);

/*==============================================================*/
/* Table: TIPOS_USUARIOS                                        */
/*==============================================================*/
create table TIPOS_USUARIOS
(
   ID_TIPO              int not null auto_increment,
   DESCRIPCION          varchar(100),
   ACTIVO               boolean default 1,
   primary key (ID_TIPO)
);

/*==============================================================*/
/* Table: TURNOS                                                */
/*==============================================================*/
create table TURNOS
(
   ID_TURNO             int not null auto_increment,
   PACIENTE_ID          int,
   PREFOLIO             varchar(100),
   FECHA_RECEPCION      date,
   TURNO                varchar(100),
   HABILITADO           bool default 0,
   IDENTIFICACION       varchar(100),
   FECHA_REGISTRO       date,
   TOTAL                float(8,2),
   ACTIVO               bool default 1,
   primary key (ID_TURNO)
);

/*==============================================================*/
/* Table: USUARIOS                                              */
/*==============================================================*/
create table USUARIOS
(
   ID_USUARIO           int not null auto_increment,
   CARGO_ID             int,
   TIPO_ID              int,
   NOMBRE               varchar(100),
   PATERNO              varchar(100),
   MATERNO              varchar(100),
   USUARIO              varchar(100),
   CONTRASENIA          varchar(100),
   PROFESION            varchar(100),
   ACTIVO               boolean default 1,
   primary key (ID_USUARIO)
);

/*==============================================================*/
/* Table: USUARIOS_AREAS                                        */
/*==============================================================*/
create table USUARIOS_AREAS
(
   ID_USUARIO_AREA      int not null auto_increment,
   USUARIO_ID           int,
   AREA_ID              int,
   ACTIVO               boolean default 1,
   primary key (ID_USUARIO_AREA)
);

/*==============================================================*/
/* Table: USUARIOS_PERMISOS                                     */
/*==============================================================*/
create table USUARIOS_PERMISOS
(
   ID_USUARIO_PERMISO   int not null auto_increment,
   USUARIO_ID           int,
   PERMISO_ID           int,
   ACTIVO               boolean default 1,
   primary key (ID_USUARIO_PERMISO)
);

alter table AREAS add constraint FK_REFERENCE_8 foreign key (ENCARGADO_ID)
      references USUARIOS (ID_USUARIO) on delete restrict on update restrict;

alter table CONTACTOS add constraint FK_REFERENCE_20 foreign key (ID_CLIENTE)
      references CLIENTES (ID_CLIENTE) on delete restrict on update restrict;

alter table DEPENDENCIAS_SEGMENTOS add constraint FK_REFERENCE_3 foreign key (CLIENTE_ID)
      references CLIENTES (ID_CLIENTE) on delete restrict on update restrict;

alter table DEPENDENCIAS_SEGMENTOS add constraint FK_REFERENCE_4 foreign key (SEGMENTO_ID)
      references SEGMENTOS (ID_SEGMENTO) on delete restrict on update restrict;

alter table DIRECCIONES add constraint FK_REFERENCE_1 foreign key (CLIENTE_ID)
      references CLIENTES (ID_CLIENTE) on delete restrict on update restrict;

alter table PACIENTES add constraint FK_REFERENCE_5 foreign key (SEGMENTO_ID)
      references SEGMENTOS (ID_SEGMENTO) on delete restrict on update restrict;

alter table PACIENTE_DETALLE add constraint FK_REFERENCE_22 foreign key (ID_PACIENTE)
      references PACIENTES (ID_PACIENTE) on delete restrict on update restrict;

alter table PACIENTE_DETALLE add constraint FK_REFERENCE_23 foreign key (ID_SERVICIO)
      references SERVICIOS (ID_SERVICIO) on delete restrict on update restrict;

alter table PACIENTE_DETALLE add constraint FK_REFERENCE_24 foreign key (ID_TURNO)
      references TURNOS (ID_TURNO) on delete restrict on update restrict;

alter table PRECIOS add constraint FK_REFERENCE_15 foreign key (CLIENTE_ID)
      references CLIENTES (ID_CLIENTE) on delete restrict on update restrict;

alter table PRECIOS add constraint FK_REFERENCE_16 foreign key (SERVICIO_ID)
      references SERVICIOS (ID_SERVICIO) on delete restrict on update restrict;

alter table PRECIOS_HISTORIAL add constraint FK_REFERENCE_17 foreign key (PRECIO_ID)
      references PRECIOS (ID_PRECIO) on delete restrict on update restrict;

alter table PRECIOS_HISTORIAL add constraint FK_REFERENCE_18 foreign key (CLIENTE_ID)
      references CLIENTES (ID_CLIENTE) on delete restrict on update restrict;

alter table PRECIOS_HISTORIAL add constraint FK_REFERENCE_19 foreign key (SERVICIO_ID)
      references SERVICIOS (ID_SERVICIO) on delete restrict on update restrict;

alter table SEGMENTOS add constraint FK_REFERENCE_2 foreign key (PADRE)
      references SEGMENTOS (ID_SEGMENTO) on delete restrict on update restrict;

alter table SERVICIOS add constraint FK_REFERENCE_13 foreign key (PADRE)
      references SERVICIOS (ID_SERVICIO) on delete restrict on update restrict;

alter table SERVICIOS add constraint FK_REFERENCE_14 foreign key (AREA_ID)
      references AREAS (ID_AREA) on delete restrict on update restrict;

alter table TURNOS add constraint FK_REFERENCE_21 foreign key (PACIENTE_ID)
      references PACIENTES (ID_PACIENTE) on delete restrict on update restrict;

alter table USUARIOS add constraint FK_REFERENCE_6 foreign key (CARGO_ID)
      references CARGOS (ID_CARGO) on delete restrict on update restrict;

alter table USUARIOS add constraint FK_REFERENCE_7 foreign key (TIPO_ID)
      references TIPOS_USUARIOS (ID_TIPO) on delete restrict on update restrict;

alter table USUARIOS_AREAS add constraint FK_REFERENCE_11 foreign key (USUARIO_ID)
      references USUARIOS (ID_USUARIO) on delete restrict on update restrict;

alter table USUARIOS_AREAS add constraint FK_REFERENCE_12 foreign key (AREA_ID)
      references AREAS (ID_AREA) on delete restrict on update restrict;

alter table USUARIOS_PERMISOS add constraint FK_REFERENCE_10 foreign key (PERMISO_ID)
      references PERMISOS (ID_PERMISO) on delete restrict on update restrict;

alter table USUARIOS_PERMISOS add constraint FK_REFERENCE_9 foreign key (USUARIO_ID)
      references USUARIOS (ID_USUARIO) on delete restrict on update restrict;

