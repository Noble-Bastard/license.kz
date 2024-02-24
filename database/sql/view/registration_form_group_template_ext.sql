create or replace view registration_form_group_template_ext
as
select
  rfgt.id,
  rfgt.registration_form_template_id,
  rft.name registration_form_template_name,
  rfgt.parameter_group_id,
  pg.name parameter_group_name,
  rfgt.order_number
from registration_form_group_template rfgt
  left join parameter_group pg
  on pg.id = rfgt.parameter_group_id
  left join registration_form_template rft
  on rft.id = rfgt.registration_form_template_id
