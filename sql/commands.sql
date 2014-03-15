-- show all work history for a given applicant
select a.email , a.lastname , w.title , w.employer from applicants as a , work_history as w
where a.email = w.email
and a.email = (select a.email from applicants as a where a.firstname = 'Sandy' and a.lastname = 'Cheeks')
order by a.email
;

-- show who has applied to a given job
select  a.firstname , a.lastname , j.title from applicants as a , jobs as j , applied
where applied.email = a.email
and applied.job_id = j.job_id
and j.job_id = (select j.job_id from jobs as j where j.title = 'Systems Engineer')
order by a.email

