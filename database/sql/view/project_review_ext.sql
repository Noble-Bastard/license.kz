create or replace view project_review_ext
as
SELECT
  pr.id,
  pr.created_by,
  cb.name created_by_name,
  pr.create_date,
  pr.assigned_to,
  ato.name assigned_to_name,
  pr.project_review_status,
  prs.name project_review_status_name,
  pr.project_id,
  p.description project_description
FROM project_review pr
  left join project_review_status prs
  on prs.id = pr.project_review_status
  left join project p
  on p.id = pr.project_id
  left join users cb
  on cb.id = pr.created_by
  left join users ato
  on ato.id = pr.assigned_to;

