CREATE TABLE participant (
    pid varchar(100) primary key,
    lastname varchar(255),
    firstname varchar(255),
    address varchar(255),
    email varchar(255),
    age int,
    dob varchar(50),
    contact varchar(10),
    gender char(1),
    percentage10 decimal,
    percentage12 decimal,
    ugcourseid varchar(20),
    ugcollege varchar(100),
    ugcgpa decimal,
    fresher char(1),
    backlogs int,
    ugyop varchar(50),
    pgcourseid varchar(20),
    pgcollege varchar(100),
    pgcgpa decimal,
    pgyop varchar(50)
);
create table config(
    maxcompnay int,
    fee1 int,
    fee2 int,
    fee3 int,
    fee4 int,
    fee5 int
);
create table participation(
    pid varchar(100),
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

create table streams (
    streamid varchar(10) primary key,
    streamname varchar(50),
    courseid varchar(50)
);

CREATE TABLE company (
    cid varchar(100) primary key,
    cname varchar(255)
);

insert into ugcourse values ('btech', "Bachelor of Technology");

insert into pgcourse values ('mtech', "Master of Technology");

insert into company values ('', "");
insert into company values ('tcs', "Tata Consultancy Service");
insert into company values ('infosys', "Infosys");
insert into company values ('tataelxsi', "Tata Elxsi");
insert into company values ('asus', "ASUS");
insert into company values ('dell', "Dell");
insert into company values ('amazon', "Amazon");


