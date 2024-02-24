create or replace view executor_group_body_ext
as
SELECT
  egb.id,
  egb.executor_group_id,
  eg.name executor_group_name,
  egb.profile_id,
  prf.full_name profile_full_name
FROM executor_group_body egb
  left join executor_group eg
  on eg.id = egb.executor_group_id
  left join profile prf
  on prf.id = egb.profile_id
