use app_ly;
-- drop old tables
drop table comments;
drop table applied;
drop table jobs;
drop table work_history;
drop table applicants;
drop table users;

-- create new tables
create table jobs
(
job_id int not null auto_increment,
title varchar(255) not null,
tags varchar(255) not null,
description text not null,
city varchar(255) not null,
country varchar(255) not null,
expiration date not null,
openings int(3) not null,
posted date not null,
primary key (job_id)
);
create table applicants
(
applicant_email varchar(255) not null,
password varchar(255) not null,
firstname varchar(255) not null,
lastname varchar(255) not null,
city varchar(255) not null,
country varchar(255) not null,
phone varchar(255) not null,
primary key (applicant_email)
);
create table work_history
(
wh_id int not null auto_increment,
applicant_email varchar(255) not null,
title varchar(255) not null,
employer varchar(255) not null,
start_date date not null,
end_date date,
reason_for_leaving text,
primary key (wh_id),
foreign key (applicant_email) references applicants(applicant_email)
);
create table applied
(
job_id int not null,
applicant_email varchar(255) not null,
foreign key (job_id) references jobs(job_id),
foreign key (applicant_email) references applicants(applicant_email)
);
create table users
(
user_email varchar(255) not null,
password varchar(255) not null,
firstname varchar(255) not null,
lastname varchar(255) not null,
title varchar(255) not null,
primary key (user_email)
);
create table comments
(
user_email varchar(255) not null,
applicant_email varchar(255) not null,
comment text not null,
foreign key (user_email) references users(user_email),
foreign key (applicant_email) references applicants(applicant_email)
);

