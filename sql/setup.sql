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
state char(2) not null,
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
state char(2) not null,
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

insert into jobs ( title , tags , description , city , state , posted , expiration , openings )
values
( 'Systems Engineer' , 'technology computer science engineering' , 'If you are an experienced Linux Systems Engineer; The Intersect Group has an exciting opportunity for you! We create unparalleled value for our clients and candidates by combining industry-leading consulting capabilities with comprehensive staffing and recruitment services. One of our clients is seeking a System Administrator Generalist with a strong website support background that can provide technical expertise for database administrators, applications developers, and application owners. If that sounds like you and your ready to take your career to the next level; let us help you succeed at the intersection of work and life!' , 'Kansas City' , 'KS' , '2014-03-12' , '2014-05-15' , 2 ) ,
( 'DevOps Engineer' , 'technology computer science engineering' , 'The Data DevOps Engineer plans and conducts activities concerned with ensuring the performance and reliability of our software applications.  This includes monitoring, validating changes, gathering and reporting metrics, testing, incident management, change management, etc.  Able to install, debug and support various environments that support CSIdentity applications.  The Data Engineering Support Engineer is expected to complete tasks independently and with minimum support from management staff.  S/he has a strong ability to grasp new technologies and acquire new skills through independent study and interaction with other team members.' , 'Atlanta' , 'GA' , '2014-03-10' , '2014-06-01' , 1 ) 
;

insert into applicants ( applicant_email , password , firstname , lastname , city , state , phone )
values
( 'spongebob@pineapple.com' , 'spongebobpass' , 'Spongebob' , 'Squarepants' , 'Dallas' , 'TX' , '934-481-6095' ) ,
( 'patrick@rock.com' , 'patrickpass' , 'Patrick' , 'Star' , 'Denver' , 'CO' , '724-589-3759' ) ,
( 'squidward@easterisland.net' , 'squidwardpass' , 'Squidward' , 'Tentacles' , 'Seattle' , 'WA' , '485-592-6703' ) ,
( 'sandy@dome.org' , 'sandypass' , 'Sandy' , 'Cheeks' , 'Houston' , 'TX' , '452-547-9703' )
;

insert into work_history ( applicant_email , title , employer , start_date , end_date , reason_for_leaving )
values
( 'spongebob@pineapple.com' , 'Frycook' , 'Weenie Hut General' , '2001-07-15' , '2004-01-01' , 'Embarassed of my job' ) ,
( 'spongebob@pineapple.com' , 'Frycook' , 'Krusty Krab' , '1999-05-01' , null , null ) ,
( 'squidward@easterisland.net' , 'Cashier' , 'Krusty Krab' , '1999-05-01' , null , null ) ,
( 'squidward@easterisland.net' , 'Band Director' , 'Bikini Bottom Municipal' , '2002-07-15' , '2005-02-15' , 'Lost the passion' ),
( 'sandy@dome.org' , 'Rancher' , 'Self-employed' , '1990-03-01' , '1999-04-15' , 'Moved to Bikini Bottom' )
;

insert into applied ( applicant_email , job_id )
values
( 'spongebob@pineapple.com' , 1 ) ,
( 'spongebob@pineapple.com' , 2 ) ,
( 'squidward@easterisland.net' , 1 ) ,
( 'sandy@dome.org' , 2 )
;

insert into users ( user_email , password , firstname , lastname , title )
values
( 'eugene@krustykrab.com' , 'eugenepass' , 'Eugene' , 'Krabs' , 'Manager' ) ,
( 'sheldon@chumbucket.com' , 'sheldonpass' , 'Sheldon' , 'Plankton' , 'Mastermind' )
;

insert into comments ( user_email , applicant_email , comment )
values
( 'sheldon@chumbucket.com' , 'spongebob@pineapple.com' , 'Spongebob is a bit too loud for me, always singing about FUN' ) ,
( 'eugene@krustykrab.com' , 'squidward@easterisland.net' , 'Squidward is a decent employee. Spends a bit too much time talking about the clarinet when he should be saving me money' ) ,
( 'eugene@krustykrab.com' , 'spongebob@pineapple.com' , 'Spongebob seems very content working here for free.' )
;
