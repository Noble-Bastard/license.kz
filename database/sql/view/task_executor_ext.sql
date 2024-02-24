create or replace view task_executor_ext
as
SELECT
  te.id,
  te.task_id,
  te.executor_id,
  pr.full_name executor_full_name,
  pr.email executor_email,
  te.assign_date
FROM
  task_executor te
    LEFT JOIN profile pr
    ON te.executor_id = pr.id;
