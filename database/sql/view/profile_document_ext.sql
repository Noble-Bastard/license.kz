 create or replace view profile_document_ext
  as
  select
      pd.id,
      p.id profile_id,
      p.full_name profile_full_name,
      p.user_id,
      u.name profile_user_name,
      pd.document_id,
      d.name document_name,
      d.path document_path
  from profile p
      inner join profile_document pd
      on pd.profile_id = p.id
        inner join document d
        on d.id = pd.document_id
      inner join users u
      on u.id = p.user_id