use app_ly;

delete from applied ;
delete from jobs ;
delete from work_history ;
delete from applicants ;

insert into jobs ( title , tags , description , city , country , posted , expiration , openings )
values
( 'Systems Engineer' , 'technology computer science engineering' , 'If you are an experienced Linux Systems Engineer; The Intersect Group has an exciting opportunity for you! We create unparalleled value for our clients and candidates by combining industry-leading consulting capabilities with comprehensive staffing and recruitment services. One of our clients is seeking a System Administrator Generalist with a strong website support background that can provide technical expertise for database administrators, applications developers, and application owners. If that sounds like you and your ready to take your career to the next level; let us help you succeed at the intersection of work and life!' , 'Kansas City' , 'United States' , '2014-03-12' , '2014-05-15' , 2 ) ,
( 'DevOps Engineer' , 'technology computer science engineering' , 'The Data DevOps Engineer plans and conducts activities concerned with ensuring the performance and reliability of our software applications.  This includes monitoring, validating changes, gathering and reporting metrics, testing, incident management, change management, etc.  Able to install, debug and support various environments that support CSIdentity applications.  The Data Engineering Support Engineer is expected to complete tasks independently and with minimum support from management staff.  S/he has a strong ability to grasp new technologies and acquire new skills through independent study and interaction with other team members.' , 'Atlanta' , 'United States' , '2014-03-10' , '2014-06-01' , 1 ) 
;

insert into applicants ( applicant_email , firstname , lastname , city , country , phone )
values
( 'spongebob@pineapple.com' , 'Spongebob' , 'Squarepants' , 'Dallas' , 'United States' , '934-481-6095' ) ,
( 'patrick@rock.com' , 'Patrick' , 'Star' , 'Ontario' , 'Canada' , '724-589-3759' ) ,
( 'squidward@easterisland.net' , 'Squidward' , 'Tentacles' , 'Seattle' , 'United States' , '485-592-6703' ) ,
( 'sandy@dome.org' , 'Sandy' , 'Cheeks' , 'Houston' , 'United States' , '452-547-9703' )
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

insert into users ( user_email , firstname , lastname , title )
values
( 'eugene@krustykrab.com' , 'Eugene' , 'Krabs' , 'Manager' ) ,
( 'sheldon@chumbucket.com' , 'Sheldon' , 'Plankton' , 'Mastermind' )
;

insert into comments ( user_email , applicant_email , comment )
values
( 'sheldon@chumbucket.com' , 'spongebob@pineapple.com' , 'Spongebob is a bit too loud for me, always singing about FUN' ) ,
( 'eugene@krustykrab.com' , 'squidward@easterisland.net' , 'Squidward is a decent employee. Spends a bit too much time talking about the clarinet when he should be saving me money' ) ,
( 'eugene@krustykrab.com' , 'spongebob@pineapple.com' , 'Spongebob seems very content working here for free.' )
;
