create or replace view registration_form_parameter_template_table_structure_ext
as
select
  rfptts.id,
  rfptts.registration_form_parameter_template_table_id,
  rfptts.column_parameter_template_id,
  rfptt.registration_form_parameter_template_id,
  rfptt.table_caption
from registration_form_parameter_template_table_structure  rfptts
  left join registration_form_parameter_template_table rfptt
  on rfptt.id = rfptts.registration_form_parameter_template_table_id

