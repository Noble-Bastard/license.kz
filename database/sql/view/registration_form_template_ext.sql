create or replace view registration_form_template_ext
as
select
  rft.id,
  rft.counter_type_id,
  ct.name counter_type_name,
  rft.name
from registration_form_template rft
  left join counter_type ct
  on ct.id = rft.counter_type_id

