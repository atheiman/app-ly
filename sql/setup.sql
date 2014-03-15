use app_ly;
-- drop old tables
drop table jobs;

-- create new tables
create table jobs
(
id int not null auto_increment,
title varchar(255) not null,
field varchar(255) not null,
page varchar(255) not null,
expiration_date date not null,
primary key (id)
);

-- build relationships

