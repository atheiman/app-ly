use app_ly;

delete from jobs ;
delete from resumes ;
delete from work_history ;
delete from applicants ;

insert into jobs ( title , tags , description , city , country , posted , expiration , openings )
values
( 'Systems Engineer' , 'technology computer science engineering' , 'If you are an experienced Linux Systems Engineer; The Intersect Group has an exciting opportunity for you! We create unparalleled value for our clients and candidates by combining industry-leading consulting capabilities with comprehensive staffing and recruitment services. One of our clients is seeking a System Administrator Generalist with a strong website support background that can provide technical expertise for database administrators, applications developers, and application owners. If that sounds like you and your ready to take your career to the next level; let us help you succeed at the intersection of work and life!' , 'Kansas City' , 'United States' , '2014-03-12' , '2014-05-15' , 2 ) ,
( 'DevOps Engineer' , 'technology computer science engineering' , 'The Data DevOps Engineer plans and conducts activities concerned with ensuring the performance and reliability of our software applications.  This includes monitoring, validating changes, gathering and reporting metrics, testing, incident management, change management, etc.  Able to install, debug and support various environments that support CSIdentity applications.  The Data Engineering Support Engineer is expected to complete tasks independently and with minimum support from management staff.  S/he has a strong ability to grasp new technologies and acquire new skills through independent study and interaction with other team members.' , 'Atlanta' , 'United States' , '2014-03-10' , '2014-06-01' , 1 ) 
;

insert into applicants ( email , firstname , lastname , city , country , phone )
values
( 'spongebob@pineapple.com' , 'Spongebob' , 'Squarepants' , 'Dallas' , 'United States' , '934-481-6095' ) ,
( 'patrick@rock.com' , 'Patrick' , 'Star' , 'Ontario' , 'Canada' , '724-589-3759' ) ,
( 'squidward@easterisland.net' , 'Squidward' , 'Tentacles' , 'Seattle' , 'United States' , '485-592-6703' ) ,
( 'sandy@dome.org' , 'Sandy' , 'Cheeks' , 'Houston' , 'United States' , '452-547-9703' )
;

insert into resumes ( email , resume )
values
( 'spongebob@pineapple.com' , 'Spongebob Squarepants spongebob@pineapple.com Fry Cook Krusty Krab Cooked delicious Krabby Patties for hungry customers. References available on request.' ) ,
( 'patrick@rock.com' , 'Patrick Star patrick@rock.com Professional sleeper. Spent many hours sleeping.' ) ,
( 'squidward@easterisland.net' , 'Squidward Tentacles squidward@easterisland.net Cashier Krusty Krab Calmed impatient customers requesting Krabby Patties. Responsible for handling large quantities of cash' ) ,
( 'sandy@dome.org' , 'Sandy Cheeks sandy@dome.org Rancher Raised and sold cattle profitably for 8 years.' )
;

insert into work_history ( email , title , employer , start_date , end_date )
values
( 'spongebob@pineapple.com' , 'Frycook' , 'Weenie Hut General' , '2001-07-15' , '2004-01-01' ) ,
( 'spongebob@pineapple.com' , 'Frycook' , 'Krusty Krab' , '1999-05-01' ) ,

;
