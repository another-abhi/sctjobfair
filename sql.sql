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
    contact varchar(10) not null,
    gender char(1) not null,
    percentage10 float not null,
    percentage12 float not null,
    ugcourseid varchar(50) not null,
    ugcollege varchar(100) not null,
    ugcgpa float not null,
    backlogs int not null,
    ugyop varchar(50) not null,
    fresher char(1) not null,
    experience float not null,
    expcompany varchar(50) not null,
    pgcourseid varchar(50) not null,
    pgcollege varchar(100) not null,
    pgcgpa float not null,
    pgyop varchar(50) not null,
    primary key(pid)
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

create table streams (
    streamid varchar(10) primary key,
    streamname varchar(50),
    courseid varchar(50)
);

CREATE TABLE company (
    cid varchar(100) primary key,
    cname varchar(255)
);

create table transactions (
    pid int not null,
    tid varchar(50) not null,
    primary key( pid, tid )
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

insert into participant(firstname, lastname, address, email, age, dob, contact, gender, percentage10, percentage12, ugcourseid, ugcollege, ugcgpa, fresher, experience, expcompany, backlogs, ugyop, pgcourseid, pgcollege, pgcgpa, pgyop) values ('akshay', 'venugopal', 'abc', 'abc@gmail.com', 20, '04NOV1995', '123', 'm', 90, 90, 'asd', 'sdf', 1, 'n', 2, 'acv', 0, '2014', 'asdf', 'sdf', 2, '2014');

