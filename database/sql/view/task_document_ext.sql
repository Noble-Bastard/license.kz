create or replace view task_document_ext
as
  select
    td.id,
    td.task_id,
    td.document_id,
    d.name document_name,
    d.path document_path,
    d.document_type_id,
    t.name document_type_name,
    td.create_date,
    td.description,
    tsk.project_id
  from
    task_document td
    left join document d
      on td.document_id = d.id
    left join document_type t
      on d.document_type_id = t.id
    left join task tsk
    on tsk.id = td.task_id



