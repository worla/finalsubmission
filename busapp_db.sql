create schema busapp_db;
use busapp_db;

/*drop table seats;*/

create table seats(
s_id int primary key,
seats int(2),
default_seats int(2),
location varchar(128)
);

insert into seats (s_id,seats,default_seats,location) values (1,45,45,'searching...');
update seats set seats=24 where s_id=1;
select * from seats;
select count(s_id) from seats;

create table reserved(
r_id int primary key auto_increment,
name varchar(30),
code int(4),
location varchar(128),
cost int,
date date
);

insert into reserved (r_id,name,code) values (1,'Edem',0000);
insert into reserved (r_id,name,code) values (2,'Felix',1234);

select * from reserved;
select count(r_id) as number from reserved;


