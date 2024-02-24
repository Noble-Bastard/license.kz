set @userid = 53;

select @profileid := id from profile where user_id = @userid;

delete from task_hist where project_id in (select id from project where service_journal_id in (select id from service_journal where client_id = @profileid));
delete from task where project_id in (select id from project where service_journal_id in (select id from service_journal where client_id = @profileid));
delete from project where service_journal_id in (select id from service_journal where client_id = @profileid);
delete from service_journal_payment where service_journal_id in (select id from service_journal where client_id = @profileid);
delete from service_journal_step where service_journal_id in (select id from service_journal where client_id = @profileid);
delete from service_journal where client_id = @profileid;

delete from profile_legal where profile_id = @profileid;
delete from executor_hourly_rate where created_by = @profileid;
update profile set manager_id = null where manager_id = @profileid;
delete from profile where user_id = @userid;

delete from messages_read_hist where message_id in (select id from messages where email_journal_id in (select id from email_journal where created_by = @userid));
delete from messages where email_journal_id in (select id from email_journal where created_by = @userid);
delete from email_journal where created_by = @userid;

delete from user_role where user_id = @userid;
delete from users where id = @userid;

select * from users;