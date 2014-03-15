use app_ly;
-- drop old tables
drop table jobs;
drop table resumes;
drop table work_history;
drop table applicants;

-- create new tables
create table jobs
(
id int not null auto_increment,
title varchar(255) not null,
tags varchar(255) not null,
description text not null,
city varchar(255) not null,
country varchar(255) not null,
expiration date not null,
openings int(3) not null,
posted date not null,
primary key (id)
);
create table applicants
(
email varchar(255) not null,
firstname varchar(255) not null,
lastname varchar(255) not null,
city varchar(255) not null,
country varchar(255) not null,
phone varchar(255) not null,
primary key (email)
);
create table resumes
(
id int not null auto_increment,
email varchar(255) not null,
resume text not null,
updated timestamp,
primary key (id),
foreign key (email) references applicants(email)
);
create table work_history
(
id int not null auto_increment,
email varchar(255) not null,
title varchar(255) not null,
employer varchar(255) not null,
start_date date not null,
end_date date,
primary key (id),
foreign key (email) references applicants(email)
);

-- build relationships

