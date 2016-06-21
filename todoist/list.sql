create database list;

create table users(
   id int(10) unsigned not NULL auto_increment,
   username varchar(16) not NULL,
   email varchar(10) not NULL,
   passwd varchar(40) not NULL,
   primary key (id)
   ) charset=utf8;

create table items(
    id int(10) unsigned not NULL auto_increment,
    title varchar(50) not NULL,
    description tinytext not NULL,
    complete_by date,
    complete_on date,
    user_id int(10) unsigned not NULL,
    primary key (id),
    constraint foreign key (user_id) references users (id)
    ) charset=utf8;
