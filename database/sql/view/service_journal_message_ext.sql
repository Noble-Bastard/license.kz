create or replace view service_journal_message_ext
as
select
  sjm.id,
  sjm.service_journal_id,
  sj.service_no service_journal_no,
  sjm.message_id,
  msg.caption message_caption,
  msg.create_date message_create_date,
  msg.message,
  sjm.create_date,
  sjm.created_by,
  prf.full_name created_by_full_name,
  r.id created_by_role_id,
  r.name created_by_role_name
from service_journal_message sjm
  left join service_journal sj
  on sj.id = sjm.service_journal_id
  left join messages msg
  on msg.id = sjm.message_id
  left join users usr
  on usr.id = sjm.created_by
    left join user_role ur
    on ur.user_id = usr.id
      left join role r
      on r.id = ur.role_id
  left join profile prf
  on prf.user_id = sjm.created_by



