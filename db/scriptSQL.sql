create database imaginest; 
use imaginest; 

create table if not exists users(
	idUser int not null AUTO_INCREMENT primary key,
    mail varchar(40) unique,
    username varchar(16) unique,
    passHash varchar(60),
    userFirstName varchar(60),
    userLastName varchar(120),
    creationDate datetime default current_timestamp,
    lastSignIn datetime,
    removeDate datetime,
    active Tinyint(1),
    activationDate datetime,
    activationCode char(64),
    resetPass Tinyint(1),
    resetPassExpiry datetime,
    resetPassCode char(64)
) ENGINE = INNODB;


CREATE TABLE IF NOT EXISTS photos (
    idPhoto int auto_increment,
    idUser int,
    urlPath varchar(64),
    title varchar(30),
    description varchar (220),
    categoria varchar(15),
    pubDate datetime default current_timestamp,
    PRIMARY KEY (idPhoto, idUser),
	FOREIGN KEY (idUser) REFERENCES users(idUser)
) ENGINE = INNODB;

 CREATE TABLE IF NOT EXISTS hashtags (
    idHashtag int auto_increment primary key,
    valueHashtag varchar(20)
) ENGINE = INNODB; 


 CREATE TABLE IF NOT EXISTS hashtagsPub (
    idHashtagPub int auto_increment,
    idPhoto int,
    valueHashtag varchar(20),
    primary key(idHashtagPub,idPhoto),
    constraint fk_hashtagPub_photos FOREIGN KEY (idPhoto) REFERENCES photos(idPhoto) on update cascade on delete restrict
) ENGINE = INNODB; 
select * from hashtagsPub;


create table if not exists estatus (
    idPhoto int,
    idUser int,
    estatus char(1),
    primary key(idPhoto,idUser),
	constraint fk_estatus_photos FOREIGN KEY (idPhoto) REFERENCES photos(idPhoto) on update cascade on delete restrict ,
    constraint fk_estatus_users FOREIGN KEY (idUser) REFERENCES users(idUser)  on update cascade on delete restrict
)ENGINE = INNODB;


create table if not exists comentarios (
    idComentario int auto_increment,
    idPhoto int,
	username varchar(16),
    comentario varchar (220),
    primary key(idComentario,idPhoto),
   	FOREIGN KEY (idPhoto) REFERENCES photos(idPhoto)
)ENGINE = INNODB;





		