CREATE TABLE participant (
    pid int not null AUTO_INCREMENT,
    regtime datetime default current_timestamp,
    paymentstatus char(20) not null,
    paymentmethod char(20) not null,
    regmethod char(20) not null,
    companycount int not null,
    fullname varchar(255) not null,
    address varchar(255) not null,
    email varchar(255) not null unique,
    age int not null,
    dob varchar(50) not null,
    contact varchar(20) not null,
    gender char(1) not null,
    percentage10 float not null,
    percentage12 float not null,
    ugcourse varchar(100) not null,
    ugcollege varchar(100) not null,
    ugbranch varchar(100),
    ugcgpa float not null,
    backlogs int not null,
    ugyop varchar(50) not null,
    fresher char(1) not null,
    experience float not null,
    expcompany varchar(200) not null,
    pgcourse varchar(100) not null,
    pgcollege varchar(100) not null,
    pgcgpa float not null,
    pgyop varchar(50) not null,
    primary key(pid)
);
create table participation(
    pid int,
    cid varchar(100),
    primary key (pid,cid)
);
create table pgcourse (
    pgcourseid varchar(20) primary key,
    pgcoursename varchar(50)
);

create table ugcourse (
    ugcourseid varchar(20) primary key,
    ugcoursename varchar(50)
);

CREATE TABLE company (
    cid varchar(100) primary key,
    cname varchar(255)
);


insert into ugcourse values ('btech', "Bachelor of Technology");
insert into ugcourse values ('diploma', "Diploma");
insert into ugcourse values ('bcom', "Bcom");
insert into ugcourse values ('ba', "BA");   

insert into pgcourse values ('mtech', "Master of Technology");
insert into pgcourse values ('ma', "MA");
insert into pgcourse values ('mba', "MBA");

insert into company values ('attinad', "Attinad Software");
insert into company values ('carestack', "Carestack");
insert into company values ('cognicor', "Cognicor");
insert into company values ('eglobe', "EGlobe");
insert into company values ('incatek', "Incatek");
insert into company values ('popularvehicles', "Popular Vehicles and Services");
insert into company values ('rajasree', "Rajasree Motors Pvt Ltd");
insert into company values ('travanleo', "Travanleo");
insert into company values ('seqato', "Seqato Software Solutions");
insert into company values ('star', "Star Health Insurance");
insert into company values ('yarab', "Yarab");
insert into company values ('orisys', "Orisys");
insert into company values ('ars', "ARS T&TT");
insert into company values ('interland', "Interland");

insert into company values ('', "");
insert into company values ('', "");
insert into company values ('', "");


