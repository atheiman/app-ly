-- show all work history for a given applicant
select a.applicant_email , a.lastname , w.title , w.employer from applicants as a , work_history as w
where a.applicant_email = w.applicant_email
and a.applicant_email = (select a.applicant_email from applicants as a where a.firstname = 'Squidward' and a.lastname = 'Tentacles')
order by a.applicant_email
;

-- show who has applied to a given job
select  a.firstname , a.lastname , j.title from applicants as a , jobs as j , applied
where applied.applicant_email = a.applicant_email
and applied.job_id = j.job_id
and j.job_id = (select j.job_id from jobs as j where j.title = 'Systems Engineer')
order by a.lastname
;

-- show all comments for a given applicant
select a.firstname , a.lastname , c.comment , u.firstname , u.lastname
from applicants as a , comments as c , users as u
where a.applicant_email = c.applicant_email
and u.user_email = c.user_email
and a.applicant_email = (select a.applicant_email from applicants as a where a.firstname = 'Spongebob' and a.lastname = 'Squarepants')
order by a.lastname 
;

