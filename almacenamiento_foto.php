psql -U master -d lynxspace;
select * from persona;
select count(*)  from persona where foto2 is not null;


network
pg puerto 5432
my puerto 3306


columna foto2 de tipo blockquote

alter table persona add column foto2 blob;
__________________________________________________________________________________

RBAC
mysql -u master -p
create table rol(id_rol int primary key auto_increment, rol varchar(50) not null);
create table privilegio(id_privilegio int primary key auto_increment, privilegio varchar(50));
create table rol_usuario(id_usuario int, id_rol int, constraint id_usuariofk1 foreign key (id_usuario)
                        references usuario(id_usuario), constraint id_rolfk2 foreign key (id_rol) references
                        rol (id_rol));
create rol_privilegios(id_rol int,id_privilegio int, constraint id_rolfk2 foreign key (id_rol) references
                        rol (id_rol),constraint id_privilegiofk2 foreign key (id_privilegio) references
                        privilegio (id_privilegio));//FALTA ESTA TABLA

insert into rol_usuario values ('Administrador', 'Usuario');
insert into privilegio(privilegio) values ('Administrador todo', 'Cuentas', 'Perfil', 'Post', 'Mensajes');
insert into rol_privilegio(id_rol,privilegio) values (1,1)();


------------------------
descargar una foto de una persona sombreada nombrada no_foto.phgpara cuando el usuario no tenga foto y colocarla en uploads donde estan las fotos de mis usuarios
insert int la persona 2 es amigo de la 1 y de la 3 y asegurarnos que tiene foto de perfil.

TAREA CRUD PARA SOLO EL ADMINISTRADOR PUEDE USAR ESTAS PANTALLAS UN CRUD PARA CADA TABLA
TABLA USUARIOS, PRIVILEGIOS, ROLES Y LAS OTRAS DOS.
EN LA PAGINA DE BIENVENIDA MIS AMIGOS.
